<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Profil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>
		<script src="javascript/profil.js"></script>

		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
		
	</head>
	
	<?php include("init.php");?>
	
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in">



				<div style="width:100%;height:1200px;display:flex">
					<?php include("include/viewProfil.php");?>					
				</div>

			</div>
		</div>
</body>
</html>