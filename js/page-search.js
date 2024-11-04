jQuery(document).ready(function ($) {
  const searchMobileCTA = document.getElementById("search-filter-mobile-cta");
  const searchFilterBar = document.getElementById("search-filter-bar");
  const searchSortControl = document.getElementById("sort-control");
  const searchResultsTop = document.getElementById("search-results-top");
  const searchContent = document.getElementById("search-page-content");
  const searchIntro = document.getElementById("search-page-intro");
  const searchFilterButton = document.getElementById("search-filter-bar-button");
  const searchSidebar = document.getElementById("search-sidebar");
  const searchMobileClose = document.getElementById("search-sidebar-mobile-close-button");
  const searchIntroContent = document.getElementById("search-intro-content");
  const mobileFiltersDiv = document.getElementById("search-filter-mobile-area");
  const showResultsButton = document.getElementById("search-filter-mobile-cta-button");

  // move sort filter -- initial
  if ($(window).width() < 1000) {
    searchFilterBar.appendChild(searchSortControl);
  } else {
    searchResultsTop.appendChild(searchSortControl);
  }

  // move elements on resize
  $(window).resize(function () {
    if ($(window).width() < 1000) {
      //mobile view
      if (searchFilterBar.contains(searchSortControl) == false) {
        // sort control
        searchFilterBar.appendChild(searchSortControl);
      }
      if (mobileFiltersDiv.contains(searchSidebar) == false) {
        // sidebar
        mobileFiltersDiv.appendChild(searchSidebar);
      }
    } else {
      // desktop view
      hideMobileFilters();
      if (searchResultsTop.contains(searchSortControl) == false) {
        // sort control
        searchResultsTop.appendChild(searchSortControl);
      }
      if (searchContent.contains(searchSidebar) == false) {
        // sidebar
        searchContent.insertBefore(searchSidebar, searchContent.firstChild);
      }
    }
  });

  // sticky on scroll
  var threshhold = searchIntro.offsetHeight + 20;
  $(window).scroll(function () {
    if ($(this).scrollTop() > threshhold) {
      searchFilterBar.classList.add("sticky");
      searchIntroContent.classList.add("sticky-compensate");
    } else {
      searchFilterBar.classList.remove("sticky");
      searchIntroContent.classList.remove("sticky-compensate");
    }
  });

  function hideMobileFilters() {
    searchSidebar.classList.remove("show");
    document.body.classList.remove("lock-scroll");
    searchMobileCTA.style.display = "none";
    searchContent.insertBefore(searchSidebar, searchContent.firstChild);
    mobileFiltersDiv.classList.remove("active");
  }

  function showMobileFilters() {
    searchSidebar.classList.add("show");
    document.body.classList.add("lock-scroll");
    searchMobileCTA.style.display = "flex";
    mobileFiltersDiv.appendChild(searchSidebar);
    mobileFiltersDiv.classList.add("active");
  }

  // Inquire modal
  const inquireModal = document.querySelector("#inquireModal");
  const genericInquireCtaButtons = [...document.querySelectorAll(".generic-inquire-cta")];
  genericInquireCtaButtons.forEach((item) => {
    item.addEventListener("click", () => {
      inquireModal.style.display = "flex";
      body.classList.add("no-scroll");
    });
  });

  // Form ----------------
  const formViewType = document.querySelector("#formViewType");
  const formFilterDeals = document.querySelector("#formFilterDeals");
  const formFilterSpecials = document.querySelector("#formFilterSpecials");

  const formRegion = document.querySelector("#formRegion");
  const formDates = document.querySelector("#formDates");
  const formRoutes = document.querySelector("#formRoutes");
  const formCountries = document.querySelector("#formCountries");
  const formMinLength = document.querySelector("#formMinLength");
  const formMaxLength = document.querySelector("#formMaxLength");
  const formMinPrice = document.querySelector("#formMinPrice");
  const formMaxPrice = document.querySelector("#formMaxPrice");
  const formSort = document.querySelector("#formSort");
  const formPageNumber = document.querySelector("#formPageNumber");

  const searchInput = document.querySelector("#searchInput");
  const searchInputButton = document.querySelector("#searchInputButton");
  const searchInputClear = document.querySelector("#searchInputClear");
  let hasSearchInput = searchInput != null ? true : false;

  // View Type
  const selectItinerariesView = document.querySelector("#view-itineraries");
  const selectShipsView = document.querySelector("#view-ships");
  const selectDeparturesView = document.querySelector("#view-departures");
  selectItinerariesView.addEventListener("click", () => {
    formViewType.value = "search-itineraries";
    selectItinerariesView.classList.add("active");
    selectShipsView.classList.remove("active");
    selectDeparturesView.classList.remove("active");
    //searchSortControl.style.visibility = "visible";
    searchSortControl.style.display = "";

    reloadResults();
  });
  selectShipsView.addEventListener("click", () => {
    formViewType.value = "search-ships";
    selectShipsView.classList.add("active");
    selectItinerariesView.classList.remove("active");
    selectDeparturesView.classList.remove("active");
    //searchSortControl.style.visibility = "visible";
    searchSortControl.style.display = "";
    reloadResults();
  });
  selectDeparturesView.addEventListener("click", () => {
    formViewType.value = "search-departures";
    selectDeparturesView.classList.add("active");
    selectShipsView.classList.remove("active");
    selectItinerariesView.classList.remove("active");
    //searchSortControl.style.visibility = "hidden";
    searchSortControl.style.display = "none";
    reloadResults();
  });

  // show mobile filter menu
  searchFilterButton.addEventListener("click", () => {
    showMobileFilters();
  });

  // hide mobile filter menu
  searchMobileClose.addEventListener("click", () => {
    hideMobileFilters();
  });

  // show results / hide mobile filter menu
  showResultsButton.addEventListener("click", () => {
    hideMobileFilters();
    if (mobileReload == true) {
      reloadResults();
      mobileReload = false;
    }
    // if text in the input...
  });

  // show more dates button
  $("#departure-show-more").click(function () {
    toggleDeparturesExpanded();
  });
  const toggleDeparturesExpanded = () => {
    $("#departure-filter-list").toggleClass("expanded");
    var isExpanded = $("#departure-filter-list").hasClass("expanded");
    if (isExpanded == true) {
      $("#departure-show-more").html("Show Less");
    } else {
      $("#departure-show-more").html("Show More");
    }
  };

  // expand if hidden checkbox is selected upon page load
  const departureDatesExpandedArray = [...document.querySelectorAll(".checkbox-expand-group")];
  let hasExpanded = false;
  departureDatesExpandedArray.forEach((item) => {
    if (item.checked == true) {
      hasExpanded = true;
    }
  });
  if (hasExpanded == true) {
    toggleDeparturesExpanded();
  }

  // intro snippet
  $(".search-intro__content__title").on("click", function (e) {
    e.preventDefault();
    $(this).parent().find(".search-intro__content__text").slideToggle(350);
    $(this).toggleClass("search-intro__content__title--collapsed");
  });

  // filter groups expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    $(this).parent().find(".filter__content").slideToggle(350);
    $(this).parent().find(".filter__heading").toggleClass("closed");
  });

  // filter input --------------------------------------------------------------------------------
  // search input
  let searchInputString = formSearchInput.value;
  let mobileReload = false; //check to perform search when hiding mobile filters
  if (hasSearchInput) {
    searchInputButton.addEventListener("click", () => {
      // magnifying glass click
      searchInputString = searchInput.value;
      formSearchInput.value = searchInputString;
      reloadResults();
      hideMobileFilters();
      mobileReload = false;
    });

    // set focus to field
    searchInput.addEventListener("focus", () => {
      if (searchInput.value != "") {
        searchInputClear.classList.add("active");
      }
    });

    // leave focus
    searchInput.addEventListener("blur", (event) => {
      searchInputClear.classList.remove("active");
      searchInputString = searchInput.value;
      formSearchInput.value = searchInputString;
    });

    // input - occurs on typing text into destination field
    searchInput.addEventListener("input", () => {
      searchInputClear.classList.add("active");
      searchInputString = searchInput.value;
      formSearchInput.value = searchInputString;
      mobileReload = true;

      if (searchInput.value == "") {
        searchInputClear.classList.remove("active");
      }
    });

    // search input clear
    searchInputClear.addEventListener("mousedown", (e) => {
      e.preventDefault();
      searchInput.value = "";
      searchInputString = "";
      formSearchInput.value = "";
      searchInputClear.classList.remove("active");
      mobileReload = true;
    });

    // Search Enter - Number 13 is the "Enter" key on the keyboard
    searchInput.addEventListener("keyup", function (event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        searchInputButton.click();
      }
    });
  }

  // region selections
  let regionString = formRegion.value;
  const regionsArray = [...document.querySelectorAll(".region-checkbox")];

  regionsArray.forEach((item) => {
    item.addEventListener("click", () => {
      let count = 0; // get count of checked boxes
      regionsArray.forEach((checkbox) => {
        if (checkbox.checked) {
          count++;
        }
      });

      if (count == 1) {
        // set region value if one is checked
        regionsArray.forEach((checkbox) => {
          if (checkbox.checked) {
            regionString = parseInt(checkbox.value);
          }
        });
      } else {
        // set region to null if none or all are checked
        regionString = "";
      }

      //filter count
      let regionFilterCount = document.getElementById("regionFilterCount");
      if (count > 0) {
        regionFilterCount.classList.add("show");
        regionFilterCount.innerHTML = count;
      } else {
        regionFilterCount.classList.remove("show");
        regionFilterCount.innerHTML = count;
      }

      formRegion.value = regionString;
      hideRoutes(regionString);
      hideDepartures(regionString);
      hideCountries(regionString);
      reloadResults();
    });
  });

  // Embarkation Country
  // if country selected, hide and uncheck unrelated routes
  const countryGroupArray = [...document.querySelectorAll(".embark-checkbox-group")]; // li element of checkbox
  const countrySubtitleArray = [...document.querySelectorAll(".embark-subtitle")]; // subtitle elements
  function hideCountries(selectedRegion) {
    countrySubtitleArray.forEach((item) => {
      if (selectedRegion == "") {
        item.style.display = "block";
      } else {
        var regionId = item.getAttribute("region-value");
        if (regionId == selectedRegion) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      }
    });

    countryGroupArray.forEach((item) => {
      if (selectedRegion == "") {
        item.style.display = "block";
      } else {
        var regionId = item.getAttribute("region-value");
        if (regionId == selectedRegion) {
          item.style.display = "block";
        } else {
          var targetCheckbox = item.querySelectorAll(".embark-checkbox");
          $(targetCheckbox).prop("checked", false); // strange but vanilla js will not work
          item.style.display = "none";
        }
      }
    });
    computeCountriesString();
  }

  // countries selections
  let countriesString = formCountries.value;
  const countriesArray = [...document.querySelectorAll(".embark-checkbox")];
  countriesArray.forEach((item) => {
    item.addEventListener("click", () => {
      computeCountriesString();
      reloadResults();
    });
  });

  // build countries string / filter count based on current state
  function computeCountriesString() {
    countriesString = "";
    let count = 0;
    countriesArray.forEach((checkbox) => {
      const itemValue = parseInt(checkbox.value);
      if (checkbox.checked) {
        if (count > 0) {
          countriesString += ";";
        }
        countriesString += itemValue;
        count++;
      }
    });

    //filter count
    let embarkFilterCount = document.getElementById("embarkFilterCount");
    if (count > 0) {
      embarkFilterCount.classList.add("show");
      embarkFilterCount.innerHTML = count;
    } else {
      embarkFilterCount.classList.remove("show");
      embarkFilterCount.innerHTML = count;
    }
    formCountries.value = countriesString;
  }

  // if region selected, hide and uncheck unrelated routes
  const routeGroupArray = [...document.querySelectorAll(".route-checkbox-group")]; // li element of checkbox
  function hideRoutes(selectedRegion) {
    routeGroupArray.forEach((item) => {
      if (selectedRegion == "") {
        item.style.display = "block";
      } else {
        var regionId = item.getAttribute("region-value");
        if (regionId == selectedRegion) {
          item.style.display = "block";
        } else {
          var targetCheckbox = item.querySelectorAll(".route-checkbox");
          $(targetCheckbox).prop("checked", false); // strange but vanilla js will not work
          item.style.display = "none";
        }
      }
    });
    computeRoutesString();
  }

  // routes selections
  let routesString = formRoutes.value;
  const routesArray = [...document.querySelectorAll(".route-checkbox")];
  routesArray.forEach((item) => {
    item.addEventListener("click", () => {
      computeRoutesString();
      reloadResults();
    });
  });

  // build route string / filter count based on current state
  function computeRoutesString() {
    routesString = "";
    let count = 0;
    routesArray.forEach((checkbox) => {
      const itemValue = parseInt(checkbox.value);
      if (checkbox.checked) {
        if (count > 0) {
          routesString += ";";
        }
        routesString += itemValue;
        count++;
      }
    });

    //filter count
    let routesFilterCount = document.getElementById("routesFilterCount");
    if (count > 0) {
      routesFilterCount.classList.add("show");
      routesFilterCount.innerHTML = count;
    } else {
      routesFilterCount.classList.remove("show");
      routesFilterCount.innerHTML = count;
    }
    formRoutes.value = routesString;
  }

  const departureGroupArray = [...document.querySelectorAll(".departure-checkbox-group")]; // li element of checkbox
  function hideDepartures(selectedRegion) {
    departureGroupArray.forEach((item) => {
      if (selectedRegion == "") {
        item.style.display = "block";
      } else {
        var regionIdArray = item.getAttribute("region-value").split(",");
        var matchedRegion = false;
        regionIdArray.forEach((item) => {
          if (item == selectedRegion) {
            matchedRegion = true;
          }
        });

        if (matchedRegion) {
          item.style.display = "block";
        } else {
          var targetCheckbox = item.querySelectorAll(".departure-checkbox");
          $(targetCheckbox).prop("checked", false); // strange but vanilla js will not work
          item.style.display = "none";
        }
      }
    });
    computeDeparturesString();
  }

  // departure date selection
  let departuresString = formDates.value;
  const departureDatesArray = [...document.querySelectorAll(".departure-checkbox")];
  departureDatesArray.forEach((item) => {
    item.addEventListener("click", () => {
      computeDeparturesString();
      reloadResults();
    });
  });

  function computeDeparturesString() {
    departuresString = "";
    let count = 0;
    departureDatesArray.forEach((checkbox) => {
      const itemValue = checkbox.value;

      if (checkbox.checked) {
        if (count > 0) {
          departuresString += ";";
        }
        departuresString += itemValue;
        count++;
      }
    });

    //filter count
    let departuresFilterCount = document.getElementById("departuresFilterCount");
    if (count > 0) {
      departuresFilterCount.classList.add("show");
      departuresFilterCount.innerHTML = count;
    } else {
      departuresFilterCount.classList.remove("show");
      departuresFilterCount.innerHTML = count;
    }
    formDates.value = departuresString;
    reloadResults();
  }

  // themes selections
  let themesString = formThemes.value;
  const themesArray = [...document.querySelectorAll(".theme-checkbox")];
  themesArray.forEach((item) => {
    item.addEventListener("click", () => {
      themesString = "";
      let count = 0;
      themesArray.forEach((checkbox) => {
        const itemValue = parseInt(checkbox.value);
        if (checkbox.checked) {
          if (count > 0) {
            themesString += ";";
          }
          themesString += itemValue;
          count++;
        }
      });

      // filter count
      let themesFilterCount = document.getElementById("themesFilterCount");
      if (count > 0) {
        themesFilterCount.classList.add("show");
        themesFilterCount.innerHTML = count;
      } else {
        themesFilterCount.classList.remove("show");
        themesFilterCount.innerHTML = count;
      }
      formThemes.value = themesString;
      reloadResults();
    });
  });




  // ship selections
  let shipSizesString = formShipSizes.value;
  const shipSizesArray = [...document.querySelectorAll(".size-checkbox")];
  shipSizesArray.forEach((item) => {
    item.addEventListener("click", () => {
      shipSizesString = "";
      let count = 0;
      shipSizesArray.forEach((checkbox) => {
        const itemValue = parseInt(checkbox.value);
        if (checkbox.checked) {
          if (count > 0) {
            shipSizesString += ";";
          }
          shipSizesString += itemValue;
          count++;
        }
      });

      // filter count
      let shipSizesFilterCount = document.getElementById("sizesFilterCount");
      if (count > 0) {
        shipSizesFilterCount.classList.add("show");
        shipSizesFilterCount.innerHTML = count;
      } else {
        shipSizesFilterCount.classList.remove("show");
        shipSizesFilterCount.innerHTML = count;
      }
      formShipSizes.value = shipSizesString;
      reloadResults();
    });
  });



  // length slider
  var lengthSliderMin = 1;
  var lengthSliderMax = 28;
  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: lengthSliderMin,
    max: lengthSliderMax,
    from: formMinLength.value,
    to: formMaxLength.value,
    postfix: " Day",
    max_postfix: "+",
    onFinish: function () {
      formMinLength.value = $("#range-slider").data("from");
      formMaxLength.value = $("#range-slider").data("to");
      reloadResults();
    },
  });

  // price slider
  var priceSliderMin = 1;
  var priceSliderMax = 50000;
  $("#price-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: priceSliderMin,
    max: priceSliderMax,
    from: formMinPrice.value,
    to: formMaxPrice.value,
    prefix: "$",
    max_postfix: "+",
    onFinish: function () {
      formMinPrice.value = $("#price-slider").data("from");
      formMaxPrice.value = $("#price-slider").data("to");
      reloadResults();
    },
  });

  // extras -- deals + specials
  const filterDealsCheckbox = document.getElementById("deal-checkbox");
  filterDealsCheckbox.addEventListener("click", () => {
    formFilterDeals.value = filterDealsCheckbox.checked;
    reloadResults();
    calcExtrasFilterCount();
  });
  const filterSpecialsCheckbox = document.getElementById("special-checkbox");
  filterSpecialsCheckbox.addEventListener("click", () => {
    formFilterSpecials.value = filterSpecialsCheckbox.checked;
    reloadResults();
    calcExtrasFilterCount();
  });

  const extrasArray = [...document.querySelectorAll(".extras-checkbox")];
  function calcExtrasFilterCount() {
    let count = 0;
    extrasArray.forEach((checkbox) => {
      if (checkbox.checked) {
        count++;
      }
    });
    let extrasFilterCount = document.getElementById("extrasFilterCount");
    if (count > 0) {
      extrasFilterCount.classList.add("show");
      extrasFilterCount.innerHTML = count;
    } else {
      extrasFilterCount.classList.remove("show");
      extrasFilterCount.innerHTML = count;
    }
  }

  // clear
  const clearButtons = [...document.querySelectorAll(".clear-filters")];
  const checkBoxes = [...document.querySelectorAll(".checkbox")];
  const filterCounts = [...document.querySelectorAll(".filter__heading__text__count")];

  clearButtons.forEach((item) => {
    item.addEventListener("click", () => {
      clearFilters();
    });
  });

  let noResultsClearButton = document.querySelector("#no-results-clear-button");
  if (noResultsClearButton != null) {
    noResultsClearButton.addEventListener("click", (e) => {
      clearFilters();
    });
  }

  function clearFilters() {
    departuresString = "";
    themesString = "";
    shipSizesString = "";

    routesString = "";
    countriesString = "";
    searchInputString = "";

    formSearchInput.value = null;
    formDates.value = null;
    formThemes.value = null;
    formShipSizes.value = null;
    formRoutes.value = null;
    formCountries.value = null;

    formMinLength.value = lengthSliderMin;
    formMaxLength.value = lengthSliderMax;
    formMinPrice.value = priceSliderMin;
    formMaxPrice.value = priceSliderMax;
    formFilterDeals.value = null;
    formFilterSpecials.value = null;

    var lengthSlider = $("#range-slider").data("ionRangeSlider");
    lengthSlider.update({
      from: lengthSliderMin,
      to: lengthSliderMax,
    });

    var priceSlider = $("#price-slider").data("ionRangeSlider");
    priceSlider.update({
      from: priceSliderMin,
      to: priceSliderMax,
    });

    filterCounts.forEach((item) => {
      item.classList.remove("show");
    });

    checkBoxes.forEach((item) => {
      item.checked = false;
    });
    if (hasSearchInput) {
      searchInput.value = "";
    }

    reloadResults();
  }

  //Sorting
  $("#result-sort").select2({
    width: "auto",
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
  });

  $("#result-sort").on("change", function () {
    formSort.value = $(this).val();
    formPageNumber.value = 1;
    reloadResults();
  });

  $("#result-sort").select2("destroy");
  $("#result-sort").val(formSort.value).select2({
    width: "auto",
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
  });
  toggleClearButtons();

  //RELOAD RESULTS -------------------------------------------------------------------------------------------------------------------------------------------

  var jqxhr = { abort: function () {} };

  function reloadResults(preservePage) {
    jqxhr.abort();

    //set url params
    const params = new URLSearchParams(location.search);

    if (searchInputString != null) {
      params.set("searchInput", searchInputString);
    }

    if (regionString != null) {
      params.set("region", regionString);
    }

    if (departuresString != null) {
      params.set("departures", departuresString);
    }

    if (routesString != null) {
      params.set("routes", routesString);
    }

    if (countriesString != null) {
      params.set("countries", countriesString);
    }

    if (themesString != null) {
      params.set("themes", themesString);
    }

    if (shipSizesString != null) {
      params.set("shipSizes", shipSizesString);
    }


    if (formMinLength.value != null) {
      params.set("length_min", formMinLength.value);
    }

    if (formMaxLength.value != null) {
      params.set("length_max", formMaxLength.value);
    }

    if (formMinPrice.value != null) {
      params.set("price_min", formMinPrice.value);
    }

    if (formMaxPrice.value != null) {
      params.set("price_max", formMaxPrice.value);
    }

    if (formSort.value != null) {
      params.set("sorting", formSort.value);
    }

    if (formViewType.value != null) {
      params.set("viewType", formViewType.value);
    }

    if (formFilterDeals.value != null) {
      params.set("filterDeals", formFilterDeals.value);
    }
    if (formFilterSpecials.value != null) {
      params.set("filterSpecials", formFilterSpecials.value);
    }

    if (preservePage == true) {
      // for when page numbers are clicked, otherwise page will always be reset to 1
      if (formPageNumber.value != null) {
        params.set("pageNumber", formPageNumber.value);
      }
      if (formPageNumber.value != "all") {
        $("body, html, .search-results").animate({ scrollTop: 0 }, "fast"); // paging scroll up
      }
    } else {
      formPageNumber.value = 1;
      params.set("pageNumber", formPageNumber.value);
    }

    if ($(window).width() < 1000 && formPageNumber.value != "all") {
      $("body, html, .search-results").animate({ scrollTop: 0 }, "fast"); // paging scroll up
    }

    window.history.replaceState({}, "", `${location.pathname}?${params}`);

    //ajax call / submit form
    var searchForm = $("#search-form");

    jqxhr = $.ajax({
      url: searchForm.attr("action"),
      data: searchForm.serialize(),
      type: searchForm.attr("method"),
      beforeSend: function () {
        $("#response").addClass("loading"); //indicate loading
        $(".search-sidebar").addClass("loading"); //indicate loading
        $("#response").append('<div class="lds-ring lds-ring--large"><div></div><div></div><div></div><div></div></div>');
        $("#response-count").html("Searching...");

        showResultsButton.innerHTML = `<div class="lds-ring"><div></div><div></div><div></div><div></div></div>`;

        //Need to hide clear button immediately
        hideClearButtons();
      },
      success: function (data) {
        $("#response").removeClass("loading");
        $(".search-sidebar").removeClass("loading"); //indicate loading
        $(".lds-ring").remove();

        toggleClearButtons();
        $("#response").html(data); //return the markup -- content-primary-search-results.php

        var resultCount = $("#totalResultsDisplay").attr("value");
        var pageNumberDisplay = $("#pageNumberDisplay").attr("value");
        var viewTypeDisplay = $("#viewTypeDisplay").attr("value");

        $("#response").removeClass("search-itineraries");
        $("#response").removeClass("search-ships");
        $("#response").removeClass("search-departures");
        $("#response").addClass(viewTypeDisplay);

        // top area text
        let pageDisplay = pageNumberDisplay > 1 ? " (Page " + pageNumberDisplay + ")" : ""; //show page number if not on page 1
        var resultCountDisplay = "";
        if (resultCount == 1) {
          resultCountDisplay = "Found " + resultCount + " result";
          showResultsButton.textContent = "See " + resultCount + " result";
        } else if (resultCount == 0) {
          resultCountDisplay = "No results found";
          showResultsButton.textContent = "No results found";
        } else {
          resultCountDisplay = "Found " + resultCount + " results" + pageDisplay;
          showResultsButton.textContent = "See " + resultCount + " results";
        }
        $("#response-count").html(resultCountDisplay);

        let noResultsClearButton = document.querySelector("#no-results-clear-button");
        if (noResultsClearButton != null) {
          noResultsClearButton.addEventListener("click", (e) => {
            clearFilters();
          });
        }

        let pageButtonArray = [...document.querySelectorAll(".search-results-area__grid__pagination__pages-group__button")];
        let showAllButton = document.getElementById("show-all-pages-button");
        if (showAllButton) {
          showAllButton.addEventListener("click", (e) => {
            $("#formPageNumber").val("all");
            reloadResults(true);
          });
        }

        //post-ajax loaded button js
        pageButtonArray.forEach((item) => {
          item.addEventListener("click", (e) => {
            var pageNumber = item.value;
            if (!item.classList.contains("current") && !item.classList.contains("disabled")) {
              // next button
              if (item.classList.contains("search-results-area__grid__pagination__pages-group__button--next-button")) {
                var pageGoTo = +pageNumberDisplay + 1;
                $("#formPageNumber").val(pageGoTo);

                // back button
              } else if (item.classList.contains("search-results-area__grid__pagination__pages-group__button--back-button")) {
                var pageGoTo = +pageNumberDisplay - 1;
                $("#formPageNumber").val(pageGoTo);

                // page number
              } else {
                var pageNumber = item.value;
                $("#formPageNumber").val(pageNumber);
              }
              reloadResults(true);
            }
          });
        });
      },
    });
  }

  //pagination js
  let pageButtonArray = [...document.querySelectorAll(".search-results-area__grid__pagination__pages-group__button")];
  let showAllButton = document.getElementById("show-all-pages-button");
  if (showAllButton) {
    showAllButton.addEventListener("click", (e) => {
      $("#formPageNumber").val("all");
      reloadResults(true);
    });
  }

  pageButtonArray.forEach((item) => {
    item.addEventListener("click", (e) => {
      var pageNumberDisplay = formPageNumber.value;
      var pageNumber = item.value;

      if (!item.classList.contains("current") && !item.classList.contains("disabled")) {
        // next button
        if (item.classList.contains("search-results-area__grid__pagination__pages-group__button--next-button")) {
          var pageGoTo = +pageNumberDisplay + 1;
          $("#formPageNumber").val(pageGoTo);

          // back button
        } else if (item.classList.contains("search-results-area__grid__pagination__pages-group__button--back-button")) {
          var pageGoTo = +pageNumberDisplay - 1;
          $("#formPageNumber").val(pageGoTo);

          // pages button
        } else {
          var pageNumber = item.value;
          $("#formPageNumber").val(pageNumber);
        }
        reloadResults(true);
      }
    });
  });

  //clear filters button handling
  function hideClearButtons() {
    let clearArea = document.querySelector(".filter--clear");
    const clearButtons = [...document.querySelectorAll(".clear-filters")];

    clearArea.classList.remove("show");
    clearButtons.forEach((item) => {
      item.classList.remove("show");
    });
  }

  function toggleClearButtons() {
    let filtersApplied = false;
    if (formSearchInput.value != "") {
      filtersApplied = true;
    }
    if (formDates.value != "") {
      filtersApplied = true;
    }
    if (formThemes.value != "") {
      filtersApplied = true;
    }
    if (formShipSizes.value != "") {
      filtersApplied = true;
    }
    if (formRoutes.value != "") {
      filtersApplied = true;
    }
    if (formCountries.value != "") {
      filtersApplied = true;
    }

    if (formMinLength.value != lengthSliderMin) {
      filtersApplied = true;
    }
    if (formMaxLength.value != lengthSliderMax) {
      filtersApplied = true;
    }

    if (formMinPrice.value != priceSliderMin) {
      filtersApplied = true;
    }
    if (formMaxPrice.value != priceSliderMax) {
      filtersApplied = true;
    }

    if (formFilterDeals.value != "") {
      filtersApplied = true;
    }
    if (formFilterSpecials.value != "") {
      filtersApplied = true;
    }

    let clearArea = document.querySelector(".filter--clear");
    const clearButtons = [...document.querySelectorAll(".clear-filters")];
    if (filtersApplied == true) {
      clearArea.classList.add("show");
      searchFilterButton.classList.add("btn-pill--inverse");
      clearButtons.forEach((item) => {
        item.classList.add("show");
      });
    } else {
      clearArea.classList.remove("show");
      searchFilterButton.classList.remove("btn-pill--inverse");
      clearButtons.forEach((item) => {
        item.classList.remove("show");
      });
    }
  }

  // Travel Guide Slider
  new Swiper("#travel-guide-slider", {
    spaceBetween: 15,
    slidesPerView: 1.2,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".travel-guide-slider-btn-next",
      prevEl: ".travel-guide-slider-btn-prev",
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

  //faq modal
  const faqsModal = document.querySelector("#faqsModal");
  const faqsModalMainContent = document.querySelector("#faqsModalMainContent");
  const readAllFaqs = [...document.querySelectorAll(".read-all-faqs")];
  if (readAllFaqs) {
    readAllFaqs.forEach((item) => {
      item.addEventListener("click", () => {
        faqsModal.style.display = "flex";
        body.classList.add("no-scroll");
        const section = item.getAttribute("section");
        const modalDivSectionOffset = document.getElementById(section).offsetTop;
        faqsModalMainContent.scrollTop = modalDivSectionOffset - 120;
      });
    });
  }
});
