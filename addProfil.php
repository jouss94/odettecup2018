<?php
session_start();

$id = (isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo = (isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

if ($id == 0) { header('Location: index.php'); }

require_once 'config.php';
include("functions.php");

function move_image($image)
{
	/*
    $extension_upload = strtolower(substr(  strrchr($image['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "./images/user/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($image['tmp_name'],$name);
	*/

    $dossier = 'images/user/';
    $fichier = basename($_FILES['imageProfil']['name']);
   	if ($fichier == "" ) 
	{
		return "";
	}
    move_uploaded_file($_FILES['imageProfil']['tmp_name'], $dossier . $fichier);
    return $dossier . $fichier;
}

function checkFile()
{
	if (!empty($_FILES['imageProfil']['size']))
	{
		//On définit les variables :
		$maxsize = 9000000; //Poid de l'image
		$maxwidth = 10000; //Largeur de l'image
		$maxheight = 10000; //Longueur de l'image
		//Liste des extensions valides
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
	
		if ($_FILES['imageProfil']['error'] > 0)
		{
			return "Erreur lors du tranfsert de l'avatar : ";
		}
		if ($_FILES['imageProfil']['size'] > $maxsize)
		{
			return "Le fichier est trop gros :
			(<strong>".$_FILES['imageProfil']['size']." Octets</strong>
			contre <strong>".$maxsize." Octets</strong>)";
		}
	
		$image_sizes = getimagesize($_FILES['imageProfil']['tmp_name']);
		if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
		{
			return "Image trop large ou trop longue :
			(<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
			<strong>".$maxwidth."x".$maxheight."</strong>)";
		}
	
		$extension_upload = strtolower(substr(  strrchr($_FILES['imageProfil']['name'], '.')  ,1));
		if (!in_array($extension_upload,$extensions_valides) )
		{
			return "Extension de l'avatar incorrecte";
		}
	}
	return "";

}

function changeEtat($con)
{
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

	$qry = " UPDATE  joueurs SET modif_profil = 1 
							WHERE id_joueur = $id";
	$result = mysqli_query($con, $qry);
}

function addProfil($con)
{

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$qry = "";

	$return = "";
	$prenomProfil = addslashes(utf8_decode_function ($_POST[ 'prenomProfil' ]));
	$nomProfil = addslashes(utf8_decode_function ($_POST[ 'nomProfil' ]));
	$mpdProfil = addslashes(utf8_decode_function ($_POST[ 'mpdProfil' ]));
	$description = addslashes(utf8_decode_function ($_POST[ 'description' ]));
	$emailProfil = addslashes(utf8_decode_function($_POST[ 'emailProfil' ]));
	$telProfil = addslashes(utf8_decode_function ($_POST[ 'telProfil' ]));

 	$fileResult = checkFile();
 	if ($fileResult != "") 
	{
		return $fileResult;
	}

 	$filename=move_image($_FILES['imageProfil']);
		                
	$qry = " UPDATE  joueurs SET prenom = '$prenomProfil' ,
								nom = '$nomProfil' ,
								email = '$emailProfil',
								password = '$mpdProfil', 
								description = '$description', ";
								if ($filename != "")
									$qry .= " image = '$filename',";
								$qry .= " telephone = '$telProfil'
			WHERE id_joueur = $id";
	$result = mysqli_query($con, $qry);
	if (!$result) {
		$return = false;
		return "Error description: " . mysqli_error($con);
	}
	else {
		$return = "";
	}

	return $return;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Modifier bonus</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/png" href="images/favicon.png" />
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
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'></div>
		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in blackougedefault">
				<div style="width:100%;height:450px">
					<div style="width:100%;height:50px"></div>

					<?php
						$addResult = addProfil($con);
						if ($addResult == "")
						{

							echo "<div class='valideDemand' id='add_valideDemand'><img src='images/check.png' style='width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;' />Votre Profil a été modifié.
								</br></br> Vous pouvez à tout moment modifier votre profil.
								</div>";
							changeEtat($con);
						}
						else
							echo '<div class="errorDemand" id="add_errDemand"><img src="images/alert.png" style="width: 40px;display:block;margin: auto;margin-top: 15px;padding-bottom: 30px;" />Une erreur est survenue : "'.$addResult.'".</div>';
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