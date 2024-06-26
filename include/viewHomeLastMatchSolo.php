<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	echo '
	<div class="cadreTableauAcceuilOneMatch cadreTableauAcceuilBg">
		<div class="nextmatchsolo">';
	
	$qry = "SELECT matches.*,
	matches.id_match as id, 
	equipes_home.name  as home_name,
	equipes_home.logo  as home_logo,
	equipes_away.name  as away_name,
	equipes_away.logo  as away_logo,
	equipes_home.color as colorHome,
	equipes_away.color as colorAway,
	pronos.*
	FROM (SELECT * from matches WHERE (modif=1 OR modif=2) and played = 1 ORDER BY date DESC, id_match LIMIT 1) as matches
	LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
	LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
	LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match 
	LEFT JOIN joueurs j ON pronos.id_joueur = j.id_joueur 
	WHERE competition = $competition;";

	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;

	$ResultP = 0;
	$ResultC = 0;
	$ResultCp = 0;
	$ResultI = 0;
	$ResultE = 0;

	$modif = -1;

	$id_match = 0;

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
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
				
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
					'.$date_array['hour']. ' h 00
				</div>
				<div class="nextmatchsoloteams">
					<div class="nextmatchsoloteamshome">
						
						<div class="nextmatchsoloteamshomename">
							<span>'.$home_name.'</span>
						</div>
						<div class="nextmatchsoloteamshomeflag">
								<img class="logoEquipebigbig" src="'.$home_logo.'" />
						</div>

					</div>
					<div class="nextmatchsoloteamsmiddle">
						<span>VS</span>
					</div>
					<div class="nextmatchsoloteamsaway">
					<div class="nextmatchsoloteamsawayname">
					<span>'.$away_name.'</span>
				</div>
										<div class="nextmatchsoloteamsawayflag">
						<img class="logoEquipebigbig" src="'.$away_logo.'" />
						</div>

					</div>			
				</div>
			';
		}
		
		$resultText = "Echec";
		$resultTextCss = "perfectEchec";
		$resultPancarteCss = "colorEresult";
		if ($point == 7 || $point == 14) {
			$ResultP++;
			$resultText = "Perfect";
			$resultTextCss = "perfectTitre";
			$resultPancarteCss = "colorPresult";
		} else if ($point == 3 || $point == 6) {
			$ResultC++;
			$resultText = "Correct";
			$resultTextCss = "perfectCorrect";
			$resultPancarteCss = "colorCresult";
		} else if ($point == 4 || $point == 8) {
			$ResultCp++;
			$resultText = "Correct+";
			$resultTextCss = "perfectCorrectPlus";
			$resultPancarteCss = "colorCpresult";
		}
		else if ($point == 1 || $point == 2) {
			$ResultI++;
			$resultText = "Inverse";
			$resultTextCss = "perfectInverse";
			$resultPancarteCss = "colorIresult";
		} else {
			$ResultE++;
		}


		if (intval($id_joueur) == $id) {
			echo '
			<div class="lastmatchsolopronos magintopless20">
				<span class="scoretext">Score :</span>		
			</div>
			<div class="lastmatchsolopronos">
					<div class="nextmatchsolopronoshome">
						<span class="pancarteBigBigSmall">'.$score_home.'</span>
					</div>
					<div class="lastmatchsolopronosmiddle">
						<span>-</span>
					</div>
					<div class="nextmatchsolopronosaway">
						<span class="pancarteBigBigSmall">'.$score_away.'</span>
					</div>			
				</div>
			<div class="lastmatchsolopronos">
				<span class="scoretext">Pronos :</span>		
			</div>
				<div class="lastmatchsolopronos">
					<div class="nextmatchsolopronoshome">
						<span class="pancarteBigBigSmall '.$resultPancarteCss.'">'.$pronos_home.'</span>
					</div>
					<div class="lastmatchsolopronosmiddle">
						<span>-</span>
					</div>
					<div class="nextmatchsolopronosaway">
						<span class="pancarteBigBigSmall '.$resultPancarteCss.'">'.$pronos_away.'</span>
					</div>			
				</div>
			<div class="lastmatchsolopronos magintoplessline">
				<span class="resultText '.$resultTextCss.'">'.$resultText.'</span>				
				<span class="middleResultText"></span>
				<span class="resultTextPoint '.$resultTextCss.'">+'. $point.'</span>
			</div>
			';
		}
	}

	$total = $ResultP + $ResultC + $ResultI + $ResultE + $ResultCp;

	if ($total != 0) {
		$px_bP = $ResultP * 315 / $total;
		$px_bC = $ResultC * 315 / $total;
		$px_bCp = $ResultCp * 315 / $total;
		$px_bI = $ResultI * 315 / $total;
		$px_bE = $ResultE * 315 / $total;

		$class_bP = "lastbar";
		$class_bC = "";
		$class_bCp = "";
		$class_bI = "";
		$class_bE = "firstbar";

		if ($px_bP == 315) {
			$class_bP = "onebar";
		} else if ($px_bC == 315) {
			$class_bC = "onebar";
		} else if ($px_bCp == 315) {
			$class_bCp = "onebar";
		} else if ($px_bI == 315) {
			$class_bI = "onebar";
		}  else if ($px_bE == 315) {
			$class_bE = "onebar";
		}	else {
			if ($px_bP == 0) {
				$class_bC = "lastbar";
				if ($px_bC == 0) {
					$class_bI = "lastbar";
				}
			} 

			if ($px_bE == 0) {
				$class_bI = "firstbar";
				if ($px_bI == 0) {
					$class_bC = "firstbar";
				}
			}
		}

	}
	


echo '<div class="nextmatchsolobar">';

	if ($modif == 2) {

		echo '
		<table class="percentBarresult">
		<tr> 
			<td class="colorEresult barpronos borderNone barresulte '. $class_bE.'"></td>
			<td class="colorIresult barpronos borderNone barresulti '. $class_bI.'"></td>
			<td class="colorCresult barpronos borderNone barresultc '. $class_bC.'"></td>
			<td class="colorCpresult barpronos borderNone barresultcp '. $class_bCp.'"></td>
			<td class="colorPresult barpronos borderNone barresultp '. $class_bP.'"></td>
		</tr>
		</table>    
			
			<style>
			.barresultp{
				width: '. $px_bP .'px;
			}
			.barresultc{
				width: '. $px_bC .'px;
			}
			.barresultcp{
				width: '. $px_bCp .'px;
			}
			.barresulti{
				width: '. $px_bI .'px;
			}
			.barresulte{
				width: '. $px_bE .'px;
			}

			.colorPresult{
				background: #00b7ff;
				border: solid 2px #c0f4fa;
			}
			.colorCresult{
				background: #2bdf6e;
				border: solid 2px #b1f7c0;
			}
			
			.colorCpresult{
				background: #2bdfaa;
				border: solid 2px #b1f7ff;
			}
			.colorIresult{
				background: #757575;
				border: solid 2px #cdcdcd;
			}
			.colorEresult{
				background-color: #ed1e25;	
				border: solid 2px #ed9d9d;
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
				Détail dernier résultat
			</a>

';

?>