<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	$current_day_in_progress = $GLOBALS['current_day_in_progress'];
	if ($current_day_in_progress) {
		$current_day++;
	}


	require_once 'config.php';
	require_once 'functions.php';

	$idProfil = $_GET['id'];
?>
	<span class="listeJoueurTitre">Pronostics matches</span>
	
	<span class="RetourSpanContainer">
		<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
			Retour
		</button>
	</span>

	<div class="viewMatchTitle">
		<div id="viewProfilTitlePrevDay" class="viewCalendarTitlePrevDay viewCalendarTitleArrow"><i class="material-icons">arrow_back_ios</i></div>
		<div id="viewProfilTitleDay" class="viewCalendarTitleDay"></div>
		<div id="viewProfilTitleNextDay" class="viewCalendarTitleNextDay viewCalendarTitleArrow"><i class="material-icons">arrow_forward_ios</i></div>
	</div>

	<div id="viewProfilContent" class="viewProfilContent">

<?php
echo 
'<script type="text/javascript">',
	 "getDisplayMatchDay(
		'getDisplayMatchdayProfilModif',
		$id, 
		$idProfil,
		$competition, 
		$current_day, 
		null,
		'viewProfilContent', 
		'viewProfilTitlePrevDay', 
		'viewProfilTitleNextDay', 
		'viewProfilTitleDay');",
 '</script>';
?>

	</div>
</div>