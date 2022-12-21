


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


  //Main nav hover
  $('.nav-main').hover(

    function () { //hover-over
      console.log('hover');
      navMain.classList.add('active');
      // if (window.innerWidth > 1000) {
      //   navBackdrop.classList.add('active');
      // }


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
      navBackdrop.classList.add('active');

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







  //MOBILE MENU -----------------------------------------
  //variables
  const burgerButton = document.querySelector('#burger-menu');
  const navMobile = document.querySelector('.nav-mobile');
  //const headerMain = document.querySelector('.header__main');

  //Burger-- open
  burgerButton.addEventListener('click', evt => {
    navMobile.classList.add('nav-mobile--active');
    document.body.classList.add('lock-scroll');
    bodyDiv.classList.add('overlay');

  });



  function closeMobile() {
    bodyDiv.classList.remove('overlay');
    navMobile.classList.remove('nav-mobile--active');
    document.body.classList.remove('lock-scroll');

    $('.nav-mobile__content-panel').removeClass('slide-out-left');
    $('.nav-mobile__content-panel').removeClass('slide-center');

    // if (window.scrollY == 0) {
    //   if (opaqueNavAlways == false) {
    //     headerMain.classList.remove('active');
    //   }
    // }
  }




  //Mobile Menu
  const mobileButtons = [...document.querySelectorAll('.nav-button')];
  mobileButtons.forEach(item => {
    item.addEventListener('click', () => {
      let menuLink = item.getAttribute('menuLinkTo');

      var topPanel = document.querySelector('.nav-mobile__content-panel--top');
      var subPanel = document.querySelector('[menuid="' + menuLink + '"]');

      var isBackButton = $(item).hasClass('nav-back');
      var isPhoneButton = $(item).hasClass('phone');


      if (isBackButton) {
        $(topPanel).removeClass('slide-out-left');

        $(item).parent().removeClass('slide-center');
      } else if (isPhoneButton) {
        //do nothing
      } else {

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



});

