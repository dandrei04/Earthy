<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/badges.css">
<script src="js/badges.js"></script>

<div id="badges">   

    <div stlye="display:none" id="ajax-load-div-badge"></div>

    <div id="header">
        <span></span>
        <h1>BADGES</h1>
        <span></span>
    </div>

    <div id="badges-content">
    <?php 
        $sql = "SELECT * FROM badges";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            // Find the active distinction 
            $sql_distinction = "SELECT * FROM users WHERE user_id = ?"; 
            $stmt_distinction = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_distinction, $sql_distinction)) {
                mysqli_stmt_bind_param($stmt_distinction, "i", $_SESSION['userId']);
                mysqli_stmt_execute($stmt_distinction);
                $result_distinction = mysqli_stmt_get_result($stmt_distinction);
                if ($row_distinction = mysqli_fetch_assoc($result_distinction)) {
                    $active_distinction = $row_distinction['user_destinction'];
                }
            }
            
            while ($row = mysqli_fetch_assoc($result)) {

                // Check if it is approved 
                $badge_id = $row['badges_id'];
                
                if ($active_distinction == $row['badges_distinction']) $active_badge = $row['badges_id'];

                $sql_check = "SELECT * FROM badges_user WHERE user_id = ? and badge_id = ?"; 
                $stmt_check = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt_check, $sql_check)) {
                    mysqli_stmt_bind_param($stmt_check, "ii", $_SESSION['userId'], $badge_id);
                    mysqli_stmt_execute($stmt_check);
                    $result_check = mysqli_stmt_get_result($stmt_check);
                    if ($row_check = mysqli_fetch_assoc($result_check)) {
                        // It means the badge is approved 
                        echo '
                        <div id="badge-box">
                            <div style="background-color:'.$row['badges_background'].'" id="badge-image">
                                <img src="'.$row['badges_image'].'">
                            </div>

                            <div id="badge-text">
                                <h1>'.$row['badges_distinction'].'</h1>
                                <div class="switch">
                                    <input id="input_ck'.$row['badges_id'].'" type="checkbox">
                                    <span class="slider" onclick="chooseBadge('.$row['badges_id'].', \''.$row['badges_distinction'].'\')"></span>
                                </div>
                            </div>
                        </div>';
                    }
                    else {
                        // It means is not approved 
                        echo '
                        <div id="badge-box">
                            <div style="background-color:'.$row['badges_background'].'" id="badge-background-locked">
                                <img src="images/locker.png">
                                <p>'.$row['badges_description'].'</p>
                                <div id="badge-over-background"></div>
                            </div>
                        </div>';
                    }
                }
            }

            // Make active the badge 
            echo '<script>activateBadge('.$active_badge.')</script>';
        } 
    ?>
    </div>
</div>