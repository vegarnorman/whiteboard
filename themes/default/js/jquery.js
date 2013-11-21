$(document).ready(function(){

	//toggle between show/hide comment-box
	$("#new-comment-button").click(function(){
	$("#comment-box").slideToggle("2000");
	});


	//toggle between original/green color
	$("#new-comment-button").click(function(){
	$(this).toggleClass("change-to-green");
	});

	//toggle between original/red color
	$("#report-comment-button").click(function(){
	$(this).toggleClass("change-to-red");
	});

});

