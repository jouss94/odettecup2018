<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];


	// INFORMATION

	echo '<div class="profilInformation floaleft">';

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
	if ( $result) {
	while ($row = mysqli_fetch_array($result )) 
	{	
		$find = true;
		echo '<div class="profilInformationSurnom" style=" background:linear-gradient(', $row["joueursColor"] ,' 0%, #9c2950 40%);">';

		echo '<div class="cadreprofilsurnom"> ';
		echo '<span style="padding-top: 15px;display: block;FONT-WEIGHT: bold;">';
		echo utf8_encode_function($row["surnom"]);
		if ($row["logo"] != null) {
			echo '<img class="logoEquipProfil" src="';
			echo $row["logo"];	
			echo '" />';
		}
		echo '</span>';
		echo '</div> ';

		echo '<div class="profilInformationImageDiv"> 

				<img src="', utf8_encode_function($row["joueursimage"]), '" class="profilInformationImage mdl-button--raised joueursimage"/>

			</div>';
		if ($idProfil == $id)
		{
			echo '<div> 
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ModifierProfil">
					Modifier Profil 
				</button>
			</div>';
		}
		echo '<div class="cadreprofil"> ';
		echo '<div class="profilInformationCivil">', utf8_encode_function($row["prenom"]), '</div>';
		// echo '<div class="profilInformationCivil">', utf8_encode_function($row["joueursnom"]), '</div>';
		echo '<div class="profilInformationCivil">', utf8_encode_function($row["email"]), '</div>';
		echo '<div class="profilInformationCivil">Tel : ', utf8_encode_function($row["telephone"]), '</div>';
		echo '</div> ';
		echo '<div class="profilInformationEmail">', utf8_encode_function($row["description"]), '</div>';
		
		
		$chipsProfil = 'chips-red';
		if (intval($row["modif_profil"]) == 1 && intval($row["modif_match"]) == 1 && intval($row["modif_bonus"]) == 1)
		$chipsProfil = 'chips-green';
		
		$chipsPayement = 'chips-red';
		if (intval($row["payed"]) == 1) $chipsPayement = 'chips-green';

		echo '
		<span class="mdl-chip mdl-chip--contact chips-body ', $chipsProfil, '-body">
			<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white ', $chipsProfil, '"></span>
			<span class="mdl-chip__text ">Profil à jour</span>
		</span>
		<span class="mdl-chip mdl-chip--contact chips-body ', $chipsPayement, '-body"">
			<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white ', $chipsPayement, '"></span>
			<span class="mdl-chip__text ">Paiement</span>
		</span>';

		echo '
		<div class="classementperso-card-event mdl-card classement-general mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand">
				<span class="TitreSmallClassement">';
					$rangGenerel = intval($row["generalrang"]);
					echo $rangGenerel;
					if ($rangGenerel == 1)
					{
						echo ' er';
					}
					else {
						echo ' eme';
					}

					echo'</span>
				<span class="TitreTableauBas">';
				echo intval($row["generalpoints"]);
				echo ' pts
				</span>
				</div>
			<div class="mdl-card__actions mdl-card--border">
				<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect classementbutton" href="classement.php?ranking=General" >
					Class.
				</a>
				</div>
		</div>
		';

		echo '<div>';
		echo '<table class="tableDetails">';
			echo '<tr >';
				echo '<td colspan="3" style="font-weight: bold;"> ';
					echo 'Détails Matches :';
				echo '</td>';
			echo '</tr>';
			echo '<tr >';
				echo '<td class="firstColumnProfilPadding"> ';
					echo 'Perfect';
				echo '</td>';
				echo '<td class="secondColumProfil"> ';
					echo intval($row["nb_perf"]);
				echo '</td>';
				echo '<td  class="thirdColumnProfil" > ';
					echo intval($row["nb_perf"]) * 7;
				echo '<span class="petitPoint">pts</span>';	
				echo '</td>';
			echo '</tr>';
			// echo '<tr >';
			// 	echo '<td class="firstColumnProfilPadding"> ';
			// 		echo 'Correct+';
			// 	echo '</td>';
			// 	echo '<td class="secondColumProfil"> ';
			// 		echo intval($row["nb_correct_plus"]);
			// 	echo '</td>';
			// 	echo '<td  class="thirdColumnProfil" > ';
			// 		echo intval($row["nb_correct_plus"]) * 4;
			// 	echo '<span class="petitPoint">pts</span>';	
			// 	echo '</td>';
			echo '</tr>';
			echo '<tr >';
				echo '<td class="firstColumnProfilPadding"> ';
					echo 'Correct';
				echo '</td>';
				echo '<td class="secondColumProfil"> ';
					echo intval($row["nb_correct"]);
				echo '</td>';
				echo '<td  class="thirdColumnProfil" > ';
					echo intval($row["nb_correct"]) * 3;
				echo '<span class="petitPoint">pts</span>';	
				echo '</td>';
			echo '</tr>';
			echo '<tr >';
				echo '<td class="firstColumnProfilPadding"> ';
					echo 'Inverse';
				echo '</td>';
				echo '<td class="secondColumProfil"> ';
					echo intval($row["nb_inverse"]);
				echo '</td>';
				echo '<td  class="thirdColumnProfil" > ';
					echo intval($row["nb_inverse"]);
				echo '<span class="petitPoint">pts</span>';	
				echo '</td>';
			echo '</tr>';
			echo '<tr >';
				echo '<td class="firstColumnProfilPadding"> ';
					echo 'Echec';
				echo '</td>';
				echo '<td class="secondColumProfil"> ';
					echo intval($row["nb_echec"]);
				echo '</td>';
				echo '<td  class="thirdColumnProfil" > ';
				echo '</td>';
			echo '</tr>';
			echo '<tr >';
				echo '<td colspan="2" style="font-weight: bold;"> ';
					echo 'Bonus :';
				echo '</td>';
				echo '<td  class="thirdColumnProfil" > ';
					echo intval($row["bonus"]);
				echo '<span class="petitPoint">pts</span>';	
				echo '</td>';
			echo '</tr>';


	echo '</table>';

	echo '</div>';


	echo '</div>';


	}


	
	}

	echo '</div>';

	if ($find)
	{




	// Pronotics

	echo '<div class="profilPronos floaleft">
	<span class="profilPronosTitre">Pronostics</span>';

	if ($idProfil == $id && $modifMatch == 1)
	{
		echo '<div  style="width:100%;margin:auto;text-align: center;padding-top: 10px;"> 
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="modifierMatch">
				Modifier matches
			</button>
		</div>';
	}

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
		
				
				echo '
				<table class="affPronosTableau">';


				$date_array = date_parse($row["date"]);
				if ($i++ % 2 == 0) {
					echo '	<tr class="affPronosLigne backgroundTab1">';
				}
				else {
					echo '	<tr class="affPronosLigne backgroundTab2">';
				}
		
		
					echo '<td style="width:55px;padding: 15px 0px;" class="affPronosLogo">';
						echo '<img class="logoEquipe"  style="margin-top: 2px;margin-bottom: 2px;margin-left: 10px;" src="', utf8_encode_function($row["home_logo"]), '" />';
					echo '</td>';
					
					echo '<td style="width:110px" class="tdMatchLeft"> ';
						echo utf8_encode_function($row["home_name"]);
					echo '</td>';
		
					echo '<td style="width:26px">';
					echo '<span class="pancarte ',$classPancarte,'"> ';
						echo $row["prono_home"];
					echo '</span> ';
					echo '</td>';
		
					echo '<td style="width:20px;text-align: center;">-';
					echo '</td>';
		
					echo '<td style="width:26px">';
					echo '<span class="pancarte ',$classPancarte,'"> ';
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
						else if ($row["played"] == 0)
						{
							echo '<div class="PasJouePronos">EN ATTENTE</div>';					
						}	
		
					echo '</td>';
		
					echo '<td class="', $classTR ,'" style="width:35px;text-align: center;font-size: 16px;font-weight: bold;">';
					if ($row["played"] == 1)
						{
							echo '+', $row["point"];
						}
		
					echo '</td>';
		
				echo '</tr>';
				echo '</table>';
			}
			if ($find == false)
			{
				echo '<span class="emptyTableau"> Aucun pronostic</span>';
			}
					// Entrez les données
		

						
			echo '		</div>
		</div>
	<div class="mdl-card__actions mdl-card--border">
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="calendrier.php" >
			MATCHES
		</a>
		</div>
</div>';

// if ($idProfil == $id && $modifBonus == 1)
// {
// 	echo '<div  style="width:100%;margin:auto;text-align: center;;margin-top:20px"> 
// 		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="modifierJoker">
// 			Modifier Joker
// 		</button>
// 	</div>';
// }

// echo '
// <div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault height150">
// <div class="mdl-card__title mdl-card--expand">';

// echo '
// <div class="cadreTableau cadreTableauBonus">
// ';


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

// $qryBonus = "SELECT *, equipe_winner.name as equipe_w
// 		FROM pronostics_bonus
// 		LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = pronostics_bonus.team_winner_id
// 		WHERE id_joueur='".$idProfil."' ;";
// $resultBonus = mysqli_query($con, $qryBonus);
// $findBonus = false;

// while ($rowBonus = mysqli_fetch_array($resultBonus )) 
// {	
// $findBonus = true;
//  $team_winner_id = utf8_encode_function($rowBonus["equipe_w"]);
//  $min_first = $rowBonus["min_first"];
//  $min_last = $rowBonus["min_last"];
//  $total_but = $rowBonus["total_but"];
//  $best_scorer = utf8_encode_function($rowBonus["best_scorer"]);

// $team_winner_id_point = intval ($rowBonus["team_winner_id_point"]);
//  $min_first_point = intval ($rowBonus["min_first_point"]);
//  $min_last_point = intval ($rowBonus["min_last_point"]);
//  $total_but_point = intval ($rowBonus["total_but_point"]);
//  $best_scorer_point = intval ($rowBonus["best_scorer_point"]);			
// }

// if ($findBonus == true && ($idProfil == $id || $modifJoker == 0))
// {

// echo '<table class="affPronosTableau">';

// echo '<tr class="affPronosLigne backgroundTab1" >';
// 	echo '<td style="width:50%" class="tdBonusLeft">Equipe vainqueur</td>';

// 	echo '<td >';
// 		echo '<span class="';
// 		if ($team_winner_id_point >= 0)
// 		{
// 			if ($team_winner_id_point == 0)
// 				echo ' pancarteBonusEchec ';
// 			else
// 				echo ' pancarteBonusCorrect ';
// 		}
// 		else
// 				echo ' pancarteAuto ';
// 		echo ' "  > ';
// 		echo $team_winner_id;
// 		echo '</span> ';
// 	echo '</td>';
// 	echo '<td class="pointBonus">';
// 	if ($team_winner_id_point >= 0)
// 	{
// 			echo '+'. $team_winner_id_point;
// 	}
// 	echo '</td>';

// echo '</tr>';

// echo '<tr class="affPronosLigne backgroundTab2" >';
// 	echo '<td style="width:50%" class="tdBonusLeft">Minute du premier but</td>';

// 	echo '<td style="width:50%">';
// 		echo '<span class="';
// 		if ($min_first_point >= 0)
// 		{
// 			if ($min_first_point == 0)
// 				echo ' pancarteBonusEchec ';
// 			else
// 				echo ' pancarteBonusCorrect ';
// 		}
// 		else
// 				echo ' pancarteAuto ';

// 		echo ' " > ';
// 		echo $min_first;
// 		echo '</span> Minutes';
// 	echo '</td>';
// 	echo '<td class="pointBonus">';
// 	if ($min_first_point >= 0)
// 	{
// 			echo '+'. $min_first_point;
// 	}
// 	echo '</td>';
// echo '</tr>';

// echo '<tr class="affPronosLigne backgroundTab1" >';
// 	echo '<td style="width:50%" class="tdBonusLeft">Minute dernier but</td>';

// 	echo '<td style="width:50%">';
// 		echo '<span class="';
// 		if ($min_last_point >= 0)
// 		{
// 			if ($min_last_point == 0)
// 				echo ' pancarteBonusEchec ';
// 			else
// 				echo ' pancarteBonusCorrect ';
// 		}
// 		else
// 				echo ' pancarteAuto ';

// 		echo ' " > ';
// 		echo $min_last;
// 		echo '</span> Minutes';
// 	echo '</td>';
// 	echo '<td class="pointBonus">';
// 	if ($min_last_point >= 0)
// 	{
// 			echo '+'. $min_last_point;
// 	}
// 	echo '</td>';
// echo '</tr>';

// echo '<tr class="affPronosLigne backgroundTab2" >';
// 	echo '<td style="width:50%" class="tdBonusLeft">Nombre total de but</td>';

// 	echo '<td style="width:50%">';
// 		echo '<span class="';
// 		if ($total_but_point >= 0)
// 		{
// 			if ($total_but_point == 0)
// 				echo ' pancarteBonusEchec ';
// 			else
// 				echo ' pancarteBonusCorrect ';
// 		}
// 		else
// 				echo ' pancarteAuto ';

// 		echo ' " > ';
// 		echo $total_but;
// 		echo '</span> Buts';
// 	echo '</td>';
// 	echo '<td class="pointBonus">';
// 	if ($total_but_point >= 0)
// 	{
// 			echo '+'. $total_but_point;
// 	}
// 	echo '</td>';
// echo '</tr>';

// // echo '<tr class="affPronosLigne backgroundTab1" >';
// // 	echo '<td style="width:50%" class="tdBonusLeft">Meilleur buteur</td>';

// // 	echo '<td style="width:50%">';
// // 		echo '<span class="';
// // 		if ($best_scorer_point >= 0)
// // 		{
// // 			if ($best_scorer_point == 0)
// // 				echo ' pancarteBonusEchec ';
// // 			else
// // 				echo ' pancarteBonusCorrect ';
// // 		}
// // 		else
// // 				echo ' pancarteAuto ';

// // 		echo ' " > ';
// // 		echo $best_scorer;
// // 		echo '</span> ';
// // 	echo '</td>';
// // 	echo '<td class="pointBonus">';
// // 	if ($best_scorer_point >= 0)
// // 	{
// // 			echo '+'. $best_scorer_point;
// // 	}
// // 	echo '</td>';
// // echo '</tr>';

// echo '</table>';
// }
// else
// echo '<span class="emptyTableau"> Aucun joker</span>';

// echo '</div>';




// echo '
// </div>
// <div class="mdl-card__actions mdl-card--border">
// <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
// 	JOKER
// </a>
// <div class="mdl-layout-spacer"></div>
// <i class="material-icons">event</i>
// </div>
// </div>';

if ($idProfil == $id && $modifBonus == 1)
{
	echo '<div  style="width:100%;margin:auto;text-align: center;;margin-top:20px"> 
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="modifierBonus">
			Modifier Bonus
		</button>
	</div>';
}


echo '
<div class="displaymatch-card-event mdl-card mdl-shadow--2dp rougedefault height150">
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
		echo '<span class="';
		if ($team_winner_id_point_value != null)
		{
			if ($team_winner_id_point == 0 || $team_winner_id_point == -3)
				echo ' pancarteBonusEchec ';
			else
				echo ' pancarteBonusCorrect ';
		}
		else
				echo ' pancarteAuto ';
		echo ' "  > ';
		echo $team_winner_id;
		

		
		echo '</span> ';
		echo '<img class="logoEquipeSmall" src="';
		echo $logo;	
		echo '" />';
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
		echo '<span class="';
		if ($total_but_point_value != null)
		{
			if ($total_but_point == 0)
				echo ' pancarteBonusEchec ';
			else
				echo ' pancarteBonusCorrect ';
		}
		else
				echo ' pancarteAuto ';

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
		echo '<span class="';
		if ($min_first_point_value != null)
		{
			if ($min_first_point == 0)
				echo ' pancarteBonusEchec ';
			else
				echo ' pancarteBonusCorrect ';
		}
		else
				echo ' pancarteAuto ';

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
		echo '<span class="';
		if ($min_last_point_value != null)
		{
			if ($min_last_point == 0)
				echo ' pancarteBonusEchec ';
			else
				echo ' pancarteBonusCorrect ';
		}
		else
				echo ' pancarteAuto ';

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
		echo '<span class="';
		if ($best_scorer_point_value != null)
		{
			if ($best_scorer_point == 0)
				echo ' pancarteBonusEchec ';
			else
				echo ' pancarteBonusCorrect ';
		}
		else
				echo ' pancarteAuto ';

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
		echo '<span class="';
		if ($player_winner_point_value != null)
		{
			if ($player_winner_point == 0)
				echo ' pancarteBonusEchec ';
			else
				echo ' pancarteBonusCorrect ';
		}
		else
				echo ' pancarteAuto ';
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
<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	BONUS
</a>
</div>
</div>';

	echo '</div>';
	}

	else
	{
		echo 'Ce profil n\'exite pas';
	}

?>