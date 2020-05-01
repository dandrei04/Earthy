<?php 

include 'login_permission.inc.php';
date_default_timezone_set('UTC');

if (isset($_POST['createEvent'])) {

    $id = $_SESSION['userId'];

    // Get the previous event_id 
    $sql = "SELECT * FROM events ORDER BY event_id DESC LIMIT 1";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../create.php?event-error=sqlerror");
        exit(); 
    }
    else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $prev_id = $row['event_id'];
        }
        else  $prev_id = 0;
    }

    // THE Photo 

    $file = $_FILES['image']; 
    
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'png', 'jpeg');

    if (in_array($fileActualExt, $allowed) || empty($fileName)) {
        if ($fileError === 0 || empty($fileName)) {
            if ($fileSize < 5019345 || empty($fileName)) {
                
                if (!empty($fileName)) {
                    $prev_id++;
                    $fileNameNew = "event".$prev_id.".".$fileActualExt;
                    $fileDestination = 'event_uploads/'. $fileNameNew;
                    $fileDestination_new = '../event_uploads/'. $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination_new);
                }
                else {
                    $fileDestination = "images/event.jpg";
                }

                $title = $_POST['title'];
                $description = $_POST['description'];
                $country = $_POST['country'];
                $state = $_POST['state'];
                $city = $_POST['city'];
                $location = $_POST['location'];
                
                // HERE ARE THE LOCAL DATAS - but we have to put in the table the UTC 
                $date = $_POST['date']; 
                $hour = $_POST['hour'];
                $minute = $_POST['minute'];
                $diffTime = $_POST['localTime_diff'];                
                $hour = $hour + $diffTime/60;

                $time = strtotime($date); 
                $time = $time + $hour * 3600 + $minute * 60;
                $date = date("Y-m-d H:i", $time);

                // THE UTC DATE 
                $date_creation = gmdate("Y-m-d H:i");
                $time_creation = strtotime($date_creation);


                if (empty($title) || empty($country) || empty($state) || empty($city) || empty($date) || (empty($hour) && $hour != 0) || (empty($minute) && $minute != 0) ) {
                    header("Location: ../create.php?event-error=fieldsrequired");
                    exit(0);
                }
                else if($time_creation > $time) {
                    header("Location: ../create.php?event-error=wrongtime");
                    exit(0);
                }
                else {
                    $sql = "INSERT INTO events(event_userid, event_title, event_description, event_country, event_state, event_city, event_location, event_date, event_date_create, event_hour, event_minute, event_likes, event_approved, event_going, event_oks, event_image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../create.php?event-error=sqlerror");
                        exit(); 
                    }
                    else {
                        $likes = 0;
                        $approved = 0;
                        $going = 0;
                        $oks = 0;
                        mysqli_stmt_bind_param($stmt, "issssssssiiiiiis", $id, $title, $description, $country, $state, $city, $location, $date, $date_creation, $hour, $minute, $likes, $approved, $going, $oks, $fileDestination);
                        mysqli_stmt_execute($stmt);
               
                        header("Location: ../create.php");
                        exit(); 
                    }
                }
            }
            else {
                header("Location: ../create.php?event-error=toobig");
                exit(0);
            }
        }
        else {
            header("Location: ../create.php?event-error=fileerror");
            exit(0);
        }
    }
    else {
        header("Location: ../create.php?event-error=wrongtype");
        exit(0);
    }
}
else {
    header("Location: ../index.php");
    exit(0);
}
