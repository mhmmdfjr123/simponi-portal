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

    // Scroll Bar
    $('section#featured .row > div > div > div').perfectScrollbar();

    //Phone control
    $('.phone-control input[type="text"]').numeric().keydown(function(e) {
        $(this).val('');
        if (e.keyCode == 8) {
            $(this).prevAll('input[type="text"]').first().focus();
        }
    }).keypress(function(e) {
        if (e.keyCode != 8) {
            $(this).nextAll('input[type="text"]').first().focus();
        }
    });

    // Applynew
    $('.applynew .nationality [type="radio"]').click(function() {
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
    });

    // Simulation Chart
    var ctx = $('canvas#simulation');
    var myChart = new Chart(ctx, {
        type: 'line',
        /*data: {
            labels: ["40", "45", "50", "55", "60"],
            datasets: [{
                label: 'Dana Awal',
                data: [12, 19, 3, 5, 2, 30],
                backgroundColor: 'rgba(49,133,156)',
                borderColor: 'rgba(49,133,156)',
                borderWidth: 1
            },
            {
                label: 'Iuran',
                data: [12, 19, 3, 25, 2, 3],
                backgroundColor: 'rgba(192,80,77)',
                borderColor: 'rgba(192,80,77)',
                borderWidth: 1
            },
            {
                label: 'Pengembangan',
                data: [12, 19, 13, 5, 2, 3],
                backgroundColor: 'rgba(119,147,60)',
                borderColor: 'rgba(119,147,60)',
                borderWidth: 1
            },
            {
                label: 'Saldo Akhir',
                data: [12, 9, 3, 5, 2, 3],
                backgroundColor: 'rgba(119,157,60)',
                borderColor: 'rgba(119,157,60)',
                borderWidth: 1
            }]
        }*/
        data: {
            labels: ["40", "45", "50", "55", "60"],
            datasets: [
                {
                    label: "Dana Awal",
                    backgroundColor: "rgba(49,133,156,.2)",
                    borderColor: "rgba(49,133,156,1)",
                    pointBackgroundColor: "rgba(49,133,156,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(49,133,156,1)",
                    data: [0, 0, 10, 20, 45]
                },
                {
                    label: "Iuran",
                    backgroundColor: "rgba(192,80,77,.2)",
                    borderColor: "rgba(192,80,77,1)",
                    pointBackgroundColor: "rgba(192,80,77,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(192,80,77,1)",
                    data: [4, 5, 6, 7, 10]
                },
                {
                    label: "Pengembangan",
                    backgroundColor: "rgba(119,147,60,.2)",
                    borderColor: "rgba(119,147,60,1)",
                    pointBackgroundColor: "rgba(119,147,60,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(119,147,60,1)",
                    data: [7, 12, 21, 35, 40]
                },
                {
                    label: "Saldo Akhir",
                    backgroundColor: "rgba(179,181,198,.2)",
                    borderColor: "rgba(179,181,198,1)",
                    pointBackgroundColor: "rgba(179,181,198,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(179,181,198,1)",
                    data: [11, 17, 27, 42, 45]
                }
            ]
        }
    });

    // Customer Dashboard
    $('section#customer .row > div:first-child > a').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('section#customer .row > div:last-child > div').attr('data-active', $(this).index());
    });
    $('.reveal').mousedown(function() {
        $(this).siblings('[type="password"]').attr('type', 'text');
    }).mouseup(function() {
        $(this).siblings('[type="text"]').attr('type', 'password');
    });

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

})(jQuery); // End of use strict
