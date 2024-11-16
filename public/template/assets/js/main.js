(function ($) {
    "use strict";

    $(document).ready(function () {
        /**-----------------------------
         *  Navbar fix
         * ---------------------------*/
        $(document).on(
            "click",
            ".navbar-area .navbar-nav li.menu-item-has-children>a",
            function (e) {
                e.preventDefault();
            }
        );

        /*-------------------------------------
            menu
        -------------------------------------*/
        $(".navbar-area .menu").on("click", function () {
            $(this).toggleClass("open");
            $(".navbar-area .navbar-collapse").toggleClass("sopen");
        });

        // mobile menu
        if ($(window).width() < 992) {
            $(".in-mobile").clone().appendTo(".sidebar-inner");
            $(".in-mobile ul li.menu-item-has-children").append(
                '<i class="fas fa-chevron-right"></i>'
            );
            $('<i class="fas fa-chevron-right"></i>').insertAfter("");

            $(".menu-item-has-children a").on("click", function (e) {
                // e.preventDefault();

                $(this).siblings(".sub-menu").animate(
                    {
                        height: "toggle",
                    },
                    300
                );
            });
        }

        var menutoggle = $(".menu-toggle");
        var mainmenu = $(".navbar-nav");

        menutoggle.on("click", function () {
            if (menutoggle.hasClass("is-active")) {
                mainmenu.removeClass("menu-open");
            } else {
                mainmenu.addClass("menu-open");
            }
        });

        /*--------------------------------------------------
            select onput
        ---------------------------------------------------*/
        if ($("select").length) {
            $("select").niceSelect();
        }

        /* -----------------------------------------------------
            Variables
        ----------------------------------------------------- */
        var leftArrow = '<i class="la la-angle-left"></i>';
        var rightArrow = '<i class="la la-angle-right"></i>';

        /* -------------------------------------------------
            Magnific JS 
        ------------------------------------------------- */
        $(".video-play-btn").magnificPopup({
            type: "iframe",
            removalDelay: 260,
            mainClass: "mfp-zoom-in",
        });
        $.extend(true, $.magnificPopup.defaults, {
            iframe: {
                patterns: {
                    youtube: {
                        index: "youtube.com/",
                        id: "v=",
                        src: "https://www.youtube.com/embed/Wimkqo8gDZ0",
                    },
                },
            },
        });

        /*------------------------------------------------
            post-slider
        ------------------------------------------------*/
        $(".post-slider").owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            smartSpeed: 1500,
            navText: [leftArrow, rightArrow],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                992: {
                    items: 1,
                },
            },
        });

        /*---------------------------------------------
            cs-partner-slider-11
        ----------------------------------------------*/
        $(".most-view-slider").owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            smartSpeed: 1500,
            center: true,
            items: 3,
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                768: {
                    items: 3,
                },
            },
        });

        /*--------------------------------------------
            Search Popup
        ---------------------------------------------*/
        var bodyOvrelay = $("#body-overlay");
        var searchPopup = $("#td-search-popup");

        $(document).on("click", "#body-overlay", function (e) {
            e.preventDefault();
            bodyOvrelay.removeClass("active");
            searchPopup.removeClass("active");
        });
        $(document).on("click", ".search", function (e) {
            e.preventDefault();
            searchPopup.addClass("active");
            bodyOvrelay.addClass("active");
        });

        /*-------------------------------------------------
            wow js init
        --------------------------------------------------*/
        new WOW().init();

        /*------------------
           back to top
        ------------------*/
        $(document).on("click", ".back-to-top", function () {
            $("html,body").animate(
                {
                    scrollTop: 0,
                },
                2000
            );
        });
    });

    $(window).on("scroll", function () {
        /*---------------------------------------
            back-to-top
        -----------------------------------------*/
        var ScrollTop = $(".back-to-top");
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }

        /*---------------------------------------
            sticky-active
        -----------------------------------------*/
        var scroll = $(window).scrollTop();
        if (scroll < 445) {
            $(".navbar").removeClass("sticky-active");
        } else {
            $(".navbar").addClass("sticky-active");
        }
    });

    $(window).on("load", function () {
        /*-----------------
            preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(0);

        /*-----------------
            back to top
        ------------------*/
        var backtoTop = $(".back-to-top");
        backtoTop.fadeOut();

        /*---------------------
            Cancel Preloader
        ----------------------*/
        $(document).on("click", ".cancel-preloader a", function (e) {
            e.preventDefault();
            $("#preloader").fadeOut(2000);
        });
    });
})(jQuery);
$(document).ready(function() {
    $('#notification-btn').click(function() {
        var notificationList = $('#notification-list');
        
        if (notificationList.is(':visible')) {
            notificationList.hide();
        } else {
            notificationList.show();
        }
    });

    // Hàm tải thông báo mới từ API
    function loadNotifications() {
        $.ajax({
            url: '/notifications', 
            method: 'GET',
            success: function(response) {
                console.log(response); // Kiểm tra kết quả từ API

                if (response.notifications.length > 0) {
                    // Cập nhật số lượng thông báo
                    $('#notification-count').text(response.notifications.length);

                    // Tạo danh sách thông báo
                    let notifications = `
                        <div class="post-item clearfix m-2">
                            <p><strong>Bài viết mới nhất:</strong></p>
                        </div>
                    `;

                    notifications += response.notifications.map(function(notification) {
                        return `
                            <div class="post-item clearfix mb-2 mr-2 ml-2">
                                <a href="${notification.link}" class="notification-link">
                                    <img src="${notification.image}" alt="Image" class="notification-img">
                                    <h6 class="notification-title">${notification.title}</h6>
                                </a>
                            </div>
                        `;
                    }).join('');

                    // Hiển thị danh sách thông báo
                    $('#notification-list').html(notifications);
                } else {
                    $('#notification-list').html('<a class="dropdown-item" href="#">Không có thông báo mới</a>');
                }
            },
            error: function() {
                console.log("Không thể lấy thông báo.");
            }
        });
    }

    // Gọi hàm ngay khi trang được tải để hiển thị thông báo
    loadNotifications();
});
