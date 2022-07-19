jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;
    var currentYear = new Date().getFullYear();
    var body = $('body');

    //Panels --------------------------------------------
    //expand/hide
    $(".outline-panel__heading").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.outline-panel__content').slideToggle(350);
        $this.parent().find('.outline-panel__heading').toggleClass('closed');
    });




    //Slick Sliders --------------------------------------------
    //--Hero Gallery
    $('#hero-gallery').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        lazyLoad: 'ondemand',
        initialSlide: 0,
        focusOnSelect: true,
        arrows: true,
        prevArrow: '<button class="btn-scroll-overlay btn-scroll-overlay--left btn-gallery-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll-overlay btn-gallery-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1375,
                settings: {
                    slidesToShow: 2,


                }
            }
        ],
    });


    //Cabins Slider
    $('#cabins-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
        prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //cabin image sliders
    $('.resource-card__image-area').slick({
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: 'ondemand',
        focusOnSelect: true,
        draggable: false,
        dots: true,
        prevArrow: '<button class="btn-scroll-overlay btn-scroll-overlay--left resource-card__image-area__btn-left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll-overlay resource-card__image-area__btn-right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        
    });



    //itineraries-slider
    $('#itineraries-slider, #extras-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //related
    $('#related-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });


    //departures slider
    $('#departures-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 6,
        infinite: false,
        arrows: true,
        prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,

                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            }
        ]
    });


    //departure filter
    $(".departure-filter").on('click', function () {
        var filter = $(this).data('filter');
        var currentYear = new Date().getFullYear();

        $(".departure-filter").removeClass('active');
        $(this).addClass('active');
        $("#departures-slider").slick('slickUnfilter');

        if (filter == currentYear) {
            $("#departures-slider").slick('slickFilter', 'div:contains("' + (currentYear) + '")');
        }
        else if (filter == (currentYear + 1)) {
            $("#departures-slider").slick('slickFilter', 'div:contains("' + (currentYear + 1) + '")');
        }
        else if (filter == (currentYear + 2)) {
            $("#departures-slider").slick('slickFilter', 'div:contains("' + (currentYear + 2) + '")');
        }
        else if (filter == 'all') {

            $("#departures-slider").slick('slickUnfilter');
        }

    })




    //Magnific Popups ---------------------------------------------------------------------------
    //--Product Gallery
    $('#product-gallery').magnificPopup({
        delegate: '.slick-slide:not(.slick-cloned) .product-hero__content__gallery__slick__item a',
        type: 'image',
        navigateByImgClick: true,
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after 
        }
    });
    //--Product Gallery Mobile
    $('#gallery-expand-button').on('click', function () {
        var gallery = $('#product-gallery');

        $(gallery).magnificPopup({
            delegate: '.slick-slide:not(.slick-cloned) .product-hero__content__gallery__slick__item a',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after 
            }
        }).magnificPopup('open');
    });

    //Itinerary Map
    $('.itinerary-map-image').magnificPopup({
        type: 'image',
    });
    //deckplan
    $('#deckplan-image').magnificPopup({
        type: 'image',
    });














    
    //MODALS ---------------------
    //Contact Modal (generic)
    var contactModal = document.getElementById("contactModal");
    var departureFormText = document.getElementById("contactModalDepartureText");

    var dealsModal = document.getElementById("dealsModal");


    //Deals Slider
    $('.deal-modal-cta-button').on('click', () => {
        dealsModal.classList.add('active');
        $('#deals-slider')[0].slick.setPosition()
    });

    //Activate contact modal (generic)
    $('#nav-secondary-cta, #nav-page-cta').on('click', () => {
        body.addClass('no-scroll');
        contactModal.style.display = "flex";
        departureFormText.style.display = "none"; //not departure specific
    });


    //Price Notes Modal
    var priceNotesModal = document.getElementById("page-modal");


    //Activate Price Notes
    const priceNoteButtons = [...document.querySelectorAll('.price-notes')];
    priceNoteButtons.forEach(item => {
        item.addEventListener('click', () => {
            body.addClass('no-scroll');
            priceNotesModal.classList.add('active');
        });
    })

    //Notification Modal (doesnt need open)
    var notificationModal = document.getElementById("notification-modal");

    //Close modals
    //Buttons
    $('.close-button, #notification-close-cta').on('click', () => {
        contactModal.style.display = "none";
        body.removeClass('no-scroll');
        if (priceNotesModal) {
            priceNotesModal.classList.remove('active');
        }
        if (notificationModal) {
            notificationModal.classList.remove('active');
        }
    });


    //Background Click
    window.onclick = function (event) { //trigger by background click
        if (event.target == contactModal) {
            contactModal.style.display = "none";
            body.removeClass('no-scroll');
        }
        if (event.target == priceNotesModal) {
            priceNotesModal.classList.remove('active');
            body.removeClass('no-scroll');
        }
        if (event.target == notificationModal) {
            notificationModal.classList.remove('active');
            body.removeClass('no-scroll');
        }

        if (event.target == dealsModal) {
            dealsModal.classList.remove('active');
            body.removeClass('no-scroll');
        }
    }



});
