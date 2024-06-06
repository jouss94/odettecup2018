<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

$qryBonus = "SELECT 
	SUM(score_home + score_away) as buts, 
	SUM(score_home + score_away) / Count(*) moyenne, 
	ROUND(SUM(score_home + score_away) / Count(*) * 64) prevision  
	FROM `matches` WHERE played = 1";
$resultBonus = mysqli_query($con, $qryBonus);
$findBonus = false;

echo '<div class="small-widget-content">';

$i = 0;

while ($rowBonus = mysqli_fetch_array($resultBonus )) 
{	
	$but_number = intval ($rowBonus["buts"]);
	$moyenne = $rowBonus["moyenne"];



	echo '<div class="totalbut-content">';	
		echo '<div class="totalbut-content-but">';	
			echo '<div><span class="totalbut">'.$but_number . ' </span><span class="totatbutsmall">buts</span></div>';
			
			// echo '<div><span class="totalbutmoyenne">'.$moyenne . ' </span><span class="totatbutsmallmoyenne">buts/matches</span></div>';
		echo '</div>';
		echo '<div class="totalbut-content-list">';
			$qryJoueur = "SELECT j.id_joueur, j.surnom, j.image, pb.total_but
					FROM  pronostics_bonus pb      
					join joueurs j on j.id_joueur = pb.id_joueur
					ORDER BY ABS(pb.total_but - $but_number) ASC";
			$resultJoueur = mysqli_query($con, $qryJoueur);
			$value = "";
			while ($rowJoueur = mysqli_fetch_array($resultJoueur )) 
			{	
				if ($value == "" || $value == $rowJoueur["total_but"]) {
					$value = $rowJoueur["total_but"];
					echo '<div class="totalbutwinner-joueur">';
					echo $rowJoueur["surnom"];
					echo '</div>';
					echo '<div class="totalbutwinner-totalbyt">';
					echo $rowJoueur["total_but"];
					echo ' Buts</div>';	
				}
			}

		echo '</div>';
	
	echo '</div>';
	
	}
echo '</div>';

?>