jQuery(document).ready(function ($) {
  const templateUrl = page_vars_itinerary.templateUrl;
  const destinationPoints = page_vars_itinerary.destinationPoints;
  const destinationLines = page_vars_itinerary.destinationLines;

  var root = am5.Root.new("itinerary-map");
  root.setThemes([am5themes_Animated.new(root), am5themes_Dark.new(root)]);
  var chart = root.container.children.push(
    am5map.MapChart.new(root, {
      panX: "translateX",
      panY: "translateY",
      wheelY: "none",
      projection: am5map.geoMercator(),
      homeZoomLevel: 10,
      homeGeoPoint: { longitude: -65, latitude: -60 }, //lat = Y, long = X
      rotationY: 50, //80
      rotationX: 35,
      maxPanOut: .4,
      minZoomLevel: 5,
      maxZoomLevel: 15

    })
  );

  var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
  backgroundSeries.mapPolygons.template.setAll({
    fill: root.interfaceColors.get("alternativeBackground"),
    fillOpacity: 0,
    strokeOpacity: 0
  });
  backgroundSeries.data.push({
    geometry: am5map.getGeoRectangle(90, 180, -90, -180)
  });
  var polygonSeries = chart.series.push(
    am5map.MapPolygonSeries.new(root, {
      geoJSON: am5geodata_worldLow
    })
  );
  polygonSeries.events.on("datavalidated", function () {
    chart.goHome();
  });
  // graticule series
  var graticuleSeries = chart.series.push(am5map.GraticuleSeries.new(root, {}));
  graticuleSeries.mapLines.template.setAll({
    //stroke: root.interfaceColors.get("alternativeBackground"),
    strokeOpacity: 0.2
  });


  var lineSeries = chart.series.push(am5map.MapLineSeries.new(root, {}));
  lineSeries.mapLines.template.setAll({
    stroke: root.interfaceColors.get("alternativeBackground"),
    strokeOpacity: 0.3
  });


  var pointSeries = chart.series.push(
    am5map.MapPointSeries.new(root, { idField: "postid" })
  );

  pointSeries.bullets.push(function () {
    var circle = am5.Circle.new(root, {
      radius: 6,
      tooltipY: 0,
      fill: am5.color(0xeeeeee),
      stroke: root.interfaceColors.get("background"),
      strokeWidth: 2,
      tooltipText: "{title}",
      cursorOverStyle: "pointer"
    });


    return am5.Bullet.new(root, {
      sprite: circle
    });
  });

  chart.set("zoomControl", am5map.ZoomControl.new(root, {}));

  pointSeries.data.setAll(destinationPoints);
  lineSeries.data.setAll(destinationLines);
  lineSeries.mapLines.template.setAll({
    stroke: am5.color(0xd9a402),
    strokeWidth: 2,
    strokeOpacity: 0.5
  });

  chart.appear(1000, 100);



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













  //Itinerary Days Slider
  $('#itinerary-main-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: false,
    adaptiveHeight: true,
    fade: true,
    focusOnSelect: true,
    arrows: true,
    dots: false,
    swipe: true,
    draggable: false,
    swipeToSlide: true,
    asNavFor: '#itinerary-nav-slider',
    prevArrow: '<button class="btn-scroll btn-scroll--left itinerary-days__content__layout__main__slider__btn-left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    nextArrow: '<button class="btn-scroll itinerary-days__content__layout__main__slider__btn-right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 800,
        settings: {
          dots: false
        }
      }
    ]
  })

  //Itinerary Side Nav Slider
  $('#itinerary-nav-slider').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    vertical: true,
    infinite: false,
    draggable: true,
    swipeToSlide: true,
    asNavFor: '#itinerary-main-slider',
    focusOnSelect: true,
    nextArrow: '<button class="btn-scroll btn-scroll--down itinerary-days__content__layout__side-nav__slider__btn-down"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    prevArrow: '<button class="btn-scroll btn-scroll--up itinerary-days__content__layout__side-nav__slider__btn-up"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 800,
        settings: {
          vertical: false,
          arrows: false,
          slidesToShow: 5,
        }
      },
      {
        breakpoint: 600,
        settings: {
          vertical: false,
          arrows: false,
          slidesToShow: 3,
        }
      }
    ]
  })

  //cabins 
  $('#cabins-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,

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

  //departures
  $('#departures-slider').slick({
    slidesToShow: 6,
    slidesToScroll: 6,

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
