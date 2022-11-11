jQuery(document).ready(function ($) {
  const itineraryObjects = page_vars_product_itinerary_days.itineraryObjects;
  const templateUrl = page_vars_product_itinerary_days.templateUrl;

  let destinationPoints = itineraryObjects[0].destinationPoints;
  let destinationLines = itineraryObjects[0].destinationLines;

  // var root = am5.Root.new("itinerary-map");
  // root.setThemes([am5themes_Animated.new(root), am5themes_Dark.new(root)]);
  // var chart = root.container.children.push(
  //   am5map.MapChart.new(root, {
  //     panX: "translateX",
  //     panY: "translateY",
  //     wheelY: "none",
  //     projection: am5map.geoMercator(),
  //     homeZoomLevel: 10,
  //     homeGeoPoint: { longitude: -65, latitude: -60 }, //lat = Y, long = X
  //     rotationY: 50, //80
  //     rotationX: 35,
  //     maxPanOut: .4,
  //     minZoomLevel: 5,
  //     maxZoomLevel: 15

  //   })
  // );

  // var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
  // backgroundSeries.mapPolygons.template.setAll({
  //   fill: root.interfaceColors.get("alternativeBackground"),
  //   fillOpacity: 0,
  //   strokeOpacity: 0
  // });
  // backgroundSeries.data.push({
  //   geometry: am5map.getGeoRectangle(90, 180, -90, -180)
  // });
  // var polygonSeries = chart.series.push(
  //   am5map.MapPolygonSeries.new(root, {
  //     geoJSON: am5geodata_worldLow
  //   })
  // );
  // polygonSeries.events.on("datavalidated", function () {
  //   chart.goHome();
  // });
  // // graticule series
  // var graticuleSeries = chart.series.push(am5map.GraticuleSeries.new(root, {}));
  // graticuleSeries.mapLines.template.setAll({
  //   //stroke: root.interfaceColors.get("alternativeBackground"),
  //   strokeOpacity: 0.2
  // });


  // var lineSeries = chart.series.push(am5map.MapLineSeries.new(root, {}));
  // lineSeries.mapLines.template.setAll({
  //   stroke: root.interfaceColors.get("alternativeBackground"),
  //   strokeOpacity: 0.3
  // });


  // var pointSeries = chart.series.push(
  //   am5map.MapPointSeries.new(root, { idField: "postid" })
  // );

  // pointSeries.bullets.push(function () {
  //   var circle = am5.Circle.new(root, {
  //     radius: 6,
  //     tooltipY: 0,
  //     fill: am5.color(0xeeeeee),
  //     stroke: root.interfaceColors.get("background"),
  //     strokeWidth: 2,
  //     tooltipText: "{title}",
  //     cursorOverStyle: "pointer"
  //   });


  //   return am5.Bullet.new(root, {
  //     sprite: circle
  //   });
  // });

  // chart.set("zoomControl", am5map.ZoomControl.new(root, {}));

  // pointSeries.data.setAll(destinationPoints);
  // lineSeries.data.setAll(destinationLines);
  // lineSeries.mapLines.template.setAll({
  //   stroke: am5.color(0xd9a402),
  //   strokeWidth: 2,
  //   strokeOpacity: 0.5
  // });

  // chart.appear(1000, 100);



  // const body = document.getElementById("body");

  // //Inquire
  // const inquireCtaButtons = [...document.querySelectorAll('.inquire-cta')];
  // const inquireModal = document.getElementById("inquireModal");
  // inquireCtaButtons.forEach(item => {
  //     item.addEventListener('click', () => {
  //         inquireModal.style.display = 'flex';
  //         body.classList.add('no-scroll');
  //     });
  // })




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






  // Itinerary Day Modal
  const itineraryDaysModal = document.querySelector("#itineraryDaysModal");
  const itineraryDaysModalMainContent = document.querySelector("#itineraryDaysModalMainContent");

  const dayExpandTextButtons = [...document.querySelectorAll('.itinerary-day-expand')];
  if (dayExpandTextButtons) {
    dayExpandTextButtons.forEach(item => {
      item.addEventListener('click', () => {

   

        itineraryDaysModal.style.display = 'flex';
        body.classList.add('no-scroll');

        const section = item.getAttribute('day-section');
        const modalDivSectionOffset = document.getElementById(section).offsetTop;
        document.querySelector("#itineraryDaysModalMainContent").scrollTop = modalDivSectionOffset - 150;

      });
    })
  }




});
