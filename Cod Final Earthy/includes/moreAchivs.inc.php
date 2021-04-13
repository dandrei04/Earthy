<?php 

include 'login_permission_ajax.inc.php';
date_default_timezone_set('UTC');

if (isset($_POST['achivs'])) {
    $number_achivs = $_POST['achivs'];
    $id = $_SESSION['userId'];

    if($_SESSION['achiv_sort'] == 1) {
        $sql = "SELECT * FROM achievements WHERE achiv_userid != '$id' ORDER BY achiv_date_create DESC LIMIT $number_achivs";
    }
    else if($_SESSION['achiv_sort'] == 2) {
        $sql = "SELECT * FROM achievements WHERE achiv_userid != '$id' ORDER BY achiv_likes DESC LIMIT $number_achivs";
    }


    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            // Get the userName 
            $userID = $row['achiv_userid'];
            $sql_user = "SELECT * FROM users WHERE user_id=?";
            $stmt_user = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt_user, $sql_user)) {
                $userName = "undefined";
                $user_distinciton = "leaf";
                $user_idphoto = 1;
            }
            else {
                mysqli_stmt_bind_param($stmt_user, "i", $userID);
                mysqli_stmt_execute($stmt_user);
                $result_user = mysqli_stmt_get_result($stmt_user);
                if ($row_user = mysqli_fetch_assoc($result_user)) {
                    $userName = $row_user['user_uid'];
                    $user_distinciton = $row_user['user_destinction'];
                    $user_idphoto = $row_user['user_profile'];
                }
                else {
                    $userName = "undefined";
                    $user_distinciton = "leaf";
                    $user_idphoto = 1;
                }
            }
            
            // Get the like
            $sql_like = "SELECT * FROM achlikes WHERE user_id=? AND achiv_id=?";
            $stmt_like = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt_like, $sql_like)) {
                $like_state = 0;
            }
            else {
                mysqli_stmt_bind_param($stmt_like, "ii", $id, $row['achiv_id']);
                mysqli_stmt_execute($stmt_like);
                $result_like = mysqli_stmt_get_result($stmt_like);
                if ($row_like = mysqli_fetch_assoc($result_like)) {
                    $like_state = $row_like['heart_state'];
                }
                else {
                    $like_state = 0;
                }
            }
            
            // Make the ago time 
            if(function_exists("time_elapsed_string") == false) {
                function time_elapsed_string($datetime, $full = false) {
                    $now = new DateTime;
                    $ago = new DateTime($datetime);
                    $diff = $now->diff($ago);
                
                    $diff->w = floor($diff->d / 7);
                    $diff->d -= $diff->w * 7;
                
                    $string = array(
                        'y' => 'year',
                        'm' => 'month',
                        'w' => 'week',
                        'd' => 'day',
                        'h' => 'hour',
                        'i' => 'minute',
                    );
                    foreach ($string as $k => &$v) {
                        if ($diff->$k) {
                            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                        } else {
                            unset($string[$k]);
                        }
                    }
                
                    if (!$full) $string = array_slice($string, 0, 1);
                    return $string ? implode(', ', $string) . ' ago' : 'just now';
                }
            }
            $time_passed = time_elapsed_string($row['achiv_date_create']);

            echo '
            <!-- THE POST BOX -->
            <div id="post-box">
                
                <!-- THE CONTENT BOX -->
                <div id="content-box">

                    <div id="top-bar">
                        <img style="border-radius:50%;" src="images/profile_pic'.$user_idphoto.'.png" alt="images/logo.png" id="profile-image">
                        <div id="user-info">
                            <h1 id="username">'.$userName.'</h1>
                            <h2 id="distinction">@'.$user_distinciton.'</h2>
                        </div>

                        <div id="date-time">
                            <p id="date">'.$time_passed.'</p>
                        </div>
                    </div>
                    
                    <div id="center">
            
                        <p id="achiv-description">'.$row['achiv_description'].'</p>
                        <h1 id="achiv-title">'.$row['achiv_title'].'</h1>';
    
                        echo '<div id="like-going">';
                        if ($like_state == 1) {
                            echo '
                            <div onclick="heartAchiv('.$row['achiv_id'].')" class="heart" id="'.$row['achiv_id'].'heart">
                                <input id="toggle-heart" type="checkbox" checked/>
                                <label class="checkedheart" id="toggle-heart-label"><img src="images/red_heart.png"></label>
                                <div class="heart-counter" id="heart-counter'.$row['achiv_id'].'">'.number_format($row['achiv_likes'], 0, ".", ".").'</div>
                            </div>
                            ';
                        }
                        else {
                            echo '
                            <div onclick="heartAchiv('.$row['achiv_id'].')" class="heart" id="'.$row['achiv_id'].'heart">
                                <input id="toggle-heart" type="checkbox"/>
                                <label class="uncheckedheart" id="toggle-heart-label"><img src="images/black_heart.png"></label>
                                <div class="heart-counter" id="heart-counter'.$row['achiv_id'].'">'.number_format($row['achiv_likes'], 0, ".", ".").'</div>
                            </div>
                            ';
                        }
                        echo '</div>
                    </div>
                </div>
            </div>';
        }
    }

    echo '<button id="moreAchivs" onclick="showMore()">Show More</button>';
}