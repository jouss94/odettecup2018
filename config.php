<?php

$isProd = false;

$host = $isProd ? 'sql-server.k8s-s8bubroc': 'localhost';
$dbname = $isProd ? 'euro2020' : 'euro2021';
$user= $isProd ? 'jousseau' : 'root';
$pass = $isProd ? 'admineuro2020' : '';

$con = mysqli_connect($host,$user,$pass) or die(mysqli_error());

if (!$con) {
    echo "Unable to connect to DB: " . mysqli_error();
    exit;
}

if (!mysqli_select_db($con, $dbname)) {
    echo "Unable to select mydbname: " . mysqli_error();
    exit;
}

?>

