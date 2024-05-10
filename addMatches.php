<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }

require_once 'config.php';

function addMatches($con)
{
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$firstID = intval($_POST[ 'firstid' ]);
	$lastID = intval($_POST[ 'lastid' ]);

	$qry = " SELECT day FROM matches WHERE id_match = $firstID AND date > NOW() LIMIT 1";
	$result = mysqli_query($con, $qry);
	$num_row = mysqli_num_rows($result);
	if ($num_row != 1) {
		return false;
	}

	// $qry = " DELETE FROM pronostics WHERE id_joueur = $id and id_match >= $firstID AND id_match <= $lastID;";
	// $result = mysqli_query($con, $qry);
	// if (!$result) 
	// {
	// 	return false;
	// }


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

				if( is_numeric($home) && is_numeric($away) )
				{
					$qry = " DELETE FROM pronostics WHERE id_joueur = $id and id_match = $idMatch;";
					$result = mysqli_query($con, $qry);
					if (!$result) 
					{
						return false;
					}		

					$qry = " INSERT INTO pronostics (id_joueur, id_match, prono_home, prono_away) VALUES ($id, $idMatch, $home, $away);";
					$result = mysqli_query($con, $qry);
						if (!$result) {
							return false;
						}
				}
		}


		$firstID++;
	}

	return true;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier matches</title>
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
			if (addMatches($con))
			{

				echo "<div class='valideDemand' id='add_valideDemand'><img src='images/check.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Votre demande a été enregistrée.
			</br></br> Vous pouvez toujours modifier vos pronostics jusqu'à la date butoir sur votre Profil</div>";
			}
			else
				echo "<div class='errorDemand' id='add_errDemand'><img src='images/alert.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Une erreur est survenue.</div>";
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