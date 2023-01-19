
jQuery(document).ready(function ($) {


    //intro text modal
    const contentModal = document.querySelector("#contentModal");
    const expandContent = document.querySelector("#expand-content");
    if (expandContent) {
        expandContent.addEventListener('click', () => {
            contentModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    }

    //faq modal
    const faqsModal = document.querySelector("#faqsModal");
    const faqsModalMainContent = document.querySelector("#faqsModalMainContent");
    const readAllFaqs = [...document.querySelectorAll('.read-all-faqs')];
    if (readAllFaqs) {
        readAllFaqs.forEach(item => {
            item.addEventListener('click', () => {
                faqsModal.style.display = 'flex';
                body.classList.add('no-scroll');
                const section = item.getAttribute('section');
                const modalDivSectionOffset = document.getElementById(section).offsetTop;
                faqsModalMainContent.scrollTop = modalDivSectionOffset - 120;

            });
        })
    }

    // Inquire modal
    const inquireModal = document.querySelector("#inquireModal");
    const genericInquireCtaButtons = [...document.querySelectorAll('.generic-inquire-cta')];
    genericInquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    })


    new Swiper('.ship-card-image-area', {
        slidesPerView: 1,
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


    const itinerariesSlider = new Swiper('#itineraries-slider', {
        loop: false,
        spaceBetween: 15,
        slidesPerView: 1,
        navigation: {
            nextEl: '.itineraries-slider-btn-next',
            prevEl: '.itineraries-slider-btn-prev',
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




});
