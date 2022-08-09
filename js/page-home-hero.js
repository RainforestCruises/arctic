jQuery(document).ready(function ($) {
  const destinationPoints = page_vars.destinationPoints;

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var root = am5.Root.new("hero-map");

  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([am5themes_Animated.new(root), am5themes_Dark.new(root)]);

  // Create the map chart
  // https://www.amcharts.com/docs/v5/charts/map-chart/
  var chart = root.container.children.push(
    am5map.MapChart.new(root, {
      panX: "none",
      panY: "none",
      wheelY: "none",
      projection: am5map.geoOrthographic(),
      homeZoomLevel: 3,
      homeGeoPoint: { longitude: -65, latitude: -60 }, //lat = Y, long = X
      rotationY: 50, //80
      rotationX: 35,
      maxPanOut: 0.5

    })
  );



  // Create series for background fill
  // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
  var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
  backgroundSeries.mapPolygons.template.setAll({
    fill: root.interfaceColors.get("alternativeBackground"),
    fillOpacity: 0,
    strokeOpacity: 0
  });

  // Add background polygon
  // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
  backgroundSeries.data.push({
    geometry: am5map.getGeoRectangle(90, 180, -90, -180)
  });

  // Create main polygon series for countries
  // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
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
    stroke: root.interfaceColors.get("alternativeBackground"),
    strokeOpacity: 0.08
  });

  // Add a button to go back to continents view
  var homeButton = chart.children.push(am5.Button.new(root, {
    paddingTop: 10,
    paddingBottom: 10,
    x: am5.percent(95),
    y: am5.percent(90),
    position: "absolute",
    centerX: am5.percent(100),
    opacity: 0,
    interactiveChildren: false,
    icon: am5.Graphics.new(root, {
      svgPath: "M17.545 15.467l-3.779-3.779c0.57-0.935 0.898-2.035 0.898-3.21 0-3.417-2.961-6.377-6.378-6.377s-6.186 2.769-6.186 6.186c0 3.416 2.961 6.377 6.377 6.377 1.137 0 2.2-0.309 3.115-0.844l3.799 3.801c0.372 0.371 0.975 0.371 1.346 0l0.943-0.943c0.371-0.371 0.236-0.84-0.135-1.211zM4.004 8.287c0-2.366 1.917-4.283 4.282-4.283s4.474 2.107 4.474 4.474c0 2.365-1.918 4.283-4.283 4.283s-4.473-2.109-4.473-4.474z",
      fill: am5.color(0xffffff)
    })
  }));

  homeButton.events.on("click", function () {
    chart.goHome();
    flickitySlider.select(0);
    contentSlider.select(0);
    homeButton.hide();
    mapZoomed = false;
    heroContent.classList.remove('content-hidden');
    backButton.classList.remove('active');

  });


  // Create point series for markers
  // https://www.amcharts.com/docs/v5/charts/map-chart/map-point-series/
  var originSeries = chart.series.push(
    am5map.MapPointSeries.new(root, { idField: "postid" })
  );

  originSeries.bullets.push(function () {
    var circle = am5.Circle.new(root, {
      radius: 6,
      tooltipY: 0,
      fill: am5.color(0xeeeeee),
      stroke: root.interfaceColors.get("background"),
      strokeWidth: 2,
      tooltipText: "{title}",
      cursorOverStyle: "pointer"
    });

    circle.events.on("click", function (e) {
      selectOrigin(e.target.dataItem.get("id"));
      heroContent.classList.remove('content-hidden');
      checkDots();
    });

    return am5.Bullet.new(root, {
      sprite: circle
    });
  });


  originSeries.data.setAll(destinationPoints);


  //BG Slider
  var flickitySlider = new Flickity('.home-hero__bg', {
    prevNextButtons: false,
    pageDots: false,
    fade: true,
    //lazyLoad: true,
    imagesLoaded: true,
    selectedAttraction: 0.04,
    friction: 0.4
  });



  //resize
  $(window).resize(function () {
    flickitySlider.resize(); //hack
    checkDots();
  });




  var contentSlider = new Flickity('.home-hero__content__slider', {
    prevNextButtons: false,
    pageDots: false,
    fade: true,
    adaptiveHeight: true,
    selectedAttraction: 0.1,
    friction: 0.6,
    draggable: false,

  });







  function selectOrigin(id) {
    var dataItem = originSeries.getDataItemById(id);
    var dataContext = dataItem.dataContext;
    chart.zoomToGeoPoint(dataContext.zoomPoint, dataContext.zoomLevel, true);
    if ($(window).width() > 1000) {
      homeButton.show();
    }

    mapZoomed = true;

    //Slider BG
    const bgSlideDiv = document.querySelector('.home-hero__bg__slide[postid="' + id + '"]');
    if (bgSlideDiv) {
      const slideNumber = bgSlideDiv.getAttribute('slidenumber');
      flickitySlider.select(slideNumber);
    }

    //Slider Content
    const contentSlideDiv = document.querySelector('.hero-content-slide[postid="' + id + '"]');
    if (contentSlideDiv) {
      const slideNumber = contentSlideDiv.getAttribute('slidenumber');
      contentSlider.select(slideNumber);
      resetTabs(); //set tabs to first one
    }

  }

  //home-hero__mobile-return
  const heroContent = document.querySelector('.home-hero__content');

  let mapZoomed = false;

  //Back Button
  const backButton = document.querySelector('#mobile-map-return-cta');
  backButton.addEventListener('click', () => {

    if (mapZoomed) {
      heroContent.classList.add('content-hidden');
      //go home

      chart.goHome();
      flickitySlider.select(0);
      contentSlider.select(0);
   
      mapZoomed = false;


    } else {
      heroContent.classList.remove('content-hidden');
      backButton.classList.remove('active');
    }

    checkDots();
  });

  //Explore Map Button
  const mobileMapCTA = document.querySelector('#mobile-map-cta');
  mobileMapCTA.addEventListener('click', () => {

    heroContent.classList.add('content-hidden');
    backButton.classList.add('active');
    checkDots();

  });

  // Make stuff animate on load
  chart.appear(1000, 100);


  //responsive dots
  checkDots();

  function checkDots() {
    if ($(window).width() < 1000 ) { //if mobile
      
      homeButton.hide();

      if(!heroContent.classList.contains('content-hidden')){
        originSeries.hide();
        
      } else {
        originSeries.show();
      }
    } else {
      originSeries.show();
      homeButton.show();
      //heroContent.classList.remove('content-hidden');
      //backButton.classList.remove('active');
    }

    console.log('checkDots');
  }






  //TABS --------------------------
  const tabButtons = [...document.querySelectorAll('.hero-content-slide__content__tabs__button')];
  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const slideindex = button.getAttribute('slideindex');
      const tabindex = button.getAttribute('tabindex');

      $(".hero-content-slide__content__tabs__button[slideindex='" + slideindex + "']").removeClass('active');
      button.classList.add('active');

      $(".hero-content-slide__content__panels__panel[slideindex='" + slideindex + "']").removeClass('active');
      $(".hero-content-slide__content__panels__panel[slideindex='" + slideindex + "'][tabindex='" + tabindex + "']").addClass('active');

    });
  })

  function resetTabs() {
    $(".hero-content-slide__content__tabs__button").removeClass('active');
    $(".hero-content-slide__content__tabs__button[tabindex='0']").addClass('active')

    $(".hero-content-slide__content__panels__panel").removeClass('active');
    $(".hero-content-slide__content__panels__panel[tabindex='0']").addClass('active')

  }

});











