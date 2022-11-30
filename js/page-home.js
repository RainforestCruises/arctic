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

    new Swiper('.itinerary-card-image-area', {
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


});



