<?php 
    // Deny the direct access to file 
    if (!defined('included')) {
        echo "The page you are trying to access dosen't exist!";
        exit(0);
    }
?>

<link rel="stylesheet" href="css/top10.css">
<script src="js/top10.js"></script>

<div id="top10">
    <div id="first-header">
        <h1>OUR TOP 10</h1>
    </div>

    <ul id="top10_list">
        <?php 
            $nr = 1;
            
            $sql_top10 = "SELECT * FROM users ORDER BY user_xp DESC LIMIT 10";
            $result_top10 = mysqli_query($conn, $sql_top10);

            while ($row_top10 = mysqli_fetch_assoc($result_top10)) {
                echo '
                <div id="user_box">
                    <h2>'.$nr.'</h2>
                    <h1>'.$row_top10['user_uid'].'</h1>
                </div>
                ';
                $nr++;
            }

            for ($i = $nr + 1; $i <= 10; $i++) {
                echo '
                <div id="user_box">
                    <h2>'.$i.'</h2>
                    <h1>Undefined</h1>
                </div>
                ';
            }
        ?>
    </ul>
</div>
