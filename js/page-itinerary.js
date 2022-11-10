jQuery(document).ready(function ($) {

  

    // Sliders -------------------
    // hero desktop slider
    const heroDesktopSlider = new Swiper('#hero-desktop-slider', {
      loop: true,
      spaceBetween: 5,
      slidesPerView: 2,
      navigation: {
          nextEl: '.hero-gallery-slider-next',
          prevEl: '.hero-gallery-slider-prev',
      },
      breakpoints: {
          1280: {
              slidesPerView: 3,
          }
      }
  });
  // hero mobile slider
  const heroMobileSlider = new Swiper('#hero-mobile-slider', {
      loop: true,
      draggable: true,
      slidesPerView: 1,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      }
  });
  const counter = document.querySelector('.product-hero__bg-slider__count');
  heroMobileSlider.on('slideChange', function (swiper) {
      counter.innerHTML = (swiper.realIndex + 1) + ' / ' + (swiper.slides.length - 2);
  });


    // Hero Desktop Gallery - Click event listeners
    const heroGalleryImages = [...document.querySelectorAll('.product-hero__gallery__slider__item')];
    const pageGalleryModal = document.getElementById("pageGalleryModal");
    heroGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            pageGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            const slideDiv = document.querySelector('.modal__gallery-content__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);

        });
    })

    // Hero Mobile Gallery - Click event listeners 
    const heroMobileGalleryImages = [...document.querySelectorAll('.product-hero__bg-slider__slide')];
    heroMobileGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            pageGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            const slideDiv = document.querySelector('.modal__gallery-content__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.slideTo(2, 0)
            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);

        });
    })




























  //Inquire
  const inquireCtaButtons = [...document.querySelectorAll('.inquire-cta')];
  const inquireModal = document.getElementById("inquireModal");
  inquireCtaButtons.forEach(item => {
      item.addEventListener('click', () => {
          inquireModal.style.display = 'flex';
          body.classList.add('no-scroll');
      });
  })

  //departure filter
  $(".departure-filter").on('click', function () {
    var filter = $(this).data('filter');
    var currentYear = new Date().getFullYear();

    $(".departure-filter").removeClass('active');
    $(this).addClass('active');
    $("#departures-slider").slick('slickUnfilter');

    if (filter == currentYear) {
      $("#departures-slider").slick('slickFilter', 'div:contains("' + (currentYear) + '")');
    }
    else if (filter == (currentYear + 1)) {
      $("#departures-slider").slick('slickFilter', 'div:contains("' + (currentYear + 1) + '")');
    }
    else if (filter == (currentYear + 2)) {
      $("#departures-slider").slick('slickFilter', 'div:contains("' + (currentYear + 2) + '")');
    }
    else if (filter == 'all') {

      $("#departures-slider").slick('slickUnfilter');
    }

  })



});
