<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

$team_winner_id = "";
$min_first = "";
$min_last = "";
$total_but = "";
$best_scorer = "";

$team_winner_id_point = -1;
$min_first_point = -1;
$min_last_point = -1;
$total_but_point = -1;
$best_scorer_point = -1;

$qryBonus = "SELECT *, equipe_winner_1.name as equipe_w_1, equipe_winner_2.name as equipe_w_2, joueurs.surnom as joueur, equipe_winner_1.logo as logo_1, equipe_winner_2.logo as logo_2
		FROM pronostics_bonus
		LEFT JOIN equipes equipe_winner_1 ON equipe_winner_1.id_equipe = pronostics_bonus.team_final_1_id
		LEFT JOIN equipes equipe_winner_2 ON equipe_winner_2.id_equipe = pronostics_bonus.team_final_2_id
		LEFT JOIN joueurs joueurs ON joueurs.id_joueur = pronostics_bonus.id_joueur
		WHERE joueurs.competition = $competition
		ORDER BY joueur;";
$resultBonus = mysqli_query($con, $qryBonus);
$findBonus = false;

echo '<table class="affPronosTableau">';

$i = 0;

while ($rowBonus = mysqli_fetch_array($resultBonus )) 
{	
	$findBonus = true;
	$team_final_1_name = utf8_encode_function($rowBonus["equipe_w_1"]);
	$team_final_2_name = utf8_encode_function($rowBonus["equipe_w_2"]);
	$logo_1 = $rowBonus["logo_1"];
	$logo_2 = $rowBonus["logo_2"];
	$surnom = utf8_encode_function($rowBonus["joueur"]);

	$team_final_1_id = $rowBonus["team_final_1_id"];
	$team_final_1_point = $rowBonus["team_final_1_point"];
	$team_final_2_id = $rowBonus["team_final_2_id"];
	$team_final_2_point = $rowBonus["team_final_2_point"];


	if ($i++ % 2 == 0) {
		echo '<tr class="affPronosLigne backgroundTab1" >';
	}
	else {
		echo '<tr class="affPronosLigne backgroundTab2" >';
	}

		echo '<td style="" class="tdBonusCenter">';
		echo $surnom;
		echo '</td>';

		echo '<td >';
			echo '<img class="logoEquipeSmallBonus" src="';
			echo $logo_1;	
			echo '" />';
			echo '<span class="pancarteTeam pancarteAuto ';
			if ($team_final_1_point != null)
			{
				if (intval($team_final_1_point) == 0 || intval($team_final_1_point) == -3)
					echo ' pancarteBonusEchec ';
				else
					echo ' pancarteBonusCorrect ';
			}
			echo ' "  > ';
			echo $team_final_1_name;
			

			
			echo '</span> ';

			echo '- <span class="pancarteTeam pancarteAuto ';
			if ($team_final_2_point != null)
			{
				if (intval($team_final_2_point) == 0 || intval($team_final_2_point) == -3)
					echo ' pancarteBonusEchec ';
				else
					echo ' pancarteBonusCorrect ';
			}
			echo ' "  > ';
			echo $team_final_2_name;

			echo '</span> ';
			echo '<img class="logoEquipeSmallBonus" src="';
			echo $logo_2;	
			echo '" />';

			
			echo '</span> ';

		echo '</td>';
		echo '<td class="pointBonusView ';
		if ($team_final_1_point != null || $team_final_2_point != null)
		{
			if (intval($team_final_1_point) + intval($team_final_2_point) > 0)
			{
				echo 'classTRCorrectHome"> +';
			}
			else {
				echo 'classTREchecHome">';
			}
			echo intval($team_final_1_point) + intval($team_final_2_point);
		}
		else {
			echo '">';
		}
		echo '</td>';

	echo '</tr>';
}
echo '</table>';



?>