<?php

require_once 'config.php';
session_start();

require_once 'functions.php';

$uName = sanitize_string($_POST['name'], $con);
$pWord = sanitize_string($_POST['pwd'], $con);
// echo "SELECT id_joueur, surnom, oauth FROM joueurs WHERE surnom='".$uName."' AND password='".$pWord."';";
$qry = "SELECT id_joueur, surnom, oauth FROM joueurs WHERE surnom='".$uName."' AND password='".$pWord."';";
$res = mysqli_query($con, $qry);
$num_row = mysqli_num_rows($res);
$row=mysqli_fetch_assoc($res);
if( $num_row == 1 ) {
	echo 'true';
	$_SESSION['uName'] = $row['surnom'];
	$_SESSION['oId'] = $row['id_joueur'];
	$_SESSION['auth'] = $row['oauth'];

	$_SESSION['pseudo'] = $row['surnom'];
	$_SESSION['level'] = $row['oauth'];
	$_SESSION['id'] = $row['id_joueur'];
	}
else {
	echo 'false';
}

?>