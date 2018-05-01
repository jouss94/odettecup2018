<?php
	

	// session_start();

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$qry = "SELECT * FROM joueurs WHERE id_joueur=".$id.";";
	$result = mysqli_query($con, $qry);
	$find = false;
	while ($row = mysqli_fetch_array($result )) 
	{
		$modif_profil = intval($row["modif_profil"]);
		$modif_match = intval($row["modif_match"]);
		$modif_bonus = intval($row["modif_bonus"]);

		if ($modif_bonus == 1 && $modif_match == 1 && $modif_profil == 1)
		{
				echo "<div class='etatProfilGreen' id='add_valideDemand'>
							Votre Profil est à jour.
						</div>";
		}

		else
		{
				echo "<div class='etatProfilRed' id='add_errDemand'>
						<table style='border-collapse: collapse;'>
							<tr>
								<td>
								 	<span rowspan='2' class='titreUpdateRed'>Votre Profil n'est pas à jour :</span>
								</td>
							</tr>

						";
			if ($modif_profil == 0)
				echo "
							<tr>
								<td class='sousTitreUpdateRed'>
									<span >Vous devez modifier vos informations de profil </span>
								</td>
								<td class='detailTitreUpdateRed'>
									<span class='detailTitreUpdateRedSpan' id='modifProfilDetails'> mettre à jour &rarr; </span>
								</td>
							</tr>

						";
				if ($modif_match == 0)
				echo "
							<tr>
								<td class='sousTitreUpdateRed'>
									<span >Vous devez entrer vos pronostics pour les matches à venir </span>
								</td>
								<td class='detailTitreUpdateRed'>
									<span class='detailTitreUpdateRedSpan' id='modifMatchDetails'> mettre à jour &rarr; </span>
								</td>
							</tr>

						";

			if ($modif_bonus == 0)
				echo "
							<tr>
								<td class='sousTitreUpdateRed'>
									<span >Vous devez entrer vos pronostics bonus </span>
								</td>
								<td class='detailTitreUpdateRed'>
									<span class='detailTitreUpdateRedSpan' id='modifBonusDetails'> mettre à jour &rarr; </span>
								</td>
							</tr>

						";
			
			
			echo "		</table>
					</div>";
		}
	}

	echo '<div>';
	
	echo '</div>';

?>