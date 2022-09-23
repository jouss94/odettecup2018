<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Demande</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/demande.js"></script>
		<link rel="stylesheet" type="text/css" href="css/formProfil.css">
		<script src="javascript/jquery.validVal.min.js"></script>
		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
	</head>

	<body>
		<div class="padding20">
			<div class="loginform-in">
				<img src="images/UEFA_Euro_2020_logo_4.png" style="width: 140px;margin: 10px;"/>
				<h3 style="margin-top: 0;color:#FFF">Formulaire d'inscription</h1>
				<div class="Retour">
					<button class="Retour  mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
						Retour
					</button>
				</div>

				<form action="addDemande.php" method="post">
					<table class="tableauPronosForm" style="margin: auto;margin-bottom: 20px;padding-bottom: 20px;padding-top: 20px;padding-left: 90px;padding-right: 90px;width: 830px;">
						<tr>
							<td style="width: 33%;text-align:right;">
								<label for="i1" style="padding-right: 35px;">Nom*</label>
							</td>
							<td>
								<input id="i1" name="required" type="text" value="" class="serverside-validation" size="24" />
								<span class="error" id="i1error1">Requis</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<label for="i2" style="padding-right: 35px;">Prénom*</label>
							</td>
							<td>
								<input id="i2" name="required_prenom" type="text" value="" class="serverside-validation" size="24" />
								<span class="error" id="i2error1">Requis</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<label for="i3" style="padding-right: 35px;">Surnom*</label>
								<div>
									<label for="i3" style="padding-right: 35px;font-weight: lighter;font-size: 12px;">Identifiant de connexion</label>					
								</div>
							</td>
							<td>
								<input id="i3" name="check-surnom" type="text" value="" class="serverside-validation" size="24" />
								<span class="error" id="i3error1">Requis</span>
								<span class="error size13" id="i3error2">Surnom déjà pris</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<label for="i4" style="padding-right: 35px;">E-mail*</label>
							</td>
							<td>
								<input id="i4" name="Email-check" type="text" value="" class="serverside-validation" size="24" />
								<span class="error" id="i4error1">Requis</span>
								<span class="error size13" id="i4error2">E-mail non conforme</span>
								<span class="error size13" id="i4error3">E-mail déjà utilisé</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<label for="i5" style="padding-right: 35px;">Téléphone*</label>
							</td>
							<td>
								<input id="i5" name="number" type="text" value="" class="serverside-validation" size="24" />
								<span class="error" id="i5error1">Requis</span>
								<span class="error size13" id="i5error2">Entrez un numéro</span>
								<span class="error size13" id="i5error3">Numéro non comforme</span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<label for="payement" style="padding-right: 35px;">Mode de payement</label>
								<div>
									<label for="payement" style="padding-right: 35px;font-weight: lighter;font-size: 12px;">Frais d'inscription : 20€</label>					
								</div>
							</td>
							<td>
								<select name="payement" id="payement" style="width:150px;">
									<option value="liquide" selected="selected">Espèce</option>
									<option value="cheque" >Chèque</option>
									<option  value="virement" >Virement</option>
								</select>
							</td>
						</tr>
		
						<tr>
							<td style="text-align:right;vertical-align: top;padding-top: 8px;">
								<label for="description" id="descriptionLabel" style="padding-right: 35px;">Description</label>
							</td>
							<td>
								<textarea name="description" id="description" style="resize:none" name="name" cols="30" rows="6" class="serverside-validation"></textarea>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
							</td>
							<td>
								<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									Valider
								</button>
								<button type="reset" value="Annuler" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="buttonValidationReset">
									Effacer
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>