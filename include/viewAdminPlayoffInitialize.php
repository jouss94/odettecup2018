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

function getNomberOfPlayoffDay($matrice)
{
	$letter = "";
	$result = 0;
	foreach ($matrice as $playoff) 
	{
		if ($playoff[0][0] != $letter) 
		{
			$result++;
			$letter = $playoff[0][0];
		}
	}

	return $result;
}

$all_days = getDays($con, $competition);

$nbOfDay = count($all_days);
// TODO = choose matrice FROM NB OF PLAYER 

$current_matrice = $playofff_matrice_test;
$nbOfPlayoffDay = getNomberOfPlayoffDay($current_matrice);

echo '<br>$nbOfDay ' . $nbOfDay;
echo '<br>$nbOfPlayoffDay ' . $nbOfPlayoffDay;


if ($nbOfDay > 0 & $nbOfPlayoffDay > 0)
{
	$firstDay = intval(end($all_days)) - $nbOfPlayoffDay;

	$qry = " DELETE FROM `playoffs` WHERE competition = $competition;";
	$result = mysqli_query($con, $qry);
	if (!$result) 
	{
		$return = false;
	}
	else 
	{
		$return = true;
	}
	
	$letter = "";
	$currentDay = $firstDay;

	foreach ($current_matrice as $playoff) 
	{
		if ($playoff[0][0] != $letter) 
		{
			$currentDay++;
			$letter = $playoff[0][0];

			echo '<br> day :' . $currentDay;
		}

		$qry = " INSERT INTO playoffs (name, equipe_home, equipe_ext, day, competition) 
				VALUES ('$playoff[0]', '$playoff[1]', '$playoff[2]', $currentDay, $competition);";
	
		$result = mysqli_query($con, $qry);
	
		if (!$result) {
			echo 'Error SQL';
		}
	}
}
else 
{
	echo 'NOTHING DONE';
}


?>
</div>