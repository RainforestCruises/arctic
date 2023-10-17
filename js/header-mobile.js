jQuery(document).ready(function ($) {
    const burgerButton = document.querySelector('#burger-menu');
    const navMobile = document.querySelector('.nav-mobile');
    const navCloseButtons = [...document.querySelectorAll('.nav-close-button')];
  

    // burger open
    burgerButton.addEventListener('click', evt => {
      navMobile.classList.add('nav-mobile--active');
      document.body.classList.add('lock-scroll');
      document.body.classList.add('overlay');
    });
  
    navCloseButtons.forEach(item => {
      item.addEventListener('click', () => {
        closeMobile();
      });
    })
  
  
    function closeMobile() {
      document.body.classList.remove('overlay');
      navMobile.classList.remove('nav-mobile--active');
      document.body.classList.remove('lock-scroll');
  
      $('.nav-mobile__content-panel').removeClass('slide-out-left');
      $('.nav-mobile__content-panel').removeClass('slide-center');
    }
  
  
    // menu buttons
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
          $(item).parent().parent().removeClass('slide-center');
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
  
  
    // click away -- close modal
    document.addEventListener('click', evt => {
      const isMobileMenu = navMobile.contains(evt.target);
      const isBurgerOpen = burgerButton.contains(evt.target);
      let navActive = navMobile.classList.contains('nav-mobile--active');
  
      if (!isBurgerOpen && navActive && !isMobileMenu) {
        closeMobile();
      }
    });
  
    
  
  });
  
  