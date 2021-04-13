<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<link rel="stylesheet" href="css/achievement.css">

<!-- CREATE EVENT/ACHIEVEMENT --> 
<div id="transparent-background"></div>

<div id="achievement">

    <div id="box-navbar">
        <h1>Write | Inspire</h1>
        <button id="cancel">Cancel</button>
    </div>
    
    <?php 
        if (isset($_GET['achievement-error'])) {
            if ($_GET['achievement-error'] == 'sqlerror') echo '<h2 id="error">Oops! There was an error. Please try again later.</h2>';
            else if ($_GET['achievement-error'] == 'toobig') echo '<h2 id="error">The image size is too big!</h2>';
            else if ($_GET['achievement-error'] == 'fileerror') echo '<h2 id="error">There was an error uploading the image!</h2>';
            else if ($_GET['achievement-error'] == 'wrongtype') echo '<h2 id="error">Only jpg/jpeg/png type images are supported!</h2>';
            else if ($_GET['achievement-error'] == 'fieldsrequired') echo '<h2 id="error">This event has incomplete information! Complete all the fields!</h2>';
        }
    ?>

    <form action="includes/achievement.inc.php" method="POST">
    
        <h2>Title</h2>
        <input maxlength="30" type="text" name="title">

        <h2>Description</h2>
        <textarea maxlength="7000" name="description"></textarea>

        <button type="submit" name="createAchievement" id="post">Post</button>
    </form>
</div>

<script src="js/achievement.js"></script>

<?php 
    if(isset($_GET['achievement-error'])) {
        echo '<script>
                achievement = document.getElementById("achievement");
                transparent_background = document.getElementById("transparent-background");
        
                achievement.style.top = "6rem";
                achievement.style.left = "50%";
                achievement.style.transform = "translateX(-50%)";
                achievement.style.opacity = "1";
        
                transparent_background.style.width = "100%";
                transparent_background.style.height = "100%";
                transparent_background.style.position = "fixed";  

                if (window.innerWidth <= 1000)choose_divAchivs();
        </script>';
    }
?>
