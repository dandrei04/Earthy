<?php
if (isset($_POST['signup'])) {
    
    require 'dbh.inc.php';
    include 'logout_permission.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../index.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();        
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidmail&uid=".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../index.php?error=indvalidusername&&mail=".$email);
        exit();
    }
    else if (strlen($username) > 11) {
        header("Location: ../index.php?error=indvalidusername&&mail=".$email);
        exit();
    }
    else if ($password !== $passwordRepeat) {
        header("Location: ../index.php?error=pwdmatch&uid=".$username."&mail=".$email);
        exit(); 
    }
    else if (strlen($password) < 8) {
        header("Location: ../index.php?error=pwdshort&uid=".$username."&mail=".$email);
        exit(); 
    }
    else {

        $sql = "SELECT * FROM users WHERE user_uid=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror&uid=".$username."&mail=".$email);
            exit(); 
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../index.php?error=usertaken&mail=".$email);
                exit(); 
            }
            else {
                $sql = "SELECT * FROM users WHERE user_mail=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror&uid=".$username."&mail=".$email);
                    exit(); 
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
            
                    if($row > 0 && $row['user_activation'] == 1) {
                        header("Location: ../index.php?error=mailtaken&uid=".$username);
                        exit();
                    }
                    else {
                        
                        if($row > 0) {
                            $sql = "DELETE FROM users WHERE user_mail=?;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../index.php?error=sqlerror&uid=".$username."&mail=".$email);
                                exit(); 
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $email);
                                mysqli_stmt_execute($stmt);
                            }
                        }

                        $sql = "INSERT INTO users(user_uid, user_mail, user_pwd, user_activation, hash, user_profile, user_xp, user_lvl, user_events, user_destinction, user_active, user_pendingxp) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../index.php?error=sqlerror&uid=".$username."&mail=".$email);
                            exit(); 
                        }
                        else {
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            $activation = 0;
                            $userprofile = rand(1,5);
                            
                            $user_lvl = 0;
                            $user_xp = 0;
                            $user_events = 0;
                            $destinction = "leaf";
                            $user_active = "0";
                            $user_pendingxp = 0;

                            $hash = md5( rand(0,1000) );

                            $to = $email; // Send email to our user
                            $subject = 'Activate your account'; // Give the email a subject 
                            $message = '
                            Your account is almost ready! We are really happy because you are joining us! 

                            Activate the account by clicking on the following link:
                            https://earthy.website/includes/verify.inc.php?email='.$email.'&hash='.$hash.'
                            
                            All the best, team Earthy!
                            '; // Our message above including the link
                                                
                            $headers = 'From:Earthy' . "\r\n"; // Set from headers
                            mail($to, $subject, $message, $headers); // Send our email

                            mysqli_stmt_bind_param($stmt, "sssisiiiissi", $username, $email, $hashedPwd, $activation, $hash, $userprofile, $user_lvl, $user_xp, $user_events, $destinction, $user_active, $user_pendingxp);
                            mysqli_stmt_execute($stmt);
                            

                            // Get the ID of the user inserted 
                            $sql_getID = "SELECT * FROM users WHERE user_uid = ?";
                            $stmt_getID = mysqli_stmt_init($conn);
                            if (mysqli_stmt_prepare($stmt_getID, $sql_getID)) {
                                mysqli_stmt_bind_param($stmt_getID, "s", $username);
                                mysqli_stmt_execute($stmt_getID);
                                $result_getID = mysqli_stmt_get_result($stmt_getID);
                                if ($row_getID = mysqli_fetch_assoc($result_getID)) {
                                    $user_ID = $row_getID['user_id'];
                                }
                            }

                            // Insert the first badge into table 
                            $sql_badge = "INSERT INTO badges_user(user_id, badge_id) VALUES(?, ?)";
                            $stmt_badge = mysqli_stmt_init($conn);
                            if (mysqli_stmt_prepare($stmt_badge, $sql_badge)) { 
                                $badge_id = 1;

                                mysqli_stmt_bind_param($stmt_badge, "ii", $user_ID, $badge_id);
                                mysqli_stmt_execute($stmt_badge);
                            }
                            
                            header("Location: ../index.php?error=succes");
                            exit(); 
                        }
                    }
                } 
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}
else {
    header("Location: ../index.php");
    exit();
}
