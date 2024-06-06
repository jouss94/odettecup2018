<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }

require_once 'config.php';
include("functions.php");


	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$return = false;
	$min_first = intval($_POST[ 'min_first' ]);
	$min_last = intval($_POST[ 'min_last' ]);
	$total_but = intval($_POST[ 'total_but' ]);
	$fairplay_score = intval($_POST[ 'fairplay_score' ]);
	$penalty_score = intval($_POST[ 'penalty_score' ]);
	$but_edf_score = intval($_POST[ 'but_edf_score' ]);
	$team_final_1_id = intval($_POST[ 'team_final_1_id' ]);
	$team_final_2_id = intval($_POST[ 'team_final_2_id' ]);

	$min_first_activated = isset($_POST[ 'min_first_activated']) ? 1 : 0;
	$min_last_activated = isset($_POST[ 'min_last_activated' ]) ? 1 : 0;
	$total_but_activated = isset($_POST[ 'total_but_activated' ]) ? 1 : 0;
	$fairplay_activated = isset($_POST[ 'fairplay_activated' ]) ? 1 : 0;
	$penalty_activated = isset($_POST[ 'penalty_activated' ]) ? 1 : 0;
	$but_edf_activated = isset($_POST[ 'but_edf_activated' ]) ? 1 : 0;
	$team_final_1_activated = isset($_POST[ 'team_final_1_activated' ]) ? 1 : 0;
	$team_final_2_activated = isset($_POST[ 'team_final_2_activated' ]) ? 1 : 0;

	/// UPDATE 
	$qry = " UPDATE  pronostics_bonus_result 
				SET total_but = $total_but,
	 				min_first = $min_first,
					min_last = $min_last, 
					fairplay_score = $fairplay_score,
					penalty_score = $penalty_score, 
					but_edf_score = $but_edf_score,
					team_final_1_id = $team_final_1_id,
					team_final_2_id = $team_final_2_id, 
					min_first_activated = $min_first_activated,
					min_last_activated = $min_last_activated,
					total_but_activated = $total_but_activated,
					fairplay_activated = $fairplay_activated, 
					penalty_activated = $penalty_activated,
					but_edf_activated = $but_edf_activated,
					team_final_1_activated = $team_final_1_activated,
					team_final_2_activated = $team_final_2_activated ";

	$result = mysqli_query($con, $qry);

	if ($result) {
		header("Location: admin.php");
	}

	exit();
?>