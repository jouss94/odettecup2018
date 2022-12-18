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
				Left JOIN joueurs ON pronostics.id_membre = joueurs.id_joueur
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

		$nb_perf_montagne = 0;
		$nb_correctPlus_montagne = 0;
		$nb_correct_montagne = 0;
		$nb_inverse_montagne = 0;
		$nb_echec_montagne = 0;
		$total_montagne = 0;
		$points_montagne = 0;

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
				// if ($pronos_away == $score_away || $pronos_home == $score_home) // CORRECT+
				// {
				// 	$pointMacht = 4;
				// 	$nb_correctPlus++;
				// 	$points += $pointMacht;
				// }
				// else
				// {
					$pointMacht = 3;
					$nb_correct++;
					$points += $pointMacht;					
				// }
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

			if ($id_match == 64)
			{
				$pointMacht = $pointMacht * 2;
			}


			$update = "UPDATE pronostics SET point   = $pointMacht WHERE id_pronostic = $id_pronostic";
			$result3 = mysqli_query($con, $update);
			if (!$result3) {
				echo 'ERROR REQUETE : ', $update, '</br>';
			}
		}

		// BONUS

		/// VALEUR A MODIFIER
		$first_but_result = 16;
		$last_but_result = 118;
		$total_but_result = 172;
		$best_scorer_result = "Mbappe";
		$player_win_result = 9;

		$teams_dict_result = null;

		$teams_dict_result = [
			5 => 1, // Angleterre
			9 => 11, // Argentine
			13 => 6, // France
			14 => -3, // Danemark
			17 => 0, // Espagne
			18 => -3, // Allemagne
			25 => 1, // Brésil
			29 => 1  // Portugal
		];
 
		$qryBonus = "SELECT * 
				FROM pronostics_bonus
				Left JOIN joueurs ON pronostics_bonus.id_membre = joueurs.id_joueur
				WHERE joueurs.id_joueur = $id_joueur;";
		$resultBonus = mysqli_query($con, $qryBonus);

		$ptsFirstMin = 'null';
		$ptsLastMin = 'null';
		$ptsTotalBut = 'null';
		$ptsPlayerWinner = 'null';
		$ptsBestScorer = 'null';
		$ptsTeamWinner = 'null';

		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{
			// Premier but 
			if ($first_but_result != -1)
			{
				$ptsFirstMin = 0;
	
				if (intval($rowBonus["min_first"]) >= $first_but_result - 2 && intval($rowBonus["min_first"]) <= $first_but_result + 2)
				{
					$ptsFirstMin = 5;
				}
			}

			// Dernier but
			if ($last_but_result != -1)
			{
				$ptsLastMin = 0;

				if (intval($rowBonus["min_last"]) >= $last_but_result - 2 && intval($rowBonus["min_last"]) <= $last_but_result + 2)
				{
					$ptsLastMin = 5;
				}
			}

			// Total but
			if ($total_but_result != -1)
			{
				$ptsTotalBut = 0;
	
				if (intval($rowBonus["total_but"]) >= $total_but_result - 3 && intval($rowBonus["total_but"]) <= $total_but_result + 3)
				{
					$ptsTotalBut = 5;
				}
			}

			// Joueur gagnant
			if ($player_win_result != -1)
			{
				$ptsPlayerWinner = 0;

				if (intval($rowBonus["player_winner_id"]) == $player_win_result)
				{
					$ptsPlayerWinner = 5;
				}
			}

			// Meilleur buteur
			if ($best_scorer_result != "")
			{
				$ptsBestScorer = 0;
			
				if ($rowBonus["best_scorer"] == $best_scorer_result)
				{
					$ptsBestScorer = 5;
				}
			}
				
			// Equipe favorite
			if ($teams_dict_result != null)
			{
				$ptsTeamWinner = $teams_dict_result[intval($rowBonus["team_winner_id"])];
			}


			$bonus = intval($ptsFirstMin) + intval($ptsTeamWinner) + intval($ptsLastMin) + intval($ptsTotalBut) + intval($ptsPlayerWinner) + intval($ptsBestScorer);
		}

		$points += $bonus;
		$updateBonus = "UPDATE pronostics_bonus 
					SET
						 min_first_point   = $ptsFirstMin,
						 team_winner_id_point = $ptsTeamWinner,
		 				 min_last_point = $ptsLastMin,
						 total_but_point = $ptsTotalBut,
						 player_winner_point = $ptsPlayerWinner,
						 best_scorer_point = $ptsBestScorer 
					WHERE id_membre = $id_joueur";
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



	$qry = "SELECT * from joueurs 
			LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
			ORDER BY points DESC, bonus ASC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, nb_inverse DESC, surnom;";
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
?>