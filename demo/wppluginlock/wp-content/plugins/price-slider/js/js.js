jQuery(document).ready(function() {
   /* Example 6 */   
   
 /*  var percentage =  jQuery("#pricecommission").val();
    //var fixprice=395;
	var price      =jQuery("#price").val();	
	var fixprice=jQuery("#fixedprice").text();*/
	//alert(fixprice);
				jQuery("#priceSliderVal").text(commaSeparateNumber(price));				
				jQuery("#pricesave").text(commaSeparateNumber(priceCalcSave(percentage,fixprice,price)));	
				
   
			jQuery("#price").slider();
			jQuery("#pricecommission").slider();
				jQuery("#pricecommission").on('slide', function(slideComi) {
				 var percentage = slideComi.value;
				 var fixprice=jQuery("#fixedprice").text();
				 var price      = jQuery("#price").val();				 
				jQuery("#priceSliderVal").text(commaSeparateNumber(price));				
				jQuery("#pricesave").text(commaSeparateNumber(priceCalcSave(percentage,fixprice,price)));					
				});
			jQuery("#price").on('slide', function(slideEvt) {
				 var percentage = jQuery("#pricecommission").val();	
				 var fixprice=jQuery("#fixedprice").text();
				 var price      = slideEvt.value;				 
				jQuery("#priceSliderVal").text(commaSeparateNumber(price));				
				jQuery("#pricesave").text(commaSeparateNumber(priceCalcSave(percentage,fixprice,price)));	
				});		
				
				
				
				jQuery('#increase').on('click',function() {
				var sliderstap=10000;
var sliderCurrentValue =jQuery("#price").val();
var newprice=parseFloat(sliderCurrentValue)+sliderstap;
jQuery( "#price" ).val(newprice);
var percentage = jQuery("#pricecommission").val();	
var fixprice=jQuery("#fixedprice").text();
var price      =newprice;				 
jQuery("#priceSliderVal").text(commaSeparateNumber(price));				
jQuery("#pricesave").text(commaSeparateNumber(priceCalcSave(percentage,fixprice,price)));	
});

jQuery('#decrease').on('click',function() {
		var sliderstap=10000;
	var sliderCurrentValue =jQuery("#price").val();
var newprice=parseFloat(sliderCurrentValue)-10000;
jQuery( "#price" ).val(newprice);
var percentage = jQuery("#pricecommission").val();	
var fixprice=jQuery("#fixedprice").text();
var price      =newprice;				 
jQuery("#priceSliderVal").text(commaSeparateNumber(price));				
jQuery("#pricesave").text(commaSeparateNumber(priceCalcSave(percentage,fixprice,price)));	

});
		
			});
			
			
			function priceCalcSave(percentage,fixprice,price){	
					 
				 var calcPrice  = ( price * percentage / 100 );
				 var pricesave=(calcPrice-fixprice);
					if(pricesave<0){
						pricesave=0;
					}
				return pricesave;
				}
			
function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
