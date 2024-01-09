
jQuery(document).ready(function ($) {

    // inquire modal
    const inquireModal = document.querySelector("#inquireModal");
    const genericInquireCtaButtons = [...document.querySelectorAll('.generic-inquire-cta')];
    genericInquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    })
    
    // intro text modal
    const contentModal = document.querySelector("#contentModal");
    const expandContent = document.querySelector("#expand-content");
    if (expandContent) {
        expandContent.addEventListener('click', () => {
            contentModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    }

    // deal sliders
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


    
    // deal modals - click event listeners
    const dealsModal = document.getElementById("dealsModal");
    const dealsModalTitle = document.getElementById("dealsModalTitle");
    
    const dealCards = [...document.querySelectorAll('.toplevel-deal-card')];
    dealCards.forEach(item => {
        item.addEventListener('click', () => {
            dealsModal.style.display = 'flex';
            body.classList.add('no-scroll');

            if (item.classList.contains('special-departure-cta')) {
                dealsModalTitle.innerHTML = "Special Departure Information";
            } else {
                dealsModalTitle.innerHTML = "Deal Information";
            }

            const filterId = item.getAttribute('dealId');
            filterDeals(filterId);
        });
    })


    const dealModalSections = [...document.querySelectorAll('.product-deals-modal-item')];
    function filterDeals(filterId) {
        dealModalSections.forEach(item => {
            item.style.display = "none";  //loop each departure card, set all to display none
            if (filterId == item.getAttribute('dealId')) {
                item.style.display = "";
            }
        });
    }
});
