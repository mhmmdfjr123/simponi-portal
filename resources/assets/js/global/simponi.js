(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 73)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Offset for Main Navigation
    var navOffsetTop = 150;
    $('#main-nav').affix({
        offset: {
            top: navOffsetTop
        }
    });
    // $('#header-nav-masking').affix({
    //     offset: {
    //         top: navOffsetTop + 20
    //     }
    // });


    // Initialize and Configure Scroll Reveal Animation
    window.sr = ScrollReveal();
    sr.reveal('.sr-icons', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 200);
    sr.reveal('.sr-button', {
        duration: 1000,
        delay: 200
    });
    sr.reveal('.sr-contact', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 300);

})(jQuery); // End of use strict
