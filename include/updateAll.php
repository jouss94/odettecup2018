<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$qryBonusValues = "SELECT * FROM pronostics_bonus_result";
	$resultBonus = mysqli_query($con, $qryBonusValues);
	$find = false;

	while ($resultBonusValues = mysqli_fetch_array($resultBonus )) 
	{
		$min_first = utf8_encode_function($resultBonusValues["min_first"]);		
		$min_first_activated = $resultBonusValues["min_first_activated"];

		$min_last = utf8_encode_function($resultBonusValues["min_last"]);		
		$min_last_activated = $resultBonusValues["min_last_activated"];

		$total_but = utf8_encode_function($resultBonusValues["total_but"]);		
		$total_but_activated = $resultBonusValues["total_but_activated"];

		$fairplay_score = utf8_encode_function($resultBonusValues["fairplay_score"]);		
		$fairplay_activated = $resultBonusValues["fairplay_activated"];

		$penalty_score = utf8_encode_function($resultBonusValues["penalty_score"]);		
		$penalty_activated = $resultBonusValues["penalty_activated"];

		$but_edf_score = utf8_encode_function($resultBonusValues["but_edf_score"]);		
		$but_edf_activated = $resultBonusValues["but_edf_activated"];

		$team_final_1_id = utf8_encode_function($resultBonusValues["team_final_1_id"]);		
		$team_final_1_activated = $resultBonusValues["team_final_1_activated"];

		$team_final_2_id = utf8_encode_function($resultBonusValues["team_final_2_id"]);		
		$team_final_2_activated = $resultBonusValues["team_final_2_activated"];
	}

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
			else if ($score_home == $pronos_away && $pronos_home == $score_away) // INVERSE
			{
				$pointMacht = 1;
				$nb_inverse++;
				$points += $pointMacht;					
			}
			else // ECHEC
			{
				$pointMacht = 0;
				$nb_echec++;
				$points += $pointMacht;									
			}

			$update = "UPDATE pronostics SET point = $pointMacht WHERE id_pronostic = $id_pronostic";
			$result3 = mysqli_query($con, $update);
			if (!$result3) {
				echo 'ERROR REQUETE : ', $update, '</br>';
			}
		}

		// BONUS
 
		$qryBonus = "SELECT * 
				FROM pronostics_bonus
				Left JOIN joueurs ON pronostics_bonus.id_joueur = joueurs.id_joueur
				WHERE joueurs.id_joueur = $id_joueur;";
		$resultBonus = mysqli_query($con, $qryBonus);

		$ptsFirstMin = 'null';
		$ptsLastMin = 'null';
		$ptsTotalBut = 'null';
		$ptsFairplay = 'null';
		$ptsPenalty = 'null';
		$ptsButEdf = 'null';
		$ptsTeamFinal1 = 'null';
		$ptsTeamFinal2 = 'null';

		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{
			$idJoueur = $rowBonus["id_joueur"];
			// Premier but 
			if ($min_first_activated == 1)
			{
				$ptsFirstMin = 0;

				$value = null;

				$getCloserPlayerFirstMinuteResultList = GetCloserPlayerFirstMinute($con, $rowBonus["competition"]);
				if (in_array($idJoueur, $getCloserPlayerFirstMinuteResultList)) {
					$ptsFirstMin += 4;
					if ($min_first == $rowBonus["min_first"])
					{
						$ptsFirstMin += 3;
					}
					// echo $idJoueur;
					// echo " id joueur =  ";
					// echo $ptsFirstMin;
					// echo "points ";
				}
			}

			if ($min_last_activated == 1)
			{
				$ptsLastMin = 0;

				$value = null;

				$getCloserPlayerLastMinuteResultList = GetCloserPlayerLastMinute($con, $rowBonus["competition"]);
				if (in_array($idJoueur, $getCloserPlayerLastMinuteResultList)) {
					$ptsLastMin += 4;
					if ($min_last == $rowBonus["min_last"])
					{
						$ptsLastMin += 3;
					}
					// echo $idJoueur;
					// echo " id joueur =  ";
					// echo $ptsLastMin;
					// echo "points ";
				}
			}

			if ($total_but_activated == 1)
			{
				$ptsTotalBut = 0;

				$value = null;

				$getCloserPlayerTotalButResultList = GetCloserPlayerTotalBut($con, $rowBonus["competition"]);
				if (in_array($idJoueur, $getCloserPlayerTotalButResultList)) {
					$ptsTotalBut += 4;
					if ($total_but == $rowBonus["total_but"])
					{
						$ptsTotalBut += 3;
					}
					// echo $idJoueur;
					// echo " id joueur =  ";
					// echo $ptsTotalBut;
					// echo "points ";
				}
			}

			if ($fairplay_activated == 1)
			{
				$ptsFairplay = 0;

				$value = null;

				$getCloserPlayerFairplayResultList = GetCloserPlayerFairplay($con, $rowBonus["competition"]);
				if (in_array($idJoueur, $getCloserPlayerFairplayResultList)) {
					$ptsFairplay += 4;
					if ($fairplay_score == $rowBonus["fairplay"])
					{
						$ptsFairplay += 3;
					}
					// echo $idJoueur;
					// echo " id joueur =  ";
					// echo $ptsFairplay;
					// echo "points ";
				}
			}

			if ($penalty_activated == 1)
			{
				$ptsPenalty = 0;

				$value = null;

				$getCloserPlayerPenaltyResultList = GetCloserPlayerPenalty($con, $rowBonus["competition"]);
				if (in_array($idJoueur, $getCloserPlayerPenaltyResultList)) {
					$ptsPenalty += 4;
					if ($penalty_score == $rowBonus["penalty"])
					{
						$ptsPenalty += 3;
					}
					// echo $idJoueur;
					// echo " id joueur =  ";
					// echo $ptsPenalty;
					// echo "points ";
				}
			}

			if ($but_edf_activated == 1)
			{
				$ptsButEdf = 0;

				$value = null;

				$getCloserPlayerButEdfResultList = GetCloserPlayerButEdf($con, $rowBonus["competition"]);
				if (in_array($idJoueur, $getCloserPlayerButEdfResultList)) {
					if ($but_edf_score == $rowBonus["but_edf"])
					{
						$ptsButEdf += 5;
					}
					// echo $idJoueur;
					// echo " id joueur =  ";
					// echo $ptsButEdf;
					// echo "points ";
				}
			}

			
			if ($team_final_1_activated == 1)
			{
				$ptsTeamFinal1 = 0;

				if ($team_final_1_id == $rowBonus["team_final_1_id"])
				{
					$ptsTeamFinal1 += 4;
				}
				
				// echo $idJoueur;
				// echo " id joueur =  ";
				// echo $ptsTeamFinal1;
				// echo "points ";
			}

			if ($team_final_2_activated == 1)
			{
				$ptsTeamFinal2 = 0;

				if ($team_final_2_id == $rowBonus["team_final_2_id"])
				{
					$ptsTeamFinal2 += 4;
				}
				
				// echo $idJoueur;
				// echo " id joueur =  ";
				// echo $ptsTeamFinal1;
				// echo "points ";
			}

			if ($team_final_2_activated == 1 && $team_final_1_activated == 1)
			{
				if ($team_final_2_id == $rowBonus["team_final_2_id"] && $team_final_1_id == $rowBonus["team_final_1_id"])
				{
					$ptsTeamFinal2 += 1;
					$ptsTeamFinal1 += 1;
				}
				
				// echo $idJoueur;
				// echo " id joueur =  ";
				// echo $ptsTeamFinal1;
				// echo "points ";
			}
			

			$bonus = intval($ptsFirstMin) + intval($ptsLastMin) + intval($ptsTotalBut) + intval($ptsFairplay) + intval($ptsPenalty) + intval($ptsButEdf) + intval($ptsTeamFinal1) + intval($ptsTeamFinal2);
		}

		$points += $bonus;
		$updateBonus = "UPDATE pronostics_bonus 
					SET
						 min_first_point   = $ptsFirstMin,
		 				 min_last_point = $ptsLastMin,
						 total_but_point = $ptsTotalBut,
						 fairplay_point = $ptsFairplay,
						 penalty_point = $ptsPenalty,
						 but_edf_point = $ptsButEdf,
						 team_final_1_point = $ptsTeamFinal1,
						 team_final_2_point = $ptsTeamFinal2
					WHERE id_joueur = $id_joueur";
		$resultBonus = mysqli_query($con, $updateBonus);
		if (!$resultBonus) {
			echo 'ERROR REQUETE : ', $updateBonus, '</br>';
		}


		$updatejoueur = "UPDATE classements 
					SET
						 points   = $points, 
						 nb_perf   = $nb_perf,
						 nb_correct_plus   = $nb_correctPlus,
						 nb_correct   = $nb_correct,
						 nb_inverse   = $nb_inverse,
						 nb_echec   = $nb_echec,
						 bonus = $bonus
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

		// TODO CHANGEMENT DE REGLE !!!
		$qry = "SELECT * from joueurs 
				LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
				WHERE joueurs.competition = $competitionId
				ORDER BY points DESC, bonus ASC, (nb_perf + nb_correct_plus + nb_correct) DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, nb_inverse DESC, surnom;";
		$result = mysqli_query($con, $qry);
		$i = 1;
		$oldPoint = -1;
		$oldRang = 0;
		while ($row = mysqli_fetch_array($result )) 
		{
			$id_joueur = $row["id_joueur"];
			// if ($row["points"] == $oldPoint)
			// {
			// 	$rang = $oldRang;
			// }
			// else
			// {
			// 	$oldRang = $i;
				$rang = $i;
			// }
	
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