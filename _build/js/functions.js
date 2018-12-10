// remap jQuery to $
(function($) {
  /* trigger when page is ready */
  $(document).ready(function() {
    $(".nav-open").on("click", function(e) {
      e.preventDefault();
      $(".nav-open").addClass("nav--is-open");
      $(".nav-close").addClass("nav--is-open");
      $(".nav").addClass("nav--is-open");
      $(".header").addClass("nav--is-open");
    });

    $(".nav-close").on("click", function(e) {
      e.preventDefault();
      $(".nav-open").removeClass("nav--is-open");
      $(".nav-close").removeClass("nav--is-open");
      $(".nav").removeClass("nav--is-open");
      $(".header").removeClass("nav--is-open");
    });
  });
})(window.jQuery);
