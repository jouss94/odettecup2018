<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';




	parse_str($_SERVER["QUERY_STRING"], $query);
	$idEquipe = $query['id'];

	$qry = "SELECT joueurs.*, coequipiers.nom as nom_equipe,
		general.rang as generalrang,
		general.points as generalpoints,
		equipe.rang as equiperang,
		equipe.points as equipepoints
	FROM `joueurs` 
	LEFT JOIN coequipiers ON coequipiers.id = joueurs.equipe
	LEFT JOIN classements as general ON general.owner_id = joueurs.id_joueur AND general.type = 'general'
	LEFT JOIN classements as equipe ON equipe.owner_id = joueurs.equipe AND equipe.type = 'equipe' 
	WHERE joueurs.equipe = $idEquipe;";

	$result = mysqli_query($con, $qry);
	$find = false;

	echo '

		<div class="viewEquipe">';

	$first = 0;

	while ($row = mysqli_fetch_array($result)) 
	{
		if ($first == 0)
		{
			$first = 1;
			$nom_equipe = utf8_encode_function($row["nom_equipe"]);
			$rangEquipe = intval($row["equiperang"]);
			$equipepoints = intval($row["equipepoints"]);
			echo '<div class="equipeTitre">', $nom_equipe ,' </div>
			<div class="equipeContainer">';
		}
		
		echo '
		<div class="joueur-card-event mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand">
				<div class="cadreTableauAcceuilNoHeight cadreTableauAcceuilBg">
					
					<div class="profilInformationImageDiv"> 

						<img src="', utf8_encode_function($row["image"]), '" style="margin: 15px;" class="profilInformationImage mdl-button--raised"/>

					</div>


					<div class="classementperso-card-event mdl-card classement-general mdl-shadow--2dp small-version">
					<div class="mdl-card__title mdl-card--expand">
						<span class="TitreSmallClassement">';
							$rangGenerel = intval($row["generalrang"]);
							echo $rangGenerel;
							if ($rangGenerel == 1)
							{
								echo ' er';
							}
							else {
								echo ' eme';
							}
			
							echo'</span>
						<span class="TitreTableauBas">';
						echo intval($row["generalpoints"]);
						echo ' pts
						</span>
						</div>
				</div>
			

				</div>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="profil.php?id=',$row["id_joueur"],'" >
				',  utf8_encode_function($row["surnom"]),'
				</a>
				<div class="mdl-layout-spacer"></div>
				<i class="material-icons">event</i>
			</div>
		</div>
	';

	}
		echo '</div>';

		echo '<div class="equipeContainer">';

		echo '
		<div class="classementequipe-card-event mdl-card classement-equipe mdl-shadow--2dp">
		<div class="mdl-card__title mdl-card--expand">
			<span class="TitreSmallClassementBig">';
				echo $rangEquipe;
				if ($rangEquipe == 1)
				{
					echo ' er';
				}
				else {
					echo ' eme';
				}

				echo'</span>
			<span class="TitreTableauBasBig">';
			echo $equipepoints;
			echo ' pts
			</span>
			</div>
	</div>

		
		';

		echo '</div>';
		
	echo '</div>';


?>