<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/profilefilterwall.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="js/profilefilterwall.js"></script>

<div id="side-box">
    <div id="myprofile">
        
        <?php 
        $id = $_SESSION['userId'];

        $sql = "SELECT * FROM users WHERE user_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $myusername = "undifined";
            //$myurlprofile = "images/logo.png";
            //$myachivment = 0;
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

        // TRANSFORM THE NUMBERS - for the POINTS 
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

        // TRANSFORM THE NUMBERS - for the EVENTS 
        if($events < 1000) {
            $events_format = $events;
        }
        else if ($events < 1000000) {
            // Anything less than a million
            $events_format = bcdiv($events, 1000, 1) . 'K';
        } else if ($events < 1000000000) {
            // Anything less than a billion
            $events_format = bcdiv($events, 1000000, 1) . 'M';
        } else {
            // At least a billion
            $events_format = bcdiv($events, 1000000000, 1) . 'B';
        }

        echo '
        <div id="img-myprofile">
            <img src="images/profile_pic'.$idphoto.'.png" alt="Your Photo">
        </div>
        <div id="info-myprofile"> 
            <h1>'.$myusername.'</h1>
            <h2>@'.$destinction.'</h2>
        </div> 

        <div id="counter-bar">
            <div class="counter-box" id="score-counter">
                <h1>Level</h1>
                <div class="box">
                    <h2>'.$level.'</h2>
                </div>
            </div>

            <div class="counter-box" id="points-counter">
                <h1>Points</h1>
                <div class="box">
                    <h2>'.$xp_format.'</h2>
                </div>
            </div>

            
            <div class="counter-box" id="events-counter">
                <h1>Events</h1>
                <div class="box">
                    <h2>'.$events_format.'</h2>
                </div>
            </div>
        </div>';
        ?>

    </div>

    <div id="open-filter">

        <h1>ORDER BY:</h1>
        <div id="filter-btn" onclick="openFilter(2)">
            <img src="images/filter.png">
        </div>

    </div>


    <div id="filter">
        <form class="filter-form" id="filter-form2" action="includes/filter-achivs.inc.php" method="POST">
        
            <select name="order" id="order">
                <option value="1">Post-date</option>
                <option value="2">Hearts</option>
            </select>

            <button type="submit" name="Search">Search</button>

        </form>
    </div>

</div>