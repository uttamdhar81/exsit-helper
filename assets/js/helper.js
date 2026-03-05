(function ($) {

  "use strict";
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/global',
      function ($scope) {

        $(document).on("click", ".post-load-more-btn", function () {

          let button = $(this);
          let page = parseInt(button.data("page"));
          let max = parseInt(button.data("max"));

          if (page >= max) return;

          page++;

          $.get(window.location.href + "?paged=" + page, function (data) {
            let posts = $(data).find(".post-blog-wrapper").html();
            $(".post-blog-wrapper").append(posts);
            button.data("page", page);
            if (page >= max) {
              button.hide();
            }
          });
        });
      });

  });

})(jQuery);