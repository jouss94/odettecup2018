<?php
//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

include("functions.php");
include("constants.php");

if ($id == 0) //On est dans la page de formulaire
{
	header('Location: index.php'); 
}

?>