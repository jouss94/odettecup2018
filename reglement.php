<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Règlement</title>
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
		<script src="javascript/reglement.js"></script>
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
			<div class="loginform-in blackougedefault">
				<div style="padding: 1px 0;">
					<span class="listeJoueurTitre">Règlement</span>
					<span class="RetourSpan">
						<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
							Retour
						</button>
					</span>
					<div class="reglementDiv">
						<p>
							<h3>Règles sur chaque match</h3>
							<div class="sousTitre perfectTitre">Perfect</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouver le score exact du match.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 2-1 : + 7 points</span></li>
							</ul>
							<div class="sousTitre perfectCorrectPlus">Correct +</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >4 points</li>
								<li class="pointRegle regleDetail" >Trouver le vainqueur du match et le nombre de but de l'une des deux équipes.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 2-0 : + 4 points</span></li>
								<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 2-1 - Score 3-1 : + 4 points</span></div>
							</ul>
							<div class="sousTitre perfectCorrect">Correct</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >3 points</li>
								<li class="pointRegle regleDetail" >Trouver le résultat du match.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 3-0 : + 3 points</span></li>
								<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 1-1 - Score 0-0 : + 3 points</span></div>
							</ul>
							<div class="sousTitre perfectInverse">Inverse</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >1 point</li>
								<li class="pointRegle regleDetail" >Trouver le résultat inverse du match.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 1-2 : + 1 point</span></li>
							</ul>
							<div class="sousTitre perfectEchec">Echec</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >0 point</li>
								<li class="pointRegle regleDetail" >Tout autre résultat.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 0-2 : + 0 point</span></li>
								<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 1-1 - Score 1-0 : + 0 point</span></div>
								<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 0-1 - Score 0-0 : + 0 point</span></div>
							</ul>

							<h3>Règles bonus</h3>
							<div class="sousTitre titreBonus">Equipe vainqueur</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >10 points</li>
								<li class="pointRegle regleDetail" >Trouver le vainqueur du tournoi Euro 2020.</li>
							</ul>
							<!-- <div class="sousTitre titreBonus">Meilleure attaque</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouvez la meilleure attaque du tournoi RUSSIE 2018.</li>
							</ul>
							<div class="sousTitre titreBonus">Meilleure défense</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouvez la meilleure défense du tournoi RUSSIE 2018.</li>
							</ul> -->
							<div class="sousTitre titreBonus">Minute du premier but</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points [tout-pil'] 3 points [approchant] </li>
								<li class="pointRegle regleDetail" >Trouver la minute du premier but du tournoi Euro 2020.</li>
								<li class="pointRegle regleDetail" >[Tout-pil'] : trouver la minute exacte.</li>
								<li class="pointRegle regleDetail" >[Approchant] : La minute se trouve dans les <strong>2</strong> minutes de battement avant ou après votre pronostic.</li>
								<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
								<li class="pointRegle regleDetail" >Minutage officiel donné par l'UEFA.</li>
							</ul> 
							<div class="sousTitre titreBonus">Minute du dernier but</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points [tout-pil'] 3 points [approchant] </li>
								<li class="pointRegle regleDetail" >Trouver la minute du dernier but du tournoi Euro 2020.</li>
								<li class="pointRegle regleDetail" >[Tout-pil'] : trouver la minute exacte.</li>
								<li class="pointRegle regleDetail" >[Approchant] : La minute se trouve dans les <strong>2</strong> minutes de battement avant ou après votre pronostic.</li>
								<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
								<li class="pointRegle regleDetail" >Minutage officiel donné par l'UEFA.</li>
							</ul>
							<div class="sousTitre titreBonus">Nombre total de buts</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >10 points [tout-pil'] 5 points [approchant] </li>
								<li class="pointRegle regleDetail" >Trouver le nombre de buts total du tournoi Euro 2020.</li>
								<li class="pointRegle regleDetail" >[Tout-pil'] : Trouver le nombre exact de buts.</li>
								<li class="pointRegle regleDetail" >[Approchant] : Le nombre de buts se trouve dans les <strong>3</strong> buts de battement avant ou après votre pronostic.</li>
								<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
							</ul>

							<!-- <div class="sousTitre titreBonus">Meilleur buteur</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouver le meilleur buteur du tournoi RUSSIE 2018.</li>
							</ul> -->

							<!-- <div class="sousTitre titreBonus">Meilleur passeur</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouver le meilleur passeur du tournoi RUSSIE 2018.</li>
							</ul>

							<div class="sousTitre titreBonus">Nombre buts du meilleur buteur</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouver le nombre de buts du meilleur buteur du tournoi RUSSIE 2018.</li>
							</ul>
							<div class="sousTitre titreBonus">Premier buteur français</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouver le premier buteur français du tournoi RUSSIE 2018.</li>
							</ul>
							<div class="sousTitre titreBonus">Nombre de buts de la France</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >7 points</li>
								<li class="pointRegle regleDetail" >Trouver le nombre de buts de la France lors du tournoi RUSSIE 2018.</li>
							</ul> -->
							<!-- <div class="sousTitre titreBonus">Bonus : Finale</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >14 points ou 8 points ou 6 points ou 2 points</li>
								<li class="pointRegle regleDetail" >Le nombre de points gagnés sur le match de la finale est doublé.</li>
							</ul>  -->
						</p>

						<h3>Dates</h3>
						<ul class="ulperso">
							<li class="pointRegle" >20 Mai 2021 : ouverture aux inscriptions.</li>
							<li class="pointRegle" >6 Juin 2021 : fermeture des inscriptions et des pronostics. Ouverture de tous les pronostics à tout le monde.</li>
							<li class="pointRegle" >Matches de phase finale : pour les 8émes, quarts, demies et finale, tous les pronostics seront à rentrer en ligne.</li>
						</ul>

						<h3>Engagement dans le concours</h3>
						<p>
							<span class="pointRegle">20€ par joueur à payer avant le 1er juin par virement, chèque ou espèce.</span>			
						</p>

						<h3>Tableau des gains</h3>
						<p>
							<span class="pointRegle">Le tableau des gains sera calculé selon le nombre de participants avec la base de calcul suivante.</span>
							<!--Total des gains 345 € (21 adultes x 15 € = 315 € + 3 mineurs x 10 = 30 €)</br></br>--->
							<ul class="ulperso">
								<li class="pointRegle" >1er   = 65 % 
								<li class="pointRegle" >2ème  = 25 % 
								<li class="pointRegle" >3ème  = 10 % 
							</ul>
							<!-- Lot restant 330 €</br>

							1er  = 214,50 €</br>
							2em  = 82,50 €</br>
							3em  = 33 €</br> -->
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>