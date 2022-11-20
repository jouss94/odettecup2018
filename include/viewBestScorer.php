<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

$qryBonus = "SELECT `id_joueur`, `name`, `nb_but` FROM `best_scorer` ORDER BY nb_but DESC LIMIT 0, 3;";
$resultBonus = mysqli_query($con, $qryBonus);
$findBonus = false;

echo '<div class="small-widget-content">';

$i = 0;

while ($rowBonus = mysqli_fetch_array($resultBonus )) 
{	
	$name = $rowBonus["name"];
	$nb_but = intval ($rowBonus["nb_but"]);

	echo '<div class="scorers">';
		echo '<span class="scorer_name">'.++$i . ' - <strong>'.$name .'</strong></span>';
		echo '<span class="scorer_nb">'.$nb_but .' b.</span>';

	echo '</div>';
}

echo '</div>';

?>