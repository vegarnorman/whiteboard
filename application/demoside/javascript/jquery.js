
//sticky header
        // var menuPosition = $('header').offset().top;
        // $(window).scroll(function(){
        //         if( $(window).scrollTop() > menuPosition ) {
        //                 $('header').css({position: 'fixed', top: '0px'});
        //         } else {
        //                 $('header').css({position: 'static', top: '0px'});
        //         }
        // });

//toggle text
$(document).ready(function(){
	//toggle-funksjon for å vise/skjule tekst
	$("#item-button1").click(function(){
		if (item1.style.display=='block') {
			$("#arr1").attr('src','images/rightarrow4.png');
		}
		else{
			$("#arr1").attr('src','images/downarrow4.png');
		}
		$("#item1").slideToggle("2000");
	});


	$("#item-button2").click(function(){
		if (item2.style.display=='block') {
			$("#arr2").attr('src','images/rightarrow4.png');
		}
		else{
			$("#arr2").attr('src','images/downarrow4.png');
		}
		$("#item2").slideToggle("2000");
	});

	$("#item-button3").click(function(){
		if (item3.style.display=='block') {
			$("#arr3").attr('src','images/rightarrow4.png');
		}
		else{
			$("#arr3").attr('src','images/downarrow4.png');
		}
		$("#item3").slideToggle("2000");
	});








});





