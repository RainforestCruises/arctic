jQuery(document).ready(function ($) {
  const defaultSearchUrl = header_vars.defaultSearchUrl;

  const headerDiv = document.querySelector('.header');
  const navMain = document.querySelector('.nav-main');
  const navMega = document.querySelector('.nav-mega');
  const navBackdrop = document.querySelector('.nav-backdrop');
  const navMainLinks = [...document.querySelectorAll('.nav-main__content__center__nav__list__item')];

  const navCta = document.querySelector('#nav-cta');
  const navControl = document.querySelector('#nav-control');
  const navControlSearch = document.querySelector('#nav-control-search');
  const navControlSearchInput = document.querySelector('#nav-control-search-input');
  const navControlMenuInitial = document.querySelector('#nav-control-menu-initial');
  const navControlMenuSearch = document.querySelector('#nav-control-menu-search');
  const navControlDates = document.querySelector('#nav-control-dates');
  const navControlMenuDates = document.querySelector('#nav-control-menu-dates');
  const navControlClearButton = document.querySelector('#nav-control-clear-button');
  const navControlSubmitButton = document.querySelector('#nav-control-submit-button');
  const formSearchInput = document.querySelector('#formSearchInput');


  // cta & control interaction -----------------------------------------------------------------------------------------------------
  navCta.addEventListener('click', (event) => {
    const isDates = document.querySelector('.nav-search-cta__input__desktop__dates').contains(event.target);
    activeSearch(isDates);
  });

  navControlSearch.addEventListener('click', (event) => {
    activeSearch();
  });
  navControlDates.addEventListener('click', (event) => {
    activeSearch(true);
  });

  navControlClearButton.addEventListener('click', (event) => {
    navControlSearchInput.value = "";
    activeSearch();
  });


  function activeSearch(isDates) {
    navMain.classList.add('active');
    navCta.style.display = 'none';
    navControl.classList.add('active');
    if (isDates) {
      navControlDates.classList.add('active');
      navControlMenuDates.classList.add('active');
      navControlSearch.classList.remove('active');
      navControlMenuInitial.classList.remove('active');
      navControlMenuSearch.classList.remove('active');
    }
    else {
      navControlSearch.classList.add('active');
      navControlMenuInitial.classList.add('active');
      navControlDates.classList.remove('active');
      navControlMenuDates.classList.remove('active');
      navControlSearchInput.focus();
      checkSearchMenu(true);
    }
  }

  // initial menu items click behavior
  const navSearchItems = [...document.querySelectorAll('.nav-search-item')];
  navSearchItems.forEach(item => {
    item.addEventListener('click', () => {
      let dataUrl = item.getAttribute('data-url');
      window.location.href = dataUrl;
      removeActiveSearch();
    });
  })

  // remove active search when click anywhere else
  document.addEventListener('click', evt => {
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
    navCta.style.display = 'grid';
    navControl.classList.remove('active');
    navControlSearch.classList.remove('active');
    navControlMenuInitial.classList.remove('active');
    navControlMenuSearch.classList.remove('active');
    navControlDates.classList.remove('active');
    navControlMenuDates.classList.remove('active');
  }

  // search field input -----------------------------------------------------------------------------------------------------
  navControlSearchInput.addEventListener('input', (event) => {
    formSearchInput.value = navControlSearchInput.value;
    checkSearchMenu();
  });

  function checkSearchMenu(initial = false) {
    if (navControlSearchInput.value.length < 3) {
      navControlMenuInitial.classList.add('active');
      navControlMenuSearch.classList.remove('active');
      navControlClearButton.classList.remove('active');

    } else {
      navControlMenuInitial.classList.remove('active');
      navControlClearButton.classList.add('active');
      if (!initial) {
        delayedSearch();
      } else {
        navControlMenuSearch.classList.add('active');
      }
    }
  }

  // delay ajax search
  var timeout = null;
  function delayedSearch() {
    navControlMenuSearch.classList.remove('active');
    if (timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(function () {
      performSearch();
    }, 300);
  }

  // ajax call / submit form
  var jqxhr = { abort: function () { } };
  function performSearch() {
    var navSearchForm = $('#nav-search-form');
    jqxhr.abort();
    jqxhr = $.ajax({
      url: navSearchForm.attr('action'),
      data: navSearchForm.serialize(),
      type: navSearchForm.attr('method'),
      beforeSend: function () {
        navControl.classList.add('loading');
      },
      success: function (data) {
        navControl.classList.remove('loading');
        navControlMenuSearch.innerHTML = data; // return the markup
        navControlMenuSearch.classList.add('active');

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
  navControlSearchInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      if (!navControl.classList.contains('loading')) {
        let navSearchItems = [...document.querySelectorAll('.nav-search-item--result')];
        if (navSearchItems.length > 0) {
          window.location.href = navSearchItems[0].getAttribute('data-url');
        } else {
          window.location.href = defaultSearchUrl + "?searchInput=" + navControlSearchInput.value;
        }
      }
    }
  });



  // date components -----------------------------------------------------------------------------------------------------
  new Swiper('#nav-dates-menu-slider', {
    slidesPerView: 6,
    spaceBetween: 5,
    watchSlidesProgress: true,
    navigation: {
      nextEl: '.nav-dates-swiper-button-next',
      prevEl: '.nav-dates-swiper-button-prev',
    },
  });










  



  // HEADER ---------------------------------------------------------------------------------------------------------------------------
  // ----------------------------------------------------------------------------------------------------------------------------------
  // set header style
  let opaqueNavAlways = header_vars.alwaysActiveHeader;
  let fixedHeader = headerDiv.classList.contains('fixed');


  // apply header styles on scroll if fixed header
  if (fixedHeader == true) {
    window.addEventListener('scroll', applyNavStyle);
  }

  if (fixedHeader == false) {
    window.addEventListener('scroll', clearMega);
  }

  function applyNavStyle() {
    let megaActive = navMega.classList.contains('active');

    //reset search input
    removeActiveSearch();

    //reduce size (height)
    if (window.scrollY == 0) {
      navMain.classList.remove('small-nav');
      if (!megaActive) {
        navBackdrop.classList.remove('active');
      }

    } else {
      navMain.classList.add('small-nav');
    }

    //set active bg past threshold
    if (!opaqueNavAlways && !megaActive) {

      if (window.scrollY > 150) {
        navMain.classList.add('active');
      } else {

        navMain.classList.remove('active');
        navBackdrop.classList.remove('active');

      }
    }
  }



  function clearMega() {

    navMega.classList.remove('active');
    navMain.classList.remove('mega-active');
    navBackdrop.classList.remove('active');

    $('.nav-main__content__center__nav__list__item').removeClass('active');
  }


  // main nav hover
  $('.nav-main').hover(
    function () { // hover-over
      navMain.classList.add('active');
    },
    function () { // hover-out
      var megaActive = navMega.classList.contains('active');
      var searchActive = navControl.classList.contains('active');
      var scrolledDown = (window.scrollY > 300) ? true : false;

      if (!opaqueNavAlways && !scrolledDown && !megaActive && !searchActive) {
        navMain.classList.remove('active');
      }

      if (!megaActive) {
        navBackdrop.classList.remove('active');
      }

    }
  )

  // nav list behavior ----------
  // nav item hover 
  $('.nav-main__content__center__nav__list__item').hover(
    function () { // over

      navMain.classList.add('active');
      navBackdrop.classList.add('active');
      navMain.classList.add('mega-active');
      navMega.classList.add('active');
      removeActiveSearch();

      var panelId = this.getAttribute("navelement");
      var panelTarget = $(".nav-mega__panel[panel='" + panelId + "']");

      $('.nav-mega__panel').removeClass('active');
      navMainLinks.forEach(link => {
        link.classList.remove('active');
      })
      this.classList.add('active');
      $(panelTarget).addClass('active');

    },
    function () { // out

      var megaActive = navMega.classList.contains('active');
      if (window.scrollY == 0 && !opaqueNavAlways && !megaActive) {
        navMain.classList.remove('active');
      }

      if (!megaActive) {
        navBackdrop.classList.remove('active');

      }

    },
  );


  // nav link hover (deals)
  $('.nav-main__content__center__nav__list__link').hover(
    function () { //over

      navMain.classList.add('active');
      navBackdrop.classList.add('active');
      $('.nav-mega__panel').removeClass('active');
      navMainLinks.forEach(link => {
        link.classList.remove('active');
      })
      navMega.classList.remove('active');
      navMain.classList.remove('mega-active');
      removeActiveSearch();

    },
    function () { //out

    },
  );


  // mega menu ----------
  // remove mega and backdrop when hover back to page
  $('.nav-mega').hover(
    function () {// on hover over

    },
    function () {//on hover out
      navMega.classList.remove('active');
      navMain.classList.remove('mega-active');

      navMainLinks.forEach(link => {
        link.classList.remove('active');
      })

      var mainActive = navMain.classList.contains('active');

      if (window.scrollY == 0 && !opaqueNavAlways && !mainActive) {
        navMain.classList.remove('active');
      }

      if (!mainActive) {
        navBackdrop.classList.remove('active');
      }

    }

  )

  //Remove mega when hover over other nav elements 
  $('.nav-main__content__center__search-area, .nav-main__content__right').hover(
    function () {//on hover over
      navMega.classList.remove('active');
      navMain.classList.remove('mega-active');
      navMainLinks.forEach(link => {
        link.classList.remove('active');
      })
    },
  )


  //Mouse Leave Browser - remove mega / active / search
  $(document).mouseleave(function () {
    navMega.classList.remove('active');
    navMain.classList.remove('mega-active');
    navBackdrop.classList.remove('active');
    removeActiveSearch();
    navMainLinks.forEach(link => {
      link.classList.remove('active');
    })

    if (window.scrollY == 0 && !opaqueNavAlways) {
      navMain.classList.remove('active');
    }
  });


  applyNavStyle();

});

