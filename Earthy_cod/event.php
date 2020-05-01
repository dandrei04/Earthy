<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<link rel="stylesheet" href="css/event.css">

<!-- CREATE EVENT/ACHIEVEMENT --> 
<div id="transparent-background"></div>

<div id="event">

    <div id="box-navbar">
        <h1>Create Event</h1>
        <button id="cancel">Cancel</button>
    </div>

    <div id="image"></div>

    <?php 
        if (isset($_GET['event-error'])) {
            if ($_GET['event-error'] == 'sqlerror') echo '<h2 id="error">Oops! There was an error. Please try again later.</h2>';
            else if ($_GET['event-error'] == 'toobig') echo '<h2 id="error">The image size is too big!</h2>';
            else if ($_GET['event-error'] == 'fileerror') echo '<h2 id="error">There was an error uploading the image!</h2>';
            else if ($_GET['event-error'] == 'wrongtype') echo '<h2 id="error">Only jpg/jpeg/png type images are supported!</h2>';
            else if ($_GET['event-error'] == 'fieldsrequired') echo '<h2 id="error">This event has incomplete information! Fields with * are required!</h2>';
            else if ($_GET['event-error'] == 'wrongtime') echo '<h2 id="error">The event date has already passed!</h2>';
        }
    ?>

    <form action="includes/event.inc.php" method="POST" enctype="multipart/form-data">

        
        <input id="localTime_diff" type="hidden" name="localTime_diff" value=0>
        <script>
            // Find the difference between the local time and the current time 
            if (!(typeof GetTime_event == 'function')) {
                function GetTime_event() {
                    var d = new Date();
                    var n = d.getTimezoneOffset();
                    document.getElementById("localTime_diff").value = n;
                }
                GetTime_event();
            }
            else {
                GetTime_event();
            }
        </script>


        <input type="file" name="image" id="file" onchange="readURL(this);"/>
        <label for="file" onmouseover="imagehover()" onmouseout="imagenohover()"><img id="camera" src="images/camera.png" alt="camera"></label>

        <h2>Title*</h2>
        <input maxlength="30" type="text" name="title">

        <h2>Description</h2>
        <textarea maxlength="1000" name="description"></textarea>

        <div id="white-background">
            
            <div id="location">

                <h2>Location*</h2>

                <select name="country" class="countries" id="countryId">
                    <option value="">Select Country</option>
                </select>

                <select name="state" class="states order-alpha" id="stateId">
                    <option value="">Select State</option>
                </select>

                <select name="city" class="cities order-alpha" id="cityId">
                    <option value="">Select City</option>
                </select>
            </div>

            <h2>Location (more precise)</h2>
            <input type="text" name="location">

            <div id="time">

                <div id="input-time">
                    <h2>Date*</h2>
                    <input type="date" name="date">
                </div>

                <div id="input-time">
                    <h2>Time*</h2>
                    <div id="time-box">
                        <select name="hour" id="hour">
                            <option value="">hh</option>
                        </select>

                        <h2>:</h2>

                        <select name="minute" id="minute">
                            <option value="">mm</option>
                        </select>
                    </div>
                </div>

            </div>

            <button type="submit" name="createEvent" id="inside-post">Post</button>
            <button type="submit" name="createEvent" id="post_event">Post</button>
        </div>
      
    </form>
</div>

<script src="js/event.js"></script>

<?php 
    if(isset($_GET['event-error'])) {
        echo '<script>
                event = document.getElementById("event");
                transparent_background = document.getElementById("transparent-background");
        
                event.style.top = "2rem";
                event.style.left = "50%";
                event.style.transform = "translateX(-50%)";
                event.style.opacity = "1";
        
                transparent_background.style.width = "100%";
                transparent_background.style.height = "100%";
                transparent_background.style.position = "fixed"; 
                
                if (window.innerWidth <= 1000)choose_divEvents();
        </script>';
    }
?>
