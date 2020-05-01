<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/eventwall.css">
<script src="js/eventwall.js"></script>
<?php date_default_timezone_set('UTC'); ?>

<div id="events-posts">
    <?php 
        $id = $_SESSION['userId'];
        $date_now = gmdate("Y-m-d H:i");

        if ($_SESSION['city'] != '0') {
            
            $city = $_SESSION['city'];
            $state = $_SESSION['state'];
            $country = $_SESSION['country'];

            if ($_SESSION['event_sort'] == 1) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_city = '$city' AND event_date > '$date_now' ORDER BY event_date_create DESC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 2) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_city = '$city' AND event_date > '$date_now' ORDER BY event_date ASC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 3) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_city = '$city' AND event_date > '$date_now' ORDER BY event_likes, event_date ASC DESC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 4) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_city = '$city' AND event_date > '$date_now' ORDER BY event_going DESC, event_date ASC LIMIT 4";
            }

        }
        else if ($_SESSION['state'] != '0') {
          
            $state = $_SESSION['state'];
            $country = $_SESSION['country'];

            if ($_SESSION['event_sort'] == 1) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_date > '$date_now' ORDER BY event_date_create DESC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 2) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_date > '$date_now' ORDER BY event_date ASC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 3) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_date > '$date_now' ORDER BY event_likes DESC, event_date ASC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 4) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_state = '$state' AND event_date > '$date_now' ORDER BY event_going DESC, event_date ASC LIMIT 4";
            }

        }
        else if ($_SESSION['country'] != '0') {
            
            $country = $_SESSION['country'];

            if ($_SESSION['event_sort'] == 1) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_date > '$date_now' ORDER BY event_date_create DESC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 2) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_date > '$date_now' ORDER BY event_date ASC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 3) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_date > '$date_now' ORDER BY event_likes, event_date ASC DESC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 4) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_country = '$country' AND event_date > '$date_now' ORDER BY event_going DESC, event_date ASC LIMIT 4";
            }

        }
        else {

            if ($_SESSION['event_sort'] == 1) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_date > '$date_now' ORDER BY event_date_create DESC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 2) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_date > '$date_now' ORDER BY event_date ASC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 3) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_date > '$date_now' ORDER BY event_likes DESC, event_date ASC LIMIT 4";
            }
            else if($_SESSION['event_sort'] == 4) {
                $sql = "SELECT * FROM events WHERE event_userid != '$id' AND event_date > '$date_now' ORDER BY event_going DESC, event_date ASC LIMIT 4";
            }
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                
                // Get the userName 
                $userID = $row['event_userid'];
                $sql_user = "SELECT * FROM users WHERE user_id=?";
                $stmt_user = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt_user, $sql_user)) {
                    $userName = "undefined";
                    $user_distinciton = "leaf";
                    $user_idphoto = 1;
                }
                else {
                    mysqli_stmt_bind_param($stmt_user, "i", $userID);
                    mysqli_stmt_execute($stmt_user);
                    $result_user = mysqli_stmt_get_result($stmt_user);
                    if ($row_user = mysqli_fetch_assoc($result_user)) {
                        $userName = $row_user['user_uid'];
                        $user_distinciton = $row_user['user_destinction'];
                        $user_idphoto = $row_user['user_profile'];
                    }
                    else {
                        $userName = "undefined";
                        $user_distinciton = "leaf";
                        $user_idphoto = 1;
                    }
                }
                
                // Get the like and going
                $sql_like = "SELECT * FROM evlikes WHERE user_id=? AND event_id=?";
                $stmt_like = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt_like, $sql_like)) {
                    $like_state = 0;
                    $going_state = 0;
                }
                else {
                    mysqli_stmt_bind_param($stmt_like, "ii", $id, $row['event_id']);
                    mysqli_stmt_execute($stmt_like);
                    $result_like = mysqli_stmt_get_result($stmt_like);
                    if ($row_like = mysqli_fetch_assoc($result_like)) {
                        $like_state = $row_like['heart_state'];
                        $going_state = $row_like['going_state'];
                    }
                    else {
                        $like_state = 0;
                        $going_state = 0;
                    }
                }

                echo '
                <!-- THE POST BOX -->
                <div id="post-box">
                    
                    <!-- THE CONTENT BOX -->
                    <div id="content-box">

                        <div id="top-bar">
                            <img style="border-radius:50%;" src="images/profile_pic'.$user_idphoto.'.png" alt="images/logo.png" id="profile-image">
                        
                            <div id="user-info">
                                <h1 id="username">'.$userName.'</h1>
                                <h2 id="distinction">@'.$user_distinciton.'</h2>
                            </div>

                            <div id="date-time">
                                <p class="date" id="date'.$row['event_id'].'"></p>
                                <p class="time" id="time'.$row['event_id'].'"></p>
                            </div>

                            <script>
                                function TransformWallEvent_datetime(date) {
                                    var newDate = new Date(date*1000);
            
                                    formatted_newDate1 = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                                    formatted_newDate2 = ("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2); 
                                    
                                    document.getElementById("date'.$row['event_id'].'").innerHTML = formatted_newDate1;
                                    document.getElementById("time'.$row['event_id'].'").innerHTML = formatted_newDate2;
                                }
                                TransformWallEvent_datetime('.strtotime($row['event_date']).');
                            </script>
                        </div>

                        <div id="center">
                            <div id="behind-image"></div>
                            <img src='.$row['event_image'].' alt="images/event.jpg" id="event-image">
                            
                            <div class="choose-info" id="choose-info'.$row['event_id'].'">
                                <div class="choose-description" id="choose-description'.$row['event_id'].'" onclick="chooseDescription('.$row['event_id'].')">
                                    <h1>DESCRIPTION</h1>
                                </div>
                                <div class="choose-details" id="choose-details'.$row['event_id'].'" onclick="chooseDetails('.$row['event_id'].')">
                                    <h1>DETAILS</h1>
                                </div>

                                <div class="box-underline-bar">
                                    <div class="underline-bar" id="underline-bar'.$row['event_id'].'"></div>
                                </div> 
                            </div>


                            <div class="center-info-text" id="center-info-text'.$row['event_id'].'">
                                <h1 id="event-title">'.$row['event_title'].'</h1>
                                <p id="event-description">'.$row['event_description'].'</p>
                            </div>

                            <div class="center-info-details" id="center-info-details'.$row['event_id'].'">
                                <div id="half-box-under"><h1>Want to know more?</h1></div>
                                <div id="details-text">
                                    <p> 
                                        '.$row['event_country'].', '.$row['event_state'].', '.$row['event_city'].' 
                                        <br>
                                        '.$row['event_location'].' 
                                    </p>
                                </div>

                                <div id="square-between"><img src="images/location.png"></div>
                            </div>

                        </div>'; 

                        echo '<div id="like-going">';
                        if ($like_state == 1) {
                            echo '
                            <div onclick="heartEvent('.$row['event_id'].')" class="heart" id="'.$row['event_id'].'heart">
                                <input id="toggle-heart" type="checkbox" checked/>
                                <label class="checkedheart" id="toggle-heart-label"><img src="images/red_heart.png"></label>
                                <div class="heart-counter" id="heart-counter'.$row['event_id'].'">'.number_format($row['event_likes'], 0, ".", ".").'</div>
                            </div>
                            ';
                        }
                        else {
                            echo '
                            <div onclick="heartEvent('.$row['event_id'].')" class="heart" id="'.$row['event_id'].'heart">
                                <input id="toggle-heart" type="checkbox"/>
                                <label class="uncheckedheart" id="toggle-heart-label"><img src="images/black_heart.png"></label>
                                <div class="heart-counter" id="heart-counter'.$row['event_id'].'">'.number_format($row['event_likes'], 0, ".", ".").'</div>
                            </div>
                            ';
                        }

                        if ($going_state == 1) {
                            echo '
                            <div onclick="goingEvent('.$row['event_id'].')" class="going" id="'.$row['event_id'].'going">
                                <input id="toggle-going" type="checkbox" checked/>
                                <label class="checkedgoing" id="toggle-going-label"><img src="images/yellow_going.png"></label>
                                <div class="going-counter" id="going-counter'.$row['event_id'].'">'.number_format($row['event_going'], 0, ".", ".").'</div>
                            </div>
                            ';
                        }
                        else {
                            echo '
                            <div onclick="goingEvent('.$row['event_id'].')" class="going" id="'.$row['event_id'].'going">
                                <input id="toggle-going" type="checkbox"/>
                                <label class="uncheckedgoing" id="toggle-going-label"><img src="images/black_going.png"></label>
                                <div class="going-counter" id="going-counter'.$row['event_id'].'">'.number_format($row['event_going'], 0, ".", ".").'</div>
                            </div>
                            ';
                        }
                        echo '</div>';
                        
                        echo '
                    </div>
                </div>';
            }
        }

    ?>

    <button id="moreEvents" onclick="showMore()">Show More</button>

</div>