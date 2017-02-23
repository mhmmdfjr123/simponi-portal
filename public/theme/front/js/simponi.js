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

    // Offset for Main Navigation
    var navOffsetTop = 150;
    $('#main-nav').affix({
        offset: {
            top: navOffsetTop
        }
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

    // jQuery Validation
    $.validator.setDefaults({
        errorPlacement: function(error, element) {
            // if the input has a prepend or append element, put the validation msg after the parent div
            if(element.parent().hasClass('input-prepend') || element.parent().hasClass('input-append')) {
                error.insertAfter(element.parent());
                // else just place the validation message immediatly after the input
            } else {
                error.insertAfter(element);
            }
        },
        errorElement: "span",
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    $.extend( $.validator.messages, {
        required: "Kolom ini diperlukan.",
        remote: "Harap perbaiki kolom ini.",
        email: "Silakan masukkan format email yang benar.",
        url: "Silakan masukkan format URL yang benar.",
        date: "Silakan masukkan format tanggal yang benar.",
        dateISO: "Silakan masukkan format tanggal(ISO) yang benar.",
        number: "Silakan masukkan angka yang benar.",
        digits: "Harap masukan angka saja.",
        creditcard: "Harap masukkan format kartu kredit yang benar.",
        equalTo: "Harap masukkan nilai yg sama dengan sebelumnya.",
        maxlength: $.validator.format( "Input dibatasi hanya {0} karakter." ),
        minlength: $.validator.format( "Input tidak kurang dari {0} karakter." ),
        rangelength: $.validator.format( "Panjang karakter yg diizinkan antara {0} dan {1} karakter." ),
        range: $.validator.format( "Harap masukkan nilai antara {0} dan {1}." ),
        max: $.validator.format( "Harap masukkan nilai lebih kecil atau sama dengan {0}." ),
        min: $.validator.format( "Harap masukkan nilai lebih besar atau sama dengan {0}." )
    } );

    var $formValidate = $(".form-validate");
    var $buttonSubmit = $('.btn-submit');

    $buttonSubmit.button({loadingText: 'Mohon Tunggu...'});
    $formValidate.validate();

    $formValidate.submit(function () {
        if($formValidate.valid())
            $buttonSubmit.button('loading');
    });
})(jQuery); // End of use strict
