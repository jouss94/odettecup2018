<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

$qryBonus = "SELECT *, equipe_winner.name as equipe_w, joueurs.surnom as joueur, equipe_winner.logo as logo
		FROM pronostics_bonus
		LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = pronostics_bonus.team_winner_id
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
	$surnom = utf8_encode_function($rowBonus["joueur"]);
	
	$penalty = $rowBonus["penalty"];		 
	$penalty_point = $rowBonus["penalty_point"];	

	if ($i++ % 2 == 0) {
		echo '<tr class="affPronosLigne backgroundTab1" >';
	}
	else {
		echo '<tr class="affPronosLigne backgroundTab2" >';
	}

		echo '<td style="" class="tdBonusCenterSmall">';
		echo $surnom;
		echo '</td>';

		echo '<td style="text-align: end;">';
			echo '<span class="pancarteAuto ';
			if ($penalty_point != null)
			{
				if (intval($penalty_point) == 0 || intval($penalty_point) == -3)
					echo ' pancarteBonusEchec ';
				else
					echo ' pancarteBonusCorrect ';
			}
			echo ' "  > ';
			echo $penalty;
			

			
			echo '</span> ';

		echo '</td>';
		echo '<td class="pointBonusViewSmall ';
		if ($penalty_point != null)
		{
			if (intval($penalty_point) > 0)
			{
				echo 'classTRCorrectHome"> +';
			}
			else {
				echo 'classTREchecHome">';
			}
			echo $penalty_point;
		}
		else {
			echo '">';
		}
		echo '</td>';

	echo '</tr>';
}
echo '</table>';



?>