
jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;


    //Contact
    var $body = $('body');

    $('.close-button').on('click', () => {
        $('.popup').removeClass('active');
        $body.removeClass('no-scroll');
    });

    document.addEventListener('click', evt => {
        const contactForm = document.querySelector('.contact');
        const popup = document.querySelector('.popup');
        const button = document.querySelector('#nav-secondary-cta');

        const isContact = contactForm.contains(evt.target);
        const isButton = button.contains(evt.target);
        const isActive = popup.classList.contains('active');
        if (isActive) {
            if (!isContact && !isButton) {
                $('.popup').toggleClass('active');
                $body.removeClass('no-scroll');
            }
        }

    });

    $('#nav-secondary-cta').on('click', () => {
        $('.popup').addClass('active');
        $body.addClass('no-scroll');
    });

    $('.form-general').on('submit', function () {
        $('.contact__wrapper__intro__title').text('Thank You');
        $('.contact__wrapper__intro__introtext').hide();
        console.log('submitted');
    });

    // //SLIDERS
    // $('#destination-hero__bg-slider').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: false,
    //     centerMode: false,
    //     draggable: false,
    //     fade: true,
    //     arrows: false,
    //     speed: 1800,
    //     lazyLoad: 'ondemand',
    //     responsive: [
    //         {
    //             breakpoint: 1000,
    //             settings: {
    //                 speed: 800,
    //             }
    //         },
    //     ]
    // });



    //Flickity
    var flickitySlider = new Flickity('.destination-hero__bg-slider', {
        prevNextButtons: false,
        pageDots: false,
        fade: true,
        lazyLoad: true,
        selectedAttraction: 0.01,
        friction: 0.15
        // options
    });



    // //Flickity Nav
    // var flickitySliderNav = new Flickity('.destination-hero__content__location__slider', {
    //     prevNextButtons: true,
    //     pageDots: false,
    //     selectedAttraction: 0.01,
    //     friction: 0.15,
    //     fade: true,
    //     //lazyLoad: true,
    //     asNavFor: '.destination-hero__bg-slider'
    //     // options
    // });

    // $(".destination-hero__content__location__slider .next").on("click", function () {
    //     // Changing items of the main div
    //     flickitySlider.next();
    // });
    // $(".destination-hero__content__location__slider .previous").on("click", function () {
    //     // Changing items of the main div
    //     flickitySlider.previous();
    // });

    //location slider
    counter = new Odometer({
        el: document.querySelector("#odometer"),
        minIntegerLen: 2,
        duration: 200,
        value: 1
    });
    //--
    $('#destination-hero__content__location__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        //asNavFor: '#destination-hero__bg-slider',
        centerMode: false,
        arrows: true,
        draggable: false,
        fade: true,
        speed: 1800,
        //lazyLoad: 'ondemand',
        prevArrow: '<button class="btn-circle btn-circle--small   btn-white btn-circle--left destination-hero__content__location__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-circle--small  btn-white btn-circle--right destination-hero__content__location__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    prevArrow: '<button class="btn-circle btn-circle--noborder    btn-white btn-circle--left destination-hero__content__location__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
                    nextArrow: '<button class="btn-circle btn-circle--noborder  btn-white btn-circle--right destination-hero__content__location__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
                    speed: 800,
                }
            },
        ]
    }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var num = (nextSlide + 1);

        flickitySlider.select(nextSlide);
        setTimeout(function () {
            counter.update(num);
        }, 0);
    });



    //progress
    var time = 2;
    var $bar,
        $slick,
        isPause,
        tick,
        percentTime;

    $slick = $('.destination-hero__content__location__slider');
    $bar = $('.destination-hero__content__location__progress__bar .progress');

    const heroLinks = [...document.querySelectorAll('.hero-link')];
    heroLinks.forEach(item => {
        item.addEventListener('click', () => {
            isPause = true;

        });
    })

    function startProgressbar() {
        resetProgressbar();
        percentTime = 0;
        isPause = false;
        tick = setInterval(interval, 60); //dictates speed
    }

    function interval() {
        if (isPause === false) {
            percentTime += 1 / (time + 0.1);
            $bar.css({
                width: percentTime + "%"
            });
            if (percentTime >= 100) {
                $slick.slick('slickNext');
                startProgressbar();
            }
        }
    }

    function resetProgressbar() {
        $bar.css({
            width: 0 + '%'
        });
        clearTimeout(tick);
    }

    startProgressbar();
    $('.destination-hero__content__location__slider .slick-arrow').click(function () {

        startProgressbar();
    });
    //end progress



    $('#main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: true,
        prevArrow: '<button class="btn-circle btn-white btn-circle--left btn-circle--large destination-main__packages__best-selling__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-white btn-circle--right btn-circle--large destination-main__packages__best-selling__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    arrows: false,
                }
            },
        ]
    });




    $('#secondary-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left product-related__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right product-related__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    centerMode: true

                }
            },

        ]
    });


    $('#lodges-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left product-related__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right product-related__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    centerMode: true

                }
            },

        ]
    });


    $('#testimonials-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: true,
        arrows: false,
    });

    //faq expand/hide
    $(".destination-faq__grid-container__faq__question").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.destination-faq__grid-container__faq__answer').slideToggle(350);
        $this.parent().find('.plus-minus-toggle').toggleClass('plus-collapsed');
        $this.parent().find('.destination-faq__grid-container__faq__question').toggleClass('destination-faq__grid-container__faq__question--active');

    });


});
