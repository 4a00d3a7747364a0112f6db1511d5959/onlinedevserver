$(function() {


    // Golbal Variables
    //==============================

    var c_width = $('#custom_width');
    var c_height = $('#custom_height');
    var user_custom = { w: 8, h: 8 };
    var user_selected = { w: 8, h: 8 };
    var frame_width = 25;
    var custom_option = 'custom';
    var $main_canvas = $('.canvasWrap');
    var canvas_defaults = { w: 440, h: 440, max_w: 580, max_height: 440 };
    $('.canvasWrap').width(canvas_defaults.w);
    $('.canvasWrap').height(canvas_defaults.h);
    var canvas_background = { image: 'http://onlinedevserver.biz/dev/canvassignages/liveeditor/images/small-blue-flower-53407-1920x1200.jpg', text: 'DRAG PHOTO HERE', opacity: .5 }




    // Define the main Canvas
    //==============================

    var main_Editarea = new fabric.Canvas('mainCanvas');



    //default canvas width height
    //==============================

    jQuery(window).on('load', function(argument) {

        jQuery('.loading_img').fadeOut();
        resizeCanvas(user_custom);

    });




    //Adding the background text
    //==============================



    var texts = new fabric.Text(canvas_background.text, {
        fontFamily: 'Open Sans',
        fontSize: 20,
        fontWeight: 'bold',
        left: main_Editarea.width / 2,
        top: main_Editarea.height / 2,
        selectable: false,
        fill: '#4d4d4d'

    });

    main_Editarea.add(texts);



    //Adding the additional Canvases
    //====================================

    jQuery('.canvasWrap .canvas-container')
        .append('<canvas id="topCanvas" class="abs_canvas"></canvas>' +
            '<canvas id="rightCanvas" class="abs_canvas"></canvas>' +
            '<canvas id="bottomCanvas" class="abs_canvas"></canvas>' +
            '<canvas id="leftCanvas" class="abs_canvas"></canvas>'
        );



    resetCanvas();

    function resetCanvas() {

        var top_canvas = document.getElementById('topCanvas');

        var right_canvas = document.getElementById('rightCanvas');

        var bottom_canvas = document.getElementById('bottomCanvas');

        var left_canvas = document.getElementById('leftCanvas');

        top_canvas.width = main_Editarea.width - (frame_width * 2);
        top_canvas.height = frame_width;
        jQuery('#topCanvas').css({ 'left': frame_width + 'px' });



        right_canvas.width = frame_width;
        right_canvas.height = main_Editarea.height - (frame_width * 2);
        jQuery('#rightCanvas').css({ 'right': '0px', 'top': frame_width + 'px' });



        bottom_canvas.width = main_Editarea.width - (frame_width * 2);
        bottom_canvas.height = frame_width;
        jQuery('#bottomCanvas').css({ 'left': frame_width + 'px', 'bottom': '0px' });



        left_canvas.width = frame_width;
        left_canvas.height = main_Editarea.height - (frame_width * 2);
        jQuery('#leftCanvas').css({ 'left': '0px', 'top': frame_width + 'px' });
    }




    //on change input
    //==============================

    $('input[name=selector1]').on('change', function(argument) {

        var user_option = $.trim($('input[name=selector1]:checked').attr('data-w'));
        if (user_option != custom_option) {

        	normal_options();
            user_selected.w = parseInt($.trim($('input[name=selector1]:checked').attr('data-w')));
            user_selected.h = parseInt($.trim($('input[name=selector1]:checked').attr('data-h')));
            user_custom.w = parseInt(user_selected.w);
            user_custom.h = parseInt(user_selected.h);

            resizeCanvas(user_custom);
        } else {
            console.log('custom selected!');
            custom_option_selected();
        }

    });



























































    function resizeCanvas(user_custom) {


        var input = { w: undefined, h: undefined, ratio: undefined };

        var canvas_final = { w: undefined, h: undefined };

        user_selected.w = input.w = parseInt(user_custom.w);

        user_selected.h = input.h = parseInt(user_custom.h);

        if (input.w > input.h) {

            input.ratio = canvas_defaults.max_w / input.w;

            canvas_final.w = canvas_defaults.max_w;

            canvas_final.h = input.h * input.ratio;

            console.log(canvas_final);

            $('.forWidth').text('WIDTH : ' + user_selected.w + ' inch');

            $('.forheight span').text('HEIGHT : ' + user_selected.h + ' inch');

            //_canvas.width = canvas_final.w;

            //_canvas.height = canvas_final.h;

            main_Editarea.setWidth(canvas_final.w);

            main_Editarea.setHeight(canvas_final.h);


            $('.canvasWrap').width(canvas_final.w);

            $('.canvasWrap').height(canvas_final.h);



        } else if (input.h >= input.w) {

            input.ratio = canvas_defaults.max_height / input.h;

            canvas_final.w = input.w * input.ratio;

            canvas_final.h = canvas_defaults.max_height;

            console.log(canvas_final);

            $('.forWidth').text('WIDTH : ' + user_selected.w + ' inch');

            $('.forheight span').text('HEIGHT : ' + user_selected.h + ' inch');

            //_canvas.setwidth = canvas_final.w;

            //_canvas.height = canvas_final.h;

            main_Editarea.setWidth(canvas_final.w);

            main_Editarea.setHeight(canvas_final.h);

            $('.canvasWrap').width(canvas_final.w);

            $('.canvasWrap').height(canvas_final.h);

        }

        make_base();

        resetCanvas();

        center_text();


    }

    // function to set the text center

    function center_text() {
        main_Editarea.centerObject(texts);
    }



    function make_base() {


        center_text();

        fabric.Image.fromURL(canvas_background.image, function(imgs) {

            imgs.setWidth(main_Editarea.width);
            imgs.setHeight(main_Editarea.height);
            main_Editarea.setBackgroundImage(imgs);
            main_Editarea.backgroundImage.opacity = canvas_background.opacity;
            main_Editarea.renderAll();

        });



        function resetCanvas() {

            var top_canvas = document.getElementById('topCanvas');

            var right_canvas = document.getElementById('rightCanvas');

            var bottom_canvas = document.getElementById('bottomCanvas');

            var left_canvas = document.getElementById('leftCanvas');

            top_canvas.width = _canvas.width - (frame_width * 2);
            top_canvas.height = frame_width;
            jQuery('#topCanvas').css({ 'left': frame_width + 'px' });



            right_canvas.width = frame_width;
            right_canvas.height = _canvas.height - (frame_width * 2);
            jQuery('#rightCanvas').css({ 'right': '0px', 'top': frame_width + 'px' });



            bottom_canvas.width = _canvas.width - (frame_width * 2);
            bottom_canvas.height = frame_width;
            jQuery('#bottomCanvas').css({ 'left': frame_width + 'px', 'bottom': '0px' });



            left_canvas.width = frame_width;
            left_canvas.height = _canvas.height - (frame_width * 2);
            jQuery('#leftCanvas').css({ 'left': '0px', 'top': frame_width + 'px' });
        }




    }


    // when custom option selected
   //=============================================

   function custom_option_selected(){

	   	var custom_size_option = jQuery('.custom-size');
	   	custom_size_option.find('select').removeAttr('disabled').removeClass('disable');

   }

   function normal_options() {

   	   	var custom_size_option = jQuery('.custom-size');
   		custom_size_option.find('select').attr('disabled',true).addClass('disable');
   }


});
