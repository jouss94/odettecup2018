$(document).ready(function(){

		 $(".Retour").click(function(){
		 	document.location = 'index.php';
		 	return false;
	});
		 $("#buttonValidationSubmit").click(function(){
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
									// $(this).next().stop().style.display = "block";;fisrtColumnProfilModifier

									if ( data[0] != 'yes' ) {
											for (var index =0; index < 5; index++) 
											{
												element = document.getElementById(data[1] + "error" + index);
												if (element != null)
													element.style.display = "none";
											}
										document.getElementById(data[1] + "error" + data[2]).style.display = "inline";
										result = false;
									}
									else
									{
											for (var index =0; index < 5; index++) 
											{
												element = document.getElementById(data[1] + "error" + index);
												if (element != null)
													element.style.display = "none";
											}

									}
								}
							});
							return result;
						}
					}	
				});
						
				$( "#payement" ).selectmenu({
  width: 200
});



			});