<?php
//Attribution des variables de session
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

// $id=(isset($_COOKIE['id']))?(int) $_COOKIE['id']:0;
// $pseudo=(isset($_COOKIE['pseudo']))?$_COOKIE['pseudo']:'';

include("functions.php");
include("constants.php");

if ($id == 0) { header('Location: index.php'); }


?>