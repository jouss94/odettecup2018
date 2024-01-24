<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];
	$find = true;
	if ($find)
	{

	// Pronotics

	echo '

	<span class="listeJoueurTitre">Pronostics matches</span>
	
		<span class="RetourSpanContainer">
			<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
				Retour
			</button>
		</span>

	<form action="addMatches.php" method="post">';

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
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id WHERE modif=1 ORDER BY groupe, date, id;";
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

		if ($oldgroup != $group)
		{
			if ($first)
			{
				$firstID = $id_match;
				$first = false;
			}
			else
				echo '</table>';

			echo '<div class="profilPronosSousTitre"> Groupe ', $group ,'</div>';

			echo '<table class="tableauPronosForm">';

			
		}

		if ($lastID < $id_match)
			$lastID = $id_match;

		$oldgroup = $group;

		echo '<tr>';
		echo '
			<td><img class="logoEquipe" src="', $home_logo, '" /></td>
		';

		echo '
			<td class="tdMatch tdMatchLeft">', $home_name, '</td>
		';
		echo '
			<td>
				<input id="match_', $id_match ,'_home" name="numberMatch_', $id_match ,'_home" value=';

				if ($pronos_home != "NULL")
					echo '"', $pronos_home, '"';
				else
					echo '""';

				echo ' type="number" size="6" />
			</td>
		';
		echo '
			<td>-</td>
		';
		echo '
			<td>
				<input id="match_', $id_match ,'_away" name="numberMatch_', $id_match ,'_away" value=';

				if ($pronos_away != "NULL")
					echo '"', $pronos_away, '"';
				else
					echo '""';

				echo ' type="number" size="6" />
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
	

	echo '		</form>';
	}
	else
	{
		echo 'Ce profil n\'exite pas';
	}

?>