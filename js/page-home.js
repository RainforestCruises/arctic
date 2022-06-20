jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;

    // Down Arrow
    $('#scroll-down').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {
        var target = $(id).offset().top;
        target = target - 0;
        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;
    }



    //Flickity
    var flickitySlider = new Flickity('.home-hero__bg', {
        prevNextButtons: false,
        pageDots: false,
        fade: true,
        lazyLoad: true, //cloudinary issue

        // options
    });




    // // //SLIDERS
    // // // //SLICK -- hero bg
    // $('.home-hero__bg').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: false,
    //     centerMode: false,
    //     draggable: false,
    //     //asNavFor: '#home-hero__bottom__slide-nav',
    //     fade: true,
    //     arrows: false,
    //     speed: 1000,
    //     lazyLoad: 'ondemand', // doesnt work

    // });

    // //--hero bg nav/label
    // $('.home-hero__bottom__slide-nav').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: false,
    //     asNavFor: '#home-hero__bg',
    //     centerMode: false,
    //     arrows: false,
    //     draggable: false,
    //     fade: true,
    //     speed: 1000,
    //     prevArrow: '<button class="btn-circle btn-circle--noborder  btn-white btn-circle--left home-hero__bottom__slide-nav__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    //     nextArrow: '<button class="btn-circle btn-circle--noborder  btn-white btn-circle--right home-hero__bottom__slide-nav__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    //     responsive: [
    //         {
    //             breakpoint: 1000,
    //             // settings: {
    //             //     prevArrow: '<button class="btn-circle btn-circle--noborder    btn-white btn-circle--left destination-hero__content__location__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    //             //     nextArrow: '<button class="btn-circle btn-circle--noborder  btn-white btn-circle--right destination-hero__content__location__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    //             //     speed: 800,
    //             // }
    //         },
    //     ]
    // })


    //Slick Sliders
    $('#intro-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 4000
    });

    $('#intro-testimonials').on("click", function () {
        $('#intro-testimonials').slick("slickNext");
    });

    //SLIDER - Destinations slider
    $('#destinations-slider').slick({
        rows: 2,
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left home-destinations__destinations-area__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right home-destinations__destinations-area__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',

        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 1,
                    arrows: false,
                    centerMode: true
                }
            },

        ]
    });


    //SLIDER - Featured Cruises
    $('#featured-cruises').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--left home-featured__content-area__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--right home-featured__content-area__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    fade: false,
                    arrows: false
                }
            }
        ]
    });

    //SLIDER - Featured Bucket List
    $('#featured-bucket').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--left home-featured__content-area__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--right home-featured__content-area__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    centerMode: true,
                    fade: false,
                    arrows: false
                }
            },


        ]
    });

    //SLIDER - Featured Bucket List
    $('#main-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: true,
        arrows: false,

    });


    //SEARCH UI --------------------------------------------------------------------------------------------
    const formDestination = document.querySelector('#formDestination');
    const formDates = document.querySelector('#formDates');

    const mobileSearchBackButton = document.querySelector('#mobile-search-back');
    const mobileSearchDatesContainer = document.querySelector('.home-full-search__dates');


    //DATES
    const datesInputContainer = document.querySelector('.home-search__dates');
    const datesInputLabel = document.querySelector('.home-search__dates__label');

    const datesInput = document.querySelector('#dates-input');
    const datesList = document.querySelector('#dates-list');
    const datesListItems = [...document.querySelectorAll('#dates-list li')];

    const dateYearArray = [...document.querySelectorAll('.home-search__dates__list__years__year')];

    //DESTINATION SELECT COMPONENT 
    const destinationInputClear = document.querySelector('.home-search__destination__clear');
    const destinationInputLabel = document.querySelector('.home-search__destination__label');
    const destinationInputContainer = document.querySelector('#destination-input-container');
    const destinationInput = document.querySelector('#destination-input');
    const destinationList = document.querySelector('#destination-list');
    const searchContainer = document.querySelector('#search-container');
    const destinationListItems = [...document.querySelectorAll('#destination-list li')];
    let suggestionsArray = [];

    //destination list initialize
    for (let i = 0; i < destinationListItems.length; i++) {
        destinationListItems[i].classList.add('closed');
    }

    //build destination full Arrays
    let destinationStringArray = []; //array of destination strings
    let destinationIdArray = []; //array of destination Ids
    destinationListItems.forEach(item => {
        destinationStringArray.push(item.textContent);
        destinationIdArray.push(parseInt(item.getAttribute('postid')));
    });


    //Destination Focus - on setting focus to destination field 
    destinationInput.addEventListener('focus', () => {
        destinationList.classList.add('open');
        searchContainer.classList.add('active');
        datesList.classList.remove('open');
        destinationInput.classList.remove('error');

        destinationListItems.forEach(dropdown => {
            dropdown.classList.remove('closed');
        });
        suggestionsArray = [];

        let inputValue = destinationInput.value.toLowerCase();
        if (inputValue.length > 0) {
            destinationInputClear.classList.add('active');
        } else {
            destinationInputClear.classList.remove('active');
        }

    });


    //Destination Clear
    destinationInputClear.addEventListener('mousedown', (e) => {
        e.preventDefault();
        suggestionsArray = [];
        destinationInput.value = "";
        destinationInputClear.classList.remove('active');
        destinationInput.classList.remove('error');

        if ($(window).width() > 1000) {
            destinationInput.blur();
            destinationInput.focus();
        } else {

            destinationListItems.forEach(item => {
                item.classList.remove('closed');
            });
            destinationInput.focus();
        }

    });


    //Destination Input - occurs on typing text into destination field
    destinationInput.addEventListener('input', () => {
        destinationList.classList.add('open');
        destinationInput.classList.remove('error');
        let inputValue = destinationInput.value.toLowerCase();

        let inputSuggestions = [];

        if (inputValue.length > 0) {
            for (let j = 0; j < destinationStringArray.length; j++) {
                if (!(inputValue.substring(0, inputValue.length) === destinationStringArray[j].substring(0, inputValue.length).toLowerCase())) {
                    destinationListItems[j].classList.add('closed');
                } else {
                    destinationListItems[j].classList.remove('closed');

                    let destinationText = destinationListItems[j].textContent;
                    let destinationPostId = destinationListItems[j].getAttribute('postid');


                    const suggestion = { suggestionText: destinationText, suggestionPostId: destinationPostId };

                    inputSuggestions.push(suggestion);
                }
            }

            destinationInputClear.classList.add('active');
        } else {
            for (let i = 0; i < destinationListItems.length; i++) {
                destinationListItems[i].classList.remove('closed');
            }
            destinationInputClear.classList.remove('active');
        }

        suggestionsArray = inputSuggestions;
    });


    //Destination List Click (mousedown) - add click event handler to each LI
    destinationListItems.forEach(item => {

        item.addEventListener('mousedown', (e) => {

            e.preventDefault(); //prevent blur

            //set selections
            let listSelectionText = item.textContent;
            let listSelectionPostId = item.getAttribute('postid');

            destinationInput.value = listSelectionText;
            formDestination.value = listSelectionPostId;

            //close list
            destinationListItems.forEach(dropdown => {
                dropdown.classList.add('closed');
            });

            //before initiating blur, must clear suggestions array and push only this selection into it.
            const suggestion = { suggestionText: listSelectionText, suggestionPostId: listSelectionPostId };
            suggestionsArray = [];
            suggestionsArray.push(suggestion);

            //change slide and show date selection
            showDateSelect();
            changeSlide(listSelectionPostId);



            destinationInput.blur();
        });
    })



    //Destination Blur - leave focus
    destinationInput.addEventListener('blur', (event) => {

        let destinationListOpen = destinationList.classList.contains('open');
        let isValidSelection = destinationStringArray.includes(destinationInput.value); //check if entered text matches one in the array 
        if (destinationListOpen) {
            if (suggestionsArray.length > 0) { //make best selection
                destinationInput.value = suggestionsArray[0].suggestionText;
                formDestination.value = suggestionsArray[0].suggestionPostId; //assign selection
                changeSlide(formDestination.value); //change background
                showDateSelect();

            } else {
                //nothing selected         

                if (!isValidSelection) {
                    formDestination.value = null; //assign null selection if invalid input
                }
            }
            destinationList.classList.remove('open'); //close list
        }
        destinationInputClear.classList.remove('active');

        if (destinationInput.value.length > 0 && isValidSelection) {
            destinationInputLabel.classList.add('active');
        } else {
            destinationInputLabel.classList.remove('active');
        }

    });

    //change background
    function changeSlide(slidePostId) {
        const slideDiv = document.querySelector('.home-hero__bg__slide[postid="' + slidePostId + '"]');
        if (slideDiv) {
            const slideNumber = slideDiv.getAttribute('slidenumber');
            //$('#home-hero__bg').slick('slickGoTo', slideNumber);
            flickitySlider.select(slideNumber);
        }
    }

    //MOBILE
    const searchButton = document.querySelector('#search-button');
    const mobileSearchButton = document.querySelector('.home-full-search-cta__button');
    const mobileLoading = document.querySelector('.home-full-search-loading');




    window.onpageshow = function (event) {
        mobileLoading.classList.remove('active'); // on first load
        hideMobileFilters();
    };

    //search-button
    searchButton.addEventListener('click', (e) => {
        
        let isActive = searchButton.classList.contains('active');
        if (!isActive) {
            destinationInput.focus();
            e.preventDefault();
        } else {
            //submit action inherent in element

            if (formDestination.value != "") {
                searchButton.classList.add('loading');

            } else {
                destinationInput.classList.add('error');
                e.preventDefault();
            }


        }

    });

    mobileSearchButton.addEventListener('click', (e) => {
        //submit action inherent in element

        mobileLoading.classList.add('active');

    });

    function showDateSelect() {
        searchContainer.classList.add('expand');
        datesInputContainer.classList.add('show');
        mobileSearchDatesContainer.classList.add('active');
        searchButton.classList.add('active');


        //check screen size
        if ($(window).width() < 1000) {
            destinationInput.blur();
            datesInput.focus();

            datesList.classList.add('open');
            datesInput.classList.add('open');
            overlayCta.classList.add('active');
        }
    }

    //END DESTINATION SELECT -----------------------------------------------------------------------------------



    // //DATE SELECT COMPONENT ------------------------------------------------------------------------------------




    let currentYear = moment().format('YYYY');
    let currentMonth = moment().format('MM');

    let selectedYear = currentYear;
    let selectedMonth = null;

    //Dates LI initialize
    //if current year, disable past months, if prox year, remove all disabled -- on first load
    datesListItems.forEach(item => {

        if (item.value < currentMonth) {
            item.classList.add('disabled');
        }
    })


    //Date Input Field Click -- open 
    datesInput.addEventListener('click', () => {
        datesList.classList.add('open');
        datesInput.classList.add('open');
        searchContainer.classList.add('active');
    });

    //Year Click - event handler to each LI
    dateYearArray.forEach(dateYear => {
        dateYear.addEventListener('click', () => {

            //if current year, disable past months, if prox year, remove all disabled -- fires every time year is clicked
            datesListItems.forEach(item => {
                if (dateYear.getAttribute("year") == currentYear) {
                    if (item.value < currentMonth) {
                        item.classList.add('disabled');
                    }
                } else {
                    item.classList.remove('disabled');
                }
            })

            if (dateYear.getAttribute("year") == selectedYear) {
                datesListItems.forEach(monthItem => {
                    if (monthItem.value == selectedMonth) {
                        monthItem.classList.add('selected');
                    } else {
                        monthItem.classList.remove('selected');
                    }
                });
            } else {
                datesListItems.forEach(monthItem => {
                    monthItem.classList.remove('selected');
                });
            }

            dateYearArray.forEach(year => {
                year.classList.remove('selected');
            });

            dateYear.classList.add('selected')
        });
    })


    const searchForm = document.querySelector('#home-search-form');
    //Month Click - event handler to each LI
    datesListItems.forEach(item => {
        item.addEventListener('click', (e) => {
            if (!item.classList.contains('disabled')) {


                var activeYearDiv = document.querySelector('.home-search__dates__list__years__year.selected');
                selectedYear = activeYearDiv.getAttribute('year');
                selectedMonth = item.value;

                formDates.value = selectedYear + "-" + zeroPad(selectedMonth, 2);
                datesInput.innerHTML = moment(selectedMonth, 'MM').format('MMMM') + ", " + selectedYear; //can get from attribute string

                datesListItems.forEach(month => {
                    month.classList.remove('selected');
                });
                item.classList.add('selected');


                //desktop
                if ($(window).width() > 1000) {
                    datesList.classList.remove('open');
                    datesInput.classList.remove('open');
                    searchContainer.classList.remove('active');




                } else {
                    searchForm.submit();
                    mobileLoading.classList.add('active');
                }

                datesInputLabel.classList.add('active');


            }

        });
    })

    function zeroPad(num, places) {
        var zero = places - num.toString().length + 1;
        return Array(+(zero > 0 && zero)).join("0") + num;
    }


    //CLICK AWAY
    document.addEventListener('click', evt => {

        const isDestinationInput = destinationInput.contains(evt.target);
        const isDatesInput = datesInput.contains(evt.target);
        const isDatesList = datesList.contains(evt.target);
        const datesListIsOpen = datesList.classList.contains('open');


        const isSearchContainer = searchContainer.contains(evt.target);


        // if (!isDestinationInput) {
        //     destinationList.classList.remove('open');
        // }

        if (datesListIsOpen && !isDatesInput && !isDatesList) { //needs both because not all area is clickable space

            if ($(window).width() > 1000) {
                datesList.classList.remove('open');
            }

        }

        if (!isDestinationInput && !isDatesInput && !isSearchContainer) {
            searchContainer.classList.remove('active'); //here
        }

    });




    //END SEARCH UI ---------------------------------------------------------------------------------

    //SEARCH UI MOBILE ---------------------------------------------------------------------------------



    mobileSearchBackButton.addEventListener('click', () => {
        mobileSearchDatesContainer.classList.remove('active');
        overlayCta.classList.remove('active');
        destinationInput.focus();
    });





    //Mobile Rearrangement ---------------------
    const homeFullSearchDestinationTop = document.querySelector('.home-full-search__destination__top');
    const homeFullSearchDestination = document.querySelector('.home-full-search__destination');

    const mobileSearchDatesTop = document.querySelector('.home-full-search__dates__top');

    //move elements -- initial
    if ($(window).width() < 1000) {
        homeFullSearchDestinationTop.appendChild(destinationInput);
        homeFullSearchDestinationTop.appendChild(destinationInputClear);

        homeFullSearchDestination.appendChild(destinationList);
        mobileSearchDatesTop.appendChild(datesInput);
        mobileSearchDatesContainer.appendChild(datesList);
    }


    //move elements -- on resize
    $(window).resize(function () {
        if ($(window).width() < 1000) { //mobile view    

            if (homeFullSearchDestinationTop.contains(destinationInput) == false) {
                homeFullSearchDestinationTop.appendChild(destinationInput);
                homeFullSearchDestinationTop.appendChild(destinationInputClear);
                homeFullSearchDestination.appendChild(destinationList);
                mobileSearchDatesTop.appendChild(datesInput);
                mobileSearchDatesContainer.appendChild(datesList);
            }

        }
        else { //desktop view    
            hideMobileFilters();

            if (searchContainer.contains(destinationInput) == false) {
                destinationInputContainer.appendChild(destinationInput);
                destinationInputContainer.appendChild(destinationInputClear);
                destinationInputContainer.appendChild(destinationList);
                datesInputContainer.appendChild(datesInput);
                datesInputContainer.appendChild(datesList);
            }

        }
    });


    const body = document.querySelector('body');
    const overlay = document.querySelector('.home-full-search');
    const overlayCta = document.querySelector('.home-full-search-cta');


    //Mobile search button
    $('#mobile-search-button').click(function (event) {

        showMobileFilters();

    })

    //Mobile search close
    $('#mobile-search-close').click(function (event) {

        hideMobileFilters();

    })


    function hideMobileFilters() {
        body.classList.remove('lock-scroll');
        overlay.classList.remove('active');
        overlayCta.classList.remove('active');

        mobileSearchDatesContainer.classList.remove('active');

    }

    function showMobileFilters() {
        body.classList.add('lock-scroll');
        overlay.classList.add('active');
        destinationInput.focus();
    }



});



