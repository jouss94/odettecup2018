<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	$prev_day = $current_day - 1;

	require_once 'config.php';
	require_once 'functions.php';
	?>

	<div class="viewMatchTitle">
		<div id="viewPrevMatchTitlePrevDay" class="viewMatchTitlePrevDay viewMatchTitleArrow"><i class="material-icons">arrow_back_ios</i></div>
		<div id="viewPrevMatchTitleDay" class="viewMatchTitleDay"></div>
		<div id="viewPrevMatchTitleNextDay" class="viewMatchTitleNextDay viewMatchTitleArrow"><i class="material-icons">arrow_forward_ios</i></div>
	</div>

	<div id="viewPrevMatchContent" class="viewPrevMatchContent">
	<?php
echo 
'<script type="text/javascript">',
	 "getDisplayMatchDay(
		'getDisplayMatchLastDayAccueil',
		$id, 
		$id,
		$competition, 
		$prev_day, 
		$current_day, 
		'viewPrevMatchContent', 
		'viewPrevMatchTitlePrevDay', 
		'viewPrevMatchTitleNextDay', 
		'viewPrevMatchTitleDay',
		'profilLast');",
 '</script>';
?>

</div>
<!-- 
	echo '<table class="full-table-collapse-white">';
	

	$qry = "SELECT * FROM matches WHERE modif=2;";
	$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.display_name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.display_name  as away_name,
					equipes_away.logo  as away_logo,
					pronos.*
			FROM matches 
			LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
			LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
			LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id WHERE modif=2  and played = 1 ORDER BY date DESC, id;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
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

		$point = $row["point"];

		$classPancarte = "";
		$classTR = "classTRNeutre";
			if ($point == 0) {
				$classTR = "classTREchecHome";
				$classPancarte = "pancarte-echec";
			}
			if ($point == 1 || $point == 2) {
				$classTR = "classTRInverseHome";
				$classPancarte = "pancarte-inverse";
			}
			if ($point == 3 || $point == 6) {
				$classTR = "classTRCorrectHome";
				$classPancarte = "pancarte-correct";
			}
			if ($point == 4 || $point == 8) {
				$classTR = "classTRCorrectPlusHome";
				$classPancarte = "pancarte-correct";
			}
			if ($point == 7 || $point == 14) {
				$classTR = "classTRPerfectHome";
				$classPancarte = "pancarte-perfect";

			}

		$date_array = date_parse($row["date"]);
// echo '	<tr class="', $classTR, '">';

		$classPancarte = "";
		$minute = $date_array['minute'];
		if (intval($minute) < 9) {
			$minute = '0' . $minute;
		}

		if ($i++ % 2 == 0) {
			echo '	<tr class="backgroundTab2">';
		}
		else {
			echo '	<tr class="backgroundTab1">';
		}

		echo '<td class="homeSmallDate">';
		echo '<div>';
			echo $date_array['day']. "/0" . $date_array['month'];	
		echo '</div>';
		echo '<div>';
			echo $date_array['hour']. "h" . $minute;	
		echo '</div>';
		echo '</td>';
		echo '<td><img class="logoEquipeSmall" src="';
		echo $home_logo;	
		echo '" /></td>';
		echo '</td>';
		echo '<td class="homeEquipeDroite">';
		echo $home_name;	
		echo '</td>';
		echo '<td class="homeEquipeEquipe"><span class="pancarteBig ',$classPancarte,'">';
		echo $row["prono_home"];
		echo '</span></td>';
		echo '<td class="homeEquipeMilieu"> - </td>';
		echo '<td class="homeEquipeEquipe"><span class="pancarteBig ',$classPancarte,'">';
		echo $row["prono_away"];
		echo '</span></td>';
		echo '<td class="homeEquipeGauche">';
		echo $away_name;	
		echo '</td>';
		echo '<td><img class="logoEquipeSmall" src="';
		echo $away_logo;	
		echo '" /></td>';
		echo '<td class="homePoint ', $classTR ,'">+';
		echo $row["point"];;
		echo '</td>';
echo '	</tr>';		

	}
	
echo '</table>';

	if (!$find)
	echo 'Pas encore de matches joués.';
	echo '';

?> -->