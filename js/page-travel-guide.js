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


});


