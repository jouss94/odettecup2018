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
	$current_date = "";

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
		$played = $row["played"];

		$point = 0;
		if ($row["point"] != "") {
			$point = $row["point"];
		}

		$classPancarte = "";
		$classTR = "classTRNeutre";
		if ($played == 1) {

			if ($point == 0) {
				$classTR = "classTREchecHome";
				$classPancarte = "pancarte-echec";
			}
			if ($point == 1 || $point == 2) {
				$classTR = "classTRInverseHome";
				$classPancarte = "pancarte-inverse";
			}
			if ($point == 3 || $point == 6) {
				$classTR = "classTRCorrectHome";
				$classPancarte = "pancarte-correct";
			}
			if ($point == 4 || $point == 8) {
				$classTR = "classTRCorrectPlusHome";
				$classPancarte = "pancarte-correct-plus";
			}
			if ($point == 7 || $point == 14) {
				$classTR = "classTRPerfectHome";
				$classPancarte = "pancarte-perfect";
				
			}
		}
			
		$date = utf8_encode_function($row["date"]);		
		$dateDay = substr($date, 0, 10);
		
		$date_array = date_parse($row["date"]);

		$minute = $date_array['minute'];
		if (intval($minute) < 9) {
			$minute = '0' . $minute;
		}
		
		if ($current_date != $dateDay) {
	
			$html .=  '
			<div class="dateMatchText"> '
				.$days[date('w', strtotime($date))] 
				.' '
				.$date_array['day']
				.' '
				.$months[$date_array['month']]
			.' </div>
			';
			$first = true;
			$i = 0;
		}

		$background = "";
		if ($i++ % 2 != 0) {
			$background = "backgroundTab1";
		}
		else {
			$background = "backgroundTab2";
		}

		// $html .= '<table class="full-table-collapse-white-accueil">';
		$html .= '<div class="accueil-match-line '.$background.'">';

		$html .= '<div>
		<a class="showmore" href="matches.php?id='. $id_match .'">Détails</a>
	 </div>';

		$current_date = $dateDay;
// $html .='	<tr class="', $classTR, '">';


		// $html .= '<td class="homeSmallDate">';
		// // $html .= '<div>';
		// // 	$html .= display2DigitNumer($date_array['day']). "/" . display2DigitNumer($date_array['month']);	
		// // $html .= '</div>';
		// $html .= '<div>';
		// 	$html .= display2DigitNumer($date_array['hour']). ":" . display2DigitNumer($date_array['minute']);	
		// $html .= '</div>';
		// $html .= '</td>';

		$minusClass = "margin-auto";
		// if ($played) {
		// 	$minusClass = "margin-top-minus";
		// }

		$html .='<div><img class="logoEquipeSmall" src="';
		$html .=$home_logo;	
		$html .='" /></div>';
		$html .='<div class="accueil-match-score-content">';
			$html .='<div class="accueil-match-score-last-day">';
				$html .='<div class="homeEquipeDroite">';
					$html .='<span class=" ">';
							$html .=$home_name;	
					$html .='</span>';
				$html .='</div>';
				$html .='<div class="homeEquipeEquipe">';
				if ($row["prono_home"] != "") {
					$html .='<span class="  pancarteBig '.$classPancarte.'">';
					$html .=$row["prono_home"];
					$html .='</span>';
				}
				$html .='</div>';
				$html .='<div class="homeEquipeMilieu"><div class=" "> - </div></div>';
				$html .='<div class="homeEquipeEquipe">';
				if ($row["prono_away"] != "") {
					$html .='<span class="  pancarteBig '.$classPancarte.'">';
					$html .=$row["prono_away"];
					$html .='</span>';
				}
				$html .='</div>';
				$html .='<div class="homeEquipeGauche">';
				$html .='<span class=" ">';
				$html .=$away_name;	
				$html .='</span>';
				$html .='</div>';
			$html .='</div>';

			if ($row["played"] == 1)
			{
				$html .='<div class="accueil-score ">
					Résultat : ';
					$html .=$row['score_home'];
					$html .=' - 	';
					$html .=$row['score_away'];
					$html .='</div>';
			}
		
		$html .='</div>';
		$html .='<div><img class="logoEquipeSmall" src="';
		$html .=$away_logo;	
		$html .='" /></div>';

		if ($played == 1) {
			$html .='<div class="homePoint '. $classTR .'">';
			if ($point > 0) {
				$html .= '+';
			}
			$html .=$point;
			$html .='</div>';
		}
		else {
			$html .='<div class="homeSmallDateLast">';
			$html .= display2DigitNumer($date_array['hour']). ":" . display2DigitNumer($date_array['minute']);	
			$html .='</div>';
		}
	$html .='	</div>';		

	}
	


	if (!$find) {
		$html .='Pas encore de matches joués.';
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