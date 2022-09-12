 
jQuery(document).ready(function ($) {

    var templateUrl = "";



    //itineraries-slider
    // $('#itineraries-slider, #extras-slider').slick({
    //     slidesToShow: 2,
    //     slidesToScroll: 1,
    //     infinite: true,
    //     arrows: true,
    //     prevArrow: '<button class="btn-scroll btn-scroll--left btn-slider-top__left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    //     nextArrow: '<button class="btn-scroll btn-slider-top__right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    //     responsive: [
    //         {
    //             breakpoint: 600,
    //             settings: {
    //                 slidesToShow: 1,
    //             }
    //         }
    //     ]
    // });

 

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


});



