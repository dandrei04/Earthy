<?php

$servername = "localhost";
$dBUsername = "id12076525_dandrei04";
$dBPassword = "ploiesti";
$dBName = "id12076525_earthy";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
