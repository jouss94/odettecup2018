<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';
	
	?>

<div class="admin-buttons-column">
	<div class="admin-button">
		<button class="InitializeCalendrierAdminSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonBonus" >
			Initialize
		</button>
	</div>
	<div class="admin-button">
		<button class="UpdateCalendrierAdminSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonBonus" >
			Update
		</button>
		<input type="date" id="datePicker" />
	</div>
	<div class="admin-button">
		<button class="RetourSpanBonusAdmin mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

<div class="admin">
</div>