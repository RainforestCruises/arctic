jQuery(document).ready(function ($) {
  const defaultSearchUrl = header_vars.defaultSearchUrl;

  const headerDiv = document.querySelector(".header");
  const navMain = document.querySelector(".nav-main");
  const navMega = document.querySelector(".nav-mega");
  const megaPanels = document.querySelectorAll(".nav-mega__panel");
  const navBackdrop = document.querySelector(".nav-backdrop");
  const navMainLinks = [...document.querySelectorAll(".nav-main__content__center__nav__list__item")];

  const navCta = document.querySelector("#nav-cta");
  const navControl = document.querySelector("#nav-control");
  const navControlSearch = document.querySelector("#nav-control-search");
  const navControlSearchInput = document.querySelector("#nav-control-search-input");
  const navControlMenuInitial = document.querySelector("#nav-control-menu-initial");
  const navControlMenuSearch = document.querySelector("#nav-control-menu-search");
  const navControlDates = document.querySelector("#nav-control-dates");
  const navControlMenuDates = document.querySelector("#nav-control-menu-dates");
  const navControlClearButton = document.querySelector("#nav-control-clear-button");
  const navControlSubmitButton = document.querySelector("#nav-control-submit-button");
  const navControlDateSubmitButton = document.querySelector("#nav-control-date-submit-button");

  const formSearchInput = document.querySelector("#formSearchInput");
  const formNavRegionInput = document.querySelector("#formNavRegionInput");

  const navCtaMobile = document.querySelector("#nav-cta-mobile");
  const navSearchModal = document.getElementById("navSearchModal");
  const navSearchModalClose = document.getElementById("navSearchModalClose");

  // cta & control interaction -----------------------------------------------------------------------------------------------------

  navCtaMobile.addEventListener("click", (event) => {
    activeMobileSearch();
  });
  navSearchModalClose.addEventListener("click", (event) => {
    closeMobileSearch();
  });

  navCta.addEventListener("click", (event) => {
    const isDates = document.querySelector(".nav-search-cta__input__dates").contains(event.target);
    activeSearch(isDates);
  });

  navControlSearch.addEventListener("click", (event) => {
    activeSearch();
  });
  navControlDates.addEventListener("click", (event) => {
    activeSearch(true);
  });

  navControlClearButton.addEventListener("click", (event) => {
    navControlSearchInput.value = "";
    activeSearch();
  });

  function activeMobileSearch() {
    navSearchModal.style.display = "flex";
    body.classList.add("no-scroll");
  }

  function closeMobileSearch() {
    navSearchModal.style.display = "none";
    body.classList.remove("no-scroll");
  }

  function activeSearch(isDates) {
    navMain.classList.add("active");
    navCta.style.display = "none";
    navControl.classList.add("active");
    if (isDates) {
      navControlDates.classList.add("active");
      navControlMenuDates.classList.add("active");
      navControlSearch.classList.remove("active");
      navControlMenuInitial.classList.remove("active");
      navControlMenuSearch.classList.remove("active");
    } else {
      navControlSearch.classList.add("active");
      navControlMenuInitial.classList.add("active");
      navControlDates.classList.remove("active");
      navControlMenuDates.classList.remove("active");
      navControlSearchInput.focus();
      checkSearchMenu(true);
    }
  }

  // initial menu items click behavior
  const navSearchItems = [...document.querySelectorAll(".nav-search-item")];
  navSearchItems.forEach((item) => {
    item.addEventListener("click", () => {
      let dataUrl = item.getAttribute("data-url");
      window.location.href = dataUrl;
      removeActiveSearch();
    });
  });

  // remove active search when click anywhere else
  document.addEventListener("click", (evt) => {
    const isNavCta = navCta.contains(evt.target);
    const isNavControl = navControl.contains(evt.target);
    const isNavControlMenuInitial = navControlMenuInitial.contains(evt.target);
    const isNavControlMenuSearch = navControlMenuSearch.contains(evt.target);
    const isNavControlMenuDates = navControlMenuDates.contains(evt.target);

    if (!isNavCta && !isNavControl && !isNavControlMenuInitial && !isNavControlMenuSearch && !isNavControlMenuDates) {
      removeActiveSearch();
    }
  });

  function removeActiveSearch() {
    navCta.style.display = "grid";
    navControl.classList.remove("active");
    navControlSearch.classList.remove("active");
    navControlMenuInitial.classList.remove("active");
    navControlMenuSearch.classList.remove("active");
    navControlDates.classList.remove("active");
    navControlMenuDates.classList.remove("active");
  }

  // search field input -----------------------------------------------------------------------------------------------------
  navControlSearchInput.addEventListener("input", (event) => {
    formSearchInput.value = navControlSearchInput.value;
    checkSearchMenu();
  });

  function checkSearchMenu(initial = false) {
    if (navControlSearchInput.value.length < 3) {
      navControlMenuInitial.classList.add("active");
      navControlMenuSearch.classList.remove("active");
      navControlClearButton.classList.remove("active");
    } else {
      navControlMenuInitial.classList.remove("active");
      navControlClearButton.classList.add("active");
      if (!initial) {
        delayedSearch();
      } else {
        navControlMenuSearch.classList.add("active");
      }
    }
  }

  // delay ajax search
  var timeout = null;
  function delayedSearch() {
    navControlMenuSearch.classList.remove("active");
    if (timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(function () {
      performSearch();
    }, 300);
  }

  // ajax call / submit form
  var jqxhr = { abort: function () {} };
  function performSearch() {
    var navSearchForm = $("#nav-search-form");
    jqxhr.abort();
    jqxhr = $.ajax({
      url: navSearchForm.attr("action"),
      data: navSearchForm.serialize(),
      type: navSearchForm.attr("method"),
      beforeSend: function () {
        navControl.classList.add("loading");
      },
      success: function (data) {
        navControl.classList.remove("loading");
        navControlMenuSearch.innerHTML = data; // return the markup
        navControlMenuSearch.classList.add("active");

        // add click behavior for results
        const navSearchItems = [...document.querySelectorAll(".nav-search-item")];
        navSearchItems.forEach((item) => {
          item.addEventListener("click", () => {
            let dataUrl = item.getAttribute("data-url");
            window.location.href = dataUrl;
            removeActiveSearch();
          });
        });
      },
    });
  }

  // check for enter key pressed
  navControlSearchInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      performSubmit();
    }
  });

  // submit button clicked
  navControlSubmitButton.addEventListener("click", (event) => {
    performSubmit();
  });

  navControlDateSubmitButton.addEventListener("click", (event) => {
    performSubmit();
  });

  // date components -----------------------------------------------------------------------------------------------------
  let selectedRegion = formNavRegionInput.value;
  let selectedSeasonHex = "";
  let selectedSeasonIndex = 0;

  // region buttons
  const dateRegionButtons = [...document.querySelectorAll(".nav-dates-menu__section__buttons--regions button")];

  // region buttons click event
  dateRegionButtons.forEach((button) => {
    button.addEventListener("click", () => {
      dateRegionButtons.forEach((b) => {
        b.classList.remove("active");
      });
      button.classList.add("active");
      selectedRegion = button.getAttribute("region");
      filterSeasonButtons(selectedRegion);
    });
  });

  // season buttons
  const dateSeasonButtons = [...document.querySelectorAll(".nav-dates-menu__section__buttons--seasons button")];

  // season buttons click event
  dateSeasonButtons.forEach((button) => {
    button.addEventListener("click", () => {
      dateSeasonButtons.forEach((b) => {
        b.classList.remove("active");
      });
      button.classList.add("active");
      selectedSeasonHex = button.getAttribute("season");
      selectedSeasonIndex = button.getAttribute("index");

      filterDateCards();
    });
  });

  function filterSeasonButtons() {
    dateSeasonButtons.forEach((button) => {
      button.classList.remove("active");
      console.log(selectedSeasonIndex);

      if (selectedSeasonIndex == -1) {
        selectedSeasonIndex = 0;
      }

      if (button.getAttribute("region") == selectedRegion) {
        button.style.display = "flex";
        if (button.getAttribute("index") == selectedSeasonIndex) {
          button.classList.add("active");
          selectedSeasonHex = button.getAttribute("season");
        }
      } else {
        button.style.display = "none";
      }
      filterDateCards();
    });
  }

  const dateCards = [...document.querySelectorAll(".date-card")];

  function filterDateCards() {
    dateCards.forEach((item) => {
      if (item.getAttribute("season") == selectedSeasonHex) {
        item.style.display = "flex";
      } else {
        item.style.display = "none";
        item.classList.remove("selected");
      }
    });
    checkDates();
  }

  // on click date cards
  dateCards.forEach((dateCard) => {
    dateCard.addEventListener("click", () => {
      if (dateCard.classList.contains("selected")) {
        dateCard.classList.remove("selected");
      } else {
        dateCard.classList.add("selected");
      }
      checkDates();
    });
  });

  let selectedDates = [];
  function checkDates() {
    selectedDates = [];
    dateCards.forEach((dateCard) => {
      // if selected
      if (dateCard.classList.contains("selected")) {
        let dateValue = dateCard.getAttribute("date-value");
        selectedDates.push(dateValue);
      }
    });

    if (selectedDates.length == 0 && selectedSeasonIndex != 0) {
      // if no selection, and not initial season select all dates
      dateCards.forEach((dateCard) => {
        if (dateCard.getAttribute("season") == selectedSeasonHex) {
          let dateValue = dateCard.getAttribute("date-value");
          selectedDates.push(dateValue);
        }
      });
    }

    document.getElementById("formNavDateInput").value = selectedDates;
    dateRegionButtons.forEach((button) => {
      if (button.classList.contains("active")) {
        selectedRegion = button.getAttribute("region");
        document.getElementById("formNavRegionInput").value = button.getAttribute("region");
      }
    });
  }

  function performSubmit() {
    // dates
    if (navControlDates.classList.contains("active")) {
      document.querySelector(".nav-dates-menu__loading").style.display = "flex";
      if (selectedDates.length > 0) {
        const dateString = selectedDates.join("%3B");
        window.location.href = defaultSearchUrl + "?region=" + selectedRegion + "&departures=" + dateString;
      } else {
        window.location.href = defaultSearchUrl + "?region=" + selectedRegion;
      }
    } else {
      // search
      if (!navControl.classList.contains("loading")) {
        let navSearchItems = [...document.querySelectorAll(".nav-search-item--result")];
        if (navSearchItems.length > 0) {
          window.location.href = navSearchItems[0].getAttribute("data-url");
        } else {
          window.location.href = defaultSearchUrl;
        }
      }
    }
  }

  // HEADER ---------------------------------------------------------------------------------------------------------------------------
  // ----------------------------------------------------------------------------------------------------------------------------------
  // set header style
  let opaqueNavAlways = header_vars.alwaysActiveHeader;
  let fixedHeader = headerDiv.classList.contains("fixed");

  // apply header styles on scroll if fixed header
  if (fixedHeader == true) {
    window.addEventListener("scroll", applyNavStyle);
  }

  if (fixedHeader == false) {
    window.addEventListener("scroll", clearMega);
  }

  applyNavStyle();
  function applyNavStyle() {
    const megaActive = navMega.classList.contains("active");
    removeActiveSearch(); // reset search

    if (window.scrollY == 0) {
      // reduce size (height)
      navMain.classList.remove("small-nav");
      if (!megaActive) {
        navBackdrop.classList.remove("active");
      }
    } else {
      navMain.classList.add("small-nav");
    }

    if (!opaqueNavAlways && !megaActive) {
      // set active bg past threshold
      if (window.scrollY > 150) {
        navMain.classList.add("active");
      } else {
        navMain.classList.remove("active");
        navBackdrop.classList.remove("active");
      }
    }
  }

  // main nav hover
  navMain.addEventListener("mouseover", () => {
    navMain.classList.add("active");
  });
  navMain.addEventListener("mouseout", () => {
    var megaActive = navMega.classList.contains("active");
    var searchActive = navControl.classList.contains("active");
    var scrolledDown = window.scrollY > 300 ? true : false;
    if (!opaqueNavAlways && !scrolledDown && !megaActive && !searchActive) {
      navMain.classList.remove("active");
    }
    if (!megaActive) {
      navBackdrop.classList.remove("active");
    }
  });

  // nav link click
  navMainLinks.forEach((item) => {
    item.addEventListener("click", () => {
      navMainLinks.forEach((link) => {
        link.classList.remove("active"); // set active link
      });
      item.classList.add("active");

      var panelId = item.getAttribute("navelement"); // set active panel
      activateMega(panelId);
    });
  });

  // activate mega menu
  function activateMega(panelId) {
    navMega.classList.add("active");
    navMain.classList.add("mega-active");
    navBackdrop.classList.add("active");

    const panelTarget = document.querySelector(".nav-mega__panel[panel='" + panelId + "']");
    megaPanels.forEach((panel) => {
      panel.classList.remove("active");
    });
    panelTarget.classList.add("active");
    removeActiveSearch();
  }

  // remove mega when click anywhere else
  document.addEventListener("click", (evt) => {
    let isNavMainLink = false;
    navMainLinks.forEach((link) => {
      if (link.contains(evt.target)) {
        isNavMainLink = true;
      }
    });

    let isNavMega = navMega.contains(evt.target);

    if (!isNavMainLink && !isNavMega) {
      clearMega();
    }
  });

  // clear mega menu
  function clearMega() {
    navMega.classList.remove("active");
    navMain.classList.remove("mega-active");
    navBackdrop.classList.remove("active");
    navMainLinks.forEach((link) => {
      link.classList.remove("active");
    });
  }

  // mega category sliders (cruises - routes / themes)
  const categorySliderSections = [...document.querySelectorAll(".mega-slider--category")];
  categorySliderSections.forEach((section, index) => {
    new Swiper("#mega-category-slider-" + index, {
      spaceBetween: 15,
      slidesPerView: 5,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".mega-category-slider-btn-next-" + index,
        prevEl: ".mega-category-slider-btn-prev-" + index,
      },
    });
  });

  // mega category sliders (cruises - routes / themes)
  const shipsSliderSections = [...document.querySelectorAll(".mega-slider--ships")];
  shipsSliderSections.forEach((section, index) => {
    new Swiper("#mega-ships-slider-" + index, {
      spaceBetween: 15,
      slidesPerView: 4,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".mega-ships-slider-btn-next-" + index,
        prevEl: ".mega-ships-slider-btn-prev-" + index,
      },
    });
  });
});
