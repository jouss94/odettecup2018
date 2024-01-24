<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

		echo '<div class="profilInformation floaleft">';


		$qry = "SELECT *, joueurs.nom as joueursnom,
		joueurs.image as joueursimage,
		joueurs.color as joueursColor,
		equipe_winner.logo as logo
		 FROM joueurs 
		
		LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = joueurs.equipe
		WHERE id_joueur='".$idProfil."';";
	$result = mysqli_query($con, $qry);
	$find = false;
	if ( $result) {
		while ($row = mysqli_fetch_array($result )) 
		{	
			$find = true;
			echo '<div class="profilInformationSurnom" style=" background:linear-gradient(', $row["joueursColor"] ,' 0%, #9c2950 40%);">';

			echo '<div class="cadreprofilsurnom"> ';
			echo '<span style="padding-top: 15px;display: block;FONT-WEIGHT: bold;">';
			echo utf8_encode_function($row["surnom"]);
			if ($row["logo"] != null) {
				echo '<img class="logoEquipProfil" src="';
				echo $row["logo"];	
				echo '" />';
			}
			echo '</span>';
			echo '</div> ';

			echo '<div class="profilInformationImageDiv"> 

					<img src="', utf8_encode_function($row["joueursimage"]), '" class="profilInformationImage mdl-button--raised"/>

				</div>';
			if ($idProfil == $id)
			{
				echo '<div> 
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ModifierProfil">
						Modifier Profil 
					</button>
				</div>';
			}

			echo '<div class="profilInformationCivil">', utf8_encode_function($row["prenom"]), '</div>';
			echo '<div class="profilInformationCivil">', utf8_encode_function($row["joueursnom"]), '</div>';
			echo '<div class="profilInformationCivil">', utf8_encode_function($row["email"]), '</div>';
			echo '<div class="profilInformationEmail">', utf8_encode_function($row["description"]), '</div>';
			
			
			$chipsProfil = 'chips-red';
			if (intval($row["modif_profil"]) == 1 && intval($row["modif_match"]) == 1 && intval($row["modif_bonus"]) == 1)
			$chipsProfil = 'chips-green';
			
			$chipsPayement = 'chips-red';
			if (intval($row["payed"]) == 1) $chipsPayement = 'chips-green';


			echo '
			<span class="mdl-chip mdl-chip--contact chips-body ', $chipsProfil, '-body">
				<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white ', $chipsProfil, '"></span>
				<span class="mdl-chip__text ">Profil à jour</span>
			</span>
			<span class="mdl-chip mdl-chip--contact chips-body ', $chipsPayement, '-body"">
				<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white ', $chipsPayement, '"></span>
				<span class="mdl-chip__text ">Paiement</span>
			</span>';

			echo '</div>';
		}
	}
	echo '</div>';

	if ($find)
	{

	// Pronotics

	echo '

	<div class="profilPronosSmall floaleft">
	<span class="profilPronosTitre">Pronostics Joker</span>

		<span class="RetourSpanContainer">
			<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
				Retour
			</button>
		</span>

		<div class="resumeJoker">
			<div class="jokerdiv jokertile">
				<img class="jokerBig" src="images/joker1.png" />
				<div class="jokerBigText">Ce joker double vos points pour le match choisi</div>
			</div>
			<div class="jokerdiv jokertile">
				<img class="jokerBig" src="images/joker2.png" />
				<div class="jokerBigText">Ce joker vous donne une chance en plus de mettre des points avec 2 scores sur le match choisi</div>
			</div>
			<div class="jokerdiv jokertile">
				<img class="jokerBig" src="images/joker3.png" />
				<div class="jokerBigText">Ce joker permet de marquer 1 point supplémentaire pour chaque but dans le match choisi</div>
			</div>
		</div>

		<div class="jokertextdiv">
			<div class="jokertext jokertile">Vous allez devoir choisir sur quel match vous voulez jouer vos jokers. Ils sont obligatoires et doivent être repartis de la maniere suivante : 
				<li>Un joker par journée de poule</li>
				<li>Dans l\'ordre que vous voulez</li>
			</div>
		</div>
	<form action="addBonus.php" method="post">';
	
	echo '
	<div class="availableJoker">
		<div class="availableJokerText">
			Joker disponible :
		</div>
		<div id="Joker1Available" class="availableJokerImg">
			<img class="jokerMedium" src="images/joker1.png" />
		</div>
		<div id="Joker3Available" class="availableJokerImg">
			<img class="jokerMedium" src="images/joker2.png" />
		</div>
		<div id="Joker2Available" class="availableJokerImg">
			<img class="jokerMedium" src="images/joker3.png" />
		</div>
	</div>
	';

	$qry = "SELECT matches.*,
	matches.id_match as id, 
	equipes_home.name  as home_name,
	equipes_home.logo  as home_logo,
	equipes_away.name  as away_name,
	equipes_away.logo  as away_logo,
	matches.dayOfStage,
	pronos.*
	FROM matches 
	LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
	LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
	LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id WHERE modif=1 ORDER BY dayOfStage, groupe, date, id;";
	$result = mysqli_query($con, $qry);

	$oldDayOfStage = 0;
	echo '
	<div>
	';
	while ($row = mysqli_fetch_array($result )) 
	{
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$pronos_home = $row["prono_home"];
		$pronos_away = $row["prono_away"];
		$dayOfStage = $row["dayOfStage"];

		if ($oldDayOfStage != $dayOfStage) 
		{
			$oldDayOfStage = $dayOfStage;

			echo '
			</div>
			';

			echo '
			<div class="availableJoker paddingtop20">
				<div class="dayofStageText">
					Journée ',$dayOfStage,' :
				</div>
			</div>
			';
		
			echo '
			<div class="jokerDisplayMatchs">
			';
		}

		echo '<div class="jokerMatch">';
		echo '
			<img class="logoEquipe" src="', $home_logo, '" />
		';

		// echo '<span>', $home_name, '</span>';

		echo '<span class="pancarteAuto"> ',$pronos_home,'</span> ';
		// echo '
		// 	<td>
		// 		<input id="match_', $id_match ,'_home" name="numberMatch_', $id_match ,'_home" type="text" value=';

		// 		if ($pronos_home != "NULL")
		// 			echo '"', $pronos_home, '"';
		// 		else
		// 			echo '""';

		// 		echo ' class="serverside-validation" size="6" />
		// 	</td>
		// ';
		echo '
			<span class="tiret">-</span>
		';
		echo '<span class="pancarteAuto"> ',$pronos_away,'</span> ';
		// echo '
		// 	<td>
		// 		<input id="match_', $id_match ,'_away" name="numberMatch_', $id_match ,'_away" type="text" value=';

		// 		if ($pronos_away != "NULL")
		// 			echo '"', $pronos_away, '"';
		// 		else
		// 			echo '""';

		// 		echo ' class="serverside-validation" size="6" />
		// 	</td>
		// ';

		// echo '<span>', $away_name, '</span>';

		echo '
			<img class="logoEquipe" src="', $away_logo, '" />
		';

		echo'
		<label class="labeljokerimg">
			<input type="radio" name="Joker1" value="joker1">
			<img class="jokerSmall jokerButton" src="images/joker1.png" alt="Option 1"/>
		</label>
		<label class="labeljokerimg">
			<input type="radio" name="Joker2" value="joker2">
			<img class="jokerSmall jokerButton" src="images/joker2.png" alt="Option 2"/>
		</label>
		<label class="labeljokerimg">
			<input type="radio" name="Joker3" value="joker2">
			<img class="jokerSmall jokerButton" src="images/joker3.png" alt="Option 3"/>
		</label>';
		// echo '
		// 	<input id="match_away" name="numberMatch_away" type="text" /> 
		// 	<input id="match_away" name="numberMatch_away" type="text" /> 
		// 	';
		echo '</div>';
	}
	echo '</div>';

	echo '<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>';

	echo '		</form></div>';
	}
	else
	{
		echo 'Ce profil n\'exite pas';
	}

?>