jQuery(document).ready(function ($) {



    // //SLIDERS
    // //SLICK
    // $('#test-hero__bg').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: true,
    //     //centerMode: false,
    //     //draggable: true,
    //     fade: false,
    //     arrows: false,
    //     speed: 0,
    //     lazyLoad: 'ondemand',
    //     waitForAnimate: false,

    // });

    ////OWL
    // $(document).ready(function () {
    //     $("#test-hero__bg").owlCarousel(
    //         {
               
    //             nav: true,
    //             items: 1,
    //             lazyLoad: true,
    //             navigation: true,
    //             navigationText: ["", ""],
    //             slideSpeed: 300,
    //             paginationSpeed: 400,
    //             autoPlay: true,
        
    //             animateOut: 'fadeOut'
    //         }
    //     );
    // });

    //Flickity
    var slider = new Flickity( '.test-hero__bg', {
        fade: true,
        lazyLoad: true,
        // options
      });


});



