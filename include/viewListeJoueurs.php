<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$qry = "SELECT * FROM joueurs LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general';";
	$result = mysqli_query($con, $qry);
	$find = false;

	echo '

		<div class="allListe">
		<table class="tableListe" style="background:#FFF;" >';


	while ($row = mysqli_fetch_array($result )) 
	{

		$image = utf8_encode_function($row["image"]);
		$surnom = utf8_encode_function($row["surnom"]);
		$points = utf8_encode_function($row["points"]);
		$rang = utf8_encode_function($row["rang"]);
		$id_joueur = $row["id_joueur"];

	echo '
			<tr style="border-bottom: solid 1px rgba(0, 0, 0, 0.16);">
				<td class="tableListeFirst">
					<img class="imageListe" src="', $image, '" />
				</td>
				<td class="tableListeSecond">',
					$surnom,
				'</td>
				<td class="tableListeThird"> <div class="pancarteListeJoueur" style="background:', $row["color"],'">',
					$points,
				'		<span class="petitPoint">pts</span>
				</div>	</td>
				<td class="tableListeFour" id="detailJoueur', $id_joueur ,'">
					Détail joueur &rarr;
				</td>
			</tr>';


	}
	echo '
		</table>
		</div>

	';

?>