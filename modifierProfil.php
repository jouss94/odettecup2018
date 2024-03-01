<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id == 0) { header('Location: index.php'); }

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier Profil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<?php include("include/style.php");?>
		<link rel="stylesheet" type="text/css" href="css/formProfil.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>
		<script src="javascript/profil.js"></script>
		<script src="javascript/profilForm.js"></script>
		<script src="javascript/jquery.validVal.min.js"></script>
	</head>	
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in">
				<div style="width:100%;height:1200px;display:flex">
					<?php include("include/viewModifierProfil.php");?> 					
				</div>
			</div>
		</div>
	</body>
</html>