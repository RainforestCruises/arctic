jQuery(document).ready(function ($) {




    new Swiper('.ship-card-image-area', {
        slidesPerView: 1,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            enabled: false
        },
        breakpoints: {
            600: {
                navigation: {
                    enabled: true,
                }
            }
        }
    });

    new Swiper('#itineraries-best-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.itineraries-best-slider-btn-next',
            prevEl: '.itineraries-best-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            },
            1000: {
                slidesPerView: 4,
            }
        }
    });

    new Swiper('#styles-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.styles-slider-btn-next',
            prevEl: '.styles-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            },
            1000: {
                slidesPerView: 4,
            },
            1200: {
                slidesPerView: 5,
            }
        }
    });


});



