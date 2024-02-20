<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	echo '
	<div class="cadreTableauAcceuilOneMatch cadreTableauAcceuilBg">
	<div class="nextmatchsolo">';
	
	$qry = "SELECT matches.*,
	matches.id_match as id, 
	equipes_home.display_name  as home_name,
	equipes_home.logo  as home_logo,
	equipes_away.display_name  as away_name,
	equipes_away.logo  as away_logo,
	equipes_home.color as colorHome,
	equipes_away.color as colorAway,
	pronos.*
	FROM (SELECT * from matches WHERE (modif=1 OR modif=2) and played = 0 ORDER BY date, id_match LIMIT 1) as matches
	LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
	LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
	LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match ;";

	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;

	$Result1 = 0;
	$ResultN = 0;
	$Result2 = 0;

	while ($row = mysqli_fetch_array($result )) 
	{
		$find = true;
		$group = $row["groupe"];
		$home_logo = utf8_encode_function($row["home_logo"]);
		$home_name = utf8_encode_function($row["home_name"]);
		$away_logo = utf8_encode_function($row["away_logo"]);
		$away_name = utf8_encode_function($row["away_name"]);
		$id_match = $row["id"];
		$pronos_home = $row["prono_home"];
		$pronos_away = $row["prono_away"];
		$colorHome = $row["colorHome"];
		$colorAway = $row["colorAway"];
		$id_joueur = $row["id_joueur"];
		
		$id_match = $row["id_match"];
		$modif = $row["modif"];

		$point = $row["point"];
		$date_array = date_parse($row["date"]);

		if ($i++ == 0) {
			echo '
				<div class="nextmatchsolodate">
					'.$date_array['day']. ' / 0' . $date_array['month'].' / '.$date_array['year'].'
				</div>
				<div class="nextmatchsolotime">
					'.$date_array['hour']. ' h '.$date_array['minute']. '
				</div>
				<div class="nextmatchsoloteams">
					<div class="nextmatchsoloteamshome">
						<div class="nextmatchsoloteamshomeflag">
							<img class="logoEquipebigbig" src="'.$home_logo.'" />
						</div>
						<div class="nextmatchsoloteamshomename">
							<span>'.$home_name.'</span>
						</div>
					</div>
					<div class="nextmatchsoloteamsmiddle">
						<span></span>
					</div>
					<div class="nextmatchsoloteamsaway">
						<div class="nextmatchsoloteamsawayflag">
							<img class="logoEquipebigbig" src="'.$away_logo.'" />
						</div>
						<div class="nextmatchsoloteamsawayname">
							<span>'.$away_name.'</span>
						</div>
					</div>			
				</div>
			';
		}

		if ($pronos_home > $pronos_away) {
			$Result1++;
		} else if ($pronos_away > $pronos_home) {
			$Result2++;
		} else {
			$ResultN++;
		}


		if (intval($id_joueur) == $id) {
			echo '
			<div class="nextmatchsolopronos">
				<div class="nextmatchsolopronoshome">
					<span class="pancarteBigBig">'.$pronos_home.'</span>
				</div>
				<div class="nextmatchsolopronosmiddle">
					<span></span>
				</div>
				<div class="nextmatchsolopronosaway">
					<span class="pancarteBigBig">'.$pronos_away.'</span>
				</div>			
			</div>
			
			';
		}
	}

$total = $Result1 + $Result2 + $ResultN;
$px_b1 = $Result1 * 315 / $total;
$px_b2 = $Result2 * 315 / $total;
$px_bN = $ResultN * 315 / $total;

$class_b1 = "firstbar";
$class_bN = "";
$class_b2 = "lastbar";

if ($px_b1 == 315) {
	$class_b1 = "onebar";
} else if ($px_b2 == 315) {
	$class_b2 = "onebar";
} else if ($px_bN == 315) {
	$class_b3 = "onebar";
} else if ($px_b1 == 0) {
	$class_bN = "firstbar";
} else if ($px_b2 == 0) {
	$class_bN = "lastbar";
}

echo '<div class="nextmatchsolobar">';

	if ($modif == 2) {

		echo '
		<table class="percentBarpronos">
		<tr> 
			<td class="color1 barpronos barpronos1 	'. $class_b1.'"></td>
			<td class="color2 barpronos barpronos2 '. $class_bN.'"></td>
			<td class="color3 barpronos barpronos3 '. $class_b2.'"></td>
		</tr>
		</table>    
			
	<style>
	.barpronos1{
		width: '. $px_b1 .'px;
	}
	.barpronos2{
		width: '. $px_bN .'px;
	}
	.barpronos3{
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
	</style>
	';
}
	
	echo '</div>';
	
	// echo '<div class="nextmatchsolobutton">
	// 		<a class="nextmatchsolobuttontext">Details du match</a>
	// 	</div>';

echo '</div>';



	if (!$find)
	echo 'Pas encore de matches joués.';
	echo '';


echo '
			</div>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href=matches.php?id='.$id_match.' >
				Détail prochain match
			</a>

';

?>