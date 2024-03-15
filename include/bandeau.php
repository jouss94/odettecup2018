<?php

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

require_once 'config.php';
require_once 'functions.php';

getCurrentDay($con);
getCurrentDayPlus2($con);
getCurrentDayInProgress($con, $GLOBALS['current_day']);

?>

<link
    href="https://fonts.googleapis.com/css2?family=Acme&family=Bungee&family=Bungee+Spice&family=Dosis:wght@200..800&family=Kalam:wght@300;400;700&family=Lexend:wght@100..900&family=Libre+Barcode+128+Text&family=Mynerve&family=Orbitron:wght@400..900&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Special+Elite&family=Yanone+Kaffeesatz:wght@200..700&display=swap"
    rel="stylesheet">

<div id="mySidenav" class="sidenav">
    <img src="images/OdetteLigue-V3.0.png" class="sidenav-logo" />
    <div class="sidebar-content">
        <div class="sidebar-content-item">
            <a href="acceuil.php">Accueil</a>
        </div>
        <div class="sidebar-content-item">
            <a href="calendrier.php">Calendrier</a>
        </div>
        <div class="sidebar-content-item">
            <a href="profil.php?id=<?php echo $id ?>">Profil</a>
        </div>
        <div class="sidebar-content-item">
            <a href="classement.php?ranking=General">Classement</a>
        </div>
        <div class="sidebar-content-item">
            <a href="playoffs.php">Playoffs</a>
        </div>
        <div class="sidebar-content-item">
            <a href="trombi.php">Joueurs</a>
        </div>
        <div class="sidebar-content-item" style="border-bottom:none;">
            <a href="reglement.php">Règlement</a>
        </div>
    </div>
    <div class="version">V<?php echo $version ?></div>
</div>

<div id="myTopnav" class="topnav">
    <div class="topnav-content">
        <div class="topnav-content-item">
            <a href="profil.php?id=<?php echo $id ?>">Profil</a>
        </div>
        <?php if($id == 1): ?>
        <div class="topnav-content">
            <div class="topnav-content-item">
                <a href="admin.php">Admin</a>
            </div>
        </div>
        <?php endif ;?>
        <!-- <div class="topnav-content-item">
            <a href="options.php">Options</a>
        </div> -->
        <div class="topnav-content-item topnav-content-item-last">
            <a href="deconnect.php">Déconnexion</a>
        </div>
    </div>
</div>

<table class="bandeau">
    <tr>
        <td id="bandeauMenuBurger">
            <i id="bandeauMenuBurgerButton" class="material-icons">menu</i>
            <i id="bandeauCloseBurgerButton" class="material-icons bandeauMenuBurgerHidden">close</i>
        </td>
        <td id="bandeauAcceuil">
            <i class="material-icons">home</i>
        </td>
        <td id="bandeauNom">
            Odette Ligue - Journée <?php echo $GLOBALS['current_day_plus_2'] ?>
        </td>

        <!-- <?php if($id == 1): ?>
        <td id="bandeauAdmin">
            <div class="flex">
                <span class="material-icons">settings</span>
                <span class="bandeauText">Admin</span>
            </div>
        </td>
        <?php endif ;?> -->

        <td id="bandeauProfil">
            <div class="flex">
                <span class="material-icons">person</span>
                <span class="bandeauText"><?php echo $pseudo ?></span>
            </div>
        </td>
        <!-- <td id="bandeauDeconnect">
            <div class="flex">
                <span class="material-icons">close</span>
                <span class="bandeauText">Déconnexion</span>
            </div>
        </td> -->
    </tr>
</table>