<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

echo '<div class="small-widget-content">';
echo '<div class="minute">Premier but : <strong>16\'</strong></div>
	<div class="minute">Dernier but : <strong>118\'</strong></div>';
	echo '</div>';

?>