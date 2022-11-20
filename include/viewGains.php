<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

echo '<div class="small-widget-content">';

	echo '<div class="gain">';
		echo '<span class="gain_name"><strong>1er</strong></span>';
		echo '<span class="gain_nb">154 €</span>';
	echo '</div>';
	echo '<div class="gain">';
		echo '<span class="gain_name"><strong>2eme</strong></span>';
		echo '<span class="gain_nb">84 €</span>';
	echo '</div>';
	echo '<div class="gain">';
		echo '<span class="gain_name"><strong>3eme</strong></span>';
		echo '<span class="gain_nb">42 €</span>';
	echo '</div>';
echo '</div>';

?>