<?php
	
	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	echo '<table class="full-table-collapse-white">';
	

	$qry = "SELECT * FROM matches WHERE modif=2;";
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
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_membre = $id WHERE modif=2  and played = 1 ORDER BY date DESC, id;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
	{
		$find = true;
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$pronos_home = $row["prono_home"];
		$pronos_away = $row["prono_away"];
		$montagne = $row["montagne"];

		$point = $row["point"];
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
// echo '	<tr class="', $classTR, '">';

		$classPancarte = "";
		if ($row["montagne"] == 1)
		{
			$classPancarte = "pancarteMontagne";
		}


		if ($i++ % 2 == 0) {
			echo '	<tr class="backgroundTab2">';
		}
		else {
			echo '	<tr class="backgroundTab1">';
		}

		echo '<td class="homeSmallDate">';
		echo '<div>';
			echo $date_array['day']. "/0" . $date_array['month'];	
		echo '</div>';
		echo '<div>';
			echo $date_array['hour']. ":00";	
		echo '</div>';
		echo '</td>';
		echo '<td><img class="logoEquipeSmall" src="';
		echo $home_logo;	
		echo '" /></td>';
		echo '</td>';
		echo '<td class="homeEquipeDroite">';
		echo $home_name;	
		echo '</td>';
		echo '<td class="homeEquipeEquipe"><span class="pancarteBig ',$classPancarte,'">';
		echo $row["prono_home"];
		echo '</span></td>';
		echo '<td class="homeEquipeMilieu"> - </td>';
		echo '<td class="homeEquipeEquipe"><span class="pancarteBig ',$classPancarte,'">';
		echo $row["prono_away"];
		echo '</span></td>';
		echo '<td class="homeEquipeGauche">';
		echo $away_name;	
		echo '</td>';
		echo '<td><img class="logoEquipeSmall" src="';
		echo $away_logo;	
		echo '" /></td>';
		echo '<td class="homePoint ', $classTR ,'">+';
		echo $row["point"];;
		echo '</td>';
echo '	</tr>';		

	}
	
echo '</table>';

	if (!$find)
	echo 'Pas encore de matches joués.';
	echo '';

?>