<?php

		$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	parse_str($_SERVER["QUERY_STRING"], $query);
	$currentClassement = $query['ranking'];

	echo '
	<span id="idCurrent" style="display:none;">'.$id.'</span>';


	echo '
	<div class="uniqueStatistics">',include "viewStatisticsGeneral.php",'</div>
	<script>openClassement(event, \'General\')</script>';
	
// 	echo '
// 		<div class="tab">
//   <button id="tabsGeneral" class="tablinks tablinksgeneral" onclick="openClassement(event, \'General\')">General</button>
//   <button id="tabsEquipe" class="tablinks tablinksequipe" onclick="openClassement(event, \'Equipe\')">Equipe</button>
//   <button id="tabsFemme" class="tablinks tablinksfemme" onclick="openClassement(event, \'Femme\')">Femme</button>
//   <button id="tabsMontagne" class="tablinks tablinksmontagne" onclick="openClassement(event, \'Montagne\')">Montagne</button>
// </div>

// <div id="General" class="tabcontent">',include "viewStatisticsGeneral.php",'</div>

// <div id="Equipe" class="tabcontent">',include("viewStatisticsEquipe.php"),'</div>

// <div id="Femme" class="tabcontent">',include("viewStatisticsFemme.php"),'</div>

// <div id="Montagne" class="tabcontent">',include("viewStatisticsMontagne.php"),'</div>

// <div id="Joueur" class="tabcontent">',include("viewStatisticsJoueur.php"),'</div>


// <script>
// // Get the element with id="defaultOpen" and click on it
// document.getElementById("tabs', $currentClassement, '").click();
// </script>

// 	';

?>