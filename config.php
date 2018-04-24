<?php
$host= 'mysql.hostinger.fr';
$host1= 'mysql.hostinger.fr';
$hostWamp= 'localhost';

$dbname= 'u849275804_01010';
$dbname1= 'u469049543_02020';
$dbnameWamp= 'russia2018';

$user= 'u849275804_01010';
$user1= 'u469049543_02020';
$userWamp= 'root';

$pass= '01010db';
$pass1= '02020db';
$passWamp= '';

$con = mysqli_connect($hostWamp,$userWamp,$passWamp) or die(mysql_error());
// $con = mysqli_connect($host1,$user1,$pass1) or die(mysqli_error());

if (!$con) {
    echo "Unable to connect to DB: " . mysqli_error();
    exit;
}

if (!mysqli_select_db($con, $dbnameWamp)) {
    echo "Unable to select mydbname: " . mysqli_error();
    exit;
}

?>