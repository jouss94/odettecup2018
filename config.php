<?php

include("constants.php");

// $con = mysqli_connect($host,$user,$pass) or die(mysqli_error());

try {
    $conn = new PDO("sqlsrv:server = tcp:odettecup.database.windows.net,1433; Database = qatar2022", "jousseau2022", "RootRoot!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "jousseau2022", "pwd" => "RootRoot!", "Database" => "qatar2022", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:odettecup.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$con) {
    echo "Unable to connect to DB: " . mysqli_error();
    exit;
}

if (!mysqli_select_db($con, $dbname)) {
    echo "Unable to select mydbname: " . mysqli_error();
    exit;
}

?>

