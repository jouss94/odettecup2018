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

	$html = "";

	$qry = "SELECT * ,
					equipe_home.display_name  as home_name,
					equipe_home.logo  as home_logo,
					equipe_away.display_name  as away_name,
					equipe_away.logo  as away_logo,
					matches.id_match as id_match_match
			FROM matches   
			LEFT JOIN pronostics ON matches.id_match = pronostics.id_match AND id_joueur ='".$idProfil."'
			LEFT JOIN equipes equipe_home ON equipe_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipe_away ON equipe_away.id_equipe = matches.id_team_away			
			WHERE day=$day 
			ORDER BY matches.date, matches.id_match;";

	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
	$first = true;
	$display_score = false;
	date_default_timezone_set('Europe/Paris');
	$now = new \DateTime(date("Y-m-d H:i:s"), new DateTimeZone("Europe/Paris"));

	while ($row = mysqli_fetch_array($result )) 
	{	
		$find = true;

		$date = utf8_encode_function($row["date"]);

		if ($first) {
			$dateTime = new \DateTime($date, new DateTimeZone("Europe/Paris"));
			if ($now >= $dateTime) {
				$display_score = true;
			}
			$first = false;
		}

		$classTR = "";
		if ($row["played"] == 1)
		{
			$point = $row["point"];
			if ($point == 0)
				$classTR = "classTREchecHome";
			if ($point == 1 || $point == 2)
				$classTR = "classTRInverseHome";
			if ($point == 3 || $point == 6)
				$classTR = "classTRCorrectHome";
			if ($point == 4 || $point == 8)
				$classTR = "classTRCorrectPlusHome";
			if ($point == 7 || $point == 14)
				$classTR = "classTRPerfectHome";
		}
		else if ($row["played"] == 0)
		{
				$classTR = "classTRNeutre";
		}	

		$classPancarte = "";



		$date_array = date_parse($row["date"]);
		if ($i++ % 2 == 0) {
			$background = 'backgroundTab1';
		}
		else {					
			$background = 'backgroundTab2';
		}

		$html .='<div class="profil-line '. $background .'">';

		$html .='<table class="affPronosTableau">';



		$html .='	<tr class="affPronosLigne ">';
			if ($row["played"] == 1)
			{
				$point = $row["point"];
				if ($point == 0)
					$classPancarte = "pancarte-padding pancarte-echec";
				if ($point == 1 || $point == 2)
					$classPancarte = "pancarte-padding pancarte-inverse";
				if ($point == 3 || $point == 6)
					$classPancarte = "pancarte-padding pancarte-correct";
				if ($point == 4 || $point == 8)
					$classPancarte = "pancarte-padding pancarte-correct";
				if ($point == 7 || $point == 14)
					$classPancarte = "pancarte-padding pancarte-perfect";
			}
			
			$html .='<td class="'. $classTR .'"  style="width:8%">';
			if ($row["played"] == 1)
			{
				$point = $row["point"];
				if ($point == 0)
					$html .='<div class="EchecPronos">ECHEC</div>';
				if ($point == 1 || $point == 2)
					$html .='<div class="InversePronos">INVERSE</div>';
				if ($point == 3 || $point == 6)
					$html .='<div class="CorrectPronos">CORRECT</div>';
				if ($point == 4 || $point == 8)
					$html .='<div class="CorrectPlusPronos">CORRECT+</div>';
				if ($point == 7 || $point == 14)
					$html .='<div class="PerfectPronos">PERFECT</div>';
			}
			// else if ($row["played"] == 0)
			// {
			// 	 $html .='<div class="PasJouePronos">EN ATTENTE</div>';					
			// }	

		$html .='</td>';

			$point = 0;
			if ($row["point"] != "") {
				$point = $row["point"];
			}

			$html .='<td class="'. $classTR .'" style="width:4%;text-align: center;font-size: 16px;font-weight: bold;">';
			if ($row["played"] == 1)
				{
					$html .='+'. $point;
				}

			$html .='</td>';

			$html .='<td style="width:8%;padding: 15px 0px;" class="affPronosLogo">';
				$html .='<img class="logoEquipe"  style="margin-top: 2px;margin-bottom: 2px;margin-left: 10px;" src="'. utf8_encode_function($row["home_logo"]). '" />';
			$html .='</td>';
			
			$html .='<td style="width:23%" class="tdMatchLeft"> ';
				$html .=utf8_encode_function($row["home_name"]);
			$html .='</td>';

			$html .='<td style="width:5%">';
			if ($row["prono_home"] != "" && ($idProfil == $id || $display_score))
			{
				$html .='<span class="pancarte-profil '.$classPancarte.'"> ';
				$html .=$row["prono_home"];
				$html .='</span> ';
			}
			$html .='</td>';

			$html .='<td style="width:4%;text-align: center;">-';
			$html .='</td>';

			$html .='<td style="width:5%">';
			if ($row["prono_away"] != "" && ($idProfil == $id || $display_score))
			{
				$html .='<span class="pancarte-profil '.$classPancarte.'"> ';
				$html .=$row["prono_away"];
				$html .='</span> ';
			}
			$html .='</td>';

			$html .='<td style="width:23%" class="tdMatchRight">';
				$html .=utf8_encode_function($row["away_name"]);
			$html .='</td>';

			$html .='<td style="width:8%">';
				$html .='<img class="logoEquipe" style="margin-right: 10px;" src="'. utf8_encode_function($row["away_logo"]). '" />';
			$html .='</td>';
	

			$html .='<td class="" style="width:12%;text-align: center;font-size: 16px;font-weight: bold;">';
			$html .='	
				<div>
					<a class="showmore" href="matches.php?id='. $row["id_match_match"] .'">Détails</a>
				</div>';
				
			$html .='</td>';

		$html .='</tr>';
		$html .='</table>';

		if ($row["played"] == 1)
		{
			$html .='<div class="profil-score ">
				Résultat : ';
				$html .=$row['score_home'];
				$html .=' - 	';
				$html .=$row['score_away'];
				$html .='</div>';
		}
		$html .='</div>';
	}
	if ($find == false)
	{
		$html .='<span class="emptyTableau"> Aucun pronostic</span>';
	}
			// Entrez les données


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