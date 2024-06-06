<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

	$find = true;

	if ($find)
	{

	 	$team_winner_id = "";
		$player_winner_id = "";
	 	$min_first = "";
	 	$min_last = "";
	 	$total_but = "";
	 	$fairplay = "";
	 	$but_edf = "";
	 	$penalty = "";
	 	$team_final_1 = "";
	 	$team_final_2 = "";
		$qryBonus = "SELECT * FROM pronostics_bonus WHERE id_joueur='".$idProfil."';";
		$resultBonus = mysqli_query($con, $qryBonus);
		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{	
		 	$team_winner_id = $rowBonus["team_winner_id"];
		 	$min_first = $rowBonus["min_first"];
		 	$min_last = $rowBonus["min_last"];
		 	$total_but = $rowBonus["total_but"];
		 	$fairplay = $rowBonus["fairplay"];
		 	$but_edf = $rowBonus["but_edf"];
		 	$penalty = $rowBonus["penalty"];
		 	$team_final_1 = $rowBonus["team_final_1_id"];
		 	$team_final_2 = $rowBonus["team_final_2_id"];
		 	$player_winner_id = $rowBonus["player_winner_id"];
		}

		$qry = "SELECT * FROM equipes ORDER BY name;";
		$equipes = mysqli_query($con, $qry);

		$qry = "SELECT * FROM joueurs ORDER BY surnom;";
		$joueurs = mysqli_query($con, $qry);

	// Pronotics

	echo '
	<span class="listeJoueurTitre">Pronostics Bonus</span>

		<span class="RetourSpanContainer">
			<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
				Retour
			</button>
		</span>

	<form action="addBonus.php" method="post">';

	echo '

	<table class="tableauPronosForm">';


		echo '<tr>';
			echo '<td class="ParamTitre">Minute du premier but</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="MinPronosFirst" type="number" name="MinPronosFirst"  value="'; if ($min_first !== null) echo $min_first; echo '"  size="8" /> <div class="bonus_valeur">Minutes</div>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
			Un seul gagnant</br> 
			Le plus proche remporte : <strong>4 points</strong></br> 
			Si score exact : <strong>7 points</strong> 
			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Minute du dernier but</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="MinPronosLast" type="number" name="MinPronosLast" value="'; if ($min_last !== null) echo $min_last; echo '"  size="8" /> <div class="bonus_valeur">Minutes</div>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="ParamSousTitre">
		Un seul gagnant</br> 
		Le plus proche remporte : <strong>4 points</strong></br> 
		Si score exact : <strong>7 points</strong> 
		</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td class="ParamTitre">Nombre total de buts</td>';

		echo '<td rowspan="2" class="tdMatch tdMatchRight">';
			echo '<input id="totalBut" type="number" name="totalBut" value="'; if ($total_but !== null) echo $total_but; echo '"  size="8" /> <div class="bonus_valeur">Buts</div>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="ParamSousTitre">
	Un seul gagnant</br> 
	Le plus proche remporte : <strong>4 points</strong></br> 
	Si score exact : <strong>7 points</strong> 
	</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td class="ParamTitre">Fairplay</td>';

	echo '<td rowspan="2" class="tdMatch tdMatchRight">';
		echo '<input id="fairplay" type="number" name="fairplay" value="'; if ($fairplay !== null) echo $fairplay; echo '"  size="8" /> <div class="bonus_valeur">Cartons</div>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="ParamSousTitre">
	
	Nombre de carton sur toute la compétition</br> 
	Jaune = +1pt / Rouge = +2pts</br> 
	1 gagnant. <strong>4 points</strong>. <strong>7 points</strong> 
	</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td class="ParamTitre">Pénalty</td>';

	echo '<td rowspan="2" class="tdMatch tdMatchRight">';
		echo '<input id="penalty" type="number" name="penalty" value="'; if ($penalty !== null) echo $penalty; echo '"  size="8" /> <div class="bonus_valeur">Penalty</div>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="ParamSousTitre">
	
	Nombre de pénalty sifflés sur toute la compétition</br> 
	1 gagnant. <strong>4 points</strong>. <strong>7 points</strong> 
	</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td class="ParamTitre">But de l\'Equipe de France</td>';

	echo '<td rowspan="2" class="tdMatch tdMatchRight">';
		echo '<input id="but_edf" type="number" name="but_edf" value="'; if ($but_edf !== null) echo $but_edf; echo '"  size="8" /> <div class="bonus_valeur">Buts</div>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="ParamSousTitre">
	
	Nombre de buts de l\'Equipe de France</br> 
	Sur l\'ensemble de la compétition</br> 
	Seuls les scores exacts marquent 5 points 
	</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td class="ParamTitre">Equipes finalistes</td>';
				echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '
					    <select name="team_final_1" id="team_final_1" style="width:150px;">';
						while ($row = mysqli_fetch_array($equipes )) 
						{	
							$value = $row["id_equipe"];
							$name = utf8_encode_function($row["name"]);
								echo '<option value="'.$value.'" ';
								if ($value == $team_final_1)
									echo ' selected="selected" ';
								echo '>'.$name.'</option>';
						}
					    echo '</select>';
						echo '-
					    <select name="team_final_2" id="team_final_2" style="width:150px;">';
						$qry = "SELECT * FROM equipes ORDER BY name;";
						$equipes = mysqli_query($con, $qry);
						while ($row = mysqli_fetch_array($equipes )) 
						{	
							$value = $row["id_equipe"];
							$name = utf8_encode_function($row["name"]);
								echo '<option value="'.$value.'" ';
								if ($value == $team_final_2)
									echo ' selected="selected" ';
								echo '>'.$name.'</option>';
						}
					    echo '</select>';
			echo '</td>';
	echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
				Trouve les deux finalistes de la compétiton</br>
				1 finaliste trouvé sur 2 : 4 points</br>
				2 finalistes trouvés sur 2 : 10 points</br>
				</td>';

				echo '</tr>';

	echo '</tr>';
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