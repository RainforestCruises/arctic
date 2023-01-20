jQuery(document).ready(function ($) {

    //Deckplan Modal ---------------------
    const body = document.getElementById("body");
    const deckplanGalleryModal = document.getElementById("deckplanGalleryModal");


    const modalGalleryMain = new Swiper("#deckplan-gallery", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
    });

    const counterGallery = document.querySelector('#deckplanGalleryModalCount');
    modalGalleryMain.on('slideChange', function (swiper) {
        counterGallery.innerHTML = (swiper.realIndex + 1) + ' / ' + (swiper.slides.length);
    });


    //Deck Plan Button
    const deckPlanButton = document.getElementById("deckplan-button");
    if(deckPlanButton){
        deckPlanButton.addEventListener('click', () => {
            deckplanGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');
            modalGalleryMain.update();
            modalGalleryMain.slideTo(0, 0);

        });
    };

});
