
jQuery(document).ready(function ($) {


    // On Click - Nav Links, href change position
    $('.toc-link').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {

        var target = $(id).offset().top;

        if ($(window).width() > 1200) {
            target = target - 160;
        } else { // small screen correction
            target = target - 120;
        }

        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;
    }



});

