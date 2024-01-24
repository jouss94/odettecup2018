<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	parse_str($_SERVER["QUERY_STRING"], $query);
	$currentClassement = $query['ranking'];

	echo '<div class="uniqueClassement">',include "viewClassementGeneral.php",'</div>';

?>