<?php

    $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	$qry = "SELECT *, (nb_perf+nb_correct_plus+nb_correct+nb_inverse+nb_echec)  as total from joueurs 
	LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general' 
	ORDER BY rang, nb_perf DESC, nb_correct_plus DESC, nb_correct DESC, nb_inverse DESC, surnom;";
	$result = mysqli_query($con, $qry);
	$find = false;
	$i = 0;

	echo '
		<div class="allListeClassement">
		<table class="sortable" >';

	echo '
<thead>
  <tr>
     <th>Rang</th>
     <th style="padding-top: 10px;padding-bottom: 10px;">Surnom</th>
     <th class="titleSmallTexte">Ponos</th>
     <th class="titleSmallTexte">Perfect</th>
     <th class="titleSmallTexte">Correct+</th>
     <th class="titleSmallTexte">Correct</th>
     <th class="titleSmallTexte">Inverse</th>
     <th class="titleSmallTexte">Echec</th>
     <th class="titleSmallTexte">Bonus</th>
     <th class="titleSmallTexte"> Points</th>
  </tr>
   </thead>';
	$nbtotal = mysqli_num_rows($result);
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
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

		$classTR = "classTRInverseHomeClassement";
			if ($i == 1)
				$classTR = "classTRPerfectHomeClassement";
			else if ($i == 2 || $i == 3)
				$classTR = "classTRCorrectPlusHomeClassement";
			else if ($i == 4)
				$classTR = "classTRCorrectHomeClassement";
			//if ($nbtotal < $i + 3)
			//	$classTR = "classTREchecHomeClassement";

			/// 	<tr class="', $classTR,'" style="border-bottom: solid 1px #FFF;">
			if ($i++ % 2 == 0) {
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
					
					$surnom,
					'</div>
				</td>
				<td class="ClassementNbPronos">',
					$total,
				'</td>
				<td class="ClassementNbPerf">',
					$nb_perf,
				'</td>
				<td class="ClassementCorrectp">',
					$nb_correct_plus,
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