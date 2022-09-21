jQuery(document).ready(function ($) {


    // Hero Sliders -------------------
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




    //MODALS ---------------------
    const body = document.getElementById("body");

    //Inquire
    const inquireCtaButtons = [...document.querySelectorAll('.inquire-cta')];
    const inquireModal = document.getElementById("inquireModal");
    inquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    })


    // Modal Gallery Slider (Main and Nav)
    const modalGalleryNav = new Swiper("#modal-gallery-nav", {
        spaceBetween: 10,
        slidesPerView: 3,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            600: {
                slidesPerView: 4,
            }
        }
    });
    const modalGalleryMain = new Swiper("#modal-gallery-main", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: modalGalleryNav,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
    });
    const counterGallery = document.querySelector('#pageGalleryModalCount');
    const titleGallery = document.querySelector('#pageGalleryModalTitle');
    modalGalleryMain.on('slideChange', function (swiper) {
        counterGallery.innerHTML = (swiper.realIndex + 1) + ' / ' + (swiper.slides.length);

        const slideDiv = document.querySelector('.page-gallery__main__slider__item[slideIndex="' + (swiper.realIndex + 1) + '"]');
        const slideTitle = slideDiv.getAttribute('title');
        titleGallery.innerHTML = slideTitle;
    });


    // Hero Desktop Gallery - Click event listeners
    const heroGalleryImages = [...document.querySelectorAll('.product-hero__gallery__slider__item')];
    const pageGalleryModal = document.getElementById("pageGalleryModal");
    heroGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            pageGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            const slideDiv = document.querySelector('.page-gallery__main__slider__item[imageId="' + imageId + '"]');
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
            const slideDiv = document.querySelector('.page-gallery__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.slideTo(2, 0)
            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);

        });
    })


    //Deck Plan Button
    const deckPlanButton = document.getElementById("deckplan-button");
    deckPlanButton.addEventListener('click', () => {
        pageGalleryModal.style.display = 'flex';
        body.classList.add('no-scroll');

        const imageId = deckPlanButton.getAttribute('imageId');
        const slideDiv = document.querySelector('.page-gallery__main__slider__item[imageId="' + imageId + '"]');
        const slideIndex = slideDiv.getAttribute('slideIndex');

        modalGalleryMain.update();
        modalGalleryMain.slideTo(slideIndex - 1, 0);
        modalGalleryNav.slideTo(slideIndex - 1, 0);
    });

    // Cabin Images - Click event listeners
    const cabinGalleryImages = [...document.querySelectorAll('.cabin-image-slide')];
    cabinGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            pageGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            console.log(imageId);
            const slideDiv = document.querySelector('.page-gallery__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);

        });
    })






    // Cabins Swiper
    new Swiper('#cabins-slider', {
        spaceBetween: 15,
        slidesPerView: 1,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.cabins-slider-btn-next',
            prevEl: '.cabins-slider-btn-prev',
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

    new Swiper('.cabin-card-image-area', {
        slidesPerView: 1,
        allowTouchMove: false,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }


    });

    // Dates Swiper
    new Swiper('#dates-slider', {
        spaceBetween: 15,
        slidesPerView: 1,
        shortSwipes: false,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.dates-slider-btn-next',
            prevEl: '.dates-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            },
            1000: {
                slidesPerView: 4,
            }

        }
    });

    // Related Swiper
    new Swiper('#related-slider', {
        spaceBetween: 15,
        slidesPerView: 1,
        allowTouchMove: false,
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
    new Swiper('.related-card-image-area', {
        slidesPerView: 1,
        allowTouchMove: false,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });


});
