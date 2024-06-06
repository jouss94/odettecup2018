<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }

require_once 'config.php';
include("functions.php");

function changeEtat($con)
{
	$colors = array(
	1 => '65112d',
	2 => 'faea0e',
	3 => '138f55',
	4 => 'ff7e04',
	5 => 'ffffff',
	6 => '950c0c',
	7 => '292975',
	8 => '179355',
	9 => '5bbee9',
	10 => '004300',
	11 => '159153',
	12 => 'dc171d',
	13 => '000066',
	14 => 'dc171d',
	15 => 'dc171e',
	16 => 'e1d71d',
	17 => 'dc080d',
	18 => '000000',
	19 => 'fff',
	20 => '012987',
	21 => 'dc151d',
	22 => 'dc171e',
	23 => 'db161d',
	24 => 'db161d',
	25 => 'ffec00',
	26 => 'dc080d',
	27 => 'dc080d',
	28 => 'ffec00',
	29 => '149153',
	30 => 'fcea0d',
	31 => '5bbee9',
	32 => 'fff'
	);

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

//	$qry = "UPDATE  joueurs SET modif_bonus = 1, equipe = $team_winner_id, color = '$color' WHERE id_joueur = $id";
	$qry = "UPDATE  joueurs SET modif_bonus = 1 WHERE id_joueur = $id";
	

	$result = mysqli_query($con, $qry);
}

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
	$min_first = intval($_POST[ 'MinPronosFirst' ]);
	$min_last = intval($_POST[ 'MinPronosLast' ]);
	$total_but = intval($_POST[ 'totalBut' ]);
	$fairplay = intval($_POST[ 'fairplay' ]);
	$but_edf = intval($_POST[ 'but_edf' ]);
	$penalty = intval($_POST[ 'penalty' ]);
	$team_final_1 = intval($_POST[ 'team_final_1' ]);
	$team_final_2 = intval($_POST[ 'team_final_2' ]);

	$qry = " INSERT INTO pronostics_bonus (id_joueur, total_but, min_first, min_last, fairplay, penalty, but_edf, team_final_1_id, team_final_2_id) 
										VALUES ($id, $total_but, $min_first, $min_last, $fairplay, '$penalty', '$but_edf', $team_final_1, $team_final_2);";

	$result = mysqli_query($con, $qry);

	if (!$result) {
		$return = false;
		return false;
	}
	else
	{
		$return = true;
		changeEtat($con);
	}
	return $return;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier bonus</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php include("include/style.php");?>
		<link rel="stylesheet" type="text/css" href="css/formMatch.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/acceuil.js"></script>
		<script src="javascript/profil.js"></script>
		<script src="javascript/pronosForm.js"></script>
		<script src="javascript/jquery.validVal.min.js"></script>
	</head>	
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in blackougedefault">



				<div style="width:100%;height:450px">
					<div style="width:100%;height:50px"></div>

					<?php
						if (addBonus($con))
						{
							echo "<div class='valideDemand' id='add_valideDemand'><img src='images/check.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Votre demande a été enregistrée.
								</br></br> Vous pouvez toujours modifier vos pronostics jusqu'à la date butoir sur votre Profil
								</div>";
						}
						else
						{
							echo "<div class='errorDemand' id='add_errDemand'><img src='images/alert.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Une erreur est survenue.</div>";
						}
					?>

					<div style="display: flex;justify-content: space-evenly;">	
						<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourProfil">
							Retour Profil
						</button>

						<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourAcceuil">
							Retour Accueil
						</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>