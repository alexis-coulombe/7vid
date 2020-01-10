/*
Template Name: VIDOE - Video Streaming Website HTML Template
Author: Askbootstrap
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/
(function ($) {
    "use strict"; // Start of use strict

    // Temporarly fix Passive Event Listeners
    // https://stackoverflow.com/questions/39152877/consider-marking-event-handler-as-passive-to-make-the-page-more-responsive
    jQuery.event.special.touchstart =
        {
            setup: function (_, ns, handle) {
                if (ns.includes("noPreventDefault")) {
                    this.addEventListener("touchstart", handle, {passive: false});
                } else {
                    this.addEventListener("touchstart", handle, {passive: true});
                }
            }
        };

    // Toggle the side navigation
    $(document).on('click', '#sidebarToggle', function (e) {
        e.preventDefault();
        //$("body").toggleClass("sidebar-toggled");
        $("#overlay").toggle();
        $(".sidebar").toggleClass("toggled");
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($window.width() > 768) {
            let e0 = e.originalEvent,
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
                0: {
                    items: 3,
                },
                600: {
                    items: 3,
                },
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
        });
    }

    // Video cards Owl Carousel
    const videoSlider = $('.owl-carousel-video-card');
    if (videoSlider.length > 0) {
        videoSlider.owlCarousel({
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
            },
            loop: true,
            margin: 15,
            lazyLoad: true,
            autoplay: true,
            autoplaySpeed: 1000,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            nav: true,
            navText: [
                "<i class=\"fas fa-arrow-left\"></i>",
                "<i class=\"fas fa-arrow-right\"></i>",
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
    $('[data-toggle="tooltip"]').tooltip();

    // Scroll to top button appear
    $(document).on('scroll', function () {
        let scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (event) {
        let $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });

    // Add aria-label to carousel buttons
    // https://stackoverflow.com/questions/41818880/owl-carousel-2-2-dots-with-aria-label
    $('.owl-carousel').each(function () {
        $(this).find('.owl-dot').each(function (index) {
            $(this).attr('aria-label', index + 1);
        });
    });

    // Detect CTRL+S
    if ($('#save-on-keyboard').length) {
        $(document).on('keydown', (e) => {
            if (e.ctrlKey && e.which === 83) {
                $('#save-on-keyboard').submit();
                e.preventDefault();
                return false;
            }
        });
    }

    // Generate abstract background to channels cards
    $('.generate-background').each(function () {
        generateAbstractBackground($(this));
    });

    function generateAbstractBackground(element) {
        let pattern = Trianglify({
            width: element.width() * 2,
            height: element.height() * 2,
            seed: Math.random() + 1
        });

        let image = pattern.canvas().toDataURL('image/png');

        element.css('background-image', 'url("' + image + '")');
    }

    // Close sidenav on overlay click
    $('#overlay').on('click', function () {
        $('.sidebar.navbar-nav').addClass('toggled');
        $(this).toggle();
    });

    // Classic editor init
    if ($('#editor').length) {
        ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
            heading: {
                options: [
                    {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                    {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                    {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'}
                ]
            }
        });
    }

    // Comment filter trigger
    $('.filter_item').on('click', function () {
        $('#filter_value').val($(this).data('value'));
        $('#filter_form').submit();
    });
})(jQuery); // End of use strict
