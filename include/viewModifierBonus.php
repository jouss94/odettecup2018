<?php

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

		echo '<div class="profilInformation floaleft">';


	$qry = "SELECT *, joueurs.nom as joueursnom FROM joueurs 
	WHERE id_joueur='".$idProfil."';";
	$result = mysqli_query($con, $qry);
	$find = false;
	if ( $result) {
		while ($row = mysqli_fetch_array($result )) 
		{	
			$find = true;
			echo '<div class="profilInformationSurnom" style=" background:linear-gradient(', $row["color"] ,' 0%, #209aad 40%);">';
			echo '<span style="padding-top: 15px;display: block;color: #FFF;FONT-WEIGHT: bold;">';
			echo utf8_encode_function($row["surnom"]);
			echo '</span>';

			echo '<div class="profilInformationImageDiv"> 

					<img src="', utf8_encode_function($row["image"]), '" style="margin: 15px;border-color: #ffffff;" class="profilInformationImage mdl-button--raised"/>

				</div>';
			if ($idProfil == $id)
			{
				echo '<div> 
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ModifierProfil">
						Modifier Profil 
					</button>
				</div>';
			}

			echo '<div class="profilInformationCivil">', utf8_encode_function($row["prenom"]), '</div>';
			echo '<div class="profilInformationCivil">', utf8_encode_function($row["joueursnom"]), '</div>';
			echo '<div class="profilInformationCivil">', utf8_encode_function($row["email"]), '</div>';
			echo '<div class="profilInformationEmail">', utf8_encode_function($row["description"]), '</div>';
			
			
			$chipsProfil = 'chips-red';
			if (intval($row["modif_profil"]) == 1 && intval($row["modif_match"]) == 1 && intval($row["modif_bonus"]) == 1)
			$chipsProfil = 'chips-green';
			
			$chipsPayement = 'chips-red';
			if (intval($row["payed"]) == 1) $chipsPayement = 'chips-green';


			echo '
			<span class="mdl-chip mdl-chip--contact chips-body ', $chipsProfil, '-body">
				<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white ', $chipsProfil, '"></span>
				<span class="mdl-chip__text ">Profil à jour</span>
			</span>
			<span class="mdl-chip mdl-chip--contact chips-body ', $chipsPayement, '-body"">
				<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white ', $chipsPayement, '"></span>
				<span class="mdl-chip__text ">Paiment</span>
			</span>';

			echo '</div>';
		}
	}
	echo '</div>';

	if ($find)
	{

	 	$team_winner_id = "";
	 	$min_first = "";
	 	$min_last = "";
	 	$total_but = "";
	 	$best_scorer = "";
		$qryBonus = "SELECT * FROM pronostics_bonus WHERE id_membre='".$idProfil."';";
		$resultBonus = mysqli_query($con, $qryBonus);
		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{	
		 	$team_winner_id = $rowBonus["team_winner_id"];
		 	$min_first = $rowBonus["min_first"];
		 	$min_last = $rowBonus["min_last"];
		 	$total_but = $rowBonus["total_but"];
		 	$best_scorer = $rowBonus["best_scorer"];
		}

		$qry = "SELECT * FROM equipes  ORDER BY name;";
		$equipes = mysqli_query($con, $qry);

	// Pronotics

	echo '

	<div class="profilPronosSmall floaleft">
	<span class="profilPronosTitre">Pronostics Bonus</span>

		<span class="RetourSpan">
			<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
				Retour
			</button>
		</span>

	<form action="addBonus.php" method="post">';

	echo '

	<table class="tableauPronosForm">';

		echo '<tr>';
			echo '<td class="ParamTitre">Equipe vainqueur</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '
					    <select name="equipeWin" id="equipeWin" style="width:150px;">';
						while ($row = mysqli_fetch_array($equipes )) 
						{	
							$value = $row["id_equipe"];
							$name = utf8_encode_function($row["name"]);
								echo '<option value="'.$value.'" ';
								if ($value == $team_winner_id)
									echo ' selected="selected" ';
								echo '>'.$name.'</option>';
						}
					    echo '</select>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
				10 points </br>
				Trouvez le vainqueur du tournoi Euro 2020 

			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Minute du premier but</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="MinPronosFirst" class="serverside-validation" name="MinPronosFirst" type="text" value="'; if ($min_first !== null) echo $min_first; echo '"  size="8" /> Minutes';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
				7 points [tout-pil\'] 3 points [approchant] </br>
				Trouvez la minute du premier but du tournoi Euro 2020.
			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Minute du dernier but</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="MinPronosLast" class="serverside-validation" name="MinPronosLast" type="text" value="'; if ($min_last !== null) echo $min_last; echo '"  size="8" /> Minutes';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
				7 points [tout-pil\'] 3 points [approchant] </br>
				Trouvez la minute du dernier but du tournoi  Euro 2020.
			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Nombre total de buts</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="totalBut" class="serverside-validation" name="totalBut" type="text" value="'; if ($total_but !== null) echo $total_but; echo '"  size="8" /> Buts';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
				10 points [tout-pil\'] 5 points [approchant] </br>
				Trouvez le nombre de buts total du tournoi Euro 2020.
			</td>';
		echo '</tr>';

		// echo '<tr>';
		// 	echo '<td class="ParamTitre">Meilleur buteur</td>';

		// 	echo '<td rowspan="2" class="tdMatch tdMatchRight">';
		// 		echo '<input id="InputTextBestScorer" class="serverside-validation" name="InputTextBestScorer" type="text" value="'; if ($best_scorer !== null) echo $best_scorer; echo '"  size="8" /> ';
		// 	echo '</td>';
		// echo '</tr>';
		// echo '<tr>';
		// 	echo '<td class="ParamSousTitre">
		// 		7 points </br>
		// 		Trouvez le meilleur buteur du tournoi RUSSIE 2018.
		// 	</td>';
		// echo '</tr>';


	echo '</table>';
	echo '<div class="buttons">
				<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Valider
				</button>
			</div>';

	echo '		</form></div>';
	}
	else
	{
		echo 'Ce profil n\'exite pas';
	}

?>