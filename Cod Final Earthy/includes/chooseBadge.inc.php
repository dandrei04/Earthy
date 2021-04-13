<?php 
    include 'login_permission.inc.php';

    // UPDATE FOR OUR USER 
    if (isset($_POST['badge_distinction'])) {
        $distinction = $_POST['badge_distinction'];
        $sql_update = "UPDATE users SET user_destinction = '$distinction' WHERE user_id = ?";
        $stmt_update =  mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt_update, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "i", $_SESSION['userId']);
            mysqli_stmt_execute($stmt_update);
        }
    }
?>