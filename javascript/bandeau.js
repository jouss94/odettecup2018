$(document).ready(function(){
	$("#bandeauAcceuil").click(function(){	
		 	document.location = 'acceuil.php';
	});
	$("#bandeauDeconnect").click(function(){
		 	document.location = 'deconnect.php';
	});
	$("#bandeauProfil").click(function(){
		 	document.location = 'profil.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});

	$("#modifProfilDetails").click(function(){
		 	document.location = 'modifierProfil.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifMatchDetails").click(function(){
		 	document.location = 'modifierMatches.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifBonusDetails").click(function(){
		 	document.location = 'modifierBonus.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
});