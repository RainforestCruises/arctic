jQuery(document).ready(function ($) {






// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("destinations-map");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([am5themes_Animated.new(root)]);

// Create the map chart
// https://www.amcharts.com/docs/v5/charts/map-chart/
var chart = root.container.children.push(
  am5map.MapChart.new(root, {
    panX: "none",
    panY: "none",
    projection: am5map.geoMercator(),
    homeZoomLevel: 6,
    homeGeoPoint: { longitude: -60, latitude: -62 }
  })
);

var cont = chart.children.push(
  am5.Container.new(root, {
    layout: root.horizontalLayout,
    x: 20,
    y: 40
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

polygonSeries.events.on("datavalidated", function() {
    chart.goHome();
  });

// graticule series
var graticuleSeries = chart.series.push(am5map.GraticuleSeries.new(root, {}));
graticuleSeries.mapLines.template.setAll({
  stroke: root.interfaceColors.get("alternativeBackground"),
  strokeOpacity: 0.08
});


// Create line series for trajectory lines
// https://www.amcharts.com/docs/v5/charts/map-chart/map-line-series/
var lineSeries = chart.series.push(am5map.MapLineSeries.new(root, {}));
lineSeries.mapLines.template.setAll({
  stroke: root.interfaceColors.get("alternativeBackground"),
  strokeOpacity: 0.3
});

// Create point series for markers
// https://www.amcharts.com/docs/v5/charts/map-chart/map-point-series/
var pointSeries = chart.series.push(am5map.MapPointSeries.new(root, {}));

pointSeries.bullets.push(function () {
  var circle = am5.Circle.new(root, {
    radius: 7,
    tooltipText: "Drag me!",
    cursorOverStyle: "pointer",
    tooltipY: 0,
    fill: am5.color(0xffba00),
    stroke: root.interfaceColors.get("background"),
    strokeWidth: 2,
    draggable: true
  });

  circle.events.on("dragged", function (event) {
    var dataItem = event.target.dataItem;
    var projection = chart.get("projection");
    var geoPoint = chart.invert({ x: circle.x(), y: circle.y() });

    dataItem.setAll({
      longitude: geoPoint.longitude,
      latitude: geoPoint.latitude
    });
  });

  return am5.Bullet.new(root, {
    sprite: circle
  });
});

var paris = addCity({ latitude: -51, longitude: -59 }, "Falkland Islands");
var toronto = addCity({ latitude: -62, longitude: -57 }, "Peninsula");
var la = addCity({ latitude: 34.3, longitude: -118.15 }, "Los Angeles");
var havana = addCity({ latitude: 23, longitude: -82 }, "Havana");

var lineDataItem = lineSeries.pushDataItem({
  pointsToConnect: [paris, toronto, la, havana]
});

var planeSeries = chart.series.push(am5map.MapPointSeries.new(root, {}));

var plane = am5.Graphics.new(root, {
  svgPath:
    "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47",
  scale: 0.06,
  centerY: am5.p50,
  centerX: am5.p50,
  fill: am5.color(0x000000)
});

planeSeries.bullets.push(function () {
  var container = am5.Container.new(root, {});
  container.children.push(plane);
  return am5.Bullet.new(root, { sprite: container });
});

var planeDataItem = planeSeries.pushDataItem({
  lineDataItem: lineDataItem,
  positionOnLine: 0,
  autoRotate: true
});

planeDataItem.animate({
  key: "positionOnLine",
  to: 1,
  duration: 10000,
  loops: Infinity,
  easing: am5.ease.yoyo(am5.ease.linear)
});

planeDataItem.on("positionOnLine", function (value) {
  if (value >= 0.99) {
    plane.set("rotation", 180);
  } else if (value <= 0.01) {
    plane.set("rotation", 0);
  }
});

function addCity(coords, title) {
  return pointSeries.pushDataItem({
    latitude: coords.latitude,
    longitude: coords.longitude
  });
}

// Make stuff animate on load
chart.appear(1000, 100);

});











