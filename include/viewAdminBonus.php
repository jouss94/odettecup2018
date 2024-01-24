<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');
	$months = array(
		11 => "Novembre",
		12 => "Décembre",
		06 => "Juin",
		07 => "Juillet",
	);

	?>

<div class="admin-buttons">
	<div class="admin-button">
		<button class="RetourSpanBonusAdmin mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

	<div class="admin">
	
	<form action="addBonusAdmin.php" method="post">
	<?php

		$qry = "SELECT * FROM pronostics_bonus_result";
		$result = mysqli_query($con, $qry);
		$find = false;

		while ($row = mysqli_fetch_array($result )) 
	{
		$team_winner_id = utf8_encode_function($row["team_winner_id"]);		
		$team_winner_id_activated = $row["team_winner_id_activated"];

		$min_first = utf8_encode_function($row["min_first"]);		
		$min_first_activated = $row["min_first_activated"];

		$min_last = utf8_encode_function($row["min_last"]);		
		$min_last_activated = $row["min_last_activated"];

		$total_but = utf8_encode_function($row["total_but"]);		
		$total_but_activated = $row["total_but_activated"];

		$best_scorer = utf8_encode_function($row["best_scorer"]);		
		$best_scorer_activated = $row["best_scorer_activated"];

		$player_winner_id = utf8_encode_function($row["player_winner_id"]);		
		$player_winner_id_activated = $row["player_winner_id_activated"];
	}

	$qry = "SELECT * FROM equipes ORDER BY name;";
	$equipes = mysqli_query($con, $qry);

	?>

		<div class="admin-bonus">
			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Minute du premier but
				</div>
				<div class="admin-bonus-value">
					<input id="min_first" type="number" name="min_first" value="<?php if ($min_first_activated == 1) echo $min_first ?> "  size="8" /> 
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="min_first_activated">
							<input id="min_first_activated" type="checkbox" name="min_first_activated"
								<?php if ($min_first_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Minute du dernier but
				</div>
				<div class="admin-bonus-value">
					<input id="min_last" type="number" name="min_last" value="<?php if ($min_last_activated == 1) echo $min_last ?> "  size="8" /> 
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="min_last_activated">
							<input id="min_last_activated" type="checkbox" name="min_last_activated"
								<?php if ($min_last_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Nombre total de buts
				</div>
				<div class="admin-bonus-value">
					<input id="total_but" type="number" name="total_but" value="<?php if ($total_but_activated == 1) echo $total_but ?> "  size="8" /> 
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="total_but_activated">
							<input id="total_but_activated" type="checkbox" name="total_but_activated"
								<?php if ($total_but_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Equipe favorite
				</div>
				<div class="admin-bonus-value">
					<select name="team_winner_id" id="team_winner_id" style="width:150px;">
						<?php
						while ($row = mysqli_fetch_array($equipes )) 
						{	
							$value = $row["id_equipe"];
							$name = utf8_encode_function($row["name"]);
							echo '<option value="', $value, '" ';
							if ($value == $team_winner_id) {
								echo ' selected="selected" ';
							}
							echo '>', $name, '</option>';
						}
						?>
					    </select>
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="team_winner_id_activated">
							<input id="team_winner_id_activated" type="checkbox" name="team_winner_id_activated"
								<?php if ($team_winner_id_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Meilleur buteur
				</div>
				<div class="admin-bonus-value">
					<input id="best_scorer" name="best_scorer" type="text" value=" <?php if ($best_scorer_activated == 1) echo $best_scorer; ?>"  size="8" />
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="best_scorer_activated">
							<input id="best_scorer_activated" type="checkbox" name="best_scorer_activated"
								<?php if ($best_scorer_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

		</div>

		<div class="buttons">
			<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Valider
			</button>
		</div>



	</form>
</div>