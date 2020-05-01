<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/create_achivs_box.css">

<div id="achiv-box">
    <div id="over-background-achiv"></div>

    <div class="over-over-background">
        <h2>Here are your Achievements and Ideas!</h2>
        <p>Unlike the events, the Achievements and Ideas focus more on "hearts"! Write something nice and make people love your post! Think green!</p>
            
        <div id="achivs-display">
            
            <?php 
                $sql = "SELECT * FROM achievements WHERE achiv_userid=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: create.php");
                    exit(); 
                }
                else {
                    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($result)) {

                        $utc_date = $row['achiv_date_create'];
                        $utc_date = strtotime($utc_date); 

                        echo '
                        <div id="achiv-box-display">
                            <div id="square-img">
                                <div id="circle-img">
                                    <img src="images/achiv.png" alt="prize">
                                </div>
                            </div>
                            
                            <h1 id="open_inspectAchiv" onclick="inspectAchiv('.$row['achiv_id'].')">'.$row['achiv_title'].'</h1>
                            <h3 id="achiv_date_header'.$row['achiv_id'].'"></h3>

                            <form action="includes/deleteAchiv.inc.php" method="POST">
                                <input type="hidden" name="id" value='.$row['achiv_id'].'>
                                <button id="achiv'.$row['achiv_id'].'" type="submit" name="delete"></button>
                            </form>

                            <button id="fake_delete" onclick="confirm_before_delete(&quot;achiv&quot; , '.$row['achiv_id'].')"></button>
                        </div>';
                        
                        // Get the date_header 
                        echo '
                        <script>
                            function TransformAchiv_time(date) {
                                var newDate = new Date(date*1000);
                                formatted_newDate = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                                document.getElementById("achiv_date_header'.$row['achiv_id'].'").innerHTML = formatted_newDate;
                            }
                            TransformAchiv_time('.$utc_date.');
                        </script>';
                        
                        while ($row = mysqli_fetch_assoc($result)) {

                            $utc_date = $row['achiv_date_create'];
                            $utc_date = strtotime($utc_date); 

                            echo '
                            <div id="achiv-box-display">
                                <div id="square-img">
                                    <div id="circle-img">
                                        <img src="images/achiv.png" alt="prize">
                                    </div>
                                </div>
                                
                                <h1 id="open_inspectAchiv" onclick="inspectAchiv('.$row['achiv_id'].')">'.$row['achiv_title'].'</h1>
                                <h3 id="achiv_date_header'.$row['achiv_id'].'"></h3>

                                <form action="includes/deleteAchiv.inc.php" method="POST">
                                    <input type="hidden" name="id" value='.$row['achiv_id'].'>
                                    <button id="achiv'.$row['achiv_id'].'" type="submit" name="delete"></button>
                                </form>
                                
                                <button id="fake_delete" onclick="confirm_before_delete(&quot;achiv&quot; , '.$row['achiv_id'].')"></button>
                            </div>';

                            // Get the date_header 
                            echo '
                            <script>
                                function TransformAchiv_time(date) {
                                    var newDate = new Date(date*1000);
                                    formatted_newDate = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                                    document.getElementById("achiv_date_header'.$row['achiv_id'].'").innerHTML = formatted_newDate;
                                }
                                TransformAchiv_time('.$utc_date.');
                            </script>';
                            }
                    }
                    else {
                        echo '
                        <div id="no-achiv">
                            <img src="images/no_achiv.png">
                        </div>
                        ';
                    }
                }
            ?>

        </div>

        <div id="add-button">
            <button id="openAchiv">Create</button>
        </div>
        
    </div>  
</div>