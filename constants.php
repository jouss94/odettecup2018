<?php
$isProd = false;

$host = $isProd ? 'sql-server.k8s-hbpc1299': 'odettecup.database.windows.net,1433';
$dbname = $isProd ? 'euro2021' : 'qatar2022';
$user= $isProd ? 'jousseau2022' : 'jousseau2022';
$pass = $isProd ? 'RootRoot!' : 'RootRoot!';
?>