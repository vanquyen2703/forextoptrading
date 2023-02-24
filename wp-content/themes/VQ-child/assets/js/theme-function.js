/*!
 * Theme Function
 *
 * Js custom theme
 *
 * https://arrowhitech.com
 * Copyright 12-2021 AHT
 */
(function ($) {
    "use strict";

    // ScrollTo Image transition
    $.fn.visible = function (partial) {

        var $t = $(this),
            $w = $(window),
            viewTop = $w.scrollTop(),
            viewBottom = viewTop + $w.height(),
            _top = $t.offset().top,
            _bottom = _top + $t.height(),
            compareTop = partial === true ? _bottom : _top,
            compareBottom = partial === true ? _top : _bottom;

        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };

    $(window).scroll(function (event) {

        $(".people-img img, .who-item-content .uagb-ifb-content, .item-contact-group, .contact-img-top figure img").each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("come-in");
            }

        });

        $(".chart-img img, .result-img img, .contact-img-bot figure img").each(function (i, el) {
            var el = $(el);
            if (el.visible(true)) {
                el.addClass("come-in-slow");
            }
        });

    });

    //Hover change background
    function hoverChangeback() {
        $(".box-1").hover(function () {
            $('.box-1').removeClass('blue');
            $('.box-1').addClass('white');
            $('.box-2').removeClass('white');
            $('.box-2').addClass('blue');
        }, function () {
            $(".forensis-col").removeClass('blue');
            $(".forensis-col").removeClass('white');
        });
        $(".box-2").hover(function () {
            $('.box-2').removeClass('blue');
            $('.box-2').addClass('white');
            $('.box-1').removeClass('white');
            $('.box-1').addClass('blue');
        }, function () {
            $(".forensis-col").removeClass('blue');
            $(".forensis-col").removeClass('white');
        });
    }

    // Menu dropdown Languages
    function clickMenu() {
        $("header .menu .trp-ls-shortcode-current-language").click(function () {
            $('header .menu .trp-ls-shortcode-language').toggleClass('visible');

            $(document).click(function (event) {
                if (!$(event.target).closest("header .menu .trp-ls-shortcode-language, header .menu .trp-ls-shortcode-current-language").length) {
                    $("header .menu .trp-ls-shortcode-language").removeClass('visible');
                }
            });
        });


        $('header .wp-block-navigation__responsive-container').addClass('is-menu-open has-modal-open close');
        $('header .wp-block-navigation__responsive-container-open').on('click', function (e) {
            e.preventDefault();

            $('header .wp-block-navigation__responsive-container-open').toggleClass('close');
            $('header').toggleClass('active');

            $('header .wp-block-navigation__responsive-container').toggleClass('close');
        });


        // Scroll header page home
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= 300) {
                $('header').addClass("fixed");
                $('header').removeClass("relative");
            } else {
                $("header").addClass("relative");
                $("header").removeClass("fixed");
            }
        });
    }

    //Menu mobile click
    function menuClickMobile() {
        $('header li.wp-block-navigation-submenu .wp-block-navigation__submenu-container').slideUp();

        $('body').on('click', 'header ul .wp-block-navigation-submenu__toggle', function (e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $('header ul .wp-block-navigation-submenu__toggle.active + ul.wp-block-navigation__submenu-container').slideUp(300);
                $('header ul .wp-block-navigation-submenu__toggle.active + ul.wp-block-navigation__submenu-container').removeClass('active');
                $(this).removeClass('active');
            } else {
                $('header ul .wp-block-navigation-submenu__toggle').removeClass('active');
                $('header ul .wp-block-navigation-submenu__toggle + ul.wp-block-navigation__submenu-container').slideUp(300);
                $(this).addClass('active');
                $('header ul .wp-block-navigation-submenu__toggle.active + ul.wp-block-navigation__submenu-container').slideDown(300);
                $('header ul .wp-block-navigation-submenu__toggle.active + ul.wp-block-navigation__submenu-container').addClass('active');
            }
        });
    }

    // Main slider
    function slideMain() {
        $('.blogs .wwp-block-query .wp-block-post-template').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 5000,
            cssEase: 'linear',
            infinite: true,
        });
    }

    var $window = $(window);
    if ($window.width() > 768) {
        function parallax(selector) {
            var scrolled = $(window).scrollTop();
            $(selector).css('background-position', "0 " + (scrolled * 1) + 'px');
        }

        $(window).scroll(function (e) {
            parallax('.main-slider .slide .uagb-ifb-left-right-wrap');
        });
    }



    //Page services according
    function accordingServices() {
        $(".according-custom").on("click", function () {
            if ($(this).hasClass("active")) {
                $(".according-custom.active + .according-content").slideUp(400);
                $(this).removeClass("active");

            } else {
                $(".according-custom").removeClass("active");
                $(".according-content").slideUp(400);
                $(this).addClass("active");
                $(".according-custom.active + .according-content").slideDown(400);
            }
        });
    }
    function drap() {
        var clicked = false, clickY;
        $(document).on({
            'mousemove': function (e) {
                clicked && updateScrollPos(e);
            },
            'mousedown': function (e) {
                clicked = true;
                clickY = e.pageY;
            },
            'mouseup': function () {
                clicked = false;
                $('html').css('cursor', 'auto');
            }
        });

        var updateScrollPos = function (e) {
            $('html').css('cursor', 'row-resize');
            $(window).scrollTop($(window).scrollTop() + (clickY - e.pageY));
        }
    }

    $(document).ready(function () {
        clickMenu();
        slideMain();
        accordingServices();
        menuClickMobile();
        hoverChangeback();
        drap();
    });


})(jQuery);

