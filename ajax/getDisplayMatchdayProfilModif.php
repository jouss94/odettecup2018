<?php 
	require_once '../config.php';
	require_once '../functions.php';

	$competition = $_GET[ 'competition' ];
	$id = $_GET[ 'id_joueur' ];
	$day = $_GET[ 'day' ];
	$idProfil = $_GET[ 'id_profil' ];

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

	$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');

	$html = "";

	$html .='
	<form action="addMatches.php" method="post">';

	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.display_name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.display_name  as away_name,
					equipes_away.logo  as away_logo,
					pronos.*
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id 
			WHERE day=$day ORDER BY date, id;";
	$result = mysqli_query($con, $qry);
	$firstID = 0;
	$lastID = 0;
	$current_date = "";
	$current_already_start = false;

	$first = true;
	date_default_timezone_set('Europe/Paris');
	$now = new \DateTime(date("Y-m-d H:i:s"), new DateTimeZone("Europe/Paris"));

	$html .='<table class="tableauPronosForm">';
	while ($row = mysqli_fetch_array($result )) 
	{
		$day = $row["day"];
		$date = utf8_encode_function($row["date"]);
		$date_array = date_parse($row["date"]);
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$pronos_home = $row["prono_home"];
		$pronos_away = $row["prono_away"];



		if ($first) {
			$firstID = $id_match;
			$dateTime = new \DateTime($date, new DateTimeZone("Europe/Paris"));
			if ($now >= $dateTime) {
				$current_already_start = true;
			}
			$first = false;
		}

		
		$dateDay = substr($date, 0, 10);
		if ($current_date != $dateDay) {
	
			$html .=  '
			</table>


			<div class="dateCalendar">
			<span class="dateCalendarText"> '
				.$days[date('w', strtotime($date))] 
				.' '
				.$date_array['day']
				.' '
				.$months[$date_array['month']]
				.' '
				.$date_array['year']
			.' </span>
			</div>
			
			<table class="tableauPronosForm">';
		}

		$current_date = $dateDay;


		if ($lastID < $id_match) {
			$lastID = $id_match;
		}


		$html .='<tr>';

		$html .='
			<td class="tdMatch tdMatchLeft">'. $home_name. '</td>
		';
		$html .='
			<td><img class="logoEquipe" src="'. $home_logo. '" /></td>
		';
		
		$html .='
			<td>
				<input id="match_'. $id_match .'_home" name="numberMatch_'. $id_match .'_home" value=';

				if ($pronos_home != "NULL")
					$html .='"'. $pronos_home. '"';
				else
					$html .='""';

				if ($current_already_start) {
					$html .= " disabled ";
				}

				$html .=' type="number" size="6" />
			</td>
		';
		$html .='
			<td>-</td>
		';
		$html .='
			<td>
				<input id="match_'. $id_match .'_away" name="numberMatch_'. $id_match .'_away" value=';

				if ($pronos_away != "NULL")
					$html .='"'. $pronos_away. '"';
				else
					$html .='""';
				
				if ($current_already_start) {
					$html .= " disabled ";
				}
				
				$html .=' type="number" size="6" />
			</td>
		';

		$html .='
		<td><img class="logoEquipe" src="'. $away_logo. '" /></td>
		';

		$html .='
			<td class="tdMatch tdMatchRight">'. $away_name. '</td>
		';

		$html .='</tr>';

	}
	$html .='</table>';

			$html .='<input id="firstid" name="firstid" type="text" value=';
			$html .='"'. $firstID . '"';
			$html .=' style="display:none;"" size="6" />';

			$html .='<input id="lastid" name="lastid" type="text" value=';
			$html .='"'. $lastID . '"';
			$html .=' style="display:none;"" size="6" />';



	$html .='<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>';
	

	$html .='		</form>';

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