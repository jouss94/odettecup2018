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
					equipes_away.logo  as away_logo
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			WHERE competition = $competition AND day = $day
			ORDER BY day, date, id;";
	$result = mysqli_query($con, $qry);
	$find = false;


	$current_date = "";
	$first = false;
	$it = 1;
	$old_day = 0;
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
		
		$day = $row["day"];
		$reporte = $row["reporte"];

		$classPancarte = "";

		if ($old_day != $day) {
			if ($it != 1) {
					echo "</table>
					</div>
				</div>";			
			}
			$it++;
			$current_date = 0;
		}

		$old_day = $day;


	$dateDay = substr($date, 0, 10);
	if ($current_date != $dateDay) {

		$html .=  '
		</table>
		</div>
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
		
		<div class="allListeCalendrier">
		<table class="tableListe" >';
		$first = true;
	}
	else {
		$first = false;
	}
	$current_date = $dateDay;

	$minute = $date_array['minute'];
	if (intval($minute) < 9) {
		$minute = '0' . $minute;
	}
	
	$html .=  '
		<tr>
			<td class="tableCalendrierGroup">J'.
				$day.
			'</td>
			<td class="tableCalendrierElse">
				<table style="border-collapse: collapse;width: 100%;    border-radius: 20px;">
					<tr class="tableCalendrierL1">';
						$classname = "";
						if ($first) $classname = "tableListeThird-round";
						$html .= '<td colspan="3" class="tableListeThird '. $classname .'"> '.
								'<table style="border-collapse: collapse;width: 100%;height: 50px;text-align: center;font-size: 20px;font-weight: bold;">
									<tr>
										<td style="width: 20%;">
											<img class="logoEquipe" src="'. $home_logo.'" />
										</td>
										<td style="width: 24%;text-align: center;padding-right: 25px;">'. 
											$home_name.
										'</td>
										<td style="width: 5%;">'; 
											if ($played == 1)
												$html .=  '<span class="pancarte-profil '.$classPancarte.'">'.  $score_home.'</span>';

										$html .=  '</td>
										<td style="width: 2%;"> - '. 
										'</td>
										<td style="width: 5%;">'; 
											if ($played == 1)
												$html .=  '<span class="pancarte-profil '.$classPancarte.'">'.  $score_away.'</span>';

										$html .=  '</td>
										<td style="width: 24%;text-align: center;padding-left: 25px;">'. 
											$away_name.
										'</td>
										<td style="width: 20%;">
											<img class="logoEquipe" src="'. $away_logo.'" />
										</td>
									</tr>
								</table>'.
							'</td>
					</tr>
					<tr class="tableCalendrierL2">';

						$html .= '
							<td style="width: 33%;">'.
								$diff.
							'</td>
							<td style="width: 33%;" class="tableCalendrierL2-hour"> '.
								// $date_array['day'], '/0', $date_array['month'], ' '.
								 $date_array['hour']. ':'. $minute.
							'</td>
							<td style="width: 33%;"> '.
								$stade.
							'</td>
					</tr>
					<tr class="tableCalendrierL3 ">';

						$html .= '
							<td></td>
							<td style="width: 33%;" class="tableListeDetail" id="detailMatche'. $id_match .'">
								<div>
									<a class="showmore" href="matches.php?id='. $id_match .'">Détails</a>
							 	</div>
							</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>';
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