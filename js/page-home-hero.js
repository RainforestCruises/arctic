jQuery(document).ready(function ($) {
  const destinationPoints = page_vars.destinationPoints;

  // Create the map chart
  var root = am5.Root.new("hero-map");
  root.setThemes([am5themes_Animated.new(root), am5themes_Dark.new(root)]);
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
  var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
  backgroundSeries.mapPolygons.template.setAll({
    fill: root.interfaceColors.get("alternativeBackground"),
    fillOpacity: 0,
    strokeOpacity: 0
  });

  // Add background polygon
  backgroundSeries.data.push({
    geometry: am5map.getGeoRectangle(90, 180, -90, -180)
  });

  // Create main polygon series for countries
  var polygonSeries = chart.series.push(
    am5map.MapPolygonSeries.new(root, {
      geoJSON: am5geodata_worldLow
    })
  );
  polygonSeries.mapPolygons.template.setAll({
    fill: am5.color(0xc2c6c9),
    fillOpacity: 0.4,
  });
  polygonSeries.events.on("datavalidated", function () {
    chart.goHome();
  });

  // graticule series
  var graticuleSeries = chart.series.push(am5map.GraticuleSeries.new(root, {}));
  graticuleSeries.mapLines.template.setAll({
    stroke: root.interfaceColors.get("alternativeBackground"),
    strokeOpacity: 0.08,
  });



  // Destination Markers
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

    circle.events.on("click", function (e) {
      selectOrigin(e.target.dataItem.get("id"));     
    });

    return am5.Bullet.new(root, {
      sprite: circle
    });
  });


  pointSeries.data.setAll(destinationPoints);


  //Main Slider
  let mapZoomed = false;
  
  //resize
  $(window).resize(function () {
    checkDots();
  });

  //BG Slider
  const backgroundSlider = new Flickity('.home-hero__bg', {
    prevNextButtons: false,
    setGallerySize: false,
    pageDots: false,
    fade: true,
    imagesLoaded: true,
    selectedAttraction: 0.04,
    friction: 0.4
  });

  const mainSliderDiv = document.querySelector('.home-hero__content__main-slider');
  const mainSlider = new Flickity('.home-hero__content__main-slider', {
    prevNextButtons: false,
    pageDots: false,
    fade: true,
    adaptiveHeight: true,
    selectedAttraction: 0.1,
    friction: 0.6,
    draggable: false,
  })



  //Click on dots
  function selectOrigin(id) {
    var dataItem = pointSeries.getDataItemById(id); //postid
    var dataContext = dataItem.dataContext;
    chart.zoomToGeoPoint(dataContext.zoomPoint, dataContext.zoomLevel, true);

    mapZoomed = true;
    backButton.classList.add('active')

    if ($(window).width() < 1000) {
      mainSliderDiv.classList.remove('hide');
    }
    

    //Slider BG
    const bgSlideDiv = document.querySelector('.home-hero__bg__slide[postid="' + id + '"]');
    if (bgSlideDiv) {
      const slideNumber = bgSlideDiv.getAttribute('slidenumber');
      backgroundSlider.select(slideNumber);
    }

    //Slider Content
    const contentSlideDiv = document.querySelector('.main-slider-slide[postid="' + id + '"]');
    if (contentSlideDiv) {
      const slideNumber = contentSlideDiv.getAttribute('slidenumber');
      mainSlider.select(slideNumber);
      resetTabs(); //set tabs to first one
    }

    checkDots();

  }

  
 

  const backButton = document.querySelector('#back-cta');
  backButton.addEventListener("click", function () {
    console.log('backClick');
    chart.goHome();
    backgroundSlider.select(0);
    mainSlider.select(0);
    backButton.classList.remove('active'); 
    mainSliderDiv.classList.remove('hide');
    mapZoomed = false;
  });

  //Explore Button
  const exploreButton = document.querySelector('#explore-cta');
  exploreButton.addEventListener('click', () => {

    mainSliderDiv.classList.add('hide');
    backButton.classList.add('active');
    checkDots();

  });


  // Make stuff animate on load
  chart.appear(1000, 100);


  //responsive dots
  checkDots();

  function checkDots() {
    if ($(window).width() < 1000) { //mobile
      console.log(mainSliderDiv);
      if (mainSliderDiv.classList.contains('hide')) {
        pointSeries.show();
      } else {
        pointSeries.hide();
      }

    } else { //desktop
      pointSeries.show();
    }

    console.log('checkDots');
  }


  //hero-content-slide__content__panels__panel panel-series
  const seriesSlider = new Swiper('.main-slider-slide__secondary__panels__panel.panel-series', {
    // Optional parameters
    loop: true,
    spaceBetween: 15,
    slidesPerView: 1,
    // Navigation arrows
    scrollbar: {
      el: '.swiper-scrollbar',
      draggable: true,
    },

    breakpoints: {
      600: {
        slidesPerView: 2,
      }

    }
  });




  //TABS --------------------------
  const tabButtons = [...document.querySelectorAll('.main-slider-slide__secondary__tabs__button')];
  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const slideindex = button.getAttribute('slideindex');
      const tabindex = button.getAttribute('tabindex');
      console.log('tabButton')

      $(".main-slider-slide__secondary__tabs__button[slideindex='" + slideindex + "']").removeClass('active');
      button.classList.add('active');

      $(".main-slider-slide__secondary__panels__panel[slideindex='" + slideindex + "']").removeClass('active');
      $(".main-slider-slide__secondary__panels__panel[slideindex='" + slideindex + "'][tabindex='" + tabindex + "']").addClass('active');

    });
  })

  function resetTabs() {
    $(".main-slider-slide__secondary__tabs__button").removeClass('active');
    $(".main-slider-slide__secondary__tabs__button[tabindex='0']").addClass('active')

    $(".main-slider-slide__secondary__panels__panel").removeClass('active');
    $(".main-slider-slide__secondary__panels__panel[tabindex='0']").addClass('active')

  }

});











