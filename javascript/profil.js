$(document).ready(function(){
	$("#modifierMatch").click(function(){	
		 	document.location = 'modifierMatches.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifierBonus").click(function(){	
		 	document.location = 'modifierBonus.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#ModifierProfil").click(function(){	
		 	document.location = 'modifierProfil.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
});