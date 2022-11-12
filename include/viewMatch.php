<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	echo '

		<div class="allMatch">';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idMatch = $query['id'];

	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.name  as away_name,
					equipes_away.logo  as away_logo
					FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			WHERE id_match = $idMatch;";
		$result = mysqli_query($con, $qry);
	$find = false;

	while ($row = mysqli_fetch_array($result )) 
	{
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$date = utf8_encode_function($row["date"]);
		$diff = utf8_encode_function($row["diff"]);
		$stadium = utf8_encode_function($row["stadium"]);
		$played = $row["played"];
		$date_array = $row["date"];
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
		$montagne = $row["montagne"];


		// echo '<h2> ',$group,'</h2>';
		
		if ($row["montagne"] == 1)
		{
			echo '<div class="matchmontagne">Match de montagne</div>';
		}		

		echo '<table style="margin:auto;width: 85%;border-collapse: collapse;text-align: center;    font-style: italic;">
			<tr>
					<td style="margin: auto;    width: 33%;text-align: left 	;">',
						 $date_array,'
					</td>
					<td style="margin: auto;    width: 33%;">', $stadium;


					echo '</td>
					<td style="margin: auto;    width: 33%;text-align: right;" >', $diff,  
					'</td>';

		echo '</tr>
		</table>';

		echo '
		<table style="margin:auto;width: 100%;border-collapse: collapse;    margin-top: 20px;">
			<tr>
					<td style="margin: auto;text-align: right;padding-right: 40px;">
						<img class="logoEquipeBig" src="', $home_logo,'" />
					</td>
					<td >';

					echo '</td>
					<td >  ', 
					'</td>
					<td >'; 
					echo '</td>
					<td style="margin: auto;text-align: left;padding-left: 40px;">
						<img class="logoEquipeBig" src="', $away_logo,'" />
					</td>
			</tr>
			<tr>
					<td class="BigTitreRight" >', 
						$home_name,
					'</td>
					<td style="width: 8%;">'; 
						if ($played == 1)
							echo '<span class="pancarte" style="font-size: 35px;">',  $score_home,'</span>';

					echo '</td >
					<td style="font-size: 50px;width:20px">&nbsp;', 
					'</td>
					<td style="width: 8%;">'; 
						if ($played == 1)
							echo '<span class="pancarte" style="font-size: 35px;">',  $score_away,'</span>';

					echo '</td>
					<td class="BigTitreLeft" >', 
						$away_name,
					'</td>
			</tr>
		</table>';




	}

	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.name  as away_name,
					equipes_away.logo  as away_logo,
					pronos.*,
					joueurs.*,
					classements.*
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match 
			LEFT JOIN joueurs ON joueurs.id_joueur = pronos.id_membre 
			LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general'
			WHERE modif=2 AND matches.id_match = $idMatch  ORDER BY classements.rang;";
	$result = mysqli_query($con, $qry);
	$find = false;


	echo '';

	echo '';

echo '

<div class="match-card-event mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-card--expand">

<div style="height: 430px;overflow-y: auto;width:100%">
<table style="
    border-collapse: collapse;
    width: 100%;color:#FFF;">';

	$i = 0;
	// $row = mysqli_fetch_array($result );
	// while ($i < 50) 
	while ($row = mysqli_fetch_array($result ))
	{
		$find = true;
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$date = utf8_encode_function($row["date"]);
		$diff = utf8_encode_function($row["diff"]);
		$stadium = utf8_encode_function($row["stadium"]);
		$played = $row["played"];
		$date_array = date_parse($row["date"]);
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
		$nom =  utf8_encode_function($row["surnom"]);
		$rang =  $row["rang"];
		$pronos_home = $row["prono_home"];
		$pronos_away = $row["prono_away"];
		$point = $row["point"];
		$palyed = $row["played"];


		$classTR = "classTRNeutre";
			if ($point == 0)
				$classTR = "classTREchecHome";
			if ($point == 1)
				$classTR = "classTRInverseHome";
			if ($point == 3)
				$classTR = "classTRCorrectHome";
			if ($point == 4)
				$classTR = "classTRCorrectPlusHome";
			if ($point == 7)
				$classTR = "classTRPerfectHome";

					$date_array = date_parse($row["date"]);

$date_array = date_parse($row["date"]);
if ($i++ % 2 == 0) {
	echo '	<tr class="backgroundTab1">';
}
else {
	echo '	<tr class="backgroundTab2">';
}

		echo '<td class="rangMatch">', $rang ,' </td>';
		echo '<td class="surnomMatch">', $nom ,' </td>';
		echo '<td class="homeEquipeDroiteMatch">';
		echo $home_name;	
		echo '</td>';
		echo '<td class="pronosMatch">', $pronos_home ,' </td>';
		echo '<td class="homeEquipeMilieuMatch"> - </td>';
		echo '<td class="pronosMatch">', $pronos_away ,' </td>';
		echo '<td class="homeEquipeGaucheMatch">';
		echo $away_name;	
		echo '</td>';
		echo '<td class="homePointMatch ', $classTR, '">';
		if ($played ==1)
		{
				echo '+';
				echo $row["point"];;	
		}
		
		echo '</td>';
echo '	</tr>';		




	}

	
	
	if (!$find)
	echo '<tr>
			<td>
				<div style="margin: auto;width: 100%;text-align: center;color: #FFF;">Pas encore de pronostics pour ce match.</div>
			</td>
		</tr>';
	echo '';
	
	echo '</table></div>';
	echo '
	</div>
	<div class="mdl-card__actions mdl-card--border">
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="listeJoueur.php" >
			Liste joueurs 
		</a>
		<div class="mdl-layout-spacer"></div>
		<i class="material-icons">event</i>
	</div>
</div>



				</div>
';


?>