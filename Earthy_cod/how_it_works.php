<?php 
    // Activate the access to the page 
    define('included',TRUE);
?>

<?php include 'general.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="images/logo.png"/>

    <title>Earthy | Tutorial</title>
</head>
<body>  

    <div id="container"></div>

    <div id="images_tutorial">
            <img src="images/tutorial.png">
    </div>
</body>
   
<style>
    body {

        margin: 2rem;
        align-items: center;
        display: flex;
        flex-direction: column; 
        justify-content: center;
    }

    body #container {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
        
        background: url("images/how_it_works_background.jpg");
        background-size: cover;
    }

    body #images_tutorial {
        border-radius: 15px;
        max-width: 800px;
        width: 100%;
        overflow: hidden;
        box-shadow: 30px 0 40px rgba(0,0,0,0.5), -30px 0 40px rgba(0,0,0,0.5);
    }

    body #images_tutorial img {
        width: 100%;
    }
</style>

</html>