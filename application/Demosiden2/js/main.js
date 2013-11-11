$(function() {
	function rotate() {
	$('bilder class').last()fadeOut(1000,function() {
		$(this).insertBefore($('bilder class').first()).show();
		});
	}
	
	setInterval(function() {
		rotate();
		}, 3000);
	});
	