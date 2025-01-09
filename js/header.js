jQuery(document).ready(function ($) {
  const headerDiv = document.querySelector(".header");
  const navMain = document.querySelector(".nav-main");
  const navCta = document.querySelector("#nav-cta");
  const navMega = document.querySelector(".nav-mega");
  const megaPanels = document.querySelectorAll(".nav-mega__panel");
  const navBackdrop = document.querySelector(".nav-backdrop");
  const navMainLinks = [...document.querySelectorAll(".nav-main__content__center__nav__list__item")];
  const navControl = document.querySelector("#nav-control");
  const navControlSearch = document.querySelector("#nav-control-search");
  const navControlMenuInitial = document.querySelector("#nav-control-menu-initial");
  const navControlMenuSearch = document.querySelector("#nav-control-menu-search");
  const navControlDates = document.querySelector("#nav-control-dates");
  const navControlMenuDates = document.querySelector("#nav-control-menu-dates");

  let templateName = header_vars.templateName;
  let postTypeName = header_vars.postTypeName;


  // template variables
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
  const allNavSliders = [];
  categorySliderSections.forEach((section, index) => {
    const slider = new Swiper("#mega-category-slider-" + index, {
      spaceBetween: 15,
      slidesPerView: 5,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".mega-category-slider-btn-next-" + index,
        prevEl: ".mega-category-slider-btn-prev-" + index,
      },
    });
    allNavSliders.push(slider);
  });

  // mega category sliders (cruises - routes / themes)
  const shipsSliderSections = [...document.querySelectorAll(".mega-slider--ships")];
  shipsSliderSections.forEach((section, index) => {
    const slider = new Swiper("#mega-ships-slider-" + index, {
      spaceBetween: 15,
      slidesPerView: 4,
      watchSlidesProgress: true,
      navigation: {
        nextEl: ".mega-ships-slider-btn-next-" + index,
        prevEl: ".mega-ships-slider-btn-prev-" + index,
      },
    });
    allNavSliders.push(slider);
  });

  //nav-region-select
  const navRegionSelects = [...document.querySelectorAll(".nav-region-select")];
  navRegionSelects.forEach((item) => {
    item.addEventListener("click", () => {
      const selectedRegion = item.getAttribute("region");
      filterSlides(selectedRegion);
    });
  });

  const navMegaItems = [...document.querySelectorAll(".nav-mega-item")];

  function filterSlides(regionId) {
    navMegaItems.forEach((item) => {
      item.style.display = "none";
      if (regionId == item.getAttribute("region") || item.getAttribute("region") == "all") {
        item.style.display = "";
      }
    });

    navRegionSelects.forEach((item) => {
      item.classList.remove("active");
      if (item.getAttribute("region") == regionId) {
        item.classList.add("active");
      }
    });

    allNavSliders.forEach((slider, index) => {
      slider.updateSize();
      slider.updateSlides();
      slider.updateProgress();
      slider.updateSlidesClasses();
      slider.slideTo(0);
      slider.scrollbar.updateSize();
    });
  }

  // remove on scroll
  function removeActiveSearch() {
    navCta.style.display = "grid";
    navControl.classList.remove("active");
    navControlSearch.classList.remove("active");
    navControlMenuInitial.classList.remove("active");
    navControlMenuSearch.classList.remove("active");
    navControlDates.classList.remove("active");
    navControlMenuDates.classList.remove("active");
  }

  // check region id
  function isIdInRegions(existingId, regionsAttribute) {
    if (!regionsAttribute) {
      return false;
    }
    var regionsIds = regionsAttribute.split(",");
    for (var i = 0; i < regionsIds.length; i++) {
      var id = regionsIds[i].trim();
      if (id === existingId) {
        return true; // ID found in regions
      }
    }
    return false; // ID not found in regions
  }

  checkFormFields();
  function checkFormFields() {
    console.log("check form");
    if(isSpecific){
      console.log("specific form");

    }


    if(postTypeName == "rfc_cruises" || postTypeName == "rfc_itineraries"){
      const extraFieldStartDate = document.querySelector(".extra-field-start-date");
      const extraFieldShipSize = document.querySelector(".extra-field-ship-size");
      const extraFieldBudget = document.querySelector(".extra-field-budget");
      const extraFieldItinerary = document.querySelector(".extra-field-itinerary");

      extraFieldStartDate?.style.display = "none";
      extraFieldShipSize?.style.display = "none";
      extraFieldBudget?.style.display = "none";
      extraFieldItinerary?.style.display = "none";
    }
  }
});
