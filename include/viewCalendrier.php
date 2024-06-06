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

	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.name  as away_name,
					equipes_away.logo  as away_logo
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			WHERE modif != 0  ORDER BY date, id;";
	$result = mysqli_query($con, $qry);
	$find = false;

	echo '

		<div class="allListeCalendrier">
		<table class="tableListe" >';

	$current_date = "";
	$first = false;
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

	$dateDay = substr($date, 0, 10);
	if ($current_date != $dateDay) {

		echo '
		</table>
		</div>
		<div class="dateCalendar">
		<span class="dateCalendarText"> '
			,$days[date('w', strtotime($date))] 
			,' '
			,$date_array['day']
			,' '
			,$months[$date_array['month']]
			,' '
			,$date_array['year']
		,' </span>
		</div>
		
		<div class="allListeCalendrier">
		<table class="tableListe" >';
		$first = true;
	}
	else {
		$first = false;
	}
	$current_date = $dateDay;
	
	echo '
		<tr>
			<td class="tableCalendrierGroup">',
				$group,
			'</td>
			<td class="tableCalendrierElse">
				<table style="border-collapse: collapse;width: 100%;    border-radius: 20px;">
					<tr class="tableCalendrierL1">';
						$classname = "";
						if ($first) $classname = "tableListeThird-round";
						echo'<td colspan="3" class="tableListeThird ', $classname ,'"> ',
								'<table style="border-collapse: collapse;width: 100%;height: 50px;text-align: center;font-size: 20px;font-weight: bold;">
									<tr>
										<td style="width: 20%;">
											<img class="logoEquipe" src="', $home_logo,'" />
										</td>
										<td style="width: 24%;text-align: right;padding-right: 25px;">', 
											$home_name,
										'</td>
										<td style="width: 5%;">'; 
											if ($played == 1)
												echo '<span class="pancarte-profil  ',$classPancarte,'">',  $score_home,'</span>';

										echo '</td>
										<td style="width: 2%;"> - ', 
										'</td>
										<td style="width: 5%;">'; 
											if ($played == 1)
												echo '<span class="pancarte-profil  ',$classPancarte,'">',  $score_away,'</span>';

										echo '</td>
										<td style="width: 24%;text-align: left;padding-left: 25px;">', 
											$away_name,
										'</td>
										<td style="width: 20%;">
											<img class="logoEquipe" src="', $away_logo,'" />
										</td>
									</tr>
								</table>',
							'</td>
					</tr>
					<tr class="tableCalendrierL2">';

						echo'
							<td style="width: 33%;">',
								$diff,
							'</td>
							<td style="width: 33%;" class="tableCalendrierL2-hour"> ',
								// $date_array['day'], '/0', $date_array['month'], ' ',
								 $date_array['hour'], 'h00',
							'</td>
							<td style="width: 33%;"> ',
								$stade,
							'</td>
					</tr>
					<tr class="tableCalendrierL3 ">';

						echo'
							<td></td>
							<td style="width: 33%;" class="tableListeDetail" id="detailMatche', $id_match ,'">
								<div>
									<a class="showmore" href="matches.php?id=', $id_match ,'">Détails</a>
							 	</div>
							</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>';


	}
	echo '
		</table>
	</div>

	';

?>