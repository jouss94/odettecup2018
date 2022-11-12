<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	echo '
	<script src="./javascript/statistics.js"></script>

	<span id="colorEquipe" style="display:none;">#2768ff</span>
	<span id="maxEquipe" style="display:none;">10</span> 
	<span id="stepEquipe" style="display:none;">1</span>

	<canvas id="canvasEquipe" width="596" height="297" class="chartjs-render-monitor" style="display: block; height: 238px; width: 477px;"></canvas> 
	';

    return '';
?>