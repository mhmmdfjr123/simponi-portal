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
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

    // Offset for AboveFold button
    $('.abovefold').affix({
        offset: {
            top: 150
        }
    });

    // Scroll Bar
    $('section#featured .row > div > div > div').perfectScrollbar();

    //Phone control
    /*$('.phone-control input[type="text"]').numeric().keydown(function(e) {
        $(this).val('');
        if (e.keyCode == 8) {
            $(this).prevAll('input[type="text"]').first().focus();
        }
    }).keypress(function(e) {
        if (e.keyCode != 8) {
            $(this).nextAll('input[type="text"]').first().focus();
        }
    });*/

    // Applynew
    /*$('.applynew .nationality [type="radio"]').click(function() {
        var parent = $(this).parent();
        if (parent.index() > 0) {
            parent.siblings('select').removeAttr('disabled');
        } else {
            parent.siblings('select').attr('disabled', true);
        }
    });
    $('.applynew .date-control [type="checkbox"]').click(function() {
        var parent = $(this).closest('.checkbox');
        if ($(this).is(':checked')) {
            parent.nextAll().attr('disabled', true);
        } else {
            parent.nextAll().removeAttr('disabled');
        }
    });*/

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

    /*$('.login').click(function() {
        $('.loginform').addClass('active fade').delay(50).queue(function() {
            $(this).addClass("in").dequeue();
        });
    });

    $('.loginform .fa-close').click(function() {
        $('.loginform').removeClass('active fade in');
    });*/

})(jQuery); // End of use strict

//# sourceMappingURL=simponi.js.map
