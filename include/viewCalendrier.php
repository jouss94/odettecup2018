<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	if (isset($_GET['day'])) {
		$current_day = $_GET['day'];
	}

	require_once 'config.php';
	require_once 'functions.php';

	?>

	<div class="viewMatchTitle">
		<div id="viewCalendarTitlePrevDay" class="viewCalendarTitlePrevDay viewCalendarTitleArrow"><i class="material-icons">arrow_back_ios</i></div>
		<div id="viewCalendarTitleDay" class="viewCalendarTitleDay"></div>
		<div id="viewCalendarTitleNextDay" class="viewCalendarTitleNextDay viewCalendarTitleArrow"><i class="material-icons">arrow_forward_ios</i></div>
	</div>

	<div id="viewCalendarContent" class="viewCalendarContent">
	<?php

echo 
'<script type="text/javascript">',
	 "getDisplayMatchDay(
		'getDisplayMatchdayCalendar',
		$id, 
		null,
		$competition, 
		$current_day,  
		null,
		'viewCalendarContent', 
		'viewCalendarTitlePrevDay', 
		'viewCalendarTitleNextDay', 
		'viewCalendarTitleDay');",
 '</script>';
?>

	</div>
</div>
