<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

parse_str($_SERVER["QUERY_STRING"], $query);

if (isset($query['username'])) {
	$username = base64_decode($query['username']);

	include('config.php');
	
	$qry = "SELECT id_joueur, surnom FROM joueurs WHERE surnom='".$username."';";
	$res = mysqli_query($con, $qry);
	$row = mysqli_fetch_assoc($res);
	
	$_SESSION['id'] = $row['id_joueur'];
	$_SESSION['pseudo'] = $row['surnom'];
	$id = $row['id_joueur'];
	$pseudo = $row['surnom'];
}

if ($id == 0) { header('Location: index.php'); }

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>Bonus</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bandeau.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <script src="javascript/jquery-2.2.3.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <script src="javascript/login.js"></script>
    <script src="javascript/bandeau.js"></script>
    <script src="javascript/acceuil.js"></script>
    <script src="javascript/reglement.js"></script>

    <link rel="stylesheet" href="./material_design/material.css">
    <link rel="stylesheet" href="./material_design/style.css">
    <link rel="stylesheet" href="./material_design/font.css">
</head>

<body>
    <div style="display:none" id="idPhp" name='<?php echo $id ?>'></div>

    <?php include("background.php");?>
    <?php include("include/bandeau.php");?>

    <div class="padding20">
        <div class="loginform-in">
            <div style="width:100%;padding-bottom: 20px">
                <span class="RetourSpanContainer" style="padding-top: 20px;    margin: 0px 20px 0px 20px;">
                    <button
                        class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                        id="RetourButtonBlanc">
                        Retour
                    </button>
                </span>
                <table class="tableAcceuil" style="padding-top: 20px;">
                    <tr>
                        <td>
                            <div class="tableAcceuilBas">
                                <div class="bonus-favotire-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBg">
                                            <?php include("include/viewBonusFavorite.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Equipe favorite
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <table class="tableAcceuil">
                    <tr>
                        <td>
                            <div class="tableAcceuilResultat">
                                <div class="bonus-small-card-event bonus-card-event  mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBg">
                                            <?php include("include/viewBonusFirstBut.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Minute du premier but
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-small-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBg">
                                            <?php include("include/viewBonusLastBut.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Minute dernier but
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-small-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBg">
                                            <?php include("include/viewBonusTotalBut.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Nombre total de but
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <table class="tableAcceuil">
                    <tr>
                        <td>
                            <div class="tableAcceuilResultat">
                                <div class="bonus-medium-card-event bonus-card-event  mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBg">
                                            <?php include("include/viewBonusScorer.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Meilleur buteur
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-medium-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBg">
                                            <?php include("include/viewBonusPlayer.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Joueur vainqueur
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>