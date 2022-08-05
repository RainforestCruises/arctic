jQuery(document).ready(function ($) {

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

homeButton.events.on("click", function() {
  chart.goHome();
  flickitySlider.select(0);
  contentSlider.select(0);
  homeButton.hide();
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
    });

    return am5.Bullet.new(root, {
      sprite: circle
    });
  });


  var originCities = [
    {
      title: "Falkland Islands",
      postid: 2924,
      slide: 1,
      geometry: { type: "Point", coordinates: [-59, -52] },
      zoomPoint: { longitude: -60, latitude: -54 },
      zoomLevel: 3.8,
    },
    {
      title: "Antarctic Peninsula",
      postid: 2922,
      slide: 4,
      geometry: { type: "Point", coordinates: [-63, -65] },
      zoomPoint: { longitude: -55, latitude: -62 },
      zoomLevel: 3.7,
    },
    {
      title: "Ushuaia",
      postid: 2927,
      slide: 2,
      geometry: { type: "Point", coordinates: [-68, -54] },

      zoomPoint: { longitude: -62, latitude: -55 },
      zoomLevel: 3.8,
    },
    {
      title: "South Georgia",
      postid: 2923,
      slide: 3,
      geometry: { type: "Point", coordinates: [-26, -57] },
      zoomPoint: { longitude: -46, latitude: -57 },
      zoomLevel: 3.5,
    }
  ];

  originSeries.data.setAll(originCities);


  //BG Slider
  var flickitySlider = new Flickity('.home-hero__bg', {
    prevNextButtons: false,
    pageDots: false,
    fade: true,
    //lazyLoad: true,
    selectedAttraction: 0.01,
    friction: 0.15
  });

  //Content Slider

  var contentSlider = new Flickity('.home-hero__content__slider', {
    prevNextButtons: false,
    pageDots: false,
    fade: true,

    selectedAttraction: 0.1,
    friction: 0.6
  });



  function selectOrigin(id) {
    var dataItem = originSeries.getDataItemById(id);
    var dataContext = dataItem.dataContext;
    chart.zoomToGeoPoint(dataContext.zoomPoint, dataContext.zoomLevel, true);
    homeButton.show();


    const slideDiv = document.querySelector('.home-hero__bg__slide[postid="' + id + '"]');
    if (slideDiv) {
        const slideNumber = slideDiv.getAttribute('slidenumber');
        flickitySlider.select(slideNumber);
    }

    //Another Slider for Content
    const contentSlideDiv = document.querySelector('.hero-content-slide[postid="' + id + '"]');
    console.log(contentSlideDiv)
    if (contentSlideDiv) {
        const slideNumber = contentSlideDiv.getAttribute('slidenumber');
        contentSlider.select(slideNumber);
        
    }
   
  }



  // Make stuff animate on load
  chart.appear(1000, 100);


});











