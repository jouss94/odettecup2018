<?php
$isProd = false;

$host = $isProd ? 'sql-server.k8s-hbpc1299': 'localhost';
$dbname = $isProd ? 'euro2021' : 'qatar2022';
$user= $isProd ? 'jousseau2021' : 'root';
$pass = $isProd ? 'admineuro2020' : '';

?>