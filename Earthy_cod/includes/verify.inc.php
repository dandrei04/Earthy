<?php

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    require 'dbh.inc.php';
    include 'logout_permission.inc.php';

    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable

    $sql = "SELECT * FROM users WHERE user_mail=? AND hash=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../mailConfirmation.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $hash);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        $id = $row['user_id'];

        if($row > 0) {
            $sql = "UPDATE users SET user_activation=1 WHERE user_id=?;";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../mailConfirmation.php?error=sqlerror");
                exit();
            }
            
            else {
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                header("Location: ../mailConfirmation.php?error=succes");
            }
        }
        else {
            header("Location: ../mailConfirmation.php?error=invalidlink");
        }
    } 

    mysqli_stmt_close($stmt);
    myslqi_close($conn);
}
else{
    header("Location: ../index.php");
}
?>