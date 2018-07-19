jQuery( document ).ready(function( $ ) {

    var rand = Math.floor(Math.random()*30)+1;
    if (rand < 10) rand = '0'+rand;
    
    $('.headerBackground.popup').addClass('bg'+rand).fadeIn(200);

    $( '#hr-team' ).sliderPro({
        width: '100%',
	    height: 550,
        arrows: true,
        fadeArrows: false,
        buttons: false
    });

    $('#hr-team .hr-person').css('visibility','visible');

    $('.news-article').on('click',function(){
        location.href = 'novinky.html';
    });

    $('.faq-header').prepend('<div class="plusIcon"></div>');

    $('.faq-header').on('click',function(e){
        e.preventDefault();
        if ($(this).data('collapsed') == 1) {
            $(this).removeClass('opened');
            $(this).data('collapsed',0);
            $(this).parent().find('.faq-answer').slideToggle(200);
        } else {
            $(this).data('collapsed',1);
            $(this).addClass('opened');

            $(this).parent().find('.faq-answer').slideToggle(200);
        }
        //$('.faq-article').each
    });

    $('.topMenu, .scrollTop, .aScroll').on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        
        var sPosition = 0;
        if ($.attr(this, 'href') != "#top") {
            sPosition = $($.attr(this, 'href')).offset().top-100;
        }

        var diff = sPosition - $('html').scrollTop();
        
        console.log(diff);
        if (diff > 2000) diff = 2000;

        $('html, body').animate({
            scrollTop: sPosition
        }, Math.abs(diff), "easeOutCubic");
    });


    $( window ).resize(function() {
        positionFloating();
    });

    $( window ).scroll(function() {
        checkScrollPosition(this);
    });

    $('.watchDog .button').on('click',function(e){
        e.preventDefault();
        $('.watchDog').hide();
        $('.thankYou').hide().removeClass('hidden').fadeIn(200);
    });

    $('.watchDogLink').on('click',function(e){
        e.preventDefault();
        initWatchDog();
        var sPosition = 0;
        if ($.attr(this, 'href') != "#top") {
            sPosition = $($.attr(this, 'href')).offset().top;
        }

        $('html, body').animate({
            scrollTop: sPosition
        }, 1000,"easeOutCirc");
    });

    $('#news-detail').hide().removeClass('hidden').fadeIn(200);        
    positionFloating();
    checkScrollPosition($(window));
});

function checkScrollPosition(obj){
    var sTop = $(obj).scrollTop();
    positionFloating();

    if (sTop > 700) {
        if (!$("#menu").hasClass('withBackground')) {
            $("#menu").addClass('withBackground');
        }        
    } else {        
        if ($("#menu").hasClass('withBackground')) {
            $("#menu").removeClass("withBackground");
        }
    }

    if (sTop > 800) {        
        if ($(".scrollTop").hasClass('hidden')){
            $(".scrollTop").fadeOut(0).removeClass('hidden');
        }
        $(".scrollTop").fadeIn(400);
    } else {
        $(".scrollTop").fadeOut(400);        
    }
}

function positionFloating(){
    var wWidth = $(window).width();
    var positionRight = wWidth-Math.floor((wWidth - $('.wrapper .content').width())/2)-60;
    $(".floatingButton").css({ 'left': positionRight+'px'});
}