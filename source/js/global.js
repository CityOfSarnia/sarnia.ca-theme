(function($) {
  $(document).ready(function() {
    var wrap = $(".wrap");
    var notification = $(".feature-notification");
    var navToggle = $(".js-primary-menu__toggle");

    navToggle.on("click", function() {
      if (wrap.hasClass("js-nav_is_open")) {
        setTimeout(function() {
          wrap.removeClass("js-nav_is_visible");
        }, 1000);
      } else {
        wrap.addClass("js-nav_is_visible");
      }
      wrap.toggleClass("js-nav_is_open");
      notification.toggleClass("js-nav_is_open");
    });
  });
})(window.jQuery);
