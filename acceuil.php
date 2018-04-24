<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/icon-france.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>

		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
		<script src="./material_design/material.js"></script>
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
					<?php echo $pseudo ?> - <span class="titre">Accueil</span>
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

				<div style="width:100%;height:1030px;background:white">
						<?php include("include/updateProfil.php");?>

						<div class="allAcceuil">
						<table class="tableAcceuil">
							<tr >
								<td class="tableAcceuilResultat">
									<div class="demo-card-event mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<div class="cadreTableauAcceuil cadreTableauAcceuilBg">
												<?php include("include/viewHomeLastMatch.php");?>
											</div>
										</div>
										<div class="mdl-card__actions mdl-card--border">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="calendrier.php" >
												Derniers matches
											</a>
											<div class="mdl-layout-spacer"></div>
											<i class="material-icons">event</i>
										</div>
									</div>
									<div class="demo-card-event mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<div class="cadreTableauAcceuil cadreTableauAcceuilBg">
											<?php include("include/viewHomeNextMatch.php");?>
											</div>
										</div>
										<div class="mdl-card__actions mdl-card--border">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="calendrier.php" >
												Prochains matches
											</a>
											<div class="mdl-layout-spacer"></div>
											<i class="material-icons">event</i>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<table class="tableAcceuil">
							<tr>
								<td class="tableAcceuilClassement">
									<div class="classement-card-event mdl-card classement-general mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilClassement cadreTableauAcceuilBg">
													<?php include("include/viewHomeClassementGeneral.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="classement.php?ranking=General" >
													Général
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">poll</i>
											</div>
										</div>
										<div class="classement-card-event mdl-card classement-equipe mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilClassement cadreTableauAcceuilBg">
													<?php include("include/viewHomeClassementEquipe.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="classement.php?ranking=Equipe" >
													Equipe
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">poll</i>
											</div>
										</div>
										<div class="classement-card-event mdl-card classement-femme mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilClassement cadreTableauAcceuilBg">
													<?php include("include/viewHomeClassementFemme.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="classement.php?ranking=Femme" >
													Femme
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">poll</i>
											</div>
										</div>
										<div class="classement-card-event mdl-card classement-montagne mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilClassement cadreTableauAcceuilBg">
													<?php include("include/viewHomeClassementMontagne.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="classement.php?ranking=Montagne" >
													Montagne
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">poll</i>
											</div>
										</div>
								</td>
							</tr>
						</table>
						<table class="tableAcceuil">
							<tr>
								<td class="tableAcceuilBas">
										<div class="information-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<span class="TitreTableauBas">
													Liste des Joueurs
												</span>
												</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="listeJoueur.php" >
													Voir la liste des joueurs
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">supervisor_account</i>
											</div>
										</div>
										<div class="information-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<span class="TitreTableauBas">
													Règlement
												</span>
												</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="reglement.php" >
													Voir le Règlement de la compétition
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">gavel</i>
											</div>
										</div>
								</td>
							</tr>
						</table>
						</div>
				</div>
			</div>
		</div>
</body>
</html>