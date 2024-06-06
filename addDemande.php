<?php
session_start();

require_once 'config.php';
require_once 'functions.php';

function addDemande($con)
{

	$nom = utf8_decode_function (sanitize_string($_POST[ 'required' ], $con));
	$prenom = utf8_decode_function (sanitize_string($_POST[ 'required_prenom' ], $con));
	$surnom = utf8_decode_function (sanitize_string($_POST[ 'check-surnom' ], $con));
	$mail = utf8_decode_function (sanitize_string($_POST[ 'Email-check' ], $con));
	$tel = utf8_decode_function (sanitize_string($_POST[ 'number' ], $con));
	$description = utf8_decode_function (sanitize_string($_POST[ 'description' ], $con));
	$payement = utf8_decode_function (sanitize_string($_POST[ 'payement' ], $con));

	$qry = "SELECT id_demande FROM demandes WHERE surnom='".$surnom."';";
	$res = mysqli_query($con, $qry);
	$num_row = mysqli_num_rows($res);
	$row = mysqli_fetch_assoc($res);
	if( $num_row == 1 ) 
	{
		return false;
	}
	else 
	{
		$qry = "SELECT id_demande FROM demandes WHERE mail='".$mail."';";
		$res = mysqli_query($con, $qry);
		$num_row = mysqli_num_rows($res);
		$row=mysqli_fetch_assoc($res);
		if( $num_row == 1 ) 
		{
			return false;
		}
		else 
		{
			$qry = "INSERT INTO demandes (nom, prenom, surnom, mail, telephone, payement, description) VALUES ('".$nom."','".$prenom."', '".$surnom."','".$mail."', '".$tel."', '".$payement."', '".$description."');";
			$result = mysqli_query($con, $qry);
			if (!$result) 
			{
				return false;
			}
			else 
			{
				return true;
			}
		}
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Demande</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<?php include("include/style.php");?>
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/demande.js"></script>

		<script src="javascript/jquery.validVal.min.js"></script>

		<link rel="stylesheet" href="./material_design/style.css">
	</head>

	<body>
		<div class="padding20">
			<div class="loginform-in blackougedefault" style="height:450px">
				<img src="images/Logo_UEFA_OCUP_2024_black.png" style="width: 110px;margin: 6px;"/>
				<div class="Retoudiv">
					<button class="Retour mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourProfil">
						Retour
					</button>
				</div>
			
				<?php
					if (addDemande($con)) 
					{
						echo "<div class='valideDemand' id='add_valideDemand'><img src='images/check.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Votre demande a été enregistrée.<div>Vous serez contacté par mail pour la poursuite de l'insciption.</div></div>";
					}
					else
					{
						echo "<div class='errorDemand' id='add_errDemand'><img src='images/alert.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Une erreur est survenue.</div>";
					}
				?>
			</div>
		</div>
	</body>
</html>