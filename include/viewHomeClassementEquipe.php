<?php
	
	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	echo '<table style="
    border-collapse: collapse;
    width: 100%;">';
	

	$qry = "SELECT * from coequipiers 
	LEFT JOIN classements ON classements.owner_id = coequipiers.id AND type = 'equipe'  
	ORDER BY rang, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;
	$nbtotal = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result )) 
	{
		$i++;
		$find = true;
		$rang = $row["rang"];
		$nom = utf8_encode_function($row["nom"]);
		$id_equipe = $row["id"];
		$points = $row["points"];

		if ($i% 2 == 0) {
			echo '	<tr class="backgroundTab1Bleu">';
		}
		else {
			echo '	<tr class="backgroundTab2Bleu">';
		}
			echo '<td class="homeClassementRang">';
			echo '<div>';
				echo $rang; 
			echo '</div>';
		echo '</td>';
		echo '<td class="homeClassementSurnom">';
			echo '<div id="lienSurnom', $id_equipe,'" class="surnomClassementDiv">';
			echo $nom;	
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