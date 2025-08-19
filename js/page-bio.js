jQuery(document).ready(function ($) {
  // SLIDERS -------------------------------------------------------

  // reviews slider
  new Swiper("#reviews-slider", {
    spaceBetween: 30,
    slidesPerView: 1,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });
});
