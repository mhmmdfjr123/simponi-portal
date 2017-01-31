(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    // $('.navbar-collapse ul li a').click(function() {
    //     $('.navbar-toggle:visible').click();
    // });

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

    // Offset for AboveFold button
    $('.above-fold').affix({
        offset: {
            top: 150
        }
    });

    // Scroll Bar
    $('section#featured .row > div > div > div').perfectScrollbar();


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

    // Initialize and Configure Magnific Popup Lightbox Plugin
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });

    $('input.currency').numeric().keydown(function() {
        $(this).val($(this).val().replace(/\./g, ''));
    }).keyup(function() {
        if ($(this).val().length > 0) {
            $(this).attr('data-value', $(this).val()).val($(this).val().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.'));
        } else {
            $(this).attr('data-value', 0);
        }
    });

    $('input.percentage').numeric().keyup(function() {
        if ($(this).val().length > 0) {
            $(this).attr('data-value', $(this).val());
        } else {
            $(this).attr('data-value', 0);
        }
    });

})(jQuery); // End of use strict
