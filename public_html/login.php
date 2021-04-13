<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/login.css">
<script src="js/login.js"></script>
<?php include 'general.php'; include 'logout_permission.php'; ?>

<div id="center-login" class="center-login">

    <div onclick="activateLogin()" id="background-over-login"></div> 

    <div id="login-box" class="login-box"> 

        <h1>Let's help the Earth! Log In!</h1>

        <!-- LOGIN VIA GOOGLE -->
        <div id="internet-login" class="internet-login">
            <div id="fb-login" class="fb-login">
                <img src="images/facebook.png" alt="facebook">
                <h1>Log in with Facebook</h1>
            </div>

            <div id="google-login" class="google-login">
                <img src="images/google.png" alt="google">
                <h1>Log in with Google</h1>
            </div>
        </div>

        <div id="or-title-login" class="or-title-login">
            <span></span>
            <h2>OR</h2>
            <span></span>
        </div>

        <!-- THE FORM -->
        <?php 
            if(isset($_GET['new_error'])) {
                if($_GET['new_error'] == 'sqlerror') echo '<h2 id="error">Oops! Something went wrong. Please try again later!</h3>';
                else if($_GET['new_error'] == 'emptyfields') echo '<h2 id="error">You have to fill in all the fields!</h3>';
                else if($_GET['new_error'] == 'wrongpwd') echo '<h2 id="error">User and password do not match!</h3>';
                else if($_GET['new_error'] == 'nouser') echo '<h2 id="error">There is no user linked with this email!</h3>';
                else if($_GET['new_error'] == 'inactivacc') echo '<h2 id="error">The account was not activated! If you did not recieved an activation mail, please contact us!</h3>';
                else if($_GET['new_error'] == 'userON') echo '<h2 id="error">There is already an user connected on this device!</h3>';

                echo '<script>activateLogin()</script>';
            }
        ?>

        <div id="form-login">
            <form autocomplete="off" action="includes/login.inc.php" method="POST">
                <h1>Email (case-sensitive)</h1>
                <input type="text" name="mail" placeholder="Email (case-sensitive)">

                <h1>Password</h1>
                <input type="password" name="pwd" placeholder="Password">
                
                <p>Welcome back! Log yourself in and let's do something positive for our Earthy! BE EARTHY!</p>
                <button name="login" type="submit">Login</button>
            </form>
        </div>
        

        <!-- LOGIN LINK-->
        <div id="login-link" class="login-link">
            <a onclick="activateSignup()">Don’t have an Earthy account? <span>Sign up.</span></a>
        </div>

    </div>
</div>