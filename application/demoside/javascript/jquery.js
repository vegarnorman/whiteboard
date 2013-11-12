//toggle text
$(document).ready(function(){


	//toggle-funksjon for å vise/skjule tekst
	$("#item-button1").click(function(){
		if (item1.style.display=='block') {
			$("#arr1").attr('src','images/rightarrow.png');
		}
		else{
			$("#arr1").attr('src','images/downarrow.png');
		}
		$("#item1").slideToggle("2000");
	});


	$("#item-button2").click(function(){
		if (item2.style.display=='block') {
			$("#arr2").attr('src','images/rightarrow.png');
		}
		else{
			$("#arr2").attr('src','images/downarrow.png');
		}
		$("#item2").slideToggle("2000");
	});

	$("#item-button3").click(function(){
		if (item3.style.display=='block') {
			$("#arr3").attr('src','images/rightarrow.png');
		}
		else{
			$("#arr3").attr('src','images/downarrow.png');
		}
		$("#item3").slideToggle("2000");
	});


	// $(document).onLoad(function(){
	// 	$("#comment-box").attr("display", "none");
	// });
	$(document).ready(function(){
	  $("#comment-box").attr("display", "none");
	  });
	});



	$("#new-comment-button").click(function(){
		$("#comment-box").slideToggle("2000");
	});








});





