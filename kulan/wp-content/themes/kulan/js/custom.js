jQuery(document).ready(function(){



    //home banner

    jQuery('.bxslider').bxSlider();



    //agents banner

    jQuery('.agent-slider').bxSlider();



    //single agent carousal

    jQuery('.agent-biopic').slick({

      centerMode: true,

      centerPadding: '60px',

      slidesToShow: 5,

      responsive: [

        {

          breakpoint: 768,

          settings: {

            arrows: false,

            centerMode: true,

            centerPadding: '40px',

            slidesToShow: 3

          }

        },

        {

          breakpoint: 480,

          settings: {

            arrows: false,

            centerMode: true,

            centerPadding: '40px',

            slidesToShow: 1

          }

        }

      ]

    });



    //agents banner

    jQuery('.about-kulan-slider').bxSlider();



	// Shadow it

    function doScroll(){

        var scrollTop = jQuery(window).scrollTop();



        if(scrollTop > 100){

            jQuery('.header').addClass('shadow');

            jQuery('body').addClass('scrolling');

        }else{

            jQuery('.header').removeClass('shadow');

            jQuery('body').removeClass('scrolling');



        }

    }



    jQuery(window).scroll(function(){

        doScroll();

    });



    jQuery('.newsletter').click(function(){

        jQuery('#mp_1').toggleClass('open');

    });



    // Parallax

    function ch_scroll(){

        var h = parseInt(jQuery(window).height(), 0),

        sp = parseInt(jQuery(window).scrollTop(), 0);

        jQuery('.hero').each(function(){

            var self = jQuery(this);

            var el = jQuery(self).offset();

            var elt = sp - (el.top-h);

            if(elt > 0){

                var j = 100 - (elt/h*100);

                jQuery(self).css('background-position', 'center '+j+'%');

            }



        });

    }



    jQuery(window).scroll( function(e){

      ch_scroll();

    });



    jQuery(window).resize( function(e){

      ch_scroll();

    });



    jQuery(window).load( function(e){

        ch_scroll();

        // if(parseInt(jQuery(window).height()) > 660){

        //     jQuery('.flip-container, .back, .front').width(jQuery('.menu').width());

        // }

    });



    jQuery('.fa-bars').on('click', function(){

        jQuery('body').toggleClass('nav-open');

    });



    jQuery('.fa-search').on('click', function(){

        jQuery('.flip-container').toggleClass('active');

    });



    jQuery('#search_text').focus( function(){

        jQuery('#search_form').addClass('active');

    });



    jQuery('#search_text').blur( function(){

        //jQuery('#search_form').removeClass('active');

    });



    jQuery('.search_options input').on( 'mousedown', function(e){

       e.preventDefault(); 

    });



    jQuery('.totop').click(function () {

            jQuery('body,html').animate({

                scrollTop: 0

            }, 800);

            console.log('click');

            return false;

        });

    

    shp = jQuery('.header').position();

    var shptop = shp.top;

    function nh_scroll(){

        sp = parseInt(jQuery(window).scrollTop(), 0);

        var ww = jQuery(window).width();

        if(ww > 667){

            if(sp >= shptop){

                jQuery('.sticky-header').addClass('stuck-header');

                jQuery('.location-chooser').removeClass('showabove');

            }else if(sp <= shptop){

                jQuery('.sticky-header').removeClass('stuck-header');

                jQuery('.location-chooser').addClass('showabove');

            }

        }

    }

    jQuery(window).scroll( function(e){

      nh_scroll();

    });

    

    jQuery(window).load( function(e){

      nh_scroll();

    });



    //agent slider

    jQuery('.agent-details').slick();








    // ranit 29-7-2017

    jQuery(window).on('load',function (argument) {
         jQuery('.management-list li:first-child').addClass('active').siblings().removeClass('active');
          jQuery('.texts').html( jQuery('.management-list li:first-child').find('.profile-description').html());
    })

    jQuery('.management-list li').mouseenter(function(event) {
       jQuery(this).addClass('active').siblings().removeClass('active');
        jQuery('.texts').html(jQuery(this).find('.profile-description').html());

    });



    

});

