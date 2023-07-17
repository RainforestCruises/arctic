jQuery(document).ready(function ($) {

    // On Click - Nav Links, href change position
    $('.hero-item').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {

        var target = $(id).offset().top;

        if ($(window).width() > 1200) { //large screen
            target = target - 50;
        } else { // small screen 
            target = target - 25;
        }

        if (id == "#section-ships") {
            target = target - 15;
        }

        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;

    }


    // hero video card
    let heroVideoCard = document.querySelector(".video-card__video")
    heroVideoCard.addEventListener("mouseover", function (e) {
        heroVideoCard.play();
    })
    heroVideoCard.addEventListener("mouseout", function (e) {
        heroVideoCard.pause();
    })

    var iframe = document.getElementById('modal-video-iframe');
    const vimeoPlayer = new Vimeo.Player(iframe);


    // video modal
    const videoModal = document.querySelector("#videoModal");
    const videoPlayButton = document.querySelector(".video-play-button");

    if (vimeoPlayer) {
        // -- open / play
        videoPlayButton.addEventListener('click', () => {
            videoModal.style.display = 'flex';
            body.classList.add('no-scroll');

            vimeoPlayer.play();
        });

        heroVideoCard.addEventListener('click', () => {
            videoModal.style.display = 'flex';
            body.classList.add('no-scroll');
            vimeoPlayer.play();
        });

        // -- stop playing 
        const stopVideoSections = [...document.querySelectorAll('.stop-video')];
        stopVideoSections.forEach(section => {
            section.addEventListener('click', () => {
                vimeoPlayer.pause();
            });
        })
    }



    // view all ships
    const allShipsButton = document.querySelector("#all-ships-button");
    const expandedShips = document.querySelector("#expanded-ships");


    // -- open / play
    allShipsButton.addEventListener('click', () => {
        if (expandedShips.classList.contains('expand')) {
            expandedShips.classList.remove('expand')
            allShipsButton.innerHTML = "View All Ships"
        } else {
            expandedShips.classList.add('expand')
            allShipsButton.innerHTML = "Show Less"

        }

    });



    // SLIDERS -------------------------------------------------------
    // each ship's image area
    new Swiper('.ship-card-image-area', {
        slidesPerView: 1,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            enabled: true
        },

    });

    // itineraries slider
    new Swiper('#itineraries-best-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.itineraries-best-slider-btn-next',
            prevEl: '.itineraries-best-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            1000: {
                slidesPerView: 3,
            },
            1300: {
                slidesPerView: 4,
            }
        }
    });

    // themes slider
    new Swiper('#styles-slider', {
        spaceBetween: 15,
        slidesPerView: 1.2,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.styles-slider-btn-next',
            prevEl: '.styles-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2,
            },
            800: {
                slidesPerView: 3,
            },
            1000: {
                slidesPerView: 4,
            },
            1300: {
                slidesPerView: 5,
            }
        }
    });

    // experiences slider
    new Swiper('#experiences-slider', {
        spaceBetween: 30,
        slidesPerView: 1,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3,
        },
        navigation: {
            nextEl: '.experiences-slider-btn-next',
            prevEl: '.experiences-slider-btn-prev',
        },
        breakpoints: {
            600: {
                slidesPerView: 2
            },
            800: {
                slidesPerView: 3,
            }
        }
    });


});



