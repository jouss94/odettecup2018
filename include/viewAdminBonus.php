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

		$min_first = utf8_encode_function($row["min_first"]);		
		$min_first_activated = $row["min_first_activated"];

		$min_last = utf8_encode_function($row["min_last"]);		
		$min_last_activated = $row["min_last_activated"];

		$total_but = utf8_encode_function($row["total_but"]);		
		$total_but_activated = $row["total_but_activated"];

		$fairplay_score = utf8_encode_function($row["fairplay_score"]);		
		$fairplay_activated = $row["fairplay_activated"];

		$penalty_score = utf8_encode_function($row["penalty_score"]);		
		$penalty_activated = $row["penalty_activated"];

		$but_edf_score = utf8_encode_function($row["but_edf_score"]);		
		$but_edf_activated = $row["but_edf_activated"];

		$team_final_1_id = utf8_encode_function($row["team_final_1_id"]);		
		$team_final_1_activated = $row["team_final_1_activated"];

		$team_final_2_id = utf8_encode_function($row["team_final_2_id"]);		
		$team_final_2_activated = $row["team_final_2_activated"];
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
					<input id="min_first" type="number" name="min_first" value="<?php echo $min_first ?>"  size="8" /> 
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
					<input id="min_last" type="number" name="min_last" value="<?php echo $min_last ?>"  size="8" /> 
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
					<input id="total_but" type="number" name="total_but" value="<?php echo $total_but ?>"  size="8" /> 
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
					Fairplay
				</div>
				<div class="admin-bonus-value">
					<input id="fairplay_score" type="number" name="fairplay_score" value="<?php echo $fairplay_score ?>"  size="8" /> 
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="fairplay_activated">
							<input id="fairplay_activated" type="checkbox" name="fairplay_activated"
								<?php if ($fairplay_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Pénalty
				</div>
				<div class="admin-bonus-value">
					<input id="penalty_score" type="number" name="penalty_score" value="<?php echo $penalty_score ?>"  size="8" /> 
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="penalty_activated">
							<input id="penalty_activated" type="checkbox" name="penalty_activated"
								<?php if ($penalty_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					But equipe de france
				</div>
				<div class="admin-bonus-value">
					<input id="but_edf_score" type="number" name="but_edf_score" value="<?php echo $but_edf_score ?>"  size="8" /> 
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="but_edf_activated">
							<input id="but_edf_activated" type="checkbox" name="but_edf_activated"
								<?php if ($but_edf_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Equipe finaliste 1
				</div>
				<div class="admin-bonus-value">
					<select name="team_final_1_id" id="team_final_1_id" style="width:150px;">
						<?php
						while ($row = mysqli_fetch_array($equipes )) 
						{	
							$value = $row["id_equipe"];
							$name = utf8_encode_function($row["name"]);
							echo '<option value="', $value, '" ';
							if ($value == $team_final_1_id) {
								echo ' selected="selected" ';
							}
							echo '>', $name, '</option>';
						}
						?>
					    </select>
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="team_final_1_activated">
							<input id="team_final_1_activated" type="checkbox" name="team_final_1_activated"
								<?php if ($team_final_1_activated == 1) echo 'checked'; ?> />
							<div class="slider round"></div>
						</label>
					</div>
				</div>
			</div>

			<div class="admin-bonus-line">
				<div class="admin-bonus-titre">
					Equipe finaliste 2
				</div>
				<div class="admin-bonus-value">
					<select name="team_final_2_id" id="team_final_2_id" style="width:150px;">
						<?php

						$qry = "SELECT * FROM equipes ORDER BY name;";
						$equipes = mysqli_query($con, $qry);

						while ($row = mysqli_fetch_array($equipes )) 
						{	
							$value = $row["id_equipe"];
							$name = utf8_encode_function($row["name"]);
							echo '<option value="', $value, '" ';
							if ($value == $team_final_2_id) {
								echo ' selected="selected" ';
							}
							echo '>', $name, '</option>';
						}
						?>
					    </select>
				</div>
				<div class="admin-bonus-value">
					<div class="checkbox-wrapper-22">
						<label class="switch" for="team_final_2_activated">
							<input id="team_final_2_activated" type="checkbox" name="team_final_2_activated"
								<?php if ($team_final_2_activated == 1) echo 'checked'; ?> />
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