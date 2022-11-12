<?php
	
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
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_membre = $id WHERE (modif=1 OR modif=2) and played = 0 ORDER BY date, id;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
	while ($row = mysqli_fetch_array($result )) 
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
		

		$date_array = date_parse($row["date"]);
		if ($i++ % 2 == 0) {
			echo '	<tr class="backgroundTab1">';
		}
		else {
			echo '	<tr class="backgroundTab2">';
		}

		$classPancarte = "";
		if ($row["montagne"] == 1)
		{
			$classPancarte = "pancarteMontagne";
		}

		echo '<td class="homeSmallDate">';
		echo '<div>';
			echo $date_array['day']. "/" . $date_array['month'];	
		echo '</div>';
		echo '<div>';
			echo $date_array['hour']. ":00";	
		echo '</div>';
		echo '</td>';
		echo '<td><img class="logoEquipeSmall" src="';
		echo $home_logo;	
		echo '" /></td>';
		echo '<td class="homeEquipeDroite2">';
		echo $home_name;	
		echo '</td>';
		echo '<td class="homeEquipeEquipe">';
		if ( $row["prono_home"] != null)
		{
			echo '<span class="pancarteBig ',$classPancarte,'">';
			echo $row["prono_home"];
			echo '</span>';
		}
		echo '</td>';

		echo '<td class="homeEquipeMilieu2"> - </td>';
		echo '<td class="homeEquipeEquipe">';
		if ( $row["prono_away"] != null)
		{
			echo '<span class="pancarteBig ',$classPancarte,'">';
			echo $row["prono_away"];
			echo '</span>';
		}
		echo '</td>';
		echo '<td class="homeEquipeGauche2">';
		echo $away_name;	
		echo '</td>';
		echo '<td><img class="logoEquipeSmall" src="';
		echo $away_logo;	
		echo '" /></td>';
echo '	</tr>';		

	}
	
echo '</table>';

	if (!$find)
	echo 'Pas encore de matches joués.';
	echo '';

?>