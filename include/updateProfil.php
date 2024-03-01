<?php
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	$current_day_update = $GLOBALS['current_day'];
	$current_day_in_progress_update = $GLOBALS['current_day_in_progress'];
	if ($current_day_in_progress_update) {
		$current_day_update++;
	}

	require_once 'config.php';
	require_once 'functions.php';

	$citations = [
		'Profil : check ! Mission accomplie.',
		'Profil bouclé. Prêt à briller !',
		'Rien à rapporter, sauf que tu es au top du game !',
		'Rien à signaler, sauf que tu es au top du podium !',
		'Aucune anomalie à notifier, seulement ton statut au top.',
		'Pas de paperasse, juste ta réussite éclatante. Tu déchires !',
		'RAS, tu es au top !',
		'Zéro alerte, tu es le meilleur.',
		'Aucun souci, juste toi, au sommet.',
		'No news, juste toi, tout en haut.',
		"Rien à signaler, sauf que t'es au top !",
		'Aucune alerte, juste ton excellence.',
		'Nada à rapporter, tu cartonnes.',
		'Rien signalé, sauf toi, numéro un.',
		"Aucune info, t'es simplement au top !",
		'Aucun hic, juste ton excellence.',
		'Le meilleur, prêt à en découdre !',
		"Top niveau, prêt pour l'assaut.",
		"T'es le meilleur, prêt à tout dégommer !",
		"T'es le ninja des victoires, prêt pour une bagarre de marshmallows.",
		'Votre profil, prêt à déclencher des rires et des victoires.',
		'Votre profil, prêt à faire rire, même les grincheux.',
		'Votre profil est à jour',
		'Votre profil est à jour',
		'Votre profil est à jour',
		'Votre profil est à jour',
		'Votre profil est à jour',
		'Votre profil est à jour',
	];

	$citationsNeg = [
		"Votre profil n'est pas à jour",
		"Votre profil n'est pas à jour",
		"Votre profil n'est pas à jour",
		"Votre profil n'est pas à jour",
		"Votre profil n'est pas à jour",
		"Votre profil a besoin d'une petite mise à jour rapide",
		"Des infos manquantes ! Il est temps de compléter",
		"Des zones d'ombre ! Complète, allume la lumière du savoir",
		"Des infos en rade ! Complète pour lever l'ancre de la victoire",
		"Profil endormi, secouons-le pour le réveiller",
		"Profil en stand-by, rallumons la machine",
		"Profil en sommeil, réveillons le géant qui sommeille",
		"Profil en retard, hâtons-nous de le mettre à jour",
		"Profil en mode fossile, faisons-le revenir à la vie",
		"Profil en mode fantôme, faisons-lui un exorcisme d'infos",
		"Profil en hibernation, réveillons cette bête de succès",
		"Profil en apnée, offrons-lui une bouffée d'actualité",
		"Profil en berne, remettons-le debout",
		"Mission : compléter le formulaire. C'est toi l'élu",
		"Formulaire en détresse, à toi de jouer le super-héros",
		"Appel à l'action : le formulaire réclame ta signature",
		"Code rouge : le formulaire a besoin de ton intervention",
		"Urgence formulaire : besoin de ta signature express",
		"Le dossier réclame ton expertise pour sa touche finale",
		"Urgence inscription, à toi de jouer le dénouement",
		"Inscription en stand-by, à toi de lancer le sprint final",
	];


	$qry = "SELECT * FROM joueurs 
	LEFT JOIN pronostics pronos ON pronos.id_joueur = $id 
	LEFT JOIN matches ON matches.id_match = pronos.id_match  
	WHERE joueurs.id_joueur=$id and day = $current_day_update
	";
	$res = mysqli_query($con, $qry);
	$nb = mysqli_num_rows($res);

	$qry = "SELECT * FROM joueurs WHERE id_joueur=".$id.";";
	$result = mysqli_query($con, $qry);
	$find = false;
	while ($row = mysqli_fetch_array($result )) 
	{
		$modif_profil = intval($row["modif_profil"]);
	}


	if ($nb == 9 && $modif_profil == 1)
	{
		echo "<div class='etatProfilGreen' id='add_valideDemand'>";
		echo $citations[array_rand($citations)];
		echo "</div>";
	}

	else
	{
		echo "<div class='etatProfilRed' id='add_errDemand'>
				<div class='update-profil'>
					<div>
							<div class='titreUpdateRed'>";
							echo $citationsNeg[array_rand($citationsNeg)]; 
							echo" :</div>
					</div>

				";
		if ($modif_profil == 0)
		{
			echo "	<div class='update-profil-sub-line'>
						<div class='sousTitreUpdateRed'>
							<span >Vous devez modifier vos informations de profil </span>
						</div>
						<div class='detailTitreUpdateRed'>
							<span class='detailTitreUpdateRedSpan' id='modifProfilDetails'> Clique ici pour mettre à jour &rarr; </span>
						</div>
					</div>
					";
		}
		if ($nb != 9) 
		{

			echo "	<div class='update-profil-sub-line'>
						<div class='sousTitreUpdateRed'>
							<span >Vous devez entrer vos pronostics pour la journée $current_day_update </span>
						</div>
						<div class='detailTitreUpdateRed'>
							<span class='detailTitreUpdateRedSpan' id='modifMatchDetails'> Clique ici pour mettre à jour &rarr; </span>
						</div>
					</div>
					";
		}
		// if ($modif_joker == 0) 
		// {
		// 	echo "	<tr>
		// 				<td class='sousTitreUpdateRed'>
		// 					<span >Vous devez entrer vos jokers </span>
		// 				</td>
		// 				<td class='detailTitreUpdateRed'>
		// 					<span class='detailTitreUpdateRedSpan' id='modifJokerDetails'> Clique ici pour mettre à jour &rarr; </span>
		// 				</td>
		// 			</tr>
		// 			";
		// }
		// if ($modif_bonus == 0) 
		// {
		// 	echo "	<tr>
		// 				<td class='sousTitreUpdateRed'>
		// 					<span >Vous devez entrer vos pronostics bonus </span>
		// 				</td>
		// 				<td class='detailTitreUpdateRed'>
		// 					<span class='detailTitreUpdateRedSpan' id='modifBonusDetails'> Clique ici pour mettre à jour &rarr; </span>
		// 				</td>
		// 			</tr>
		// 			";
		// }

		
		echo "</div>
			</div>";
	}
?>