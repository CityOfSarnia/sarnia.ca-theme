// remap jQuery to $
!function(e){
/* trigger when page is ready */
e(document).ready(function(){e(".nav-open").on("click",function(n){n.preventDefault(),e(".nav-open").addClass("nav--is-open"),e(".nav-close").addClass("nav--is-open"),e(".nav").addClass("nav--is-open"),e(".header").addClass("nav--is-open")}),e(".nav-close").on("click",function(n){n.preventDefault(),e(".nav-open").removeClass("nav--is-open"),e(".nav-close").removeClass("nav--is-open"),e(".nav").removeClass("nav--is-open"),e(".header").removeClass("nav--is-open")})})}(window.jQuery);