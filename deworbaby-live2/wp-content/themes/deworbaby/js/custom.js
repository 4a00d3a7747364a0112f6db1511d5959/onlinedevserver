jQuery(document).ready(function(){

// label wrapper
//alert();
//jQuery('.input_field').wrap('<label></label>');
//jQuery( ".input_field" ).wrap(function() {
	//alert();
  //return "<label></label>";
//});

	//017 -3 -2017

	if(jQuery(window).width() < 1150){

		jQuery('.popbox').each(function (argument) {
			jQuery(this).find('.content').append('<div class="closeContent"><i class="fa fa-times"></i></div>');
		});		
	}
	// if(jQuery(window).width() < 481){

	// 	jQuery('.popbox').each(function (argument) {
	// 		jQuery(this).find('.content').width(jQuery(window).width());
	// 	});				
	// }

	jQuery(document).on('click','.closeContent',function (argument) {
		jQuery(this).parent().removeClass('showHide');
	});

//subscription page scroll
if (jQuery('.sub_sec_3.plans').length){
var subPlanOffset = jQuery('.sub_sec_3.plans').offset().top;
	jQuery('.page_subscribe .show_now.banner_text').on('click', function(){
	//alert();
 
  jQuery('html, body').animate({
     	scrollTop:(subPlanOffset + 'px')
     },800);
   
});

}


/* ***************** responsive nav ******************* */

jQuery('a.bars').on('click', function(e){
	e.preventDefault();
	var winWidth=jQuery(window).width();
    jQuery('nav').addClass('responsive');
    jQuery('#main_header .right_part ul:nth-of-type(2)').css({'position':'inherit'});
    

});
jQuery('.close').on('click', function(){
	//alert();
	jQuery('nav').removeClass('responsive');
	jQuery('#main_header .right_part ul:nth-of-type(2)').css({'position':'relative'});
});

// 15 -3 - 2017
	jQuery(document).on('click','.pro_left_box',function(){
		//alert($(this).html());
		jQuery(this).addClass('active').parent().siblings().find('a').removeClass('active');
		jQuery('.nature_bamboo .tab h4').text(jQuery(this).find('.text').text());
		jQuery('.nature_bamboo .tab p').text(jQuery(this).find('.desc').text());
	});

	jQuery(document).on('click','.popbox',function(){
		jQuery(this).find('.content').toggleClass('showHide').parent().siblings().find('.content').removeClass('showHide');
	});

	

  // Search field  
jQuery('li .search').on('click', function(e){
	e.preventDefault();
	//alert();
	//$('.search_field').css({'transform':'scale(1,1)', 'transition':'ease-in .3s all'});
	jQuery('.search_field').addClass('zoom');
});
jQuery(document).on('click','.cross', function(event){
 // event.preventDefault();
  //$('.search_field').css({'transform':'scale(0,0)', 'transition':'ease-in .3s all'});
    jQuery('.search_field').removeClass('zoom');
});

	jQuery('.ywsl-social.ywsl-facebook').text('Facebook'); //ywsl-social ywsl-google

	jQuery('.ywsl-social.ywsl-google').text('Google Plus');


	jQuery('.login.ywsl-box a').each(function() {
		jQuery(this).wrap('<li></li>');
	});
	jQuery('.ywsl-social ywsl-facebook').wrap('<li></li>');


	jQuery('.login.ywsl-box li').wrapAll('<ul class="social_btn"></ul>');
	jQuery('.login.ywsl-box ul').wrapAll('<div class="social_btn"></div>');

	var winWidth = jQuery(window).width();



	jQuery.fn.__mainBody(winWidth);	

	jQuery('#sub_sec_2 .description').height(jQuery('.sub_sec_2 .contentArea').height());

	jQuery('.sub_sec_3 .description').height(jQuery('.sub_sec_3').height());

	jQuery('.subscrib_now').bind('click',function(){ jQuery.fn.__goForSubs(); });


    var navObj=jQuery('.navigation');
    if(!navObj.length){
    	return;
    }
    var navPos=navObj.offset().top;
   // console.log(navPos);
	var nav_height = jQuery('.navigation').height();

jQuery('.navigation ul li a').on('click', function(){
    var ids=jQuery(this).attr('href');
       jQuery('html, body').animate({
     	scrollTop:((jQuery(ids).offset().top) - (nav_height +90))
     },800);

  });

jQuery(window).scroll(function(){
        var winPos=jQuery(window).scrollTop();
	if(winPos>=navPos){

		jQuery('.navigation').addClass('fixed');	

		//jQuery('.navigation').css({'position':'relative','top': (winPos-navPos)+'px','z-index':'99'})

	}else{

	jQuery('.navigation').removeClass('fixed');	

	}
	
});

//jQuery('.woocommerce form.login.ywsl-box .ywsl-social.ywsl-facebook').text('FACEBOOK');
   jQuery('.woocommerce form.login.ywsl-box .ywsl-social').on('click',function(){
   	alert();
   });





});

jQuery(document).on('click','.close', function(){

	jQuery.fn.__closeMenu();

});

jQuery.fn.__mainBody = function(e){

	jQuery('.responsiveMenu').bind('click', function(){

		jQuery.fn.__toggleMenu();

	});

	var totalL = jQuery('nav ul#menu-header-menu li').length;
	for(i=0;i<totalL;i++){
		jQuery('nav ul#menu-header-menu li').eq(i).addClass('listNo_'+i);
	}

	if(e<= 768){

		jQuery('<div class="close"><i class="fa fa-times"></i></div>')

		.appendTo('nav ul.menu-header-menu');	

	}	




}
jQuery(document).on('click','.logged-in li#navds > a',function (e) {
		e.preventDefault();
		jQuery(this).parent().find('ul').slideToggle();
})

// jQuery.fn.__closeMenu = function(){

// 	jQuery('nav ul').fadeOut();

// }



jQuery.fn.__toggleMenu = function(){

	jQuery('nav ul').fadeToggle();

}

jQuery.fn.__goForSubs = function(){

	

	 jQuery("html, body").animate({ scrollTop: jQuery('.signIn').offset().top }, 600);

	//jQuery(window).scrollTop();

}






