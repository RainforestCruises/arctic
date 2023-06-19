jQuery(document).ready(function ($) {

    // Related Swiper
    new Swiper('#related-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.related-slider-btn-next',
            prevEl: '.related-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            }
        }
    });

    // Ships Swiper
    new Swiper('#ships-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.ships-slider-btn-next',
            prevEl: '.ships-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            }
        }
    });

    // itineraries Swiper
    new Swiper('#itineraries-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.itineraries-slider-btn-next',
            prevEl: '.itineraries-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            }
        }
    });



    // Guide Menu 
    // button click
    $(".guide-menu__button").on("click", function () {
        $('.guide-menu__menu').toggleClass('active');
    });


    // click away, close menu
    const navGuideMenu = document.querySelector('.guide-menu__menu');
    const navGuideButton = document.querySelector('.guide-menu__button');

    document.addEventListener('click', evt => {

        const isButtonClick = navGuideButton.contains(evt.target);
        const isOpen = navGuideMenu.classList.contains('active');

        if (!isButtonClick && isOpen) {
            navGuideMenu.classList.remove('active');
        }
    });



    //On Scroll Listener
    window.onscroll = function () { scrollCheck() };
    function scrollCheck() {
        var threshHold = 620
        if ($(window).width() > 1000) {
            threshHold = 1200;
        }

        console.log(window.scrollY);
        console.log($(document).height());
        if (window.scrollY < threshHold) {
            console.log('above');
            $('.guide-menu-area').removeClass('active');
        } else if(window.scrollY > $(document).height() - 2000) {
            console.log('below');
            $('.guide-menu-area').removeClass('active');
        } else {
            console.log('mid');
            $('.guide-menu-area').addClass('active');
        }
        progressBarScroll();
    }

    progressBarScroll();
    function progressBarScroll() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop,
            height = document.documentElement.scrollHeight - document.documentElement.clientHeight - 500,
            scrolled = (winScroll / height) * 100;
        document.getElementById("progressBar").style.width = scrolled + "%";
    }



});


