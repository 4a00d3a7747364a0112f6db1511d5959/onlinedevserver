jQuery(document).ready(function(){
jQuery("#flexiselDemo3").flexisel({
        visibleItems: 2,
        itemsToScroll: 1,
        autoPlay: {
            enable: true,
            interval: 5000,
            pauseOnHover: true
        }      
    });

jQuery("#navds").appendTo("#menu-header-menu");
    jQuery('.post-type-archive-product').addClass('page_subscribe'); //shop page
    jQuery('.page-id-87').addClass('page_subscribe'); //privacy policy page
    jQuery('.page-id-85').addClass('page_subscribe'); //faq page
    jQuery('.page-id-156').addClass('page_subscribe'); //wholesale page
    jQuery('.page-id-194').addClass('page_subscribe'); //subscribe page
    jQuery('.page-id-9').addClass('page_subscribe'); //learn page
    jQuery('.page-id-827').addClass('page_subscribe'); //free trial page

   

    //swaping woocommerce registration fields
    var copy_email = jQuery("p.confirm-email").clone();
    jQuery(copy_email).insertBefore("p.set-pwd");
    jQuery('.register p').eq(5).remove();

    //re-locate facebook and google login in wp registration/login
    var clone_social = jQuery(".wc-social-login").html();
    jQuery(clone_social).insertBefore("p.or").addClass('dodo');
    jQuery('.socials-list:not(.dodo)').parent().remove();
    jQuery('.socials-list:not(.dodo)').remove(); //wc-social-login

    //changing google plus to google
    jQuery("a.ywsl-google").html("Google");

   
    jQuery('input').attr('autocomplete', 'off');

    //change type for zip and phone
    jQuery("#billing_phone").prop("type", "tel");
    jQuery("#billing_postcode").prop("type", "tel");
    jQuery("#billing_phone").attr("maxlength", "10");
    jQuery("#billing_postcode").attr("maxlength", "6");



//ranit code 25/04/2017



     jQuery('#pmsc_3').find('input[type=tel]').attr('type','number');
     jQuery('#pmsc_1').find('input[type=tel]').attr('type','number');
     jQuery('#pmsc_2').find('#shipping_postcode').attr('type','number');
     jQuery('#pmsc_3').find('input[type=tel]').css({'css':'text-indent: 20px;'});
     jQuery('#pmsc_1').find('input[type=tel]').css({'css':'text-indent: 20px;'});

     jQuery('#pmsc_3').find('input[type=number]').eq(0).keyup(function (argument) {
         if (this.value.length > 10) {
            this.value = this.value.slice(0,10); 
        }
     });
     jQuery('#pmsc_3').find('input[type=number]').eq(1).keyup(function (argument) {
         if (this.value.length > 5) {
            this.value = this.value.slice(0,5); 
        }
     });

     jQuery('#pmsc_1').find('input[type=number]').eq(0).keyup(function (argument) {
         if (this.value.length > 10) {
            this.value = this.value.slice(0,10); 
        }
     });
     jQuery('#pmsc_1').find('input[type=number]').eq(1).keyup(function (argument) {
         if (this.value.length > 5) {
            this.value = this.value.slice(0,5); 
        }
     });
     jQuery('#pmsc_2').find('input[type=number]').keyup(function (argument) {
         if (this.value.length > 5) {
            this.value = this.value.slice(0,5); 
        }
     });


     jQuery(document).on('mousemove',function () {

       

        if(jQuery('#pmsc_1').is(':visible')){

             if(jQuery('#pmsc_1 .validate-required:not(.subscription_step_1)').find('input[type=number]').eq(0).val().length < 10){
               
                jQuery('#pmsc_1').find('input[type=number]').eq(0).css({'border':'2px solid red'});
                //jQuery('#pmsc_1').find('input[type=number]').eq(0).focus();
                jQuery('button.phoen_checkout_butt_next').attr('disabled',true);
                jQuery('button.phoen_checkout_butt_next').addClass('btnDisabled');
            }
        }
           
        if(jQuery('#pmsc_3').is(':visible')){

             if(jQuery('#pmsc_3').find('input[type=number]').eq(0).val().length < 10){
                //jQuery('#pmsc_3').find('input[type=number]').eq(0).val('');
                jQuery('#pmsc_3').find('input[type=number]').eq(0).css({'border':'2px solid red'});
                //jQuery('#pmsc_3').find('input[type=number]').eq(0).focus();
                jQuery('button.phoen_checkout_butt_next').attr('disabled',true);
                jQuery('button.phoen_checkout_butt_next').addClass('btnDisabled');
            }
        }
            
     });
      jQuery(document).on('mousemove',function () {

         if(jQuery('#pmsc_3').is(':visible')){ // if the tab 3 is visible

            if(jQuery('#pmsc_3').find('input[type=number]').eq(1).val().length < 5){               
               
                jQuery('#pmsc_3').find('input[type=number]').eq(1).css({'border':'2px solid red'});
                //jQuery('#pmsc_3').find('input[type=number]').eq(1).focus();
                jQuery('button.phoen_checkout_butt_next').attr('disabled',true);
                jQuery('button.phoen_checkout_butt_next').addClass('btnDisabled');
            }
        }
         if(jQuery('#pmsc_1').is(':visible')){ // if the tab 1 is visible
            if(jQuery('#pmsc_1').find('input[type=number]').eq(1).val().length < 5){

                jQuery('#pmsc_1').find('input[type=number]').eq(1).css({'border':'2px solid red'});
                //jQuery('#pmsc_1').find('input[type=number]').eq(1).focus();
                jQuery('button.phoen_checkout_butt_next').attr('disabled',true);
                jQuery('button.phoen_checkout_butt_next').addClass('btnDisabled');
            }
        }

        // if(jQuery('#pmsc_2').is(':visible')){ // if the tab 1 is visible
        //     if(jQuery('#pmsc_2').find('input[type=number]').val().length < 5){

        //         jQuery('#pmsc_2').find('input[type=number]').css({'border':'2px solid red'});
        //         //jQuery('#pmsc_2').find('input[type=number]').focus();
        //         jQuery('button.phoen_checkout_butt_next').attr('disabled',true);
        //         jQuery('button.phoen_checkout_butt_next').addClass('btnDisabled');
        //     }
        // }

       //    if(jQuery(this).val() == 0){
       //      jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
       // }else{
       //     jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
       // }
       


     });



 
     

      jQuery('.phoen_checkout_butt_next').on('click', function()
        { 
            pmsc_div_show = jQuery('.pmsc_tabs').find('li.selected').attr('data-step');
            
            if(pmsc_div_show == 1){


                jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
            }
        });

      


jQuery('p.not_check').eq(1).removeClass('not_check');



function require_validate_sc(tgh)
        {
            
            jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
            console.log(tgh);
            jQuery(tgh).find('.validate-required').each(function() {
               
                var input_val = jQuery(this).find('input').val();
                jQuery(this).find('#s2id_billing_state').remove();
                jQuery(this).find('select').css({'display':'block'});
                    
                if(input_val =="")
                {
                    var email_val = 0;
                    jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                    jQuery(this).find('input').css({"border": "2px solid red"});
                    
                
                    if(jQuery(this).find('.error-text').length == 0) 
                    {
                        jQuery(this).find('input').after('<span class="error-text">This is required field</span>');
                        
                    }
                    else
                    {
                        jQuery(this).find('.error-text').show();
                    }
                }
                else
                {
                    
                    var type = jQuery(this).find('input').attr('type');
                    
                    /*Check if email is validated*/
                        
                    if(type =="email")
                    {
                        function ValidateEmail(email) 
                        {
                            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                            return expr.test(email);
                        };
                        
                        if (!ValidateEmail(input_val)) 
                        {
                            
                                    if(jQuery.find('.error-emai').length == 0) 
                                    {
                                        jQuery(this).after('<span class="error-emai">Email is not valid</span>');

                                    }
                                    else
                                    {
                                        jQuery('.error-emai').show();
                                    }
                            console.log("Invalid email address.");
                            email_val = 1;
                            jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                        }
                        else 
                        {
                            jQuery('.error-emai').hide();
                            console.log("Valid email address.");
                            email_val =0;
                        }
                    }
                    
                    
                    //.alert(jQuery(this).find('.error-text').length);
                    if(jQuery(this).find('.error-text').length != 0) 
                    {
                        jQuery(this).find('.error-text').hide();
                        
                    }
                    
                    jQuery(this).find('input').css({"border": "1px solid #e5e4e4"});
                    //jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
                }
                 
             });
        }

        jQuery('#pmsc_1').find('.validate-required').find('input').on('keyup', function(){ var tgh = "#pmsc_1";require_validate_sc(tgh); });
        jQuery('#pmsc_2').find('.validate-required').find('input').on('keyup', function(){ var tgh = "#pmsc_2";require_validate_sc(tgh); });


        // positioning the err-emai message for different methods
        jQuery(document).on('keyup',function (argument) {          
            jQuery('.validate-required').each(function (argument) {
               if(jQuery(this).hasClass('validate-email') == true){
                console.log(jQuery(this).index());
                if(jQuery(this).index() == 5){
                    jQuery('.error-emai').css({'top':'39%'});
                }else if(jQuery(this).index() == 3){
                    jQuery('.error-emai').css({'top':'34%'});
                }else if(jQuery(this).index() == 1){
                    jQuery('.error-emai').css({'top':'24%'});
                }
               }
            });
        });
        

       jQuery('#ship-to-different-address input').on('click',function () {    
      
          var hiddenField = jQuery('#ship-to-different-address input'),
            val = hiddenField.val();

            hiddenField.val(val === '1' ? '0' : '1');
           if(jQuery(this).val() == 0){
                jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
           }else{
               jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
           }
    });

       // if(jQuery('#ship-to-different-address input').val() == 0){
       //  jQuery(document).on('mousemove',function () {
       //      jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
       //  });
       // }



       jQuery('.phoen_checkout_button_prev').on('click',function () {
           console.log(jQuery(this).parent().prev().find('> div:visible').attr('id'));
       })

    
});





   