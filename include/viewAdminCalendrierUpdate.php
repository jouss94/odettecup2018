<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	parse_str($_SERVER["QUERY_STRING"], $query);
	$date = $query['date'];

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
	include("IcsReader/IcsReader.php");

	$reader = new IcsReader();
	$ics    = $reader->parse($calendarContent);

	$arrayYears = explode('-', $years);
	$startDate =  $arrayYears[0] . '/07/01';
	$endDate =  $arrayYears[1] . '/07/01';

	$events = $ics->getEventsFromRange(new \DateTime($date));
	// echo  json_encode(count($events));
	$it = 0;
	while ($it < count($events)) {
		$event = $events[$it];

		$teams = explode(' - ', $event['SUMMARY']);

		$score_home = 0;
		$score_away = 0;
		$team_home = $teams[0];
		$team_away = $teams[1];
		if(strpos($team_away, '(')) 
		{
			$team_score = explode('(', $team_away);
			$team_away = $team_score[0];

			$score_home = substr($team_score[1], 0, -3);
			$score_away = substr($team_score[1], 2, -1);
		}

		$datetime = new \DateTime($event['DTSTART'], new DateTimeZone("UTC"));
		$datetime->setTimezone(new DateTimeZone('Europe/Paris'));
		$date = $datetime->format('Y-m-d H:i:s');

		$qry = "UPDATE matches SET date = '$date'
		WHERE matches.id_team_home = (SELECT id_equipe FROM equipes WHERE equipes.name = '$team_home')
		AND matches.id_team_away = (SELECT id_equipe FROM equipes WHERE equipes.name = '$team_away')
		AND years = '$years'";

		$result = mysqli_query($con, $qry);
		if (!$result) 
		{
			echo "</br></br>ERREUR with request : </br>" . $qry. '</br>';
		}
		else 
		{
			echo "</br></br>UPDATE MATCH : </br><b>" . $team_home . '-' . $team_away . '</b>';
		}

		echo $qry;

		$it++;
	}
?>
</div>