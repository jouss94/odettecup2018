 <?php

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$qry = "TRUNCATE TABLE `historic_rang`;";
	$result = mysqli_query($con, $qry);


	// $dateCurrent = date('14/06/2018');
	$dateCurrent = date('2018/06/15');
	$today = date("Y/m/d");

	$qry = "SELECT max(DATE_FORMAT(date, '%Y/%m/%d')) as datemax FROM matches WHERE matches.played = 1;";
	$result = mysqli_query($con, $qry);
	
	$today = date(mysqli_fetch_array($result)[0]);

	
	$today = date('Y/m/d', strtotime($today. ' + 1 days'));
	echo $today;
	echo ' // ';
	echo $dateCurrent;

while ($dateCurrent <= $today)
{
	echo '<p>';
	echo $dateCurrent;
	echo '</p>';

	$qry = "SELECT * FROM joueurs;";
	$result = mysqli_query($con, $qry);
	while ($row = mysqli_fetch_array($result )) 
	{
		$id_joueur = intval($row["id_joueur"]);
	
		$qry2 = "SELECT * 
				FROM pronostics  
				Left JOIN joueurs ON pronostics.id_membre = joueurs.id_joueur
				Left JOIN matches ON pronostics.id_match = matches.id_match
				WHERE joueurs.id_joueur = $id_joueur AND matches.played = 1 AND matches.date < '$dateCurrent'";
		$result2 = mysqli_query($con, $qry2);

		$nb_perf = 0;
		$nb_correctPlus = 0;
		$nb_correct = 0;
		$nb_inverse = 0;
		$nb_echec = 0;
		$total = 0;
		$points = 0;
		$bonus = 0;

		$nb_perf_montagne = 0;
		$nb_correctPlus_montagne = 0;
		$nb_correct_montagne = 0;
		$nb_inverse_montagne = 0;
		$nb_echec_montagne = 0;
		$total_montagne = 0;
		$points_montagne = 0;

		$bonusFinal = 0;

		while ($row2 = mysqli_fetch_array($result2 )) 
		{
			$id_match = intval($row2["id_match"]);
			$pronos_home = intval($row2["prono_home"]);
			$pronos_away = intval($row2["prono_away"]);
			$score_home = intval($row2["score_home"]);
			$score_away = intval($row2["score_away"]);
			$id_pronostic = $row2["id_pronostic"];
			$is_montagne = $row2["montagne"];
			$pointMacht = 0;
			$total++;

			if ($score_home == $pronos_home && $score_away == $pronos_away)
			{
				$pointMacht = 7;
				$nb_perf++;
				$points += $pointMacht;
				if ($is_montagne) 
				{
					$nb_perf_montagne++;
					$points_montagne += $pointMacht;
				}
			}
			else if (
						(($pronos_away - $pronos_home) > 0 && ($score_away - $score_home) > 0) 
						|| (($pronos_away - $pronos_home) < 0 && ($score_away - $score_home) < 0) 
						|| (($pronos_away - $pronos_home) == 0 && ($score_away - $score_home) == 0) 
					)
			{
				if ($pronos_away == $score_away || $pronos_home == $score_home)
				{
					$pointMacht = 4;
					$nb_correctPlus++;
					$points += $pointMacht;
					if ($is_montagne) 
					{
						$nb_correctPlus_montagne++;
					$points_montagne += $pointMacht;						
					}
				}
				else
				{
					$pointMacht = 3;
					$nb_correct++;
					$points += $pointMacht;					
					if ($is_montagne) 
					{
						$nb_correct_montagne++;
					$points_montagne += $pointMacht;					
						
					}
				}
			}
			else if ($score_home == $pronos_away && $pronos_home == $score_away)
			{
				$pointMacht = 1;
				$nb_inverse++;
				$points += $pointMacht;					
				if ($is_montagne) 
				{
					$nb_inverse_montagne++;
					$points_montagne += $pointMacht;										
				}
			}
			else
			{
				$pointMacht = 0;
				$nb_echec++;
				$points += $pointMacht;									
				if ($is_montagne) 
				{
					$nb_echec_montagne++;
					$points_montagne += $pointMacht;					
				}
			}
		}

		// BONUUUUUUUUS
		// Bonus first Min = all 0
		$qryBonus = "SELECT * 
				FROM pronostics_bonus
				Left JOIN joueurs ON pronostics_bonus.id_membre = joueurs.id_joueur
				WHERE joueurs.id_joueur = $id_joueur;";
		$resultBonus = mysqli_query($con, $qryBonus);

		$ptsFirstMin = 0;
		$ptsTeamWinner = 0;
		$ptsLastMin = 0;
		$ptsTotalBut = 0;
		$ptsButeur = 0;
		// + autre

		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{
			// regles a implémenter
			if (intval($rowBonus["min_first"]) == 12)
			{
				$ptsFirstMin = 10;
			}

			$bonus = $ptsFirstMin + $ptsTeamWinner + $ptsLastMin + $ptsTotalBut + $ptsButeur + $bonusFinal; // + + +
		}

		$points += $bonus;

		$updatejoueur = "INSERT INTO historic_rang  
					VALUES ('general', $id_joueur, '$dateCurrent', 0, $points)";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}

		$updatejoueur = "INSERT INTO historic_rang  
					VALUES ('montagne', $id_joueur, '$dateCurrent', 0, $points_montagne)";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}


		if (intval($row["female"]) == 1)
		{
			$updatejoueur = "INSERT INTO historic_rang  
			VALUES ('femme', $id_joueur, '$dateCurrent', 0, $points)";
			$result4 = mysqli_query($con, $updatejoueur);
			if (!$result4) {
				echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
			}
		}

	}
	$dateCurrent = date('Y/m/d', strtotime($dateCurrent. ' + 1 days'));

};
$dateCurrent = date('2018/06/15');
while ($dateCurrent <= $today)
{
	$qry = "SELECT * from historic_rang WHERE type = 'general' AND date = '$dateCurrent' ORDER BY points DESC";
	$result = mysqli_query($con, $qry);
	$i = 1;
	$oldPoint = -1;
	$oldRang = 0;
	while ($row = mysqli_fetch_array($result )) 
	{
		$id_joueur = $row["id_owner"];
		if ($row["points"] == $oldPoint)
		{
			$rang = $oldRang;
		}
		else
		{
			$oldRang = $i;
			$rang = $i;
		}

		$i++;
		$oldPoint = $row["points"];
		$updatejoueur = "UPDATE historic_rang 
					SET
					rang = $rang
					WHERE id_owner = $id_joueur AND type = 'general' AND date = '$dateCurrent'";

		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}
	}

	$qry = "SELECT * from historic_rang WHERE type = 'montagne' AND date = '$dateCurrent' ORDER BY points DESC";
	$result = mysqli_query($con, $qry);
	$i = 1;
	$oldPoint = -1;
	$oldRang = 0;
	while ($row = mysqli_fetch_array($result )) 
	{
		$id_joueur = $row["id_owner"];
		if ($row["points"] == $oldPoint)
		{
			$rang = $oldRang;
		}
		else
		{
			$oldRang = $i;
			$rang = $i;
		}

		$i++;
		$oldPoint = $row["points"];
		$updatejoueur = "UPDATE historic_rang 
					SET
					rang = $rang
					WHERE id_owner = $id_joueur AND type = 'montagne' AND date = '$dateCurrent'";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}
	}


	$qry = "SELECT * from historic_rang WHERE type = 'femme' AND date = '$dateCurrent' ORDER BY points DESC";
	$result = mysqli_query($con, $qry);
	$i = 1;
	$oldPoint = -1;
	$oldRang = 0;
	while ($row = mysqli_fetch_array($result )) 
	{
		$id_joueur = $row["id_owner"];
		if ($row["points"] == $oldPoint)
		{
			$rang = $oldRang;
		}
		else
		{
			$oldRang = $i;
			$rang = $i;
		}

		$i++;
		$oldPoint = $row["points"];
		$updatejoueur = "UPDATE historic_rang 
					SET
					rang = $rang
					WHERE id_owner = $id_joueur AND type = 'femme' AND date = '$dateCurrent'";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}
	}

		$qry = "SELECT sum(classements.points) as total
	FROM `joueurs` 
	LEFT JOIN `historic_rang` classements ON `classements`.`id_owner` = `joueurs`.`id_joueur` AND `classements`.`type` = 'general' AND classements.date = '$dateCurrent'
	GROUP BY `equipe`
	ORDER BY total DESC";

	$result = mysqli_query($con, $qry);
	$i = 1;
	$oldPoint = -1;
	$oldRang = 0;
	while ($row = mysqli_fetch_array($result )) 
	{
		$id = $row["id"];
		if ($row["total"] == $oldPoint)
		{
			$rang = $oldRang;
		}
		else
		{
			$oldRang = $i;
			$rang = $i;
		}
		$points_equipe = $row["total"];
		
		$i++;
		$oldPoint = $row["total"];
		$updatejoueur = "INSERT INTO historic_rang  
					VALUES ('equipe', $id, '$dateCurrent', $rang, $points_equipe)";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}
	}
	$dateCurrent = date('Y/m/d', strtotime($dateCurrent. ' + 1 days'));
}

	return;
?>