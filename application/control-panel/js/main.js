$(function() {

	$(".cp-sidebar").append("<p />");
	$(".cp-mobile-menu-toggle").append("<a href=\"#\" id=\"cp-mobile-menu-toggle\" class=\"button c2a\">Vis/skjul meny</a>");

	$(".body").on("click", "#cp-mobile-menu-toggle", function() {
		$(".cp-sidebar nav").slideToggle(300);
		return false;
	});

});

function redirect(time, url) {
	setTimeout(function() {
		location.assign(url);
	}, (time * 1000));
}