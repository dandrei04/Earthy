<?php 

include 'login_permission.inc.php';

if (isset($_POST['collect_event'])) {

    $eventID = $_POST['eventID']; // The ID of the event 
    $mainUser = $_SESSION['userId']; // The user that created the event 
    $num_rows = $_POST['num_rows']; // number of total rows = number of total participants (including the unchecked ones)
    $days = $_POST['days']; // number of days that passed between the creation of the event and his actual date (used in score_likes formula)
    $likes = $_POST['likes']; // the number of likes of the event 
    
    $going = 0; // how many of the participants have actually participated (were checked and are not "undifined")

    $score_likes = $likes * (1/(1+$days/2)); // Here is the formula that depends on the number of days that passed (if the event is created in the same day => score_likes = number of actual likes)
     
    $add_to_participants = floor($score_likes + 30); // For each checked participant we add him score_likes and also 30 points. 

    for ($i = 1; $i <= $num_rows; $i++) {

        if (isset($_POST[$i])) {
            
            $user_id = $_POST[$i]; 

            if($user_id != 0) {

                //UPDATE THE SCORE FOR EACH USER
                $sql_update = "UPDATE users SET user_pendingxp = user_pendingxp + $add_to_participants WHERE user_id = ?";
                $stmt_update =  mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                    mysqli_stmt_bind_param($stmt_update, "i", $user_id);
                    mysqli_stmt_execute($stmt_update);
                }

                $going++; // increment the number of participants 
            }
        }
    }       

    // If the event has more than 10 participants, it means we count it
    if($going >= 10)$successful_event = 1;
    else $successful_event = 0; 

    // The score depends on the number of people that participated (they were checked by the organiser)
    $score_going = $going / 10 * 30;

    // The total score is the sum between the score_going and the score_likes 
    $score_add = $score_going + $score_likes;
    $score_add = round($score_add);

    // First, check if the score hits maximum level 
    $dif_level = 0;

    $sql_score = "SELECT * FROM users WHERE user_id = ?";
    $stmt_score = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_score, $sql_score)) {
        mysqli_stmt_bind_param($stmt_score, "i", $mainUser);
        mysqli_stmt_execute($stmt_score);
        $result_score = mysqli_stmt_get_result($stmt_score);
        if ($row_score = mysqli_fetch_assoc($result_score)) {
            $actual_score = $row_score['user_xp'];
            $new_score = min($actual_score + $score_add, 1798053548);
            
            $actual_level = $row_score['user_lvl'];
            $numbers_events = $row_score['user_events'];
            
            $level = 1; $required_xp = 150;
            while ($required_xp <= $new_score) {
                $required_xp = intval($required_xp + $required_xp * (1/3.14));
                $level++;
            }
            $level--; 

            if ($level > $actual_level) {
                $dif_level = $level - $actual_level; 
                $array_level_size = $dif_level;
            }
        }
    }

    // UPDATE THE SCORE FOR OUR USER 
    $sql_update = "UPDATE users SET user_xp = $new_score WHERE user_id = ?";
    $stmt_update =  mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
        mysqli_stmt_bind_param($stmt_update, "i", $mainUser);
        mysqli_stmt_execute($stmt_update);
    }

    // UPDATE THE LEVEL FOR OUR USER 
    $sql_update = "UPDATE users SET user_lvl = $level WHERE user_id = ?";
    $stmt_update =  mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
        mysqli_stmt_bind_param($stmt_update, "i", $mainUser);
        mysqli_stmt_execute($stmt_update);
    }


    // DELETE THE EVENT FROM THE LIKES/GOING TABLE 
    $sql_delete = "DELETE FROM evlikes WHERE event_id = ?";
    $stmt_delete = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
        mysqli_stmt_bind_param($stmt_delete, "i", $eventID);
        mysqli_stmt_execute($stmt_delete);
    }


    // DELETE FROM THE MAIN EVENTS TABLE
    $sql_delete = "DELETE FROM events WHERE event_id = ?";
    $stmt_delete = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
        mysqli_stmt_bind_param($stmt_delete, "i", $eventID);
        mysqli_stmt_execute($stmt_delete);
    }


    // CHECK THE BADGES 
    // initialize the array 
    $url_array = array();
    for ($i = 1; $i <= 10; $i++) {
        array_push($url_array, 0);
    }
    
    // For the events part 
    if ($numbers_events == 0) {
        if ($going >= 10) {
            $numbers_events ++;
        }

        // now we check if he already collected a first event
        $badge_id = 2;

        $sql_ck_badge = "SELECT * FROM badges_user WHERE user_id = ? AND badge_id = ?";
        $stmt_ck_badge = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt_ck_badge, $sql_ck_badge)) {
            mysqli_stmt_bind_param($stmt_ck_badge, "ii", $mainUser, $badge_id);
            mysqli_stmt_execute($stmt_ck_badge);
            $result_ck_badge = mysqli_stmt_get_result($stmt_ck_badge);
            if ($row_ck_badge = mysqli_fetch_assoc($result_ck_badge)) {
                $url_array[1] = 0;
            }
            else {
                $url_array[1] = 1;
            }
        }
    }
    else {
        if ($going >= 10) {
            $numbers_events ++;

            if ($numbers_events == 5) $url_array[2] = 1;
            if ($numbers_events == 10) $url_array[3] = 1;
            if ($score_add > 100) {
                
                // now we check if he already did that 
                $badge_id = 9;

                $sql_ck_badge = "SELECT * FROM badges_user WHERE user_id = ? AND badge_id = ?";
                $stmt_ck_badge = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt_ck_badge, $sql_ck_badge)) {
                    mysqli_stmt_bind_param($stmt_ck_badge, "ii", $mainUser, $badge_id);
                    mysqli_stmt_execute($stmt_ck_badge);
                    $result_ck_badge = mysqli_stmt_get_result($stmt_ck_badge);
                    if ($row_ck_badge = mysqli_fetch_assoc($result_ck_badge)) {
                        $url_array[8] = 0;
                    }
                    else {
                        $url_array[8] = 1;
                    }
                }
            }
        }
    }   

    // Add the levels 
    for ($i = $actual_level + 1; $i <= $level; $i++) {
        array_push($url_array, $i);
    }

    // UPDATE THE EVENTS FOR OUR USER 
    $sql_update = "UPDATE users SET user_events = $numbers_events WHERE user_id = ?";
    $stmt_update =  mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
        mysqli_stmt_bind_param($stmt_update, "i", $mainUser);
        mysqli_stmt_execute($stmt_update);
    }

    // For the level part 
    for ($i = $actual_level + 1; $i <= $level; $i++) {
       if ($i == 10) $url_array[4] = 1;
       if ($i == 15) $url_array[5] = 1;
       if ($i == 35) $url_array[6] = 1;
       if ($i == 60) $url_array[7] = 1;
    }
    
    header("Location: ../create.php?levels_passed=".$dif_level."&".http_build_query($url_array)."");
    exit(0);
}
else {
    header("Location: ../create.php");
    exit(0);
}