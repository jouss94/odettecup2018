$(document).ready(function(){
	$("#add_err").css('display', 'none', 'important');
	$("#add_load").css('display', 'none', 'important');
	 $("#login").click(function(){	
		  username=$("#name").val();
		  password=$("#word").val();
		  $.ajax({
		   type: "POST",
		   url: "login.php",
			data: "name="+username+"&pwd="+password,
		   success: function(html){ 
			// $("#add_err").css('display', 'inline', 'important');
			//  $("#add_err").html("<span>" + html + "</span>");
			if(html.indexOf('true') >= 0)    {
				console.log("OK"); 
				//$("#add_err").html("right username or password");
				window.location="acceuil.php";
			}
			else    {
			$("#add_load").css('display', 'none', 'important');
			$("#add_err").css('display', 'block', 'important');
			 $("#add_err").html("<img src='images/alert.png' style='width: 40px;' /><div>Mauvais nom d'utilisateur ou mot de passe.</div>");
			}
		   },
		   beforeSend:function()
		   {
			$("#add_load").css('display', 'block', 'important');
			$("#add_load").html("<img src='images/ajax-loader.gif' /> <br/>chargement...")
		   }
		  });
		return false;
	});

	 $("#demand").click(function(){
		 	document.location = 'demande.php';
		 	return false;
	});

	 
});