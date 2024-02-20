$(document).ready(function() {
	$("#modifierMatch").click(function(){	
		document.location = 'modifierMatches.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifierBonus").click(function(){	
		document.location = 'modifierBonus.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#ModifierProfil").click(function(){	
		document.location = 'modifierProfil.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifierJoker").click(function(){	
		document.location = 'modifierJoker.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});

	$(".RetourSpan").click(function(){
		history.back();
		return false;
	});
});