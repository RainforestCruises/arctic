
jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;

    $('#testimonials-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--right destination-testimonials__slider__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--left destination-testimonials__slider__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    arrows: false,
                    dots: true
                }
            }

        ]
    });




});
