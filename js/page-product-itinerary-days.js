jQuery(document).ready(function ($) {

  $(".accordion-panel__heading").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.accordion-panel__content').slideToggle(350);
    $this.parent().find('.accordion-panel__heading').toggleClass('closed');
  });




});
