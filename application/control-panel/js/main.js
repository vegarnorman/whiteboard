$(function() {

	$(".cp-sidebar").append("<p class=\"cp-mobile-menu-toggle\" />");
	$(".cp-mobile-menu-toggle").append("<a href=\"#\" class=\"button c2a\">Vis/skjul meny</a>");

	$(".body").on("click", ".cp-mobile-menu-toggle a", function() {
		$(".cp-sidebar nav").slideToggle(300);
		return false;
	});

});

function redirect(time, url) {
	setTimeout(function() {
		location.assign(url);
	}, (time * 1000));
}