<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	echo '<div class="home-classement">';
	
	$qry = "SELECT *,
	equipe_winner.logo as logo,
    playoffs.name as playoffs_name
	from joueurs 
	LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur
	LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = joueurs.equipe 
    LEFT JOIN playoffs  ON (playoffs.equipe_home = classements.rang || playoffs.equipe_ext = classements.rang)
	WHERE joueurs.competition = $competition
	ORDER BY rang, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, surnom;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
	$nbtotal = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result )) 
	{
		$i++;
		$find = true;
		$rang = $row["rang"];
		$surnom = utf8_encode_function($row["surnom"]);
		$id_joueur = $row["id_joueur"];
		$points = $row["points"];
		$playoffs_name = $row["playoffs_name"];

		$half = round(intval($nbtotal) / 2);

		if ($half%2 == 0 && $i == $half + 1) {
			$i++;
		}
		if ($i% 2 == 0) {
			echo '	<div class="home-classement-item backgroundTab2">';
		}
		else {
			echo '	<div class="home-classement-item backgroundTab1">';
		}

	$background_rang = "";
	$background_surnom = "";

	if ($playoffs_name != "") {
		$letter = $playoffs_name[0];
		$value =  $playoff_classement[$letter];
		$background_rang = $value;
		$background_surnom = $value . "-gradient";	
	}
	


	echo '<div class="homeClassementRang '.$background_rang.'">';
			echo '<div>';
				echo $rang; 
			echo '</div>';
		echo '</div>';
		echo '<div class="homeClassementSurnom '.$background_surnom.'">';
			echo '<div id="lienSurnom', $id_joueur,'" class="surnomClassementDiv clickJoueur">';
			echo $surnom;	
			if ($row["logo"] != null) {
				echo '<img class="logoEquipProfil" src="';
				echo $row["logo"];	
				echo '" />';
			}
			echo '</div>';
		echo '</div>';
		echo '<div class="homeClassementPoint">';
		echo $points;
		echo '<span style="padding-left: 2px;" class="petitPoint">pts</span>';
		echo '</div>';
echo '	</div>';		
	}
	
echo '</div>';


$height = round(intval($nbtotal) / 2) * 60;

echo '
<style>
.home-classement{
	height: '.$height.'px;
 }</style>';

	if (!$find)
	echo 'Pas encore de joueur dans ce classement.';
	echo '';

?>