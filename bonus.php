<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

require_once 'config.php';
require_once 'functions.php';

$qry = "SELECT * FROM etat WHERE competition = $competition;";
$result = mysqli_query($con, $qry);
while ($row = mysqli_fetch_array($result )) 
{
    if ($row["attribut"] == "PRONOS_BONUS") {
        $modifBonus = $row["value"];
    }
    if ($row["attribut"] == "PRONOS") {
        $modifMatch = $row["value"];
    }
    if ($row["attribut"] == "JOKER") {
        $modifJoker = $row["value"];
    }
}
if ($id == 0) { header('Location: index.php'); }

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>Bonus</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php include("include/style.php");?>
    <link rel="stylesheet" type="text/css" href="css/bandeau.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <script src="javascript/jquery-2.2.3.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <script src="javascript/login.js"></script>
    <script src="javascript/bandeau.js"></script>
    <script src="javascript/acceuil.js"></script>
    <script src="javascript/reglement.js"></script>
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
                <?php if ($modifBonus == 0) { ?>
                <table class="tableAcceuil" style="padding-top: 20px;">
                    <tr>
                        <td>
                            <div class="tableAcceuilBas">
                                <div class="bonus-favotire-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil">
                                            <?php include("include/viewBonusFavorite.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Equipes finalistes
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
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBig">
                                            <?php include("include/viewBonusFirstBut.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Premier but
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-small-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBig">
                                            <?php include("include/viewBonusLastBut.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Dernier but
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-small-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBig">
                                            <?php include("include/viewBonusTotalBut.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Total buts
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
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBig">
                                            <?php include("include/viewBonusPenalty.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Penalty
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-small-card-event bonus-card-event mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBig">
                                            <?php include("include/viewBonusFairplay.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Fairplay
                                        </a>
                                    </div>
                                </div>
                                <div class="bonus-small-card-event bonus-card-event  mdl-card mdl-shadow--2dp">
                                    <div class="mdl-card__title mdl-card--expand">
                                        <div class="cadreTableauAcceuil cadreTableauAcceuilBig">
                                            <?php include("include/viewBonusButEdf.php");?>
                                        </div>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            Buts EdF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php } else { ?>
                    <div class="bonus-empty">
                        Les bonus ne sont pas encore ouvert à tous.
                    </div>
                    <div class="bonus-empty-phrase-middle">
                        Il reste encore du temps pour les modifier.
                    </div>
                    <div class="bonus-empty-phrase">
                        Reviens quand tous les pronostics seront validés pour avoir une belle vue d'ensemble sur tous les bonus, INCROYABLE !
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>