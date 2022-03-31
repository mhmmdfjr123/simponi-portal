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