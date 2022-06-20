jQuery(document).ready(function ($) {
  const templateUrl = page_vars.templateUrl;
  var currentYear = new Date().getFullYear();
  var body = $('body');


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


  //Activare Price Notes
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



  //ITINERARIES --------------------------------
  //Itinerary Info Tabs - Overview / Inclusions / Exclusions
  const tabArray = [...document.querySelectorAll('.product-itinerary-slide__top__side-info__tabs__item')];
  tabArray.forEach(item => {
    item.addEventListener('click', () => {
      let itineraryTab = item.getAttribute("itinerary-tab");
      let tabType = item.getAttribute("tab-type");

      //content panes
      let tabPanes = [...document.querySelectorAll('.product-itinerary-slide__top__side-info__content[itinerary-tab="' + itineraryTab + '"]')];
      tabPanes.forEach((x) => {
        x.classList.remove('current');
      });

      tabPanes.forEach((x) => {
        if (x.getAttribute('tab-type') == tabType) {
          x.classList.add('current')
        }
      });

      //tabs nav
      let tabNavs = [...document.querySelectorAll('.product-itinerary-slide__top__side-info__tabs__item[itinerary-tab="' + itineraryTab + '"]')];
      tabNavs.forEach((x) => {
        x.classList.remove('current');
      });

      tabNavs.forEach((x) => {
        if (x.getAttribute('tab-type') == tabType) {
          x.classList.add('current')
        }
      });

    });
  })

  //Days slider (must initialize first - for height)
  $('.product-itinerary-slide__bottom__days').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    fade: true,
    focusOnSelect: true,
    arrows: true,
    dots: true,
    swipe: true,
    draggable: false,
    swipeToSlide: true,
    prevArrow: '<button class="product-itinerary-slide__bottom__days__btn product-itinerary-slide__bottom__days__btn--left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
    nextArrow: '<button class="product-itinerary-slide__bottom__days__btn product-itinerary-slide__bottom__days__btn--right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
    customPaging: function (slider, i) {
      return '<a class="dot">' + (i + 1) + '</a>';
    },

    responsive: [
      {
        breakpoint: 800,
        settings: {
          dots: false
        }
      }
    ]
  }).on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
    $('#itineraries-slider').slick("setOption", '', '', true);
    var currentCounter = $(this).next();

    var i = (currentSlide ? currentSlide : 0) + 1;
    currentCounter.text(i + ' / ' + slick.slideCount);
  });

  //Itinerary Slider
  $('#itineraries-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    draggable: false,
    swipe: false,
    swipeToSlide: false,
    centerMode: true,
    adaptiveHeight: true,
  });

  //Itinerary Slider Nav
  $('#itineraries-slider-nav').on('init', function (event, slick) {
    var counterDiv = $('#itineraries-slider-counter');
    counterDiv.text('1 / ' + slick.slideCount); //set count div
    if (slick.slideCount < 2) { //if one slide, remove padding for nav arrows
      $('.product-itineraries__nav__slider').css("padding-right", 0);
    }
  }).slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '#itineraries-slider',
    dots: false,

    focusOnSelect: true,

    arrows: true,
    prevArrow: '<button class="product-itineraries__nav__slider__btn product-itineraries__nav__slider__btn--left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
    nextArrow: '<button class="product-itineraries__nav__slider__btn product-itineraries__nav__slider__btn--right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,

        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,

        }
      }
    ]
  }).on('click', function (event, slick, currentSlide, nextSlide) {
  }).on('afterChange', function (event, slick, currentSlide, nextSlide) {
    var counterDiv = $('#itineraries-slider-counter');

    // const params = new URLSearchParams(location.search);
    // params.set('i', currentSlide);
    // var anchor = window.location.hash;
    // if (anchor == '') {
    //   window.history.replaceState({}, '', `${location.pathname}?${params}#itineraries`);
    // } else {
    //   window.history.replaceState({}, '', `${location.pathname}?${params}${anchor}`);
    // }


    var i = (currentSlide ? currentSlide : 0) + 1;
    counterDiv.text(i + ' / ' + slick.slideCount);
    $('.side-info-panel[tab-type="all"').show();
    $('.side-info-panel[tab-type="dates"').hide();
  });





  //Go to specific itinerary slide (starts at 0) -- BUG on back button
  //FIX -- use pageshow: will not fire if using back/reloading
  window.addEventListener('pageshow', function () {
    var urlString = window.location.href;
    var url = new URL(urlString);
    var itinerarySlideFromUrl = url.searchParams.get("i");


    console.log('pageshow')
    if (itinerarySlideFromUrl != null) {
      itinerarySlideFromUrl = Number.parseInt(itinerarySlideFromUrl) - 1;
      console.log(itinerarySlideFromUrl);
      $('#itineraries-slider-nav').slick('slickGoTo', itinerarySlideFromUrl)
    }

  })





  // Read More
  $("#readmore-button").click(function (e) {
    // record if our text is expanded
    var isExpanded = $(e.target).parent().hasClass("expand");

    //close all open paragraphs
    $(".product-overview__content.expand").removeClass("expand");
    $("#readmore-button").parent().removeClass("expand");

    // if target wasn't expand, then expand it
    if (!isExpanded) {
      $('.product-overview__content').addClass("expand");
      $(e.target).parent().addClass("expand");
      $(e.target).text("Read Less");
    } else {
      $(e.target).text("Read More");


      //var overviewContentDiv = $(".product-overview__content");

      var target = $(".product-overview__content").offset().top;

      $('html, body').animate({ scrollTop: target }, 0);

    }
  });




  //Date Grid
  const dateGridItems = [...document.querySelectorAll('.date-grid__item--available')];
  dateGridItems.forEach(item => {
    item.addEventListener('click', () => {
      selectedYear = item.getAttribute("departure-year");
      selectedMonth = item.getAttribute("departure-month");
      itineraryTab = item.getAttribute("itinerary-tab");
      itineraryId = item.getAttribute("itinerary-id");

      var formattedMonth = moment(selectedMonth, 'MM').format('MMMM')
      $('.side-info-panel__top__month').text(formattedMonth + ", " + selectedYear);

      $('.side-info-panel[itinerary-tab="' + itineraryTab + '"][tab-type="all"').hide();
      $('.side-info-panel[itinerary-tab="' + itineraryTab + '"][tab-type="dates"').show();

      $('#form-itinerary').val(itineraryId);
      $('#form-month').val(selectedMonth);
      $('#form-year').val(selectedYear);

      //$('#testfield').val('js-test');

      //console.log('xxx');
      reloadResults();
      // $('#search-form').submit(function (event) {
      //   event.preventDefault();
      //   //reloadResults();
      //   return false;
      // });
    });
  })

  const closeButtons = [...document.querySelectorAll('.side-info-panel__top__close-button')];
  closeButtons.forEach(item => {
    item.addEventListener('click', () => {

      $('.side-info-panel[tab-type="dates"').hide();
      $('.side-info-panel[tab-type="all"').show();

    });
  })

  //Date and Price Grid Time Config
  //display Itinerary Side Info for current year only
  $('.date-grid').hide();
  $('.date-grid__' + currentYear).show();

  $('.price-grid').hide();
  $('.price-grid__' + currentYear).show();


  //Season
  $('.season-select').select2({
    width: '100%',
    minimumResultsForSearch: -1
  });

  //Price / Availability
  $('.itinerary-year-select').select2({
    width: '100%',
    minimumResultsForSearch: -1
  });

  //Itinerary Year Select on Side Details - Show Hide Date / Price Grids for selected year
  $('.itinerary-year-select').on('change', function () {
    var year = $(this).val();
    //var tab_id = $(this).attr('data-tab');
    $('.itinerary-year-select').val(year).trigger('change.select2'); //set value without triggering change

    $('.date-grid').hide();
    $('.date-grid__' + year).show();

    $('.price-grid').hide();
    $('.price-grid__' + year).show();

  });

  //season-select
  $('.season-select').on('change', function () {
    var season = $(this).val();
    //var tab_id = $(this).attr('itinerary-tab');
    $('.season-select').val(season).trigger('change.select2'); //set value without triggering change

    $('.season-panel').hide();
    $('.season-panel[data-tab="' + season + '"]').show();
  });


  //Cruise Date Search
  function reloadResults() {
    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('.side-info-panel__departure-grid').html('<div class="product-dates__search-area__results__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
      },
      success: function (data) {
        $('.side-info-panel__departure-grid').html(data); // insert data


        const buttonArray = [...document.querySelectorAll('.departure-cta-button')];

        //add click event handler to each Inquire Button
        buttonArray.forEach(item => {
          item.addEventListener('click', () => {
            var body = $('body');
            var contactModal = document.getElementById("contactModal");
            var departureFormText = document.getElementById("contactModalDepartureText"); //Departure Specific inqure form

            body.addClass('no-scroll');
            contactModal.style.display = "flex";
            departureFormText.style.display = "block"; //Show departure date div

            var departureDate = item.getAttribute('departureDate');
            var itineraryNights = item.getAttribute('itineraryNights');
            var formattedDate = moment(departureDate).format('MMMM D, YYYY')
            var formattedName = (+itineraryNights + 1) + 'D/' + (+itineraryNights) + 'N';

            departureFormText.textContent = formattedName + " Departing: " + formattedDate;

            //form-departure-date
            const hiddenField = document.querySelector('.form-departure-date input');
            hiddenField.value = formattedName + " - " + formattedDate;
          });
        })

      }
    });
  }


  //SLIDERS ---------------------------
  //Flickity - Cabins images
  $('.product-cabins__cabin__image-area.dfproperty').flickity({
    prevNextButtons: true,
    pageDots: false,
    fade: true,
    lazyLoad: 2, //preload one over
    imagesLoaded: true,
  })


  //Slick Sliders --------------------------------------------
  //Product gallery, social area, Reviews, Related,

  //Product Gallery
  $('#product-gallery').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    lazyLoad: 'ondemand',
    initialSlide: 0,
    focusOnSelect: true,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-circle--small btn-circle--noborder btn-circle--left product-hero__gallery__slick__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-circle--noborder btn-circle--right product-hero__gallery__slick__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1375,
        settings: {
          slidesToShow: 2,


        }
      }
    ],
  });

  //Areas Slider (must select class for chained sliders)
  $('.product-areas__slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    centerMode: true,
    asNavFor: '.product-areas__slider-nav',
    focusOnSelect: true,
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
  $('.product-areas__slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.product-areas__slider',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    variableWidth: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,

        }
      }
    ]
  });

  //Reviews Slider
  $('#reviews-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-circle--white btn-circle--noborder btn-circle--small  btn-circle--left product-reviews__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--white btn-circle--noborder btn-circle--small  btn-circle--right product-reviews__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',

    lazyLoad: 'ondemand',
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

  //Related Products Slider
  $('#related-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    initialSlide: 0,

    arrows: true,
    dots: false,
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-related__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-related__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
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
          arrows: false,
          centerMode: true,
        }
      }
    ]
  });


  //Hotels Slider (Tours) (must initialize before tab nav functions for position init)
  $('#hotels-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-hotels__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-hotels__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
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

  //deals-indicator
  $('#deals-slider').on('init', function (event, slick) {
    var dealCounter = $('#deals-indicator');
    dealCounter.text('1 / ' + slick.slideCount); //set count div

  }).slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-white btn-circle--left btn-circle--large deals-slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-white btn-circle--right btn-circle--large deals-slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [

      {
        breakpoint: 800,
        settings: {
          slidesToShow: 1,
          arrows: false,
          centerMode: true
        }
      },
    ]

  }).on('afterChange', function (event, slick, currentSlide, nextSlide) {
    var dealCounter = $('#deals-indicator');


    var i = (currentSlide ? currentSlide : 0) + 1;
    dealCounter.text(i + ' / ' + slick.slideCount);

  });









  //Magnific Popups ---------------------------------------------------------------------------
  //Product Gallery, Itinerary Maps, Deckplans
  //Gallery
  $('#product-gallery').magnificPopup({
    delegate: '.slick-slide:not(.slick-cloned) .product-hero__gallery__slick__item a',
    type: 'image',
    navigateByImgClick: true,
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1] // Will preload 0 - before current, and 1 after 
    }
  });

  $('#gallery-expand-button').on('click', function () {

    var gallery = $('#product-gallery');

    $(gallery).magnificPopup({
      delegate: '.slick-slide:not(.slick-cloned) .product-hero__gallery__slick__item a',
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


});
