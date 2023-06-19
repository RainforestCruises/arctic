jQuery(document).ready(function ($) {

    //MODALS ---------------------
    const body = document.getElementById("body");

    // Cabins Swiper
    new Swiper('#cabins-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        slideToClickedSlide: false,
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


    new Swiper('.cruise-cabins-modal-item__image-area', {
        slidesPerView: 1,
        spaceBetween: 15,
        watchSlidesProgress: true,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
       
    });


    
    // Cabin Images - Click event listeners
    const cabinModal = document.getElementById("cabinModal");
    const cabinGalleryImages = [...document.querySelectorAll('.cabin-image-slide')];

    cabinGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            cabinModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const filterId = item.getAttribute('cabinId');
            filterCabins(filterId);
        });
    })

    // cabin avatar images
    const cabinAvatarImages = [...document.querySelectorAll('.cabin-avatar-image')];
    cabinAvatarImages.forEach(item => {
        item.addEventListener('click', () => {
            cabinModal.style.display = 'flex';
            cabinModal.classList.add('modal-second-level');

            const filterId = item.getAttribute('cabinId');
            filterCabins(filterId);
        });
    })



    const cabinModalSections = [...document.querySelectorAll('.cruise-cabins-modal-item')];

    function filterCabins(filterId) {
        cabinModalSections.forEach(item => { 
            item.style.display = "none";  //loop each departure card, set all to display none
            if (filterId == item.getAttribute('cabinId')) {
                item.style.display = "";
            }
        });
       
    }


});
