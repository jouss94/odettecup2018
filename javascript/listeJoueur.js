$(document).ready(function(){

	// TODO : HORRIBLE !!!!
	for (id = 0; id < 100; id++)
	{
		element = document.getElementById("detailJoueur" + id);
		if (element != null)
		{
			$("#detailJoueur" + id).click(function(event){
				idLocal = event.target.id;
				idLocal = idLocal.substring(12);					
				document.location = 'profil.php?id=' + idLocal;
				return false;
			});
		}
	}

	$(".RetourSpan").click(function(){
		history.back();
		 	return false;
	});

});