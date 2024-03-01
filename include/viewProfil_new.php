<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$current_day_update = $GLOBALS['current_day'];
	$current_day_in_progress_update = $GLOBALS['current_day_in_progress'];
	if ($current_day_in_progress_update) {
		$current_day_update++;
	}

	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

	$qry = "SELECT * FROM joueurs 
	LEFT JOIN pronostics pronos ON pronos.id_joueur = $id 
	LEFT JOIN matches ON matches.id_match = pronos.id_match  
	WHERE joueurs.id_joueur=$id and day = $current_day_update
	";
	$res = mysqli_query($con, $qry);
	$nb = mysqli_num_rows($res);

	// $modifMatch = false;
	// $modifBonus = false;
	// $modifJoker = false;

	// $qry = "SELECT * FROM etat WHERE competition = $competition;"; // CHANGE HERE
	// $result = mysqli_query($con, $qry);
	// while ($row = mysqli_fetch_array($result )) 
	// {
	// 	if ($row["attribut"] == "PRONOS_BONUS") {
	// 		$modifBonus = $row["value"];
	// 	}
	// 	if ($row["attribut"] == "PRONOS") {
	// 		$modifMatch = $row["value"];
	// 	}
	// 	if ($row["attribut"] == "JOKER") {
	// 		$modifJoker = $row["value"];
	// 	}
	// }

	$qry = "SELECT 
		*,
		joueurs.image as joueursimage,
		joueurs.nom as joueursnom,
		general.rang as generalrang,
		general.points as generalpoints,
		joueurs.color as joueursColor,
		equipe_winner.logo as logo
	FROM joueurs 
	LEFT JOIN classements as general ON general.owner_id = joueurs.id_joueur AND general.type = 'general' 
	LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = joueurs.equipe
	WHERE id_joueur='".$idProfil."';";
	$result = mysqli_query($con, $qry);
	$find = false;

	if ($result) {
		while ($row = mysqli_fetch_array($result )) 
		{
			$find=true;

			$joueursColor = $row["joueursColor"];
			$surnom = utf8_encode_function($row["surnom"]);
			$logo = $row["logo"];
			$joueursimage = utf8_encode_function($row["joueursimage"]);
			$prenom = utf8_encode_function($row["prenom"]);
			$nom = utf8_encode_function($row["nom"]);
			$email = utf8_encode_function($row["email"]);
			$telephone = utf8_encode_function($row["telephone"]);
			$description = utf8_encode_function($row["description"]);
			$modif_profil = intval($row["modif_profil"]);
			$modif_match = intval($row["modif_match"]);
			$modif_bonus = intval($row["modif_bonus"]);
			$payed = intval($row["payed"]);
			$generalrang = intval($row["generalrang"]);
			$generalpoints = intval($row["generalpoints"]);
			$nb_perf = intval($row["nb_perf"]);
			$nb_correct = intval($row["nb_correct"]);
			$nb_correct_plus = intval($row["nb_correct_plus"]);
			$nb_echec = intval($row["nb_echec"]);
			$bonus = intval($row["bonus"]);
		}
	}
?>

<!-- IF NOT FIND ERROR -->

<div class="profilPage-info">
    <div class="profilPage-info-perso">
        <div class="profilPage-info-perso-surnom">
            <?php echo $surnom;?>
        </div>
        <div class="profilPage-info-perso-photo">
            <img src="<?php echo $joueursimage;?>" class="profilPage-info-perso-photo-img" />
        </div>
        <?php if($idProfil == $id): ?>
        <div class="profilPage-info-perso-modifprofil">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                id="ModifierProfil">
                Modifier Profil
            </button>
        </div>
        <?php endif ;?>
    </div>
    <div class="profilPage-info-citation">
        <blockquote class="profilPage-info-citation-content"><?php echo $description;?></blockquote><cite
            class="profilPage-info-citation-content-cite"><?php echo $prenom;?> <?php echo $nom;?></cite>
    </div>
    <div class="profilPage-info-about">
        <div class="profilPage-info-about-profil">
            <div class="profilPage-info-about-title-petit">Profil à jour</div>
            <div class="checkbox-wrapper-22">
                <label class="switch" for="checkbox-profil">
                    <input type="checkbox" id="checkbox-profil" disabled
                        <?php if ($modif_profil == 1 && $nb == 9) echo 'checked';?> />
                    <div class="slider round"></div>
                </label>
            </div>
        </div>
        <div class="profilPage-info-about-profil">
            <div class="profilPage-info-about-title">Paiement</div>
            <div class="checkbox-wrapper-22">
                <label class="switch" for="checkbox-paiement">
                    <input type="checkbox" id="checkbox-paiement" disabled <?php if ($payed) echo 'checked';?> />
                    <div class="slider round"></div>
                </label>
            </div>
        </div>
        <!-- <div class="profilPage-info-about-title">
		Informations
		</div>
		<div class="profilPage-info-about-content">
			<div class="profilPage-info-about-content-prenom">
				Prénom : <span class="profilPage-info-about-content-value"><?php echo $prenom;?></span>
			</div>
			<div class="profilPage-info-about-content-nom">
				Nom : <span class="profilPage-info-about-content-value"><?php echo $nom;?></span>
			</div>
			<div class="profilPage-info-about-content-email">
				Email : <span class="profilPage-info-about-content-value"><?php echo $email;?></span>
			</div>
			<div class="profilPage-info-about-content-telephone">
				Téléphone : <span class="profilPage-info-about-content-value"><?php echo $telephone;?></span>
			</div>
			<div class="profilPage-info-about-content-telephone">
				Profil : <?php if ($modif_profil == 1 && $modif_match == 1 && $modif_bonus == 1) echo 1; else echo 0;?>
			</div>
			<div class="profilPage-info-about-content-telephone">
				Paiement : <?php if ($payed) echo 1; else echo 0;?>
			</div>
		</div> -->
    </div>
</div>




<div class="profilPage-content">
		<span class="RetourSpan RetourSpan-profil">
			<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
				Retour
			</button>
		</span>
    <div class="profilPage-content-pronos">
        <div class="profilPage-content-pronos-list">
            <div class="profilPage-info-perso-modif">
            <?php if($idProfil == $id): ?>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    id="modifierMatch">
                    Modifier matches
                </button>
				<?php endif ;?>
            </div>
            <?php

echo '
	<div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault">
		<div class="mdl-card__title mdl-card--expand">
			<div style="width:100%" class="cadreTableau cadreTableauMatch">';
			
			include("include/viewProfil_matchDay.php");
									
			echo '
		</div>
	</div>';
?>

        </div>
    </div>
    <div class="profilPage-content-stats">

		<?php 


		$qry = "SELECT COUNT(*) as played FROM `matches` WHERE played = 1;";
		$result = mysqli_query($con, $qry);
		$showStat = false;
		while ($row = mysqli_fetch_array($result )) 
		{
			if (intval($row["played"]) > 0) {
				$showStat = true;
			}
		}
		
		// $bonus = 10;
		$nb_perf_point = $nb_perf * 7;
		$nb_correct_point = $nb_correct * 3;
		$nb_correct_plus_point = $nb_correct_plus * 4;
		$nb_echec;
		
		$nb_total_point = $nb_perf_point + $nb_correct_point + $nb_correct_plus_point;
		$nb_total = $nb_perf + $nb_correct + $nb_correct + $nb_echec;

		$nb_total_point = max($nb_perf_point, $nb_correct_point, $nb_correct_plus_point);
		$nb_total = max($nb_perf, $nb_correct, $nb_correct_plus, $nb_echec);

		$pc_perf_match = 7;
		$pc_correct_match = 7;
		$pc_correct_plus_match = 7;
		$pc_echec_match = 7;
		if ($nb_total != 0) {
			$pc_perf_match = ($nb_perf * 93 / $nb_total) + 7;
			$pc_correct_match = ($nb_correct * 93 / $nb_total) + 7;
			$pc_correct_plus_match = ($nb_correct_plus * 93 / $nb_total) + 7;
			$pc_echec_match = ($nb_echec * 93 / $nb_total) + 7;
		}

		$pc_perf_point = 7;
		$pc_correct_point = 7;
		$pc_correct_plus_point = 7;
		$pc_echec_point = 7;
		if ($nb_total_point != 0) {
			$pc_perf_point = ($nb_perf_point * 93 / $nb_total_point) + 7;
			$pc_correct_point = ($nb_correct_point * 93 / $nb_total_point) + 7;
			$pc_correct_plus_point = ($nb_correct_plus_point * 93 / $nb_total_point) + 7;
			$pc_echec_point = 7;
		}

		?>


		<div class="profilPage-content-stat">
			<div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault stats">

				<?php if ($showStat) { ?>
				
				<div class="profilPage-content-stats-bars">
					<div class="profilPage-content-stats-bars-line">
						<div class="profilPage-content-stats-bars-line-match">
							<div style=" width:<?php echo $pc_perf_match?>%; " class="profilPage-content-stats-bars-line-match-bar bar-perfect">
								<?php echo $nb_perf?>
							</div>
						</div>
						<div class="profilPage-content-stats-bars-line-titre">
							Perfect
						</div>
						<div class="profilPage-content-stats-bars-line-point">
							<div style=" width:<?php echo $pc_perf_point?>%; " class="profilPage-content-stats-bars-line-point-bar bar-perfect">
								<?php echo $nb_perf_point?>pts
							</div>
						</div>
					</div>
					<div class="profilPage-content-stats-bars-line">
						<div class="profilPage-content-stats-bars-line-match">
							<div  style=" width:<?php echo $pc_correct_plus_match?>%; " class="profilPage-content-stats-bars-line-match-bar bar-correct-plus">
								<?php echo $nb_correct_plus?>
							</div>
						</div>
						<div class="profilPage-content-stats-bars-line-titre">
							Correct+
						</div>
						<div class="profilPage-content-stats-bars-line-point">
							<div style=" width:<?php echo $pc_correct_plus_point?>%; " class="profilPage-content-stats-bars-line-point-bar bar-correct-plus">
								<?php echo $nb_correct_plus_point?>pts
							</div>
						</div>
					</div>
					<div class="profilPage-content-stats-bars-line">
						<div class="profilPage-content-stats-bars-line-match">
							<div  style=" width:<?php echo $pc_correct_match?>%; " class="profilPage-content-stats-bars-line-match-bar bar-correct">
								<?php echo $nb_correct?>
							</div>
						</div>
						<div class="profilPage-content-stats-bars-line-titre">
							Correct
						</div>
						<div class="profilPage-content-stats-bars-line-point">
							<div  style=" width:<?php echo $pc_correct_point?>%; " class="profilPage-content-stats-bars-line-point-bar bar-correct">
								<?php echo $nb_correct_point?>pts
							</div>
						</div>
					</div>
					<div class="profilPage-content-stats-bars-line">
						<div class="profilPage-content-stats-bars-line-match">
							<div style=" width:<?php echo $pc_echec_match?>%; " class="profilPage-content-stats-bars-line-match-bar bar-echec">
								<?php echo $nb_echec?>
							</div>
						</div>
						<div class="profilPage-content-stats-bars-line-titre">
							Echec
						</div>
						<div class="profilPage-content-stats-bars-line-point">
							<div style=" width:<?php echo $pc_echec_point?>%; "  class="profilPage-content-stats-bars-line-point-bar bar-echec">
								N/A
							</div>
						</div>
					</div>
				</div>
				<?php } else { ?>
					<div class="profilPage-content-stats-waiting-titre">
						Les statistiques ne sont pas encore disponible.
					</div>
					<div class="profilPage-content-stats-waiting-phrase">
						Mais reviens plus tard, tu verras c'est stylé de ouf !	
					</div>
				<?php } ?>
			</div>
		</div>

    </div>
</div>