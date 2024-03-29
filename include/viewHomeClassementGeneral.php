<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	echo '<table style="
    border-collapse: collapse;
    width: 100%;">';
	

	$qry = "SELECT *,
	equipe_winner.logo as logo
	from joueurs 
	LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
	LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = joueurs.equipe 
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
	
	if ($i% 2 == 0) {
		echo '	<tr class="backgroundTab2">';
	}
	else {
		echo '	<tr class="backgroundTab1">';
	}
	echo '<td class="homeClassementRang">';
			echo '<div>';
				echo $rang; 
			echo '</div>';
		echo '</td>';
		echo '<td class="homeClassementSurnom">';
			echo '<div id="lienSurnom', $id_joueur,'" class="surnomClassementDiv clickJoueur">';
			echo $surnom;	
			if ($row["logo"] != null) {
				echo '<img class="logoEquipProfil" src="';
				echo $row["logo"];	
				echo '" />';
			}
			echo '</div>';
		echo '</td>';
		echo '<td class="homeClassementPoint">';
		echo $points;
		echo '<span style="padding-left: 2px;" class="petitPoint">pts</span>';
		echo '</td>';
echo '	</tr>';		
	}
	
echo '</table>';

	if (!$find)
	echo 'Pas encore de joueur dans ce classement.';
	echo '';

?>