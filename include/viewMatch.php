<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');
	$months = array(
		11 => "Novembre",
		12 => "Décembre",
		06 => "Juin",
		07 => "Juillet",
	);

	echo '

		<div class="allMatch">';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idMatch = $query['id'];

	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.name  as away_name,
					equipes_away.logo  as away_logo,
					equipes_home.color as colorHome,
					equipes_away.color as colorAway
					FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			WHERE id_match = $idMatch;";
		$result = mysqli_query($con, $qry);
	$find = false;
	$modif = 0;
	
	while ($row = mysqli_fetch_array($result )) 
	{
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$date = utf8_encode_function($row["date"]);
		$diff = utf8_encode_function($row["diff"]);
		$stadium = utf8_encode_function($row["stadium"]);
		$played = $row["played"];
		$modif = $row["modif"];
		$date_array = date_parse($row["date"]);
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
		$colorHome = $row["colorHome"];
		$colorAway = $row["colorAway"];

		echo '<table style="margin:auto;width: 85%;border-collapse: collapse;text-align: center;    font-weight: bold;">
			<tr>
					<td style="margin: auto;width: 25%;text-align: left;">',
						$stadium,'
					</td>
					<td style="margin: auto;width: 50%;"><div class="match-date">',
					$days[date('w', strtotime($date))] 
					,' '
					,$date_array['day']
					,' '
					,$months[$date_array['month']],
					"</br>",
					$date_array['hour'], 'h00';

					echo '</div></td>
					<td style="margin: auto;width: 25%;text-align: right;" >', $diff,  
					'</td>';

		echo '</tr>
		</table>';

		echo '
		<table style="margin:auto;width: 100%;border-collapse: collapse;    margin-top: 20px;">
			<tr>
					<td style="margin: auto;text-align: right;padding-right: 40px;">
						<img class="logoEquipeBig" src="', $home_logo,'" />
					</td>
					<td >';

					echo '</td>
					<td >  ', 
					'</td>
					<td >'; 
					echo '</td>
					<td style="margin: auto;text-align: left;padding-left: 40px;">
						<img class="logoEquipeBig" src="', $away_logo,'" />
					</td>
			</tr>
			<tr>
					<td class="BigTitreRight" >', 
						$home_name,
					'</td>
					<td style="width: 8%;">'; 
						if ($played == 1)
							echo '<span class="pancarte" style="font-size: 35px;">',  $score_home,'</span>';

					echo '</td >
					<td style="font-size: 50px;width:20px">-', 
					'</td>
					<td style="width: 8%;">'; 
						if ($played == 1)
							echo '<span class="pancarte" style="font-size: 35px;">',  $score_away,'</span>';

					echo '</td>
					<td class="BigTitreLeft" >', 
						$away_name,
					'</td>
			</tr>
		</table>';

		if ($modif == 2 )
		echo '
		<div class="match-bars">
		<span class="textmatch">Pronostics :</span>
		<table class="percentBar">
			<tr> 
				<td class="color1 bar bar1"></td>
				<td class="color2 bar bar2"></td>
				<td class="color3 bar bar3"></td>
			</tr>
		</table>    
		<span class="textmatch">Résultats :</span>
		<table class="percentBar">
		<tr> 
			<td class="colorEresult barpronos barresulte "></td>
			<td class="colorIresult barpronos barresulti "></td>
			<td class="colorCresult barpronos barresultc "></td>
			<td class="colorPresult barpronos barresultp "></td>
		</tr>
		</table></div>  ';
		


	}

	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.name  as away_name,
					equipes_away.logo  as away_logo,
					pronos.*,
					joueurs.*,
					classements.*
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match 
			LEFT JOIN joueurs ON joueurs.id_joueur = pronos.id_joueur 
			LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general'
			WHERE modif=2 AND matches.id_match = $idMatch AND joueurs.competition = $competition ORDER BY classements.rang;";
	$result = mysqli_query($con, $qry);
	$find = false;


	echo '';

	echo '';


echo '

<div class="match-card-event mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-card--expand">




<div style="height: 430px;overflow-y: auto;width:100%">
<table style="
    border-collapse: collapse;
    width: 100%;color:#000;">';

	$i = 0;
	// $row = mysqli_fetch_array($result );
	// while ($i < 50) 
	$Result1 = 0;
	$ResultN = 0;
	$Result2 = 0;
		
	$ResultP = 0;
	$ResultC = 0;
	$ResultI = 0;
	$ResultE = 0;


	while ($row = mysqli_fetch_array($result ))
	{
		$find = true;
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$date = utf8_encode_function($row["date"]);
		$diff = utf8_encode_function($row["diff"]);
		$stadium = utf8_encode_function($row["stadium"]);
		$played = $row["played"];
		$date_array = date_parse($row["date"]);
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
		$nom =  utf8_encode_function($row["surnom"]);
		$rang =  $row["rang"];
		$pronos_home = intval($row["prono_home"]);
		$pronos_away = intval($row["prono_away"]);
		$point = $row["point"];
		$played = $row["played"];
		
		$modif = $row["modif"];

		if ($pronos_home > $pronos_away) {
			$Result1++;
		} else if ($pronos_away > $pronos_home) {
			$Result2++;
		} else {
			$ResultN++;
		}

		if ($point == 7 || $point == 14) {
			$ResultP++;
		} else if ($point == 3 || $point == 6) {
			$ResultC++;
		} else if ($point == 1 || $point == 2) {
			$ResultI++;
		} else {
			$ResultE++;
		}

		$classTR = "classTRNeutre";
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

					$date_array = date_parse($row["date"]);

		$date_array = date_parse($row["date"]);
		if ($i++ % 2 == 0) {
			echo '	<tr class="backgroundTab1">';
		}
		else {
			echo '	<tr class="backgroundTab2">';
		}

		echo '<td class="rangMatch">', $rang ,' </td>';
		echo '<td class="surnomMatch">', $nom ,' </td>';
		echo '<td class="homeEquipeDroiteMatch">';
		echo $home_name;	
		echo '</td>';
		echo '<td class="pronosMatch">', $pronos_home ,' </td>';
		echo '<td class="homeEquipeMilieuMatch"> - </td>';
		echo '<td class="pronosMatch">', $pronos_away ,' </td>';
		echo '<td class="homeEquipeGaucheMatch">';
		echo $away_name;	
		echo '</td>';
		echo '<td class="homePointMatch ', $classTR, '">';
		if ($played ==1)
		{
				echo '+';
				echo $row["point"];;	
		}
		
		echo '</td>';
		echo '	</tr>';		
	}

	
	
	if (!$find)
	echo '<tr>
			<td>
				<div style="margin: auto;width: 100%;text-align: center;color: #000;">Pas encore de pronostics pour ce match.</div>
			</td>
		</tr>';
	echo '';
	
	echo '</table></div>';
	echo '
	</div>
	<div class="mdl-card__actions mdl-card--border" style="justify-content: space-evenly;">
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="trombi.php" >
			Liste joueurs 
		</a>
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="classement.php?ranking=General" >
			Classement 
		</a>
	</div>
</div>



				</div>
';


if ($modif == 2) {

$total = $Result1 + $Result2 + $ResultN;
$px_b1 = $Result1 * 600 / $total;
$px_b2 = $Result2 * 600 / $total;
$px_bN = $ResultN * 600 / $total;

$total2 = $ResultP + $ResultC + $ResultI + $ResultE;
$px_bP = $ResultP * 600 / $total2;
$px_bC = $ResultC * 600 / $total2;
$px_bI = $ResultI * 600 / $total2;
$px_bE = $ResultE * 600 / $total2;


$class_bP = "0px 5px 5px 0px";
$class_bC = "0px";
$class_bI = "0px";
$class_bE = "5px 0px 0px 5px";

if ($px_bP == 600) {
	$class_bP = "5px";
} else if ($px_bC == 600) {
	$class_bC = "5px";
} else if ($px_bI == 600) {
	$class_bI = "5px";
}  else if ($px_bE == 600) {
	$class_bE = "5px";
}	else {
	if ($px_bP == 0) {
		$class_bC = "0px 5px 5px 0px";
		if ($px_bC == 0) {
			$class_bI = "0px 5px 5px 0px";
		}
	} 

	if ($px_bE == 0) {
		$class_bI = "5px 0px 0px 5px";
		if ($px_bI == 0) {
			$class_bC = "5px 0px 0px 5px";
		}
	}
}

$class_b1 = "5px 0px 0px 5px";
$class_bN = "0px";
$class_b2 = "0px 5px 5px 0px";

if ($px_b1 == 600) {
	$class_b1 = "5px";
} else if ($px_b2 == 600) {
	$class_b2 = "5px";
} else if ($px_bN == 600) {
	$class_bN = "5px";
} else if ($px_b1 == 0) {
	$class_bN = "5px 0px 0px 5px";
} else if ($px_b2 == 0) {
	$class_bN = "0px 5px 5px 0px";
}

echo '
<style>
.bar1{
	border-radius: '.$class_b1.';
    width: '. $px_b1 .'px;
 }
.bar2{
	border-radius: '.$class_bN.';
	width: '. $px_bN .'px;
 }
.bar3{
	border-radius: '.$class_b2.';
    width: '. $px_b2 .'px;
}

.color1{
  background-color: '.$colorHome.';
}
.color2{
  background-color: #66666c;
}
.color3{
   background-color: '.$colorAway.';
}

</style>';

if ($played == 1) {
	echo '
	
	<style>
	.barresultp{	
		border-radius: '.$class_bP.';
		width: '. $px_bP .'px;
	}
	.barresultc{
		border-radius: '.$class_bC.';
		width: '. $px_bC .'px;
	}
	.barresulti{
		border-radius: '.$class_bI.';
		width: '. $px_bI .'px;
	}
	.barresulte{
		border-radius: '.$class_bE.';
		width: '. $px_bE .'px;
}

.colorPresult{
	background-color: #18beff;
}
.colorCresult{
	background-color: #29cd35;
}
.colorIresult{
	background-color: #757575;
}
.colorEresult{
	background-color: #ff3b3b;
}
</style>
';

}

}


?>