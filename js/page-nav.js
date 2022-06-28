jQuery(document).ready(function ($) {


    //scroll to position if there is an anchor tag (must wait for page content to load)
    window.addEventListener('load', function () {     
        var identifier = window.location.hash;
        if ($(identifier).length) {
            changePosition(identifier);
        }
    })

    //On Scroll Listener
    window.onscroll = function () { scrollCheck() };
    function scrollCheck() {

        var threshHold = 320
        if ($(window).width() > 1000) {
            threshHold = 700;
        }

        if (window.scrollY < threshHold) {
            $('.nav-secondary').removeClass('active');
            $('.nav-secondary-mobile').removeClass('active');
            $("#nav-secondary-button").removeClass('active');
        } else { //if template nav is out of view
            //and if burger menu isnt active
            if ($(".burger-menu").hasClass('burger-menu--active') != true) {
                $('.nav-secondary').addClass('active');

            }
        }

        isSelected($(window).scrollTop());
    }

    //On Scroll -- Apply current to nav links
    var sections = $('.nav-secondary__main__links li a');
    function isSelected(scrolledTo) {
        var threshold = 200;
        var i;

        for (i = 0; i < sections.length; i++) {
            var section = $(sections[i]);
            var target = getTargetTop(section);

            if (scrolledTo > target - threshold && scrolledTo < target + threshold) {
                var sectionHref = $(section).attr('href');
                var active = $('a[href="' + sectionHref + '"]');

                $('.nav-secondary__main__links li a').removeClass("current");
                $('.nav-secondary-mobile__list li a').removeClass("current");

                if (active != null) {
                    active.addClass("current");
                }
            }
        };
    }

    //Get top distance
    function getTargetTop(elem) {
        var id = elem.attr("href");
        return $(id).offset().top;
    }

    // On Click - Nav Links, href change position
    $('.page-nav-template, .nav-secondary__main__links li a,  .nav-secondary-mobile__list li a, #nav-secondary-title,  #down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();


    })

    // Animate Change Position
    function changePosition(id) {

        if (id != "#top") {
            $('.header').addClass('preventExpand');
        }



        $('.nav-secondary-mobile').removeClass('active'); //if mobile open - close menu / button
        $("#nav-secondary-button").removeClass('active');

        //var testDiv = document.getElementById(id)
        // var target = testDiv.offsetTop;

        var target = $(id).offset().top;
        var isScrollUp = $('.header').hasClass('scrollUp');


        if ($(window).width() > 1200) {

            if (!isScrollUp) {
                target = target - 160;
            } else {
                target = target - 80;
            }

        } else { // small screen 
            if (!isScrollUp) {
                target = target - 125;
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



    //Burger
    //Burger Menu -- click
    $("#nav-secondary-button").on("click", function () {

        $('#nav-secondary-button').toggleClass('active');
        $('.nav-secondary-mobile').toggleClass('active');

    });



    //CLICK AWAY
    const navSecondaryMobile = document.querySelector('.nav-secondary-mobile')
    const navSecondaryMobileList = document.querySelector('.nav-secondary-mobile__list')
    const navSecondaryButton = document.querySelector('#nav-secondary-button')

    document.addEventListener('click', evt => {

        const isMenuClick = navSecondaryMobileList.contains(evt.target);
        const isButtonClick = navSecondaryButton.contains(evt.target);
        const isOpen = navSecondaryMobile.classList.contains('active');




        if (!isButtonClick && isOpen && !isMenuClick) {
            navSecondaryMobile.classList.remove('active');
            navSecondaryButton.classList.remove('active');
        }


    });




    //resize window -- remove collapse menu over 1000
    $(window).resize(function () {
        if ($(window).width() > 600) {
            $('.nav-secondary-mobile').removeClass('active');
            $("#nav-secondary-button").removeClass('active');

        }
    });






});

