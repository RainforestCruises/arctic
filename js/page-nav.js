jQuery(document).ready(function ($) {

    //On Scroll Listener
    window.onscroll = function () { scrollCheck() };
    function scrollCheck() {

        var threshHold = 320
        if ($(window).width() > 1000) {
            threshHold = 700;
        }

        if (window.scrollY < threshHold) {
            $('.nav-secondary').removeClass('active');
        } else { 
            $('.nav-secondary').addClass('active');
        }

        isSelected($(window).scrollTop());
    }

    //On Scroll -- Apply current to nav links
    var sections = $('.nav-secondary__content__links__link');
    function isSelected(scrolledTo) {
        var threshold = 200;
        var i;

        for (i = 0; i < sections.length; i++) {
            var section = $(sections[i]);
            var target = getTargetTop(section);

            if (scrolledTo > target - threshold && scrolledTo < target + threshold) {
                var sectionHref = $(section).attr('href');
                var active = $('a[href="' + sectionHref + '"]');

                $('.nav-secondary__content__links__link').removeClass("active");

                if (active != null) {
                    active.addClass("active");
                }
            }
        };
        if(scrolledTo < 600){
            $('.nav-secondary__content__links__link').removeClass("active");
        }
    }

    //Get top distance
    function getTargetTop(elem) {
        var id = elem.attr("href");
        return $(id).offset().top;
    }

    // On Click - Nav Links, href change position
    $('.nav-secondary__content__title__link, .nav-secondary__content__links__link, .product-hero__content__main__primary__nav__link, #down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {

        if (id != "#top") {
            $('.header').addClass('preventExpand');
        }



        var target = $(id).offset().top;
        var isScrollUp = $('.header').hasClass('scrollUp');


        if ($(window).width() > 1200) {

            if (!isScrollUp) {
                target = target - 140;
            } else {
                target = target - 80;
            }

        } else { // small screen 
            if (!isScrollUp) {
                target = target - 110;
            } else {
                target = target - 60;
            }
        }

        $('html, body').animate({ scrollTop: target }, 500);
        setTimeout(setScrollStatus, 600)
        window.location.hash = id;
       
    }

    function setScrollStatus() {
        $('.header').removeClass('preventExpand');
    }





});

