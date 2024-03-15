<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }
$showMatch = 0;

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<?php include("include/style.php");?>
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>
		<script src="javascript/getDisplayDay.js"></script>
	</head>
	
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'></div>

		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>

		<div class="padding20">
			<div class="loginform-in-acceuil" style="background:none">
				<div style="width:100%;padding-bottom: 20px">
				
					<?php include("include/updateProfil.php");?>
					<div class="allAcceuil">

					<?php if ($showMatch == 1) : ?>
					<!-- Match en cours x2 -->
					<table class="tableAcceuil">
						<tr >
							<td>
								<div class="tableAcceuilResultat">
									<div class="onematch-card-event mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<?php include("include/viewHomeLastMatchSolo.php");?>
										</div>
									</div>
									<div class="onematch-card-event mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<?php include("include/viewHomeNextMatchSolo.php");?>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<?php endif; ?>

					
					<?php include("include/viewHomePlayoff.php");?>

					<div class="tableAcceuilResultat">
						<div class="demo-card-event mdl-card mdl-shadow--2dp">
							<div class="mdl-card__title mdl-card--expand">
								<div class="cadreTableauAcceuil cadreTableauAcceuilBg">
									<?php include("include/viewHomeLastMatchday.php");?>
								</div>
							</div>
							<div class="mdl-card__actions mdl-card--border">
								<a id="lastMatchButton" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" >
									Résultats
								</a>
							</div>
						</div>
						<div class="demo-card-event mdl-card mdl-shadow--2dp">
							<div class="mdl-card__title mdl-card--expand">
								<div class="cadreTableauAcceuil cadreTableauAcceuilBg">
									<?php include("include/viewHomeNextMatchday.php");?>
								</div>
							</div>
							<div class="mdl-card__actions mdl-card--border">
								<a id="nextMatchButton" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" >
									Pronostics
								</a>
							</div>
						</div>
					</div>

					<div class="tableAcceuilBas">
							<div class="statistics-card-event mdl-card mdl-shadow--2dp">
								<div class="mdl-card__title mdl-card--expand">
									<span class="TitreTableauBas">
									📅 Lien direct pour le calendrier
									</span>
									</div>
								<div class="mdl-card__actions mdl-card--border">
									<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="calendrier.php#item-<?php echo $GLOBALS['current_day'] ?>" >
									
									Voir tous les matches													
									</a>
								</div>
							</div>
					</div>

					<div class="tableAcceuilClassement"> 
						<div class="classement-card-event mdl-card classement-general mdl-shadow--2dp backgroundwhite">
							<div class="mdl-card__title mdl-card--expand">
								<div class="cadreTableauAcceuilClassement cadreTableauAcceuilBg">
									<?php include("include/viewHomeClassementGeneral.php");?>
								</div>
							</div>
							<div class="mdl-card__actions mdl-card--border">
								<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="classement.php?ranking=General" >
									Classement
								</a>
							</div>
						</div>
					</div>
					<div class="tableAcceuilBas">
						<div class="information-card-event mdl-card mdl-shadow--2dp">
							<div class="mdl-card__title mdl-card--expand">
								<span class="TitreTableauBas">
									Trombinoscope
								</span>
							</div>
							<div class="mdl-card__actions mdl-card--border">
								<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="trombi.php" >
									Voir la gueule des autres !
								</a>
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
							</div>
						</div>
						<div class="information-card-event mdl-card mdl-shadow--2dp">
							<div class="mdl-card__title mdl-card--expand">
								<span class="TitreTableauBas">
									Playoffs
								</span>
							</div>
							<div class="mdl-card__actions mdl-card--border">
								<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="playoffs.php" >
									Voir le tableau des playoffs
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>