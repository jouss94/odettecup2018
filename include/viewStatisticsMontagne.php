<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	echo '

	<script src="./javascript/statistics.js"></script>

	<span id="colorMontagne" style="display:none;">#3ccb24</span>
	<span id="maxMontagne" style="display:none;">30</span>
	<span id="stepMontagne" style="display:none;">3</span>

	<canvas id="canvasMontagne" width="596" height="297" class="chartjs-render-monitor" style="display: block; height: 238px; width: 477px;"></canvas> 
	';
    return '';

?>