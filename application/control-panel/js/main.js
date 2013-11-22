$(function() {

	$(".cp-sidebar").append('<p class="cp-mobile-menu" />');
	$(".cp-mobile-menu").append('<a href="#" class="button c2a" id="cp-mobile-menu-toggle">Vis/skjul meny</a>');

	$(".cp-sidebar").on("click", "#cp-mobile-menu-toggle", function() {
		$(".cp-sidebar nav").slideToggle(280);
	});

});

function redirect(time, url) {
	setTimeout(function() {
		location.assign(url);
	}, (time * 1000));
}