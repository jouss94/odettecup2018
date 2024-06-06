<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

	$modifMatch = false;
	$modifBonus = false;
	$modifJoker = false;

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
			$nb_inverse = intval($row["nb_inverse"]);
			$nb_echec = intval($row["nb_echec"]);
			$nb_correct_plus = intval($row["nb_correct_plus"]);
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
		<div class="profilPage-info-about-rang">
			<div class="profilPage-info-about-profil-classement"><?php echo $generalpoints;?> points</div>
			<div class="profilPage-info-about-profil-points"><?php echo $generalrang; if ($generalrang == 1) echo 'er'; else echo 'ème'; ?> </div>
		</div>
        <div class="profilPage-info-about-profil">
            <div class="profilPage-info-about-title-petit">Profil à jour</div>
            <div class="checkbox-wrapper-22">
                <label class="switch" for="checkbox-profil">
                    <input type="checkbox" id="checkbox-profil" disabled
                        <?php if ($modif_profil == 1 && $modif_match == 1 && $modif_bonus == 1) echo 'checked';?> />
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
            <?php if($idProfil == $id && $modifMatch == 1): ?>
            <div class="profilPage-info-perso-modif">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    id="modifierMatch">
                    Modifier matches
                </button>
            </div>
			<?php endif ;?>
            <?php
	echo '
	<div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault">
		<div class="mdl-card__title mdl-card--expand">
			<div style="width:100%" class="cadreTableau cadreTableauMatch">';

			$qry = "SELECT * ,
							equipe_home.name  as home_name,
							equipe_home.logo  as home_logo,
							equipe_away.name  as away_name,
							equipe_away.logo  as away_logo
					FROM pronostics   
					LEFT JOIN matches ON matches.id_match = pronostics.id_match  
					LEFT JOIN equipes equipe_home ON equipe_home.id_equipe = matches.id_team_home 
					LEFT JOIN equipes equipe_away ON equipe_away.id_equipe = matches.id_team_away			
					WHERE id_joueur ='".$idProfil."' ";
				if ($idProfil == $id)
				{
					$qry .= "AND (matches.modif = 1 || matches.modif = 2) ";
				}
				else
				{
					$qry .= "AND matches.modif = 2 ";
				}
		
			$qry .= "ORDER BY matches.date, matches.id_match;";
			$result = mysqli_query($con, $qry);
			$find = false;
			$i = 0;

			while ($row = mysqli_fetch_array($result )) 
			{	
				$classTR = "";
				if ($row["played"] == 1)
				{
					$point = $row["point"];
					if ($point == 0)
						$classTR = "classTREchecHome";
					if ($point == 1 || $point == 2)
						$classTR = "classTRInverseHome";
					if ($point == 3 || $point == 6)
						$classTR = "classTRCorrectHome";
					if ($point == 4 || $point == 8)
						$classTR = "classTRCorrectPlusHome";
					if ($point == 7 || $point == 14)
						$classTR = "classTRPerfectHome";
				}
				else if ($row["played"] == 0)
				{
						$classTR = "classTRNeutre";
				}	

				$classPancarte = "";
		
				$find = true;

				$date_array = date_parse($row["date"]);
				if ($i++ % 2 == 0) {
					$background = 'backgroundTab1';
				}
				else {					
					$background = 'backgroundTab2';
				}
		
				echo '<div class="profil-line ', $background ,'">';

				echo '<table class="affPronosTableau">';



				echo '	<tr class="affPronosLigne ">';
					if ($row["played"] == 1)
					{
						$point = $row["point"];
						if ($point == 0)
							$classPancarte = "pancarte-padding pancarte-echec";
						if ($point == 1 || $point == 2)
							$classPancarte = "pancarte-padding pancarte-inverse";
						if ($point == 3 || $point == 6)
							$classPancarte = "pancarte-padding pancarte-correct";
						if ($point == 4 || $point == 8)
							$classPancarte = "pancarte-padding pancarte-correct-plus";
						if ($point == 7 || $point == 14)
							$classPancarte = "pancarte-padding pancarte-perfect";
					}
		
					echo '<td style="width:55px;padding: 15px 0px;" class="affPronosLogo">';
						echo '<img class="logoEquipe"  style="margin-top: 2px;margin-bottom: 2px;margin-left: 10px;" src="', utf8_encode_function($row["home_logo"]), '" />';
					echo '</td>';
					
					echo '<td style="width:110px" class="tdMatchLeft"> ';
						echo utf8_encode_function($row["home_name"]);
					echo '</td>';
		
					echo '<td style="width:26px">';
					echo '<span class="pancarte-profil ',$classPancarte,'"> ';
						echo $row["prono_home"];
					echo '</span> ';
					echo '</td>';
		
					echo '<td style="width:20px;text-align: center;">-';
					echo '</td>';
		
					echo '<td style="width:26px">';
					echo '<span class="pancarte-profil ',$classPancarte,'"> ';
						echo $row["prono_away"];
					echo '</span> ';
					echo '</td>';
		
					echo '<td style="width:110px" class="tdMatchRight">';
						echo utf8_encode_function($row["away_name"]);
					echo '</td>';
		
					echo '<td style="width:55px">';
						echo '<img class="logoEquipe" style="margin-right: 10px;" src="', utf8_encode_function($row["away_logo"]), '" />';
					echo '</td>';
		
					echo '<td class="', $classTR ,'"  style="width:70px">';
						if ($row["played"] == 1)
						{
							$point = $row["point"];
							if ($point == 0)
								echo '<div class="EchecPronos">ECHEC</div>';
							if ($point == 1 || $point == 2)
								echo '<div class="InversePronos">INVERSE</div>';
							if ($point == 3 || $point == 6)
								echo '<div class="CorrectPronos">CORRECT</div>';
							if ($point == 4 || $point == 8)
								echo '<div class="CorrectPlusPronos">CORRECT+</div>';
							if ($point == 7 || $point == 14)
								echo '<div class="PerfectPronos">PERFECT</div>';
						}
						// else if ($row["played"] == 0)
						// {
						// 	 echo '<div class="PasJouePronos">EN ATTENTE</div>';					
						// }	
		
					echo '</td>';
		
					echo '<td class="', $classTR ,'" style="width:35px;text-align: center;font-size: 16px;font-weight: bold;">';
					if ($row["played"] == 1)
						{
							echo '+', $row["point"];
						}
		
					echo '</td>';

					echo '<td class="" style="width:35px;text-align: center;font-size: 16px;font-weight: bold;">';
					echo '	
						<div>
							<a class="showmore" href="matches.php?id=', $row["id_match"] ,'">Détails</a>
				 		</div>';
						
					echo '</td>';
		
				echo '</tr>';
				echo '</table>';

				if ($row["played"] == 1)
				{
					echo '<div class="profil-score ">
						Résultat : ';
						echo $row['score_home'];
						echo ' - 	';
						echo $row['score_away'];
						echo '</div>';
				}
				echo '</div>';
			}
			if ($find == false)
			{
				echo '<span class="emptyTableau"> Aucun pronostic</span>';
			}
					// Entrez les données
		

						
			echo '</div>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="calendrier.php" >
				MATCHES
			</a>
		</div>
	</div>';
?>

        </div>

        <div class="profilPage-content-pronos-bonus">
			<?php if($idProfil == $id && $modifBonus == 1): ?>
            <div class="profilPage-info-perso-modif">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
						id="modifierBonus">
						Modifier Bonus
					</button>
				</div>
				<?php endif ;?>

            <?php
	echo '
	<div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault bonuscard">
	<div class="mdl-card__title mdl-card--expand">';

	echo '
	<div class="cadreTableau cadreTableauBonus">
	';
	// $team_winner_id = "";
	// $min_first = "";
	// $min_last = "";
	// $total_but = "";
	// $best_scorer = "";
	
	// $team_winner_id_point = -1;
	// $min_first_point = -1;
	// $min_last_point = -1;
	// $total_but_point = -1;
	// $best_scorer_point = -1;

	// $min_first_point = -1;
	// $min_last_point = -1;
	// $total_but_point = -1;
	// $fairplay_point = -1;
	// $but_edf_point = -1;
	// $penalty_point = $rowBonus[ 'penalty_point' ];
	// $team_final_1_point = $rowBonus[ 'team_final_1_point' ];
	// $team_final_2_point = $rowBonus[ 'team_final_2_point' ];
	
	$qryBonus = "SELECT *, team_final_1.name as team_final_1_name, team_final_2.name as team_final_2_name, team_final_1.logo as team_final_1_logo, team_final_2.logo as team_final_2_logo
			FROM pronostics_bonus
			LEFT JOIN equipes team_final_1 ON team_final_1.id_equipe = pronostics_bonus.team_final_1_id
			LEFT JOIN equipes team_final_2 ON team_final_2.id_equipe = pronostics_bonus.team_final_2_id
			WHERE pronostics_bonus.id_joueur='".$idProfil."' ;";
	$resultBonus = mysqli_query($con, $qryBonus);
	$findBonus = false;
	
	while ($rowBonus = mysqli_fetch_array($resultBonus )) 
	{	
		$findBonus = true;

		$min_first = intval($rowBonus[ 'min_first' ]);
		$min_last = intval($rowBonus[ 'min_last' ]);
		$total_but = intval($rowBonus[ 'total_but' ]);
		$fairplay = intval($rowBonus[ 'fairplay' ]);
		$but_edf = intval($rowBonus[ 'but_edf' ]);
		$penalty = intval($rowBonus[ 'penalty' ]);
		$team_final_1_name = $rowBonus[ 'team_final_1_name' ];
		$team_final_2_name = $rowBonus[ 'team_final_2_name' ];
		$team_final_1_logo = $rowBonus["team_final_1_logo"];
		$team_final_2_logo = $rowBonus["team_final_2_logo"];

		$min_first_point = $rowBonus[ 'min_first_point' ];
		$min_last_point = $rowBonus[ 'min_last_point' ];
		$total_but_point = $rowBonus[ 'total_but_point' ];
		$fairplay_point = $rowBonus[ 'fairplay_point' ];
		$but_edf_point = $rowBonus[ 'but_edf_point' ];
		$penalty_point = $rowBonus[ 'penalty_point' ];
		$team_final_1_point = $rowBonus[ 'team_final_1_point' ];
		$team_final_2_point = $rowBonus[ 'team_final_2_point' ];

		// $team_winner_id_point_value = $rowBonus["team_winner_id_point"];
		// $team_winner_id_point = intval ($rowBonus["team_winner_id_point"]);
		// $player_winner_point_value = $rowBonus["player_winner_point"];
		// $player_winner_point = intval ($rowBonus["player_winner_point"]);
		// $min_first_point_value = $rowBonus["min_first_point"];
		// $min_first_point = intval ($rowBonus["min_first_point"]);
		// $min_last_point_value = $rowBonus["min_last_point"];
		// $min_last_point = intval ($rowBonus["min_last_point"]);
		// $total_but_point_value = $rowBonus["total_but_point"];
		// $total_but_point = intval ($rowBonus["total_but_point"]);
		// $best_scorer_point_value = $rowBonus["best_scorer_point"];	
		// $best_scorer_point = intval ($rowBonus["best_scorer_point"]);	 
	
	}

	
	if ($findBonus == true && ($idProfil == $id || $modifBonus == 0))
	{

	echo '<table class="affPronosTableau">';


	echo '<tr class="affPronosLigne backgroundTab1" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">Minute premier but</td>';

	echo '<td class="affPronosLigneResult" >';
		echo '<span class="pancarteAuto pancarte-padding pancarte-bonus';
		if ($min_first_point != null)
		{
			if (intval($min_first_point) == 0)
				echo ' pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}

		echo ' " > ';
		echo $min_first;
		echo '</span> Minutes';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($min_first_point != null)
	{
		if (intval($min_first_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. intval($min_first_point);
	}
	else {
		echo '">';
	}
	echo '</td>';
	echo '</tr>';


	echo '<tr class="affPronosLigne backgroundTab2" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">Minute dernier but</td>';

	echo '<td class="affPronosLigneResult">';
		echo '<span class="pancarteAuto pancarte-padding pancarte-bonus';
		if ($min_last_point != null)
		{
			if (intval($min_last_point) == 0)
				echo ' pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}

		echo ' " > ';
		echo $min_last;
		echo '</span> Minutes';
	echo '</td>';
	echo '<td class="affPronosLignePoint pointBonus ';
	if ($min_last_point != null)
	{
		if (intval($min_last_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $min_last_point;
	}
	else {
		echo '">';
	}
	echo '</td>';
	echo '</tr>';


	echo '<tr class="affPronosLigne backgroundTab1" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">Nombre total de but</td>';

	echo '<td class="affPronosLigneResult" >';
		echo '<span class="pancarteAuto pancarte-padding pancarte-bonus';
		if ($total_but_point != null)
		{
			if (intval($total_but_point) == 0)
				echo '  pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}

		echo ' " > ';
		echo $total_but;
		echo '</span> Buts';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($total_but_point != null)
	{
		if (intval($total_but_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
		echo '+'. $total_but_point;
	}
	else {
		echo '">';
	}
	echo '</td>';
	echo '</tr>';




	echo '<tr class="affPronosLigne backgroundTab2" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">Fairplay</td>';

	echo '<td class="affPronosLigneResult" >';
		echo '<span class="pancarteAuto pancarte-padding pancarte-bonus';
		if ($fairplay_point != null)
		{
			if (intval($fairplay_point) == 0)
				echo ' pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}

		echo ' " > ';
		echo $fairplay;
		echo '</span> Cartons';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($fairplay_point != null)
	{
		if (intval($fairplay_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $fairplay_point;
	}
	else {
		echo '">';
	}

	echo '</td>';
	echo '</tr>';


	echo '<tr class="affPronosLigne backgroundTab1" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">Penalty</td>';

	echo '<td >';
		echo '<span class="pancarteAuto pancarte-padding pancarte-bonus';
		if ($penalty_point != null)
		{
			if (intval($penalty_point) == 0)
				echo ' pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}
		echo ' "  > ';
		echo $penalty;
		echo '</span> Penalty';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($penalty_point != null)
	{
		if (intval($penalty_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $penalty_point;
	}
	else {
		echo '">';
	}
	echo '</td>';

	echo '</tr>';

	echo '<tr class="affPronosLigne backgroundTab2" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">But Equipe de France</td>';

	echo '<td >';
		echo '<span class="pancarteAuto pancarte-padding pancarte-bonus';
		if ($but_edf_point != null)
		{
			if (intval($but_edf_point) == 0)
				echo ' pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}
		echo ' "  > ';
		echo $but_edf;
		echo '</span> Buts';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($but_edf_point != null)
	{
		if (intval($but_edf_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $but_edf_point;
	}
	else {
		echo '">';
	}
	echo '</td>';

	echo '</tr>';

	echo '<tr class="affPronosLigne backgroundTab1" >';
	echo '<td class="affPronosLigneTitre tdBonusLeft">Finalistes</td>';

	$team_final_point = 0;
	if ($team_final_1_point != null)
	{
		$team_final_point += intval($team_final_1_point);
	}
	if ($team_final_2_point != null)
	{
		$team_final_point += intval($team_final_2_point);
	}

	echo '<td >';
		echo '<div>';

		echo '<img class="logoEquipeSmall" src="';
		echo $team_final_1_logo;	
		echo '" />';

		echo '
		
		<span class="pancarteAuto pancarte-padding ';
		if ($team_final_1_point != null)
		{
			if (intval($team_final_1_point) == 0)
				echo '  pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}
		echo ' "  > ';
		echo $team_final_1_name;
		echo '</span>
		</div>
		';

		echo '<div>';

		echo '<img class="logoEquipeSmall" src="';
		echo $team_final_2_logo;	
		echo '" />';

		echo '<span class="pancarteAuto pancarte-padding ';
		if ($team_final_2_point != null)
		{
			if (intval($team_final_2_point) == 0)
				echo '  pancarte-echec ';
			else
				echo ' pancarte-correct ';
		}
		echo ' "  > ';
		echo $team_final_2_name;
		echo '</span></div>';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($team_final_1_point != null || $team_final_2_point != null)
	{
		if (intval($team_final_point) > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $team_final_point;
	}
	else {
		echo '">';
	}
	echo '</td>';

	echo '</tr>';



	echo '</table>';
	}
	else
	echo '<span class="emptyTableau"> Aucun bonus</span>';

	echo '</div>';




	echo '
	</div>
	<div class="mdl-card__actions mdl-card--border">
	<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="bonus.php">
		BONUS
	</a>
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
		$nb_inverse_point = $nb_inverse;
		$nb_echec;
		
		$nb_total_point = $nb_perf_point + $nb_correct_point + $nb_inverse_point + $bonus + $nb_correct_plus_point;
		$nb_total = $nb_perf + $nb_correct + $nb_inverse + $nb_echec;

		$nb_total_point = max($nb_perf_point, $nb_correct_point, $nb_inverse_point, $bonus, $nb_correct_plus_point);
		$nb_total = max($nb_perf, $nb_correct, $nb_inverse, $nb_echec, $nb_correct_plus);

		
		if ($nb_total != 0) {
			$pc_perf_match = ($nb_perf * 93 / $nb_total) + 7;
			$pc_correct_match = ($nb_correct * 93 / $nb_total) + 7;
			$pc_inverse_match = ($nb_inverse * 93 / $nb_total) + 7;
			$pc_echec_match = ($nb_echec * 93 / $nb_total) + 7;
			$pc_bonus_match = 7;
		}

		$pc_perf_point = 8;
		$pc_correct_point = 8;
		$pc_correct_plus_point = 8;
		$pc_echec_point = 8;
		$pc_inverse_point = 8;
		$pc_bonus_point = 8;

		if ($nb_total_point != 0) {
			$pc_perf_point = ($nb_perf_point * 93 / $nb_total_point) + 7;
			$pc_correct_point = ($nb_correct_point * 93 / $nb_total_point) + 7;
			$pc_inverse_point = ($nb_inverse_point * 93 / $nb_total_point) + 7;
			$pc_correct_plus_point = ($nb_correct_plus_point * 92 / $nb_total_point) + 8;
			$pc_bonus_point = ($bonus * 93 / $nb_total_point) + 7;
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
							<div  style=" width:<?php echo $pc_inverse_match?>%; " class="profilPage-content-stats-bars-line-match-bar bar-inverse">
								<?php echo $nb_inverse?>
							</div>
						</div>
						<div class="profilPage-content-stats-bars-line-titre">
							Inverse
						</div>
						<div class="profilPage-content-stats-bars-line-point">
							<div style=" width:<?php echo $pc_inverse_point?>%; " class="profilPage-content-stats-bars-line-point-bar bar-inverse">
								<?php echo $nb_inverse_point?>pts
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

					<div class="profilPage-content-stats-bars-line">
						<div class="profilPage-content-stats-bars-line-match">
							<div style=" width:<?php echo $pc_bonus_match?>%; " class="profilPage-content-stats-bars-line-match-bar bar-bonus">
								N/A
							</div>
						</div>
						<div class="profilPage-content-stats-bars-line-titre">
							Bonus
						</div>
						<div class="profilPage-content-stats-bars-line-point">
							<div style=" width:<?php echo $pc_bonus_point?>%; "  class="profilPage-content-stats-bars-line-point-bar bar-bonus">
								<?php echo $bonus?>pts
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