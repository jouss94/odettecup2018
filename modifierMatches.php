<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
if ($id == 0) { header('Location: index.php'); }

parse_str($_SERVER["QUERY_STRING"], $query);
$idProfil = $query['id'];

if ($id != $idProfil)
{
	header('Location: acceuil.php');
}
require_once 'config.php';
require_once 'functions.php';

$qry = "SELECT * FROM etat WHERE competition = $competition;";
$result = mysqli_query($con, $qry);
while ($row = mysqli_fetch_array($result )) 
{
	if ($row["attribut"] == "PRONOS") {
		$modifMatch = $row["value"];
	}
}

if ($modifMatch == 0) { header('Location: acceuil.php'); }

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier matches</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/formMatch.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>
		<script src="javascript/profil.js"></script>
		<script src="javascript/pronosForm.js"></script>
		<script src="javascript/jquery.validVal.min.js"></script>
		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
	</head>
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in blackougedefault">
				<div style="width:100%;padding-bottom: 30px;">
					<?php include("include/viewModifierMatch.php");?> 					
				</div>
			</div>
		</div>
	</body>
</html>