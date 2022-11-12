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
				// if ($pronos_away == $score_away || $pronos_home == $score_home)
				// {
				// 	$pointMacht = 4;
				// 	$nb_correctPlus++;
				// 	$points += $pointMacht;
				// 	if ($is_montagne) 
				// 	{
				// 		$nb_correctPlus_montagne++;
				// 	$points_montagne += $pointMacht;						
				// 	}
				// }
				// else
				// {
					$pointMacht = 3;
					$nb_correct++;
					$points += $pointMacht;					
					if ($is_montagne) 
					{
						$nb_correct_montagne++;
					$points_montagne += $pointMacht;					
						
					}
				// }
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
		$ptsTeamWinner = 0;
		$ptsLastMin = 0;
		$ptsTotalBut = 0;
		// + autre

		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{
			// regles a implémenter 
			if (intval($rowBonus["min_first"]) == 51)
			{
				$ptsFirstMin = 3;
			}
			
			if (intval($rowBonus["min_last"]) == 68)
			{
				$ptsLastMin = 3;
			}

			if (intval($rowBonus["total_but"]) == 141)
			{
				$ptsTotalBut = 5;
			}

			$bonus = $ptsFirstMin + $ptsTeamWinner + $ptsLastMin + $ptsTotalBut; // + + +
		}

		$points += $bonus;
		$updateBonus = "UPDATE pronostics_bonus 
					SET
						 min_first_point   = $ptsFirstMin,
						 team_winner_id_point = $ptsTeamWinner,
		 				 min_last_point = $ptsLastMin,
						 total_but_point = $ptsTotalBut
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

		// $updatejoueur = "UPDATE classements 
		// 			SET
		// 				 points   = $points_montagne, 
		// 				 nb_perf   = $nb_perf_montagne,
		// 				 nb_correct_plus   = $nb_correctPlus_montagne,
		// 				 nb_correct   = $nb_correct_montagne,
		// 				 nb_inverse   = $nb_inverse_montagne,
		// 				 nb_echec   = $nb_echec_montagne
		// 			WHERE owner_id = $id_joueur AND type = 'montagne'";
		// $result4 = mysqli_query($con, $updatejoueur);
		// if (!$result4) {
		// 	echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		// }


		// if (intval($row["female"]) == 1)
		// {
		// 	$updatejoueur = "UPDATE classements 
		// 	SET
		// 		 points   = $points, 
		// 		 nb_perf   = $nb_perf,
		// 		 nb_correct_plus   = $nb_correctPlus,
		// 		 nb_correct   = $nb_correct,
		// 		 nb_inverse   = $nb_inverse,
		// 		 nb_echec   = $nb_echec,
		// 		 bonus = $bonus
		// 	WHERE owner_id = $id_joueur AND type = 'femme'";
		// 	$result4 = mysqli_query($con, $updatejoueur);
		// 	if (!$result4) {
		// 		echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
		// 	}
		// }

	}



	$qry = "SELECT * from joueurs 
			LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
			ORDER BY points DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
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

	// $qry = "SELECT * from joueurs 
	// 		LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'montagne' 
	// 		ORDER BY points DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
	// $result = mysqli_query($con, $qry);
	// $i = 1;
	// $oldPoint = -1;
	// $oldRang = 0;
	// while ($row = mysqli_fetch_array($result )) 
	// {
	// 	$id_joueur = $row["id_joueur"];
	// 	if ($row["points"] == $oldPoint)
	// 	{
	// 		$rang = $oldRang;
	// 	}
	// 	else
	// 	{
	// 		$oldRang = $i;
	// 		$rang = $i;
	// 	}

	// 	$i++;
	// 	$oldPoint = $row["points"];
	// 	$updatejoueur = "UPDATE classements 
	// 				SET
	// 				rang = $rang
	// 				WHERE owner_id = $id_joueur AND type = 'montagne'";

	// 	$result4 = mysqli_query($con, $updatejoueur);
	// 	if (!$result4) {
	// 		echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
	// 	}
	// }


	// $qry = "SELECT * from joueurs 
	// 		LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'femme' 
	// 		ORDER BY points DESC, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
	// $result = mysqli_query($con, $qry);
	// $i = 1;
	// $oldPoint = -1;
	// $oldRang = 0;
	// while ($row = mysqli_fetch_array($result )) 
	// {
	// 	$id_joueur = $row["id_joueur"];
	// 	if ($row["points"] == $oldPoint)
	// 	{
	// 		$rang = $oldRang;
	// 	}
	// 	else
	// 	{
	// 		$oldRang = $i;
	// 		$rang = $i;
	// 	}

	// 	$i++;
	// 	$oldPoint = $row["points"];
	// 	$updatejoueur = "UPDATE classements 
	// 				SET
	// 				rang = $rang
	// 				WHERE owner_id = $id_joueur AND type = 'femme'";

	// 	$result4 = mysqli_query($con, $updatejoueur);
	// 	if (!$result4) {
	// 		echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
	// 	}
	// }

	// $qry = "SELECT sum(classements.points) as total, coequipiers.nom, coequipiers.id
	// 	,SUM(classements.nb_perf) as nb_perf
	// 	,SUM(classements.nb_correct_plus) as nb_correct_plus
	// 	,SUM(classements.nb_correct) as nb_correct
	// 	,SUM(classements.nb_inverse) as nb_inverse
	// 	,SUM(classements.nb_echec) as nb_echec
	// 	,SUM(classements.bonus) as bonus
	// FROM `joueurs` 
	// LEFT JOIN `classements` ON `classements`.`owner_id` = `joueurs`.`id_joueur` AND `classements`.`type` = 'general'
	// LEFT JOIN coequipiers ON coequipiers.id = joueurs.equipe
	// GROUP BY `equipe`
	// ORDER BY total DESC";

	// $result = mysqli_query($con, $qry);
	// $i = 1;
	// $oldPoint = -1;
	// $oldRang = 0;
	// while ($row = mysqli_fetch_array($result )) 
	// {
	// 	$id = $row["id"];
	// 	if ($row["total"] == $oldPoint)
	// 	{
	// 		$rang = $oldRang;
	// 	}
	// 	else
	// 	{
	// 		$oldRang = $i;
	// 		$rang = $i;
	// 	}
	// 	$points_equipe = $row["total"];

	// 	$nb_perf_equipe = intval($row["nb_perf"]);
	// 	$nb_correct_plus_equipe = intval($row["nb_correct_plus"]);
	// 	$nb_correct_equipe = intval($row["nb_correct"]);
	// 	$nb_inverse_equipe = intval($row["nb_inverse"]);
	// 	$nb_echec_equipe = intval($row["nb_echec"]);
	// 	$bonus_equipe = intval($row["bonus"]);
	// 	$total = $nb_perf_equipe + $nb_correct_plus_equipe + $nb_correct_equipe + $nb_inverse_equipe + $nb_echec_equipe;
		
	// 	$i++;
	// 	$oldPoint = $row["total"];
	// 	$updatejoueur = "UPDATE classements 
	// 				SET
	// 				points = $points_equipe,
	// 				rang = $rang,
	// 				bonus = $bonus_equipe,
	// 				nb_perf = $nb_perf_equipe,
	// 				nb_correct = $nb_correct_equipe,
	// 				nb_correct_plus = $nb_correct_plus_equipe,
	// 				nb_inverse = $nb_inverse_equipe,
	// 				nb_echec = $nb_echec_equipe
	// 				WHERE owner_id = $id AND type = 'equipe'";

	// 	$result4 = mysqli_query($con, $updatejoueur);
	// 	if (!$result4) {
	// 		echo 'ERROR REQUETE : ', $updatejoueur, '</br>';
	// 	}
	// }


?>