
jQuery(document).ready(function ($) {

  //Element variables
  const searchMobileCTA = document.getElementById('search-filter-mobile-cta');
  const searchFilterBar = document.getElementById('search-filter-bar');
  const searchSortControl = document.getElementById('sort-control');
  const searchResultsTop = document.getElementById('search-results-top');
  const searchContent = document.getElementById("search-page-content");
  const searchIntro = document.getElementById('search-page-intro');
  const searchFilterButton = document.getElementById('search-filter-bar-button');
  const searchSidebar = document.getElementById('search-sidebar');
  const searchMobileClose = document.getElementById('search-sidebar-mobile-close-button');
  const searchIntroContent = document.getElementById('search-intro-content');
  const mobileFiltersDiv = document.getElementById('search-filter-mobile-area');
  const showResultsButton = document.getElementById('search-filter-mobile-cta-button');


  function showMobileFilters() {
    searchSidebar.classList.add('show');
    document.body.classList.add('lock-scroll');
    searchMobileCTA.style.display = 'flex';
    mobileFiltersDiv.appendChild(searchSidebar);
    mobileFiltersDiv.classList.add('active');
  }

  function hideMobileFilters() {
    searchSidebar.classList.remove('show');
    document.body.classList.remove('lock-scroll');
    searchMobileCTA.style.display = 'none';
    searchContent.insertBefore(searchSidebar, searchContent.firstChild);
    mobileFiltersDiv.classList.remove('active');
  }


  //move sort filter -- initial
  if ($(window).width() < 1000) {
    searchFilterBar.appendChild(searchSortControl)
  }
  else {
    searchResultsTop.appendChild(searchSortControl)
  }

  //move elements on resize
  $(window).resize(function () {
    if ($(window).width() < 1000) { //mobile view    
      //sort control
      if (searchFilterBar.contains(searchSortControl) == false) {
        searchFilterBar.appendChild(searchSortControl)
      }
      //sidebar
      if (mobileFiltersDiv.contains(searchSidebar) == false) {
        mobileFiltersDiv.appendChild(searchSidebar);
      }
    }
    else { //desktop view    
      hideMobileFilters();
      //sort control
      if (searchResultsTop.contains(searchSortControl) == false) {
        searchResultsTop.appendChild(searchSortControl);
      }
      //sidebar
      if (searchContent.contains(searchSidebar) == false) {
        searchContent.insertBefore(searchSidebar, searchContent.firstChild);
      }

    }
  });

  //sticky on scroll  
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


  //FORM ----------------
  //form variables
  const searchInput = document.querySelector('#searchInput');
  const searchInputButton = document.querySelector('#searchInputButton');
  const searchInputClear = document.querySelector('#searchInputClear');

  let hasSearchInput = false;
  if (searchInput != null) {
    hasSearchInput = true;
  }

  const formViewType = document.querySelector('#formViewType');
  const selectItinerariesView = document.querySelector('#view-itineraries');
  const selectShipsView = document.querySelector('#view-ships');
  const selectDeparturesView = document.querySelector('#view-departures');


  //View Type
  selectItinerariesView.addEventListener('click', () => {
    formViewType.value = 'search-itineraries';
    selectItinerariesView.classList.add('active');
    selectShipsView.classList.remove('active');
    selectDeparturesView.classList.remove('active');
    reloadResults();
  })
  selectShipsView.addEventListener('click', () => {
    formViewType.value = 'search-ships';
    selectShipsView.classList.add('active');
    selectItinerariesView.classList.remove('active');
    selectDeparturesView.classList.remove('active');
    reloadResults();
  })
  selectDeparturesView.addEventListener('click', () => {
    formViewType.value = 'search-departures';
    selectDeparturesView.classList.add('active');
    selectShipsView.classList.remove('active');
    selectItinerariesView.classList.remove('active');
    reloadResults();
  })



  const formDates = document.querySelector('#formDates');
  const formTravelStyles = document.querySelector('#formTravelStyles');
  const formDestinations = document.querySelector('#formDestinations');
  const formExperiences = document.querySelector('#formExperiences');
  const formMinLength = document.querySelector('#formMinLength');
  const formMaxLength = document.querySelector('#formMaxLength');
  const formSort = document.querySelector('#formSort');
  const formPageNumber = document.querySelector('#formPageNumber');

  //Do Search
  //filter button click -- show menu 
  searchFilterButton.addEventListener('click', () => {
    showMobileFilters();
  });

  //hide menu
  searchMobileClose.addEventListener('click', () => {
    hideMobileFilters();
  });
  //hide menu
  showResultsButton.addEventListener('click', () => {
    hideMobileFilters();
    if (mobileReload == true) {
      reloadResults();
      mobileReload = false;

    }
    //if text in the input...
  });

  //Expand Lists --------------------------------------------
  // Departure List -- Show More Dates
  $("#departure-show-more").click(function () {
    toggleDeparturesExpanded();
  });

  const toggleDeparturesExpanded = () => {
    $("#departure-filter-list").toggleClass("expanded");
    var isExpanded = $("#departure-filter-list").hasClass("expanded");
    if (isExpanded == true) {
      $('#departure-show-more').html("Show Less");
    } else {
      $('#departure-show-more').html("Show More");
    }
  }

  //expand if hidden checkbox is selected upon page load
  const departureDatesExpandedArray = [...document.querySelectorAll('.checkbox-expand-group')];
  let hasExpanded = false;
  departureDatesExpandedArray.forEach(item => {
    if (item.checked == true) {
      hasExpanded = true;
    }
  })
  if (hasExpanded == true) {
    toggleDeparturesExpanded();
  }


  //Intro Snippet
  $(".search-intro__content__title").on("click", function (e) {
    e.preventDefault();
    $(this).parent().find('.search-intro__content__text').slideToggle(350);
    $(this).toggleClass('search-intro__content__title--collapsed');
  });

  //Search Filters expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    $(this).parent().find('.filter__content').slideToggle(350);
    $(this).parent().find('.filter__heading').toggleClass('closed');
  });




  //Search Filter Selections ------------------------------------


  //Search Input 
  let searchInputString = formSearchInput.value;
  let mobileReload = false; //check to perform search when hiding mobile filters

  if (hasSearchInput) {

    //magnifying glass click
    searchInputButton.addEventListener('click', () => {
      searchInputString = searchInput.value
      formSearchInput.value = searchInputString;
      reloadResults();
      hideMobileFilters();
      mobileReload = false;
    })


    //Focus - on setting focus to destination field 
    searchInput.addEventListener('focus', () => {
      if (searchInput.value != "") {
        searchInputClear.classList.add('active');
      }
    });

    //Blur - leave focus
    searchInput.addEventListener('blur', (event) => {
      searchInputClear.classList.remove('active');
      searchInputString = searchInput.value
      formSearchInput.value = searchInputString;
    });


    // Input - occurs on typing text into destination field
    searchInput.addEventListener('input', () => {
      searchInputClear.classList.add('active');
      searchInputString = searchInput.value
      formSearchInput.value = searchInputString;
      mobileReload = true;

      if (searchInput.value == "") {
        searchInputClear.classList.remove('active');
      }
    });


    //Search Input Clear
    searchInputClear.addEventListener('mousedown', (e) => {
      e.preventDefault();
      searchInput.value = "";
      searchInputString = "";
      formSearchInput.value = "";
      searchInputClear.classList.remove('active');
      mobileReload = true;
    });


    // Search Enter - Number 13 is the "Enter" key on the keyboard
    searchInput.addEventListener("keyup", function (event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        searchInputButton.click();
      }
    });

  };



  //Departure Date selections
  let departuresString = formDates.value;
  const departureDatesArray = [...document.querySelectorAll('.departure-checkbox')];
  departureDatesArray.forEach(item => {
    item.addEventListener('click', () => {
      departuresString = "";
      let count = 0;
      departureDatesArray.forEach(checkbox => {
        const itemValue = checkbox.value;

        if (checkbox.checked) {

          if (count > 0) {
            departuresString += ";";
          }
          departuresString += itemValue;
          count++;
        }
      })

      //filter count
      let departuresFilterCount = document.getElementById('departuresFilterCount');
      if (count > 0) {
        departuresFilterCount.classList.add("show");
        departuresFilterCount.innerHTML = count;
      } else {
        departuresFilterCount.classList.remove("show");
        departuresFilterCount.innerHTML = count;
      }
      formDates.value = departuresString;
      reloadResults();

    });
  })


  // checkNonCruiseDestinations();
  // function checkNonCruiseDestinations() {
  //   const nonCruiseCheckboxes = [...document.querySelectorAll('.no-cruise')];
  //   if (formTravelStyles.value == 'rfc_cruises' || formTravelStyles.value == 'charter_cruises') {

  //     nonCruiseCheckboxes.forEach(x => {
  //       x.style.display = 'none';
  //       //would need to uncheck and remove ID from form/url
  //     })
  //   } else {
  //     nonCruiseCheckboxes.forEach(x => {
  //       x.style.display = 'block';
  //     })
  //   }
  // }

  // routes selections
  let routesString = formRoutes.value;
  const routesArray = [...document.querySelectorAll('.route-checkbox')];
  routesArray.forEach(item => {
    item.addEventListener('click', () => {
      routesString = "";
      let count = 0;
      routesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {
          if (count > 0) {
            routesString += ";";
          }
          routesString += itemValue;
          count++;
        }
      })

      //filter count
      let routesFilterCount = document.getElementById('routesFilterCount');
      if (count > 0) {
        routesFilterCount.classList.add("show");
        routesFilterCount.innerHTML = count;
      } else {
        routesFilterCount.classList.remove("show");
        routesFilterCount.innerHTML = count;
      }

      formRoutes.value = routesString;
      reloadResults();
    });
  })

  // themes selections
  let themesString = formThemes.value;
  const themesArray = [...document.querySelectorAll('.theme-checkbox')];
  themesArray.forEach(item => {
    item.addEventListener('click', () => {
      themesString = "";
      let count = 0;
      themesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {

          if (count > 0) {
            themesString += ";";
          }
          themesString += itemValue;
          count++;
        }

      });

      //filter count
      let themesFilterCount = document.getElementById('themesFilterCount');
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
  })

  var lengthSliderMin = 1;
  var lengthSliderMax = 21

  //Length Slider
  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: lengthSliderMin, //default
    max: lengthSliderMax, //default
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



  //Clear 
  const clearButtons = [...document.querySelectorAll('.clear-filters')];
  const checkBoxes = [...document.querySelectorAll('.checkbox')];
  const filterCounts = [...document.querySelectorAll('.filter__heading__text__count')];

  clearButtons.forEach(item => {
    item.addEventListener('click', () => {
      clearFilters();
    });
  })

  let noResultsClearButton = document.querySelector('#no-results-clear-button');
  if (noResultsClearButton != null) {
    noResultsClearButton.addEventListener('click', (e) => {
      clearFilters();
    })
  }


  function clearFilters() {
    departuresString = "";
    themesString = "";
    routesString = "";
    searchInputString = "";

    formSearchInput.value = null;
    formDates.value = null;
    formThemes.value = null;
    formRoutes.value = null;

    formMinLength.value = lengthSliderMin;
    formMaxLength.value = lengthSliderMax;

    var lengthSlider = $("#range-slider").data("ionRangeSlider");
    lengthSlider.update({
      from: lengthSliderMin,
      to: lengthSliderMax
    });

    filterCounts.forEach(item => {
      item.classList.remove("show");
    });

    checkBoxes.forEach(item => {
      item.checked = false;
    });
    if (hasSearchInput) {
      searchInput.value = "";
    }


    reloadResults();
  }

  //Sorting
  $('#result-sort').select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
  });

  $('#result-sort').on('change', function () {
    formSort.value = $(this).val();
    formPageNumber.value = 1;
    reloadResults();
  });

  $('#result-sort').select2('destroy');
  $('#result-sort').val(formSort.value).select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,

  });
  toggleClearButtons();


  //RELOAD RESULTS -------------------------------------------------------------------------------------------------------------------------------------------
  function reloadResults(preservePage) {

    //set url params
    const params = new URLSearchParams(location.search);

    if (searchInputString != null) {
      params.set('searchInput', searchInputString);
    }

    if (departuresString != null) {
      params.set('departures', departuresString);
    }

    if (routesString != null) {
      params.set('routes', routesString);
    }

    if (themesString != null) {
      params.set('themes', themesString);
    }

    if (formMinLength.value != null) {
      params.set('length_min', formMinLength.value);
    }

    if (formMinLength.value != null) {
      params.set('length_max', formMaxLength.value);
    }

    if (formSort.value != null) {
      params.set('sorting', formSort.value);
    }

    if (formViewType.value != null) {
      params.set('viewType', formViewType.value);
    }


    if (preservePage == true) { // for when page numbers are clicked, otherwise page will always be reset to 1
      if (formPageNumber.value != null) {
        params.set('pageNumber', formPageNumber.value);
      }
      if (formPageNumber.value != 'all') {
        $('body, html, .search-results').animate({ scrollTop: 0 }, "fast"); // paging scroll up
      }
    } else {
      formPageNumber.value = 1;
      params.set('pageNumber', formPageNumber.value);
    }

    if ($(window).width() < 1000 && formPageNumber.value != 'all') {
      $('body, html, .search-results').animate({ scrollTop: 0 }, "fast"); //paging scroll up
    }

    window.history.replaceState({}, '', `${location.pathname}?${params}`);

    //ajax call / submit form
    var searchForm = $('#search-form');
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(),
      type: searchForm.attr('method'),
      beforeSend: function () {
        $('#response').addClass('loading'); //indicate loading
        $('.search-sidebar').addClass('loading'); //indicate loading
        $("#response").append('<div class="lds-ring lds-ring--large"><div></div><div></div><div></div><div></div></div>');
        $('#response-count').html('Searching...');

        showResultsButton.innerHTML = `<div class="lds-ring"><div></div><div></div><div></div><div></div></div>`

        //Need to hide clear button immediately 
        hideClearButtons();
      },
      success: function (data) {
        $('#response').removeClass('loading');
        $('.search-sidebar').removeClass('loading'); //indicate loading
        $(".lds-ring").remove();

        toggleClearButtons();
        $('#response').html(data); //return the markup -- content-primary-search-results.php

        var resultCount = $('#totalResultsDisplay').attr('value');
        var pageNumberDisplay = $('#pageNumberDisplay').attr('value');
        var viewTypeDisplay = $('#viewTypeDisplay').attr('value');

        $('#response').removeClass('search-itineraries');
        $('#response').removeClass('search-ships');
        $('#response').removeClass('search-departures');
        $('#response').addClass(viewTypeDisplay);

        // top area text
        let pageDisplay = (pageNumberDisplay > 1) ? " (Page " + pageNumberDisplay + ")" : ""; //show page number if not on page 1   
        var resultCountDisplay = ""
        if (resultCount == 1) {
          resultCountDisplay = "Found " + resultCount + " result"
          showResultsButton.textContent = "See " + resultCount + " result";
        } else if (resultCount == 0) {
          resultCountDisplay = "No results found"
          showResultsButton.textContent = "No results found";
        } else {
          resultCountDisplay = "Found " + resultCount + " results" + pageDisplay;
          showResultsButton.textContent = "See " + resultCount + " results";
        }
        $('#response-count').html(resultCountDisplay);


        let noResultsClearButton = document.querySelector('#no-results-clear-button');
        if (noResultsClearButton != null) {
          noResultsClearButton.addEventListener('click', (e) => {
            clearFilters();
          })
        }


        let pageButtonArray = [...document.querySelectorAll('.search-results-area__grid__pagination__pages-group__button')];
        let showAllButton = document.getElementById('show-all-pages-button');
        showAllButton.addEventListener('click', (e) => {
          $("#formPageNumber").val('all');
          reloadResults(true);
        })
        //post-ajax loaded button js
        pageButtonArray.forEach(item => {
          item.addEventListener('click', (e) => {
            var pageNumber = item.value;
            if (!item.classList.contains('current') && !item.classList.contains('disabled')) {

              // next button
              if (item.classList.contains('search-results-area__grid__pagination__pages-group__button--next-button')) {
                var pageGoTo = (+pageNumberDisplay + 1);
                $("#formPageNumber").val(pageGoTo);

                // back button
              } else if (item.classList.contains('search-results-area__grid__pagination__pages-group__button--back-button')) {
                var pageGoTo = (+pageNumberDisplay - 1);
                $("#formPageNumber").val(pageGoTo);

                // page number
              } else {
                var pageNumber = item.value;
                $("#formPageNumber").val(pageNumber);
              }
              reloadResults(true);
            }

          });
        })

      }
    });
  }


  //pagination js
  let pageButtonArray = [...document.querySelectorAll('.search-results-area__grid__pagination__pages-group__button')];
  let showAllButton = document.getElementById('show-all-pages-button');
  showAllButton.addEventListener('click', (e) => {
    $("#formPageNumber").val('all');
    reloadResults(true);
  })

  pageButtonArray.forEach(item => {
    item.addEventListener('click', (e) => {
      var pageNumberDisplay = formPageNumber.value;
      var pageNumber = item.value;

      if (!item.classList.contains('current') && !item.classList.contains('disabled')) {

        // next button
        if (item.classList.contains('search-results-area__grid__pagination__pages-group__button--next-button')) {
          var pageGoTo = (+pageNumberDisplay + 1);
          $("#formPageNumber").val(pageGoTo);

          // back button
        } else if (item.classList.contains('search-results-area__grid__pagination__pages-group__button--back-button')) {
          var pageGoTo = (+pageNumberDisplay - 1);
          $("#formPageNumber").val(pageGoTo);
          
          // pages button
        } else {
          var pageNumber = item.value;
          $("#formPageNumber").val(pageNumber);
        }
        reloadResults(true);
      }
    });
  })


  //clear filters button handling
  function hideClearButtons() {

    let clearArea = document.querySelector('.filter--clear');
    const clearButtons = [...document.querySelectorAll('.clear-filters')];

    clearArea.classList.remove('show');
    clearButtons.forEach(item => {
      item.classList.remove('show');
    })
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
    if (formRoutes.value != "") {
      filtersApplied = true;
    }

    if (formMinLength.value != lengthSliderMin) {
      filtersApplied = true;
    }
    if (formMaxLength.value != lengthSliderMax) {
      filtersApplied = true;
    }


    let clearArea = document.querySelector('.filter--clear');
    const clearButtons = [...document.querySelectorAll('.clear-filters')];
    if (filtersApplied == true) {
      clearArea.classList.add('show');
      searchFilterButton.classList.add('btn-pill--inverse');
      clearButtons.forEach(item => {
        item.classList.add('show');
      })

    } else {
      clearArea.classList.remove('show');
      searchFilterButton.classList.remove('btn-pill--inverse');
      clearButtons.forEach(item => {
        item.classList.remove('show');
      })
    }
  }




});


