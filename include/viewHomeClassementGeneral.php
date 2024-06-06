<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';


	echo '<div class="home-classement">';

	$qry = "SELECT *
	from joueurs 
	LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
	WHERE joueurs.competition = $competition
	ORDER BY rang, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
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



		echo '<div class="homeClassementRang ">';
		echo '<div>';
			echo $rang; 
		echo '</div>';
	echo '</div>';
	echo '<div class="homeClassementSurnom ">';
		echo '<div id="lienSurnom', $id_joueur,'" class="surnomClassementDiv clickJoueur">';
		echo $surnom;	
		echo '</div>';
	echo '</div>';
	echo '<div class="homeClassementPoint ">';
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