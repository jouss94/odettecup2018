<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="icon" type="image/png" href="images/icon-france.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>

		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
		<script src="./material_design/material.js"></script>
	</head>
		
	<?php include("initReverse.php");?>

	<body>

		<?php include("background.php");?>
		
		<div class="padding20">
		<div class="loginform-in loginform-in-acceuil">
		<fieldset>	
			<img src="images/UEFA_Euro_2020_logo.png" style="width: 350px;margin: 20px;"/>
		
		<div class="err" id="add_err"></div>
		<div class="load" id="add_load"></div>
			<form action="./" method="post" style="margin: 10px;">

				<div class="inputLogin">
					<input type="text" size="30"  name="name" id="name" placeholder="Nom d'utilisateur" />
				</div class="inputLogin">
				<div>
					<input type="password" size="30"  name="word" id="word" placeholder="Mot de passe" />
				</div>
				<div class="inputLogin">
					<button id="login" name="login" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Connexion
					</button>
				</div>
				<div class="inputLogin">
					<button id="demand" name="demand" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Inscription
					</button>
				</div>


				<!--<table style="margin: auto;width: 500px;">
				<tr>
					<td style="width: 250px;">
					<label for="name">Nom d'utilisateur :</label>
					</td>
					<td style="width: 250px;">
					<input type="text" size="30"  name="name" id="name"  />
					</td>
				</tr>
				<tr>
					<td>
					<label for="name">Mot de passe :</label>
					</td>
					<td>
					<input type="password" size="30"  name="word" id="word"  />
					</td>
				</tr>
				<tr>
					<td>
					<label></label>
					</td>
					<td>
					<input type="submit" id="login" name="login" value="Connexion" class="loginbutton" >
					</td>
				</tr>
				<tr>
					<td>
					<label></label>
					</td>
					<td>
					<input type="submit" id="demand" name="demand" value="Faire une demande >" class="demandbutton" >
					</td>
				</tr>
				</table>-->
			</form>	
		</fieldset>
		</div>
		</div>
	</body>
</html>