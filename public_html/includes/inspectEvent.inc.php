<?php 

include 'login_permission_ajax.inc.php';
date_default_timezone_set('UTC');

if (isset($_POST['event_id'])) {

    $event_id=$_POST['event_id'];

    $sql = "SELECT * FROM events WHERE event_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: create.php");
        exit(); 
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $event_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {

            echo '  
            <div id="behind-image"></div>
            <img src='.$row['event_image'].' alt="images/event.jpg" id="inspect_image">

            <div id="top-div">

                <form id="delete-event" action="includes/deleteEvent.inc.php" method="POST">
                    <input type="hidden" name="id" value='.$row['event_id'].'>
                    <button id="event'.$row['event_id'].'" type="submit" name="delete"></button>
                </form>
                <button id="fake_delete" onclick="confirm_before_delete(&quot;event&quot; , '.$row['event_id'].')"></button>

                <div id="date-time">
                    <p id="date_inspectEvent"></p>
                    <p id="time_inspectEvent"></p>
                </div>

                <script>
                    function TransformEvent_datetime(date) {
                        var newDate = new Date(date*1000);

                        formatted_newDate1 = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                        formatted_newDate2 = ("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2); 
                        
                        document.getElementById("date_inspectEvent").innerHTML = formatted_newDate1;
                        document.getElementById("time_inspectEvent").innerHTML = formatted_newDate2;
                    }
                    TransformEvent_datetime('.strtotime($row['event_date']).');
                </script>
            </div>

            <div class="choose-info">
                <div class="choose-description" id="choose-description" onclick="chooseDescription()">
                    <h1>DESCRIPTION</h1>
                </div>
                <div class="choose-details" id="choose-details" onclick="chooseDetails()">
                    <h1>DETAILS</h1>
                </div>

                <div class="box-underline-bar" id="box-underline-bar">
                    <div class="underline-bar" id="underline-bar"></div>
                </div> 
            </div>

            <div class="inspect-info-text" id="inspect-info-text">
                <h1 id="event-title">'.$row['event_title'].'</h1>
                <p id="event-description">'.$row['event_description'].'</p>
            </div>

            <div class="inspect-info-details" id="inspect-info-details">
                <div id="half-box-under"><h1>Forgot the location?</h1></div>
                <div id="details-text">
                    <p> 
                        '.$row['event_country'].', '.$row['event_state'].', '.$row['event_city'].' 
                        <br>
                        '.$row['event_location'].' 
                    </p>
                </div>

                <div id="square-between"><img src="images/location.png"></div>
            </div>';
            
            $time = strtotime($row['event_date']);
            $date_now = strtotime(gmdate("Y-m-d H:i"));
            if($date_now > $time) {
                
                echo '
                <div id="number_hearts_going">
                    <div id="heart-box"> 
                        <label><img src="images/red_heart.png"></label>
                        <h1>'.number_format($row['event_likes'], 0, ".", ".").'</h1>
                    </div>
                </div>
                ';

                echo '
                <div id="green-div"></div>

                <div id="participants-div">
                    <span id="triangle1"></span>
                    <h1>PARTICIPANTS</h1>
                    <span id="triangle2"></span>
                </div>
                ';  
                
                // LET'S GET THE PARTICIPANTS 
                $sql_participants = "SELECT * FROM evlikes WHERE event_id=? AND going_state = 1";
                $stmt_participants = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt_participants, $sql_participants)) {
                    header("Location: create.php");
                    exit(); 
                }
                else {
                    
                    // Here we find the number of days passed from the creation of the event until its end 
                    $time_start = strtotime($row['event_date_create']);
                    $time_fin = strtotime($row['event_date']); 
                    $datediff = $time_fin - $time_start; 
                    $datediff = intval($datediff / (60 * 60 * 24));

                    echo '<form id="collect-points" action="includes/collect_event.inc.php" method="POST">';
                    
                    mysqli_stmt_bind_param($stmt_participants, "i", $event_id);
                    mysqli_stmt_execute($stmt_participants);
                    $result_participants = mysqli_stmt_get_result($stmt_participants);

                    echo '<input type="hidden" name="eventID" value="'.$event_id.'">';  // to keep the eventID
                    echo '<input type="hidden" name="num_rows" value="'.mysqli_num_rows($result_participants).'">';  // 0 in case if there is no user 
                    echo '<input type="hidden" name="likes" value="'.$row['event_likes'].'">';  // for the score 
                    echo '<input type="hidden" name="days" value="'.$datediff.'">';  // for the score 

                    echo '
                    <label id="input-box">
                        <h1 id="all-header">ALL</h1>
                        <input type="checkbox" id="check-all" onclick="checkAll('.mysqli_num_rows($result_participants).')">
                        <span class="checkmark"></span>
                    </label>';

                    echo '<div id="inputs">';

                    if ($row_participants = mysqli_fetch_assoc($result_participants)) {
                     
                        $contor = 1;

                        $sql_user = "SELECT * FROM users WHERE user_id=?";
                        $stmt_user = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt_user, $sql_user)) {
                            echo '
                            <label id="input-box">
                                <h1>undifined</h1>
                                <input class="inputcheck" type="checkbox" name='.$contor.' value=0>
                                <span class="checkmark"></span>
                            </label>';
                        }
                        else {
                            mysqli_stmt_bind_param($stmt_user, "i", $row_participants['user_id']);
                            mysqli_stmt_execute($stmt_user);
                            $result_user = mysqli_stmt_get_result($stmt_user);
                            if ($row_user = mysqli_fetch_assoc($result_user)) {
                                echo '
                                <label id="input-box">
                                    <h1>'.$row_user['user_uid'].'</h1>
                                    <input class="inputcheck" type="checkbox" name='.$contor.' value='.$row_user['user_id'].'>
                                    <span class="checkmark"></span>
                                </label>';
                            }
                            else {
                                echo '
                                <label id="input-box">
                                    <h1>undifined</h1>
                                    <input class="inputcheck" type="checkbox" name='.$contor.' value=0>
                                    <span class="checkmark"></span>
                                </label>';
                            }
                        }

                        while ($row_participants = mysqli_fetch_assoc($result_participants)) {

                            $contor++;
                            
                            $sql_user = "SELECT * FROM users WHERE user_id=?";
                            $stmt_user = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt_user, $sql_user)) {
                                echo '
                                <label id="input-box">
                                    <h1>undifined</h1>
                                    <input class="inputcheck" type="checkbox" name='.$contor.' value=0>
                                    <span class="checkmark"></span>
                                </label>';
                            }
                            else {
                                mysqli_stmt_bind_param($stmt_user, "i", $row_participants['user_id']);
                                mysqli_stmt_execute($stmt_user);
                                $result_user = mysqli_stmt_get_result($stmt_user);
                                if ($row_user = mysqli_fetch_assoc($result_user)) {
                                    echo '
                                    <label id="input-box">
                                        <h1>'.$row_user['user_uid'].'</h1>
                                        <input class="inputcheck" type="checkbox" name='.$contor.' value='.$row_user['user_id'].'>
                                        <span class="checkmark"></span>
                                    </label>';
                                }
                                else {
                                    echo '
                                    <label id="input-box">
                                        <h1>undifined</h1>
                                        <input class="inputcheck" type="checkbox" name='.$contor.' value=0>
                                        <span class="checkmark"></span>
                                    </label>';
                                }
                            }
                        }
                    }   
                    echo '</div>';
                    echo '<button name="collect_event" type="submit">COLLECT POINTS</button>';
                    echo '</form>';

                    echo '<div id="fill-space"></div>';
                }
            }

            else {
                echo '
                <div id="number_hearts_going">
                    <div id="heart-box"> 
                        <label><img src="images/red_heart.png"></label>
                        <h1>'.number_format($row['event_likes'], 0, ".", ".").'</h1>
                    </div>

                    <div id="going-box"> 
                        <label><img src="images/yellow_going.png"></label>
                        <h1>'.number_format($row['event_going'], 0, ".", ".").'</h1>
                    </div>  
                </div>
                ';
            }
        }
    }
}