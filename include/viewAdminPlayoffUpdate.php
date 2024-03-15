<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	parse_str($_SERVER["QUERY_STRING"], $query);

	require_once 'config.php';
	require_once 'functions.php';
	
	?>

<div class="admin-buttons">
	<div class="admin-button">
		<button class="RetourSpanBonusAdmin mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonBlanc">
			Retour
		</button>
	</div>
</div>

<div class="admin">

<?php 
	$subQry = "SELECT playoffs.*,
	joueurs_home.id_joueur as joueurs_home_id_joueur, 
	joueurs_ext.id_joueur as joueurs_ext_id_joueur,
	classements_home.rang as classements_home_rang,
	classements_ext.rang as classements_ext_rang
	FROM playoffs
	LEFT JOIN classements classements_home on classements_home.rang = playoffs.equipe_home
	LEFT JOIN joueurs joueurs_home on classements_home.owner_id = joueurs_home.id_joueur
	LEFT JOIN classements classements_ext on classements_ext.rang = playoffs.equipe_ext
	LEFT JOIN joueurs joueurs_ext on classements_ext.owner_id = joueurs_ext.id_joueur
	WHERE playoffs.competition = $competition;";

	$subResult = mysqli_query($con, $subQry);

	$result = null;
	while ($row = mysqli_fetch_array($subResult)) 
	{
		$id = $row["id"];
		$name = $row["name"];
		$equipe_home = $row["equipe_home"];
		$equipe_ext = $row["equipe_ext"];
		$id_equipe_home = $row["id_equipe_home"];
		$id_equipe_ext = $row["id_equipe_ext"];
		$day = $row["day"];
		$competition = $row["competition"];
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
		$joueurs_home_id_joueur = $row["joueurs_home_id_joueur"];
		$joueurs_ext_id_joueur = $row["joueurs_ext_id_joueur"];
		$classements_home_rang = $row["classements_home_rang"];
		$classements_ext_rang = $row["classements_ext_rang"];

		if ($id_equipe_home == null) {
			$id_equipe_home = $joueurs_home_id_joueur;
		}

		if ($id_equipe_ext == null) {
			$id_equipe_ext = $joueurs_ext_id_joueur;
		}

		$vainqueur = null;
		if ($score_home != null && $score_away != null) 
		{
			if ($score_away > $score_home) {
				$vainqueur = $id_equipe_ext;
			}

			if ($score_away < $score_home) {
				$vainqueur = $id_equipe_home;
			}

			if ($score_away == $score_home) {
				if ($classements_ext_rang < $classements_home_rang) {
					$vainqueur = $id_equipe_ext;
				}
				else {
					$vainqueur = $id_equipe_home;
				}
			}
		}

		$id_equipe_home_value = $id_equipe_home == null ? 'NULL' : $id_equipe_home;
		$id_equipe_ext_value = $id_equipe_ext == null ? 'NULL' : $id_equipe_ext;
		$vainqueur_value = $vainqueur == null ? 'NULL' : $vainqueur;

		$qry = " UPDATE `playoffs` 
		SET 
			id_equipe_home=$id_equipe_home_value,
			id_equipe_ext=$id_equipe_ext_value,
			vainqueur=$vainqueur_value
		WHERE id=$id
			;";

		$result = mysqli_query($con, $qry);

		echo $qry . '<br>';

		if (!$result) {
			echo 'Error SQL';
		}
	}



	$subQry = "SELECT playoffs.*,
	playoffs_result_home.vainqueur as playoffs_result_home_vainqueur,
	playoffs_result_ext.vainqueur as playoffs_result_ext_vainqueur
	FROM playoffs
	LEFT JOIN playoffs playoffs_result_home on playoffs_result_home.name = playoffs.equipe_home
	LEFT JOIN playoffs playoffs_result_ext on playoffs_result_ext.name = playoffs.equipe_ext
	WHERE playoffs.competition = $competition;";

	$subResult = mysqli_query($con, $subQry);

	$result = null;
	while ($row = mysqli_fetch_array($subResult)) 
	{
		$id = $row["id"];
		$name = $row["name"];
		$equipe_home = $row["equipe_home"];
		$equipe_ext = $row["equipe_ext"];
		$id_equipe_home = $row["id_equipe_home"];
		$id_equipe_ext = $row["id_equipe_ext"];
		$day = $row["day"];
		$competition = $row["competition"];
		$score_home = $row["score_home"];
		$score_away = $row["score_away"];
		$playoffs_result_home_vainqueur = $row["playoffs_result_home_vainqueur"];
		$playoffs_result_ext_vainqueur = $row["playoffs_result_ext_vainqueur"];

		if ($playoffs_result_home_vainqueur != null) {
			$id_equipe_home = $playoffs_result_home_vainqueur;
		}

		if ($playoffs_result_ext_vainqueur != null) {
			$id_equipe_ext = $playoffs_result_ext_vainqueur;
		}

		$id_equipe_home_value = $id_equipe_home == null ? 'NULL' : $id_equipe_home;
		$id_equipe_ext_value = $id_equipe_ext == null ? 'NULL' : $id_equipe_ext;
		$qry = " UPDATE `playoffs` 
		SET 
			id_equipe_home=$id_equipe_home_value,
			id_equipe_ext=$id_equipe_ext_value
		WHERE id=$id
			;";

		$result = mysqli_query($con, $qry);

		echo $qry . '<br>';

		if (!$result) {
			echo 'Error SQL';
		}
	}
?>
</div>