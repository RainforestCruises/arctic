jQuery(document).ready(function ($) {
    const itineraryObjects = page_vars_cruise_itineraries.itineraryObjects;
    let destinationPoints = itineraryObjects[0].destinationPoints;
    let destinationLines = itineraryObjects[0].destinationLines;

    console.log(itineraryObjects);


    //Map
    var root = am5.Root.new("map-01");
    root.setThemes([am5themes_Animated.new(root), am5themes_Dark.new(root)]);
    var chart = root.container.children.push(
        am5map.MapChart.new(root, {
            panX: "translateX",
            panY: "translateY",
            wheelY: "none",
            projection: am5map.geoMercator(),
            homeZoomLevel: 10,
            homeGeoPoint: { longitude: -75, latitude: -60 }, //lat = Y, long = X
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
        strokeOpacity: 0.5,
    });

    chart.appear(1000, 100);



    //SLIDERS
    // Itineraries Swiper
    const itinerariesSliderNav = new Swiper('#itineraries-slider-nav', {
        slidesPerView: "auto",
        slideToClickedSlide: true,
        spaceBetween: 10,
        watchSlidesProgress: true,

    });
    
    // Itineraries Swiper
    const itinerariesSlider =  new Swiper('#itineraries-slider', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.itineraries-slider-btn-next',
            prevEl: '.itineraries-slider-btn-prev',
        },
        thumbs: {
            swiper: itinerariesSliderNav,
        },
    });
    itinerariesSlider.on('slideChange', function (swiper) {
        let destinationPoints = itineraryObjects[swiper.realIndex].destinationPoints;
        let destinationLines = itineraryObjects[swiper.realIndex].destinationLines;


        pointSeries.data.setAll(destinationPoints);
        lineSeries.data.setAll(destinationLines);
    });

    window.addEventListener('resize', function() {
        chart.goHome();
    });


});
