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

    // experiences slider
  new Swiper("#cruises-slider", {
    spaceBetween: 30,
    slidesPerView: 1,
    watchSlidesProgress: true,
    pagination: {
      el: ".swiper-pagination",
    },
    navigation: {
      nextEl: ".cruises-slider-btn-next",
      prevEl: ".cruises-slider-btn-prev",
    },
    breakpoints: {
      600: {
        slidesPerView: 2,
      },
      800: {
        slidesPerView: 3,
      },
    },
  });
});
