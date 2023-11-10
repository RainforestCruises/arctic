jQuery(document).ready(function ($) {
  const defaultSearchUrl = header_vars.defaultSearchUrl;
  const formSearchInput = document.querySelector('#formSearchInput');
  const navCtaMobile = document.querySelector('#nav-cta-mobile');

  const navSearchModal = document.getElementById('navSearchModal');
  const navSearchModalBottomCta = document.getElementById('navSearchModalBottomCta');
  const navSearchModalSubmitButton = document.getElementById('navSearchModalSubmitButton');
  const navSearchModalInput = document.getElementById('navSearchModalInput');
  const navSearchModalInputArea = document.getElementById('navSearchModalInputArea');
  const navSearchModalResults = document.getElementById('navSearchModalResults');
  const navSearchModalResultsInitial = document.getElementById('navSearchModalResultsInitial');
  const navSearchModalClearButton = document.getElementById('navSearchModalClearButton');
  const navSearchModalClose = document.getElementById('navSearchModalClose');

  const navSearchModalMainTab = document.getElementById('navSearchModalMainTab');
  const navSearchModalDatesTab = document.getElementById('navSearchModalDatesTab');
  const navSearchModalMain = document.getElementById('navSearchModalMain');
  const navSearchModalDates = document.getElementById('navSearchModalDates');

  const navControlMenuDates = document.getElementById('nav-control-menu-dates');


  window.addEventListener('resize', function (event) {
    
    if(window.screen.width > 800){
      closeMobileSearch();
    } 

  }, true);


  navSearchModalMainTab.addEventListener('click', (event) => {
    navSearchModalMainTab.classList.add('active');
    navSearchModalDatesTab.classList.remove('active');
    navSearchModalMain.style.display = 'block';
    navSearchModalDates.style.display = 'none';
    navSearchModalInput.focus();

  });

  navSearchModalDatesTab.addEventListener('click', (event) => {
    navSearchModalMainTab.classList.remove('active');
    navSearchModalDatesTab.classList.add('active');
    navSearchModalMain.style.display = 'none';
    navSearchModalDates.style.display = 'block';
  });

  navCtaMobile.addEventListener('click', (event) => {
    activeMobileSearch();
  });

  navSearchModalClose.addEventListener('click', (event) => {
    closeMobileSearch();
  });

  navSearchModalClearButton.addEventListener('click', (event) => {
    navSearchModalInput.value = "";
    formSearchInput.value = "";
    navSearchModalResultsInitial.classList.add('active');
    navSearchModalResults.innerHTML = "";
    navSearchModalClearButton.classList.remove('active');
  });



  function activeMobileSearch() {
    navSearchModal.style.display = 'flex';
    navSearchModalBottomCta.style.display = 'flex';
    navSearchModalInput.focus();
    body.classList.add('no-scroll');
    navSearchModalDates.appendChild(navControlMenuDates)


  }

  function closeMobileSearch() {
    navSearchModal.style.display = 'none';
    navSearchModalBottomCta.style.display = 'none';
    body.classList.remove('no-scroll');
    document.querySelector('.nav-main__content__center__search-area').appendChild(navControlMenuDates)

  }


  navSearchModalInput.addEventListener('input', (event) => {
    formSearchInput.value = navSearchModalInput.value;
    checkMobileSearchMenu();
  });

  function checkMobileSearchMenu() {
    if (navSearchModalInput.value.length < 3) {
      navSearchModalResultsInitial.classList.add('active');
      navSearchModalClearButton.classList.remove('active');
      navSearchModalResults.innerHTML = "";
    } else {
      navSearchModalClearButton.classList.add('active');
      navSearchModalResultsInitial.classList.remove('active');
      delayedSearchMobile();
    }
  }

  // delay ajax search
  var timeout = null;
  function delayedSearchMobile() {
    if (timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(function () {
      performSearchMobile();
    }, 300);
  }

  // ajax call / submit form
  var jqxhr = { abort: function () { } };
  function performSearchMobile() {
    var navSearchForm = $('#nav-search-form');
    jqxhr.abort();
    jqxhr = $.ajax({
      url: navSearchForm.attr('action'),
      data: navSearchForm.serialize(),
      type: navSearchForm.attr('method'),
      beforeSend: function () {
        navSearchModalInputArea.classList.add('loading');
      },
      success: function (data) {
        navSearchModalInputArea.classList.remove('loading');
        navSearchModalResults.innerHTML = data; // return the markup

        // add click behavior for results
        const navSearchItems = [...document.querySelectorAll('.nav-search-item')];
        navSearchItems.forEach(item => {
          item.addEventListener('click', () => {
            let dataUrl = item.getAttribute('data-url');
            window.location.href = dataUrl;
            removeActiveSearch();
          });
        })
      }
    });
  }


  // check for enter key pressed
  navSearchModalInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      performSubmitMobile();
    }
  });

  // submit button clicked
  navSearchModalSubmitButton.addEventListener('click', (event) => {
    performSubmitMobile();
  });


  function performSubmitMobile() {

    let selectedRegion = document.getElementById('formNavRegionInput').value;
    let selectedDates = document.getElementById('formNavDateInput').value;
    let selectedDatesArray = selectedDates.split(',');

    // dates
    if (navSearchModalDatesTab.classList.contains('active')) {
      if (selectedDates.length > 0) {
        const dateString = selectedDatesArray.join('%3B');
        window.location.href = defaultSearchUrl + "?region=" + selectedRegion + "&departures=" + dateString;
      }
      else {
        window.location.href = defaultSearchUrl + "?region=" + selectedRegion;
      }
    }

    if (!navSearchModalInputArea.classList.contains('loading')) {
      let navSearchItems = [...document.querySelectorAll('.nav-search-item--result')];
      if (navSearchItems.length > 0) {
        window.location.href = navSearchItems[0].getAttribute('data-url');
      } else {
        window.location.href = defaultSearchUrl + "?searchInput=" + navControlSearchInput.value;
      }
    }
  }


});

