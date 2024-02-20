<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	if (isset($_GET['day'])) {
		$current_day = $_GET['day'];
	}

	$idProfil = $_GET['id'];

	require_once 'config.php';
	require_once 'functions.php';

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
		'viewProfilTitleDay');",
 '</script>';
?>

	</div>
</div>
