<?php
$isProd = false;

$host = $isProd ? 'sql-server.k8s-s8bubroc': 'localhost';
$dbname = $isProd ? 'euro2020' : 'euro2021';
$user= $isProd ? 'jousseau' : 'root';
$pass = $isProd ? 'admineuro2020' : '';
?>