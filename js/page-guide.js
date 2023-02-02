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


});


