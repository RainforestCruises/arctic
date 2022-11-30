jQuery(document).ready(function ($) {
    //const templateUrl = page_vars.templateUrl;

    $(window).scroll(function (e) {
        parallax();
    });
    function parallax() {
        var scrolled = $(window).scrollTop();
        $('.hero').css('top', -(scrolled * 0.0315) + 'rem');
        $('.hero > h1').css('top', -(scrolled * -0.005) + 'rem');
        $('.hero > h1').css('opacity', 1 - (scrolled * .00175));
    };



    // Down Arrow
    $('#scroll-down').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {
        var target = $(id).offset().top;
        target = target - 0;
        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;
    }


    //Content
    //-- Deals, Experiences, Landmarks, Cruises, Itineraries



    const itinerariesSlider = new Swiper('#itineraries-slider', {
        // Optional parameters
        loop: true,
        spaceBetween: 15,
        slidesPerView: 1,
        // Navigation arrows
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
            },
            1000: {
                slidesPerView: 5,
            }
        }
    });


    new Swiper('#cruises-slider', {
        spaceBetween: 15,
        slidesPerView: 1,

        //allowTouchMove: false,

        navigation: {
            nextEl: '.cruises-slider-btn-next',
            prevEl: '.cruises-slider-btn-prev',
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


    const cruiseCardImageAreas = [...document.querySelectorAll('.cruise-card-image-area')];
    cruiseCardImageAreas.forEach((element, index) => {
        new Swiper('.cruise-card-image-area-' + index, {
            slidesPerView: 1,
            loop: true,
            pagination: {
                el: '.cruise-card-image-area-pagination-' + index,
                clickable: true,
                dynamicBullets: true,
                dynamicMainBullets: 3,
            },
            navigation: {
                nextEl: '.cruise-card-image-area-button-next-' + index,
                prevEl: '.cruise-card-image-area-button-prev-' + index,
            },
        });
    })


});



