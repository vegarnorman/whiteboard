
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
		$("#x").attr('src','images/downarrow.png');
		$("#item1").slideToggle("2000");
	});

	$("#item-button2").click(function(){
		$("#x").attr('src','images/downarrow.png');
		$("#item2").slideToggle("2000");
	});

	$("#item-button3").click(function(){
		$("#x").attr('src','images/downarrow.png');
		$("#item3").slideToggle("2000");
	});

	$("#new-comment-button").click(function(){
		$("#comment-box").slideToggle("2000");
	});





});





