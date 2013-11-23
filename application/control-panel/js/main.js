$(function() {

	//	KONSOLLMELDING
	//================

	console.log("W H I T E B O A R D   C M S\n===========================\n\nEt produkt av Gruppe 25, Webprosjekt @ HiOA H2013\nVegar Norman\nPer Erik Finstad\nHalvor Ødegård\nMarius Baltramaitis\n\n===========================");



	//	RESPONSIV SIDEBAR
	//===================

	$(".cp-sidebar").append('<p class="cp-mobile-menu" />');
	$(".cp-mobile-menu").append('<a href="#" class="button c2a" id="cp-mobile-menu-toggle">Vis/skjul meny</a>');

	$(".cp-sidebar").on("click", "#cp-mobile-menu-toggle", function() {
		$(".cp-sidebar nav").slideToggle(280);
	});

});



//	OMDIRIGERINGSSCRIPT
//=====================

function redirect(time, url) {
	setTimeout(function() {
		location.assign(url);
	}, (time * 1000));
}