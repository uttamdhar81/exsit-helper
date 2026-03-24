(function ($) {

    "use strict";

    /* -------------------------------------------------------
    POST LOAD MORE
    ------------------------------------------------------- */
    $(document).on("click", ".post-load-more-btn", function () {

        let button = $(this);
        let wrapper = button.closest('.elementor-widget').find('.post-blog-wrapper');

        let page = parseInt(button.attr("data-page")) + 1;
        let max = parseInt(button.attr("data-max"));

        $.ajax({
            url: exsit_ajax.ajaxurl,
            type: "POST",
            data: {
                action: "exsit_load_more_posts",
                page: page,
                posts_per_page: button.attr("data-posts-per-page"),
                image_size: button.attr("data-image-size"),
                excerpt_length: button.attr("data-excerpt-length"),
                style: button.attr("data-style"),
                columns: button.attr("data-columns"),
                show_excerpt: button.attr("data-show-excerpt"),
                show_author: button.attr("data-show-author")
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


    /* -------------------------------------------------------
    SLICK SLIDER
    ------------------------------------------------------- */

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/exsit_slick_slider.default',
            function ($scope) {

                let slider = $scope.find('.exsit-slick-slider');
                let current = $scope.find('.exsit-slider-counter .current');
                let total = $scope.find('.exsit-slider-counter .total');
                let autoplay = slider.data('autoplay');
                let dots = slider.data('dots');
                let arrows = slider.data('arrows');
                let autoplaySpeed = slider.data('autoplay-speed');


                slider.on('init', function (event, slick) {
                    total.text(slick.slideCount);
                    current.text(slick.currentSlide + 1);
                });

                slider.on('afterChange', function (event, slick, currentSlide) {
                    current.text(currentSlide + 1);
                });

                if (!slider.hasClass('slick-initialized')) {

                    slider.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: arrows,
                        dots: dots,
                        autoplay: autoplay,
                        autoplaySpeed: autoplaySpeed,
                        adaptiveHeight: true
                    });

                }

            }
        );

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/exsit_feedback_slider.default',
            function ($scope) {

                let slider = $scope.find('.exsit-slick-slider');

                let autoplay = slider.data('autoplay');
                let dots = slider.data('dots');
                let arrows = slider.data('arrows');
                let autoplaySpeed = slider.data('autoplay-speed');

                // ✅ SUPPORT STYLE2 + STYLE3
                let style = slider.data('style');
                let isMultiSlide = style === 'style2' || style === 'style3';

                if (!slider.hasClass('slick-initialized')) {

                    slider.slick({

                        slidesToShow: isMultiSlide ? 3 : 1,
                        slidesToScroll: 1,

                        arrows: arrows,
                        dots: dots,
                        autoplay: autoplay,
                        autoplaySpeed: autoplaySpeed,

                        speed: 400,
                        adaptiveHeight: true,

                        // ✅ ONLY STYLE1 USES FADE
                        ...(isMultiSlide ? {} : {
                            fade: true,
                            cssEase: 'linear'
                        }),

                        // ✅ RESPONSIVE FOR STYLE2 + STYLE3
                        responsive: isMultiSlide ? [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1
                                }
                            }
                        ] : []

                    });

                }

            }
        );

    });

})(jQuery);