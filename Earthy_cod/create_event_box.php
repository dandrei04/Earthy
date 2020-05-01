<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/create_event_box.css">
<?php date_default_timezone_set('UTC'); ?>

<div id="event-box">
    <div id="over-background-event"></div>

    <div class="over-over-background">
        <h2>Here are your Events</h2>
        <p>Events require minimum 10 participants. Do something nice for the environment together. With more people come more points!</p>

        <div id="events-display">
            <?php 

                $sql = "SELECT * FROM events WHERE event_userid=?";
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
                        
                        $utc_date = $row['event_date'];
                        $utc_date = strtotime($utc_date);

                        echo '
                        <div id="event-box-display">
                            <div id="square-img">
                                <div id="circle-img">
                                    <img src="images/event.png" alt="event">
                                </div>
                            </div>
                        
                            <h1 id="open_inspectEvent" onclick="inspectEvent('.$row['event_id'].')">'.$row['event_title'].'</h1>
                            <h3 id="event_date_header'.$row['event_id'].'"></h3>

                            <form action="includes/deleteEvent.inc.php" method="POST">
                                <input type="hidden" name="id" value='.$row['event_id'].'>
                                <button id="event'.$row['event_id'].'" type="submit" name="delete"></button>
                            </form>

                            <button id="fake_delete" onclick="confirm_before_delete(&quot;event&quot; , '.$row['event_id'].')"></button>
                        </div>';

                        // Get the date_header 
                        echo '
                        <script>
                            function TransformEvent_time(date) {
                                var newDate = new Date(date*1000);
                                formatted_newDate = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                                document.getElementById("event_date_header'.$row['event_id'].'").innerHTML = formatted_newDate;
                            }
                            TransformEvent_time('.$utc_date.');
                        </script>';

                        while ($row = mysqli_fetch_assoc($result)) {

                            $utc_date = $row['event_date'];
                            $utc_date = strtotime($utc_date);
                            
                            echo '
                            <div id="event-box-display">
                                <div id="square-img">
                                    <div id="circle-img">
                                        <img src="images/event.png" alt="event">
                                    </div>
                                </div>
                                
                                <h1 id="open_inspectEvent" onclick="inspectEvent('.$row['event_id'].')">'.$row['event_title'].'</h1>
                                <h3 id="event_date_header'.$row['event_id'].'"></h3>
                            
                                <form action="includes/deleteEvent.inc.php" method="POST">
                                    <input type="hidden" name="id" value='.$row['event_id'].'>
                                    <button id="event'.$row['event_id'].'" type="submit" name="delete"></button>
                                </form>

                                <button id="fake_delete" onclick="confirm_before_delete(&quot;event&quot; , '.$row['event_id'].')"></button>
                            </div>';
                            
                            // Get the date_header 
                            echo '
                            <script>
                                function TransformEvent_time(date) {
                                    var newDate = new Date(date*1000);
                                    formatted_newDate = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth() + 1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2);
                                    document.getElementById("event_date_header'.$row['event_id'].'").innerHTML = formatted_newDate;
                                }
                                TransformEvent_time('.$utc_date.');
                            </script>';
                        }
                    }

                    else {
                        echo '
                        <div id="no-event">
                            <img src="images/no_event.png">
                        </div>
                        ';
                    }
                }
            ?>
        </div>

        <div id="add-button">
            <button id="openEvent">Create</button>
        </div>
        
    </div>  
</div>