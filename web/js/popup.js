
$(document).ready(function(){

    $('.dialog--welcome .dialog__action').click(function() {
        $('.modal').addClass('modal--bouncein');
    });
    $('.login').submit(function(e) {
        e.preventDefault();
        if($('.login .dialog__action').hasClass('dialog__action--pending'))
            return;
        $('.login .dialog__action').addClass('dialog__action--pending');
        setTimeout(function() {
            $('.modal').addClass('modal--bounceout');
            setTimeout(function () {
                $('.modal .dialog__action').removeClass('dialog__action--pending');
                $('.modal').removeClass('modal--bouncein modal--bounceout');
            }, 250);
        }, 2500);
    });

    $('.dialog--register .dialog__register').click(function() {
        $('.modals').addClass('modals--bouncein');
    });
    $('.login').submit(function(e) {
        e.preventDefault();
        if($('.register .dialog__register').hasClass('dialog__action--pending'))
            return;
        $('.register .dialog__register').addClass('dialog__action--pending');
        setTimeout(function() {
            $('.modals').addClass('modals--bounceout');
            setTimeout(function () {
                $('.modals .dialog__register').removeClass('dialog__action--pending');
                $('.modals').removeClass('modals--bouncein modal--bounceout');
            }, 250);
        }, 2500);
    });

});