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

var mappingColor = { tabsGeneral:"#fff900", tabsEquipe:"#fff900", tabsFemme:"#fff900", tabsMontagne:"#fff900" };

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
    
    // document.getElementById(cityName).style.display = "block";
    // evt.currentTarget.className += " active";

    var typeclassement = cityName;
    console.log(cityName);
    var color = document.getElementById('color' + typeclassement).innerText;
    var max = parseInt(document.getElementById('max' + typeclassement).innerText);     
    var step = parseInt(document.getElementById('step' + typeclassement).innerText);     

    reloadGraph(color, typeclassement, max, step);
}
