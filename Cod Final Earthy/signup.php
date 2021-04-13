<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<script src="js/signup.js"></script>
<link rel="stylesheet" href="css/signup.css">

<!-- SIGNUP BOX --> 
<div id="center-signup" class="center-signup">

    <div onclick="activateSignup()" id="background-over-signup"></div> 

    <div id="signup-box" class="signup-box">
        <h1>Sign Up For Free</h1>
        <div id="internet-signup" class="internet-signup">
            <div id="fb-signup" class="fb-signup">
                <img src="images/facebook.png" alt="facebook">
                <h1>Sign up with Facebook</h1>
            </div>
            <div id="google-signup" class="google-signup">
                <img src="images/google.png" alt="google">
                <h1>Sign up with Google</h1>
            </div>
        </div>
        <div id="or-title-signup" class="or-title-signup">
            <span></span>
            <h2>OR</h2>
            <span></span>
        </div>
        <p>Username must be 1 to 11 characters, containing only letters a/A to z/Z, or numbers 0 to 9, and cannot include any inappropriate terms.</p>
        
        <?php 
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'sqlerror') echo '<h2 id="error">Oops! Something went wrong. Please try again later!</h2>';
                else if($_GET['error'] == 'emptyfields') echo '<h2 id="error">You have to fill in all the fields!</h2>';
                else if($_GET['error'] == 'invalidmail') echo '<h2 id="error">Please insert a valid email!</h2>';
                else if($_GET['error'] == 'indvalidusername') echo '<h2 id="error">Please insert a valid username (only a-z/A-z/0-9 characters are allowed)!</h2>';
                else if($_GET['error'] == 'pwdmatch') echo '<h2 id="error">The passwords do not match!</h2>';
                else if($_GET['error'] == 'pwdshort') echo '<h2 id="error">The password must be at least 8 characters in length!</h2>';
                else if($_GET['error'] == 'usertaken') echo '<h2 id="error">The user is already taken!</h2>';
                else if($_GET['error'] == 'mailtaken') echo '<h2 id="error">There is already an account linked with this email!</h2>';
                else if($_GET['error'] == 'succes') echo '<h2 id="succes">An email has been sent to you to activate your account!</h2>';
            }
        ?>
        <form onsubmit="return validateMyForm();" autocomplete="off" action="includes/signup.inc.php" method="POST">
            
            <?php 
                if (!isset($_GET['uid'])) echo '<input id="uid" type="text" name="uid" placeholder="Username">';
                else echo '<input id="uid" type="text" name="uid" placeholder="Username" value='.$_GET['uid'].'>';
            
                if(!isset($_GET['mail'])) echo '<input id="mail" type="text" name="mail" placeholder="Email">';
                else echo '<input id="mail" type="text" name="mail" placeholder="Email" value='.$_GET['mail'].'>';
            ?>

            <input id="pwd" type="password" name="pwd" placeholder="Password">
            <input id="pwd-repeat" type="password" name="pwd-repeat" placeholder="Confirm Password">
            <p>By clicking the button below, you are indicating that you have read and agree to the Terms of Service and Privacy Policy.</p>
            <button name="signup" type="submit">Sign Up</button>
        </form>
    </div>

</div>