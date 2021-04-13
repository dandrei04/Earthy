<?php   

    include 'login_permission_ajax.inc.php';
    date_default_timezone_set('UTC'); 

    if (isset($_POST['state']) && isset($_SESSION['userId'])) {

        $state = $_POST['state'];
        $event_id = $_POST['event_id'];
        $user_id = $_SESSION['userId'];

        // Check if the event still exists or is in the time span 
        $date_now = gmdate("Y-m-d H:i");

        $sql_check = "SELECT * FROM events WHERE event_id=?";
        $stmt_check = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt_check, $sql_check)) {
            mysqli_stmt_bind_param($stmt_check, "i", $event_id);
            mysqli_stmt_execute($stmt_check);
            $result_check = mysqli_stmt_get_result($stmt_check);
            if ($row_check = mysqli_fetch_assoc($result_check)) {
                if ($row_check['event_date'] < $date_now) {
                    echo '
                    <script>
                        document.location.reload(true);
                    </script>
                    ';
                    exit(0);
                }
            }
            else {
                echo '
                <script>
                    document.location.reload(true);
                </script>
                ';
                exit(0);
            }
        }
        else {
            echo '
            <script>
                document.location.reload(true);
            </script>
            ';
            exit(0);
        } 


        // Change the going_state 
        if ($state == -1) {
            // See if heart_state is 1 
            $sql_heart = "SELECT * FROM evlikes WHERE user_id=? AND event_id=?";
            $stmt_heart = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt_heart, $sql_heart)) {
                mysqli_stmt_bind_param($stmt_heart, "ii", $user_id, $event_id);
                mysqli_stmt_execute($stmt_heart);
                $result_heart = mysqli_stmt_get_result($stmt_heart);
                if ($row_heart = mysqli_fetch_assoc($result_heart)) {
                    $delete = $row_heart['heart_state'];
                }
                else {
                    $delete = 0;
                }
            }
            else {
                $delete = 1;
            } 
            

            if ($delete == 0) { // I can delete the row in the table, because both are 0;
                $sql_delete = "DELETE FROM evlikes WHERE user_id=? AND event_id=?";
                $stmt_delete = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
                    mysqli_stmt_bind_param($stmt_delete, "ii", $user_id, $event_id);
                    mysqli_stmt_execute($stmt_delete);
                }
            }
            else { // I have to update only the going_state
                $sql_update = "UPDATE evlikes SET going_state=0 WHERE user_id=? AND event_id=?";
                $stmt_update = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                    mysqli_stmt_bind_param($stmt_update, "ii", $user_id, $event_id);
                    mysqli_stmt_execute($stmt_update);
                }
            }
        }
        else {
            // See if there is already a row created 
            $sql_exist = "SELECT * FROM evlikes WHERE user_id=? AND event_id=?";
            $stmt_exist = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_exist, $sql_exist)) {
                mysqli_stmt_bind_param($stmt_exist, "ii", $user_id, $event_id);
                mysqli_stmt_execute($stmt_exist);
                $result_exist = mysqli_stmt_get_result($stmt_exist);
                if ($row_exist = mysqli_fetch_assoc($result_exist)) {
                    $exists = 1;
                }
                else $exists = 0;
            }
            else {
                $exists = 0;
            }   
            
            if ($exists == 1) { // I have to update
                $sql_update = "UPDATE evlikes SET going_state=1 WHERE user_id=? AND event_id=?";
                $stmt_update = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                    mysqli_stmt_bind_param($stmt_update, "ii", $user_id, $event_id);
                    mysqli_stmt_execute($stmt_update);
                }
            }
            else { // I have to insert

                // Get the last id 
                $sql_id = "SELECT * FROM evlikes ORDER BY like_id DESC LIMIT 1";
                $stmt_id = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt_id, $sql_id)) {
                    mysqli_stmt_execute($stmt_id);
                    $result_id = mysqli_stmt_get_result($stmt_id);
                    if ($row_id = mysqli_fetch_assoc($result_id)) {
                        $lastID = $row_id['like_id'] + 1;
                    }
                    else {
                        $lastID = 1;
                    }
                }
                else {
                    $lastID = 1;
                }
                
                $sql_insert = "INSERT INTO evlikes(like_id, event_id, user_id, heart_state, going_state) VALUES(?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_stmt_init($conn);
             
                if (mysqli_stmt_prepare($stmt_insert, $sql_insert)) {
                    $heart_state = 0;
                    $going_state = 1;
                    mysqli_stmt_bind_param($stmt_insert, "iiiii", $lastID, $event_id, $user_id, $heart_state, $going_state);
                    mysqli_stmt_execute($stmt_insert);
                }
            }  
        }

        // Change the event_likes
        $sql_update = "UPDATE events SET event_going=event_going+$state WHERE event_id=?";
        $stmt_update = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "i", $event_id);
            mysqli_stmt_execute($stmt_update);
        }

        // Output the likes numbers 
        $sql = "SELECT * FROM events WHERE event_id=?";
        $stmt =  mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $event_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                echo number_format($row['event_going'], 0, ".", ".");
            }
            else echo '0';
        }
        else echo '0';

    }

?>