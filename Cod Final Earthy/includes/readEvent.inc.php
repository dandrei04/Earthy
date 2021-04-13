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
                <div id="date-time">
                    <p id="date_readEvent"></p>
                    <p id="time_readEvent"></p>
                </div>
            </div>

            <script>
                function TransformReadEvent_datetime(date) {
                    var newDate = new Date(date*1000);

                    formatted_newDate1 = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                    formatted_newDate2 = ("0" + newDate.getHours()).slice(-2) + ":" + ("0" + newDate.getMinutes()).slice(-2); 
                    
                    document.getElementById("date_readEvent").innerHTML = formatted_newDate1;
                    document.getElementById("time_readEvent").innerHTML = formatted_newDate2;
                }
                TransformReadEvent_datetime('.strtotime($row['event_date']).');
            </script>

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