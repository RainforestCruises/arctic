jQuery(document).ready(function ($) {
  const templateUrl = page_vars.templateUrl;
  var currentYear = new Date().getFullYear();
  var body = $('body');



  //Itinerary Days Slider
  $('#itinerary-days-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    fade: true,
    focusOnSelect: true,
    arrows: true,
    dots: false,
    swipe: true,
    draggable: false,
    swipeToSlide: true,
    prevArrow: '<button class="btn-circle btn-circle--small btn-circle--left home-arctic-newest__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-circle--right home-arctic-newest__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
  responsive: [
      {
        breakpoint: 800,
        settings: {
          dots: false
        }
      }
    ]
  }).on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
    $('#itineraries-slider').slick("setOption", '', '', true);
    var currentCounter = $(this).next();

    var i = (currentSlide ? currentSlide : 0) + 1;
    currentCounter.text(i + ' / ' + slick.slideCount);
  });



 //Arctic Sliders
 $('.itinerary-overview__grid__ship-area__slider').slick({
  slidesToShow: 2,
  slidesToScroll: 1,

  arrows: true,
  prevArrow: '<button class="btn-circle btn-circle--small btn-circle--left home-arctic-newest__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
  nextArrow: '<button class="btn-circle btn-circle--small btn-circle--right home-arctic-newest__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
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
$('.itinerary-departures__slider').slick({
  slidesToShow: 5,
  slidesToScroll: 1,

  arrows: true,
  prevArrow: '<button class="btn-circle btn-circle--small btn-circle--left home-arctic-newest__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
  nextArrow: '<button class="btn-circle btn-circle--small btn-circle--right home-arctic-newest__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
  responsive: [
      {
          breakpoint: 600,
          settings: {
              slidesToShow: 2,
          
          }
      }
  ]
});







});
