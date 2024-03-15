<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	require_once 'config.php';
	require_once 'functions.php';

	$current_day = $GLOBALS['current_day_plus_2'];
	if (isset($_GET['day'])) {
		$current_day = $_GET['day'];
	}

	$playoff_days = getPlayoffDays($con, $competition);
	$payoff_day_array_js = '["' . implode('", "', $playoff_days) . '"]';

	$idProfil = $_GET['id'];


	?>

	<div class="viewMatchTitle">
		<div id="viewProfilTitlePrevDay" class="viewProfilTitlePrevDay viewProfilTitleArrow"><i class="material-icons">arrow_back_ios</i></div>
		<div id="viewProfilTitleDay" class="viewProfilTitleDay"></div>
		<div id="viewProfilTitleNextDay" class="viewProfilTitleNextDay viewProfilTitleArrow"><i class="material-icons">arrow_forward_ios</i></div>
	</div>

	<div id="viewProfilContent" class="viewProfilContent">
	<?php

echo 
'<script type="text/javascript">',
	 "getDisplayMatchDay(
		'getDisplayMatchdayProfil',
		$id, 
		$idProfil,
		$competition, 
		$current_day, 
		null,
		'viewProfilContent', 
		'viewProfilTitlePrevDay', 
		'viewProfilTitleNextDay', 
		'viewProfilTitleDay',
		'$payoff_day_array_js');",
 '</script>';
?>

	</div>
</div>
