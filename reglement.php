<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id == 0) { header('Location: index.php'); }

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>Règlement</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/png" href="images/favicon.png" />
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
    <div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
    <?php include("background.php");?>
    <?php include("include/bandeau.php");?>
    <div class="padding20">
        <div class="loginform-in blackougedefault">
            <div style="padding: 1px 0;">
                <span class="listeJoueurTitre">Règlement</span>
                <span class="RetourSpanContainer">
                    <button
                        class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                        id="RetourButtonBlanc">
                        Retour
                    </button>
                </span>
                <div class="reglementDiv">
                    <p>
                    <h3>Règles sur chaque match</h3>
                    <div class="sousTitre perfectTitre">Perfect</div>
                    <ul class="ulperso">
                        <li class="pointRegle reglePoint">7 points</li>
                        <li class="pointRegle regleDetail">Trouver le score exact du match.</li>
                        <li class="pointRegle regleExemple">Exemple : <span class="regleExempleCorp">Pronostic 2-1 -
                                Score 2-1 : + 7 points</span></li>
                    </ul>
                    <div class="sousTitre perfectCorrectPlus">Correct +</div>
							<ul class="ulperso">
								<li class="pointRegle reglePoint" >4 points</li>
								<li class="pointRegle regleDetail" >Trouver le vainqueur du match et la différence de but entre les 2 équipes.</li>
								<li class="pointRegle regleExemple" >Exemple : <span class="regleExempleCorp">Pronostic 2-1 - Score 1-0 : + 4 points</span></li>
								<div style="margin-left: 145px;"><span class="regleExempleCorp">Pronostic 1-1 - Score 0-0 : + 4 points</span></div>
                                <div style="margin-left: 145px;"><span class="regleExempleCorp">Pronostic 2-0 - Score 3-1 : + 4 points</span></div>
							</ul>
                    <div class="sousTitre perfectCorrect">Correct</div>
                    <ul class="ulperso">
                        <li class="pointRegle reglePoint">3 points</li>
                        <li class="pointRegle regleDetail">Trouver le résultat du match.</li>
                        <li class="pointRegle regleExemple">Exemple : <span class="regleExempleCorp">Pronostic 2-1 -
                                Score 3-0 : + 3 points</span></li>
                        <div style="margin-left: 145px;"><span class="regleExempleCorp">Pronostic 1-0 - Score 2-0 : + 3
                                points</span></div>
                    </ul>
                    <div class="sousTitre perfectEchec">Echec</div>
                    <ul class="ulperso">
                        <li class="pointRegle reglePoint">0 point</li>
                        <li class="pointRegle regleDetail">Tout autre résultat.</li>
                        <li class="pointRegle regleExemple">Exemple : <span class="regleExempleCorp">Pronostic 2-1 -
                                Score 0-2 : + 0 point</span></li>
                        <div style="margin-left: 145px;"><span class="regleExempleCorp">Pronostic 1-1 - Score 1-0 : + 0
                                point</span></div>
                    </ul>

                

                    <!-- <h3>Dates</h3>
                    <ul class="ulperso">
                        <li class="pointRegle">17 octobre 2022 : ouverture aux inscriptions.</li>
                        <li class="pointRegle">18 novembre 2022 : fermeture des inscriptions et des pronostics.
                            Ouverture de tous les pronostics à tout le monde.</li>
                        <li class="pointRegle">20 novembre 2022 : match d'ouverture de la coupe du monde 2022</li>
                        <li class="pointRegle">Les matches de phase finale : pour les 8èmes, quarts, demies et finale
                            tous les pronostics seront à rentrer en ligne.</li>
                    </ul> -->

                    <!-- <h3>Engagement dans le concours</h3>
                    <p>
                        <li class="pointRegle">20€ par joueur adulte</li>
                        <li class="pointRegle">10€ par joueur mineur</li>
                        <li class="pointRegle">A payer avant le 17 novembre 2022 par virement</li>
                    </p> -->

                <!-- <h3>Tableau des gains</h3>
                <p>
                    <span class="pointRegle">Le tableau des gains sera calculé selon le nombre de participants avec
                        la base de calcul suivante.</span> -->
                        <!--Total des gains 345 € (21 adultes x 15 € = 315 € + 3 mineurs x 10 = 30 €)</br></br>--->
                <!-- <ul class="ulperso">
                    <li class="pointRegle">1er = 65 %
                    <li class="pointRegle">2ème = 25 %
                    <li class="pointRegle">3ème = 10 %
                    <li class="pointRegle">4ème = Remboursé
                </ul> -->
                    <!-- Lot restant 330 €</br>

							1er  = 214,50 €</br>
							2em  = 82,50 €</br>
							3em  = 33 €</br> -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>