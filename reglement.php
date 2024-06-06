<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id == 0) { header('Location: index.php'); }

$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

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
                    <div class="reglement-titre-centre">La Odette Cup 2024</div>
                        <div class="reglement-text">La Odette Cup 2024 se joue sur l'<b>Euro 2024</b> en Allemagne.</div> 
                        
                        <div class="reglement-text">La Odette Cup est basée sur un <b>classement</b> à points sur <b>51 matches</b>.</div> 
                        <div class="reglement-text">Il existe deux manières de gagner des points :</div>      
                        <div class="reglement-sous-text">Le <b>pronostic</b> de chaque match de la compétition</div>
                        <div class="reglement-sous-text">Les <b>bonus</b> pendant ou en fin de compétition</div>
                    
                    <div class="reglement-titre">Pronostics</div>
                        <div class="reglement-text">Des points sont attribués à chaque match de la manière suivante :</div> 
                        <div class="reglement-point">
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectTitre">Perfect</div>
                                <div class="reglement-point-item-point perfectTitre">+7</div>
                                <div class="reglement-point-item-def">Le score exact du match.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectCorrectPlus">Correct+</div>
                                <div class="reglement-point-item-point perfectCorrectPlus">+4</div>
                                <div class="reglement-point-item-def">Le resultat du match et la différence de but entre les 2 équipes.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectCorrect">Correct</div>
                                <div class="reglement-point-item-point perfectCorrect">+3</div>
                                <div class="reglement-point-item-def">Le résultat du match.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectInverse">Inverse</div>
                                <div class="reglement-point-item-point perfectInverse">+1</div>
                                <div class="reglement-point-item-def">Le résultat inverse.</div>
                            </div>
                            <div class="reglement-point-item">
                                <div class="reglement-point-item-text perfectEchec">Echec</div>
                                <div class="reglement-point-item-point perfectEchec">0</div>
                                <div class="reglement-point-item-def">Tout autre résultat.</div>
                            </div>
                        </div>
                        
                    <div class="reglement-titre">Bonus</div>
                        <div class="reglement-sub-titre">Minute du premier but :</div> 
                        <div class="reglement-sub-text">Trouver la minute du premier but de la coupe du monde. Minutage officiel UEFA.</div>
                        <div class="reglement-sub-text">Seul le ou les plus proches marquent des points</div>
                        <div class="reglement-sub-text">Le plus proche marque <b>4 points</b></div>
                        <div class="reglement-sub-text">Si le minutage exact est trouvé <b>7 points</b></div>

                        <div class="reglement-sub-titre">Minute du dernier but :</div> 
                        <div class="reglement-sub-text">Trouver la minute du dernier but de la coupe du monde. Minutage officiel UEFA.</div>
                        <div class="reglement-sub-text">Seul le ou les plus proches marquent des points</div>
                        <div class="reglement-sub-text">Le plus proche marque <b>4 points</b></div>
                        <div class="reglement-sub-text">Si le minutage exact est trouvé <b>7 points</b></div>

                        <div class="reglement-sub-titre">Nombre total de buts :</div> 
                        <div class="reglement-sub-text">Trouve le nombre total de buts de la competition Euro 2024.</div>
                        <div class="reglement-sub-text">Seul le ou les plus proches marquent des points</div>
                        <div class="reglement-sub-text">Le plus proche marque <b>4 points</b></div>
                        <div class="reglement-sub-text">Si le nombre de buts exact est trouvé <b>7 points</b></div>

                        <div class="reglement-sub-titre">Fairplay :</div> 
                        <div class="reglement-sub-text">Trouve le nombre de cartons de la competition Euro 2024.</div>
                        <div class="reglement-sub-text">Un score qui comptabilise les cartons de la façon suivante :</div>
                        <div class="reglement-sub-text">+1 pour un carton jaune.</div>
                        <div class="reglement-sub-text">+2 pour un carton rouge.</div>
                        <div class="reglement-sub-text">Seul le ou les plus proches marquent des points</div>
                        <div class="reglement-sub-text">Le plus proche marque <b>4 points</b></div>
                        <div class="reglement-sub-text">Si le score exact est trouvé <b>7 points</b></div>

                        <div class="reglement-sub-titre">Pénalty :</div> 
                        <div class="reglement-sub-text">Trouve le nombre de pénalty sifflés pendant la competition Euro 2024.</div>
                        <div class="reglement-sub-text">Un penalty non converti est comptabilisé.</div>
                        <div class="reglement-sub-text">Seul le ou les plus proches marquent des points</div>
                        <div class="reglement-sub-text">Le plus proche marque <b>4 points</b></div>
                        <div class="reglement-sub-text">Si le score exact est trouvé <b>7 points</b></div>

                        <div class="reglement-sub-titre">Nombre de buts de l'Equipe de France :</div> 
                        <div class="reglement-sub-text">Trouve le nombre de buts marqués au total par l'Equipe de France.</div>
                        <div class="reglement-sub-text">Seul le nombre de buts exact marque des points.</div>
                        <div class="reglement-sub-text">Si le score exact est trouvé <b>5 points</b></div>
                        
                        <div class="reglement-sub-titre">Finalistes :</div> 
                        <div class="reglement-sub-text">Trouve les deux finalistes de la competition Euro 2024.</div>
                        <div class="reglement-sub-text">Si <b>1 finaliste</b> est trouvé <b>4 points</b></div>
                        <div class="reglement-sub-text">Si les <b>2 finalistes</b> sont trouvés <b>10 points</b></div>

                    <div class="reglement-titre">Paiement</div>
                        <div class="reglement-text">Une participation de <b>20€</b> est demandée. 10€ pour les mineurs</div>
                        <div class="reglement-text">Règlement par <b>chèque</b>, <b>espèce</b> ou <b>virement</b>.</div>
                    <div class="reglement-titre">Gains</div>
                    <?php if ($competition == 1) : ?>
                        <div class="reglement-text">4 places sont payées selon la règle suivante :</div>
                        
                        <div class="reglement-text">20€ de la cagnotte finale seront utilisés pour les frais du site.</div>
                        <div class="reglement-sous-text"><b>4ème</b> =  Remboursé</div>
                        
                        
                        <div class="reglement-sous-text">Avec le restant de la cagnotte :</div>
                        <div class="reglement-sous-text"><b>3ème</b> =  10% de la cagnotte</div>
                        <div class="reglement-sous-text"><b>2ème</b> =  30% de la cagnotte</div>

                        <div class="reglement-sous-text"><b>1er</b> =  60% de la cagnotte</div>
                        
                        
                    <?php endif; ?>

                    <?php if ($competition == 2) : ?>
                        <div class="reglement-text">3 places sont payées selon la règle suivante :</div>
                        <div class="reglement-sous-text"><b>1er</b> =  60% de la cagnotte</div>
                        
                        <div class="reglement-sous-text"><b>2ème</b> =  30% de la cagnotte</div>
                        
                        <div class="reglement-sous-text"><b>3ème</b> =  10% de la cagnotte</div>

                        <div class="reglement-text">20€ de la cagnotte finale seront utilisés pour les frais du site.</div>
                    <?php endif; ?>

                    <div class="reglement-titre">FAQ</div>
                        <div class="reglement-text">Que se passe-t-il en cas d'<b>égalité</b> au classement ?</div>
                        <div class="reglement-reponse-text">Le classement est calculé de la manière suivante : Le nombre de points, puis le moins de bonus, puis le moins d'echecs, puis le plus perfects, puis enfin le plus de correct+.</div>
                        <div class="reglement-text">Un exemple de <b>perfect</b> ?</div>
                        <div class="reglement-reponse-text">Bien sûr : Pronostic 2-1 /  Score 2-1 - Pronostic 3-0 /  Score 3-0 </div>
                        <div class="reglement-text">Un exemple de <b>correct +</b> ?</div>
                        <div class="reglement-reponse-text">Et voilà : Pronostic 2-1 /  Score 1-0 - Pronostic 1-1 /  Score 0-0 - Pronostic 2-0 /  Score 3-1</div>
                        <div class="reglement-text">Un exemple de <b>correct</b> alors ?</div>
                        <div class="reglement-reponse-text">Comme ça : Pronostic 1-0 /  Score 2-0 - Pronostic 3-0 /  Score 2-1</div>
                        <div class="reglement-text">Un exemple de <b>inverse</b> maintenant ?</div>
                        <div class="reglement-reponse-text">Simple : Pronostic 1-0 /  Score 0-1 - Pronostic 1-2 /  Score 2-1</div>
                        <div class="reglement-text">Un match <b>nul</b> c'est 4 points minimum ?</div>
                        <div class="reglement-reponse-text">Basique : Seulement si le match nul est trouvé. Oui. Le match nul est le score le plus risqué à trouver normal qu'il soit récompensé.</div>
                        <div class="reglement-text">Et les <b>bonus</b> ?</div>
                        <div class="reglement-reponse-text">Tout est expliqué dans le chapitre sur les bonus. Prenez le temps de bien le lire.</div>
                        <div class="reglement-text">Tu peux expliquer quand même le "<b>Un gagnant le plus proche</b>" ?</div>
                        <div class="reglement-reponse-text">C'est assez simple. Il y a aura toujours un vainqueur. Il n'y a plus de battements. Un seul vainqueur, le plus proche de la réponse ! Pour les minutes, les buts, les cartons et les pénalty. Si plusieurs joueurs sont premiers égalités tout le monde marquent des points.    </div>
                        <div class="reglement-text">Pour le fairplay ça marche comment <b>1 carton rouge</b> obtenu par <b>2 cartons jaunes</b> ?</div>
                        <div class="reglement-reponse-text">Dans ce cas, 2 points seulement sont ajoutés au score Fairplay. Le carton rouge "remplace" les cartons jaunes</div>
                        <div class="reglement-text">La <b>Finale</b> n'est plus <b>doublée</b> cette année ?</div>
                        <div class="reglement-reponse-text">Non ! Cette année la finale est un match comme les autres en terme de points.</div>
                
            </div>
        </div>
    </div>
</body>

</html>