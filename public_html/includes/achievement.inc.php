<?php 

include 'login_permission.inc.php';
date_default_timezone_set('UTC');

if (isset($_POST['createAchievement'])) {

    $id = $_SESSION['userId'];

    // Get the previous event_id 
    $sql = "SELECT * FROM achievements ORDER BY achiv_id DESC LIMIT 1";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../create.php?achievement-error=sqlerror");
        exit(); 
    }
    else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $prev_id = $row['achiv_id'];
        }
        else  $prev_id = 0;
    }
  

    $title = $_POST['title'];
    $description = $_POST['description'];

    // THE UTC DATE 
    $date = gmdate("Y-m-d H:i");

    if (empty($title) || empty($description)) {
        header("Location: ../create.php?achievement-error=fieldsrequired");
        exit(0);
    }
    else {
        $sql = "INSERT INTO achievements(achiv_userid, achiv_title, achiv_description, achiv_date_create, achiv_likes, achiv_oks) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../create.php?achievement-error=sqlerror");
            exit(); 
        }
        else {
            $likes = 0;
            $oks = 0;
            mysqli_stmt_bind_param($stmt, "isssii", $id, $title, $description, $date, $likes, $oks);
            mysqli_stmt_execute($stmt);
            
            header("Location: ../create.php");
            exit(); 
        }
    }

}
else {
    header("Location: ../index.php");
    exit(0);
}
