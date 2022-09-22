<?php

include("constants.php");

$con = mysqli_connect($host,$user,$pass) or die(mysqli_error());

if (!mysqli_select_db($con, $dbname)) 
{
    echo "Unable to select mydbname: " . mysqli_error();
    exit;
}

?> 

