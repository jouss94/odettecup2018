<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';


	require_once 'config.php';
	require_once 'functions.php';
	
	?>

<div class="admin-buttons-column">
	<div class="admin-button">
		<button class="RetourSpanBonusAdmin mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

<div class="admin-joueurs-list">




<?php 

	$current_day = $GLOBALS['current_day'];

	echo "<div class='admin-joueur-day'>Journée en cours : $current_day</div>";

	$qry = "SELECT joueurs.id_joueur, joueurs.surnom, count(matches.id_match) as nb FROM joueurs 
	LEFT JOIN pronostics pronos ON pronos.id_joueur = joueurs.id_joueur 
	LEFT JOIN matches ON matches.id_match = pronos.id_match AND matches.day = $current_day
    GROUP BY joueurs.id_joueur, joueurs.surnom
	";
	$result = mysqli_query($con, $qry);
	$find = false;

	
	while ($row = mysqli_fetch_array($result)) 
	{

		$id_joueur = $row["id_joueur"];
		$surnom = $row["surnom"];
		$nb = $row["nb"];


		?>	
		<div class='admin-joueurs-item'>
		<div class='admin-joueurs-surnom'>
			<?php echo $surnom ?>
		</div>
		<div class='admin-joueur-toogle checkbox-wrapper-22'>
			<label class='switch' for='checkbox-paiement'>
				<input type='checkbox' id='checkbox-paiement' disabled <?php if ($nb== 9) echo 'checked';?> />
				<div class='slider round'></div>
			</label>
		</div>
		</div>
		<?php
	}

?>

</div>