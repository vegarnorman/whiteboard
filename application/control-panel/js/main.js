$(function() {

	$(".cp-mobile-menu-toggle a").click(function() {
		$(".cp-sidebar nav").slideToggle(300);
		return false;
	});

	$(".cp-sidebar").append("<p class=\"cp-mobile-menu-toggle\" />");
	$(".cp-mobile-menu-toggle").append("<a href=\"#\" class=\"button c2a\">Vis/skjul meny</a>");

});

function redirect(time, url) {
	setTimeout(function() {
		location.assign(url);
	}, (time * 1000));
}