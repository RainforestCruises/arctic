
jQuery(document).ready(function ($) {
  const templateUrl = page_vars.templateUrl;


  function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  }


  //Element variables
  const searchMobileCTA = document.getElementById('search-filter-mobile-cta');
  const searchFilterBar = document.getElementById('search-filter-bar');
  const searchSortControl = document.getElementById('sort-control');
  const searchResultsTop = document.getElementById('search-results-top');
  const searchContent = document.getElementById("search-page-content");
  const searchIntro = document.getElementById('search-page-intro').offsetHeight;
  const searchFilterButton = document.getElementById('search-filter-bar-button');
  const searchSidebar = document.getElementById('search-sidebar');
  const searchMobileClose = document.getElementById('search-sidebar-mobile-close-button');
  const headerDiv = document.getElementById('header');
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
  const mainNav = document.querySelector('.header__main');

  $(window).scroll(function () {
    if ($(this).scrollTop() > searchIntro) {
      searchFilterBar.classList.add("sticky");
      //insertAfter(searchFilterBar, mainNav);
    } else {
      searchFilterBar.classList.remove("sticky");
      //insertAfter(searchFilterBar, searchIntro);
    }

    //for the content add margin top to prevent jump
    if ($(this).scrollTop() > searchIntro) {
      searchContent.classList.add("sticky");
    } else {
      searchContent.classList.remove("sticky");
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
  const selectGridView = document.querySelector('#view-grid-layout');
  const selectListView = document.querySelector('#view-list-layout');


  //View Type
  selectGridView.addEventListener('click', () => {
    formViewType.value = 'grid';
    selectGridView.classList.add('active');
    selectListView.classList.remove('active');
    reloadResults();
  })
  selectListView.addEventListener('click', () => {
    formViewType.value = 'list';
    selectGridView.classList.remove('active');
    selectListView.classList.add('active');
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
  $(".search-intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-intro__text').slideToggle(350);
    $this.toggleClass('search-intro__title--collapsed');
  });

  //Search Filters expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.filter__content').slideToggle(350);
    $this.parent().find('.filter__heading').toggleClass('closed');
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

  //Travel Style selections
  let travelStylesString = formTravelStyles.value;
  const travelStylesArray = [...document.querySelectorAll('.travel-style-checkbox')];
  travelStylesArray.forEach(item => {
    item.addEventListener('click', () => {

      //if charterCruises = selected --> make unselected
      if (item.value != 'charter_cruises') {
        const charterCheckbox = document.getElementById('charterCheckbox');
        charterCheckbox.checked = false;
      } else {
        //if this is charterCruises (and not selected) --> unselect all the other checkboxes
        if (item.checked == true) {
          travelStylesArray.forEach(checkboxItem => {
            checkboxItem.checked = false;
          });
          charterCheckbox.checked = true;
        }
      }

      travelStylesString = "";
      let count = 0;
      travelStylesArray.forEach(checkbox => {
        const itemValue = checkbox.value;
        if (checkbox.checked) {
          if (count > 0) {
            travelStylesString += ";";
          }
          travelStylesString += itemValue;
          count++;
        }
      })

      //filter count
      let travelStyleFilterCount = document.getElementById('travelStyleFilterCount');
      if (count > 0) {
        travelStyleFilterCount.classList.add("show");
        travelStyleFilterCount.innerHTML = count;
      } else {
        travelStyleFilterCount.classList.remove("show");
        travelStyleFilterCount.innerHTML = count;
      }


      formTravelStyles.value = travelStylesString;
      checkNonCruiseDestinations();
      reloadResults();
    });
  })

  checkNonCruiseDestinations();
  function checkNonCruiseDestinations() {
    const nonCruiseCheckboxes = [...document.querySelectorAll('.no-cruise')];
    if (formTravelStyles.value == 'rfc_cruises' || formTravelStyles.value == 'charter_cruises') {

      nonCruiseCheckboxes.forEach(x => {
        x.style.display = 'none';
        //would need to uncheck and remove ID from form/url
      })
    } else {
      nonCruiseCheckboxes.forEach(x => {
        x.style.display = 'block';
      })
    }
  }

  //Destination selections
  let destinationsString = formDestinations.value;
  const destinationsArray = [...document.querySelectorAll('.destination-checkbox')];
  destinationsArray.forEach(item => {
    item.addEventListener('click', () => {
      destinationsString = "";
      let count = 0;
      destinationsArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {
          if (count > 0) {
            destinationsString += ";";
          }
          destinationsString += itemValue;
          count++;
        }
      })

      //filter count
      let destinationsFilterCount = document.getElementById('destinationsFilterCount');
      if (count > 0) {
        destinationsFilterCount.classList.add("show");
        destinationsFilterCount.innerHTML = count;
      } else {
        destinationsFilterCount.classList.remove("show");
        destinationsFilterCount.innerHTML = count;
      }

      formDestinations.value = destinationsString;
      reloadResults();
    });
  })

  //Experiences selections
  let experiencesString = formExperiences.value;
  const experiencesArray = [...document.querySelectorAll('.experience-checkbox')];
  experiencesArray.forEach(item => {
    item.addEventListener('click', () => {
      experiencesString = "";
      let count = 0;
      experiencesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {

          if (count > 0) {
            experiencesString += ";";
          }
          experiencesString += itemValue;
          count++;
        }

      });

      //filter count
      let experiencesFilterCount = document.getElementById('experiencesFilterCount');
      if (count > 0) {
        experiencesFilterCount.classList.add("show");
        experiencesFilterCount.innerHTML = count;
      } else {
        experiencesFilterCount.classList.remove("show");
        experiencesFilterCount.innerHTML = count;
      }

      formExperiences.value = experiencesString;
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
    travelStylesString = "";
    destinationsString = "";
    experiencesString = "";
    searchInputString = "";

    formSearchInput.value = null;
    formDates.value = null;
    formTravelStyles.value = null;
    formDestinations.value = null;
    formExperiences.value = null;

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
  //RELOAD RESULTS
  function reloadResults(preservePage) {

    //set url params
    const params = new URLSearchParams(location.search);

    if (searchInputString != null) {
      params.set('searchInput', searchInputString);
    }

    if (departuresString != null) {
      params.set('departures', departuresString);
    }

    if (travelStylesString != null) {
      params.set('travel_style', travelStylesString);

    }

    if (destinationsString != null) {
      params.set('destinations', destinationsString);

    }

    if (experiencesString != null) {
      params.set('experiences', experiencesString);

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



    if (preservePage == true) { //for when page numbers are clicked, otherwise page will always be reset to 1
      if (formPageNumber.value != null) {
        params.set('pageNumber', formPageNumber.value);

      }

      if (formPageNumber.value != 'all') {
        $('body, html, .search-results').animate({ scrollTop: 0 }, "fast"); //paging scroll up
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

        let pageDisplay = document.querySelector('#page-number'); //page number
        pageDisplay.innerHTML = "";

        //showResultsButton.textContent = "Searching";
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
        var charterFilter = $('#charterFilter').attr('value');

        if (viewTypeDisplay == 'grid') {
          $('#response').addClass('gridview');
        } else {
          $('#response').removeClass('gridview');
        }


        let pageDisplay = document.querySelector('#page-number'); //show page number if not on page 1
        if (pageNumberDisplay > 1) {
          pageDisplay.innerHTML = "Page " + pageNumberDisplay;
        } else {
          pageDisplay.innerHTML = "";
        }


        var resultCountDisplay = ""
        if (resultCount == 1) {
          resultCountDisplay = "Found " + resultCount + " result"
          showResultsButton.textContent = "See " + resultCount + " result";
        } else if (resultCount == 0) {
          resultCountDisplay = "No results found"
          showResultsButton.textContent = "No results found";
        } else {
          resultCountDisplay = "Found " + resultCount + " results"
          showResultsButton.textContent = "See " + resultCount + " results";
        }

        if (charterFilter == true) {
          resultCountDisplay += '<span>Charter prices are shown in USD price per day</span>';
        } else {
          resultCountDisplay += '<span>Prices are displayed in USD per person in double occupancy or charter per day</span>';
        }


        //SERP Tabs
        const tabArray = [...document.querySelectorAll('.search-result__detail__header__tab')];
        tabArray.forEach(item => {
          item.addEventListener('click', (e) => {

            var thisTabArray = $(item).parent().find('.search-result__detail__header__tab');
            $(thisTabArray).removeClass('current');

            var panels = $(item).parent().parent().find('.search-result__detail__panel');
            panels.removeClass('current');

            var subtitles = $(item).parent().parent().parent().find('.search-result__content__top__title-group__subtitle span');
            subtitles.removeClass('current');
      
            var badges = $(item).parent().parent().parent().find('.dealbadge');
            badges.removeClass('current');
      
            if (item.classList.contains('fit-tab')) {
              panels[0].classList.add('current');
              thisTabArray[0].classList.add('current');
              subtitles[0].classList.add('current');
              badges[0].classList.add('current');
      
            } else {
              panels[1].classList.add('current');
              thisTabArray[1].classList.add('current');
              subtitles[1].classList.add('current');
              badges[1].classList.add('current');
            }
  

          })
        })


        $('#response-count').html(resultCountDisplay);


        let noResultsClearButton = document.querySelector('#no-results-clear-button');
        if (noResultsClearButton != null) {
          noResultsClearButton.addEventListener('click', (e) => {
            clearFilters();
          })
        }




        let pageButtonArray = [...document.querySelectorAll('.search-results__grid__pagination__pages-group__button')];


        //post-ajax loaded button js
        pageButtonArray.forEach(item => {
          item.addEventListener('click', (e) => {
            var pageNumber = item.value;

            if (!item.classList.contains('current') && !item.classList.contains('disabled')) {

              // next button
              if (item.classList.contains('search-results__grid__pagination__pages-group__button--next-button')) {
                var pageGoTo = (+pageNumberDisplay + 1);
                $("#formPageNumber").val(pageGoTo);

                // back button
              } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--back-button')) {
                var pageGoTo = (+pageNumberDisplay - 1);
                $("#formPageNumber").val(pageGoTo);

                //all button
              } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--all-button')) {
                $("#formPageNumber").val('all');

                //page button
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



  //SERP Tabs
  const tabArray = [...document.querySelectorAll('.search-result__detail__header__tab')];
  tabArray.forEach(item => {
    item.addEventListener('click', (e) => {

      var thisTabArray = $(item).parent().find('.search-result__detail__header__tab');
      $(thisTabArray).removeClass('current');

      var panels = $(item).parent().parent().find('.search-result__detail__panel');
      panels.removeClass('current');

      var subtitles = $(item).parent().parent().parent().find('.search-result__content__top__title-group__subtitle span');
      subtitles.removeClass('current');

      var badges = $(item).parent().parent().parent().find('.dealbadge');
      badges.removeClass('current');

      if (item.classList.contains('fit-tab')) {
        panels[0].classList.add('current');
        thisTabArray[0].classList.add('current');
        subtitles[0].classList.add('current');
        badges[0].classList.add('current');

      } else {
        panels[1].classList.add('current');
        thisTabArray[1].classList.add('current');
        subtitles[1].classList.add('current');
        badges[1].classList.add('current');
      }
      //Pre Title Text Change - charter
      //Promo badge hide - charter
      //handle charter only and charter unavailable boats

      //calculate min price based on itinerary length charter
      //optimize lowest price algorithm FIT

    })
  })


  //pagination js
  let pageButtonArray = [...document.querySelectorAll('.search-results__grid__pagination__pages-group__button')];
  pageButtonArray.forEach(item => {
    item.addEventListener('click', (e) => {
      var pageNumberDisplay = formPageNumber.value;
      var pageNumber = item.value;

      if (!item.classList.contains('current') && !item.classList.contains('disabled')) {

        // next button
        if (item.classList.contains('search-results__grid__pagination__pages-group__button--next-button')) {
          var pageGoTo = (+pageNumberDisplay + 1);
          $("#formPageNumber").val(pageGoTo);

          // back button
        } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--back-button')) {
          var pageGoTo = (+pageNumberDisplay - 1);
          $("#formPageNumber").val(pageGoTo);

          //all button
        } else if (item.classList.contains('search-results__grid__pagination__pages-group__button--all-button')) {
          $("#formPageNumber").val('all');

          //page button
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
    if (formTravelStyles.value != "") {
      filtersApplied = true;
    }
    if (formDestinations.value != "") {
      filtersApplied = true;
    }
    if (formExperiences.value != "") {
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
      searchFilterButton.classList.add('search-button--inverse');
      clearButtons.forEach(item => {
        item.classList.add('show');
      })

    } else {
      clearArea.classList.remove('show');
      searchFilterButton.classList.remove('search-button--inverse');
      clearButtons.forEach(item => {
        item.classList.remove('show');
      })
    }
  }




});


