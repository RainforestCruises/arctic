
jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;


    //Contact
    var $body = $('body');



    //Flickity
    var flickitySlider = new Flickity('.category-hero__bg-slider', {
        prevNextButtons: false,
        pageDots: false,
        fade: true,
        lazyLoad: true,
        selectedAttraction: 0.01,
        friction: 0.15
        // options
    });

    //location slider
    counter = new Odometer({
        el: document.querySelector("#odometer"),
        minIntegerLen: 2,
        duration: 200,
        value: 1
    });
    //--
    $('#category-hero__content__location__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        //asNavFor: '#category-hero__bg-slider',
        centerMode: false,
        arrows: true,
        draggable: false,
        fade: true,
        speed: 1800,
        //lazyLoad: 'ondemand',
        prevArrow: '<button class="btn-circle btn-circle--small   btn-white btn-circle--left category-hero__content__location__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-circle--small  btn-white btn-circle--right category-hero__content__location__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    prevArrow: '<button class="btn-circle btn-circle--noborder    btn-white btn-circle--left category-hero__content__location__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
                    nextArrow: '<button class="btn-circle btn-circle--noborder  btn-white btn-circle--right category-hero__content__location__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
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

    $slick = $('.category-hero__content__location__slider');
    $bar = $('.category-hero__content__location__progress__bar .progress');

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
    $('.category-hero__content__location__slider .slick-arrow').click(function () {

        startProgressbar();
    });
    //end progress





    $('#testimonials-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: true,
        arrows: false,
    });

    //faq expand/hide
    $(".category-faq__group__question").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.category-faq__group__answer').slideToggle(350);
        $this.parent().find('.plus-minus-toggle').toggleClass('plus-collapsed');
        $this.parent().find('.category-faq__group__question').toggleClass('category-faq__group__question--active');

    });





    //cruises image area
    new Swiper('.ship-card-image-area', {
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


    const itinerariesSlider = new Swiper('#itineraries-slider', {
        // Optional parameters
        loop: false,
        spaceBetween: 15,
        slidesPerView: 1,
        // Navigation arrows
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
