$(document).ready(function(){

	// TODO : HORRIBLE !!!
	for (id = 0; id < 100; id++)
	{
		element = document.getElementById("detailMatche" + id);
		if (element != null)
		{
			$("#detailMatche" + id).click(function(event){

					idLocal = event.target.id;
					idLocal = idLocal.substring(12);					
		 			document.location = 'matches.php?id=' + idLocal;
				 	return false;
			});
		}
	}

	$(".RetourSpan").click(function() {
		 	document.location = 'calendrier.php';
		 	return false;
	});

});
