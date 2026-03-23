(function($){

    $(window).on('elementor/frontend/init', function(){

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/exsit_slick_slider.default',
            function($scope){

                var slider = $scope.find('.exsit-slick-slider');

                slider.slick({
                    slidesToShow:1,
                    slidesToScroll:1,
                    arrows:true,
                    dots:true,
                    autoplay:false
                });

            }
        );

    });

})(jQuery);