$(document).ready(function(){

		 $(".RetourSpan").click(function(){
		 	document.location = 'profil.php?id=' + document.getElementById("idPhp").getAttribute("name");
		 	return false;
	});
});

$(function() {
				$('form').validVal({
					customValidations: {
						'serverside-validation': function( v ) {
							console.log('test');
							var result = true;
							$.ajax({
								async: false, // !important
								url: 'validations.php',
								data: 'name=' + $(this).attr( 'name' ) + '&value=' + v + '&idDiv=' + $(this).attr( 'id' ),
								success: function( yesOrNo ) {
									var data = yesOrNo.split(";");
									// $(this).next().stop().style.display = "block";;
									if ( data[0] != 'yes' ) {
										result = false;
									}
								}
							});
							return result;
						}
					}	
				});

				

				$( "#equipeWin" ).selectmenu();
				    $( "#buttonValidationReset" ).button({
					      icons: {
									primary: 'ui-icon-blank', 
                    				secondary: ' ui-icon-closethick'
                    		}
					    });


			});