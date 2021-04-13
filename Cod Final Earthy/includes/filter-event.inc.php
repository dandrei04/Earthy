<?php 
    include 'login_permission.inc.php';
    if (isset($_SESSION['userId']) && isset($_POST['Search'])) {
        $_SESSION['event_sort'] = $_POST['order'];

        if (empty($_POST['country'])) $_SESSION['country'] = 0;
        else $_SESSION['country'] = $_POST['country'];

        if (empty($_POST['state'])) $_SESSION['state'] = 0;
        else $_SESSION['state'] = $_POST['state'];

        if (empty($_POST['city'])) $_SESSION['city'] = 0;
        else $_SESSION['city'] = $_POST['city'];

        header("Location: ../home.php");
    } 
    else {
        header("Location: ../home.php");
    }

?>