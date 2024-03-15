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
                    <div class="reglement-titre-centre">La Odette Ligue</div>
                        <div class="reglement-text">La Odette Ligue se joue avec <b>Ligue 1 Uber Eats</b>.</div> 
                        <div class="reglement-text"><b>Deux</b> compétitions par an. Une sur la phase <b>aller</b>, une sur la phase <b>retour.</b> </div>
                        <div class="reglement-text"><b>17</b> journées de championnat réparties de la manière suivante :</div>
                        <div class="reglement-sous-text"><b>12</b> journées de saison régulière</div>
                        <div class="reglement-sous-text"><b>5</b> journées de playoffs</div>
                        <div class="reglement-text"></div>
                        <div class="reglement-text">Un <b>classement</b> final est établi à la fin de la <b>12ème</b> journée. </div>
                        <div class="reglement-text">Les <b>playoffs</b> pourront alors démarer jusqu'à la grande finale lors de la <b>17ème</b> journée.</div>
                    
                    <div class="reglement-titre">Les points</div>
                        <div class="reglement-text">Des points sont attribués à chaque match de la manière suivante :</div> 
                        <div class="reglement-point">
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectTitre">Perfect</div>
                                <div class="reglement-point-item-point perfectTitre">+7</div>
                                <div class="reglement-point-item-def">Le score exact du match.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectCorrectPlus">Correct +</div>
                                <div class="reglement-point-item-point perfectCorrectPlus">+4</div>
                                <div class="reglement-point-item-def">Le resultat du match et la différence de but entre les 2 équipes.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectCorrect">Correct</div>
                                <div class="reglement-point-item-point perfectCorrect">+3</div>
                                <div class="reglement-point-item-def">Le résultat du match.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectEchec">Echec</div>
                                <div class="reglement-point-item-point perfectEchec">0</div>
                                <div class="reglement-point-item-def">Tout autre résultat.</div>
                            </div>
                        </div>
                        
                    <div class="reglement-titre">Playoffs</div>
                        <div class="reglement-text">Un playoff est un face à face entre <b>deux</b> joueurs.</div>
                        <div class="reglement-text">Celui qui a fait le plus de <b>points</b> sur les <b>9</b> matches du week-end est le <b>gagnant</b>.</div>
                        <div class="reglement-text">En cas d'<b>égalité</b> celui qui a le <b>meilleur classement</b> gagne.</div>
                        <div class="reglement-text"></div>
                        <div class="reglement-text">Les playoffs démarrent après la <b>12ème journée</b> quand le <b>classement</b> est définitif.</div> 
                        <div class="reglement-text">Le tirage au sort du tableau est fait lors de la <b>première journée</b>.</div>
                        <div class="reglement-text">Quand tous les participants sont connus, le tableau est disponible dans <b><a class="reglement-link" href="playoffs.php"> playoffs</a></b>.</div> 
                        <div class="reglement-text">Le tableau est différent selon le nombre de <b>participants</b> afin d'avoir le plus de monde qualifié.</div> 
                        <div class="reglement-text">Le <b>premier</b> du classement est directement qualifié pour les <b>demi-finales</b>.</div>

                    <div class="reglement-titre">Paiement</div>
                        <div class="reglement-text">Une participation de <b>25€</b> est demandée.</div>
                        <div class="reglement-text">Règlement par <b>chèque</b>, <b>espèce</b> ou <b>virement</b>.</div>
                    <div class="reglement-titre">Gains</div>
                        <div class="reglement-text">4 places sont payées selon la règle suivante :</div>
                        <div class="reglement-sous-text">Les <b>2 perdants</b> des demi-finales (12%)</div>
                        <div class="reglement-sous-text">Le <b>finaliste</b> (25%)</div>
                        <div class="reglement-sous-text">Le <b>grand vainqueur</b> (50%)</div>
                        <div class="reglement-text">20€ de la cagnotte finale seront utilisés pour les frais du site.</div>

                    <div class="reglement-titre">FAQ</div>
                        <div class="reglement-text">En cas de match <b>reporté</b> ?</div>
                        <div class="reglement-reponse-text">Si le match est pendant la saison régulière et qu'il est rejoué avant la 12ème journée les points seront compatibilisés. Dans tout autres cas, le match est annulé et exempté pour la journée de classement ou de playoff</div>
                        <div class="reglement-text">Un exemple de <b>perfect</b> ?</div>
                        <div class="reglement-reponse-text">Bien sûr : Pronostic 2-1 /  Score 2-1 - Pronostic 3-0 /  Score 3-0 </div>
                        <div class="reglement-text">Un exemple de <b>correct +</b> ?</div>
                        <div class="reglement-reponse-text">Et voilà : Pronostic 2-1 /  Score 1-0 - Pronostic 1-1 /  Score 0-0 - Pronostic 2-0 /  Score 3-1</div>
                        <div class="reglement-text">Un exemple <b>correct</b> alors ?</div>
                        <div class="reglement-reponse-text">Simple : Pronostic 1-0 /  Score 2-0 - Pronostic 3-0 /  Score 2-1</div>
                        <div class="reglement-text">Un match <b>nul</b> c'est 4pts minimum ?</div>
                        <div class="reglement-reponse-text">Basique : Seulement si le match nul est trouvé. Oui. Le match nul est le score le plus risqué à trouver normal qu'il soit récompensé.</div>
                        <div class="reglement-text">Et les <b>bonus</b> ?</div>
                        <div class="reglement-reponse-text">Ici c'est le football qui parle ! Le vainqueur sera celui qui sera le plus régulier.</div>

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