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





	//toggle-funksjon for å vise/skjule tekst


	// $("#item-button1").click(function(){
	// 	if (item1.style.display=='block') {
	// 		$("#arr1").attr('src','images/rightarrow.png');
	// 	
	// 	else{
	// 		$("#arr1").attr('src','images/downarrow.png');
	// 	}
	// 	$("#item1").slideToggle("2000");
	// });


	// $("#item-button2").click(function(){
	// 	if (item2.style.display=='block') {
	// 		$("#arr2").attr('src','images/rightarrow.png');
	// 	}
	// 	else{
	// 		$("#arr2").attr('src','images/downarrow.png');
	// 	}
	// 	$("#item2").slideToggle("2000");
	// });

	// $("#item-button3").click(function(){
	// 	if (item3.style.display=='block') {
	// 		$("#arr3").attr('src','images/rightarrow.png');
	// 	}
	// 	else{
	// 		$("#arr3").attr('src','images/downarrow.png');
	// 	}
	// 	$("#item3").slideToggle("2000");
	// });






