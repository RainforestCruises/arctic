jQuery(document).ready(function ($) {
  // Capture this immediately, before any delay or redirect-cleanup script can touch the URL
  const urlParams = new URLSearchParams(window.location.search);
  const variantParamFromUrl = urlParams.get("variant");

  // -------------------------------------------------------
  // SLIDERS — init immediately, no Mapbox needed
  // Only run if the elements exist (handles both page types)
  // -------------------------------------------------------
  if (document.getElementById("itineraries-slider-nav")) {
    const itinerariesSliderNav = new Swiper("#itineraries-slider-nav", {
      slidesPerView: 3,
      spaceBetween: 10,
      watchSlidesProgress: true,
      slideToClickedSlide: true,
      breakpoints: {
        1000: { slidesPerView: 4 },
      },
    });

    const itinerariesSlider = new Swiper("#itineraries-slider", {
      slidesPerView: 1,
      spaceBetween: 10,
      navigation: {
        nextEl: ".itineraries-slider-btn-next",
        prevEl: ".itineraries-slider-btn-prev",
      },
      thumbs: {
        swiper: itinerariesSliderNav,
      },
      // jump straight to the variant slide on load, if one was requested
      initialSlide: variantParamFromUrl !== null && page_vars.itineraryMapObjects[variantParamFromUrl] !== undefined ? Number(variantParamFromUrl) : 0,
    });

    itinerariesSlider.on("slideChange", function (swiper) {
      // map functions called here — safe because by the time
      // a user slides, 500ms has long passed and map is ready
      if (typeof createMarkers === "function") {
        createMarkers(page_vars.itineraryMapObjects[swiper.realIndex]);
        createLineFeatures(page_vars.itineraryMapObjects[swiper.realIndex]);
        flyToCenter(page_vars.itineraryMapObjects[swiper.realIndex]);
      }

      // keep URL in sync when sliding too
      const url = new URL(window.location.href);
      url.searchParams.set("variant", swiper.realIndex);
      window.history.replaceState({}, "", url);
    });
  }

  // -------------------------------------------------------
  // MAPBOX — load after 500ms, only if map container exists
  // -------------------------------------------------------
  if (!document.getElementById("itinerary-map")) return;

  setTimeout(function () {
    const mapboxScript = document.createElement("script");
    mapboxScript.src = page_vars.themeUrl + "/vendor/mapbox/mapbox-gl.js";
    mapboxScript.onload = function () {
      initMap();
    };
    document.head.appendChild(mapboxScript);
  }, 500);

  // Declare these outside initMap so slideChange can reach them
  var createMarkers, createLineFeatures, flyToCenter;

  function initMap() {
    const itineraryMapObjects = page_vars.itineraryMapObjects;
    let markersReference = [];
    let sourcesReference = [];

    // Determine starting variant from URL (?variant=2), defaulting to 0
    const startIndex = variantParamFromUrl !== null && itineraryMapObjects[variantParamFromUrl] !== undefined ? variantParamFromUrl : 0;

    const initialObject = itineraryMapObjects[startIndex];

    mapboxgl.accessToken = "pk.eyJ1IjoicmFpbmZvcmVzdGNydWlzZXNybHMiLCJhIjoiY2xiNWh2aXo5MDNiZzN2dW5hNjFpaXM3dCJ9.05yNz0iG1JXFq62DYF7SFA";
    var map = new mapboxgl.Map({
      container: "itinerary-map",
      style: "mapbox://styles/mapbox/outdoors-v12",
      center: [initialObject.startLongitude, initialObject.startLatitude],
      zoom: initialObject.startZoom,
      projection: "mercator",
      attributionControl: false,
    });
    map.addControl(new mapboxgl.NavigationControl());
    map.scrollZoom.disable();

    // ✅ Define all three functions FIRST
    createMarkers = function (itineraryObject) {
      markersReference.forEach((item) => item.remove());
      for (const feature of itineraryObject.featureList) {
        const el = document.createElement("div");
        el.className = "destination-marker";
        let description = "";

        if (!itineraryObject.hasDifferentPorts && feature.properties.isEmbarkation) {
          description = "Embarkation & Disembarkation";
          el.className = "embarkation-marker";
        }
        if (itineraryObject.hasDifferentPorts && feature.properties.isEmbarkation) {
          description = "Embarkation";
          el.className = "embarkation-marker";
        }
        if (itineraryObject.hasDifferentPorts && feature.properties.isDisembarkation) {
          description = "Disembarkation";
        }

        const marker = new mapboxgl.Marker(el)
          .setLngLat(feature.geometry.coordinates)
          .setPopup(
            new mapboxgl.Popup({ offset: 25 }).setHTML(
              `<div class="mapboxgl-popup-content__title-area">
                <div class="mapboxgl-popup-content__title-area__day-count">${feature.properties.day}</div>
                <div class="mapboxgl-popup-content__title-area__title">${feature.properties.title}</div>
                <div class="mapboxgl-popup-content__title-area__description">${description}</div>
              </div>
              <div class="mapboxgl-popup-content__image-area"><img src="${feature.properties.image}"></div>`,
            ),
          )
          .addTo(map);

        markersReference.push(marker);
      }
    };

    createLineFeatures = function (itineraryObject) {
      sourcesReference.forEach((item) => {
        map.removeLayer(item);
        map.removeSource(item);
      });
      sourcesReference = [];

      if (itineraryObject.geojson == null) return false;

      itineraryObject.geojson.features.forEach((featureItem, index) => {
        let resourceId = "route" + index;
        sourcesReference.push(resourceId);
        map.addSource(resourceId, { type: "geojson", data: featureItem });
        map.addLayer({
          id: resourceId,
          type: "line",
          source: resourceId,
          layout: { "line-join": "round", "line-cap": "round" },
          paint: {
            "line-color": featureItem.properties.stroke,
            "line-width": 4,
            "line-dasharray": featureItem.properties.stroke == "royalblue" ? [1, 2] : [],
          },
        });
      });
    };

    flyToCenter = function (itineraryObject) {
      let coordinates = [itineraryObject.startLongitude, itineraryObject.startLatitude];
      let zoom = itineraryObject.startZoom;

      if (window.innerWidth < 600) {
        zoom = zoom - 0.75;
        coordinates = [itineraryObject.startLongitude, +itineraryObject.startLatitude - 1];
      }

      map.flyTo({ center: coordinates, zoom: zoom, duration: 1500, essential: true });
    };

    // ✅ Now safe to call them
    createMarkers(initialObject);

    map.on("load", () => {
      createLineFeatures(initialObject);
      flyToCenter(initialObject);
    });

    // Variant buttons
    const variantButtons = [...document.querySelectorAll(".itinerary-variants__content__itinerary__nav .variant-button")];
    variantButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const activeIndex = button.getAttribute("data-variant-index");
        variantButtons.forEach((b) => b.classList.remove("active"));
        button.classList.add("active");
        createMarkers(itineraryMapObjects[activeIndex]);
        createLineFeatures(itineraryMapObjects[activeIndex]);
        flyToCenter(itineraryMapObjects[activeIndex]);
        setActiveDays(activeIndex);

        // keep the URL in sync so the link stays shareable
        const url = new URL(window.location.href);
        url.searchParams.set("variant", activeIndex);
        window.history.replaceState({}, "", url);
      });
    });

    const dayListItems = [...document.querySelectorAll(".itinerary-variants__content__itinerary__main__days-area .day-list")];
    function setActiveDays(activeIndex) {
      dayListItems.forEach((item) => {
        item.classList.remove("active");
        if (item.getAttribute("data-variant-index") == activeIndex) {
          item.classList.add("active");
        }
      });
    }

    // Reflect the starting variant in the button/day-list UI
    const startButton = variantButtons.find((b) => b.getAttribute("data-variant-index") === String(startIndex));
    if (startButton) {
      variantButtons.forEach((b) => b.classList.remove("active"));
      startButton.classList.add("active");
    }
    setActiveDays(startIndex);
  } // end initMap()
}); // end document.ready
