(function ($) {

  "use strict";

  $(document).on("click", ".post-load-more-btn", function () {

    let button = $(this);

    // target correct widget wrapper
    let wrapper = button.closest('.elementor-widget').find('.post-blog-wrapper');

    let page = parseInt(button.attr("data-page")) + 1;
    let max = parseInt(button.attr("data-max"));

    let posts_per_page = button.attr("data-posts-per-page");
    let image_size = button.attr("data-image-size");
    let excerpt_length = button.attr("data-excerpt-length");
    let style = button.attr("data-style");
    let columns = button.attr("data-columns");
    let show_excerpt = button.attr("data-show-excerpt");
    let show_author = button.attr("data-show-author");

    $.ajax({

      url: exsit_ajax.ajaxurl,
      type: "POST",

      data: {
        action: "exsit_load_more_posts",
        page: page,
        posts_per_page: posts_per_page,
        image_size: image_size,
        excerpt_length: excerpt_length,
        style: style,
        columns: columns,
        show_excerpt: show_excerpt,
        show_author: show_author
      },

      success: function (response) {

        if ($.trim(response) === "") {
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