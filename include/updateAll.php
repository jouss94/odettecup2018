<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

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
			$id_pronostic = $row2["id_pronostic"];
			$pointMacht = 0;
			$total++;

			if ($score_home == $pronos_home && $score_away == $pronos_away) // PERFECT
			{
				$pointMacht = 7;
				$nb_perf++;
				$points += $pointMacht;
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
					$nb_correctPlus++;
					$points += $pointMacht;
				}
				else
				{
					$pointMacht = 3;
					$nb_correct++;
					$points += $pointMacht;					
				}
			}
			else // ECHEC
			{
				$pointMacht = 0;
				$nb_echec++;
				$points += $pointMacht;									
			}

			// if ($id_match == 51) // TODO : VARIABILISE
			// {
			// 	$pointMacht = $pointMacht * 2;
			// }


			$update = "UPDATE pronostics SET point   = $pointMacht WHERE id_pronostic = $id_pronostic";
			$result3 = mysqli_query($con, $update);
			if (!$result3) {
				echo 'ERROR REQUETE : ', $update, '</br>';
			}
		}

		// BONUS
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
				LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
				WHERE joueurs.competition = $competitionId
				ORDER BY points DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, surnom;";
		$result = mysqli_query($con, $qry);
		$i = 1;
		$oldPoint = -1;
		$oldRang = 0;
		while ($row = mysqli_fetch_array($result )) 
		{
			$id_joueur = $row["id_joueur"];
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

?>