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
		<button class="BonusSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonBonus">
			Bonus
		</button>
	</div>
	<div class="admin-button">
		<button class="MoulinetteSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ButtonMoulinette">
			RUN
		</button>
	</div>
	<div class="admin-button">
		<button class="RetourSpanBonus mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

	<div class="admin">
	
	<form action="addMatchesAdmin.php" method="post">
	<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>
	<?php

		$qry = "SELECT matches.*,
		matches.id_match as id, 
		equipes_home.name  as home_name,
		equipes_home.logo  as home_logo,
		equipes_away.name  as away_name,
		equipes_away.logo  as away_logo
		FROM matches 
		LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
		LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
		 ORDER BY date, id;";
		$result = mysqli_query($con, $qry);
		$find = false;

		$current_date = "";
		$first = false;
		$firstValue = true;
		$firstID = 0;
		$lastID = 0;

	while ($row = mysqli_fetch_array($result )) 
	{

		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$date = utf8_encode_function($row["date"]);
		$diff = utf8_encode_function($row["diff"]);
		$stade = utf8_encode_function($row["stadium"]);
		$played = $row["played"];
		$modif = $row["modif"];
		$date_array = date_parse($row["date"]);
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];

		$classPancarte = "";

		if ($firstValue)
		{
			$firstID = $id_match;
			$firstValue = false;
		}

		if ($lastID < $id_match)
			$lastID = $id_match;

		$dateDay = substr($date, 0, 10);
		if ($current_date != $dateDay) {
			echo '<div class="admin-date">'
			,$days[date('w', strtotime($date))] 
			,' '
			,$date_array['day']
			,' '
			,$months[$date_array['month']]
			,' '
			,$date_array['year'];
			echo '</div>';

			$first = true;
		}
		else {
			$first = false;
		}

		echo '<div class="admin-match">';
			echo '<div class="admin-match-logo">
					<img class="logoEquipe" src="', $home_logo,'" />
				</div>';
			echo '<div class="admin-match-name">',
					$home_name,
				'</div>';
				
				
			echo '<div class="admin-match-score">';
					echo '<input id="match_', $id_match ,'_home" name="numberMatch_', $id_match ,'_home" value=';

					if ($played == 1)
						echo '"', $score_home, '"';
					else
						echo '""';
	
					echo ' type="number" size="6" />';
					
			echo '</div>';

			echo '<div class="admin-match-tiret">
					-
				</div>';

			echo '<div class="admin-match-score">';
				echo '<input id="match_', $id_match ,'_away" name="numberMatch_', $id_match ,'_away" value=';

				if ($played == 1)
					echo '"', $score_away, '"';
				else
					echo '""';

				echo ' type="number" size="6" />';
				
			echo '</div>';

			echo '<div class="admin-match-name">',
				$away_name,
			'</div>';
			echo '<div class="admin-match-logo">
				<img class="logoEquipe" src="', $away_logo,'" />
			</div>';

			echo ' <div class="checkbox-wrapper-22">
						<label class="switch" for="numberMatch_', $id_match ,'_played">
							<input id="numberMatch_', $id_match ,'_played" type="checkbox" name="numberMatch_', $id_match ,'_played" ';
								if ($played == 1) echo 'checked';
								echo ' />
							<div class="slider round"></div>
						</label>
					</div>';
			echo '<div class="admin-match-modif">';
				echo '<input id="match_', $id_match ,'_modif" name="numberMatch_', $id_match ,'_modif" value="', $modif,'" type="number" size="6" />';
			echo '</div>';
	

		echo '</div>';

		$current_date = $dateDay;

	}

	echo '<input id="firstid" name="firstid" type="text" value=';
	echo '"', $firstID , '"';
	echo ' style="display:none;"" size="6" />';

	echo '<input id="lastid" name="lastid" type="text" value=';
	echo '"', $lastID , '"';
	echo ' style="display:none;"" size="6" />';


	echo '<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>';

?>

	</form>
</div>