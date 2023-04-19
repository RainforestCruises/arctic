
jQuery(document).ready(function ($) {

    const dealSliderSections = [...document.querySelectorAll('.deal-slider-block')];

    dealSliderSections.forEach((section, index) => {
        new Swiper('#category-slider-' + index, {
            spaceBetween: 15,
            slidesPerView: 1.2,
            watchSlidesProgress: true,
            navigation: {
                nextEl: '.category-slider-btn-next-' + index,
                prevEl: '.category-slider-btn-prev-' + index,
            },
            breakpoints: {
                600: {
                    slidesPerView: 2,
                },
                1000: {
                    slidesPerView: 3,
                },
                1300: {
                    slidesPerView: 4,
                }
            }
        });
    })


});
