jQuery(document).ready(function ($) {
  
    //faq expand/hide
    $(".category-faq__group__question").on("click", function (e) {
      e.preventDefault();
      let $this = $(this);
      $this.parent().find('.category-faq__group__answer').slideToggle(350);
      $this.parent().find('.plus-minus-toggle').toggleClass('plus-collapsed');
      $this.parent().find('.category-faq__group__question').toggleClass('category-faq__group__question--active');
  });





});
