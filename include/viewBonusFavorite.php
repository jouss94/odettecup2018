<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

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

$qryBonus = "SELECT *, equipe_winner.name as equipe_w, joueurs.surnom as joueur, joueurs_w.surnom as joueur_w, equipe_winner.logo as logo
		FROM pronostics_bonus
		LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = pronostics_bonus.team_winner_id
		LEFT JOIN joueurs joueurs ON joueurs.id_joueur = pronostics_bonus.id_membre
		LEFT JOIN joueurs joueurs_w ON joueurs_w.id_joueur = pronostics_bonus.player_winner_id
		ORDER BY joueur;";
$resultBonus = mysqli_query($con, $qryBonus);
$findBonus = false;

echo '<table class="affPronosTableau">';

$i = 0;

while ($rowBonus = mysqli_fetch_array($resultBonus )) 
{	
	$findBonus = true;
	$team_winner_id = utf8_encode_function($rowBonus["equipe_w"]);
	$surnom = utf8_encode_function($rowBonus["joueur"]);
	$player_winner_id = utf8_encode_function($rowBonus["joueur_w"]);
	$min_first = $rowBonus["min_first"];
	$min_last = $rowBonus["min_last"];
	$total_but = $rowBonus["total_but"];
	$best_scorer = utf8_encode_function($rowBonus["best_scorer"]);

	$team_winner_id_point_value = $rowBonus["team_winner_id_point"];
	$team_winner_id_point = intval ($rowBonus["team_winner_id_point"]);
	$player_winner_point_value = $rowBonus["player_winner_point"];
	$player_winner_point = intval ($rowBonus["player_winner_point"]);
	$min_first_point_value = $rowBonus["min_first_point"];
	$min_first_point = intval ($rowBonus["min_first_point"]);
	$min_last_point_value = $rowBonus["min_last_point"];
	$min_last_point = intval ($rowBonus["min_last_point"]);
	$total_but_point_value = $rowBonus["total_but_point"];
	$total_but_point = intval ($rowBonus["total_but_point"]);
	$best_scorer_point_value = $rowBonus["best_scorer_point"];	
	$best_scorer_point = intval ($rowBonus["best_scorer_point"]);	 

	$logo = $rowBonus["logo"];

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
			echo '<span class="';
			if ($team_winner_id_point_value != null)
			{
				if ($team_winner_id_point == 0 || $team_winner_id_point == -3)
					echo ' pancarteBonusEchec ';
				else
					echo ' pancarteBonusCorrect ';
			}
			else
					echo ' pancarteAuto ';
			echo ' "  > ';
			echo $team_winner_id;
			

			
			echo '</span> ';
			echo '<img class="logoEquipeSmall" src="';
			echo $logo;	
			echo '" />';
		echo '</td>';
		echo '<td class="pointBonusView ';
		if ($team_winner_id_point_value != null)
		{
			if ($team_winner_id_point > 0)
			{
				echo 'classTRCorrectHome"> +';
			}
			else {
				echo 'classTREchecHome">';
			}
			echo $team_winner_id_point;
		}
		else {
			echo '">';
		}
		echo '</td>';

	echo '</tr>';
}
echo '</table>';



?>