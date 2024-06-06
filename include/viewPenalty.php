<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

$qryBonus = "SELECT pbr.penalty_score FROM  pronostics_bonus_result pbr";
$resultBonus = mysqli_query($con, $qryBonus);
$findBonus = false;

echo '<div class="small-widget-content">';

$i = 0;

while ($rowBonus = mysqli_fetch_array($resultBonus )) 
{	
	$penalty_score = intval ($rowBonus["penalty_score"]);

	echo '<div class="totalbut-content">';	
		echo '<div class="totalbut-content-but">';	
			echo '<div><span class="totalbut">'.$penalty_score . ' </span><span class="totatbutsmall"> penalty</span></div>';
			
			// echo '<div><span class="totalbutmoyenne">'.$moyenne . ' </span><span class="totatbutsmallmoyenne">buts/matches</span></div>';
		echo '</div>';
		echo '<div class="totalbut-content-list">';
			$qryJoueur = "SELECT j.id_joueur, j.surnom, j.image, pb.penalty
					FROM  pronostics_bonus pb      
					join joueurs j on j.id_joueur = pb.id_joueur
					ORDER BY ABS(pb.penalty - $penalty_score) ASC";
			$resultJoueur = mysqli_query($con, $qryJoueur);
			$value = "";
			while ($rowJoueur = mysqli_fetch_array($resultJoueur )) 
			{	
				if ($value == "" || $value == $rowJoueur["penalty"]) {
					$value = $rowJoueur["penalty"];
					echo '<div class="totalbutwinner-joueur">';
					echo $rowJoueur["surnom"];
					echo '</div>';
					echo '<div class="totalbutwinner-totalbyt">';
					echo $rowJoueur["penalty"];
					echo ' p.</div>';	
				}
			}

		echo '</div>';
	
	echo '</div>';
	
	}
echo '</div>';

?>