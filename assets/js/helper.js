; (function ($) {
    'use strict';

    /*=================================
     JS Index Here
    ==================================*/

    $(window).on('elementor/frontend/init', function () {
      /*---------- Global Js ----------*/
      elementorFrontend.hooks.addAction(
        "frontend/element_ready/global",
        function ($scope) {
          $(".sub-menu li.menu-item-has-children a").addClass("no-border");
        }
      );

      /*---------- Mobile Menu Active ----------*/
      elementorFrontend.hooks.addAction(
        "frontend/element_ready/primary-main-menu.default",
        function ($scope) {
          /*----------  Mobile Menu Active ----------*/
          $.fn.vsmobilemenu = function (options) {
            var opt = $.extend(
              {
                menuToggleBtn: ".primary-menu-toggle",
                bodyToggleClass: "primary-body-visible",
                subMenuClass: "primary-submenu",
                subMenuParent: "primary-item-has-children",
                subMenuParentToggle: "primary-active",
                meanExpandClass: "primary-mean-expand",
                appendElement: '<span class="primary-mean-expand"></span>',
                subMenuToggleClass: "primary-open",
                toggleSpeed: 400,
              },
              options
            );

            return this.each(function () {
              var menu = $(this); // Select menu

              // Menu Show & Hide
              function menuToggle() {
                menu.toggleClass(opt.bodyToggleClass);

                // collapse submenu on menu hide or show
                var subMenu = "." + opt.subMenuClass;
                $(subMenu).each(function () {
                  if ($(this).hasClass(opt.subMenuToggleClass)) {
                    $(this).removeClass(opt.subMenuToggleClass);
                    $(this).css("display", "none");
                    $(this).parent().removeClass(opt.subMenuParentToggle);
                  }
                });
              }

              // Class Set Up for every submenu
              menu.find("li").each(function () {
                var submenu = $(this).find("ul");
                submenu.addClass(opt.subMenuClass);
                submenu.css("display", "none");
                submenu.parent().addClass(opt.subMenuParent);
                submenu.prev("a").append(opt.appendElement);
                submenu.next("a").append(opt.appendElement);
              });

              // Toggle Submenu
              function toggleDropDown($element) {
                var $submenu =
                  $element.next("ul").length > 0
                    ? $element.next("ul")
                    : $element.prev("ul");

                // Close only sibling submenus
                $element
                  .parent()
                  .siblings()
                  .find("." + opt.subMenuClass)
                  .each(function () {
                    if ($(this).hasClass(opt.subMenuToggleClass)) {
                      $(this)
                        .removeClass(opt.subMenuToggleClass)
                        .slideUp(opt.toggleSpeed);
                      $(this).parent().removeClass(opt.subMenuParentToggle);
                    }
                  });

                // Toggle the clicked submenu
                $element.parent().toggleClass(opt.subMenuParentToggle);
                $submenu
                  .slideToggle(opt.toggleSpeed)
                  .toggleClass(opt.subMenuToggleClass);
              }

              // Submenu toggle Button
              var expandToggler = "." + opt.meanExpandClass;
              $(expandToggler).each(function () {
                $(this).on("click", function (e) {
                  e.preventDefault();
                  toggleDropDown($(this).parent());
                });
              });

              // Menu Show & Hide On Toggle Btn click
              $(opt.menuToggleBtn).each(function () {
                $(this).on("click", function () {
                  menuToggle();
                });
              });

              // Hide Menu On outside click
              menu.on("click", function (e) {
                e.stopPropagation();
                menuToggle();
              });

              // Stop Hide full menu on menu click
              menu.find("div").on("click", function (e) {
                e.stopPropagation();
              });
            });
          };

          $(".primary-menu-wrapper").vsmobilemenu();
        }
      );

      //
          elementorFrontend.hooks.addAction(
            "frontend/element_ready/lonyo-portfolio.default",
            function ($scope) {
              $(".pf-isotope-nav li").on("click", function () {
                const filterValue = $(this).data("filter");

                $(".pf-isotope-nav li").removeClass("active");
                $(this).addClass("active");

                $(".portfolio-pf-item-wrap").each(function () {
                  const item = $(this);
                  if (
                    filterValue === "*" ||
                    item.hasClass(filterValue.substring(1))
                  ) {
                    item.show();
                  } else {
                    item.hide();
                  }
                });
              });
            }
          );
      // End All Js
    });
}(jQuery));
