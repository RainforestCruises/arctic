jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;
    var currentYear = new Date().getFullYear();
    //var body = $('body');



    //Panels --------------------------------------------
    //expand/hide
    $(".outline-panel__heading").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.outline-panel__content').slideToggle(350);
        $this.parent().find('.outline-panel__heading').toggleClass('closed');
    });



    // Swiper Sliders -------------------
    // hero desktop
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

    // hero mobile
    const heroMobileSlider = new Swiper('#hero-mobile-slider', {
        loop: true,
        draggable: true,
        slidesPerView: 1,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    const counter = document.querySelector('.cruise-hero__bg-slider__count');
    heroMobileSlider.on('slideChange', function (swiper) {
        counter.innerHTML = (swiper.realIndex + 1) + ' / ' + (swiper.slides.length - 2);
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







    //MODALS ---------------------
    const body = document.getElementById("body");

    //Inquire
    const inquireCtaButtons = [...document.querySelectorAll('.inquire-cta')];
    const inquireModal = document.getElementById("inquireModal");
    inquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    })

    //Hero Gallery
    const heroGalleryImages = [...document.querySelectorAll('.cruise-hero__gallery__slider__item')];
    const cruiseGalleryModal = document.getElementById("cruiseGalleryModal");
    heroGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            cruiseGalleryModal.style.display = 'flex';      
            body.classList.add('no-scroll');
        });
    })



 
    // Generic Close Modals (move to global) ------------------------------
    const closeModalButtons = [...document.querySelectorAll('.close-modal-button')]; 
    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            closeModals();          
        });
    })

    const allModals = [...document.querySelectorAll('.modal')];
    window.onclick = function (event) { 
        allModals.forEach(modal => {
            if (event.target == modal) {
                closeModals();
            }
        })
    }

    function closeModals() {
        allModals.forEach(modal => {
            modal.style.display = 'none';
        })
        body.classList.remove('no-scroll');
    }


});
