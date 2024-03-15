<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	$current_day = $GLOBALS['current_day'];

	if (isset($_GET['day'])) {
		$current_day = $_GET['day'];
	}

	require_once 'config.php';
	require_once 'functions.php';


	$qry = "SELECT playoffs.*, 
	joueurs_home.id_joueur as joueurs_home_id_joueur, 
	joueurs_home.surnom as joueurs_home_surnom,  
	joueurs_home.image as joueurs_home_image,
	classements_home.rang as classements_home_rang, 
	
	joueurs_ext.id_joueur as joueurs_ext_id_joueur, 
	joueurs_ext.surnom as joueurs_ext_surnom,  
	joueurs_ext.image as joueurs_ext_image,
	classements_ext.rang as classements_ext_rang
	
	FROM playoffs 
	LEFT JOIN joueurs joueurs_home on joueurs_home.id_joueur = playoffs.id_equipe_home
	LEFT JOIN joueurs joueurs_ext on joueurs_ext.id_joueur = playoffs.id_equipe_ext
	LEFT JOIN classements classements_home on classements_home.owner_id = joueurs_home.id_joueur
	LEFT JOIN classements classements_ext on classements_ext.owner_id = joueurs_ext.id_joueur
	WHERE playoffs.competition = $competition
	ORDER BY name";
	$result = mysqli_query($con, $qry);
	$find = false;

	$letter = "";

	$i = 0;

	if ($result) {
		while ($row = mysqli_fetch_array($result )) 
		{
			$find=true;

			$id = $row["id"];
			$name = $row["name"];
			$equipe_home = $row["equipe_home"];
			$equipe_ext = $row["equipe_ext"];
			$id_equipe_home = $row["id_equipe_home"];
			$id_equipe_ext = $row["id_equipe_ext"];
			$day = $row["day"];
			$competition = $row["competition"];
			
			$vainqueur = $row["vainqueur"];
			$score_home = $row["score_home"];
			$score_away = $row["score_away"];
			$joueurs_home_id_joueur = $row["joueurs_home_id_joueur"];
			$joueurs_ext_id_joueur = $row["joueurs_ext_id_joueur"];
			$joueurs_home_surnom = $row["joueurs_home_surnom"];
			$joueurs_ext_surnom = $row["joueurs_ext_surnom"];
			$joueurs_home_image = $row["joueurs_home_image"];
			$joueurs_ext_image = $row["joueurs_ext_image"];
			$classements_home_rang = $row["classements_home_rang"];
			$classements_ext_rang = $row["classements_ext_rang"];

			if ($letter != $name[0])
			{
				if ($letter != "") {
					echo '</div>';
				}

				$playoff_title = $playoff_titles[$name[0]];

				echo "<div class='playoff-title'><div>$playoff_title</div><div>Journée $day</div></div>";
				$letter = $name[0];

				echo "<div class='playoff-content'>";
			}

			$backgroud = "";
			if ($i++ % 2 != 0) {
				$backgroud = "playoff-background";
			}

			echo "
				<div class='playoff-item'>				
						<div class='playoff-item-left $backgroud '>	";	

						if ($id_equipe_home == "") {
							if (is_numeric($equipe_home)) {
								// Classement
								echo "<div class='playoff-item-left-title'>Classement</div>";
								echo "<div class='playoff-item-left-sub-title'>". getClassementFromNumeric($equipe_home)."</div>";
							} else {
								// Match
								echo "<div class='playoff-item-left-title-match'>$equipe_home</div>";
							}
						}
						else {
							// joueurs
							echo "<div class='playoff-item-left-joueur'>";
								echo "<div class='playoff-item-joueur-img'>";
								
								echo "<img src='$joueurs_home_image' class='playoff-item-joueur-img-content'/>";
								echo "</div>";
							
								echo "<div class='playoff-item-left-joueur-title'>";
									echo "<div class='playoff-item-left-title'><a class='surnom-match' href='profil.php?id=$joueurs_home_id_joueur'>$joueurs_home_surnom</a></div>";
									echo "<div class='playoff-item-left-sub-title'>". getClassementFromNumeric($classements_home_rang)."</div>";
								echo "</div>";
								
								

								if ($score_home != '') {
									$color = "";
									if ($vainqueur != "") {
										$color = "pancarte-echec";
										if ($joueurs_home_id_joueur == $vainqueur) {
											$color = "pancarte-correct";
										}
									}
									echo "<div class='playoff-item-left-joueur-pancarte'>";
										echo "<span class='pancarte-profil $color '>$score_home</span>";
									echo "</div>";
								}
							echo "</div>";
						}

				$backgroud = "";
				if ($i % 2 != 0) {
					$backgroud = "playoff-background";
				}

			echo "					
					</div>
					<div class='playoff-item-right $backgroud '>	";	

					
					if ($id_equipe_ext == "") {
						if (is_numeric($equipe_ext)) {
							// Classement
							echo "<div class='playoff-item-left-title'>Classement</div>";
							echo "<div class='playoff-item-left-sub-title'>". getClassementFromNumeric($equipe_ext)."</div>";
						} else {
							// Match
							echo "<div class='playoff-item-left-title-match'>$equipe_ext</div>";
						}
					}
					else {
						// joueurs
						
						echo "<div class='playoff-item-right-joueur'>";


						$color = "";
						if ($score_away != '') {
							if ($vainqueur != "") {
								$color = "pancarte-echec";
								if ($joueurs_ext_id_joueur == $vainqueur) {
									$color = "pancarte-correct";
								}
							}

							echo "<div class='playoff-item-left-joueur-pancarte'>";
								echo "<span class='pancarte-profil $color'>$score_away</span>";
							echo "</div>";
						} 

							echo "<div class='playoff-item-left-joueur-title'>";
								echo "<div class='playoff-item-left-title'><a class='surnom-match' href='profil.php?id=$joueurs_ext_id_joueur'>$joueurs_ext_surnom</a></div>";
								echo "<div class='playoff-item-left-sub-title'>". getClassementFromNumeric($classements_ext_rang)."</div>";
							echo "</div>";

							echo "<div class='playoff-item-joueur-img'>";
								echo "<img src='$joueurs_ext_image' class='playoff-item-joueur-img-content' />";
							echo "</div>";

						echo "</div>";

					}

		echo "				
				
				</div>
					<div class='playoff-match'>		
						<a href='playoff.php?id=$id'>$name</a>
					</div>
				</div>";

		}
	}

	if ($find) {
		echo '</div>';
	}
	if ($find == false) {
		echo '					
		<div class="profilPage-content-stats-waiting-titre">
			Les playoffs ne sont pas encore disponible.
		</div>
		<div class="profilPage-content-stats-waiting-phrase">
			Mais reviens plus tard, tu verras c\'est stylé de ouf !	
		</div>';
	}

	?>



</div>
