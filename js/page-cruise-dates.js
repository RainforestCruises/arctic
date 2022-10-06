jQuery(document).ready(function ($) {


    // Itinerary Filter ----------------------------------------------------------------------------------------
    const itineraryFilterButton = document.querySelector('#itinerary-filter-button');
    const itineraryFilterTooltip = document.querySelector('#itinerary-filter-tooltip');
    let itineraryValuesInitialState = [];
    let itineraryValues = [];
    const itineraryFilterSearchButton = document.querySelector('#itinerary-filter-search-button');
    const itineraryFilterClearButton = document.querySelector('#itinerary-filter-clear-button');

    // popper instance
    const itineraryPopper = Popper.createPopper(itineraryFilterButton, itineraryFilterTooltip, {
        placement: 'top-start',
        modifiers: [
            {
                name: 'offset',
                options: {
                    offset: [-8, 10],
                },
            },
        ],
    });

    // show popper
    itineraryFilterButton.addEventListener('click', showItineraryPopper);
    function showItineraryPopper() {
        itineraryFilterTooltip.setAttribute('data-show', '');
        itineraryFilterButton.classList.add('active');
        itineraryPopper.update();

        // tick boxes with initial state values
        itineraryCheckboxes.forEach(item => {
            itineraryValuesInitialState.forEach(value => {
                if (item.value == value) {
                    item.checked = true;
                }
            })
        })
        updateItineraryValues();
    }

    // hide popper
    document.addEventListener('click', evt => {
        const isItineraryFilterButton = itineraryFilterButton.contains(evt.target);
        const isItineraryFilterTooltip = itineraryFilterTooltip.contains(evt.target);
        const itineraryListIsOpen = itineraryFilterTooltip.hasAttribute('data-show');

        if (itineraryListIsOpen && !isItineraryFilterButton && !isItineraryFilterTooltip) { //needs both because not all area is clickable space
            hideItineraryPopper();
        }
    });
    function hideItineraryPopper() {
        itineraryFilterTooltip.removeAttribute('data-show');
        if (itineraryValuesInitialState.length == 0) {
            itineraryFilterButton.classList.remove('active');
        }

    }

    // checkboxes
    const itineraryCheckboxes = [...document.querySelectorAll('.itinerary-checkbox')];
    itineraryCheckboxes.forEach(item => {
        item.addEventListener('click', () => {
            updateItineraryValues();
        });
    })

    // checkboxes update values array
    function updateItineraryValues() {
        itineraryValues = [];
        itineraryCheckboxes.forEach(item => {
            if (item.checked) {
                itineraryValues.push(item.value);
            }
        })
    }

    // clear button
    itineraryFilterClearButton.addEventListener('click', () => {
        itineraryValues = [];
        itineraryCheckboxes.forEach(item => {
            item.checked = false;
        })
    });

    // search button
    itineraryFilterSearchButton.addEventListener('click', () => {
        itineraryValuesInitialState = itineraryValues; //set initial values
        hideItineraryPopper();
        filterSlides();
    });






    //Popper (Dates) ---------------
    const dateFilterButton = document.querySelector('#date-filter-button');
    const dateFilterTooltip = document.querySelector('#date-filter-tooltip');
    let dateValuesInitialState = [];
    let dateValues = [];
    const dateFilterSearchButton = document.querySelector('#date-filter-search-button');
    const dateFilterClearButton = document.querySelector('#date-filter-clear-button');

    const datePopper = Popper.createPopper(dateFilterButton, dateFilterTooltip, {
        placement: 'top-start',
        modifiers: [
            {
                name: 'offset',
                options: {
                    offset: [-8, 10],

                },
            },
        ],
    });


    //show
    dateFilterButton.addEventListener('click', showDatesPopper);
    function showDatesPopper() {
        dateFilterTooltip.setAttribute('data-show', '');
        dateFilterButton.classList.add('active');
        datePopper.update();

        // tick boxes with initial state values
        dateCheckboxes.forEach(item => {
            dateValuesInitialState.forEach(value => {
                if (item.value == value) {
                    item.checked = true;
                }
            })
        })
        updateDateValues();
    }

    // hide
    document.addEventListener('click', evt => {
        const isDateFilterButton = dateFilterButton.contains(evt.target);
        const isDateFilterTooltip = dateFilterTooltip.contains(evt.target);
        const datesListIsOpen = dateFilterTooltip.hasAttribute('data-show');

        if (datesListIsOpen && !isDateFilterButton && !isDateFilterTooltip) { //needs both because not all area is clickable space
            hideDatesPopper();
        }
    });
    function hideDatesPopper() {
        dateFilterTooltip.removeAttribute('data-show');
        if (dateValuesInitialState.length == 0) {
            dateFilterButton.classList.remove('active');
        }
    }

    // checkboxes
    const dateCheckboxes = [...document.querySelectorAll('.date-checkbox')];
    dateCheckboxes.forEach(item => {
        item.addEventListener('click', () => {
            updateDateValues();
        });
    })

    // checkboxes update values array
    function updateDateValues() {
        dateValues = [];
        dateCheckboxes.forEach(item => {
            if (item.checked) {
                dateValues.push(item.value);
            }
        })
    }


    // clear
    dateFilterClearButton.addEventListener('click', () => {
        dateValues = [];
        dateCheckboxes.forEach(item => {
            item.checked = false;
        })
    });

    // search
    dateFilterSearchButton.addEventListener('click', () => {
        dateValuesInitialState = dateValues; //set initial values
        hideDatesPopper();
        filterSlides();
    });









    // Dates Swiper ---------------------------------------------------
    const datesSliderNoResults = document.querySelector('#dates-slider-no-results');
    const clearFilters = [...document.querySelectorAll('.clear-departure-filters')];

    clearFilters.forEach(item => {
        item.addEventListener('click', () => {
            console.log('clear')
            dateValues = []
            dateValuesInitialState = []; //set initial values
            itineraryValues = [];
            itineraryValuesInitialState = [];
            dateCheckboxes.forEach(item => {
                item.checked = false;
            })
            hideDatesPopper();
            itineraryCheckboxes.forEach(item => {
                item.checked = false;
            })
            hideItineraryPopper();
            filterSlides();
        });
    })
    



    var datesSwiper = new Swiper('#dates-slider', {
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


    const departureCards = [...document.querySelectorAll('.departure-card')];

    function filterSlides() {
        var count = 0;
        departureCards.forEach(item => {
            item.style.display = "none";
            var matchDate = false;
            var matchItinerary = false;

            //check date
            if (dateValuesInitialState.length == 0) {
                matchDate = true;
            } else {
                dateValuesInitialState.forEach(dateValue => {
                    if (item.getAttribute('data-filter-date') == dateValue) {
                        matchDate = true;
                    }
                })
            }

            //check itienrary
            if (itineraryValuesInitialState.length == 0) {
                matchItinerary = true;
            } else {
                itineraryValuesInitialState.forEach(itineraryValue => {
                    if (item.getAttribute('data-filter-itinerary') == itineraryValue) {
                        matchItinerary = true;
                    }
                })
            }

            if (matchDate && matchItinerary) {
                item.style.display = "";
                count = count + 1;
            }
        });
        dateSubtitleDisplay(count);

        datesSwiper.updateSize();
        datesSwiper.updateSlides();
        datesSwiper.updateProgress();
        datesSwiper.updateSlidesClasses();
        datesSwiper.slideTo(0);
        datesSwiper.scrollbar.updateSize();

        if (count > 0) {
            datesSliderNoResults.style.display = "none";
        } else {
            datesSliderNoResults.style.display = "flex";
        }

        if (dateValuesInitialState.length == 0 && itineraryValuesInitialState.length == 0){
            clearFilters.forEach(item => {
                item.style.display = 'none';
            })
        } else {
            clearFilters.forEach(item => {
                item.style.display = '';
            })
        }

    }

    const dateSubtitles = [...document.querySelectorAll('.departure-date-subtitle')];

    function dateSubtitleDisplay(count) {
        count = count / 2; //because there are duplicated in modal
        var display = "";
        if (count == 0) {
            display = "There are no depatures for the criteria selected";
        } else if (count == 1) {
            display = "Showing " + count + " scheduled departure";
        } else {
            display = "Showing " + count + " scheduled departures";
        }

        dateSubtitles.forEach(item => {
            item.innerHTML = display;
        })
    }





    //   //Inquire
    //   const viewAllButton = document.querySelector('#view-all-dates-button');
    //   const departuresModal = document.getElementById("departuresModal");

    //   viewAllButton.addEventListener('click', () => {
    //     departuresModal.style.display = 'flex';
    //     body.classList.add('no-scroll');
    // });




});
