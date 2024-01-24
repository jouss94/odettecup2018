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
	 	$best_scorer = "";
		$qryBonus = "SELECT * FROM pronostics_bonus WHERE id_joueur='".$idProfil."';";
		$resultBonus = mysqli_query($con, $qryBonus);
		while ($rowBonus = mysqli_fetch_array($resultBonus )) 
		{	
		 	$team_winner_id = $rowBonus["team_winner_id"];
		 	$min_first = $rowBonus["min_first"];
		 	$min_last = $rowBonus["min_last"];
		 	$total_but = $rowBonus["total_but"];
		 	$best_scorer = $rowBonus["best_scorer"];
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
			echo '<td class="ParamTitre">Nombre total de buts</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="totalBut" type="number" name="totalBut" value="'; if ($total_but !== null) echo $total_but; echo '"  size="8" /> Buts';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
			Toutes les reponses situées dans une plage de 3 buts</br> avant 
			et après le résultat final remportent <strong>5 points</strong> 
				
			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Minute du premier but</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="MinPronosFirst" type="number" name="MinPronosFirst"  value="'; if ($min_first !== null) echo $min_first; echo '"  size="8" /> Minutes';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
			Toutes les reponses situées dans une plage de 2 minutes</br> 
			avant et après le minutage finale remportent <strong>5 points</strong> 
			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Minute du dernier but</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '<input id="MinPronosLast" type="number" name="MinPronosLast" value="'; if ($min_last !== null) echo $min_last; echo '"  size="8" /> Minutes';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
			Toutes les reponses situées dans une plage de 2 minutes</br> 
			avant et après le minutage finale remportent <strong>5 points</strong> 
			</td>';
		echo '</tr>';


		echo '<tr>';
		echo '<td class="ParamTitre">Meilleur buteur</td>';

		echo '<td rowspan="2" class="tdMatch tdMatchRight">';
			echo '<input id="InputTextBestScorer" name="InputTextBestScorer" type="text" value="'; if ($best_scorer !== null) echo $best_scorer; echo '"  size="8" /> ';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td class="ParamSousTitre">
			Trouver le meilleur buteur de la coupe du monde</br>
			Rapporte <strong>5 points</strong> 
		</td>';
	echo '</tr>';

	echo '<tr>';
			echo '<td class="ParamTitre">Joueur vainqueur</td>';

			echo '<td rowspan="2" class="tdMatch tdMatchRight">';
				echo '
					    <select name="joueurWin" id="joueurWin" style="width:150px;">';
						while ($row = mysqli_fetch_array($joueurs)) 
						{	
							$value = $row["id_joueur"];
							$name = utf8_encode_function($row["surnom"]);
								echo '<option value="'.$value.'" ';
								if ($value == $player_winner_id)
									echo ' selected="selected" ';
								echo '>'.$name.'</option>';
						}
					    echo '</select>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td class="ParamSousTitre">
			Trouver le joueur vainqueur du tournoi Odette Cup 2022 </br>
			Rapporte <strong>5 points</strong> 

			</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td class="ParamTitre">Equipe favorite</td>';

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
				Attention ce choix est très important</br>
				&nbsp;&nbsp;&nbsp;&nbsp;Eliminé en poule :&nbsp;&nbsp;&nbsp;&nbsp; <strong>-3 points</strong></br> 
				&nbsp;&nbsp;&nbsp;&nbsp;Eliminé en 8eme  :&nbsp;&nbsp;&nbsp; &nbsp;<strong>0 point</strong></br> 
				&nbsp;&nbsp;&nbsp;&nbsp;Passe les 8emes  :&nbsp;&nbsp;&nbsp; <strong>+1 point</strong></br> 
				&nbsp;&nbsp;&nbsp;&nbsp;Passe les quarts :&nbsp;&nbsp;&nbsp;&nbsp; <strong>+2 points</strong></br> 
				&nbsp;&nbsp;&nbsp;&nbsp;Passe les demies :&nbsp;&nbsp; <strong>+3 points</strong></br> 
				&nbsp;&nbsp;&nbsp;&nbsp;Gagne le tournoi :&nbsp;&nbsp;&nbsp;&nbsp; <strong>+5 points</strong></br> 

			</td>';
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