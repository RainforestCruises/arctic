jQuery(document).ready(function ($) {
    const destinationPoints = page_vars_cruise.destinationPoints;
    const destinationLines = page_vars_cruise.destinationLines;

    // Hero Sliders -------------------
    // hero desktop slider
    const heroDesktopSlider = new Swiper('#hero-desktop-slider', {
        loop: true,
        spaceBetween: 5,
        slidesPerView: 2,
        navigation: {
            nextEl: '.hero-gallery-slider-next',
            prevEl: '.hero-gallery-slider-prev',
        },
        breakpoints: {
            1280: {
                slidesPerView: 3,
            }
        }
    });
    // hero mobile slider
    const heroMobileSlider = new Swiper('#hero-mobile-slider', {
        loop: true,
        draggable: true,
        slidesPerView: 1,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });
    const counter = document.querySelector('.cruise-hero__bg-slider__count');
    heroMobileSlider.on('slideChange', function (swiper) {
        counter.innerHTML = (swiper.realIndex + 1) + ' / ' + (swiper.slides.length - 2);
    });




    //MODALS ---------------------
    const body = document.getElementById("body");

    //Inquire
    const inquireCtaButtons = [...document.querySelectorAll('.inquire-cta')];
    const inquireModal = document.getElementById("inquireModal");
    inquireCtaButtons.forEach(item => {
        item.addEventListener('click', () => {
            inquireModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    })


    // Fullscreen Gallery Modal
    const modalGalleryNav = new Swiper("#modal-gallery-nav", {
        spaceBetween: 10,
        slidesPerView: 3,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            600: {
                slidesPerView: 4,
            }
        }
    });
    const modalGalleryMain = new Swiper("#modal-gallery-main", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: modalGalleryNav,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
    });
    const counterGallery = document.querySelector('#cruiseGalleryModalCount');
    const titleGallery = document.querySelector('#cruiseGalleryModalTitle');
    modalGalleryMain.on('slideChange', function (swiper) {
        counterGallery.innerHTML = (swiper.realIndex + 1) + ' / ' + (swiper.slides.length);

        const slideDiv = document.querySelector('.cruise-gallery__main__slider__item[slideIndex="' + (swiper.realIndex + 1) + '"]');
        const slideTitle = slideDiv.getAttribute('title');
        titleGallery.innerHTML = slideTitle;
        console.log('sc')
    });


    // Hero Desktop Gallery Images - Click event listeners
    const heroGalleryImages = [...document.querySelectorAll('.cruise-hero__gallery__slider__item')];
    const cruiseGalleryModal = document.getElementById("cruiseGalleryModal");
    heroGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            cruiseGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            const slideDiv = document.querySelector('.cruise-gallery__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
        });
    })

    // Hero Mobile Gallery Images - Click event listeners 
    const heroMobileGalleryImages = [...document.querySelectorAll('.cruise-hero__bg-slider__slide')];
    heroMobileGalleryImages.forEach(item => {
        item.addEventListener('click', () => {
            cruiseGalleryModal.style.display = 'flex';
            body.classList.add('no-scroll');

            const imageId = item.getAttribute('imageId');
            const slideDiv = document.querySelector('.cruise-gallery__main__slider__item[imageId="' + imageId + '"]');
            const slideIndex = slideDiv.getAttribute('slideIndex');

            modalGalleryMain.slideTo(2, 0)
            modalGalleryMain.update();
            modalGalleryMain.slideTo(slideIndex - 1, 0);
        });
    })







    // Cabins Swiper
    new Swiper('#cabins-slider', {
        spaceBetween: 15,
        slidesPerView: 1,
        navigation: {
            nextEl: '.cabins-slider-btn-next',
            prevEl: '.cabins-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            }
        }
    });

    new Swiper('.cabin-card-image-area', {
        slidesPerView: 1,
        loop: true,
        allowTouchMove: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            800: {
                allowTouchMove: false,
            },
        }

    });


    // Related Swiper
    new Swiper('#related-slider', {
        spaceBetween: 15,
        slidesPerView: 1,
        navigation: {
            nextEl: '.related-slider-btn-next',
            prevEl: '.related-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            }
        }
    });
    new Swiper('.related-card-image-area', {
        slidesPerView: 1,
        loop: true,
        allowTouchMove: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            800: {
                allowTouchMove: false,
            },
        }
    });




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
            homeGeoPoint: { longitude: -65, latitude: -60 }, //lat = Y, long = X
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
        strokeOpacity: 0.5
    });

    chart.appear(1000, 100);





});
