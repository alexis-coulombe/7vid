/*
Template Name: VIDOE - Video Streaming Website HTML Template
Author: Askbootstrap
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/
(function($) {
    "use strict"; // Start of use strict

    // Temporarly fix Passive Event Listeners
    // https://stackoverflow.com/questions/39152877/consider-marking-event-handler-as-passive-to-make-the-page-more-responsive
    jQuery.event.special.touchstart =
    {
      setup: function( _, ns, handle )
      {
        if ( ns.includes("noPreventDefault") )
        {
          this.addEventListener("touchstart", handle, { passive: false });
        }
        else
        {
          this.addEventListener("touchstart", handle, { passive: true });
        }
      }
    };

    // Toggle the side navigation
    $(document).on('click', '#sidebarToggle', function(e) {
        e.preventDefault();
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($window.width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Category Owl Carousel
    const objowlcarousel = $('.owl-carousel-category');
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            responsive: {
                1000: {
                    items: 4,
                },
                1200: {
                    items: 6,
                },
            },
            loop: true,
            lazyLoad: true,
            autoplay: true,
            autoplaySpeed: 1000,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            nav: true,
            navText: [
                "",
                "",
            ],
        });
    }

    // Video cards Owl Carousel
    const videoSlider = $('.owl-carousel-video-card');
    if (videoSlider.length > 0) {
        videoSlider.owlCarousel({
            responsive: {
                1000: {
                    items: 4,
                },
                1200: {
                    items: 4,
                },
            },
            loop: true,
            margin:10,
            lazyLoad: true,
            autoplay: true,
            autoplaySpeed: 1000,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            nav: true,
            navText: [
                "",
                "",
            ],
        });
    }

    // Login Owl Carousel
    const mainslider = $('.owl-carousel-login');
    if (mainslider.length > 0) {
        mainslider.owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            autoplay: true,
            autoplaySpeed: 2000,
            autoplayTimeout: 6000,
            autoplayHoverPause: true
        });
    }

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip()

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });

    // Add aria-label to carousel buttons
    // https://stackoverflow.com/questions/41818880/owl-carousel-2-2-dots-with-aria-label
    $('.owl-carousel').each(function() {
      $(this).find('.owl-dot').each(function(index) {
        $(this).attr('aria-label', index + 1);
      });
    });

    // Detect CTRL+S
    if($('#save-on-keyboard').length) {
        $(document).on('keydown', (e) => {
            if (e.ctrlKey && e.which === 83) {
                $('#save-on-keyboard').submit();
                e.preventDefault();
                return false;
            }
        });
    }

})(jQuery); // End of use strict
