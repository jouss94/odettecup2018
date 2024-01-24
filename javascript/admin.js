$(document).ready(function() {

	// for (id = 0; id < 100; id++)
	// {
	// 	element = document.getElementById("detailMatche" + id);
	// 	if (element != null)
	// 	{
	// 		$("#detailMatche" + id).click(function(event) {
	// 			idLocal = event.target.id;
				
	// 			console.log("event.target.id", event.target.id);			
	// 			idLocal = idLocal.substring(12);
	// 			console.log("idLocal", idLocal);					
	// 			 // document.location = 'matches.php?id=' + idLocal;
	// 			 return false;
	// 		});
	// 	}
	// }

	$(".RetourSpanBonus").click(function() {
		history.back();
		return false;
	});

	$(".RetourSpanBonusAdmin").click(function() {
		document.location = 'admin.php';
		return false;
	});

	$(".MoulinetteSpan").click(function() {
		document.location = 'UpdateAll.php';
		return false;
	});

	$(".BonusSpan").click(function() {
		document.location = 'adminBonus.php';
		return false;
	});
});