jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;

    $(window).scroll(function(e){
        parallax();
      });
      function parallax(){
        var scrolled = $(window).scrollTop();
        $('.hero').css('top',-(scrolled*0.0315)+'rem');
        $('.hero > h1').css('top',-(scrolled*-0.005)+'rem');
        $('.hero > h1').css('opacity',1-(scrolled*.00175));
      };

      

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


    //Content
    //-- Deals, Experiences, Landmarks, Cruises, Itineraries


    //Newest Cruises Slider
    $('#newest-cruises-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,

        arrows: true,
        prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
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

                }
            }
        ]
    });
    //destinations slider
    $('#destinations-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,

        arrows: true,
        prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,

                }
            }
        ]
    });


    const swiper = new Swiper('#itineraries-slider', {
        // Optional parameters
        loop: true,
        spaceBetween: 15,
        slidesPerView: 1,
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-custom__next',
          prevEl: '.swiper-button-custom__prev',
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

    
});



