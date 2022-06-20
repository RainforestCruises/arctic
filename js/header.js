


jQuery(document).ready(function ($) {

  //Set Header Style
  var opaqueNavAlways = false;
  if (header_vars.alwaysActiveHeader == true) {
    opaqueNavAlways = true;
  }

  //Scroll to Top on Reload
  if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
  } else {
    window.onbeforeunload = function () {
      window.scrollTo(0, 0);
    }
  }



  //Variables
  const bodyDiv = document.querySelector('#body');

  const headerDiv = document.querySelector('.header');
  const headerMain = document.querySelector('.header__main');

  const megaMenuOverlay = document.querySelector('.nav-mega-overlay');

  const megaMenu = document.querySelector('.nav-mega');
  const burgerButton = document.querySelector('#burger-menu');
  const burgerButtonClose = document.querySelector('#burger-menu-close');
  const navMobile = document.querySelector('.nav-mobile');


  //Navbar ----------

  //Scroll listener
  applyNavStyle();
  window.addEventListener('scroll', applyNavStyle);


  //Set active / small-nav classes 
  function applyNavStyle() {

    let megaActive = megaMenu.classList.contains('active');
    //small nav
    if (window.scrollY == 0) {
      headerMain.classList.remove('small-nav');
    } else {
      headerMain.classList.add('small-nav');
    }
    //active (non-transparent)
    if (!opaqueNavAlways && !megaActive) {
      if (window.scrollY > 300) {
        headerMain.classList.add('active');
      } else {
        headerMain.classList.remove('active');
      }
    }
  }


  //Hover
  //Make navbar white, add class: active
  $('.header__main').hover(
    function () {
      let isMobile = false;
      if ($(window).width() < 1000) {
        isMobile = true;
      }

      if (!opaqueNavAlways && !isMobile) {
        headerMain.classList.add('active');
      }
    },

    function () {

      var mobileExpanded = burgerButton.classList.contains('nav-mobile--active');
      var megaActive = megaMenu.classList.contains('active');
      var pageNavActive = $('.nav-secondary').hasClass('active');

      var scrolledDown = false;
      if (window.scrollY > 300) {
        scrolledDown = true;
      }

      if (!mobileExpanded && !opaqueNavAlways && !pageNavActive && !scrolledDown && !megaActive) {
        headerMain.classList.remove('active');
      }

    }
  )


  //MEGA MENU ----------
  //Hover behavior
  $('.nav-mega').hover(
    function () {//on hover over
      //Nada
    },
    function () {//on hover out
      megaMenu.classList.remove('active');
      megaMenuOverlay.classList.remove('active');
      $('.nav-secondary').removeClass('mega-hide');
      if (window.scrollY == 0 && !opaqueNavAlways) {
        headerMain.classList.remove('active');
      }
    }

  )

  //ARCTIC MENU LINKS
  $('.nav-mega__nav-arctic__menu__list__item__link').click(
    function (e) {
      e.preventDefault();
      var panelId = this.getAttribute("panel");
      console.log(panelId);

      var panelTarget = $(".nav-mega__nav-arctic__content-area__panel[panel='" + panelId + "']"); 
      console.log(panelTarget);
      

      $('.nav-mega__nav-arctic__content-area__panel').removeClass('active');
      $(panelTarget).addClass('active');

      var allLinks = $(".nav-mega__nav-arctic__menu__list__item__link");
      $(allLinks).removeClass('active');

      var targetLink = $(".nav-mega__nav-arctic__menu__list__item__link[panel='" + panelId + "']");
      $(targetLink).addClass('active');

    },
  );

  //NAV LINKS ----------
  //Main Nav Link (with mega class) - Hover 
  $('.header__main__nav__list__item__link.mega').hover(
    function () {
      var navelement = this.getAttribute("navelement");

      megaMenu.classList.add('active');
      megaMenuOverlay.classList.add('active');

      headerMain.classList.add('active');
      $('.nav-secondary').addClass('mega-hide');

      //Arctic
      var allPanels = $(".nav-mega__nav-arctic__content-area__panel");
      var allLinks = $(".nav-mega__nav-arctic__menu__list__item__link");
      $(allPanels).removeClass('active');
      $(allLinks).removeClass('active');

      var initialLinks = $(".nav-mega__nav-arctic__menu__list__item__link.initial");
      var initialPanels = $(".nav-mega__nav-arctic__content-area__panel.initial");
      $(initialPanels).addClass('active');
      $(initialLinks).addClass('active');

      //--




      if (navelement == "Destinations") {
        $('.nav-mega__nav--experiences').hide();
        $('.nav-mega__nav--destinations').show();

        $('.nav-mega__nav-arctic--ships').hide();
        $('.nav-mega__nav-arctic--destinations').show();


      } else if (navelement == "Experiences") {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').show();

        $('.nav-mega__nav-arctic--ships').hide();
        $('.nav-mega__nav-arctic--destinations').hide();
      }

      else if (navelement == "Ships") {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').hide();

        $('.nav-mega__nav-arctic--ships').show();
        $('.nav-mega__nav-arctic--destinations').hide();
      }


    }, function () {
      var megaActive = megaMenu.classList.contains('active');
      if (window.scrollY == 0 && !opaqueNavAlways && !megaActive) {
        headerMain.classList.remove('active');
      }
    }
  );
  //Main Nav Link (with no-mega class)- Hover 
  $('.header__main__nav__list__item__link.no-mega').hover(
    function () {
      megaMenu.classList.remove('active');
      megaMenuOverlay.classList.remove('active');
      headerMain.classList.add('active');
      $('.nav-secondary').removeClass('mega-hide');
    },
  );



  //Mouse Leave Browser - remove mega / active
  $(document).mouseleave(function () {
    megaMenu.classList.remove('active');
    megaMenuOverlay.classList.remove('active');
    $('.nav-secondary').removeClass('mega-hide');
    let menuActive = navMobile.classList.contains('nav-mobile--active');
    if (window.scrollY == 0 && !opaqueNavAlways && !menuActive) {
      headerMain.classList.remove('active');
    }
  });



  //MOBILE MENU -----------------------------------------
  //Burger-- open
  const languageSwitcher = document.querySelector('.mobile-language-switch');
  burgerButton.addEventListener('click', evt => {
    navMobile.classList.add('nav-mobile--active');
    burgerButtonClose.classList.add('active');
    document.body.classList.add('lock-scroll');
    bodyDiv.classList.add('overlay');
    if (languageSwitcher != null) {
      languageSwitcher.style.display = 'flex'; //fix this
    }
  });

  //Burger-- close
  burgerButtonClose.addEventListener('click', evt => {
    closeMobile();
  });

  function closeMobile() {
    burgerButtonClose.classList.remove('active');
    bodyDiv.classList.remove('overlay');
    navMobile.classList.remove('nav-mobile--active');
    document.body.classList.remove('lock-scroll');

    $('.nav-mobile__content-panel').removeClass('slide-out-left');
    $('.nav-mobile__content-panel').removeClass('slide-center');

    if (window.scrollY == 0) {
      if (opaqueNavAlways == false) {
        headerMain.classList.remove('active');
      }
    }
  }




  //Mobile Menu
  const mobileButtons = [...document.querySelectorAll('.nav-mobile__content-panel__button')];
  mobileButtons.forEach(item => {
    item.addEventListener('click', () => {
      let menuLink = item.getAttribute('menuLinkTo');

      var topPanel = document.querySelector('.nav-mobile__content-panel--top');
      var subPanel = document.querySelector('[menuid="' + menuLink + '"]');

      var isBackButton = $(item).hasClass('back-link');
      var isPhoneButton = $(item).hasClass('phone');
      if (languageSwitcher != null) {
        languageSwitcher.style.display = 'flex'; //fix this
      }

      if (isBackButton) {
        $(topPanel).removeClass('slide-out-left');

        $(item).parent().removeClass('slide-center');
      } else if (isPhoneButton) {
        //do nothing
      } else {
        if (languageSwitcher != null) {
          languageSwitcher.style.display = 'none'; //fix this
        }
        if (!item.classList.contains("mobile-link")) {
          topPanel.classList.add('slide-out-left');
          $(subPanel).addClass('slide-center');
        } else {
          closeMobile();
        }

      }
    });
  })


  //Click Away -- close modal
  document.addEventListener('click', evt => {
    const isMobileMenu = navMobile.contains(evt.target);
    const isBurgerOpen = burgerButton.contains(evt.target);
    let navActive = navMobile.classList.contains('nav-mobile--active');

    if (!isBurgerOpen && navActive && !isMobileMenu) {
      closeMobile();
    }
  });



  //Page Nav-- Hover
  $('#template-nav').hover(
    function () { },
    function () {
      if ($(".burger-menu").hasClass('burger-menu--active') != true) {
        $('.nav-mega').removeClass('active');
      }
    }
  );



  //Newsletter
  $('.close-button').on('click', () => {
    $('.popup').removeClass('active');
    body.classList.remove('no-scroll');
  });

  document.addEventListener('click', evt => {
    const contactForm = document.querySelector('.contact');
    const popup = document.querySelector('.popup');
    const button = document.querySelector('#newsletterButton');

    const isContact = contactForm.contains(evt.target);
    const isButton = button.contains(evt.target);
    const isActive = popup.classList.contains('active');
    if (isActive) {
      if (!isContact && !isButton) {
        $('.popup').toggleClass('active');
        body.classList.remove('no-scroll');
      }
    }

  });

  $('#newsletterButton').on('click', () => {
    $('.popup').addClass('active');
    body.classList.add('no-scroll');
  });

  $('.form-general').on('submit', function () {
    $('.contact__wrapper__intro__title').text('Thank You');
    $('.contact__wrapper__intro__introtext').hide();
  });



  //TEMPLATE SPECIFIC EXTRAS -----------------------------------------------------------------
  //SERP
  const searchFilterBar = document.getElementById('search-filter-bar'); //for search template

  //Resize Window - Close menus
  $(window).resize(function () {

    if ($(window).width() > 1000) {
      navMobile.classList.remove('nav-mobile--active');
      bodyDiv.classList.remove('overlay');
    }
    if ($(window).width() <= 1000) {
      megaMenu.classList.remove('active');
      megaMenuOverlay.classList.remove('active');

    }
  });


  //Another scroll listener for SERP
  var c;
  var currentScrollTop = 0;

  $(window).scroll(function () {
    let preventNavExpand = headerDiv.classList.contains('preventExpand'); //added and removed with delay from page nav

    let megaActive = megaMenu.classList.contains('active');

    if (!preventNavExpand && !megaActive) {
      var a = $(window).scrollTop();
      var b = headerDiv.offsetHeight;

      currentScrollTop = a;

      if (c < currentScrollTop && a > b + b) {
        headerDiv.classList.add("scrollUp");

        if (searchFilterBar != null) {
          searchFilterBar.classList.add("scrollUp");
        }

      } else if (c > currentScrollTop && !(a <= b)) {
        headerDiv.classList.remove("scrollUp");
        if (searchFilterBar != null) {
          searchFilterBar.classList.remove("scrollUp");
        }
      }
      c = currentScrollTop;
    }

  });

});

