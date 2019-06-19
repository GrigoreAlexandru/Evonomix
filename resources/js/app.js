/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */


require('./bootstrap');
require('tempusdominus-bootstrap-4');
require('bootstrap');

$(document).ready(function () {
    //initializare librarie tempusdominus
    $('#datetimepicker1').datetimepicker(); 
    
    // photoswipe
    var container = [];
    $('#gallery').find('.content').each(function () {
        var $link = $(this).find('#photoswipe-img'),
            item = {
                src: $link.attr('href'),
                w: $link.data('width'),
                h: $link.data('height'),
                title: $link.data('caption')
            };
        container.push(item);
    });
    $('#view-btn, .click-event').click(function (event) {
        event.preventDefault();
        var $pswp = $('.pswp')[0],
            options = {
                index: $(this).parents('.content').index(),
                bgOpacity: 0.85,
                showHideOpacity: true
            };
        var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
        gallery.init();
    });
    $(".content-gallery .image-bg").hover(function () {
        $(this).find("a").show();
    }, function () {
        $(this).find("a").hide();
    });
});


