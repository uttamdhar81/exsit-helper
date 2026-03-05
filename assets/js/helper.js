(function ($) {

  "use strict";

  $(document).on("click", ".post-load-more-btn", function () {

    let button = $(this);
    let wrapper = $(".post-blog-wrapper");

    let page = parseInt(button.attr("data-page")) + 1;
    let max = parseInt(button.attr("data-max"));

    let posts_per_page = button.attr("data-posts-per-page");
    let image_size = button.attr("data-image-size");
    let excerpt_length = button.attr("data-excerpt-length");

    $.ajax({

      url: exsit_ajax.ajaxurl,
      type: "POST",

      data: {
        action: "exsit_load_more_posts",
        page: page,
        posts_per_page: posts_per_page,
        image_size: image_size,
        excerpt_length: excerpt_length
      },

      success: function (response) {

        if (response.trim() === "") {
          button.hide();
          return;
        }

        wrapper.append(response);

        button.attr("data-page", page);

        if (page >= max) {
          button.hide();
        }

      }

    });

  });

})(jQuery);