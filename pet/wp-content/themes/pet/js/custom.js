//js document 

jQuery(window).load(function(){
  jQuery('ul.sub-menu').addClass('subMenuShow');
});


jQuery(document).ready(function($){




 $('.search a').on('click', function(e){

   //e.preventDefault();
   //alert('ff');
   $('.search_bar_area').toggleClass('expand_search_bar');
   //$(this).css({'opacity':'0'});
   //$('body').removeClass('expand_search_bar');
   e.stopPropagation();

   });

    $(document).on('click', function(e){
    	//alert('gg');
    	//$('.search_bar_area').removeClass('expand_search_bar');
    	if ($(e.target).is(".search_bar_area, .search_bar_area form, .search_bar_area form input") === false){
    		//alert('dsc');
    		 $('.search_bar_area').removeClass('expand_search_bar');
    		 $('.search a').css({'opacity':'1'});
    	}
    });
   
   //hamburger
   $('.hamburger a').on('click', function(){
       
       $('header .middle nav').css({'width':'50%'})

   });
   $('nav .cross').on('click', function(){
       
       $('header .middle nav').css({'width':'0'})
   }); 

  $('nav li.has_child a').on('click',function(e){
  	e.preventDefault();
     
     $(this).siblings('.child').slideToggle(300);
  }); 






});