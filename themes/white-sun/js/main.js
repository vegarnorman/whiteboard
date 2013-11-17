$(function() {
	$("#content").before("<div class=\"nav-placeholder\"></div>");
	var stickyTop = $("nav").offset().top;

	$(window).scroll(function() {
		if ($(window).scrollTop() > stickyTop) {
			$(".nav-placeholder").css({"display": "block"});
			$("nav").css({"position": "fixed", "top": 0, "width": "100%", "z-index": 9999});
		}

		else {
			$(".nav-placeholder").css({"display": "none"});
			$("nav").css({"position": "static", "top": 0});
		}
	});

});