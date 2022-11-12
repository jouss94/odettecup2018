<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id == 0) { header('Location: index.php'); }

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
							<!-- <div class="sousTitre perfectCorrectPlus">Correct +</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >4 points</li>
								<li class="pointRegle regleDetail" >Trouver le vainqueur du match et le nombre de but de l'une des deux équipes.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 2-0 : + 4 points</span></li>
								<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 2-1 - Score 3-1 : + 4 points</span></div>
							</ul> -->
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
							<div class="sousTitre titreBonus">Equipe favorite</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >Nouvelle règle - Votre équipe favorite va vous suivre pendant toute la coupe du monde</li>
								<li class="pointRegle regleDetail" >Vous êtes associé à cette équipe sur le site avec une couleur et le drapeau</li>
								<li class="pointRegle regleDetail" >Elle vous fera gagner ou perdre des points selon les règles suivantes :</li>
								<ul>
									<li class="pointRegle regleDetail" >Eliminé en poule :&nbsp;&nbsp;&nbsp;&nbsp; <strong>-3 points</strong></li>
									<li class="pointRegle regleDetail" >Eliminé en 8eme  :&nbsp;&nbsp;&nbsp; &nbsp;<strong>0 point</strong></li>
									<li class="pointRegle regleDetail" >Passe les 8emes  :&nbsp;&nbsp;&nbsp; <strong>+1 point</strong></li>
									<li class="pointRegle regleDetail" >Passe les quarts :&nbsp;&nbsp;&nbsp;&nbsp; <strong>+2 points</strong></li>
									<li class="pointRegle regleDetail" >Passe les demies :&nbsp;&nbsp; <strong>+3 points</strong></li>
									<li class="pointRegle regleDetail" >Gagne le tournoi :&nbsp;&nbsp;&nbsp;&nbsp; <strong>+5 points</strong></li>
								</ul>
								<li class="pointRegle regleDetail" >Les points sont cumulables</li>
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
							<div class="sousTitre titreBonus">Nombre total de buts</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >Attention la règle change sur l'attribution des points</li>
								<li class="pointRegle regleDetail" >Trouver le nombre de buts total de la coupe du monde</li>
								<li class="pointRegle regleDetail" >Rapporte <strong>5 points</strong></li>
								<li class="pointRegle regleDetail" >La reponse se trouve dans les <strong>3</strong> buts de battement avant ou après le résultat.</li>
								<li class="pointRegle regleDetail" >Soit une plage de but de <strong>7</strong> buts. Exemple :</li>
								<ul>
									<li class="pointRegle regleDetail" >Le nombre de but total final est de 85 buts.</li>
									<li class="pointRegle regleDetail" >Toutes les reponses entre 82 buts et 88 buts inclus gagnent <strong>5 points</strong></li>
								</ul>
								<!-- <li class="pointRegle reglePoint" >10 points [tout-pil'] 5 points [approchant] </li>
								<li class="pointRegle regleDetail" >[Tout-pil'] : Trouver le nombre exact de buts.</li>
								<li class="pointRegle regleDetail" >[Approchant] : Le nombre de buts se trouve dans les <strong>3</strong> buts de battement avant ou après votre pronostic.</li> -->
								<!-- <li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li> -->
							</ul>
							<div class="sousTitre titreBonus">Minute du premier but</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >Attention la règle change sur l'attribution des points</li>
								<li class="pointRegle regleDetail" >Trouver la minute du premier but de la coupe du monde</li>
								<li class="pointRegle regleDetail" >Rapporte <strong>5 points</strong></li>
								<li class="pointRegle regleDetail" >Minutage officiel donné par la FIFA.</li>
								<li class="pointRegle regleDetail" >La reponse se trouve dans les <strong>2</strong> minutes de battement avant ou après le résultat.</li>
								<li class="pointRegle regleDetail" >Soit une plage de but de <strong>5</strong> minutes. Exemple :</li>
								<ul>
									<li class="pointRegle regleDetail" >Le but est marqué à la 32ème minute</li>
									<li class="pointRegle regleDetail" >Toutes les reponses entre la 30ème et la 34ème minute inclus gagnent <strong>5 points</strong></li>
								</ul>
																<!-- <li class="pointRegle reglePoint" >7 points [tout-pil'] 3 points [approchant] </li>
								<li class="pointRegle regleDetail" >Trouver la minute du premier but du tournoi Euro 2020.</li>
								<li class="pointRegle regleDetail" >[Tout-pil'] : trouver la minute exacte.</li>
								<li class="pointRegle regleDetail" >[Approchant] : La minute se trouve dans les <strong>2</strong> minutes de battement avant ou après votre pronostic.</li>
								<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li> -->

							</ul> 
							<div class="sousTitre titreBonus">Minute du dernier but</div>
							<ul class="ulperso">
							<li class="pointRegle reglePoint" >Attention la règle change sur l'attribution des points</li>
								<li class="pointRegle regleDetail" >Trouver la minute du dernier but de la coupe du monde</li>
								<li class="pointRegle regleDetail" >Rapporte <strong>5 points</strong></li>
								<li class="pointRegle regleDetail" >Minutage officiel donné par la FIFA.</li>
								<li class="pointRegle regleDetail" >La reponse se trouve dans les <strong>2</strong> minutes de battement avant ou après le résultat.</li>
								<li class="pointRegle regleDetail" >Soit une plage de but de <strong>5</strong> minutes. Exemple :</li>
								<ul>
									<li class="pointRegle regleDetail" >Le but est marqué à la 79ème minute</li>
									<li class="pointRegle regleDetail" >Toutes les reponses entre la 77ème et la 81ème minute inclus gagnent <strong>5 points</strong></li>
								</ul>

								<!-- <li class="pointRegle reglePoint" >7 points [tout-pil'] 3 points [approchant] </li>
								<li class="pointRegle regleDetail" >Trouver la minute du dernier but du tournoi Euro 2020.</li>
								<li class="pointRegle regleDetail" >[Tout-pil'] : trouver la minute exacte.</li>
								<li class="pointRegle regleDetail" >[Approchant] : La minute se trouve dans les <strong>2</strong> minutes de battement avant ou après votre pronostic.</li>
								<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
								<li class="pointRegle regleDetail" >Minutage officiel donné par l'UEFA.</li> -->
							</ul>


							<div class="sousTitre titreBonus">Meilleur buteur</div>
							<ul class="ulperso">
								<li class="pointRegle regleDetail" >Trouver le meilleur buteur de la coupe du monde</li>
								<li class="pointRegle regleDetail" >Rapporte <strong>5 points</strong></li>
								<li class="pointRegle regleDetail" >Si plusieurs meilleurs buteurs égalités toutes les reponses sont correctes</strong></li>
							</ul>

							<div class="sousTitre titreBonus">Joueur gagnant</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >Le retour d'un bonus pour encore plus de fun</li>
								<li class="pointRegle regleDetail" >Trouver le gagnant du tournoi Odette Cup 2022</li>
								<li class="pointRegle regleDetail" >Rapporte <strong>5 points</strong></li>
								<li class="pointRegle regleDetail" >On parle bien ici d'un joueur, un concurrent</li>
								<li class="pointRegle regleDetail" >Ce bonus sera le tout dernier bonus attribué</li>
								<li class="pointRegle regleDetail" >Le classement est arrété à la fin de la finale tous les bonus compris sauf celui-ci</li>
								<li class="pointRegle regleDetail" >Le gagnant sera donc le premier à la fin de la finale bonus compris sauf celui-ci</li>
								<li class="pointRegle regleDetail" >Si ce bonus redistribu les cartes et change le gagnant, c'est normal et c'est le but</li>
								<li class="pointRegle regleDetail" >Bien sur si tu es très confiant tu mets ton propre nom</li>
							</ul>

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
							<div class="sousTitre titreBonus">Bonus de la Finale</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >Le nombre de points gagnés sur le match de la finale est doublé</li>
								<li class="pointRegle regleDetail" >Rapporte 14 points ou 6 points ou 2 points ou 0 point</li>
							</ul> 
						</p>

						<h3>Dates</h3>
						<ul class="ulperso">
							<li class="pointRegle" >17 octobre 2022 : ouverture aux inscriptions.</li>
							<li class="pointRegle" >18 novembre 2022 : fermeture des inscriptions et des pronostics. Ouverture de tous les pronostics à tout le monde.</li>
							<li class="pointRegle" >20 novembre 2022 : match d'ouverture de la coupe du monde 2022</li>
							<li class="pointRegle" >Les matches de phase finale : pour les 8èmes, quarts, demies et finale tous les pronostics seront à rentrer en ligne.</li>
						</ul>

						<h3>Engagement dans le concours</h3>
						<p>
							<li class="pointRegle">20€ par joueur adulte</li>			
							<li class="pointRegle">10€ par joueur mineur</li>			
							<li class="pointRegle">A payer avant le 17 novembre 2022 par virement</li>			
						</p>

						<h3>Tableau des gains</h3>
						<p>
							<span class="pointRegle">Le tableau des gains sera calculé selon le nombre de participants avec la base de calcul suivante.</span>
							<!--Total des gains 345 € (21 adultes x 15 € = 315 € + 3 mineurs x 10 = 30 €)</br></br>--->
							<ul class="ulperso">
								<li class="pointRegle" >1er   = 65 % 
								<li class="pointRegle" >2ème  = 25 % 
								<li class="pointRegle" >3ème  = 10 % 
								<li class="pointRegle" >4ème  = Remboursé 
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