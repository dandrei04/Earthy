<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/navbar.css">
<script src="js/navbar.js"></script>

<div id="navbar">

    <ul id="navbar_ul">
        <a href="home.php">HOME <div id="underline"></div></a>
        <a href="create.php">CREATIONS <div id="underline"></div></a>
        <a href="create.php">BADGES <div id="underline"></div></a>
        <a href="profile.php">PROFILE <div id="underline"></div></a>
        <a href="how_it_works.php">TUTORIAL <div id="underline"></div></a>
    </ul>

    <div id="open-nav-container">
        <div id="open-nav">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <form action="includes/logout.inc.php" method="POST">
        <button type="logout" name="logout_btn" id="logout_btn">LogOut</button>
    </form>
    
</div>

<div id="mid-header">
    <h1>EARTHY</h1>
</div>


<div class="sidenavbar" id="sidenavbar">

    <div id="logo_sidenavbar">
        <img src="images/logo.png">
        <h1>EARTHY</h1>
    </div>

    <ul id="side_nav">
        <div id="image-link">
            <img src="images/home_green.png">
            <a href="home.php"> Home</a>
        </div>

        <div id="image-link">
            <img src="images/creations_green.png">
            <a href="create.php"> Creations</a>
        </div>

        <div id="image-link">
            <img src="images/badge_green.png" id="bigger-img">
            <a href="create.php">Badges</a>
        </div>
        
        <div id="image-link">
            <img src="images/profile_green.png" id="less-img">
            <a href="profile.php">Profile</a>
        </div>

        <div id="image-link">
            <img src="images/how_it_works_logo.png">
            <a href="how_it_works.php">Tutorial</a>
        </div>

        <form action="includes/logout.inc.php" method="POST">
            <img src="images/logout_green.png">
            <button type="logout" name="logout_btn" id="logout_btn">LogOut</button>
        </form>
    </ul>

</div>