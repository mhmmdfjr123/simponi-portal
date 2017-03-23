/**
 * Based on: https://github.com/judesfernando/initial.js
 * it has been customized by efriandika
 *
 * Added new options:
 *      options = {
 *          ...
 *          colors: ['#005c69', '#f05921', '#333333'] // it will generate random color what we want to
 *          ...
 *      }
 */
(function ($) {

    var getInitial = function(fullName, maxCharCount) {
        var pieces = fullName.split(" ");
        var initials = "";

        for(var x = 0; x < pieces.length && x < maxCharCount; x++) {
            initials += pieces [x].substring(0, 1);
        }

        return initials;
    };

    $.fn.initial = function (options) {

        // Defining Colors
        var colors = ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#2ecc71", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6", "#7f8c8d", "#ec87bf", "#d870ad", "#f69785", "#9ba37e", "#b49255", "#b49255", "#a94136"];
        var finalColor;

        return this.each(function () {

            var e = $(this);
            var settings = $.extend({
                // Default settings
                name: 'Name',
                color: null,
                seed: 0,
                charCount: 1,
                textColor: '#ffffff',
                height: 100,
                width: 100,
                fontSize: 60,
                fontWeight: 400,
                fontFamily: 'HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica, Arial,Lucida Grande, sans-serif',
                radius: 0
            }, options);

            // overriding from data attributes
            settings = $.extend(settings, e.data());

            // making the text object
            var c = getInitial(settings.name, settings.charCount).toUpperCase();
            var cobj = $('<text text-anchor="middle"></text>').attr({
                'y': '50%',
                'x': '50%',
                'dy' : '0.35em',
                'pointer-events':'auto',
                'fill': settings.textColor,
                'font-family': settings.fontFamily
            }).html(c).css({
                'font-weight': settings.fontWeight,
                'font-size': settings.fontSize+'px',
            });

            var colorIndex ='';
            if(settings.color != null){
                if( Object.prototype.toString.call( settings.color ) === '[object Array]' ) {
                    colorIndex = Math.floor((c.charCodeAt(0) + settings.seed) % settings.color.length);
                    finalColor = settings.color[colorIndex];
                } else {
                    finalColor = settings.color
                }
            }else{
                colorIndex = Math.floor((c.charCodeAt(0) + settings.seed) % colors.length);
                finalColor = colors[colorIndex]
            }

            var svg = $('<svg></svg>').attr({
                'xmlns': 'http://www.w3.org/2000/svg',
                'pointer-events':'none',
                'width': settings.width,
                'height': settings.height
            }).css({
                'background-color': finalColor,
                'width': settings.width+'px',
                'height': settings.height+'px',
                'border-radius': settings.radius+'px',
                '-moz-border-radius': settings.radius+'px'
            });

            svg.append(cobj);
            // svg.append(group);
            var svgHtml = window.btoa(unescape(encodeURIComponent($('<div>').append(svg.clone()).html())));

            e.attr("src", 'data:image/svg+xml;base64,' + svgHtml);

        })
    };

}(jQuery));

/**
 * Password validator method for jquery validation based on BNI Password Policy
 *
 * @version 1.0.0
 * @author efriandika
 *
 * Copyright (c) 2017
 */
var rules = [
    {
        html: {
            id: 'bni-password-min-8',
            text: 'Minimal 8 Karakter'
        },
        validator: function(value, element) {
            return value.length >= 8;
        }
    },
    {
        html: {
            id: 'bni-password-username',
            text: 'Tidak mengandung username'
        },
        validator: function(value, element) {
            return value != '' && value.indexOf($(element).data('username-id') ?
                    $('#'+$(element).data('username-id')).val() : $(element).data('username')) < 0;
        }
    },
    {
        html: {
            id: 'bni-password-alphanumeric',
            text: 'Mengandung kombinasi huruf dan angka'
        },
        validator: function(value, element) {
            return /\d/.test(value) && /[A-z]/.test(value);
        }
    },
    {
        html: {
            id: 'bni-password-special',
            text: 'Mengandung karakter spesial, kecuali:<br />; - + \' \\ ( ) = > < @'
        },
        validator: function(value, element) {
            return /[^\w]/.test(value) && !/[;.\-+'\\()=><@]/.test(value);
        }
    }
];

// Create validator message indicator
var messageContainer = '<div class="alert alert-warning alert-password-meter">' +
    'Kriteria password:' +
    '<ul class="fa-ul">';

$.each(rules, function(key, rule) {
    messageContainer += '<li class="' + rule.html.id + '">' +
        '<i class="ion-android-checkmark-circle ok"></i>' +
        '<i class="ion-close-circled not-ok"></i>' +
        rule.html.text +
        '</li>';
});

messageContainer += '</ul></div>';

createPasswordValidatorMessage();

// Validator
$.validator.addMethod("bniPasswordValidator", function(value, element) {
    var result = true;
    var listOfFalse = [];

    $.each(rules, function(key, rule) {
        if(rule.validator(value, element)) {
            $('.' + rule.html.id).addClass('has-password-ok');
        } else {
            listOfFalse.push(false);
            $('.' + rule.html.id).removeClass('has-password-ok');
        }
    });

    $.each(listOfFalse, function(key, value) {
        result = result && value;
    });

    return result;
}, 'Password anda belum memenuhi kriteria.');

function createPasswordValidatorMessage(){
    const $bniPasswordElements = $('.bniPasswordValidator');

    $bniPasswordElements.each(function() {
        $(messageContainer).insertAfter(this)
    });
}
(function($) {
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

    // Initial JS
    $('.name-initializer').initial({
        color: ['#005c69', '#f05921', '#333333']
    });
})(jQuery); // End of use strict

(function ($) {
    // jQuery Validation
    $.validator.addMethod("notNumericOnly", function(value, element) {
        return /^\d*[A-z][A-z\d]*$/.test(value);
    }, "Please don't input numeric only");

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
        min: $.validator.format( "Harap masukkan nilai lebih besar atau sama dengan {0}." ),

        // Custom Validator
        notNumericOnly: "Tidak boleh hanya memuat angka"
    } );

    var $formValidate = $(".form-validate");
    var $buttonSubmit = $('.btn-submit');

    $buttonSubmit.button({loadingText: 'Mohon Tunggu...'});
    $formValidate.validate();

    $formValidate.submit(function () {
        if($formValidate.valid())
            $buttonSubmit.button('loading');
    });

    // Ajax Global Configuration
    $.ajaxSetup({
        statusCode: {
            400: function() {
                alertDirectPopUp('Informasi', 'Telah terjadi Bad Request. Harap ulangi beberapa saat lagi.', 'OK', '');
            },
            401: function() {
                alertDirectPopUp('Informasi', 'Maaf, sesi anda telah habis. Silahkan login kembali untuk melanjutkan', 'Login', '');
            },
            404: function() {
                alertDirectPopUp('Informasi', 'Data tidak ditemukan.', 'Tutup', '');
            },
            500: function() {
                alertDirectPopUp('Kesalahan', 'Telah terjadi kesalahan 500. Harap hubungi administrator.', 'OK', '');
            }
        }
    });
}(jQuery));

function load(page,div){
    $.ajax({
        url: page,
        beforeSend: function(){
            $(div).html('<div class="loader">Loading...</div>');
        },
        success: function(response){
            $(div).html(response);
        },
        type:"get",
        dataType:"html"
    });
    return false;
}

function loadIntoBox(page, dt){
    $.ajax({
        url: page,
        data: dt,
        beforeSend: function(){
            popUpLoader();
        },
        success: function(response){
            $.facebox(response);
        },
        type:"get",
        dataType:"html"
    });

    return false;
}

function confirmPopUp(obj, command, title, text, yes, no, param){
    $.facebox.confirm({
        title: title,
        text: text,
        button:{
            yes: {
                text: yes,
                class: 'btn btn-primary btn-sm',
                callback: function(){
                    command.call(obj, param);
                }
            },
            no: {
                text: no,
                class: 'btn btn-default btn-sm',
                callback: function(){
                    $.facebox.close();
                }
            }
        }
    });
}

function confirmDirectPopUp(action, title, text, yes, no){
    $.facebox.confirm({
        title: title,
        text: text,
        button:{
            yes: {
                text: yes,
                class: 'btn btn-primary btn-sm',
                href: action,
                callback: function(){
                    popUpLoader();
                }
            },
            no: {
                text: no,
                class: 'btn btn-default btn-sm',
                callback: function(){
                    $.facebox.close();
                }
            }
        }
    });
}

function freeze(title, text){
    $.facebox.confirm({
        title: title,
        text: text,
        button:{
            close: {
                text: 'Please wait...',
                class: 'btn btn-primary btn-sm disabled',
                callback: function(){
                    // no action
                }
            }
        }
    });
}

function alertPopUp(title, text, actionName){
    $.facebox.confirm({
        title: title,
        text: text,
        button:{
            close: {
                text: actionName,
                class: 'btn btn-primary btn-sm',
                callback: function(){
                    $.facebox.close();
                }
            }
        }
    });
}

function alertDirectPopUp(title, text, actionName, action){
    $.facebox.confirm({
        title: title,
        text: text,
        button:{
            close: {
                text: actionName,
                class: 'btn btn-primary btn-sm',
                href: action,
                callback: function(){
                    popUpLoader();
                }
            }
        }
    });
}

function popUpLoader(){
    $.facebox('<div class="loader">Loading...</div>');
}

function maintenance(){
    alertPopUp('Notice', 'I\'m Sorry :(.. This feature is unavailable at the moment..<br />It\'s under construction<br />Comeback later<br /><br />Thank You', 'Close');
}

function alertError(opt){
    opt = typeof opt !== 'undefined' ? opt : 'Tidak diketahui';

    alertPopUp('Kesalahan..', 'Telah terjadi suatu kesalahan.. Silahkan ulangi beberapa saat lagi..<br />Atau hubungi administrator<br /><br />Kode Kesalahan => '+opt, 'Tutup');
}