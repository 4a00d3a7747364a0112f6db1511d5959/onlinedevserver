jQuery(document).ready(function ($) {
//JS to Run onLoad
    $("a#show-city-list").attr("href", "javascript:;");
    $("a#show-filter-list").attr("href", "javascript:;");

//Mobile Navigation
    //Clone both menus to keep them intact
    var combinedMenu = $('.main-nav ul').clone();
    var secondMenu = $('.top-right-nav ul').clone();
    secondMenu.children('li').appendTo(combinedMenu);

    combinedMenu.slicknav({
        duplicate:false,
        label: 'Menu',
        duration: 500,
        prependTo: '#mobile_nav',
        close: function() {

        }
    });

//Show City DropDown
    var $show_city_list = $(".top-right-nav #show-city-list");
    var $show_filter_list = $(".top-right-nav #show-filter-list");
    $("a#show-city-list").click(function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");

        if($show_city_list.hasClass( "c-hlight" )) {
            $show_city_list.removeClass("c-hlight");
        } else {
            $show_city_list.addClass("c-hlight");
        }

        if($(this).position().top > '10') {
            setTimeout(function(){
                $(".city-menu").slideToggle();
            }, 500);
        } else {
            $(".city-menu").slideToggle();
        }
        $(".lady_menu").slideUp();
        $(".filter_menu").slideUp();
        $show_filter_list.removeClass("c-hlight");

        return false;
    });
    $("#close-city-menu").click(function(){
        $(".top-right-nav #show-city-list").removeClass("c-hlight");
        $(".city-menu").slideUp();
    });
//Show Filter DropDown
    $("a#show-filter-list").click(function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");

        if($show_filter_list.hasClass( "c-hlight" )) {
            $show_filter_list.removeClass("c-hlight");
        } else {
            $show_filter_list.addClass("c-hlight");
        }

        if($(this).position().top > '10') {
            setTimeout(function(){
                $(".filter_menu").slideToggle();
            }, 500);
        } else {
            $(".filter_menu").slideToggle();
        }
        $(".lady_menu").slideUp();
        $(".city-menu").slideUp();
        $show_city_list.removeClass("c-hlight");
        $('ul.slicknav_nav').slicknav('close');

        return false;
    });
    $("#close-filter_menu").click(function(){
        $(".top-right-nav #show-filter-list").removeClass("c-hlight");
        $(".filter_menu").slideUp();
    });
//Link to Page in Mobile Nav
    $("ul.slicknav_nav #show-lady_menu").click(function(){
        if($("#in_members").val()=='1') {
            window.location.href = "members/escort-services.htm#LadyList";
        } else {
            window.location.href = "/escort-services.htm#LadyList";
        }
        $('ul.slicknav_nav').slicknav('close');
    });
//Show Lady DropDown
    $("#show-lady_menu").click(function(){
        $(".lady_menu").slideToggle();
    });
    $("#close-lady_menu").click(function(){
        $(".lady_menu").slideUp();
    });
//BxSlider
    if ( $.isFunction($.fn.bxSlider) ) {
    //Activate Main Gallery Slider
        var numberOfTargetImages = $('.target-slider li img').length;
        if(numberOfTargetImages > 1) {
            $(".target-slider").bxSlider({
                auto: true,
                autoControls: false,
                captions: true,
                infiniteLoop: true,
                mode: 'fade',
                speed: 3000,
                easing: 'ease'
            });
        }
    //Activate News Slider
        var news_array = new Array();
        $('.block-news .news-slider').each(function(i){
            news_array[i] = $(this).bxSlider({
                slideWidth: 300,
                minSlides: 2,
                maxSlides: 4,
                moveSlides: 1,
                slideMargin: 0,
                captions: true,
                easing: 'ease'
            });
        });
        //Detect External Controls
            $(".block-news h3 span").click(function(){
                if($(this).hasClass('slider-custom-left')) {
                    $.each(news_array, function(i,elem){
                        elem.goToPrevSlide();
                    });
                } else if($(this).hasClass('slider-custom-right')) {
                    $.each(news_array, function(i,elem){
                        elem.goToNextSlide();
                    });
                }
            });
    //Activate Lady Slider
        var lady_array = new Array();
        $('.block-lady_list .lady_list').each(function(i){
            lady_array[i] = $(this).bxSlider({
                slideWidth: 240,
                minSlides: 2,
                maxSlides: 5,
                moveSlides: 1,
                slideMargin: 0,
                captions: true,
                easing: 'ease'
            });
        });
        //Detect External Controls
        $(".block-lady_list h3 span").click(function(){
            if($(this).hasClass('slider-custom-left')) {
                $.each(lady_array, function(i,elem){
                    elem.goToPrevSlide();
                });
            } else if($(this).hasClass('slider-custom-right')) {
                $.each(lady_array, function(i,elem){
                    elem.goToNextSlide();
                });
            }
        });
    //Activate Lady Thumb Slider
        var thumb_array = new Array();
        if( $(window).width()<='480' ) {
            $('.block_thumb_list .thumb_list').each(function(i){
                thumb_array[i] = $(this).bxSlider({
                    slideWidth: 480,
                    minSlides: 1,
                    maxSlides: 1,
                    moveSlides: 1,
                    slideMargin: 0,
                    captions: true,
                    easing: 'ease'
                });
            });
        } else {
            $('.block_thumb_list .thumb_list').each(function(i){
                thumb_array[i] = $(this).bxSlider({
                    slideWidth: 300,
                    minSlides: 2,
                    maxSlides: 4,
                    moveSlides: 1,
                    slideMargin: 0,
                    captions: true,
                    easing: 'ease'
                });
            });
        }
        //Detect External Controls
        $(".block_thumb_list h3 span").click(function(){
            if($(this).hasClass('slider-custom-left')) {
                $.each(thumb_array, function(i,elem){
                    elem.goToPrevSlide();
                });
            } else if($(this).hasClass('slider-custom-right')) {
                $.each(thumb_array, function(i,elem){
                    elem.goToNextSlide();
                });
            }
        });
    }
//Pretty Photo

//Scroll to News Article if ID is in URL Hash
    if(window.location.hash) {
        var hash = window.location.hash.substring(1);

        if($.isNumeric(hash)) {
            $('html,body').animate({
                    scrollTop: $("#newsid" + hash).offset().top
                }, '2000');
        }
        if(hash=='LadyList') {
            $('html,body').animate({
                scrollTop: $(".main_lady_list").offset().top
            }, '2000');
        }
        if(hash=='BookingForm') {
            $('html,body').animate({
                scrollTop: $(".generic_booking_form").offset().top
            }, '5000');
        }
        if(hash=='FeedbackForm') {
            $("#feedback-form").slideToggle("slow",function(){
                $('html,body').animate({
                        scrollTop: $("#feedback-form").offset().top},
                    '2000');
            });
        }
        if(hash=='CastingForm') {
            $('html,body').animate({
                scrollTop: $(".CastingForm").offset().top
            }, '5000');
        }

    }
//Scroll to Ladies on City Landing Page
    $("#landing-scroll").click(function(){
        $('html,body').animate({
                scrollTop: $(".landing_lady_list").offset().top},
            '5000');
    });
//Scroll to Ladies on Main Thumb Page
    $("#mainthumb-scroll").click(function(){
        $('html,body').animate({
                scrollTop: $(".main_lady_list").offset().top},
            '5000');
    });
//Scroll to Details on Lady Page
    $("#lady-scroll").click(function(){
        $('html,body').animate({
                scrollTop: $(".lady-scroll-to").offset().top},
            '5000');
    });
//Scroll for Content Pages
    $("#scroll-to-content").click(function(){
        $('html,body').animate({
                scrollTop: $(".content1").offset().top},
            '5000');
    });
//Lady Profile Page
    $("#show-lady-text2").click(function(){
        $(this).fadeOut("slow",function(){
            $("#lady-text2").slideDown();
        })
    });
    $("#lady_feedbacks a#show-more-feedbacks").click(function(){
        $(this).fadeOut("slow",function(){
            $("#more-feedbacks").slideDown();
        })
    });
    $("a#show-feedback-form").click(function(){
        $("#feedback-form").slideToggle("slow",function(){
        $('html,body').animate({
                scrollTop: $("#feedback-form").offset().top},
            '5000');
        });
    });
    $("a#show-feedback-form2").click(function(){
        $("#feedback-form").slideDown("slow",function(){
            $('html,body').animate({
                    scrollTop: $("#feedback-form").offset().top},
                '5000');
        });
    });
    $("a#show-booking-form").click(function(){
        var $booking_block=$("#lady_booking_block");

        $booking_block.slideDown(1500);
        $('html,body').animate({
                scrollTop: $booking_block.offset().top},
            '10000');
    });
//Feedback Page
    $("#feedback_page a#show-more-feedbacks").click(function(){
        var $link_val = $(this);
        $link_val.fadeOut("slow",function(){
            $link_val.parent().parent().closest("div").children("#more-feedbacks").slideDown();
        });
    });

//FAQ Page
    $(".strip-faq h2, .strip-faq h3, .strip-faq h5").click(function(){
        $(this).parent().next().slideToggle("slow");
    });
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $("a[rel^='prettyPhoto']").attr("href","javascript:;");
    } else {
        if ( $.isFunction($.fn.prettyPhoto) ) {
            $("a[rel^='prettyPhoto']").prettyPhoto({
                animation_speed: 'fast', /* fast/slow/normal */
                slideshow: 5000, /* false OR interval time in ms */
                autoplay_slideshow: false, /* true/false */
                opacity: 0.80, /* Value between 0 and 1 */
                show_title: false, /* true/false */
                allow_resize: true, /* Resize the photos bigger than viewport. true/false */
                allow_expand: false,
                default_width: 800,
                default_height: 600,
                counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
                theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                horizontal_padding: 20, /* The padding on each side of the picture */
                hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
                wmode: 'opaque', /* Set the flash wmode attribute */
                autoplay: true, /* Automatically start videos: True/False */
                modal: false, /* If set to true, only the close button will close the window */
                deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
                overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
                keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
                ie6_fallback: true,
                custom_markup: '',
                social_tools: false /* html or false to disable */
            });
        }
    }
    $(document).bind("contextmenu", function(event) {
        event.preventDefault();
    });
    $(".application2submit").click(function(){
        $(this).hide();
        $("<img src='/images/bx_loader.gif'>").appendTo("#application2box");
    });
    $("div.payment_page a#toggle_3d_secure").click(function(){
        $("div.payment_page div.secure-info-box").slideToggle("fast");
    });
    $("div.payment_page a#pay_now").click(function(){
        $("div.payment_page div#light-pop-overlay").fadeIn("fast");
    });
    $("div.payment_page div.light-pop .close-it").click(function(){
        $("div.payment_page div#light-pop-overlay").fadeOut("fast");
    });
    $(".landing_news_archive").on("click", "a#show_more", function(){
        $(this).remove();
        $(".landing_news_archive .news_entry").removeClass('hide_me');
    });
    if($("#in_members").val()=='1') {
        $("a.link-inactive").click(function() {
            alert('The page you are trying to access does not exist inside the Members Area');
        })
    }
});
