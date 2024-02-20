<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	$prev_day = $current_day - 1;

	require_once 'config.php';
	require_once 'functions.php';

	$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');
	?>

	<div class="viewMatchTitle">
		<div id="viewPrevMatchTitlePrevDay" class="viewMatchTitlePrevDay viewMatchTitleArrow"><i class="material-icons">arrow_back_ios</i></div>
		<div id="viewPrevMatchTitleDay" class="viewMatchTitleDay"></div>
		<div id="viewPrevMatchTitleNextDay" class="viewMatchTitleNextDay viewMatchTitleArrow"><i class="material-icons">arrow_forward_ios</i></div>
	</div>

	<div id="viewPrevMatchContent" class="viewPrevMatchContent">
	<?php
echo 
'<script type="text/javascript">',
	 "getDisplayMatchDay(
		'getDisplayMatchdayAdmin',
		$id, 
		$id,
		$competition, 
		$current_day, 
		$current_day, 
		'viewPrevMatchContent', 
		'viewPrevMatchTitlePrevDay', 
		'viewPrevMatchTitleNextDay', 
		'viewPrevMatchTitleDay');",
 '</script>';
 ?>

