<?php 

include 'login_permission.inc.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM events WHERE event_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php");
        exit(); 
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $sql_delete = "DELETE FROM evlikes WHERE event_id=?";
        $stmt_delete = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt_delete, $sql_delete)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $id);
            mysqli_stmt_execute($stmt_delete);
        }

        header("Location: ../create.php");
        exit(); 
    }

}
else {
    header("Location: ../index.php");
}

?>