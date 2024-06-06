<?php
ob_start();
session_start();

include('config.php');
include('functions.php');

$postData = $_POST;

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

// Validation du formulaire

if (isset($postData['name']) && isset($postData['password'])) 
{
	$name = sanitize_string($_POST['name'], $con);
	$password = sanitize_string($_POST['password'], $con);

	$qry = "SELECT id_joueur, surnom, competition FROM joueurs WHERE surnom='".$name."' AND password='".$password."';";
	$res = mysqli_query($con, $qry);
	$num_row = mysqli_num_rows($res);
	$row = mysqli_fetch_assoc($res);

	if( $num_row == 1 ) 
	{
		// echo "OK";
		$_SESSION['id'] = $row['id_joueur'];
		$_SESSION['pseudo'] = $row['surnom'];
		$_SESSION['competition'] = $row['competition'];
	}

	if (!isset($_SESSION['id'])) {
		// echo "NOOO";

		$_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf("Mauvais nom d'utilisateur ou mot de passe.");
		header("Location: index.php");
	} else {
		// echo "YES";
		header("Location: acceuil.php");
	}
} else {
	echo '2';
	header("Location:index.php");
}


exit();

?>
