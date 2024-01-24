<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	$qry = "SELECT *, 
	(nb_perf+nb_correct_plus+nb_correct+nb_inverse+nb_echec)  as total ,
	equipe_winner.logo as logo
	from joueurs 
	LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
	
	LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = joueurs.equipe 
	WHERE joueurs.competition = $competition
	ORDER BY rang, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;

	echo '
	<div class="allListeClassement">
		<table class="sortable" >';

	echo '
<thead>
<tr style="height: 40px;">
<th class="titleSmallTexte">Rang</th>
<th >Surnom</th>
<th class="titleSmallTexte">Ponos</th>
<th class="titleSmallTexte">Perfect</th>
<th class="titleSmallTexte">Correct</th>
<th class="titleSmallTexte">Inverse</th>
<th class="titleSmallTexte">Echec</th>
<th class="titleSmallTexte">Bonus</th>
<th class="titleSmallTexte"> Points</th>
</tr>
</thead>';
	$nbtotal = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result )) 
	{

		$i++;
		$find = true;
		$rang = $row["rang"];
		$surnom = utf8_encode_function($row["surnom"]);
		$id_joueur = $row["id_joueur"];
		$id = $row["id_joueur"];
		$points = $row["points"];
		$nb_perf = $row["nb_perf"];
		$nb_correct_plus = $row["nb_correct_plus"];
		$nb_correct = $row["nb_correct"];
		$nb_inverse = $row["nb_inverse"];
		$nb_echec = $row["nb_echec"];
		$bonus = $row["bonus"];
		$total = $row["total"];

			if ($i % 2 == 0) {
				echo '	<tr class="backgroundTab2">';
			}
			else {
				echo '	<tr class="backgroundTab1">';
			}


			echo '<td class="ClassementRang">',
					$rang,
				'</td>
				<td class="ClassementSurnom">
					<div id="lienSurnom', $id_joueur,'" style="" class="surnomClassementDiv clickJoueur">',
					
					$surnom;
				if ($row["logo"] != null) {
					echo '<img class="logoEquipProfil" src="';
					echo $row["logo"];	
					echo '" />';
				}					
				echo	'</div>
				</td>
				<td class="ClassementNbPronos">',
					$total,
				'</td>
				<td class="ClassementNbPerf">',
					$nb_perf,
				'</td>
				<td class="ClassementCorrect">',
					$nb_correct,
				'</td>
				<td class="ClassementInverse">',
					$nb_inverse,
				'</td>
				<td class="ClassementEchec">',
					$nb_echec,
				'</td>
				<td class="ClassementBonus">',
					$bonus,
				'</td>
				<td class="ClassementPoints">',
					$points,
				'</td>
			</tr>';


    }
    
    echo '
	</table>
	</div>';

    return '';
?>