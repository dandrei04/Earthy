<?php     
    include 'includes/dbh.inc.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if it is the same session 
    $sql_session = "SELECT * FROM users WHERE user_id=?";
    $stmt_session = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt_session, $sql_session)) {
        mysqli_stmt_bind_param($stmt_session, "i", $_SESSION['userId']);
        mysqli_stmt_execute($stmt_session);
        $result_session = mysqli_stmt_get_result($stmt_session);
        if ($row_session = mysqli_fetch_assoc($result_session)) {
            if ($row_session['user_active'] != $_SESSION['hash']) {
                session_unset();
                session_destroy();
            
                header("Location: index.php");
                exit(); 
            }
        }
        else {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
    }
    else {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if(!isset($_SESSION['userId'])) header("Location: index.php");
?>