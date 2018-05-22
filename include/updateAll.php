<?php

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
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

		$bonusFinal = 0;

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

			if ($score_home == $pronos_home && $score_away == $pronos_away)
			{
				$pointMacht = 7;
				$nb_perf++;
				$points += $pointMacht;
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
				}
				else
				{
					$pointMacht = 3;
					$nb_correct++;
					$points += $pointMacht;					
				}
			}
			else if ($score_home == $pronos_away && $pronos_home == $score_away)
			{
				$pointMacht = 1;
				$nb_inverse++;
				$points += $pointMacht;					
			}
			else
			{
				$pointMacht = 0;
				$nb_echec++;
				$points += $pointMacht;									
			}

			if ($id_match == 52)
				$bonusFinal = $pointMacht;


			$update = "UPDATE pronostics SET point   = $pointMacht WHERE id_pronostic = $id_pronostic";
			$result3 = mysqli_query($con, $update);
			if (!$result3) {
				echo 'ERROR REQUETE : ', $update, '</br>';
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
		$ptsFirstButeurFrance = 0;
		$ptsTeamWinner = 0;
		$ptsTeamAttaque = 0;
		$ptsTeamDefence = 0;
		$ptsLastMin = 0;
		$ptsTotalBut = 0;
		$ptsButeur = 0;
		$ptsPasseur = 0;
		$ptsNombreButButeur = 0;
		$ptsNombreButFrance = 0;
		// + autre

		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{
			// regles a implémenter


			$bonus = $ptsFirstMin + $ptsFirstButeurFrance + $ptsTeamWinner + $ptsTeamAttaque + $ptsTeamDefence + $ptsLastMin + $ptsTotalBut +
					 $ptsButeur + $ptsPasseur + $ptsNombreButButeur + $ptsNombreButFrance + $bonusFinal; // + + +
		}

		$points += $bonus;
		// $updateBonus = "UPDATE pronostics_bonus 
		// 			SET
		// 				 min_first_point   = $ptsFirstMin, 
		// 				 team_winner_id_point = $ptsTeamWinner,
		// 				 min_last_point = $ptsLastMin,
		// 				 total_but_point = $ptsTotalBut
		// 			WHERE id_membre = $id_joueur";
		// $resultBonus = mysqli_query($con, $updateBonus);
		// if (!$resultBonus) {
		// 	echo 'ERROR REQUETE : ', $updateBonus, '</br>';
		// }



		// $updatejoueur = "UPDATE joueurs 
		// 			SET
		// 				 points   = $points, 
		// 				 nb_perf   = $nb_perf,
		// 				 nb_correct_plus   = $nb_correctPlus,
		// 				 nb_correct   = $nb_correct,
		// 				 nb_inverse   = $nb_inverse,
		// 				 nb_echec   = $nb_echec,
		// 				 bonus = $bonus
		// 			WHERE id_joueur = $id_joueur";
		// $result4 = mysqli_query($con, $updatejoueur);
		// if (!$result4) {
		// 	echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		// }

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

		$updatejoueur = "UPDATE classements 
					SET
						 points   = $points_montagne, 
						 nb_perf   = $nb_perf_montagne,
						 nb_correct_plus   = $nb_correctPlus_montagne,
						 nb_correct   = $nb_correct_montagne,
						 nb_inverse   = $nb_inverse_montagne,
						 nb_echec   = $nb_echec_montagne
					WHERE owner_id = $id_joueur AND type = 'montagne'";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}


		if (intval($row["female"]) == 1)
		{
			$updatejoueur = "UPDATE classements 
			SET
				 points   = $points, 
				 nb_perf   = $nb_perf,
				 nb_correct_plus   = $nb_correctPlus,
				 nb_correct   = $nb_correct,
				 nb_inverse   = $nb_inverse,
				 nb_echec   = $nb_echec,
				 bonus = $bonus
			WHERE owner_id = $id_joueur AND type = 'femme'";
			$result4 = mysqli_query($con, $updatejoueur);
			if (!$result4) {
				echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
			}
		}

	}



	$qry = "SELECT * from joueurs ORDER BY points DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
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
		$updatejoueur = "UPDATE joueurs 
					SET
						 rang = $rang
					WHERE id_joueur = $id_joueur";
		$result4 = mysqli_query($con, $updatejoueur);
		if (!$result4) {
			echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		}
	}

?>