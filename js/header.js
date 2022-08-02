


jQuery(document).ready(function ($) {

  // //Set Header Style
  var opaqueNavAlways = header_vars.alwaysActiveHeader;


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

  const megaMenu = document.querySelector('.nav-mega');

  let fixedHeader = headerDiv.classList.contains('fixed');



  const burgerButton = document.querySelector('#burger-menu');
  const burgerButtonClose = document.querySelector('#burger-menu-close');
  const navMobile = document.querySelector('.nav-mobile');




  //If not fixed, apply header styles on scroll
  if (fixedHeader == true) {
    window.addEventListener('scroll', applyNavStyle);
  }

  function applyNavStyle() {
    //small nav
    if (window.scrollY == 0) {
      headerMain.classList.remove('small-nav');
    } else {
      headerMain.classList.add('small-nav');
    }

    //active (non-transparent)  && !megaActive
    if (!opaqueNavAlways) {
      if (window.scrollY > 300) {
        headerMain.classList.add('active');
      } else {
        headerMain.classList.remove('active');
      }
    }
  }


  //Hover
  //Make navbar white, add class: active
  $('.header__main').hover( //rename to nav-main

    function () { //hover-over

      if ($(window).width() > 1000) {
        if (!opaqueNavAlways) {
          headerMain.classList.add('active');
        }
      }

    },

    function () { //hover-out

      var mobileExpanded = burgerButton.classList.contains('nav-mobile--active');
      //var megaActive = megaMenu.classList.contains('active');
      var pageNavActive = $('.nav-secondary').hasClass('active');

      var scrolledDown = false;
      if (window.scrollY > 500) {
        scrolledDown = true;
      }

      // && !megaActive
      if (!mobileExpanded && !opaqueNavAlways && !pageNavActive && !scrolledDown) {
        headerMain.classList.remove('active');
      }

    }
  )


  //MEGA MENU ----------

  let megaActive = false;
  $('.header__main__content__center__nav__list__item__link').hover(
    function () {

      // megaActive = true;
      // $('.nav-mega').addClass('active');

      // var panelId = this.getAttribute("navelement");
      // var panelTarget = $(".nav-mega__panel[panel='" + panelId + "']");

      // $('.nav-mega__panel').removeClass('active');
      // (panelTarget).addClass('active');

    },
  );


  //CLICK AWAY
  if(megaActive == true){
    document.addEventListener('click', evt => {

      // const isMegaMenu = megaMenu.contains(evt.target);
  
      // console.log('aaaa')
      // if (!isMegaMenu) {
      //   $('.nav-mega__panel').removeClass('active');
      //   $('.nav-mega').removeClass('active');
      // }

    });
  }




  //Mouse Leave Browser - remove mega / active
  $(document).mouseleave(function () {
    //$('.nav-mega').removeClass('active');

    //$('.nav-secondary').removeClass('mega-hide');
    //let menuActive = navMobile.classList.contains('nav-mobile--active');
    if (window.scrollY == 0 && !opaqueNavAlways) {
      headerMain.classList.remove('active');
    }
  });













  //OLD -------------------

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

});

