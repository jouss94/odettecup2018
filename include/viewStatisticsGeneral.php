<?php

    $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	echo '
	<script src="./javascript/statistics.js"></script>

	<span id="colorGeneral" style="display:none;">#fff</span>
	<span id="maxGeneral" style="display:none;">30</span>
	<span id="stepGeneral" style="display:none;">1</span>

	<canvas id="canvasGeneral" width="596" height="297" class="chartjs-render-monitor" style="display: block; height: 238px; width: 477px;"></canvas> 
	';

    return '';
?>