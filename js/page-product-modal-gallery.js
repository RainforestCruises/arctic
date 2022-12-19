jQuery(document).ready(function ($) {

    //MODALS ---------------------
    const body = document.getElementById("body");



    // Modal Gallery Slider (Main and Nav)
    const modalGalleryNav = new Swiper("#modal-gallery-nav", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            800: {
                slidesPerView: 5,
            },
            1000: {
                slidesPerView: 6,
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

        const slideDiv = document.querySelector('.modal__gallery__main__slider__item[slideIndex="' + (swiper.realIndex + 1) + '"]');
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
            const slideDiv = document.querySelector('.modal__gallery__main__slider__item[imageId="' + imageId + '"]');
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
            const slideDiv = document.querySelector('.modal__gallery__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.slideTo(2, 0)
            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);

        });
    })


    //Deck Plan Button
    const deckPlanButton = document.getElementById("deckplan-button");
    if(deckPlanButton){
        deckPlanButton.addEventListener('click', () => {
            pageGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');
    
            const imageId = deckPlanButton.getAttribute('imageId');
            const slideDiv = document.querySelector('.modal__gallery-content__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');
    
            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);
        });
    }


    // Cabin Images - Click event listeners
    const cabinGalleryImages = [...document.querySelectorAll('.cabin-image-slide')];
    cabinGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            pageGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            const slideDiv = document.querySelector('.modal__gallery__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
            modalGalleryNav.slideTo(slideIndex - 1, 0);

        });
    })







});
