<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	require_once 'config.php';
	require_once 'functions.php';
	 ?>

	<div class="viewMatchTitle">
		<div id="viewNextMatchTitlePrevDay" class="viewMatchTitlePrevDay viewMatchTitleArrow"><i class="material-icons">arrow_back_ios</i></div>
		<div id="viewNextMatchTitleDay" class="viewMatchTitleDay"></div>
		<div id="viewNextMatchTitleNextDay" class="viewMatchTitleNextDay viewMatchTitleArrow"><i class="material-icons">arrow_forward_ios</i></div>
	</div>

	<div id="viewNextMatchContent" class="viewMatchContent">

<?php
echo 
'<script type="text/javascript">',
	 "getDisplayMatchDay(
		'getDisplayMatchNextDayAccueil',
		$id,  
		0,
		$competition,
		$current_day,
		$current_day, 
		'viewNextMatchContent', 
		'viewNextMatchTitlePrevDay', 
		'viewNextMatchTitleNextDay', 
		'viewNextMatchTitleDay',
		'profilNext');",
 '</script>';
?>

</div>