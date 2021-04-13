<?php 
    // Activate the access to the page 
    define('included',TRUE);
?>
<?php include 'general.php'; include 'login_permission.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="images/logo.png"/>
    <script src="js/home.js"></script>

    <title>Earthy - Make Earth Day Everyday</title>
</head>
<body>

    <!-- THE SIDE NAVBAR OF THE MAIN PAGE -->
    <?php include 'sidenavbar.php' ?>

    <!-- THE BODY -->
    <div id="body">

        <div id="top_body"> 

            <?php 
                echo ' <div id="top-box-top-bar">';

                if ($_SESSION['wall'] == 1) {
                    echo '
                    <h1>Events</h1>

                    <form action="includes/change.inc.php" method="POST" id="change">
                        <button name="change"><img src="images/change.png"></button>
                    </form>
                    ';
                }
                else {
                    echo '
                    <h1>Achivs & Ideas</h1>
                    <form action="includes/change.inc.php" method="POST" id="change">
                        <button name="change"><img src="images/change.png"></button>
                    </form>
                    ';
                }
                echo '</div>';
            ?>

            <?php 
                if ($_SESSION['wall'] == 1) include 'profilefilterwall.php'; 
                else include 'profilefilterwallach.php';
            ?>

        </div>   

        <?php 
            if ($_SESSION['wall'] == 1) include 'eventwall.php';
            else include 'achivswall.php';
        ?>
    </div>

    <div id="random-width-div"></div>

    <!-- TOP 10 DIV -->
    <?php include 'top10.php' ?>
                
    <!--
    <footer>
        <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
            <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="#6DC5A5" />
            <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="#68829E" />
        </svg>
    </footer>
            -->

</body>
    <script src="js/appear.js"></script>
    
</html>