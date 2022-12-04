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
	
	echo '<div><span class="totalbut">'.$but_number . ' </span><span class="totatbutsmall">buts</span></div>';
	
	echo '<div><span class="totalbutmoyenne">'.$moyenne . ' </span><span class="totatbutsmallmoyenne">buts/matches</span></div>';
}
echo '</div>';

?>