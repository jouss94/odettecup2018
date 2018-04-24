<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Liste des joueurs</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/icon-france.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/tabs.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/calendrier.js"></script>
		<script src="javascript/sorttable.js"></script>
		<script src="javascript/classement.js"></script>

	</head>
	
	<?php include("init.php");?>
	<?php include("background.php");?>

	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<table class="bandeau">
			<tr>
				<td id="bandeauAcceuil">
				</td>
				<td id="bandeauNom">
					<?php echo $pseudo ?> - <span class="titre">Classement</span>
				</td>
				<td id="bandeauProfil">
					Profil
				</td>
				<td id="bandeauDeconnect">
					Déconnexion
				</td>
			</tr>
		</table>
		<div class="padding20">
			<div class="loginform-in">


<!--
				<div class="bandeauDiv">
						<div class="inline" id="bandeauAcceuil">
							<img src="images/icon/home_24x24.png" class="imageAcceuil" />
						</div>
						<div class="inline" id="bandeauNom">
							Nom
						</div>
						<div class="inline" id="bandeauProfil">
							Odette Cup 2016
						</div>
						<div class="inline" id="bandeauDeconnect">
							<input type="button" id="deconnect" name="deconnect" value="Déconnexion" class="loginbutton" >
						</div>
				</div>-->

				<div style="width:100%;height:800px;">

						<?php include("include/viewClassement.php");?>

				</div>

			</div>
		</div>
</body>
</html>