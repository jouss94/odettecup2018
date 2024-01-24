<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }

require_once 'config.php';
include("functions.php");

function addBonus($con)
{
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$qry = " DELETE FROM pronostics_bonus WHERE id_joueur = $id;";
	$result = mysqli_query($con, $qry);
	if (!$result) 
	{
		$return = false;
	}
	else 
	{
		$return = true;
	}

	$return = false;
	$team_winner_id = intval($_POST[ 'equipeWin' ]);
	$min_first = intval($_POST[ 'MinPronosFirst' ]);
	$min_last = intval($_POST[ 'MinPronosLast' ]);
	$total_but = intval($_POST[ 'totalBut' ]);
	$best_scorer = addslashes(utf8_decode_function ($_POST[ 'InputTextBestScorer' ]));

	$player_winner_id = intval($_POST[ 'joueurWin' ]);

	/// UPDATE 
	$qry = " INSERT INTO pronostics_bonus (id_joueur, team_winner_id, total_but, min_first, min_last, player_winner_id, best_scorer) 
										VALUES ($id, $team_winner_id, $total_but, $min_first, $min_last, $player_winner_id, '$best_scorer');";

	$result = mysqli_query($con, $qry);

	if (!$result) {
		$return = false;
		return false;
	}
	else
	{
		$return = true;
		changeEtat($con, $team_winner_id);
	}
	return $return;
}

?>
