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
