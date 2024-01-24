$(document).ready(function(){
	$("#deconnect").click(function() {
		document.location = 'deconnect.php';
	});
	$("#detailReglement").click(function() {
		document.location = 'reglement.php';
	});
	$("#detailCalendrier").click(function() {
		document.location = 'calendrier.php';
	});
	$("#detailCalendrier2").click(function() {
		document.location = 'calendrier.php';
	});

	$(".clickClassement").click(function(event) {
		var classement = event.target.id;
		if (classement == null || classement == '' || classement == undefined)
		{
			classement = $(event.target).parent()[0].id;
		}
		document.location = 'classement.php?ranking=' + classement;
	});

	$(".clickJoueur").click(function(event) {
		idLocal = event.target.id;
		idLocal = idLocal.substring(10);					
		document.location = 'profil.php?id=' + idLocal;
		return false;
	});

	$(".clickEquipe").click(function(event) {
		idLocal = event.target.id;
		idLocal = idLocal.substring(10);					
		document.location = 'equipes.php?id=' + idLocal;
		return false;
	});
});


