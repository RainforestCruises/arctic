jQuery(document).ready(function ($) {


    //MODALS ---------------------
    const body = document.getElementById("body");


    const departureSelectionDisplay = document.querySelector("#departure-selection-display");
    const cabinSelectionDisplay = document.querySelector("#cabin-selection-display");


    //hide outline panels on load (mobile)
    checkOutlinePanels();
    function checkOutlinePanels() {
        if ($(window).width() < 1000) { //mobile view    
            $('.outline-panel__content').toggle();
            $('.outline-panel__heading').toggleClass('closed');
        }
    }

    // Inquire buttons (generic)
    // -- clear all selections
    // -- hide tabs
    // -- go to inquire form
    const genericInquireCtaButtons = [...document.querySelectorAll('.generic-inquire-cta')];
    genericInquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
            activeTabPanel('inquire');


            departureSelectionDisplay.style.display = "";
            departureSelectionDisplay.innerHTML = "";
            cabinSelectionDisplay.style.display = "";
            cabinSelectionDisplay.innerHTML = "";
            hideModalTabButtons();
        });
    })

    // Inquire Buttons (on departures)
    // -- go to inquire
    // -- make selection of departure date
    // -- hide tabs except return to dates
    const departureInquireCtaButtons = [...document.querySelectorAll('.departure-inquire-cta')];
    departureInquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
            activeTabPanel('inquire');

            var selection = item.getAttribute("itineraryTitle") + " - Departing " + item.getAttribute("departureDate");

            departureSelectionDisplay.style.display = "block";
            departureSelectionDisplay.innerHTML = selection;
            hideModalTabButtons('dates')
        });
    })

    // Inquire buttons (on cabins)
    // -- complete the cabin selection
    // -- go to inquire form
    const cabinInquireCtaButtons = [...document.querySelectorAll('.cabin-inquire-cta')];
    cabinInquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
            activeTabPanel('inquire');
            hideModalTabButtons('cabins');

            var selection = item.getAttribute("cabinTitle");

            cabinSelectionDisplay.style.display = "block";
            cabinSelectionDisplay.innerHTML = selection;

        });
    })

    // View Prices Buttons (on departures)
    // -- go to cabin selection
    // -- display itinerary selected
    const departurePriceButtons = [...document.querySelectorAll('.price-group-button')];
    departurePriceButtons.forEach(item => {
        item.addEventListener('click', () => {

            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const year = item.getAttribute('year');
            const itinerary = item.getAttribute('itinerary');
            const title = item.getAttribute('itineraryTitle') + ' - Departing, ' + item.getAttribute('departureDate');

            activeTabPanel('cabins');
            filterCabins(year, itinerary, title);
            hideModalTabButtons('dates'); // show the dates tab

            departureSelectionDisplay.style.display = "block";
            departureSelectionDisplay.innerHTML = title;

            cabinSelectionDisplay.innerHTML = ""; // clear cabin selection
            cabinSelectionDisplay.style.display = "none";
        });
    })

    // Filter Cabins
    // -- display the departure date
    const modalCabinCards = [...document.querySelectorAll('.modal-cabin-card ')];
    const cabinDepartureSubtitle = document.querySelector("#cabin-departure-subtitle");
    function filterCabins(year, itineraryId, display) {
        cabinDepartureSubtitle.innerHTML = display;
        var count = 0;
        modalCabinCards.forEach(item => {
            item.style.display = "none";
            var matchDate = false;
            var matchItinerary = false;

            if (item.getAttribute('year') == year) {
                matchDate = true;
            }

            if (item.getAttribute('itinerary') == itineraryId) {
                matchItinerary = true;
            }

            if (matchDate && matchItinerary) {
                item.style.display = "";
                count = count + 1;
            }
        });


    }

    // view all button
    // -- show departures
    // -- hide all modal tab buttons
    const viewAllDates = document.querySelector("#view-all-dates-button");
    viewAllDates.addEventListener('click', () => {
        inquireModal.style.display = 'flex';
        body.classList.add('no-scroll');
        activeTabPanel('dates');
        hideModalTabButtons();
    });


    // Modal Tabs
    const modalTabButtons = [...document.querySelectorAll('.modal-tab-link')];
    modalTabButtons.forEach(item => {
        item.addEventListener('click', () => {
            const tabId = item.getAttribute('tab-panel');
            activeTabPanel(tabId);
            if (tabId == 'cabins') {
                cabinSelectionDisplay.style.display = ""; //erase cabin selection
                cabinSelectionDisplay.innerHTML = "";
                hideModalTabButtons('dates');
            } else {
                hideModalTabButtons();
            }
        });
    })

    // Hide Tabs
    function hideModalTabButtons(exclude) {
        
        modalTabButtons.forEach(item => {
            if (item.getAttribute('tab-panel') == exclude) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        })

      
    }

    // Modal Panels
    const modalTabPanels = [...document.querySelectorAll('.modal-tab-panel')];
    const departureModalTitle = document.querySelector("#departure-modal-title");
    const inquireModalMainContent = document.querySelector("#inquireModalMainContent");
    function activeTabPanel(tabId) {
        inquireModalMainContent.scrollTop = 0;
        modalTabPanels.forEach(panel => {
            const panelId = panel.getAttribute('tab-panel');
            if (tabId == panelId) {
                panel.classList.add('active');
            } else {
                panel.classList.remove('active');
            }
        })
        departureModalTitle.style.display = "none";
        if(tabId == 'dates'){
            departureModalTitle.style.display = "";
        }
    }





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


    // Related Swiper
    new Swiper('#related-slider', {
        spaceBetween: 15,
        slidesPerView: 1,
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






    // view all button
    // -- show departures
    // -- hide all modal tab buttons
    const reviewsModal = document.querySelector("#reviewsModal");
    const readAllReviews = document.querySelector("#read-all-reviews");
    readAllReviews.addEventListener('click', () => {
        reviewsModal.style.display = 'flex';
        body.classList.add('no-scroll');
        
    });


});
