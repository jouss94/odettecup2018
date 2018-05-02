$(document).ready(function(){

		 $(".RetourSpan").click(function(){
		 	document.location = 'profil.php?id=' + document.getElementById("idPhp").getAttribute("name");
		 	return false;
	});

	$("#RetourProfil").click(function(){
		document.location = 'profil.php?id=' + document.getElementById("idPhp").getAttribute("name");
		return false;
	});

	$("#RetourAcceuil").click(function(){
		document.location = 'acceuil.php';
		return false;
	});

});

$(function() {
				$('form').validVal({
					customValidations: {

						'serverside-validation': function( v ) {
							var result = true;
							$.ajax({
								async: false, // !important
								url: 'validations.php',
								data: 'name=' + $(this).attr( 'name' ) + '&value=' + v + '&idDiv=' + $(this).attr( 'id' ),
								success: function( yesOrNo ) {
									var data = yesOrNo.split(";");
									// $(this).next().stop().style.display = "block";;
									console.log(data);
									if ( data[0].indexOf('yes') < 0 ) {
										result = false;
									}
								}
							});
							return result;
						}
					}	
				});
						
			});