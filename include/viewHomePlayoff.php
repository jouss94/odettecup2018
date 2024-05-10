<?php
	
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';
	
	require_once 'config.php';
	require_once 'functions.php';

	$playoff_days = getPlayoffDays($con, $competition);

	// WORK ALSO FOR NEXT MATCH (same page)
	$current_day = $GLOBALS['current_day'];
	$current_day_in_progress = $GLOBALS['current_day_in_progress'];

	if (in_array($current_day,  $playoff_days)) {
?>

	
<div class="tableAcceuilBas">
	<div class="statistics-card-event mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title mdl-card--expand">
		<div class="playoff-home">

		<?php
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
			WHERE playoffs.competition = $competition AND playoffs.day = $current_day 
			AND (joueurs_home.id_joueur = $id || joueurs_ext.id_joueur = $id)
			ORDER BY name";

			$result = mysqli_query($con, $qry);
			$find = false;

			$i = 0;

			$day = 0;
			$id_equipe_home = 0;
			$id_equipe_ext = 0;

			if ($result) {
				while ($row = mysqli_fetch_array($result )) {
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
		
					$playoff_title = $playoff_titles[$name[0]];

					echo "<div class='playoff-title playoff-title-home'><div>$playoff_title</div><div>Journée $day</div></div>";

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

			
			echo "</div>
			<div class='playoff-home playoff-home-second'>";

			if ($id_equipe_home == "") {
				$id_equipe_home = 0;
			}			
				echo "<div class='playoff-item playoff-item-pronos'>";
	
					echo "<div class='playoff-item-left playoff-item-left-pronos'>";

						$qry = "SELECT matches.*,
						matches.id_match as id, 
						equipes_home.display_name  as home_name,
						equipes_home.logo  as home_logo,
						equipes_away.display_name  as away_name,
						equipes_away.logo  as away_logo,
						pronos.*
						FROM matches 
						LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
						LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
						LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id_equipe_home
						WHERE day=$day and competition=$competition AND $id_equipe_home != 0 AND reporte=0 ORDER BY date, id;";

						$result = mysqli_query($con, $qry);
						$find = false;
						$i = 0;
						$current_date = "";
						$total_home = 0;
						$current_already_start = false;
						$first = true;	
						date_default_timezone_set('Europe/Paris');
						$now = new \DateTime(date("Y-m-d H:i:s"), new DateTimeZone("Europe/Paris"));

						while ($row = mysqli_fetch_array($result )) 
						{
							$find = true;
							$group = $row["groupe"];
							$home_logo = utf8_encode_function($row["home_logo"]);
							$home_name = utf8_encode_function($row["home_name"]);
							$away_logo = utf8_encode_function($row["away_logo"]);
							$away_name = utf8_encode_function($row["away_name"]);
							$id_match = $row["id"];
							$pronos_home = $row["prono_home"];
							$pronos_away = $row["prono_away"];
							$played = $row["played"];
							$date = utf8_encode_function($row["date"]);


							if ($first) {
								$dateTime = new \DateTime($date, new DateTimeZone("Europe/Paris"));
								if ($now >= $dateTime) {
									$current_already_start = true;
								}
								$first = false;
							}

							$point = 0;
							if ($row["point"] != "") {
								$point = $row["point"];
							}

							$total_home += $point;

							$classPancarte = "";
							$classTR = "classTRNeutre";
							if ($played == 1) {

								if ($point == 0) {
									$classTR = "classTREchecHome";
									$classPancarte = "pancarte-echec";
								}
								if ($point == 3 || $point == 6) {
									$classTR = "classTRCorrectHome";
									$classPancarte = "pancarte-correct";
								}
								if ($point == 4 || $point == 8) {
									$classTR = "classTRCorrectPlusHome";
									$classPancarte = "pancarte-correct-plus";
								}
								if ($point == 7 || $point == 14) {
									$classTR = "classTRPerfectHome";
									$classPancarte = "pancarte-perfect";
									
								}
							}

							$date = utf8_encode_function($row["date"]);		
							$dateDay = substr($date, 0, 10);
							
							$date_array = date_parse($row["date"]);

							$minute = $date_array['minute'];
							if (intval($minute) < 9) {
								$minute = '0' . $minute;
							}

							if ($current_date != $dateDay) {

								echo  '
								<div class="dateMatchText"> '
									.$days[date('w', strtotime($date))] 
									.' '
									.$date_array['day']
									.' '
									.$months[$date_array['month']]
								.' </div>
								';
								$first = true;
								$i = 0;
							}

							$background = "";
							if ($i++ % 2 != 0) {
								$background = "backgroundTab1";
							}
							else {
								$background = "backgroundTab2";
							}

							echo '<div class="accueil-match-line '.$background.'">';

							$current_date = $dateDay;

							
						$minusClass = "margin-auto";
						echo '<div><img class="logoEquipeSmall" src="';
						echo $home_logo;	
						echo '" /></div>';
						echo '<div class="accueil-match-score-content">';
							echo '<div class="accueil-match-score-last-day accueil-match-score-last-day-pronos">';
								echo '<div class="homeEquipeDroite homeEquipeDroite-pronos">';
									echo '<span class=" ">';
											echo $home_name;	
									echo '</span>';
								echo '</div>';
								echo '<div class="homeEquipeEquipe">';
								if ($row["prono_home"] != "" && $current_already_start) {
									echo '<span class="  pancarteBig '.$classPancarte.'">';
									echo $row["prono_home"];
									echo '</span>';
								}
								echo '</div>';
								echo '<div class="homeEquipeMilieu"><div class=" "> - </div></div>';
								echo '<div class="homeEquipeEquipe">';
								if ($row["prono_away"] != "" && $current_already_start) {
									echo '<span class="  pancarteBig '.$classPancarte.'">';
									echo $row["prono_away"];
									echo '</span>';
								}
								echo '</div>';
								echo '<div class="homeEquipeGauche homeEquipeGauche-pronos">';
								echo '<span class=" ">';
								echo $away_name;	
								echo '</span>';
								echo '</div>';
							echo '</div>';

							if ($row["played"] == 1)
							{
								echo '<div class="accueil-score ">
									Résultat : ';
									echo $row['score_home'];
									echo ' - 	';
									echo $row['score_away'];
									echo '</div>';
							}

						echo '</div>';
						echo '<div><img class="logoEquipeSmall" src="';
						echo $away_logo;	
						echo '" /></div>';

						if ($played == 1) {
							echo '<div class="homePoint '. $classTR .'">';
							if ($point > 0) {
								echo  '+';
							}
							echo $point;
							echo '</div>';
						}
						else {
							echo '<div class="homeSmallDateLast">';
							echo  display2DigitNumer($date_array['hour']). ":" . display2DigitNumer($date_array['minute']);	
							echo '</div>';
						}
						echo '	</div>';		
						}

						if ($current_already_start)
						{

							echo  '
							<div class="total">
							<div class="playoff-total">TOTAL</div>
							
							<div class="playoff-total-pancarte">
							<span class="  pancarte-total classTRNeutre">';
							echo $total_home;
							echo '</span>
							</div>
							</div>
							';
						}

					echo "</div>";
					echo "<div class='playoff-item-right playoff-background playoff-item-left-pronos'>";
					if ($id_equipe_ext == "") {
						$id_equipe_ext = 0;
					}
		
				$qry = "SELECT matches.*,
					matches.id_match as id, 
					equipes_home.display_name  as home_name,
					equipes_home.logo  as home_logo,
					equipes_away.display_name  as away_name,
					equipes_away.logo  as away_logo,
					pronos.*
					FROM matches 
					LEFT JOIN equipes equipes_home ON equipes_home.id_equipe = matches.id_team_home 
					LEFT JOIN equipes equipes_away ON equipes_away.id_equipe = matches.id_team_away 
					LEFT JOIN pronostics pronos ON pronos.id_match = matches.id_match AND pronos.id_joueur = $id_equipe_ext
					WHERE day=$day and competition=$competition AND $id_equipe_ext != 0 AND reporte=0 ORDER BY date, id;";
		
				$result = mysqli_query($con, $qry);
				$find = false;
				$i = 0;
				$current_date = "";
				$total_home = 0;
				$current_already_start = false;
				$first = true;	
				date_default_timezone_set('Europe/Paris');
				$now = new \DateTime(date("Y-m-d H:i:s"), new DateTimeZone("Europe/Paris"));
		
				while ($row = mysqli_fetch_array($result )) 
				{
					$find = true;
					$group = $row["groupe"];
					$home_logo = utf8_encode_function($row["home_logo"]);
					$home_name = utf8_encode_function($row["home_name"]);
					$away_logo = utf8_encode_function($row["away_logo"]);
					$away_name = utf8_encode_function($row["away_name"]);
					$id_match = $row["id"];
					$pronos_home = $row["prono_home"];
					$pronos_away = $row["prono_away"];
					$played = $row["played"];
					$date = utf8_encode_function($row["date"]);
		
		
					if ($first) {
						$dateTime = new \DateTime($date, new DateTimeZone("Europe/Paris"));
						if ($now >= $dateTime) {
							$current_already_start = true;
						}
						$first = false;
					}
		
					$point = 0;
					if ($row["point"] != "") {
						$point = $row["point"];
					}
		
					$total_home += $point;
		
					$classPancarte = "";
					$classTR = "classTRNeutre";
					if ($played == 1) {
		
						if ($point == 0) {
							$classTR = "classTREchecHome";
							$classPancarte = "pancarte-echec";
						}
						if ($point == 3 || $point == 6) {
							$classTR = "classTRCorrectHome";
							$classPancarte = "pancarte-correct";
						}
						if ($point == 4 || $point == 8) {
							$classTR = "classTRCorrectPlusHome";
							$classPancarte = "pancarte-correct-plus";
						}
						if ($point == 7 || $point == 14) {
							$classTR = "classTRPerfectHome";
							$classPancarte = "pancarte-perfect";
							
						}
					}
		
					$date = utf8_encode_function($row["date"]);		
					$dateDay = substr($date, 0, 10);
					
					$date_array = date_parse($row["date"]);
		
					$minute = $date_array['minute'];
					if (intval($minute) < 9) {
						$minute = '0' . $minute;
					}
		
					if ($current_date != $dateDay) {
			
						echo  '
						<div class="dateMatchTextRight"> '
							.$days[date('w', strtotime($date))] 
							.' '
							.$date_array['day']
							.' '
							.$months[$date_array['month']]
						.' </div>
						';
						$first = true;
						$i = 0;
					}
		
					$background = "";
					if ($i++ % 2 != 0) {
						$background = "backgroundTab1";
					}
					else {
						$background = "backgroundTab2";
					}
		
					echo '<div class="accueil-match-line '.$background.'">';
			
					$current_date = $dateDay;
					if ($played == 1) {
						echo '<div class="homePoint '. $classTR .'">';
						if ($point > 0) {
							echo  '+';
						}
						echo $point;
						echo '</div>';
					}
					else {
						echo '<div class="homeSmallDateLast">';
						echo  display2DigitNumer($date_array['hour']). ":" . display2DigitNumer($date_array['minute']);	
						echo '</div>';
					}
					
				$minusClass = "margin-auto";
				echo '<div><img class="logoEquipeSmall" src="';
				echo $home_logo;	
				echo '" /></div>';
				echo '<div class="accueil-match-score-content">';
					echo '<div class="accueil-match-score-last-day accueil-match-score-last-day-pronos">';
						echo '<div class="homeEquipeDroite homeEquipeDroite-pronos">';
							echo '<span class=" ">';
									echo $home_name;	
							echo '</span>';
						echo '</div>';
						echo '<div class="homeEquipeEquipe">';
						if ($row["prono_home"] != "" && $current_already_start) {
							echo '<span class="  pancarteBig '.$classPancarte.'">';
							echo $row["prono_home"];
							echo '</span>';
						}
						echo '</div>';
						echo '<div class="homeEquipeMilieu"><div class=" "> - </div></div>';
						echo '<div class="homeEquipeEquipe">';
						if ($row["prono_away"] != "" && $current_already_start) {
							echo '<span class="  pancarteBig '.$classPancarte.'">';
							echo $row["prono_away"];
							echo '</span>';
						}
						echo '</div>';
						echo '<div class="homeEquipeGauche homeEquipeGauche-pronos">';
						echo '<span class=" ">';
						echo $away_name;	
						echo '</span>';
						echo '</div>';
					echo '</div>';
		
					if ($row["played"] == 1)
					{
						echo '<div class="accueil-score ">
							Résultat : ';
							echo $row['score_home'];
							echo ' - 	';
							echo $row['score_away'];
							echo '</div>';
					}
				
				echo '</div>';
				echo '<div><img class="logoEquipeSmall" src="';
				echo $away_logo;	
				echo '" /></div>';
		
		
				echo '	</div>';		
				}
		
				if ($current_already_start)
				 {
		
					 echo  '
					 <div class="total total-right">
					 
					 <div class="playoff-total-pancarte">
					 <span class="  pancarte-total classTRNeutre">';
					 echo $total_home;
					 echo '</span>
					 </div>
					 <div class="playoff-total playoff-total-right">TOTAL</div>
					 </div>
					 ';
				}
		
					echo "</div>";
				echo "</div>";
			echo "</div>";

			if ($find == false) {
				echo '					
				<div class="playoff-no-content">
				<div class="playoff-no-content-titre">
					Pas de playoff pour toi cette semaine.
				</div>
				</div>';
			}
		?>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="playoffs.php?>" >
			
			Playoffs												
			</a>
		</div>
	</div>
</div>

<?php 		
	}
?>
