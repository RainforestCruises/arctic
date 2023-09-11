
jQuery(document).ready(function ($) {

    // Inquire modal
    const inquireModal = document.querySelector("#inquireModal");
    const genericInquireCtaButtons = [...document.querySelectorAll('.generic-inquire-cta')];
    genericInquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    })
    
    //intro text modal
    const contentModal = document.querySelector("#contentModal");
    const expandContent = document.querySelector("#expand-content");
    if (expandContent) {
        expandContent.addEventListener('click', () => {
            contentModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    }


    const dealSliderSections = [...document.querySelectorAll('.deal-slider-block')];

    dealSliderSections.forEach((section, index) => {
        new Swiper('#category-slider-' + index, {
            spaceBetween: 15,
            slidesPerView: 1.2,
            watchSlidesProgress: true,
            navigation: {
                nextEl: '.category-slider-btn-next-' + index,
                prevEl: '.category-slider-btn-prev-' + index,
            },
            breakpoints: {
                600: {
                    slidesPerView: 2,
                },
                1000: {
                    slidesPerView: 3,
                },
                1300: {
                    slidesPerView: 4,
                }
            }
        });
    })


});
