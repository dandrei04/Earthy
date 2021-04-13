<?php 
    // Activate the access to the page 
    define('included',TRUE);
?>
<?php include 'general.php'; include 'logout_permission.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="images/logo.png"/>
    <script src="js/index.js"></script>

    <title>Earthy - Make Earth Day Everyday</title>
</head>
<body>

    <!-- INDEX NAVBAR -->   
    <div id="index-navbar">
        <img src="images/logo.png" alt="logo_image">
        <h1>earthy</h1>
        
        <h2 id="curved-title">
            <span data-aos="fade-right" data-aos-duration="760" class="chara">Y</span>
            <span data-aos="fade-right" data-aos-duration="750" class="chara">H</span>
            <span data-aos="fade-right" data-aos-duration="740" class="chara">T</span>
            <span data-aos="fade-right" data-aos-duration="730" class="chara">R</span>
            <span data-aos="fade-right" data-aos-duration="720" class="chara">A</span>
            <span data-aos="fade-right" data-aos-duration="710" class="chara">E</span>
            <span data-aos="fade-right" data-aos-duration="700" class="chara">&nbsp;</span>
            <span data-aos="fade-right" data-aos-duration="690" class="chara">O</span>
            <span data-aos="fade-right" data-aos-duration="680" class="chara">T</span>
            <span data-aos="fade-right" data-aos-duration="670" class="chara">&nbsp;</span>
            <span data-aos="fade-right" data-aos-duration="660" class="chara">E</span>
            <span data-aos="fade-right" data-aos-duration="650" class="chara">M</span>
            <span data-aos="fade-right" data-aos-duration="640" class="chara">O</span>
            <span data-aos="fade-right" data-aos-duration="630" class="chara">C</span>
            <span data-aos="fade-right" data-aos-duration="620" class="chara">L</span>
            <span data-aos="fade-right" data-aos-duration="610" class="chara">E</span>
            <span data-aos="fade-right" data-aos-duration="600" class="chara">W</span>
        </h2>
      
        <div id="links">
            <a onclick="activateSignup()">Get Started!</a>
            <a id="about-us" href="how_it_works.php">How it works?</a>
        </div>
        <a onclick="activateLogin_responsive()" class="login-signup-link-button" id="login-link-button">Login</a>
        <a onclick="activateSignup_responsive()" class="login-signup-link-button" id="signup-link-button">SignUp</a>

    </div>

    <!-- CHANGE SIDE DIV / PLANET DIV  -->
    <div id="change-side">
        
        <div id="double-lines">
            <span></span>
            <span></span>
        </div>

        <div id="planet-container">
            <div id="planet"></div>
            <div id="horizontal-line"></div>
            <div id="vertical-line"></div>
        </div>

        <div id="double-lines">
            <span></span>
            <span></span>
        </div>

    </div>


    <!-- THE MAIN BODY -->
    <div id="login-signup"> 

        <!-- SIGNUP -->
        <?php include 'signup.php'; ?>

        <!-- LOGIN -->
        <?php include 'login.php'; ?>
        
        <!-- HANDLE THE ERRORS --> 
        <?php   
            if(isset($_GET['error'])) {
                echo '<script>activateSignup()</script>';
            }
            else if(isset($_GET['new_error'])) {
                echo '<script>activateLogin()</script>';
            }
            else {
                echo '<script>activateLogin()</script>';
            }
        ?>
    
    </div>  

</body>

<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


</html>