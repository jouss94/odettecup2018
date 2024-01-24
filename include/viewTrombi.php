<?php

	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$competition=(isset($_SESSION['competition']))?$_SESSION['competition']:'';

	require_once 'config.php';
	require_once 'functions.php';

	$qry = "SELECT * FROM joueurs LEFT JOIN classements ON classements.owner_id = joueurs.id_joueur AND type = 'general'
	WHERE joueurs.competition = $competition ;";
	$result = mysqli_query($con, $qry);
	$find = false;
?>


<div class="trombi">

<?php

	while ($row = mysqli_fetch_array($result )) 
	{

		$image = utf8_encode_function($row["image"]);
		$nom = utf8_encode_function($row["nom"]);		
		$prenom = utf8_encode_function($row["prenom"]);
		$surnom = utf8_encode_function($row["surnom"]);
		$description = utf8_encode_function($row["description"]);
		$points = utf8_encode_function($row["points"]);
		$rang = utf8_encode_function($row["rang"]);
		$id_joueur = $row["id_joueur"];


		echo '
		<div class="tombi-carte">
			<div class="tombi-carte-surnom">
				', strtoupper($surnom), '
			</div>
			<div class="tombi-carte-content">
				<div class="tombi-carte-content-photo">
					<img class="tombi-carte-content-photo-img" src="', $image, '" />
				</div>				
				<div class="tombi-carte-content-info">
					<div class="tombi-carte-content-info-citation">
					', $description, '
					</div>				
				</div>				
			</div>	
			<div class="">
				<div class="tombi-carte-content-code">
				', strtoupper(substr($prenom, 0, 3)), strtoupper(substr($nom, 0, 3)),'00', $id_joueur, ' ', strtoupper(substr($surnom, 0, 4)),'				
				</div>
				<div class="tombi-carte-content-info-showmore">
					<a class="showmore" href="profil.php?id=', $id_joueur ,'">Détails</a>
				</div>			
			</div>	
		</div>
		';


	}

?>

</div>
