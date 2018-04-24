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
							var result = true;
							$.ajax({
								async: false, // !important
								url: 'validations.php',
								data: 'name=' + $(this).attr( 'name' ) + '&value=' + v + '&idDiv=' + $(this).attr( 'id' ),
								success: function( yesOrNo ) {
									var data = yesOrNo.split(";");
									// $(this).next().stop().style.display = "block";;
									console.log(data);
									if ( data[0] != 'yes' ) {
											if (data[0] == "confirm")
											{
													confirm = document.getElementById("confirmationProfil").value;
													mdp = document.getElementById("mpdProfil").value;
													console.log(confirm);
															console.log(mdp);
													if (confirm == mdp)
													{
														for (var index =0; index < 5; index++) 
														{
															element = document.getElementById(data[1] + "error" + index);
															if (element != null)
																element.style.display = "none";
														}
													}
													else
													{
															for (var index =0; index < 5; index++) 
															{
																element = document.getElementById(data[1] + "error" + index);
																if (element != null)
																	element.style.display = "none";
															}
																document.getElementById(data[1] + "error" + data[2]).style.display = "inline";
																result = false;

													}		


											} 
											else
											{

													for (var index =0; index < 5; index++) 
													{
														element = document.getElementById(data[1] + "error" + index);
														if (element != null)
															element.style.display = "none";
													}
												document.getElementById(data[1] + "error" + data[2]).style.display = "inline";
												result = false;

											}

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

				

				$( "#equipeWin" ).selectmenu();
			});