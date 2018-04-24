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
		<link rel="icon" type="image/png" href="images/icon-france.png" />
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
					<?php echo $pseudo ?> - <span class="titre">Règlement</span>
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
			<div class="loginform-in blackougedefault">



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

				<div style="width:100%;height:2950px;">

					<span class="listeJoueurTitre">Règlement</span>
	
					<span class="RetourSpan">
					<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
							Retour
						</button>
					</span>

						<div class="reglementDiv">

								<p>
				<h3>Règles sur chaque match :</h3>
				<div class="sousTitre perfectTitre">Perfect</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez le score exact du match.</li>
						<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 2-1 : + 7 points</span></li>
					</ul>
				<div class="sousTitre perfectCorrectPlus">Correct +</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >4 points</li>
						<li class="pointRegle regleDetail" >Trouvez le vainqueur du match et le score d'une des 2 équipes.</li>
						<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 2-0 : + 4 points</span></li>
						<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 2-1 - Score 3-1 : + 4 points</span></div>
					</ul>

				<div class="sousTitre perfectCorrect">Correct</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >3 points</li>
						<li class="pointRegle regleDetail" >Trouvez le résultat du match.</li>
						<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 3-0 : + 3 points</span></li>
						<div style="margin-left: 161px;"><span class="regleExempleCorp">Pronostic 1-1 - Score 0-0 : + 3 points</span></div>
					</ul>
				<div class="sousTitre perfectInverse">Inverse</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >1 point</li>
						<li class="pointRegle regleDetail" >Trouvez le résultat inverse du match.</li>
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

				<h3>Règles bonus :</h3>
					<div class="sousTitre titreBonus">Equipe vainqueur</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >14 points</li>
						<li class="pointRegle regleDetail" >Trouvez le vainqueur du tournoi EURO 2016.</li>
					</ul>
					<div class="sousTitre titreBonus">Meilleure attaque</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez la meilleure attaque du tournoi EURO 2016.</li>
					</ul>
					<div class="sousTitre titreBonus">Meilleure défense</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez la meilleure défense du tournoi EURO 2016.</li>
					</ul>
					<div class="sousTitre titreBonus">Minute du premier but</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >10 points [tout-pil'] 7 points [approchant] </li>
						<li class="pointRegle regleDetail" >Trouvez la minute du premier but du tournoi EURO 2016.</li>
						<li class="pointRegle regleDetail" >[Tout-pil'] : trouvez la minute exacte.</li>
						<li class="pointRegle regleDetail" >[Approchant] : La minute se trouve dans les <strong>2</strong> minutes de battement avant ou après votre pronostic.</li>
						<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
						<li class="pointRegle regleDetail" >Minutage officiel donné par l'UEFA.</li>
					</ul>



					<div class="sousTitre titreBonus">Minute du dernier but</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >10 points [tout-pil'] 7 points [approchant] </li>
						<li class="pointRegle regleDetail" >Trouvez la minute du dernier but du tournoi EURO 2016.</li>
						<li class="pointRegle regleDetail" >[Tout-pil'] : trouvez la minute exacte.</li>
						<li class="pointRegle regleDetail" >[Approchant] : La minute se trouve dans les <strong>2</strong> minutes de battement avant ou après votre pronostic.</li>
						<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
						<li class="pointRegle regleDetail" >Minutage officiel donné par l'UEFA.</li>
					</ul>

					<div class="sousTitre titreBonus">Nombre total de buts</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >14 points [tout-pil'] 7 points [approchant] </li>
						<li class="pointRegle regleDetail" >Trouvez le nombre de buts total du tournoi EURO 2016.</li>
						<li class="pointRegle regleDetail" >[Tout-pil'] : trouvez le nombre exact de buts.</li>
						<li class="pointRegle regleDetail" >[Approchant] : Le nombre de buts se trouve dans les <strong>3</strong> buts de battement avant ou après votre pronostic.</li>
						<li class="pointRegle regleDetail" >Seul le ou les plus proches égalités prennent des points.</li>
					</ul>

					<div class="sousTitre titreBonus">Meilleur buteur</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez le meilleur buteur du tournoi EURO 2016.</li>
					</ul>

					<div class="sousTitre titreBonus">Meilleur passeur</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez le meilleur passeur du tournoi EURO 2016.</li>
					</ul>

					<div class="sousTitre titreBonus">Nombre buts du meilleur buteur</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez le nombre de buts du meilleur buteur du tournoi EURO 2016.</li>
					</ul>
					<div class="sousTitre titreBonus">Premier buteur français</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez le premier buteur français du tournoi EURO 2016.</li>
					</ul>
					<div class="sousTitre titreBonus">Nombre de buts de la France</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >7 points</li>
						<li class="pointRegle regleDetail" >Trouvez le nombre de buts de la France lors du tournoi EURO 2016.</li>
					</ul>
					<div class="sousTitre titreBonus">Bonus : Finale</div>
					<ul class="ulperso">
						<li class="pointRegle reglePoint" >14 points ou 8 points ou 6 points ou 2 points ou 0 point</li>
						<li class="pointRegle regleDetail" >Le nombre de points gagnés sur la finale est doublé.</li>
					</ul>

			</p>

		<h3>Dates :</h3>
				<ul class="ulperso">
						<li class="pointRegle" >1er Mai 2016 : ouverture aux inscriptions.</li>
						<li class="pointRegle" >1er Juin 2016 : fermeture des inscriptions et des pronostics. Ouverture de tous les pronostics à tout le monde.</li>
						<li class="pointRegle" >Matches de phase finale : pour les 8émes, quarts, demies et finale, tous les pronostics seront à rentrer en ligne.</li>
					</ul>


		<h3>Engagement dans le concours :</h3>
			<p>
				<span class="pointRegle">20€ par joueur à payer avant le 1er juin par virement, chèque ou espèce.</span>			
			</p>

		<h3>Tableau des gains :</h3>
			<p>
				<span class="pointRegle">Le tableau des gains sera calculé selon le nombre de participants.</span>
				<!--Total des gains 345 € (21 adultes x 15 € = 315 € + 3 mineurs x 10 = 30 €)</br></br>
				Répartitions :</br>
				1er   = 65 % </br>
				2ème  = 25 % </br>
				3ème  = 10 % </br>
				4ème  = remboursé (rembourssé comme un adulte soit 15€)</br></br>

				Lot restant 330 €</br>

				1er  = 214,50 €</br>
				2em  = 82,50 €</br>
				3em  = 33 €</br>
			-->
			</p>

			<!--
			<h2>Quelques règles pour le site :</h2>
			<p>
				<h3>Plusieurs rubrique vous sont proposées :</h3>
			<ul>
				<li>La Rubrique <strong>News</strong> servira à communiquer avec l'ensemble des pronostiqueurs que vous êtes.<br/>
				On y retrouvera toutes les nouveautés du site, et pour vous prévenir de toute mise à jour
				<li>La Rubrique <strong>Classement</strong>, vous indiquera le classement officiel après chaque match avec présentation d'un podium. Nous sommes classés au nombre de points puis par ordre alphabétique.</li>
				<li>La Rubrique <strong>Calendrier</strong>, vous servira à voir toute la programmation des matchs avec la date et l'heure. Vous pouvez accéder à tous les pronostics du match dans la rubrique "détails"</li>
				<li>La Rubrique <strong>Joueurs</strong>, vous permet de lister tous les joueurs du championnat avec leurs photos, choisis par leurs soins, on peut donc grâce à cette rubrique accéder aux profils de chaque joueurs.</li>
				<li>La Rubrique <strong>Règlement</strong>, vous indiquera le règlement officiel du tournoi, mais aussi le règlement et les détails du site internet.</li>
				<li>La Rubrique <strong>Lachez-Vous</strong>, cette rubrique est sûrement la plus importante du site internet.<br/>
				Elle a été revue complètement à neuf. Tout est expliqué en details ci-dessous	
								</ul>
			</p>

			<p>
				<h3>La connexion au profil :</h3>

				En haut de chaque page vous retrouvez une nouvelle fonctionnalité de connexion.<br/>
				Le but est de se connecter avant de pouvoir poster des messages dans la rubriques de Lâchez-Vous<br/>
				En vous connectant vous pourrez modifier votre profil, changer votre mot passe, votre photo, et toutes autres informations<br/>
				Vôtre pseudo et mot de passe vous ont étés envoyés par message. Ce premier mot de passe est temporaire et peut être changé à tout moment.<br/>
				En cas de problème avec la connexion à vôtre compte, contactez le 07.60.85.19.92
			</p>

			<p>
				<h3>Lâchez-Vous :</h3>

				<h4>Cette nouvelle fonctionnalité vous propose 4 auditoires différents :</h4>
				<ul>
					<li><strong>Football</strong> pour ne parler que de foot toujours et encore.<br/></li>
					<li><strong>Pronos</strong> pour commenter les derniers résultats, le classement, et tout ce qui est en rapport avec les pronotics.<br/></li>
					<li><strong>Delire</strong> pour ne pas oublier que tout ceci n'est qu'un jeu.<br/></li>
					<li><strong>Site Web</strong> pour connaître votre avis sur le site et ses fonctionnalités, toute critique est bonne à prendre.<br/></li>
				</ul>

				Dans chaque auditoire, vous retrouverez différents thèmes de discussions.</br>
				Exemple pour Pronos : 
				<ul>
					<li><strong>RESULTAT PRONOS</strong></li>
					<li><strong>PRONOSTICS DES POULES</strong></li>
					<li><strong>ESPACE BONUS</strong></li>
				</ul>
				Et enfin dans chaque thèmes toutes les discussions en cours.</br>
				<h4> Voici un descriptif de toutes les fonctionnaliés proposées :</h4>

				<ul>
				<li>Vous pouvez à tout moment <b>créer une nouvelle discussion</b> avec le symbole <img src="./pictures/forum/ajouter16.png" alt="Nouveau topic" title="Poster un nouveau topic" /></li>
				<li>Ce symbole <img src="./pictures/forum/repondre16.png" alt="Répondre" title="Répondre à ce sujet" /> vous permet de <b>répondre</b> à la conversation en cours</li>
				<li>Vous pouvez <b>modifier</b> votre message grâce à ce symbole <img src="./pictures/forum/modifier16.png" alt="Editer" title="Editer ce message" /> directement sur le message</li>
				<li>Vous pouvez aussi <b>supprimer</b> votre message grâce à ce symbole <img src="./pictures/forum/annuler16.png" alt="Editer" title="Editer ce message" /> </li>
			</ul>

			<h4>Par ailleurs, Sachez que :</h4>
			<ul>
				<li>Vous ne pouvez rédiger des messages que si vous êtes connectés</li>
				<li>Vous ne pouvez modifer et supprimer que vos propres messages</li>
				<li>Vous pouvez changer les paramètres de votre profil à tous moments en vous rendant sur la page de votre profil</li>
			</ul>
			</p>
			-->
					<div/>
				</div>

			</div>
		</div>
</body>
</html>