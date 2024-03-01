<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }

require_once 'config.php';

	$firstID = intval($_POST[ 'firstid' ]);
	$lastID = intval($_POST[ 'lastid' ]);

	$return = true;
	while ($firstID <= $lastID)
	{

		$idMatch = $firstID;
		$idHome = "numberMatch_" . $firstID . "_home";
		$idAway = "numberMatch_" . $firstID . "_away";
		$idPlayed = "numberMatch_" . $firstID . "_played";
		echo'pas la';

		$home = 0;
		$away = 0;
		$played = 0;

		if( isset($_POST[ $idHome ]) && isset($_POST[ $idAway ]) && isset($_POST[ $idPlayed ]))
		{
			$home = $_POST[ $idHome ];
			$away = $_POST[ $idAway ];
			$played = 1;
		}

		// echo $idMatch . " - ";
		$qry = " UPDATE matches SET score_home=$home, score_away=$away, played=$played WHERE id_match = $idMatch";
		$result = mysqli_query($con, $qry);
		if (!$result) {
			$return = false;
		}

		$firstID++;
	}

	if ($return) {
		header("Location:admin.php");
	}

exit();
?>
