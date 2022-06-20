
jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;

    $('#difference-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        arrows: true,
    
        prevArrow: '<button class="btn-circle btn-white btn-circle--left btn-circle--large destination-main__packages__best-selling__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-white btn-circle--right btn-circle--large destination-main__packages__best-selling__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        focusOnSelect: true,
        responsive: [
            {
              breakpoint: 600,
              settings: {
                arrows: false,
      
              }
            }
          ]
    });




});
