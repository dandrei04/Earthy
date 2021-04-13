<?php 

include 'login_permission_ajax.inc.php';

if (isset($_POST['achiv_id'])) {

    $achiv_id=$_POST['achiv_id'];

    $sql = "SELECT * FROM achievements WHERE achiv_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: create.php");
        exit(); 
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $achiv_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            echo ' 

            <div id="behind-image"></div>
            <img src="images/background2_achivs.jpg" id="inspect_image">

            <div id="top-div">

                <form id="delete-achiv" action="includes/deleteAchiv.inc.php" method="POST">
                    <input type="hidden" name="id" value='.$row['achiv_id'].'>
                    <button id="achiv'.$row['achiv_id'].'" type="submit" name="delete"></button>
                </form>
                <button id="fake_delete" onclick="confirm_before_delete(&quot;achiv&quot; , '.$row['achiv_id'].')"></button>

            </div>

            <div class="choose-info">
                <div class="choose-description" id="choose-description">
                    <h1>DESCRIPTION</h1>
                </div>

                <div class="box-underline-bar" id="box-underline-bar">
                    <div class="underline-bar" id="underline-bar"></div>
                </div> 
            </div>

            <div class="inspect-info-text" id="inspect-info-text">
                <h1 id="achiv-title">'.$row['achiv_title'].'</h1>
                <p id="achiv-description">'.$row['achiv_description'].'</p>
            </div>';
                            
            echo '
            <div id="number_hearts_going">
                <div id="heart-box"> 
                    <label><img src="images/red_heart.png"></label>
                    <h1>'.number_format($row['achiv_likes'], 0, ".", ".").'</h1>
                </div>
            </div>
            ';

            // Here we find the number of days passed from the creation of the post
            $time_start = strtotime($row['achiv_date_create']);
            $time_fin = strtotime(gmdate("Y-m-d H:i")); 
            $datediff = $time_fin - $time_start; 
            $datediff = intval($datediff / (60 * 60 * 24));

            echo '
            <div id="form-box">
                <form id="collect-points-achiv" action="includes/collect_achiv.inc.php" method="POST">
                    <input type="hidden" name="achivID" value="'.$achiv_id.'"> 
                    <input type="hidden" name="likes" value="'.$row['achiv_likes'].'">
                    <input type="hidden" name="days" value="'.$datediff.'">
                    <button name="collect_achiv" type="submit">COLLECT POINTS</button>
                </form>
            </div>
            ';
        }
    }
}