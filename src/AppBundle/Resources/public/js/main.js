$(document).ready(function () {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    $('li.page-scroll').hover(
        function () {
            $('li.active').animate({'borderColor' : '#FFF'},200);
            $(this).animate({'border-color' : '#478323'});
        },
        function () {}
        )
});
