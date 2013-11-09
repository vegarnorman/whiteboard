
//sticky header
$(function(){
        var menuPosition = $('header').offset().top;
        $(window).scroll(function(){
                if( $(window).scrollTop() > menuPosition ) {
                        $('header').css({position: 'fixed', top: '0px'});
                } else {
                        $('header').css({position: 'static', top: '0px'});
                }
        });
});
