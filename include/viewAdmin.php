<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');
	?>

<div class="admin-buttons">
	<div class="admin-button">
		<button class="PlayoffAdminSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonBonus">
			Playoff
		</button>
	</div>
	<div class="admin-button">
		<button class="CalendrierAdminSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonBonus">
			Calendrier
		</button>
	</div>
	<div class="admin-button">
		<button class="MoulinetteSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonMoulinette">
			RUN
		</button>
	</div>
	<div class="admin-button">
		<button class="JoueursAdminSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonBonus">
			Joueurs
		</button>
	</div>
	<div class="admin-button">
		<button class="RetourSpanBonus mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

	<?php include("include/viewAdminDay.php");?>
