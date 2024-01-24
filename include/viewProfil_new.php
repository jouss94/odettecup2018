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

	$qry = "SELECT * FROM etat;";
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
            <div class="profilPage-info-perso-modif">
            <?php if($idProfil == $id && $modifMatch == 1): ?>
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
							$classPancarte = "pancarte-padding pancarte-correct";
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
            <div class="profilPage-info-perso-modif">
            	<?php if($idProfil == $id && $modifBonus == 1): ?>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
						id="modifierBonus">
						Modifier Bonus
					</button>
				<?php endif ;?>
            </div>

            <?php
	echo '
	<div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault bonuscard">
	<div class="mdl-card__title mdl-card--expand">';

	echo '
	<div class="cadreTableau cadreTableauBonus">
	';
	$team_winner_id = "";
	$min_first = "";
	$min_last = "";
	$total_but = "";
	$best_scorer = "";
	
	$team_winner_id_point = -1;
	$min_first_point = -1;
	$min_last_point = -1;
	$total_but_point = -1;
	$best_scorer_point = -1;
	
	$qryBonus = "SELECT *, equipe_winner.name as equipe_w, joueurs.surnom as joueur, equipe_winner.logo as logo
			FROM pronostics_bonus
			LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = pronostics_bonus.team_winner_id
			LEFT JOIN joueurs joueurs ON joueurs.id_joueur = pronostics_bonus.player_winner_id
			WHERE pronostics_bonus.id_joueur='".$idProfil."' ;";
	$resultBonus = mysqli_query($con, $qryBonus);
	$findBonus = false;
	
	while ($rowBonus = mysqli_fetch_array($resultBonus )) 
	{	
		$findBonus = true;
		$team_winner_id = utf8_encode_function($rowBonus["equipe_w"]);
		$player_winner_id = utf8_encode_function($rowBonus["joueur"]);
		$min_first = $rowBonus["min_first"];
		$min_last = $rowBonus["min_last"];
		$total_but = $rowBonus["total_but"];
		$best_scorer = utf8_encode_function($rowBonus["best_scorer"]);

		$team_winner_id_point_value = $rowBonus["team_winner_id_point"];
		$team_winner_id_point = intval ($rowBonus["team_winner_id_point"]);
		$player_winner_point_value = $rowBonus["player_winner_point"];
		$player_winner_point = intval ($rowBonus["player_winner_point"]);
		$min_first_point_value = $rowBonus["min_first_point"];
		$min_first_point = intval ($rowBonus["min_first_point"]);
		$min_last_point_value = $rowBonus["min_last_point"];
		$min_last_point = intval ($rowBonus["min_last_point"]);
		$total_but_point_value = $rowBonus["total_but_point"];
		$total_but_point = intval ($rowBonus["total_but_point"]);
		$best_scorer_point_value = $rowBonus["best_scorer_point"];	
		$best_scorer_point = intval ($rowBonus["best_scorer_point"]);	 
	
	 	$logo = $rowBonus["logo"];
	}

	
	if ($findBonus == true && ($idProfil == $id || $modifBonus == 0))
	{

	echo '<table class="affPronosTableau">';

	echo '<tr class="affPronosLigne backgroundTab1" >';
	echo '<td style="width:50%" class="tdBonusLeft">Equipe favorite</td>';

	echo '<td >';
		echo '<span class="pancarteAuto ';
		if ($team_winner_id_point_value != null)
		{
			if ($team_winner_id_point == 0 || $team_winner_id_point == -3)
				echo ' pancarte-padding pancarte-echec ';
			else
				echo ' pancarte-padding pancarte-correct ';
		}
		echo ' "  > ';
		echo $team_winner_id;
		

		
		echo '</span> ';
		// echo '<img class="logoEquipeSmall" src="';
		// echo $logo;	
		// echo '" />';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($team_winner_id_point_value != null)
	{
		if ($team_winner_id_point > 0)
		{
			echo 'classTRCorrectHome"> +';
		}
		else {
			echo 'classTREchecHome">';
		}
		echo $team_winner_id_point;
	}
	else {
		echo '">';
	}
	echo '</td>';

	echo '</tr>';

	echo '<tr class="affPronosLigne backgroundTab2" >';
	echo '<td style="width:50%" class="tdBonusLeft">Nombre total de but</td>';

	echo '<td style="width:50%">';
		echo '<span class="pancarteAuto ';
		if ($total_but_point_value != null)
		{
			if ($total_but_point == 0)
				echo ' pancarte-padding pancarte-echec ';
			else
				echo ' pancarte-padding pancarte-correct ';
		}

		echo ' " > ';
		echo $total_but;
		echo '</span> Buts';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($total_but_point_value != null)
	{
		if ($total_but_point > 0)
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

	echo '<tr class="affPronosLigne backgroundTab1" >';
	echo '<td style="width:50%" class="tdBonusLeft">Minute du premier but</td>';

	echo '<td style="width:50%">';
		echo '<span class="pancarteAuto ';
		if ($min_first_point_value != null)
		{
			if ($min_first_point == 0)
				echo ' pancarte-padding pancarte-echec ';
			else
				echo ' pancarte-padding pancarte-correct ';
		}

		echo ' " > ';
		echo $min_first;
		echo '</span> Minutes';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($min_first_point_value != null)
	{
		if ($min_first_point > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $min_first_point;
	}
	else {
		echo '">';
	}
	echo '</td>';
	echo '</tr>';

	echo '<tr class="affPronosLigne backgroundTab2" >';
	echo '<td style="width:50%" class="tdBonusLeft">Minute dernier but</td>';

	echo '<td style="width:50%">';
		echo '<span class="pancarteAuto ';
		if ($min_last_point_value != null)
		{
			if ($min_last_point == 0)
				echo ' pancarte-padding pancarte-echec ';
			else
				echo ' pancarte-padding pancarte-correct ';
		}

		echo ' " > ';
		echo $min_last;
		echo '</span> Minutes';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($min_last_point_value != null)
	{
		if ($min_last_point > 0)
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
	echo '<td style="width:50%" class="tdBonusLeft">Meilleur buteur</td>';

	echo '<td style="width:50%">';
		echo '<span class="pancarteAuto ';
		if ($best_scorer_point_value != null)
		{
			if ($best_scorer_point == 0)
				echo ' pancarte-padding pancarte-echec ';
			else
				echo ' pancarte-padding pancarte-correct ';
		}

		echo ' " > ';
		echo $best_scorer;
		echo '</span> ';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($best_scorer_point_value != null)
	{
		if ($best_scorer_point > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $best_scorer_point;
	}
	else {
		echo '">';
	}

	echo '</td>';
	echo '</tr>';


	echo '<tr class="affPronosLigne backgroundTab2" >';
	echo '<td style="width:50%" class="tdBonusLeft">Joueur vainqueur</td>';

	echo '<td >';
		echo '<span class=pancarteAuto "';
		if ($player_winner_point_value != null)
		{
			if ($player_winner_point == 0)
				echo ' pancarte-padding pancarte-echec ';
			else
				echo ' pancarte-padding pancarte-correct ';
		}
		echo ' "  > ';
		echo $player_winner_id;
		echo '</span> ';
	echo '</td>';
	echo '<td class="pointBonus ';
	if ($player_winner_point_value != null)
	{
		if ($player_winner_point > 0)
		{
			echo 'classTRCorrectHome">';
		}
		else {
			echo 'classTREchecHome">';
		}
			echo '+'. $player_winner_point;
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
        <!-- stats -->
    </div>
</div>