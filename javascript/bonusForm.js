$(document).ready(function() {
	$(".RetourSpan").click(function() {
		history.back();
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
						
						if ( data[0].indexOf('yes') < 0 ) {
							result = false;
						}
					}
				});
				return result;
			}
		}	
	});
	
	$( "#buttonValidationReset" ).button({
		icons: {
			primary: 'ui-icon-blank', 
			secondary: ' ui-icon-closethick'
		}
	});
});