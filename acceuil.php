<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

parse_str($_SERVER["QUERY_STRING"], $query);

if (isset($query['username'])) {
	$username = base64_decode($query['username']);

	include('config.php');
	
	$qry = "SELECT id_joueur, surnom FROM joueurs WHERE surnom='".$username."';";
	$res = mysqli_query($con, $qry);
	$row = mysqli_fetch_assoc($res);
	
	$_SESSION['id'] = $row['id_joueur'];
	$_SESSION['pseudo'] = $row['surnom'];
	$id = $row['id_joueur'];
	$pseudo = $row['surnom'];
}

if ($id == 0) { header('Location: index.php'); }

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style-v4.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>

		
		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style-v2.css">
		<link rel="stylesheet" href="./material_design/font.css">
	</head>
	
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'></div>

		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>

		<div class="padding20">
			<div class="loginform-in">
				<div style="width:100%;padding-bottom: 20px">
				
					<?php include("include/updateProfil.php");?>
					<div class="allAcceuil">

					<table class="tableAcceuil">
							<tr >
								<td>
									<div class="tableAcceuilResultat">
										<div class="small-card-event bonus-card-event bonus-card-event-small-padding mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
													<?php include("include/viewTotalBut.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
													Total but
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">filter_tilt_shift</i>
											</div>
										</div>
										<div class="small-card-event bonus-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
												<?php include("include/viewMinutage.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
													Minutages
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">watch_later</i>
											</div>
										</div>
										<div class="small-card-event bonus-card-event mdl-card bonus-card-event-small-padding mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
													<?php include("include/viewBestScorer.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
													Buteurs
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">group</i>
											</div>
										</div>
										<div class="small-card-event bonus-card-event bonus-card-event-small-padding mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
													<?php include("include/viewGains.php");?>
												</div>
											</div>
											<div class="mdl-card__actions mdl-card--border">
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" >
													Gains
												</a>
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">euro_symbol</i>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>

						<table class="tableAcceuil">
							<tr >
								<td>
									<div class="tableAcceuilResultat">
										<div class="onematch-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilOneMatch cadreTableauAcceuilBg">
													<?php include("include/viewHomeLastMatchSolo.php");?>
											</div>
										</div>
										<div class="onematch-card-event mdl-card mdl-shadow--2dp">
											<div class="mdl-card__title mdl-card--expand">
												<div class="cadreTableauAcceuilOneMatch cadreTableauAcceuilBg">
												<?php include("include/viewHomeNextMatchSolo.php");?>
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
													⚠️🚨 Nouvelle page - Bonus 🚨⚠️
													</span>
													</div>
												<div class="mdl-card__actions mdl-card--border">
													<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="bonus.php" >
														Voir tous les bonus sur une seule page
													</a>
													<div class="mdl-layout-spacer"></div>
													<i class="material-icons">filter_9_plus</i>
												</div>
											</div>
									</div>
								</td>
							</tr>
						</table>

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
													
													Voir tous les matches jour par jour avec le détail de chaque matches													
													</a>
													<div class="mdl-layout-spacer"></div>
													<i class="material-icons">event</i>
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
												<div class="mdl-layout-spacer"></div>
												<i class="material-icons">storage</i>
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