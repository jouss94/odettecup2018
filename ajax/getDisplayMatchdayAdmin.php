<?php
	require_once '../config.php';
	require_once '../functions.php';

	$competition = $_GET[ 'competition' ];
	$id_joueur = $_GET[ 'id_joueur' ];
	$day = $_GET[ 'day' ];

	class Data implements JsonSerializable {

		public $htlm;
		public $id_prev_day;
		public $id_next_day;

		public function __construct() {
		}	

		public function jsonSerialize () {
			return array(
				'htlm'=>$this->htlm,
				'id_prev_day'=>$this->id_prev_day,
				'id_next_day'=>$this->id_next_day
			);
		}
	}


	$html = "";

	$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');

	
	$html .='<div class="admin">';
	
	$html .='<form action="addMatchesAdmin.php" method="post">';
	$html .='<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>';

	$qry = "SELECT matches.*,
	matches.id_match as id, 
	equipes_home.display_name  as home_name,
	equipes_home.logo  as home_logo,
	equipes_away.display_name  as away_name,
	equipes_away.logo  as away_logo
	FROM matches 
	LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
	LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
	WHERE day=$day
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
			$html .= '<div class="admin-date">'
			.$days[date('w', strtotime($date))] 
			.' '
			.$date_array['day']
			.' '
			.$months[$date_array['month']]
			.' '
			.$date_array['year'];
			$html .= '</div>';

			$first = true;
		}
		else {
			$first = false;
		}

		$html .= '<div class="admin-match">';
			$html .= '<div class="admin-match-logo">
					<img class="logoEquipe" src="'. $home_logo.'" />
				</div>';
			$html .= '<div class="admin-match-name">'.
					$home_name.
				'</div>';
				
				
			$html .= '<div class="admin-match-score">';
					$html .= '<input id="match_'. $id_match .'_home" name="numberMatch_'. $id_match .'_home" value=';

					if ($played == 1)
						$html .= '"'. $score_home. '"';
					else
						$html .= '""';
	
					$html .= ' type="number" size="6" />';
					
			$html .= '</div>';

			$html .= '<div class="admin-match-tiret">
					-
				</div>';

			$html .= '<div class="admin-match-score">';
				$html .= '<input id="match_'. $id_match .'_away" name="numberMatch_'. $id_match .'_away" value=';

				if ($played == 1)
					$html .= '"'. $score_away. '"';
				else
					$html .= '""';

				$html .= ' type="number" size="6" />';
				
			$html .= '</div>';

			$html .= '<div class="admin-match-name">'.
				$away_name.
			'</div>';
			$html .= '<div class="admin-match-logo">
				<img class="logoEquipe" src="'. $away_logo.'" />
			</div>';

			$html .= ' <div class="checkbox-wrapper-22">
						<label class="switch" for="numberMatch_'. $id_match .'_played">
							<input id="numberMatch_'. $id_match .'_played" type="checkbox" name="numberMatch_'. $id_match .'_played" ';
								if ($played == 1) $html .= 'checked';
								$html .= ' />
							<div class="slider round"></div>
						</label>
					</div>';
			// $html .= '<div class="admin-match-modif">';
			// 	$html .= '<input id="match_'. $id_match .'_modif" name="numberMatch_'. $id_match .'_modif" value="'. $modif.'" type="number" size="6" />';
			// $html .= '</div>';
	

		$html .= '</div>';

		$current_date = $dateDay;

	}

	$html .= '<input id="firstid" name="firstid" type="text" value=';
	$html .= '"'. $firstID . '"';
	$html .= ' style="display:none;"" size="6" />';

	$html .= '<input id="lastid" name="lastid" type="text" value=';
	$html .= '"'. $lastID . '"';
	$html .= ' style="display:none;"" size="6" />';


	$html .= '<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>

	</form>
</div>';

	$returnObj = new \stdClass();
	$returnObj->html = $html;

	$prevday = $day-1;
	$qry = "SELECT id_match FROM matches WHERE day=$prevday  and competition=$competition LIMIT 1";

	$res = mysqli_query($con, $qry);
	$num_row = mysqli_num_rows($res);
	if( $num_row == 1 ) 
	{
		$returnObj->id_prev_day = $prevday;
	} else 
	{
		$returnObj->id_prev_day = null;
	}

	$nextday = $day+1;
	$qry = "SELECT id_match FROM matches WHERE day=$nextday  and competition=$competition LIMIT 1";
	$res = mysqli_query($con, $qry);
	$num_row = mysqli_num_rows($res);
	if( $num_row == 1 ) 
	{
		$returnObj->id_next_day = $nextday;
	} else 
	{
		$returnObj->id_next_day = null;
	}

	echo json_encode($returnObj, JSON_PRETTY_PRINT);
?>