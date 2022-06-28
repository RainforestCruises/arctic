jQuery(document).ready(function ($) {
  const templateUrl = page_vars.templateUrl;
  var currentYear = new Date().getFullYear();
  var body = $('body');



  //Itinerary Days Slider
  $('#itinerary-main-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: false,
    adaptiveHeight: true,
    fade: true,
    focusOnSelect: true,
    arrows: true,
    dots: false,
    swipe: true,
    draggable: false,
    swipeToSlide: true,
    asNavFor: '#itinerary-nav-slider',
    prevArrow: '<button class="btn-scroll btn-scroll--left itinerary-days__content__layout__main__slider__btn-left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    nextArrow: '<button class="btn-scroll itinerary-days__content__layout__main__slider__btn-right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 800,
        settings: {
          dots: false
        }
      }
    ]
  })

    //Itinerary Side Nav Slider
    $('#itinerary-nav-slider').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      vertical: true,
      infinite: false,
      draggable: true,
      swipeToSlide: true,
      asNavFor: '#itinerary-main-slider',
      focusOnSelect: true,
      nextArrow: '<button class="btn-scroll btn-scroll--down itinerary-days__content__layout__side-nav__slider__btn-down"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
      prevArrow: '<button class="btn-scroll btn-scroll--up itinerary-days__content__layout__side-nav__slider__btn-up"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
      responsive: [
        {
          breakpoint: 800,
          settings: {
            vertical: false,
            arrows: false,
            slidesToShow: 5,
          }
        },
        {
          breakpoint: 600,
          settings: {
            vertical: false,
            arrows: false,
            slidesToShow: 3,
          }
        }
      ]
    })


  //Arctic Sliders
  $('#cabins-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,

    arrows: true,
    prevArrow: '<button class="btn-scroll btn-scroll--left itinerary-overview__content__grid__ship-area__slider__btn-left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    nextArrow: '<button class="btn-scroll itinerary-overview__content__grid__ship-area__slider__btn-right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,

        }
      }
    ]
  });

  //
  $('#departures-slider').slick({
    slidesToShow: 6,
    slidesToScroll: 6,

    arrows: true,
    prevArrow: '<button class="btn-scroll btn-scroll--left itinerary-overview__content__grid__ship-area__slider__btn-left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    nextArrow: '<button class="btn-scroll itinerary-overview__content__grid__ship-area__slider__btn-right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,

        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,

        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      }
    ]
  });







});
