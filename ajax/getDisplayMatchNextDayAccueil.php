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
	
	$html .= '<table class="full-table-collapse-white">';
	
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
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id_joueur 
			WHERE day=$day and competition=$competition ORDER BY date, id;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
	while ($row = mysqli_fetch_array($result )) 
	{
		$find = true;
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$pronos_home = $row["prono_home"];
		$pronos_away = $row["prono_away"];

		$point = $row["point"];
		$classTR = "classTRNeutre";
		

		$date_array = date_parse($row["date"]);
		if ($i++ % 2 == 0) {
			$html .= '	<tr class="backgroundTab1">';
		}
		else {
			$html .= '	<tr class="backgroundTab2">';
		}

		$classPancarte = "";

		$html .= '<td class="homeSmallDate">';
		$html .= '<div>';
			$html .= display2DigitNumer($date_array['day']). "/" . display2DigitNumer($date_array['month']);	
		$html .= '</div>';
		$html .= '<div>';
			$html .= display2DigitNumer($date_array['hour']). "h" . display2DigitNumer($date_array['minute']);	
		$html .= '</div>';
		$html .= '</td>';
		$html .= '<td><img class="logoEquipeSmall" src="';
		$html .= $home_logo;	
		$html .= '" /></td>';
		$html .= '<td class="homeEquipeDroite2">';
		$html .= $home_name;	
		$html .= '</td>';
		$html .= '<td class="homeEquipeEquipe">';
		if ( $row["prono_home"] != null)
		{
			$html .= '<span class="pancarteBig ' . $classPancarte . '">';
			$html .= $row["prono_home"];
			$html .= '</span>';
		}
		$html .= '</td>';

		$html .= '<td class="homeEquipeMilieu2"> - </td>';
		$html .= '<td class="homeEquipeEquipe">';
		if ( $row["prono_away"] != null)
		{
			$html .= '<span class="pancarteBig ' . $classPancarte . '">';
			$html .= $row["prono_away"];
			$html .= '</span>';
		}
		$html .= '</td>';
		$html .= '<td class="homeEquipeGauche2">';
		$html .= $away_name;	
		$html .= '</td>';
		$html .= '<td><img class="logoEquipeSmall" src="';
		$html .= $away_logo;	
		$html .= '" /></td>';
$html .= '	</tr>';		

	}
	
$html .= '</table>';

	if (!$find) {
		$html .= 'Pas de matche disponible.';
	}

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