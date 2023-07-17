jQuery(document).ready(function ($) {

  // itineraries slider
  new Swiper('#difference-slider', {
    spaceBetween: 0,
    slidesPerView: 1,
    centeredSlides: true,
    watchSlidesProgress: true,
    loop: true,
    navigation: {
      nextEl: '.difference-slider-btn-next',
      prevEl: '.difference-slider-btn-prev',
    },
    breakpoints: {
      600: {
        slidesPerView: 1,
      },
 
      1300: {
        slidesPerView: 1.5,
      }
    }
  });




});
