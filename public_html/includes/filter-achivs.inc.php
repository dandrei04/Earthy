<?php 
    include 'login_permission.inc.php';
    if (isset($_SESSION['userId']) && isset($_POST['Search'])) {
        $_SESSION['achiv_sort'] = $_POST['order'];
        header("Location: ../home.php");
    } 
    else {
        header("Location: ../home.php");
    }

?>