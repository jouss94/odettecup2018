<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
		<link rel="icon" href="images/favicon.png" />
	</head>
		
	<!-- <?php include("initReverse.php");?> -->

	<body>	
		<div class="padding20">
			<div class="loginform-in loginform-in-acceuil">
				<fieldset>	
					<img src="images/Logo_UEFA_Euro_2024.png" style="width: 350px;margin: 20px;"/>
				
					<!-- <div class="err" id="add_err"></div>
					<div class="load" id="add_load"></div> -->
					
					<form action="submit_login.php" method="POST" method="post" style="margin: 10px;"> 
						<!-- si message d'erreur on l'affiche -->
						<?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
							<div class="err" id="add_err">
								<img src='images/alert.png' style='width: 40px;' />
								<div><?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
									unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?></div>
							</div>
						<?php endif; ?>

						<div class="inputLogin">
							<input type="text" size="30" name="name" id="name" placeholder="Nom d'utilisateur" />
						</div class="inputLogin">
						<div>
							<input type="password" size="30" name="password" id="word" placeholder="Mot de passe" />
						</div>
						<div class="inputLogin">
							<button type="submit" id="login" name="login" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
								Connexion
							</button>
						</div>
					</form>	
					<div class="inputLogin">
						<button id="demand" name="demand" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							Inscription
						</button>
					</div>


				</fieldset>
			</div>
		</div>
	</body>
</html>