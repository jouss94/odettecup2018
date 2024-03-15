$(document).ready(function () {

	var date = document.getElementById('datePicker');
	if (date) {
		date.valueAsDate = new Date();
	}

	$(".RetourSpanBonus").click(function () {
		history.back();
		return false;
	});

	$(".RetourSpanBonusAdmin").click(function () {
		document.location = 'admin.php';
		return false;
	});

	$(".MoulinetteSpan").click(function () {
		document.location = 'UpdateAll.php';
		return false;
	});

	$(".PlayoffAdminSpan").click(function () {
		document.location = 'adminPlayoff.php';
		return false;
	});
	
	$(".CalendrierAdminSpan").click(function () {
		document.location = 'adminCalendrier.php';
		return false;
	});

	$(".JoueursAdminSpan").click(function () {
		document.location = 'adminJoueurs.php';
		return false;
	});

	$(".InitializeCalendrierAdminSpan").click(function () {
		const response = confirm("T'es sûr batard ?");

		if (response) {
			const response2 = confirm("T'es VRAIMENT sûr batard ?");
			if (response2) {
				document.location = 'adminCalendrierInitialize.php';
			}
		}

		return false;
	});

	$(".InitializePlayoffAdminSpan").click(function () {
		const response = confirm("Playoff T'es sûr batard ?");

		if (response) {
			const response2 = confirm("Playoff T'es VRAIMENT sûr batard ?");
			if (response2) {
				document.location = 'adminPlayoffInitialize.php';
			}
		}

		return false;
	});


	$(".UpdateCalendrierAdminSpan").click(function () {

		document.location = 'adminCalendrierUpdate.php?date=' + date.value;
		return false;
	});

	$(".UpdatePlayoffAdminSpan").click(function () {
		const response = confirm("Le classement est figé ?");

		if (response) {
			const response2 = confirm("Le tour de playoff est terminé ?");
			if (response2) {
				document.location = 'adminPlayoffUpdate.php';
				return false;
			}
		}
	});

});