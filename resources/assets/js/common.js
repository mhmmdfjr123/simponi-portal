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

    // IWannaKillYou();
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

function IWannaKillYou(){
    console.log('%c What are you doing??!!', 'background: #222; color: #63DE00; font-size: 60px; font-family: courier, sans-serif');
    console.log('%c Close this console!! It is not your business.', 'background: #222; color: #63DE00; font-size: 40px; font-family: courier, sans-serif');
    console.log('%c == EP ==', 'background: #222; color: #63DE00; font-size: 60px; font-family: courier, sans-serif');
}