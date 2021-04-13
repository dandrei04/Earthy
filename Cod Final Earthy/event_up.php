<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/event_up.css">
<script src="js/event_up.js"></script>

<?php 

    // WE USE THE SAME FILE FOR ACHIEVEMENTS AS WELL 

    echo '<div id="level_up-over_background"></div>';

    // Find if you get any badge 
    $first_badge = -1;
    for($i = 1; $i <= 10; $i++) {
        if ($_GET[$i - 1] == 1) {
            $first_badge = $i;
            $i = 11;
        }
    }

    // Display the badges 
    for ($i = 10; $i >= 1; $i--) {
        if ($_GET[$i - 1] == 1) {

            // First check if the badge is already inserted
            $badge_id = $i;

            $sql_ck_badge = "SELECT * FROM badges_user WHERE user_id = ? AND badge_id = ?";
            $stmt_ck_badge = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_ck_badge, $sql_ck_badge)) {
                mysqli_stmt_bind_param($stmt_ck_badge, "ii", $_SESSION['userId'], $badge_id);
                mysqli_stmt_execute($stmt_ck_badge);
                $result_ck_badge = mysqli_stmt_get_result($stmt_ck_badge);
                if (!$row_ck_badge = mysqli_fetch_assoc($result_ck_badge)) {
                    
                    // Insert the badge into table 
                    $sql_badge = "INSERT INTO badges_user(user_id, badge_id) VALUES(?, ?)";
                    $stmt_badge = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt_badge, $sql_badge)) { 
                        mysqli_stmt_bind_param($stmt_badge, "ii", $_SESSION['userId'], $badge_id);
                        mysqli_stmt_execute($stmt_badge);
                    }

                }
            }

            if ($first_badge != $badge_id) {
                echo '
                <div class="badge_done" id="badge_done'.$badge_id.'">
                    <div id="text">
                        <img src="images/new_badge.png" alt="">
                        <p>Whoo! You got a new badge! Visit the badge collection to see your new distinction!</p>
                        <button onclick="closeBadge('.$badge_id.')">YaY!</button>
                    </div>
                </div>';
            }
            else {
                echo '
                <div class="badge_done" id="badge_done'.$badge_id.'">
                    <div id="text">
                        <img src="images/new_badge.png" alt="">
                        <p>Whoo! You got a new badge! Visit the badge collection to see your new distinction!</p>
                        <form action="includes/cleanURL.inc.php"><button>YaY!</button></form>
                    </div>
                </div>';
            }
        }
    }

    // Display yhe levels 
    $level_ups = max($_GET['levels_passed'], 0);
    $first_level = $_GET[10];
    $last_level = $first_level + $level_ups - 1;

    if ($level_ups > 0) {

        $level = $last_level;
        if ($first_badge == -1) {
            echo '
            <div class="level_up" id="level_up'.$level.'">
                <div id="text">
                    <img src="images/star.png" alt="">
                    <h1>'.$level.'</h1>
                    <p>Great Work! You have achieved a new level! Keep up with the good work. Our Earth is thankful!</p>
                    <form action="includes/cleanURL.inc.php"><button>YaY!</button></form>
                </div>
            </div>';
        }
        else {
            echo '
            <div class="level_up" id="level_up'.$level.'">
                <div id="text">
                    <img src="images/star.png" alt="">
                    <h1>'.$level.'</h1>
                    <p>Great Work! You have achieved a new level! Keep up with the good work. Our Earth is thankful!</p>
                    <button onclick="closeLevel('.$level.')">YaY!</button>
                </div>
            </div>';
        }

        for ($level = $last_level - 1; $level >= $first_level; $level--) {
            echo '
            <div class="level_up" id="level_up'.$level.'">
                <div id="text">
                    <img src="images/star.png" alt="">
                    <h1>'.$level.'</h1>
                    <p>Great Work! You have achieved a new level! Keep up with the good work. Our Earth is thankful!</p>
                    <button onclick="closeLevel('.$level.')">YaY!</button>
                </div>
            </div>';
        }     
    }
?>
