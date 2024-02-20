<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	
	?>

<div class="admin-buttons">
	<div class="admin-button">
		<button class="RetourSpanBonusAdmin mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

<div class="admin">

<?php 
	$url =  'http://ics.fixtur.es/v2/league/ligue-1.ics';
	$file_name = basename($url); 

	$calendarContent = file_get_contents($url);
	include("IcsReader\IcsReader.php");

	$reader = new IcsReader();
	$ics    = $reader->parse($calendarContent);

	$arrayYears = explode('-', $years);
	$startDate =  $arrayYears[0] . '/07/01';
	$endDate =  $arrayYears[1] . '/07/01';

	$qry = " DELETE FROM `matches` WHERE date > '$startDate' AND date < '$endDate'";
	echo $qry;
	$result = mysqli_query($con, $qry);
	if (!$result) 
	{
		echo "DELETE MATCHES ERROR</br>";
	}
	else 
	{
		echo "DELETE MATCHES DONE";
	}

	$events = $ics->getEventsFromRange(new \DateTime($startDate), new \DateTime($endDate));
	// echo  json_encode(count($events));
	$it = 0;
	$day = 1;
	$nb_of_matches = 0;
	while ($it < count($events)) {
		// echo $it;
		// echo json_encode($events[$it]);

		$event = $events[$it];

		if ($nb_of_matches == 9) {
			$day++;
			$nb_of_matches = 0;
		}

		// echo $event['SUMMARY'];

		$teams = explode(' - ', $event['SUMMARY']);

		$score_home = 0;
		$score_away = 0;
		$team_home = $teams[0];
		$team_away = $teams[1];
		$played = 0;
		$modif = 1;
		if(strpos($team_away, '(')) 
		{
			$team_score = explode('(', $team_away);
			$team_away = $team_score[0];

			$score_home = substr($team_score[1], 0, -3);
			$score_away = substr($team_score[1], 2, -1);
			$played = 1;
			$modif = 2;
		}

		$datetime = new \DateTime($event['DTSTART'], new DateTimeZone("UTC"));
		$datetime->setTimezone(new DateTimeZone('Europe/Paris'));
		$date = $datetime->format('Y-m-d H:i:s');

		$qry = " INSERT INTO matches (id_team_home, id_team_away, score_home, score_away, date, played, modif, day, years, competition, reporte) 
		SELECT 
			team_home.id_equipe as id_team_home, 
			team_away.id_equipe as id_team_away,
			'$score_home' as score_home,
			'$score_away' as score_away,
			'$date' as date,
			'$played' as played,
			'$modif' as modif,
			'$day' as day,
			'$years' as years,
			$competition as competition,
			0 as reporte
		FROM equipes
		LEFT JOIN equipes as team_home ON team_home.name = '$team_home'
		LEFT JOIN equipes as team_away ON team_away.name = '$team_away'
		LIMIT 1
		";

		$result = mysqli_query($con, $qry);
		if (!$result) 
		{
			$return = false;
		}
		else 
		{
			$return = true;
		}

		echo $qry;


		$nb_of_matches++;
		$it++;
	}
?>
</div>