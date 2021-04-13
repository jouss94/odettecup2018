<?php
session_start();

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

require_once 'config.php';

function changeEtat($con)
{
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

	$qry = " UPDATE  joueurs SET modif_match = 1 
							WHERE id_joueur = $id";
	$result = mysqli_query($con, $qry);

}

function addMatches($con)
{

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$firstID = intval($_POST[ 'firstid' ]);
	$lastID = intval($_POST[ 'lastid' ]);
	$qry = "";

	$qry = " DELETE FROM pronostics WHERE id_membre = $id and id_match >= $firstID AND id_match <= $lastID;";
	$result = mysqli_query($con, $qry);
		if (!$result) {
			$return = false;
			return false;
		}
		else
			$return = true;


	$return = false;
	while ($firstID <= $lastID)
	{

		$idMatch = $firstID;
		$idHome = "numberMatch_" . $firstID . "_home";
		$idAway = "numberMatch_" . $firstID . "_away";

		if( isset($_POST[ $idHome ]) && isset($_POST[ $idAway ]))
		{
				$home = $_POST[ $idHome ];
				$away = $_POST[ $idAway ];

				// echo $idMatch . " - ";
				$qry = " INSERT INTO pronostics (id_membre, id_match, prono_home, prono_away) VALUES ($id, $idMatch, $home, $away);";
				$result = mysqli_query($con, $qry);
					if (!$result) {
						$return = false;
						return false;
					}
					else
						$return = true;

		}


		$firstID++;
	}

	return $return;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier matches</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/icon-france.png" />
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
		<script src="./material_design/material.js"></script>

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
			if (addMatches($con))
			{

				echo "<div class='valideDemand' id='add_valideDemand'><img src='images/check.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Votre demande a été enregistrée.
			</br></br> Merci pour cette enregistrement, vous pouvez toujours modifier vos pronostics jusqu'au 1er Juin dans la rubrique Profil</div>";
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