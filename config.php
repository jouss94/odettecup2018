<?php
$host= 'cl1-sql20';
$host1= 'mysql.hostinger.fr';
$hostWamp= 'localhost';

$dbname= 'xcx58271';
$dbname1= 'u469049543_02020';
$dbnameWamp= 'russia2018';

$user= 'xcx58271';
$user1= 'u469049543_02020';
$userWamp= 'root';

$pass= 'xmJDHUBSMPQD';
$pass1= '02020db';
$passWamp= '';

// $con = mysqli_connect($host,$user,$pass) or die(mysqli_error());
$con = mysqli_connect($hostWamp,$userWamp,$passWamp) or die(mysqli_error());

if (!$con) {
    echo "Unable to connect to DB: " . mysqli_error();
    exit;
}

if (!mysqli_select_db($con, $dbnameWamp)) {
    echo "Unable to select mydbname: " . mysqli_error();
    exit;
}

?>

