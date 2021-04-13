<?php 

if (isset($_POST['login'])) {

    require 'dbh.inc.php';
    include 'logout_permission.inc.php';

    $mailuid = $_POST['mail'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?new_error=emptyfields");    
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE user_mail=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?new_error=sqlerror");
            exit(); 
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['user_pwd']);
                if ($pwdCheck == false) {
                    header("Location: ../index.php?new_error=wrongpwd");
                    exit();
                }
                else if ($pwdCheck == true) {
                    if ($row['user_activation']) {
                        session_start();
                        if (isset($_SESSION['userId'])) {
                            header("Location: ../index.php?new_error=userON");
                            exit(); 
                        }
                        else {
                            $session_id = md5( rand(0,1000) );
                            $_SESSION['hash'] = $session_id;

                            $_SESSION['userId'] = $row['user_id'];
                            $_SESSION['wall'] = 1;

                            $_SESSION['event_sort'] = 1;
                            $_SESSION['country'] = '0';
                            $_SESSION['state'] = '0';
                            $_SESSION['city'] = '0' ;

                            $_SESSION['achiv_sort'] = 1;   
                            
                            $_SESSION['create_page'] = 0;
                            $_SESSION['home_page'] = 0;
                            $_SESSION['profile_page'] = 0;

                            // Update the table - make the user active 
                            $sql_active = "UPDATE users SET user_active = '$session_id' WHERE user_id = ?";
                            $stmt_active =  mysqli_stmt_init($conn);

                            if (mysqli_stmt_prepare($stmt_active, $sql_active)) {
                                mysqli_stmt_bind_param($stmt_active, "i", $row['user_id']);
                                mysqli_stmt_execute($stmt_active);
                                

                                /// Add the pending xp
                                $score_add = $row['user_pendingxp']; 
                                                       
                                if ($score_add > 0) {

                                    $actual_score = $row['user_xp'];
                                    $new_score = min($actual_score + $score_add, 1798053548);
                                    
                                    $actual_level = $row['user_lvl'];
                                    
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

                                    // UPDATE THE SCORE FOR OUR USER 
                                    $sql_update = "UPDATE users SET user_xp = $new_score WHERE user_id = ?";
                                    $stmt_update =  mysqli_stmt_init($conn);
                                    if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                                        mysqli_stmt_bind_param($stmt_update, "i", $row['user_id']);
                                        mysqli_stmt_execute($stmt_update);
                                    }

                                    // UPDATE THE LEVEL FOR OUR USER 
                                    $sql_update = "UPDATE users SET user_lvl = $level WHERE user_id = ?";
                                    $stmt_update =  mysqli_stmt_init($conn);
                                    if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                                        mysqli_stmt_bind_param($stmt_update, "i", $row['user_id']);
                                        mysqli_stmt_execute($stmt_update);
                                    }   

                                    // UPDATE THE PENDING SCORE 
                                    $sql_update = "UPDATE users SET user_pendingxp = 0 WHERE user_id = ?";
                                    $stmt_update =  mysqli_stmt_init($conn);
                                    if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
                                        mysqli_stmt_bind_param($stmt_update, "i", $row['user_id']);
                                        mysqli_stmt_execute($stmt_update);
                                    }
                                    
                                    // initialize the array 
                                    $url_array = array();
                                    for ($i = 1; $i <= 10; $i++) {
                                        array_push($url_array, 0);
                                    }

                                    // For the level part 
                                    for ($i = $actual_level + 1; $i <= $level; $i++) {
                                        if ($i == 10) $url_array[4] = 1;
                                        if ($i == 15) $url_array[5] = 1;
                                        if ($i == 35) $url_array[6] = 1;
                                        if ($i == 60) $url_array[7] = 1;
                                    }
                                    
                                    // Add the levels 
                                    for ($i = $actual_level + 1; $i <= $level; $i++) {
                                        array_push($url_array, $i);
                                    }

                                    // Redirect to see the rewards 
                                    header("Location: ../create.php?levels_passed=".$dif_level."&".http_build_query($url_array)."");
                                    exit(0);
                                }
                                else {
                                    header("Location: ../home.php");
                                    exit();
                                } 
                            }
                            else {
                                header("Location: ../index.php?new_error=sqlerror");
                                exit(); 
                            }
                        }  
                    }
                    else {
                        header("Location: ../index.php?new_error=inactivacc");
                        exit();
                    }
                }
                else {
                    header("Location: ../index.php?new_error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?new_error=nouser");
                exit();
            }

        }
    }
}
else {
    header("Location: ../index.php");
    exit();
}

?>
