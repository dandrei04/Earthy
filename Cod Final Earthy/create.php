<?php 
    // Activate the access to the page 
    define('included',TRUE);
?>
<?php include 'general.php'; include 'login_permission.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/create.css">
    <link rel="shortcut icon" href="images/logo.png"/>
    <script src="js/create.js"></script>

    <title>Earthy - Make Earth Day Everyday</title>
</head>
<body>  

    <!-- THE NAVBAR --> 
    <?php include 'navbar.php' ?>

    <!-- THE ADD SECTION --> 
    <div id="add-div">  
        
        <div class="choose-div-top-bar" id="choose-div-top-bar1">
            <span class="ribbon" id="choose-div-events" onclick="choose_divEvents()">C<br>R<br>E<br>A<br>T<br>E</span>
        </div>

        <div class="choose-div-top-bar" id="choose-div-top-bar2">
            <span class="ribbon" id="choose-div-achivs" onclick="choose_divAchivs()">I<br>N<br>S<br>P<br>I<br>R<br>E</span>
        </div>

        <?php include 'create_event_box.php'; ?>
        <?php include 'create_achivs_box.php'; ?>
        
    </div>

    <!-- THE BADGES -->
    <?php include 'badges.php'; ?>

    <!-- THE HIDDEN EVENT/ACHIVS --> 
    <?php include 'event.php'; ?>
    <?php include 'achievement.php'; ?>

    <!-- THE INSPECT EVENT/ACHIVS --> 
    <?php include 'inspectEvent.php'; ?>
    <?php include 'inspectAchiv.php'; ?>

    <!-- HANDLE THE LEVEL UP + BADGES -->
    <?php 
        $ok = 0;
        for ($i = 1; $i <= 10; $i++) {
            if (isset($_GET[$i - 1]) && $_GET[$i - 1] != 0) $ok = 1;
        }
        
        if (isset($_GET['levels_passed']) && ($_GET['levels_passed'] != 0 || $ok != 0)) include 'event_up.php'; 
        else if (isset($_GET['levels_passed']) && $_GET['levels_passed'] == 0 && $ok == 0) 
            echo 
            '<form id="cleanURL" action="includes/cleanURL.inc.php"><button>YaY!</button></form>
            <script>document.getElementById("cleanURL").submit()</script>
            ';
    ?>

</body>
    <script src="js/appear.js"></script>
</html>