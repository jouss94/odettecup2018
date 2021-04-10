<?php

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

		echo '<div class="profilInformation floaleft">';


	$qry = "SELECT *, joueurs.nom as joueursnom FROM joueurs 
	WHERE id_joueur='".$idProfil."';";
	$result = mysqli_query($con, $qry);
	$find = false;
	while ($row = mysqli_fetch_array($result )) 
	{	
		$find = true;
		echo '<div class="profilInformationSurnomBig">';
		echo '<span style="padding-top: 15px;display: block;color: #FFF;FONT-WEIGHT: bold;">';
		echo utf8_encode_function($row["surnom"]);
		echo '</span>';

		echo '<div class="profilInformationImageDiv"> 

				<img src="', utf8_encode_function($row["image"]), '" style="margin: 15px;" class="profilInformationImage mdl-button--raised"/>

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
			<span class="mdl-chip__text ">Paiment</span>
		</span>';

		echo '</div>';
	}

	echo '</div>';

	if ($find)
	{

	// Pronotics

	echo '

	<div class="profilPronosBig floaleft">
	<span class="profilPronosTitre">Pronostics Matches</span>
	
		<span class="RetourSpan">
			<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
				Retour
			</button>
		</span>

	<form action="addMatches.php" method="post">

	';




	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.name  as away_name,
					equipes_away.logo  as away_logo,
					pronos.*
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_membre = $id WHERE modif=1 ORDER BY groupe, date, id;";
	$result = mysqli_query($con, $qry);
	$oldgroup = "";
	$first = true;
	$firstID = 0;
	$lastID = 0;
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
		$montagne = $row["montagne"];

		if ($oldgroup != $group)
		{
			if ($first)
			{
				$firstID = $id_match;
				$first = false;
			}
			else
				echo '</table>';

			echo '<span class="profilPronosSousTitre"> Groupe ', $group ,'</span>';

			echo '<table class="tableauPronosForm">';

			
		}

		if ($lastID < $id_match)
			$lastID = $id_match;

		$oldgroup = $group;


		if ($montagne == 1)
		{
			echo '<tr>
				<td colspan="7" class="tdmontagne">
				&darr; Match de montagne &darr;
				</td>
			</tr>';
		}

		echo '<tr>';
		echo '
			<td><img class="logoEquipe" src="', $home_logo, '" /></td>
		';

		echo '
			<td class="tdMatch tdMatchLeft">', $home_name, '</td>
		';
		echo '
			<td>
				<input id="match_', $id_match ,'_home" name="numberMatch_', $id_match ,'_home" type="text" value=';

				if ($pronos_home != "NULL")
					echo '"', $pronos_home, '"';
				else
					echo '""';

				echo ' class="serverside-validation" size="6" />
			</td>
		';
		echo '
			<td>-</td>
		';
		echo '
			<td>
				<input id="match_', $id_match ,'_away" name="numberMatch_', $id_match ,'_away" type="text" value=';

				if ($pronos_away != "NULL")
					echo '"', $pronos_away, '"';
				else
					echo '""';

				echo ' class="serverside-validation" size="6" />
			</td>
		';

		echo '
			<td class="tdMatch tdMatchRight">', $away_name, '</td>
		';

		echo '
			<td><img class="logoEquipe" src="', $away_logo, '" /></td>
		';
		echo '</tr>';

	}
	echo '</table>';

			echo '<input id="firstid" name="firstid" type="text" value=';
			echo '"', $firstID , '"';
			echo ' style="display:none;"" size="6" />';

			echo '<input id="lastid" name="lastid" type="text" value=';
			echo '"', $lastID , '"';
			echo ' style="display:none;"" size="6" />';



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