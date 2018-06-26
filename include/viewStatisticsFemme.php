<?php

    $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	echo '
	<script src="./javascript/statistics.js"></script>

	<span id="colorFemme" style="display:none;">#ff00a3</span>
	<span id="maxFemme" style="display:none;">9</span>
	<span id="stepFemme" style="display:none;">1</span>

	<canvas id="canvasFemme" width="596" height="297" class="chartjs-render-monitor" style="display: block; height: 238px; width: 477px;"></canvas> 
	';

    return '';
?>