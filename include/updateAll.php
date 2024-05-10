<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$playoff_days = getPlayoffDays($con, $competition);

	$qry = "SELECT * FROM joueurs;";
	$result = mysqli_query($con, $qry);
	while ($row = mysqli_fetch_array($result )) 
	{
		$id_joueur = intval($row["id_joueur"]);
	
		$qry2 = "SELECT * 
				FROM pronostics  
				Left JOIN joueurs ON pronostics.id_joueur = joueurs.id_joueur
				Left JOIN matches ON pronostics.id_match = matches.id_match
				WHERE joueurs.id_joueur = $id_joueur AND matches.played = 1;";
		$result2 = mysqli_query($con, $qry2);

		$nb_perf = 0;
		$nb_correctPlus = 0;
		$nb_correct = 0;
		$nb_inverse = 0;
		$nb_echec = 0;
		$total = 0;
		$points = 0;
		$bonus = 0;

		while ($row2 = mysqli_fetch_array($result2 )) 
		{
			$id_match = intval($row2["id_match"]);
			$pronos_home = intval($row2["prono_home"]);
			$pronos_away = intval($row2["prono_away"]);
			$score_home = intval($row2["score_home"]);
			$score_away = intval($row2["score_away"]);
			$day = intval($row2["day"]);
			$id_pronostic = $row2["id_pronostic"];
			$pointMacht = 0;
			$total++;

			$isPlayoff = false;
			if (in_array($day,  $playoff_days)) {
				$isPlayoff = true;
			}

			if ($score_home == $pronos_home && $score_away == $pronos_away) // PERFECT
			{
				$pointMacht = 7;
				if (!$isPlayoff) {
					$nb_perf++;
					$points += $pointMacht;
				}
			}
			else if (
						(($pronos_away - $pronos_home) > 0 && ($score_away - $score_home) > 0) 
						|| (($pronos_away - $pronos_home) < 0 && ($score_away - $score_home) < 0) 
						|| (($pronos_away - $pronos_home) == 0 && ($score_away - $score_home) == 0) 
					) // CORRECT
			{
				if ($pronos_home - $pronos_away == $score_home - $score_away) // CORRECT+
				{
					$pointMacht = 4;	
					if (!$isPlayoff) {
						$nb_correctPlus++;
						$points += $pointMacht;
					}
				}
				else
				{
					$pointMacht = 3;
					
					if (!$isPlayoff) {
						$nb_correct++;
						$points += $pointMacht;
					}					
				}
			}
			else
			{
				$pointMacht = 0;
				
				if (!$isPlayoff) {
					$nb_echec++;
					$points += $pointMacht;
				}									
			}

			$update = "UPDATE pronostics SET point = $pointMacht WHERE id_pronostic = $id_pronostic";
			$result3 = mysqli_query($con, $update);
			if (!$result3) {
				echo 'ERROR REQUETE : ', $update, '</br>';
			}
		}

		$updatejoueur = "UPDATE classements 
					SET
						 points   = $points, 
						 nb_perf   = $nb_perf,
						 nb_correct_plus   = $nb_correctPlus,
						 nb_correct   = $nb_correct,
						 nb_inverse   = $nb_inverse,
						 nb_echec   = $nb_echec
					WHERE owner_id = $id_joueur AND type = 'general'";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}
	}

	$qryCompetition = "SELECT * FROM competition";
	$resultCompetition = mysqli_query($con, $qryCompetition);
	while ($rowCompetition = mysqli_fetch_array($resultCompetition )) 
	{
		$competitionId = $rowCompetition["id"];

		$qry = "SELECT * from joueurs 
				LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur
				WHERE joueurs.competition = $competitionId
				ORDER BY points DESC, (nb_perf + nb_correct_plus + nb_correct) DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, surnom;";
		$result = mysqli_query($con, $qry);
		$i = 1;
		$oldPoint = -1;
		while ($row = mysqli_fetch_array($result )) 
		{
			$id_joueur = $row["id_joueur"];
			$rang = $i;
	
			$i++;
			$oldPoint = $row["points"];
			$updatejoueur = "UPDATE classements 
						SET
						rang = $rang
						WHERE owner_id = $id_joueur AND type = 'general'";
	
			$result4 = mysqli_query($con, $updatejoueur);
			if (!$result4) {
				echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
			}
		}
	}

	foreach ($playoff_days as $playoff) 
	{
		$qry = "SELECT playoffs.id, sum(pronos_home.point) as score_home
		FROM playoffs
		
		LEFT JOIN joueurs joueurs_home on playoffs.id_equipe_home = joueurs_home.id_joueur
		LEFT JOIN pronostics pronos_home on playoffs.id_equipe_home = pronos_home.id_joueur
		LEFT JOIN matches matches_home on matches_home.id_match = pronos_home.id_match  
		
		WHERE playoffs.competition = $competition and playoffs.day = $playoff AND matches_home.day = $playoff AND matches_home.played = 1 AND matches_home.reporte = 0
		GROUP BY playoffs.id";
		$result = mysqli_query($con, $qry);

		while ($row = mysqli_fetch_array($result )) 
		{
			$id = $row["id"];
			$score_home = $row["score_home"];

			$qry2 = " UPDATE `playoffs` 
			SET 
				score_home=$score_home
				WHERE id=$id
				;";

			$subResult = mysqli_query($con, $qry2);

			echo $qry . '<br>';

			if (!$subResult) {
				echo 'Error SQL';
			}
		}

		$qry = "SELECT playoffs.id, sum(pronos_ext.point) as score_ext
		FROM playoffs
		
		LEFT JOIN joueurs joueurs_ext on playoffs.id_equipe_ext = joueurs_ext.id_joueur
		LEFT JOIN pronostics pronos_ext on playoffs.id_equipe_ext = pronos_ext.id_joueur
		LEFT JOIN matches matches_ext on matches_ext.id_match = pronos_ext.id_match 
		
		WHERE playoffs.competition = $competition and playoffs.day = $playoff AND matches_ext.day = $playoff AND matches_ext.played = 1 AND matches_ext.reporte = 0
		GROUP BY playoffs.id";
		$result = mysqli_query($con, $qry);

		while ($row = mysqli_fetch_array($result )) 
		{
			$id = $row["id"];
			$score_ext = $row["score_ext"];

			$qry2 = " UPDATE `playoffs` 
			SET 
				score_away=$score_ext
				WHERE id=$id
				;";

			$subResult = mysqli_query($con, $qry2);

			echo $qry . '<br>';

			if (!$subResult) {
				echo 'Error SQL';
			}
		}
	}
?>