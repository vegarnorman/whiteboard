$(function() {
	function rotate() {
	$('.bilder div').last().fadeOut(1000,function() {
		$(this).insertBefore($('.bilder div').first()).show();
		});
	}
	
	setInterval(function() {
		rotate();
		}, 3000);
	});
	