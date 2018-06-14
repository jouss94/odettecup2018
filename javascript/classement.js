$(document).ready(function(){
	$(".clickJoueur").click(function(event){
		idLocal = event.target.id;
		idLocal = idLocal.substring(10);					
		document.location = 'profil.php?id=' + idLocal;
		return false;
    });
    

    $(".clickEquipe").click(function(event){
		idLocal = event.target.id;
		idLocal = idLocal.substring(10);					
		document.location = 'equipes.php?id=' + idLocal;
		return false;
	});
});

function openClassement(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
