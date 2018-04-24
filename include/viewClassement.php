<?php

		$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	parse_str($_SERVER["QUERY_STRING"], $query);
	$currentClassement = $query['ranking'];

	echo '
		<div class="tab">
  <button id="tabsGeneral" class="tablinks" onclick="openClassement(event, \'General\')">General</button>
  <button id="tabsEquipe" class="tablinks" onclick="openClassement(event, \'Equipe\')">Equipe</button>
  <button id="tabsFemme" class="tablinks" onclick="openClassement(event, \'Femme\')">Femme</button>
  <button id="tabsMontagne" class="tablinks" onclick="openClassement(event, \'Montagne\')">Montagne</button>
</div>

<div id="General" class="tabcontent">',include "viewClassementGeneral.php",'</div>

<div id="Equipe" class="tabcontent">',include("viewClassementEquipe.php"),'</div>

<div id="Femme" class="tabcontent">',include("viewClassementFemme.php"),'</div>

<div id="Montagne" class="tabcontent">',include("viewClassementMontagne.php"),'</div>

<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("tabs', $currentClassement, '").click();
</script>

	';

?>