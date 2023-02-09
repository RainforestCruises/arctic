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
        if (scrolledTo < 600) {
            $('.nav-secondary__content__links__link').removeClass("active");
        }
    }

    //Get top distance
    function getTargetTop(elem) {

        var id = elem.attr("href");
        var sectionElement = document.querySelector(id);
        if (sectionElement) {
            return sectionElement.offsetTop;
        }


    }

    // On Click - Nav Links, href change position
    $('.nav-secondary__content__title-area__link, .nav-secondary__mobile-menu__list__item__link, .nav-secondary__content__links__link, .product-hero__content__main__primary__nav__link, .landing-nav__content__links__link, #down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {
        // if (id != "#section-top") {
        //     $('.header').addClass('preventExpand');
        // }

        var target = $(id).offset().top;

        if ($(window).width() > 1200) { //large screen
            target = target - 140;
        } else { // small screen 
            target = target - 25;        
        }

        $('html, body').animate({ scrollTop: target }, 500);
        setTimeout(setScrollStatus, 600)
        window.location.hash = id;

    }

    // function setScrollStatus() {
    //     $('.header').removeClass('preventExpand');
    // }

    //Burger
    //Burger Menu -- click
    $(".nav-secondary__content-mobile").on("click", function () {

        $('.nav-secondary__content-mobile').toggleClass('active');
        $('.nav-secondary__mobile-menu').toggleClass('active');

    });


    //CLICK AWAY
    const navSecondaryMobile = document.querySelector('.nav-secondary__mobile-menu');
    const navSecondaryButton = document.querySelector('.nav-secondary__content-mobile');

    document.addEventListener('click', evt => {

        const isButtonClick = navSecondaryButton.contains(evt.target);
        const isOpen = navSecondaryMobile.classList.contains('active');

        if (!isButtonClick && isOpen) {
            navSecondaryMobile.classList.remove('active');
            navSecondaryButton.classList.remove('active');
        }
    });

    //resize window -- remove collapse menu over 1000
    $(window).resize(function () {
        if ($(window).width() > 600) {
            $('.nav-secondary__content-mobile').removeClass('active');
            $(".nav-secondary__mobile-menu").removeClass('active');
        }
    });

});

