$(document).ready(function(){
	$("#bandeauAcceuil").click(function() {	
		document.location = 'acceuil.php';
	});
	$("#bandeauDeconnect").click(function() {
		document.location = 'deconnect.php';
	});
	// $("#bandeauProfil").click(function() {
	// 	document.location = 'profil.php?id=' + document.getElementById("idPhp").getAttribute("name");
	// });

	$("#bandeauAdmin").click(function() {
		document.location = 'admin.php';
	});

	$("#modifProfilDetails").click(function() {
		document.location = 'modifierProfil.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifMatchDetails").click(function() {
		document.location = 'modifierMatches.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifBonusDetails").click(function() {
		document.location = 'modifierBonus.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});
	$("#modifJokerDetails").click(function() {
		document.location = 'modifierJoker.php?id=' + document.getElementById("idPhp").getAttribute("name");
	});

	var sidenav = document.getElementById("mySidenav");
	var topnav = document.getElementById("myTopnav");
	var bandeauMenuBurgerButton = document.getElementById("bandeauMenuBurgerButton");
	var bandeauCloseBurgerButton = document.getElementById("bandeauCloseBurgerButton");

	
	var bandeauProfilButton = document.getElementById("bandeauProfil");
	// var openBtn = document.getElementById("openBtn");
	// var closeBtn = document.getElementById("closeBtn");

	$("#bandeauProfil").click(function() {	
		topnav.classList.toggle("active");
	});


	$("#bandeauMenuBurger").click(function() {	
		bandeauCloseBurgerButton.classList.toggle('bandeauMenuBurgerHidden');
		bandeauMenuBurgerButton.classList.toggle('bandeauMenuBurgerHidden');
		sidenav.classList.toggle("active");
	});

	$("#closeBtn").click(function() {	
		sidenav.classList.remove("active");
	});


	// openBtn.onclick = openNav;
	// closeBtn.onclick = closeNav;

	// /* Set the width of the side navigation to 250px */
	// function openNav() {
	// 	sidenav.classList.add("active");
	// }

	// /* Set the width of the side navigation to 0 */
	// function closeNav() {
	// 	sidenav.classList.remove("active");
	// }
});