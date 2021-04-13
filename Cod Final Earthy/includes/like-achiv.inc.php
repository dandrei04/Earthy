<?php   

    include 'login_permission_ajax.inc.php';
    date_default_timezone_set('UTC'); 

    if (isset($_POST['state']) && isset($_SESSION['userId'])) {

        $state = $_POST['state'];
        $achiv_id = $_POST['achiv_id'];
        $user_id = $_SESSION['userId'];


        // Check if the achiv still exists

        $sql_check = "SELECT * FROM achievements WHERE achiv_id=?";
        $stmt_check = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt_check, $sql_check)) {
            mysqli_stmt_bind_param($stmt_check, "i", $achiv_id);
            mysqli_stmt_execute($stmt_check);
            $result_check = mysqli_stmt_get_result($stmt_check);
            if (!($row_check = mysqli_fetch_assoc($result_check))) {
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


        // Change the heart_state 
        if ($state == -1) {

            // I can delete the row in the table 
            $sql_delete = "DELETE FROM achlikes WHERE user_id=? AND achiv_id=?";
            $stmt_delete = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
                mysqli_stmt_bind_param($stmt_delete, "ii", $user_id, $achiv_id);
                mysqli_stmt_execute($stmt_delete);
            }
        }
        else {
            // See if there is already a row created 
            $sql_exist = "SELECT * FROM achlikes WHERE user_id=? AND achiv_id=?";
            $stmt_exist = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_exist, $sql_exist)) {
                mysqli_stmt_bind_param($stmt_exist, "ii", $user_id, $achiv_id);
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
                $sql_update = "UPDATE achlikes SET heart_state=1 WHERE user_id=? AND achiv_id=?";
                $stmt_update = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                    mysqli_stmt_bind_param($stmt_update, "ii", $user_id, $achiv_id);
                    mysqli_stmt_execute($stmt_update);
                }
            }
            else {// I have to insert

                // Get the last id 
                $sql_id = "SELECT * FROM achlikes ORDER BY like_id DESC LIMIT 1";
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
                
                $sql_insert = "INSERT INTO achlikes(like_id, achiv_id, user_id, heart_state) VALUES(?, ?, ?, ?)";
                $stmt_insert = mysqli_stmt_init($conn);
             
                if (mysqli_stmt_prepare($stmt_insert, $sql_insert)) {
                    $heart_state = 1;
                    mysqli_stmt_bind_param($stmt_insert, "iiii", $lastID, $achiv_id, $user_id, $heart_state);
                    mysqli_stmt_execute($stmt_insert);
                }
            }  
        }

        // Change the achiv_likes
        $sql_update = "UPDATE achievements SET achiv_likes=achiv_likes+$state WHERE achiv_id=?";
        $stmt_update = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "i", $achiv_id);
            mysqli_stmt_execute($stmt_update);
        }

        
        // Output the likes numbers 
        $sql = "SELECT * FROM achievements WHERE achiv_id=?";
        $stmt =  mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $achiv_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                echo number_format($row['achiv_likes'], 0, ".", ".");
            }
            else echo '0';
        }
        else echo '0';
    }

?>