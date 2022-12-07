jQuery(document).ready(function ($) {
    const itineraryObject = page_vars_product_itinerary_map.itineraryObjects[0];
    const destinationPoints = itineraryObject.destinationPoints;


    mapboxgl.accessToken = 'pk.eyJ1IjoicmFpbmZvcmVzdGNydWlzZXNybHMiLCJhIjoiY2xiNWh2aXo5MDNiZzN2dW5hNjFpaXM3dCJ9.05yNz0iG1JXFq62DYF7SFA';
    var map = new mapboxgl.Map({
        container: 'itinerary-map',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        center: [itineraryObject.startLongitude, itineraryObject.startLatitude],
        zoom: itineraryObject.startZoom,
        projection: 'mercator'
    });
    map.addControl(new mapboxgl.NavigationControl());
    map.scrollZoom.disable();


    // Destination Markers
    var features = [];
    destinationPoints.forEach(item => {
        var feature = {
            type: 'Feature',
            geometry: {
                type: 'Point',
                coordinates: item['coordinates']
            },
            properties: {
                day: item['day'],
                title: item['title'],
                description: item['description'],
                image: item['image'],
                locationType: item['locationType']

            }
        }
        features.push(feature);
    })



    // add markers to map
    for (const feature of features) {
        // create a HTML element for each feature
        const el = document.createElement('div');
        el.className = 'destination-marker';

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el)
            .setLngLat(feature.geometry.coordinates)
            .setPopup(
                new mapboxgl.Popup({ offset: 25 }) // add popups
                    .setHTML(
                        `<div class="mapbox-popup__day-count">${feature.properties.day}</div>
                        <div class="mapbox-popup__title">${feature.properties.title}</div>
                        <div class="mapbox-popup__badge-area">${feature.properties.locationType}</div>

                        <div class="mapbox-popup__description">${feature.properties.description}</div>
                        <div class="mapbox-popup__image-area"><img src="${feature.properties.image}"></div>`
                    )
            ).addTo(map);
    }




    //Lines

    map.on('load', () => {

        if (itineraryObject.geojson == null) return false
        const lineFeatures = itineraryObject.geojson.features;


        lineFeatures.forEach((featureItem, index) => {
            let resourceId = 'route' + index;

            map.addSource(resourceId, {
                'type': 'geojson',
                'data': featureItem
            });
            map.addLayer({
                'id': resourceId,
                'type': 'line',
                'source': resourceId,
                'layout': {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                'paint': {
                    'line-color': featureItem.properties.stroke,
                    'line-width': 4,
                    'line-dasharray': featureItem.properties.stroke == 'orange' ? [1, 2] : [],

                }
            });
        })
    });

});


