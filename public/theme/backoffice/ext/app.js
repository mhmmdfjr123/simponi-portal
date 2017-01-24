define("app-default", ['jquery'], function ($) {
    // Ajax Global Config
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

    return $;z
});

require(['jquery', 'px/pixeladmin', 'px/plugins/px-nav', 'px/plugins/px-navbar', 'px/extensions/perfect-scrollbar.jquery',
        'px/plugins/px-validate', 'px-libs/initial', 'px-libs/jquery.facebox', 'px-libs/jquery.form', 'px-bootstrap/button'],
    function($) {
    /**
     * Theme Config
     */
    $('#navbar-notifications').perfectScrollbar();
    $('#navbar-messages').perfectScrollbar();

    // Activate current nav item
    var url = String(document.location + '').replace(/\#.*?$/, '');
    $('.px-nav')
        .find('.px-nav-item > a[href="' + url + '"]')
        .parent()
        .addClass('active');
    $('#px-nav-main').pxNav();


        // Set Initial.js
    $('.img-profile-name').initial({charCount:2, fontSize: 52});

    /**
     * Default Config
     */
    // Default validate tag
    var $validateElement = $('.validate');
    $validateElement.pxValidate();
    $validateElement.submit(function(e){
        if($(this).valid()){
            $(".btn-save").button('loading');
        }
    });

    // Global Config hyperlink to popup (loadIntoBox)
    $('.btn-load-popup').facebox();

    makeBreadCrumb();
});

/*
 * Update BreadCrumbs Automatically
 * Author: Efriandika Pratama
 */
function makeBreadCrumb() {
    // Active menu state checking
    var activeMenu = $('ol.page-breadcrumb li.active').data('active-menu');

    if(typeof activeMenu != 'undefined')
        setMenuState(activeMenu)

    // Creating breadcrumbs
    var navElements = $('ul#main-navigation li.active > a'),
        breadElement = $('ol.page-breadcrumb'),
        breadElementChild = $('ol.page-breadcrumb li');

    var mergeElement = $.merge(navElements, breadElementChild),
        count = mergeElement.length;

    breadElement.empty();
    breadElement.append($("<li>Dashboard</li>"));

    mergeElement.each(function() {
        var $href = $(this).attr('href');

        if($href == undefined)
            $href = $(this).find('a').attr('href');

        if (!--count)
            breadElement.append($("<li class='active'></li>").html($.trim("<a href='javascript:void(0)'>" + $(this).clone().children(".badge").remove().end().text()) + "</a>"));
        else
            breadElement.append($("<li></li>").html("<a href='" + $href + "'>" + $.trim($(this).clone().children(".badge").remove().end().text()) + "</a>"));

        // update title when creating a breadcrumb is finished...
        //if (!--count) document.title = breadElement.find("li:last-child").text();
    });

}

function setMenuState(idName){
    $(idName).addClass('active')
        .parent().parent().addClass('px-open active');
}

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