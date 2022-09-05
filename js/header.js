


jQuery(document).ready(function ($) {

  //Variables
  const bodyDiv = document.querySelector('#body');
  const headerDiv = document.querySelector('.header');
  const navMain = document.querySelector('.nav-main');
  const navMega = document.querySelector('.nav-mega');
  const navBackdrop = document.querySelector('.nav-backdrop');


  //Set Header Style
  let opaqueNavAlways = header_vars.alwaysActiveHeader;
  let fixedHeader = headerDiv.classList.contains('fixed');


  //not used
  const burgerButton = document.querySelector('#burger-menu');
  const navMobile = document.querySelector('.nav-mobile');


  //apply header styles on scroll if fixed header
  if (fixedHeader == true) {
    window.addEventListener('scroll', applyNavStyle);
  }

  if (fixedHeader == false) {
    window.addEventListener('scroll', clearMega);
  }

  function applyNavStyle() {
    let megaActive = navMega.classList.contains('active');
    let mainActive = navMain.classList.contains('active');

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

      if (window.scrollY > 600) {
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


  //Main nav hover
  $('.nav-main').hover(

    function () { //hover-over
      console.log('hover');
      navMain.classList.add('active');
      if (window.innerWidth > 1000) {
        navBackdrop.classList.add('active');
      }


    },

    function () { //hover-out
      var megaActive = navMega.classList.contains('active');
      var scrolledDown = (window.scrollY > 300) ? true : false;

      if (!opaqueNavAlways && !scrolledDown && !megaActive) {
        navMain.classList.remove('active');
      }

      if (!megaActive) {
        navBackdrop.classList.remove('active');
      }

    }
  )

  //Nav Links ----------
  //Nav links hover ----------
  $('.nav-main__content__center__nav__list__item').hover(
    function () { //over

      navMega.classList.add('active');
      navMain.classList.add('active');
      navMain.classList.add('mega-active');

      $('.nav-main__content__center__nav__list__item').removeClass('active');
      this.classList.add('active');


      var panelId = this.getAttribute("navelement");
      var panelTarget = $(".nav-mega__panel[panel='" + panelId + "']");

      $('.nav-mega__panel').removeClass('active');
      $(panelTarget).addClass('active');

    },
    function () { //out

      var megaActive = navMega.classList.contains('active');
      if (window.scrollY == 0 && !opaqueNavAlways && !megaActive) {
        navMain.classList.remove('active');

      }

      if (!megaActive) {
        navBackdrop.classList.remove('active');

      }

    },
  );


  //Mega Menu ----------
  //Remove mega and backdrop when hover back to page
  $('.nav-mega').hover(
    function () {//on hover over
      //Nada
    },
    function () {//on hover out
      navMega.classList.remove('active');
      navMain.classList.remove('mega-active');

      $('.nav-main__content__center__nav__list__item').removeClass('active');

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
      $('.nav-main__content__center__nav__list__item').removeClass('active');
    },
  )


  //Mouse Leave Browser - remove mega / active
  $(document).mouseleave(function () {
    navMega.classList.remove('active');
    navMain.classList.remove('mega-active');
    navBackdrop.classList.remove('active');

    $('.nav-main__content__center__nav__list__item').removeClass('active');

    if (window.scrollY == 0 && !opaqueNavAlways) {
      navMain.classList.remove('active');
    }
  });






  //OLD -------------------



  //Scroll to Top on Reload
  if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
  } else {
    window.onbeforeunload = function () {
      window.scrollTo(0, 0);
    }
  }


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



  // //TEMPLATE SPECIFIC EXTRAS -----------------------------------------------------------------
  // //SERP
  // const searchFilterBar = document.getElementById('search-filter-bar'); //for search template

  // //Resize Window - Close menus
  // $(window).resize(function () {

  //   if ($(window).width() > 1000) {
  //     navMobile.classList.remove('nav-mobile--active');
  //     bodyDiv.classList.remove('overlay');
  //   }
  //   if ($(window).width() <= 1000) {
  //     navMega.classList.remove('active');
  //     megaMenuOverlay.classList.remove('active');

  //   }
  // });

});

