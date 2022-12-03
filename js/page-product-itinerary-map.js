jQuery(document).ready(function ($) {
    const itineraryObject = page_vars_product_itinerary_map.itineraryObjects[0];
    const destinationPoints = itineraryObject.destinationPoints;
    const coordinatePoints = itineraryObject.coordinatePoints;


    mapboxgl.accessToken = 'pk.eyJ1IjoicmFpbmZvcmVzdGNydWlzZXNybHMiLCJhIjoiY2xiNWh2aXo5MDNiZzN2dW5hNjFpaXM3dCJ9.05yNz0iG1JXFq62DYF7SFA';
    var map = new mapboxgl.Map({
        container: 'itinerary-map',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        center: [-65, -60],
        zoom: 2.8,
        projection: 'mercator'
    });




    var features = [];
    destinationPoints.forEach(item => {
        var feature = {
            type: 'Feature',
            geometry: {
                type: 'Point',
                coordinates: item['coordinates']
            },
            properties: {
                title: item['title'],
                description: item['description'],
                image: item['image']
            }
        }
        features.push(feature);
    })

    var geojson = {
        type: 'FeatureCollection',
        features: features
    }

    // add markers to map
    for (const feature of geojson.features) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el)
            .setLngLat(feature.geometry.coordinates)
            .setPopup(
                new mapboxgl.Popup({ offset: 25 }) // add popups
                    .setHTML(
                        `<div class="mapbox-popup__title">${feature.properties.title}</div>
                        <div class="mapbox-popup__description">${feature.properties.description}</div>
                        <div class="mapbox-popup__image-area"><img src="${feature.properties.image}"></div>`
                    )
            ).addTo(map);
    }

    map.addControl(new mapboxgl.NavigationControl());
    map.scrollZoom.disable();

    // map.on('load', () => {
    //     map.addSource('route', {
    //         'type': 'geojson',
    //         'data': {
    //             'type': 'Feature',
    //             'properties': {},
    //             'geometry': {
    //                 'type': 'LineString',
    //                 'coordinates': coordinatePoints
    //             }
    //         }
    //     });
    //     map.addLayer({
    //         'id': 'route',
    //         'type': 'line',
    //         'source': 'route',
    //         'layout': {
    //             'line-join': 'round',
    //             'line-cap': 'round'
    //         },
    //         'paint': {
    //             'line-color': '#ffa600',
    //             'line-width': 2,
    //             'line-dasharray': [1, 2],
    //         }
    //     });
    // });



});


