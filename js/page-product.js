jQuery(document).ready(function ($) {
  //MODALS ---------------------
  const body = document.getElementById("body");
  const contentModal = document.querySelector("#contentModal");
  const contentModalMain = document.querySelector("#contentModalMain");

  const expandContent = document.querySelector("#expand-content");
  if (expandContent) {
    expandContent.addEventListener("click", () => {
      contentModal.style.display = "flex";
      body.classList.add("no-scroll");
      contentModalMain.scrollTop = 300;
    });
  }

  const departureSelectionDisplay = document.querySelector("#departure-selection-display");
  const cabinSelectionDisplay = document.querySelector("#cabin-selection-display");

  const formDepartureDate = document.querySelector(".form-departure-date input:first-child");


  //hide outline panels on load (mobile) -- on resize fix

  if (window.innerWidth < 800) {
    //mobile view
    $(".outline-panel__content").toggle();
    $(".outline-panel__heading").toggleClass("closed");
  }

  // Inquire buttons (generic)
  // -- clear all selections
  // -- hide tabs
  // -- go to inquire form
  const genericInquireCtaButtons = [...document.querySelectorAll(".generic-inquire-cta")];
  genericInquireCtaButtons.forEach((item) => {
    item.addEventListener("click", () => {
      inquireModal.style.display = "flex";
      body.classList.add("no-scroll");
      
      activeTabPanel("inquire");

      departureSelectionDisplay.style.display = "";
      departureSelectionDisplay.innerHTML = "";
      cabinSelectionDisplay.style.display = "";
      cabinSelectionDisplay.innerHTML = "";

      formDepartureDate.value = "";
      hideModalTabButtons();
    });
  });

  // Inquire Buttons (on departures)
  // -- go to inquire
  // -- make selection of departure date
  // -- hide tabs except return to dates
  const departureInquireCtaButtons = [...document.querySelectorAll(".departure-inquire-cta")];
  departureInquireCtaButtons.forEach((item) => {
    item.addEventListener("click", () => {
      inquireModal.style.display = "flex";
      body.classList.add("no-scroll");
      activeTabPanel("inquire");
      
      var selection = item.getAttribute("itineraryTitle") + " - Departing " + item.getAttribute("departureDate");

      departureSelectionDisplay.style.display = "block";
      departureSelectionDisplay.innerHTML = selection;
      formDepartureDate.value = departureSelectionDisplay.innerHTML + " " + cabinSelectionDisplay.innerHTML;

      hideModalTabButtons("dates");
    });
  });

  // Inquire buttons (on cabins)
  // -- complete the cabin selection
  // -- go to inquire form
  const cabinInquireCtaButtons = [...document.querySelectorAll(".cabin-inquire-cta")];
  cabinInquireCtaButtons.forEach((item) => {
    item.addEventListener("click", () => {
      inquireModal.style.display = "flex";
      body.classList.add("no-scroll");
      activeTabPanel("inquire");
      hideModalTabButtons("cabins");
      
      var selection = item.getAttribute("cabinTitle");

      cabinSelectionDisplay.style.display = "block";
      cabinSelectionDisplay.innerHTML = selection;
      formDepartureDate.value = departureSelectionDisplay.innerHTML + " " + cabinSelectionDisplay.innerHTML;
    });
  });

  // View Prices Buttons (on departures)
  // -- go to cabin selection
  // -- display itinerary selected
  const departurePriceButtons = [...document.querySelectorAll(".departure-price-group-button")];
  departurePriceButtons.forEach((item) => {
    item.addEventListener("click", () => {
      inquireModal.style.display = "flex";
      body.classList.add("no-scroll");

      const departureId = item.getAttribute("departureId");
      const title = item.getAttribute("itineraryTitle") + " - Departing, " + item.getAttribute("departureDate");

      activeTabPanel("cabins");
      filterCabins(departureId, title);
      hideModalTabButtons("dates"); // show the dates tab

      departureSelectionDisplay.style.display = "block";
      departureSelectionDisplay.innerHTML = title;

      cabinSelectionDisplay.innerHTML = ""; // clear cabin selection
      cabinSelectionDisplay.style.display = "none";
    });
  });

  // Filter Cabins
  // -- display the departure date
  const modalDealCards = [...document.querySelectorAll(".modal-deal-card ")];
  const modalCabinCards = [...document.querySelectorAll(".modal-cabin-card ")];
  const cabinDepartureSubtitle = document.querySelector("#cabin-departure-subtitle");
  function filterCabins(departureId, display) {
    cabinDepartureSubtitle.innerHTML = display;
    var count = 0;
    modalCabinCards.forEach((item) => {
      item.style.display = "none";

      if (item.getAttribute("departureId") == departureId) {
        item.style.display = "";
        count = count + 1;
      }
    });

    modalDealCards.forEach((item) => {
      item.style.display = "none";
      if (item.getAttribute("departureId") == departureId) {
        item.style.display = "";
      }
      if (item.classList.contains("specs-deal")) {
        // omit hiding the ones in full date list
        item.style.display = "";
      }
    });
  }

  // view all button
  // -- show departures
  // -- hide all modal tab buttons
  const viewAllDates = document.querySelector("#view-all-dates-button");
  viewAllDates.addEventListener("click", () => {
    inquireModal.style.display = "flex";
    body.classList.add("no-scroll");
    activeTabPanel("dates");
    hideModalTabButtons();
  });

  // Modal Tabs
  const modalTabButtons = [...document.querySelectorAll(".modal-tab-link")];
  modalTabButtons.forEach((item) => {
    item.addEventListener("click", () => {
      const tabId = item.getAttribute("tab-panel");
      activeTabPanel(tabId);
      if (tabId == "cabins") {
        cabinSelectionDisplay.style.display = ""; //erase cabin selection
        cabinSelectionDisplay.innerHTML = "";
        hideModalTabButtons("dates");
      } else {
        hideModalTabButtons();
      }
    });
  });

  // Hide Tabs
  function hideModalTabButtons(exclude) {
    modalTabButtons.forEach((item) => {
      if (item.getAttribute("tab-panel") == exclude) {
        item.style.display = "";
      } else {
        item.style.display = "none";
      }
    });
  }

  // Modal Panels
  const modalTabPanels = [...document.querySelectorAll(".modal-tab-panel")];
  const departureModalTitle = document.querySelector("#departure-modal-title");
  const inquireModalMainContent = document.querySelector("#inquireModalMainContent");
  function activeTabPanel(tabId) {
    inquireModalMainContent.scrollTop = 0;
    modalTabPanels.forEach((panel) => {
      const panelId = panel.getAttribute("tab-panel");
      if (tabId == panelId) {
        panel.classList.add("active");
      } else {
        panel.classList.remove("active");
      }
    });
    departureModalTitle.style.display = "none";
    if (tabId == "dates") {
      departureModalTitle.style.display = "";
    }
  }

  // Sliders -------------------
  // hero desktop slider
  const heroDesktopSlider = new Swiper("#hero-desktop-slider", {
    loop: true,
    spaceBetween: 5,
    slidesPerView: 2,
    navigation: {
      nextEl: ".hero-gallery-slider-next",
      prevEl: ".hero-gallery-slider-prev",
    },
    breakpoints: {
      1500: {
        slidesPerView: 3,
      },
    },
  });
  // hero mobile slider
  const heroMobileSlider = new Swiper("#hero-mobile-slider", {
    loop: false,
    draggable: true,
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
      dynamicMainBullets: 3,
    },
  });
  const counter = document.querySelector(".product-hero__bg-slider__count");
  heroMobileSlider.on("slideChange", function (swiper) {
    counter.innerHTML = swiper.realIndex + 1 + " / " + swiper.slides.length;
  });

  // Extras Swiper
  new Swiper("#extras-slider", {
    spaceBetween: 15,
    slidesPerView: 1.2,
    watchSlidesProgress: true,
    slideToClickedSlide: false,
    navigation: {
      nextEl: ".extras-slider-btn-next",
      prevEl: ".extras-slider-btn-prev",
    },
    breakpoints: {
      600: {
        slidesPerView: 2,
      },
    },
  });

  // Extras Modal
  const extrasModal = document.querySelector("#extrasModal");
  const extrasModalMainContent = document.querySelector("#extrasModalMainContent");

  const viewExtrasButtons = [...document.querySelectorAll(".extras-view-details")];
  if (viewExtrasButtons) {
    viewExtrasButtons.forEach((item) => {
      item.addEventListener("click", () => {
        extrasModal.style.display = "flex";
        body.classList.add("no-scroll");
        const section = item.getAttribute("section");
        const modalDivSectionOffset = document.getElementById(section).offsetTop;

        if (section == "extras-section-0") {
          extrasModalMainContent.scrollTop = 0;
        } else {
          extrasModalMainContent.scrollTop = modalDivSectionOffset - 90;
        }
      });
    });
  }

  // Deals Swiper
  new Swiper("#deals-slider", {
    spaceBetween: 15,
    slidesPerView: 1,
    watchSlidesProgress: true,
    slideToClickedSlide: true,
    navigation: {
      nextEl: ".deals-slider-btn-next",
      prevEl: ".deals-slider-btn-prev",
    },
    breakpoints: {
      600: {
        slidesPerView: 2,
      },
    },
  });

  // Related Swiper
  new Swiper("#related-slider", {
    spaceBetween: 15,
    slidesPerView: 1.2,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".related-slider-btn-next",
      prevEl: ".related-slider-btn-prev",
    },
    breakpoints: {
      600: {
        slidesPerView: 2,
      },
      800: {
        slidesPerView: 3,
      },
    },
  });

  const reviewsModal = document.querySelector("#reviewsModal");
  const reviewsModalMainContent = document.querySelector("#reviewsModalMainContent");

  const readAllReviews = [...document.querySelectorAll(".read-all-reviews")];
  if (readAllReviews) {
    readAllReviews.forEach((item) => {
      item.addEventListener("click", () => {
        reviewsModal.style.display = "flex";
        body.classList.add("no-scroll");
        const section = item.getAttribute("section");
        const modalDivSectionOffset = document.getElementById(section).offsetTop;
        reviewsModalMainContent.scrollTop = modalDivSectionOffset - 120;
      });
    });
  }

  // Items Modal
  const itemsModal = document.querySelector("#itemsModal");
  const expandItems = document.querySelector("#expand-items");

  if (expandItems) {
    expandItems.addEventListener("click", () => {
      itemsModal.style.display = "flex";
      body.classList.add("no-scroll");
    });
  }

  // deals - click event listeners
  const dealsModal = document.getElementById("dealsModal");
  const dealsModalTitle = document.getElementById("dealsModalTitle");

  const dealCtaButtons = [...document.querySelectorAll(".deal-cta")];

  dealCtaButtons.forEach((item) => {
    item.addEventListener("click", () => {
      dealsModal.style.display = "flex";
      body.classList.add("no-scroll");

      if (item.classList.contains("special-departure-cta")) {
        dealsModalTitle.innerHTML = "Special Departure Information";
      } else {
        dealsModalTitle.innerHTML = "Deal Information";
      }

      const filterId = item.getAttribute("dealId");
      filterDeals(filterId);
    });
  });

  // deal modal cta buttons
  modalDealCards.forEach((item) => {
    item.addEventListener("click", () => {
      dealsModal.style.display = "flex";
      dealsModal.classList.add("modal-second-level");
      if (item.classList.contains("special-departure-cta")) {
        dealsModalTitle.innerHTML = "Special Departure Information";
      } else {
        dealsModalTitle.innerHTML = "Deal Information";
      }
      const filterId = item.getAttribute("dealId");
      filterDeals(filterId);
    });
  });

  const dealModalSections = [...document.querySelectorAll(".product-deals-modal-item")];

  function filterDeals(filterId) {
    dealModalSections.forEach((item) => {
      item.style.display = "none"; //loop each departure card, set all to display none
      if (filterId == item.getAttribute("dealId")) {
        item.style.display = "";
      }
    });
  }

  // Cruise Region
  const regionModal = document.getElementById("regionModal");
  const switchRegionButtons = [...document.querySelectorAll(".switch-region-button")];

  switchRegionButtons.forEach((item) => {
    item.addEventListener("click", () => {
      regionModal.style.display = "flex";
      body.classList.add("no-scroll");
    });
  });
});
