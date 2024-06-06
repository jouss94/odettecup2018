<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }
$showBonus = 0;
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
	</head>
	
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'></div>

		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>

		<div class="padding20">
			<div class="loginform-in" style="background:none">
				<div style="width:100%;padding-bottom: 20px">
				
					<?php include("include/updateProfil.php");?>
					<div class="allAcceuil">

					<!-- Affichage Bonus x4 -->
					<?php if ($showBonus == 1) : ?>
					<table class="tableAcceuil">
						<tr >
							<td>
								<div class="tableAcceuilResultat">
									<!-- <div class="tableAcceuilResultat-"></div> -->

									<div class="small-card-event bonus-card-event bonus-card-event-small-padding mdl-card mdl-shadow--2dp">

										<div class="mdl-card__title mdl-card--expand">
											<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
												<?php include("include/viewTotalBut.php");?>
											</div>
										</div>
										<div class="mdl-card__actions mdl-card--border">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												Total buts
											</a>
										</div>
									</div>
									<div class="small-card-event bonus-card-event bonus-card-event-small-padding mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
												<?php include("include/viewFairplay.php");?>
											</div>
										</div>
										<div class="mdl-card__actions mdl-card--border">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												Fairplay
											</a>
										</div>
									</div>
									<div class="small-card-event bonus-card-event mdl-card bonus-card-event-small-padding mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
												<?php include("include/viewPenalty.php");?>
											</div>
										</div>
										<div class="mdl-card__actions mdl-card--border">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												Penalty
											</a>
										</div>
									</div>
									<div class="small-card-event bonus-card-event bonus-card-event-small-padding mdl-card mdl-shadow--2dp">
										<div class="mdl-card__title mdl-card--expand">
											<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
												<?php include("include/viewButEDF.php");?>
											</div>
										</div>
										<div class="mdl-card__actions mdl-card--border">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" >
												But EDF
											</a>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<?php endif; ?>

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

					<!-- Page Bonus -->
					<table class="tableAcceuil">
						<tr>
							<td>
								<div class="tableAcceuilBas">
										<div class="statistics-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<span class="TitreTableauBas">
												<!-- ⚠️🚨 Nouvelle page - Bonus 🚨⚠️ -->
												🚨 Tous les bonus sur une seule page
												</span>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="bonus.php" >
												Bonus
												</a>
											</div>
										</div>
								</div>
							</td>
						</tr>
					</table>
					<?php endif; ?>

					<table class="tableAcceuil">
						<tr >
							<td>
								<div class="tableAcceuilResultat">
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
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<table class="tableAcceuil">
						<tr>
							<td>
								<div class="tableAcceuilBas">
										<div class="statistics-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<span class="TitreTableauBas">
												📅 Lien direct pour le calendrier
												</span>
												</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="calendrier.php" >
												
												Voir tous les matches													
												</a>
											</div>
										</div>
								</div>
							</td>
						</tr>
					</table>
					<table class="tableAcceuil">
						<tr>
							<td >
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
							</td>
						</tr>
					</table>
					<table class="tableAcceuil">
						<tr>
							<td>
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
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>