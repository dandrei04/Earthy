<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/sidenavbar.css">
<script src="js/sidenavbar.js"></script>

<div class="sidenavbar" id="sidenavbar1">

    <div id="logo_sidenavbar">
        <img src="images/logo.png">
        <h1>EARTHY</h1>
    </div>

    <ul id="side_nav">
        <div id="image-link">
            <img src="images/home_green.png">
            <a href="home.php">Home</a>
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
            <img src="images/logout_green.png">
            <a href="">LogOut</a>
        </div>

        <div id="image-link">
            <img src="images/how_it_works_logo.png">
            <a href="how_it_works.php">Tutorial</a>
        </div>
        
    </ul>

    <a id="create-btn" href="create.php">CREATE</a>

</div>


<div class="sidenavbar" id="sidenavbar2">

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

    <a id="create-btn" href="create.php">CREATE</a>
    
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

    <div id="copyright">
        <h1>All rights Earthy@2019</h1>
    </div>
 
</div>


<div class="sidenavbar" id="sidenavbar3">

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

    <a id="create-btn" href="create.php">CREATE</a>

</div>