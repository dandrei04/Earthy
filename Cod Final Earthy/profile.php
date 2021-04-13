<?php 
    // Activate the access to the page 
    define('included',TRUE);
?>

<?php include 'general.php'; include 'login_permission.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/readEvent.css">
    <link rel="shortcut icon" href="images/logo.png"/>
    <script src="js/profile.js"></script>

    <title>Earthy | Profile</title>
</head>
<body>

    <?php 
        echo '<div id="over-background"></div>'; 
        echo '<div id="readEvent"></div>';
        include 'navbar.php';
    ?>

    <!-- For the profile responsive page -->
    <style>
        #open-nav-container {
            top: 12.5px;
        }
    </style>

    <?php date_default_timezone_set('UTC'); ?>
    
    <div id="profile-box">
        <?php 
            $id = $_SESSION['userId'];

            $sql = "SELECT * FROM users WHERE user_id=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: home.php");
                exit(0);
            }
            else {
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)) {
                    $myusername = $row['user_uid'];
                    $idphoto = $row['user_profile'];
                    $level = $row['user_lvl'];
                    $xp = $row['user_xp'];
                    $events = $row['user_events'];
                    $destinction = $row['user_destinction'];
                }
                else {
                    $myusername = "undifined";
                    $idphoto = 1;
                    $level = 0;
                    $xp = 0;
                    $events = 0;
                    $destinction = "leaf";
                }
            }
            
            // Get the XP until the level obtained  
            if ($level == 0) {
                $necessary_xp = 150;
                $over_xp = $xp; 
            }
            else {
                $gained_xp = 150;
                for ($i = 2; $i <= $level; $i++) {
                    $gained_xp = intval($gained_xp + $gained_xp * (1/3.14));
                }
                $necessary_xp = intval($gained_xp + $gained_xp * (1/3.14));
                $over_xp = $xp - $gained_xp; 
            }
            $percentage = intval(101 - ($xp * 100) / $necessary_xp);


            // TRANSFORM THE NUMBERS
            if($xp < 1000) {
                $xp_format = $xp;
            }
            else if ($xp < 1000000) {
                // Anything less than a million
                $xp_format = bcdiv($xp, 1000, 1) . 'K';
            } else if ($xp < 1000000000) {
                // Anything less than a billion
                $xp_format = bcdiv($xp, 1000000, 1) . 'M';
            } else {
                // At least a billion
                $xp_format = bcdiv($xp, 1000000000, 1) . 'B';
            }

            echo '
            <div id="profile-data">

                <div id="image-box">
                    <img src="images/profile_pic'.$idphoto.'.png" alt="Your Photo">
                </div>

                <div id="text-part">
                    <div id="info-box">
                        <h1>'.$myusername.'</h1>
                        <h2><span>DESTINCTION:</span> @'.$destinction.'</h2>
                    </div>

                    <div id="choose-bar">
                        <div id="choose-header">
                            <h1 id="progress" onclick="chooseAbout()">Progress</h1>
                            <h1 id="future-events" onclick="chooseEvents()">Future-Events</h1>
                        </div>

                        <div id="under-bar">
                            <div id="bar"></div>
                        </div>
                    </div>

                    <div id="about"> 
                        <div id="about-headers">
                            <h1 id="level"><span>'.$level.'</span> LEVEL</h1>
                            <h1 id="total-points"><span>'.$xp_format.'</span> POINTS</h1>
                        </div>
                        <h1 id="remained-points"><span>'.$percentage.'%</span> until next level</h1>

                        <div id="level-bar"></div>       
                        <img src="images/profile_tree.png">
                        <script>fillBar('.(100 - $percentage).')</script>
                    </div>
                    
                    <div id="myevents">';

                        // Get all the events where the user said will attend 
                        $sql_events = "SELECT * FROM evlikes WHERE user_id = ? AND going_state = 1";
                        $stmt_events = mysqli_stmt_init($conn);

                        if (mysqli_stmt_prepare($stmt_events, $sql_events)) {
                
                            mysqli_stmt_bind_param($stmt_events, "i", $id);
                            mysqli_stmt_execute($stmt_events);
                            $result_events = mysqli_stmt_get_result($stmt_events);
                            if ($row_events = mysqli_fetch_assoc($result_events)) {
                                
                                $event_id = $row_events['event_id'];
                                
                                // Get the info of the event 
                                $sql_choose_event = "SELECT * FROM events WHERE event_id = ?";
                                $stmt_choose_event = mysqli_stmt_init($conn);

                                if (mysqli_stmt_prepare($stmt_choose_event, $sql_choose_event)) {
                                    mysqli_stmt_bind_param($stmt_choose_event, "i", $event_id);
                                    mysqli_stmt_execute($stmt_choose_event);
                                    $result_choose_event = mysqli_stmt_get_result($stmt_choose_event);
                                    if ($row_choose_event = mysqli_fetch_assoc($result_choose_event)) {
                                        $date_now = gmdate("Y-m-d H:i");
                                        if ($date_now < $row_choose_event['event_date']) {
                                            echo '
                                            <div id="event-title-box">
                                                <h1 id="open_readEvent" onclick="readEvent('.$row_choose_event['event_id'].')">'.$row_choose_event['event_title'].'</h1>
                                            </div>
                                            ';
                                        }
                                    }
                                }

                                while ($row_events = mysqli_fetch_assoc($result_events)) {

                                    $event_id = $row_events['event_id'];
                                
                                    // Get the info of the event 
                                    $sql_choose_event = "SELECT * FROM events WHERE event_id = ?";
                                    $stmt_choose_event = mysqli_stmt_init($conn);
    
                                    if (mysqli_stmt_prepare($stmt_choose_event, $sql_choose_event)) {
                                        mysqli_stmt_bind_param($stmt_choose_event, "i", $event_id);
                                        mysqli_stmt_execute($stmt_choose_event);
                                        $result_choose_event = mysqli_stmt_get_result($stmt_choose_event);
                                        if ($row_choose_event = mysqli_fetch_assoc($result_choose_event)) {
                                            $date_now = gmdate("Y-m-d H:i");
                                            if ($date_now < $row_choose_event['event_date']) {
                                                echo '
                                                <div id="event-title-box">
                                                    <h1 id="open_readEvent" onclick="readEvent('.$row_choose_event['event_id'].')">'.$row_choose_event['event_title'].'</h1>
                                                </div>
                                                ';
                                            }
                                        }
                                    }
                                }
                            }
                            else {
                                echo '<img id="make-plans" src="images/make_plans.png">';
                                echo '<h1 id="no_future_events">Oh no! You do not have any plans!</h1>';
                            }
                        }

                    echo '</div>
                </div>
            </div>';
        ?>
    
    </div>

</body>
   
</html>