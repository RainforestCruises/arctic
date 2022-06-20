
jQuery(document).ready(function ($) {
    console.log('original array');
    console.log(resultsArray);
  
    var preselectMinLength = 1;
    var preselectMaxLength = 15;
    //Length Slider
  
    let rangeFrom = 1;
    let rangeTo = 15;
  
    $("#range-slider").ionRangeSlider({
      skin: "round",
      type: "double",
      min: 1,
      max: 15,
      from: preselectMinLength,
      to: preselectMaxLength,
      postfix: " Day",
      max_postfix: "+",
      onFinish: function () {
        var low = $("#range-slider").data("from");
        var high = $("#range-slider").data("to");
  
        rangeFrom = low;
        rangeTo = high;
  
        filterResults();
  
      },
    });
  
    // Show More -- Departure List
    $("#departure-show-more").click(function (e) {
      $("#departure-filter-list").toggleClass("expanded");
      var isExpanded = $("#departure-filter-list").hasClass("expanded");
      if (isExpanded == true) {
        $('#departure-show-more').html("Show Less");
      } else {
        $('#departure-show-more').html("Show More");
      }
    });
  
    //intro expand/hide
    $(".search-intro__title").on("click", function (e) {
      e.preventDefault();
      let $this = $(this);
      $this.parent().find('.search-intro__text').slideToggle(350);
      $this.toggleClass('search-intro__title--collapsed');
    });
  
    //filters expand/hide
    $(".filter__heading").on("click", function (e) {
      e.preventDefault();
      let $this = $(this);
      $this.parent().find('.filter__content').slideToggle(350);
      $this.parent().find('.filter__heading').toggleClass('closed');
    });
  
  
  
    //FORM ----------------
    //form variables
    const formDates = document.querySelector('#formDates');
    const formTravelStyles = document.querySelector('#formTravelStyles');
    const formDestinations = document.querySelector('#formDestinations');
    const formExperiences = document.querySelector('#formExperiences');
  
  
  
    //Departure Date selections
    let departureString = "";
    let departureSelectionArray = [];
    const departureDatesArray = [...document.querySelectorAll('.departure-checkbox')];
    departureDatesArray.forEach(item => {
      item.addEventListener('click', () => {
        departureSelectionArray = [];
        departureString = "";
        let count = 0;
        departureDatesArray.forEach(checkbox => {
          const itemMonth = checkbox.getAttribute("month");
          const itemYear = checkbox.getAttribute("year");
  
  
          if (checkbox.checked) {
  
            var itemValue = itemYear + "-" + itemMonth + "-01";
            departureSelectionArray.push(itemValue);
            if (count > 0) {
              departureString += ":";
            }
            departureString += itemMonth + "-" + itemYear;
            count++;
          }
  
        })
  
        formDates.value = departureString;
  
        filterResults();
      });
    })
  
  
    //Travel Style selections
    let travelStylesString = "";
    let travelStylesSelectionArray = [];
    const travelStylesArray = [...document.querySelectorAll('.travel-style-checkbox')];
    travelStylesArray.forEach(item => {
      item.addEventListener('click', () => {
        travelStylesSelectionArray = [];
        travelStylesString = "";
        let count = 0;
        travelStylesArray.forEach(checkbox => {
          const itemValue = checkbox.value;
  
          if (checkbox.checked) {
  
            travelStylesSelectionArray.push(itemValue);
  
            if (count > 0) {
              travelStylesString += ":";
            }
            travelStylesString += itemValue;
            count++;
          }
  
        })
  
        formTravelStyles.value = travelStylesString;
  
        filterResults();
      });
    })
  
    //Destination selections
    let destinationsString = "";
    let destinationsSelectionArray = [];
    const destinationsArray = [...document.querySelectorAll('.destination-checkbox')];
    destinationsArray.forEach(item => {
      item.addEventListener('click', () => {
        destinationsSelectionArray = [];
        destinationsString = "";
        let count = 0;
        destinationsArray.forEach(checkbox => {
          const itemValue = parseInt(checkbox.value);
  
          if (checkbox.checked) {
            destinationsSelectionArray.push(itemValue);
            if (count > 0) {
              destinationsString += ":";
            }
            destinationsString += itemValue;
            count++;
          }
  
        })
  
        formDestinations.value = destinationsString;
        filterResults();
      });
    })
  
    //Experiences selections
    let experiencesString = "";
    let experiencesSelectionArray = [];
    const experiencesArray = [...document.querySelectorAll('.experience-checkbox')];
    experiencesArray.forEach(item => {
      item.addEventListener('click', () => {
        experiencesSelectionArray = [];
        experiencesString = "";
        let count = 0;
        experiencesArray.forEach(checkbox => {
          const itemValue = parseInt(checkbox.value);
  
          if (checkbox.checked) {
  
            experiencesSelectionArray.push(itemValue);
  
            if (count > 0) {
              experiencesString += ":";
            }
            experiencesString += itemValue;
            count++;
          }
  
        })
        formExperiences.value = experiencesString;
        filterResults();
      });
    })
  
  
  
  
    //Need function to filter list and prepare prices/length values based on filter inputs
    //Then pass to render function
    const filterResults = () => {
  
      let filteredList = resultsArray;
  
  
      //travel styles
      if (travelStylesSelectionArray.length > 0) {
        let list = [];
        resultsArray.forEach(o => {
          if (travelStylesSelectionArray.includes(o.postType)) {
            list.push(o);
          };
  
        })
        filteredList = list;
  
      }
  
      //experiences
      if (experiencesSelectionArray.length > 0) {
        let list = [];
        filteredList.forEach(o => {
  
          arr1 = o.experiences.map(x => x.postId);
          arr2 = experiencesSelectionArray;
          const found = arr1.some(r => arr2.indexOf(r) >= 0);
          if (found == true) {
            list.push(o);
          }
  
        })
        filteredList = list;
      }
  
      //destinations / locations
      if (destinationsSelectionArray.length > 0) {
        let list = [];
        filteredList.forEach(o => {
  
          arr1 = o.locations.map(x => x.postId); //check if locations or destination based on searchType
          arr2 = destinationsSelectionArray;
          const found = arr1.some(r => arr2.indexOf(r) >= 0);
          if (found == true) {
            list.push(o);
          }
  
        })
        filteredList = list;
      }
  
  
      //range
      if (rangeFrom != null || rangeTo != null) {
  
        let list = [];
        filteredList.forEach(o => {
          if (o.postType == 'rfc_tours') {
  
            var itineraryLength = o.itineraries[0].lengthInDays;
  
            if (itineraryLength >= rangeFrom && itineraryLength <= rangeTo) {
              list.push(o);
            }
  
          } else { //cruises/lodges
  
            let newItineraryList = [];
            o.itineraries.forEach(i => {
              if (i.lengthInDays >= rangeFrom && i.lengthInDays <= rangeTo) {
                newItineraryList.push(i);
              }
            })
  
            o.itineraries = newItineraryList;
            list.push(o);
          }
  
        });
        filteredList = list;
      }
      console.log(departureSelectionArray);
      //departure
      if (departureSelectionArray.length > 0) {
        let list = [];
  
        filteredList.forEach(o => {
          if (o.postType != 'rfc_cruises') {
            list.push(o);
          }
          else { //cruises
            
  
          }
        })
        filteredList = list;
      }
      console.log(filteredList);
      renderResponse(filteredList);
    };
  
    const prepareRender = (arr) => {
      let preparedList = []
  
      arr.forEach(o => {
  
        //Product Type Display
        let productTypeDisplay = "";
        if (o.postType == "rfc_cruises") {
          productTypeDisplay = 'River Cruise';
        } else if (o.postType == "rfc_tours") {
          productTypeDisplay = 'Land Tour';
        } else {
          productTypeDisplay = 'Lodge Stay';
        }
  
        //Regions Display
        let regionsDisplay = ""
        if (o.destinations.length > 0) {
          let count = 0;
          o.destinations.forEach(d => {
            if (count != 0) {
              regionsDisplay += ", " + d.name;
            } else {
              regionsDisplay += d.name;
            }
            count++;
          })
        }
  
        //Destinations Display
        let destinationsDisplay = ""
        if (o.locations.length > 0) {
          let count = 0;
          o.locations.forEach(l => {
            if (count != 0) {
              destinationsDisplay += ", " + l.name;
            } else {
              destinationsDisplay += l.name;
            }
            count++;
          })
        }
  
        //Itinerary Length
        let itineraryRangeDisplay = ""
        let itineraryCountDisplay = ""
  
        if (o.postType != "rfc_tours") { //cruises & lodges
          if (o.itineraries.length > 0) {
  
            const itineraryValues = o.itineraries.map(i => parseInt(i.lengthInDays));
            const rangeFrom = Math.min(...itineraryValues);
            const rangeTo = Math.max(...itineraryValues);
  
            //range
            if (rangeFrom != rangeTo) {
              itineraryRangeDisplay = rangeFrom + " - " + rangeTo + " Days";
            } else {
              itineraryRangeDisplay = rangeFrom + " Days";
            }
            //count
            itineraryCountDisplay = o.itineraries.length + (o.itineraries.length > 1 ? " Itineraries" : " Itinerary");
          }
        } else { //tours
          itineraryRangeDisplay = o.itineraries[0].lengthInDays + " Days";
          itineraryCountDisplay = "";
        }
  
  
        //Experiences -- could be in render
        let experienceHTML = "";
        if (o.experiences.length > 0) {
  
          o.experiences.forEach(e => {
            let iconHTML = "";
            let svgLink = '<svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#' + e.icon + '"></use></svg>';
            iconHTML = `
            <div class="search-result__content__bottom__experiences__item">
            <div class="experience-icon">
            ${svgLink}
                <span class="tooltiptext">${e.name}</span>
            </div>
            </div>
            `
            experienceHTML += iconHTML;
  
          })
  
        }
  
  
        var product = {
          productTitle: o.productTitle,
          productTypeDisplay: productTypeDisplay,
          productImage: o.productImage,
          snippet: o.snippet,
          regionsDisplay: regionsDisplay,
          destinationsDisplay: destinationsDisplay,
          itineraryRangeDisplay: itineraryRangeDisplay,
          itineraryCountDisplay: itineraryCountDisplay,
          experienceHTML: experienceHTML,
          postType: o.postType,
          numberOfCabins: o.numberOfCabins,
          vesselCapacity: o.vesselCapacity,
        };
  
        preparedList.push(product);
  
      })
  
      return preparedList;
  
    };
  
  
    //Render function
    const responseDiv = document.querySelector('#response');
    const renderResponse = (arr) => {
      responseDiv.innerHTML = "";
  
      // console.log('filtered array');
      // console.log(arr);
  
      let results = prepareRender(arr);
      // console.log('prepared render');
      // console.log(results);
  
      results.forEach(item => {
  
        var resultCard = document.createElement("a");
        resultCard.classList.add("search-result");
        //resultCard.href = item.postLink;
  
        var resultHTML = `
        <div class="search-result__image-area">
          <img src="${item.productImage}" alt="">
        </div>
        <div class="search-result__content">
            <div class="search-result__content__top">
                <div class="search-result__content__top__title-group">
                    <div class="search-result__content__top__title-group__subtitle">
                      ${item.productTypeDisplay}
                    </div>
                    <div class="search-result__content__top__title-group__title">
                      ${item.productTitle}
                    </div>
                </div>
                <div class="search-result__content__top__snippet">
                  ${item.snippet}
                </div>
            </div>
            <div class="search-result__content__bottom">
                <div class="search-result__content__bottom__details">
                    <div class="search-result__content__bottom__details__group">
                        <span class="search-result__content__bottom__details__group__title">
                            Regions:
                        </span>
                        <span class="search-result__content__bottom__details__group__text">
                          ${item.regionsDisplay}
                        </span>
                    </div>
                    <div class="search-result__content__bottom__details__group">
                        <span class="search-result__content__bottom__details__group__title">
                            Destinations:
                        </span>
                        <span class="search-result__content__bottom__details__group__text">
                        ${item.destinationsDisplay}
                        </span>
                    </div>
                </div>
                <div class="search-result__content__bottom__experiences">
                    <!-- Experience Item -->
                    ${item.experienceHTML}
                    
                </div>
            </div>
  
        </div>
        <div class="search-result__detail">
            <div class="search-result__detail__info">
                <div class="search-result__detail__info__price-from">
                    <div class="search-result__detail__info__price-from__text">
                        Starting From
                    </div>
                    <div class="search-result__detail__info__price-from__price">
                       $5,000
                        <span>
                            USD
                        </span>
                    </div>
                </div>
                <div class="search-result__detail__info__attributes">
  
                    <!-- Itineraries -->
                    <div class="search-result__detail__info__attributes__item">
                        <div class="search-result__detail__info__attributes__item__data">
                            <div class="search-result__detail__info__attributes__item__data__icon">
                                <svg>
                                    <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                            </div>
                            <div class="search-result__detail__info__attributes__item__data__text">
                                ${item.itineraryRangeDisplay}
                                <div class="sub-attribute">
                                ${item.itineraryCountDisplay}
                                </div>
                            </div>
  
                        </div>
                    </div>
                    
                  
                  ${item.postType != "rfc_tours" ?
            `
                    <div class="search-result__detail__info__attributes__item">
                    <div class="search-result__detail__info__attributes__item__data">
                      <div class="search-result__detail__info__attributes__item__data__icon">
                        <svg>
                            <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-boat-front"></use>
                        </svg>
                      </div>
                      <div class="search-result__detail__info__attributes__item__data__text">
                      ${item.vesselCapacity} Guests
                          <div class="sub-attribute">
                          ${item.numberOfCabins} Cabins
                          </div>
                      </div>
                    </div>
                  </div>
                    `
            : ''}
                  
                </div>
  
            </div>
            <div class="search-result__detail__cta">
                <button class="btn-cta-round">
                    View Cruise
                </button>
            </div>
  
        </div>
        
        `
  
  
        resultCard.innerHTML = resultHTML;
        responseDiv.appendChild(resultCard);
      })
    }
  
  
    //onLoad
    renderResponse(resultsArray);
  
  
  
  });
  
  
  