jQuery(document).ready(function ($) {

  const itineraryMapObjects = page_vars.itineraryMapObjects;
    let markersReference = [];
    let sourcesReference = [];

    // Map 
    const initialObject = itineraryMapObjects[0]; // initial object

    mapboxgl.accessToken = 'pk.eyJ1IjoicmFpbmZvcmVzdGNydWlzZXNybHMiLCJhIjoiY2xiNWh2aXo5MDNiZzN2dW5hNjFpaXM3dCJ9.05yNz0iG1JXFq62DYF7SFA';
    var map = new mapboxgl.Map({
        container: 'itinerary-map',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        center: [initialObject.startLongitude, initialObject.startLatitude],
        zoom: initialObject.startZoom,
        projection: 'mercator',
        attributionControl: false
    });
    map.addControl(new mapboxgl.NavigationControl());
    map.scrollZoom.disable();

    //Markers
    createMarkers(initialObject);

    //Lines
    map.on('load', () => {
        createLineFeatures(initialObject);
        flyToCenter(initialObject);
    });



    //Map Functions
    function createMarkers(itineraryObject) {

        markersReference.forEach(item => { //remove the old ones
            item.remove();
        })

         // -- add markers to map
         for (const feature of itineraryObject.featureList) {

            const el = document.createElement('div');
            el.className = 'destination-marker';


            let description = "";

            if (!itineraryObject.hasDifferentPorts && feature.properties.isEmbarkation) {
                description = "Embarkation & Disembarkation"
                el.className = 'embarkation-marker';
            }

            if (itineraryObject.hasDifferentPorts && feature.properties.isEmbarkation) {
                description = "Embarkation"
                el.className = 'embarkation-marker';
            }

            if (itineraryObject.hasDifferentPorts && feature.properties.isDisembarkation) {
                description = "Disembarkation"
            }

            const marker = new mapboxgl.Marker(el)
                .setLngLat(feature.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 }) // add popups
                        .setHTML(
                            `<div class="mapboxgl-popup-content__title-area">
                            <div class="mapboxgl-popup-content__title-area__day-count">${feature.properties.day}</div>
                            <div class="mapboxgl-popup-content__title-area__title">${feature.properties.title}</div>
                            <div class="mapboxgl-popup-content__title-area__description">${description}</div>
                            </div>
                            <div class="mapboxgl-popup-content__image-area"><img src="${feature.properties.image}"></div>`
                        )
                ).addTo(map);

            markersReference.push(marker);
        }
    }


    function createLineFeatures(itineraryObject) {

        sourcesReference.forEach(item => { //remove the old ones
            map.removeLayer(item)
            map.removeSource(item);
        })
        sourcesReference = [];

        if (itineraryObject.geojson == null) return false
        const lineFeatures = itineraryObject.geojson.features;

        lineFeatures.forEach((featureItem, index) => {
            let resourceId = 'route' + index;
            sourcesReference.push(resourceId);

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
                    'line-dasharray': featureItem.properties.stroke == 'royalblue' ? [1, 2] : [],
                }
            });
        })
    }




    //Map Functions
    function flyToCenter(itineraryObject) {
        let coordinates = [itineraryObject.startLongitude, itineraryObject.startLatitude];
        let zoom = itineraryObject.startZoom;

        if(window.innerWidth < 600){
            zoom = zoom - .75; // adjust for mobile
            coordinates = [itineraryObject.startLongitude, (+itineraryObject.startLatitude - 1)];
        }


        map.flyTo({
            center: coordinates,
            zoom: zoom,
            duration: 1500,
            essential: true
        });
    }

    //SLIDERS
    // Itineraries Swiper
    const itinerariesSliderNav = new Swiper('#itineraries-slider-nav', {
        slidesPerView: 3,
        spaceBetween: 10,
        watchSlidesProgress: true,
        slideToClickedSlide: true,
        breakpoints: {
            1000: {
                slidesPerView: 4,
            }
        }
    });

    // Itineraries Swiper
    const itinerariesSlider = new Swiper('#itineraries-slider', {
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
        createMarkers(itineraryMapObjects[swiper.realIndex]);
        createLineFeatures(itineraryMapObjects[swiper.realIndex]);
        flyToCenter(itineraryMapObjects[swiper.realIndex]);
    });

});
