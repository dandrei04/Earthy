<?php
    include 'login_permission.inc.php';
    if (isset($_SESSION['userId']) && isset($_POST['change'])) {
        $_SESSION['wall'] = $_SESSION['wall'] * (-1);
        header("Location: ../home.php");
    }
?>