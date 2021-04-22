<?php

	$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	require_once 'config.php';
	require_once 'functions.php';


	parse_str($_SERVER["QUERY_STRING"], $query);
	$idProfil = $query['id'];

		echo '<div class="profilInformation floaleft width100">';


	$qry = "SELECT * FROM joueurs WHERE id_joueur='".$idProfil."';";
	$result = mysqli_query($con, $qry);
	$find = false;
	while ($row = mysqli_fetch_array($result )) 
	{	
		$find = true;
		$surnom = utf8_encode_function($row["surnom"]);
		$prenom = utf8_encode_function($row["prenom"]);
		$nom = utf8_encode_function($row["nom"]);
		$email = utf8_encode_function($row["email"]);
		$image = utf8_encode_function($row["image"]);
		$departement = intval($row["departement"]);
		$telephone = utf8_encode_function($row["telephone"]);
		$password = utf8_encode_function($row["password"]);
		$description = utf8_encode_function($row["description"]);
		$color = $row["color"] != null ? $row["color"] : "#7bbfc9";


		echo '

		<div class="profilPronosFulll floaleft">
		<span class="profilPronosTitre">Modifier Profil</span>
		
			<span class="RetourSpan">
				<button class="RetourSpan mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="RetourButtonRouge">
				Retour
				</button>
			</span>

		<form action="addProfil.php" method="post" enctype="multipart/form-data">';

		echo '<table class="tableauPronosForm">';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Surnom';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
				echo $surnom;
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Prenom';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="prenomProfil" class="serverside-validation" name="prenomProfil" type="text" value="'; if ($prenom !== null) echo $prenom; echo '"  size="8" />';
				
				echo '<span class="error" id="prenomProfilerror1">Requis</span>';

				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Nom';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="nomProfil" class="serverside-validation" name="nomProfil" type="text" value="'; if ($nom !== null) echo $nom; echo '"  size="8" />';
				
				echo '<span class="error" id="nomProfilerror1">Requis</span>';

				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Mot de passe';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="mpdProfil" class="serverside-validation" name="mpdProfil" type="password" value="'; if ($password !== null) echo $password; echo '"  size="8" />';
				echo '<span class="error" id="mpdProfilerror1">Requis</span>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Confirmation';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="confirmationProfil" class="serverside-validation" name="confirmationProfil" type="password" value="'; if ($password !== null) echo $password; echo '"  size="8" />';
				echo '<span class="error" id="confirmationProfilerror1">Mot de passe différent</span>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Email';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="emailProfil" class="serverside-validation" name="emailProfil" type="text" value="'; if ($email !== null) echo $email; echo '"  size="8" />';
				echo '	<span class="error" id="emailProfilerror1">Requis</span>';
				echo '	<span class="error size13" id="emailProfilerror2">E-mail non conforme</span>';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Téléphone';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="telProfil" class="serverside-validation" name="telProfil" type="text" value="'; if ($telephone !== null) echo $telephone; echo '"  size="8" />';
				echo '	<span class="error" id="telProfilerror1">Requis</span> ';
				echo '	<span class="error size13" id="telProfilerror2">Entrez un numéro</span> '; 
				echo '	<span class="error size13" id="telProfilerror3">Numéro non comforme</span> ';

				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Département';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input id="departementProfil" class="serverside-validation" name="departementProfil" type="text" value="'; if ($departement !== null) echo $departement; echo '"  size="8" />';
				echo '	<span class="error" id="departementProfilerror1">Requis</span> ';
				echo '	<span class="error size13" id="departementProfilerror2">Entrez un numéro</span> '; 
				echo '	<span class="error size13" id="departementProfilerror3">Numéro non comforme</span> ';
				echo '</td>';
			echo '</tr>';

			echo '<tr>
					<td class="fisrtColumnProfilModifierTop">
						Description
					</td>
					<td>
						<textarea name="description" id="descriptionProfil" style="resize:none" name="name" 
							  cols="30" rows="6" class="serverside-validation">',$description,'</textarea>
					</td>
				</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Image';
				echo '</td>';
				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input type="file" name="imageProfil" id="imageProfil" />';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Couleur de votre profil';
				echo '</td>';
				echo '<td class="secondColumnProfilModifier"> ';
					echo '<input type="color" name="colorProfil" id="colorProfil" style="width: 50px;height: 50px;" value="',$color,'" />';
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="fisrtColumnProfilModifier"> Avatar actuel';
				echo '</td>';

				echo '<td class="secondColumnProfilModifier"> ';
					echo '<img src="'.$image.'"alt="pas d avatar" class="profilInformationImage"/>';
				echo '</td>';
			echo '</tr>';


		echo '</table>';
			echo '<div class="buttons">
			<button id="buttonValidationSubmit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Valider
			</button>
		</div>';

		echo '		</form></div></div>';
	
	}
	if ($find)
	{
		
	}
	else
	{
		echo 'Ce profil n\'exite pas';
	}

?>