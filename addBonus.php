<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

require_once 'config.php';

function changeEtat($con)
{
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

	$qry = " UPDATE  joueurs SET modif_bonus = 1 
							WHERE id_joueur = $id";
	$result = mysqli_query($con, $qry);

}


function addBonus($con)
{
	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$qry = "";
	
	$qry = " DELETE FROM pronostics_bonus WHERE id_membre = $id;";
	$result = mysqli_query($con, $qry);
		if (!$result) {
			$return = false;
			return false;
		}
		else
			$return = true;


	$return = false;
	$team_winner_id = intval($_POST[ 'equipeWin' ]);
	// $min_first = intval($_POST[ 'MinPronosFirst' ]);
	// $min_last = intval($_POST[ 'MinPronosLast' ]);
	$total_but = intval($_POST[ 'totalBut' ]);
	// $best_scorer = addslashes(utf8_decode_function ($_POST[ 'InputTextBestScorer' ]));

	$qry = " INSERT INTO pronostics_bonus (id_membre
											, team_winner_id
											, total_but
										) 
										VALUES ($id, 
												$team_winner_id,
												$total_but
											);";
	$result = mysqli_query($con, $qry);
	if (!$result) {
		$return = false;
		return false;
	}
	else
		$return = true;
	return $return;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier bonus</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
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
		<link rel="stylesheet" href="./material_design/material.css">
		<link rel="stylesheet" href="./material_design/style.css">
		<link rel="stylesheet" href="./material_design/font.css">
	</head>
	
	<?php include("init.php");?>
	<?php include("background.php");?>

	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in blackougedefault">



				<div style="width:100%;height:450px">
					<div style="width:100%;height:50px"></div>

		<?php
			if (addBonus($con))
			{

				echo "<div class='valideDemand' id='add_valideDemand'><img src='images/check.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Votre demande a été enregistrée.
					</br></br> Merci pour cette enregistrement, vous pouvez toujours modifier vos pronostics jusqu'au 1er Juin dans la rubrique Profil
					</div>";
					changeEtat($con);
			}
				else
				echo "<div class='errorDemand' id='add_errDemand'><img src='images/alert.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Une erreur est survenue.</div>";
		?>

					<div style="display: flex;justify-content: space-evenly;">	
						<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourProfil">
							Retour Profil
						</button>

						<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourAcceuil">
							Retour Acceuil
						</button>
					</div>
				</div>

			</div>
		</div>
</body>
</html>