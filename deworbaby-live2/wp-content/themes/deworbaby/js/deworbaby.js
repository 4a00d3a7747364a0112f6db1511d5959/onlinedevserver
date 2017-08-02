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

    //$('.add_to_cart_button, .single_add_to_cart_button').after(' <a class="poplink" href="#"> (Size Chart & counts)</a>');

    //product gallery slide divs
    /*$("a.woocommerce-main-image .thumbnails").addClass("bxslider");
    $('.thumbnails').bxSlider({
        mode: 'vertical',
        slideMargin: 5,
        minSlides: 4,
        maxSlides: 4,
        moveSlides: 1,
        slideWidth: 110,
        pager: false,
        controls: true,
        nextText: 'Next',
        prevText: 'Prev',
    }); */   



    //calculate number of images for product gallery slider
    /*$('.bxslider').find(function() {
       var x = $('.size-shop_thumbnail', this).length;
       //alert(x);
       if( x <= 3 ){
        $( ".bx-controls" ).hide();
       }
    });*/



    //instagram image feed starts
    /*var token = '1362124742.3ad74ca.6df307b8ac184c2d830f6bd7c2ac5644',
    num_photos = 20; 

    jQuery.ajax({
        url: 'https://api.instagram.com/v1/users/self/media/recent',
        dataType: 'jsonp',
        type: 'GET',
        data: {access_token: token, count: num_photos},

        success: function(data){
            //console.log(data);
            for( x in data.data ){
                jQuery('ul#sb_custom_instafeeds').append('<li><img src="'+data.data[x].images.low_resolution.url+'"></li>');
            }
        },
        error: function(data){
            //console.log(data);
        }
    });*/
    //instagram image feed ends


    /*$("#sb_custom_instafeeds").addClass("bxslider");
    $('.bxslider').bxSlider({
        slideMargin: 2,
        minSlides: 5,
        maxSlides: 5,
        moveSlides: 1,
        slideWidth: 200,
        pager: false,
        controls: true,
        nextText: 'Next',
        prevText: 'Prev',
    });*/

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

    //adding attribute to continue button in checkout page
    jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');

    //stop auto complete an input field
    jQuery('input').attr('autocomplete', 'off');

    //change type for zip and phone
    jQuery("#billing_phone").prop("type", "tel");
    jQuery("#billing_postcode").prop("type", "tel");
    jQuery("#billing_phone").attr("maxlength", "10");
    jQuery("#billing_postcode").attr("maxlength", "6");


    //validation error msg in checkout page
    //var totalF = jQuery('p.validate-required').length;
    //var hasVal = 0;
    //console.log('outter'+hasVal);
    jQuery(document).on('click','.phoen_checkout_butt_next', function (argument) {        
        if(jQuery('#pmsc_2').is(':visible')){
            console.log('second step visibled !!!');
            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');


                if(jQuery('#shipping_first_name').val() != ''){
                    if(jQuery('#shipping_last_name').val() != ''){
                        if(jQuery('#shipping_country').val() != ''){
                            if(jQuery('#shipping_address_1').val() != ''){
                                if(jQuery('#shipping_city').val() != ''){
                                    if(jQuery('#shipping_state').val() != ''){
                                        if(jQuery('#shipping_postcode').val() != ''){
                                            jQuery('.phoen_checkout_butt_next').removeAttr("disabled");
                                            jQuery('.phoen_checkout_butt_next').removeClass('btnDisabled');
                                        }else{
                                            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                                        }
                                    }else{
                                        jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                                    }
                                }else{
                                    jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                                }
                            }else{
                                jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                            }
                        }else{
                            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                        }
                    }else{
                        jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                    }
                }else{
                    jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                }

        }else{
            jQuery('.phoen_checkout_butt_next').removeAttr("disabled");
            jQuery('.phoen_checkout_butt_next').removeClass('btnDisabled');
        }
    });

    jQuery(document).on('click','.phoen_checkout_button_prev',function (argument) {
        if(jQuery('#pmsc_2').is(':visible')){
            console.log('second step visibled !!!');
            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                if(jQuery('#shipping_first_name').val() != ''){
        if(jQuery('#shipping_last_name').val() != ''){
            if(jQuery('#shipping_country').val() != ''){
                if(jQuery('#shipping_address_1').val() != ''){
                    if(jQuery('#shipping_city').val() != ''){
                        if(jQuery('#shipping_state').val() != ''){
                            if(jQuery('#shipping_postcode').val() != ''){
                                jQuery('.phoen_checkout_butt_next').removeAttr("disabled");
                                jQuery('.phoen_checkout_butt_next').removeClass('btnDisabled');
                            }else{
                                jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                            }
                        }else{
                            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                        }
                    }else{
                        jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                    }
                }else{
                    jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                }
            }else{
                jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
            }
        }else{
            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
        }
    }else{
        jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
    }
        }else{
            jQuery('.phoen_checkout_butt_next').removeAttr("disabled");
            jQuery('.phoen_checkout_butt_next').removeClass('btnDisabled');
        }
        jQuery('#ship-to-different-address-checkbox').attr('checked','true').removeClass('clicked');
        jQuery('#pmsc_2 .shipping_address').css({'display':'block'});
    });

    jQuery('p.validate-required').each(function(){
        jQuery(this).find('input').attr('required',true);
    });

    jQuery(document).on('click','#ship-to-different-address-checkbox',function () {
        if(jQuery(this).hasClass('clicked')== true){
            jQuery(this).attr('checked','true');
            jQuery(this).removeClass('clicked');
            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
        }else{
            jQuery(this).addClass('clicked').removeAttr('checked');
            jQuery('.phoen_checkout_butt_next').removeAttr("disabled");
            jQuery('.phoen_checkout_butt_next').removeClass('btnDisabled');
        }
       
    });



    

    jQuery('p.validate-required').each(function(){
        jQuery(this).append('<span class="err-msg" style="display:none;">Please complete the required field</span>');
    });

    jQuery('#billing_phone_field .err-msg').text('Please Enter Valid Phone numbers');


    jQuery('#billing_first_name').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });

    jQuery('#billing_last_name').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });   

    jQuery('#billing_email').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });

   jQuery('#billing_phone').focusout(function(event) {
    jQuery(this).parent().find('.err-msg').text('Please enter a valid phone number');
        if(jQuery(this).val() != ''){     
            jQuery(this).parent().find('.err-msg').hide();
            if (isNaN(jQuery(this).val())){
                    alert('Please Enter Valid Phone numbers');  
                    jQuery(this).val('');
                    jQuery(this).focus();                           
                }else{                       
                       
                }  
            }else{
                jQuery(this).parent().find('.err-msg').show();
            }
   });

    jQuery('#billing_address_1').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });

   jQuery('#billing_city').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });

   jQuery('#billing_state').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });

   jQuery('#billing_postcode').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });


   //shipping

    jQuery('#shipping_first_name').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   });

    jQuery('#shipping_last_name').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   }); 

    jQuery('#shipping_country').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   }); 
jQuery('#shipping_address_1').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   }); 
jQuery('#shipping_city').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   }); 
jQuery('#shipping_state').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   }); 
jQuery('#shipping_postcode').focusout(function(event) {
       /* Act on the event */
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).parent().find('.err-msg').show();
       }else{
            jQuery(this).next().focus();
            jQuery(this).parent().find('.err-msg').hide();
       }
   }); 


 jQuery(document).on('keyup','#pmsc_2 input',function(){
    if(jQuery('#shipping_first_name').val() != ''){
        if(jQuery('#shipping_last_name').val() != ''){
            if(jQuery('#shipping_country').val() != ''){
                if(jQuery('#shipping_address_1').val() != ''){
                    if(jQuery('#shipping_city').val() != ''){
                        if(jQuery('#shipping_state').val() != ''){
                            if(jQuery('#shipping_postcode').val() != ''){
                                jQuery('.phoen_checkout_butt_next').removeAttr("disabled");
                                jQuery('.phoen_checkout_butt_next').removeClass('btnDisabled');
                            }else{
                                jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                            }
                        }else{
                            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                        }
                    }else{
                        jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                    }
                }else{
                    jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
                }
            }else{
                jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
            }
        }else{
            jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
        }
    }else{
        jQuery('.phoen_checkout_butt_next').prop("disabled",true).addClass('btnDisabled');
    }

 });
    
    



   jQuery(document).on('keyup','#pmsc_1  input',function(){

    if(jQuery('#billing_first_name').val() != ''){
        if(jQuery('#billing_last_name').val() != ''){
            if(jQuery('#billing_email').val() != ''){
                if(jQuery('#billing_phone').val() != ''){
                    if(jQuery('#billing_address_1').val() != ''){                    
                        if(jQuery('#billing_city').val() != ''){                                
                            if(jQuery('#billing_state').val() != ''){                                
                                if(jQuery('#billing_postcode').val() != ''){                                                                   
                                    jQuery("button.phoen_checkout_butt_next").removeAttr("disabled").removeClass('btnDisabled');
                                 }else{
                                    jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                                 }
                            }else{
                                jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                             }
                        }else{
                            jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                         }
                    }else{
                        jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                     }
                }else{
                    jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                 }
            }else{
                jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
             }
        }else{
            jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
         }
    }else{
        jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
     }

    });


   //jQuery('.login .wc-social-login').css('display','none');


   // jQuery('#billing_first_name').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });
   // jQuery('#billing_last_name').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });
   // jQuery('#billing_email').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });
   // jQuery('#billing_phone').focusout(function(event) {
   //  jQuery(this).parent().find('.err-msg').text('Please Enter Valid Phone numbers');
   //      if(jQuery(this).val() != ''){     

   //          if (isNaN(jQuery(this).val())){
   //                  alert('Please Enter Valid Phone numbers');  
   //                  jQuery(this).val('');
   //                  jQuery(this).focus();
   //                     // jQuery(this).parent().find('.err-msg').show();                
   //              }else{                       
   //                      //jQuery(this).parent().find('.err-msg').hide();
   //              }  
   //          }else{
   //              jQuery(this).parent().find('.err-msg').show();
   //          }
   // });

   //  jQuery('#billing_address_1').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });
   // jQuery('#billing_city').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });
   // jQuery('#billing_state').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });
   // jQuery('#billing_postcode').focusout(function(event) {
   //     /* Act on the event */
   //     if(jQuery(this).val() == ''){
   //          jQuery(this).focus();
   //          jQuery(this).parent().find('.err-msg').show();
   //     }else{
   //          jQuery(this).next().focus();
   //          jQuery(this).parent().find('.err-msg').hide();
   //     }
   // });


    

});


jQuery(window).on('load',function () {     

    if(jQuery('#billing_first_name').val() != ''){
        if(jQuery('#billing_last_name').val() != ''){
            if(jQuery('#billing_email').val() != ''){
                if(jQuery('#billing_phone').val() != ''){
                    if(jQuery('#billing_address_1').val() != ''){                    
                        if(jQuery('#billing_city').val() != ''){                                
                            if(jQuery('#billing_state').val() != ''){                                
                                if(jQuery('#billing_postcode').val() != ''){                                                                   
                                    jQuery("button.phoen_checkout_butt_next").removeAttr("disabled").removeClass('btnDisabled');
                                 }else{
                                    jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                                 }
                            }else{
                                jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                             }
                        }else{
                            jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                         }
                    }else{
                        jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                     }
                }else{
                    jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
                 }
            }else{
                jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
             }
        }else{
            jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
         }
    }else{
        jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
     }
});







// ranit 20-3-2017

//jQuery('form#subscribe_step_1 input').attr('required','true');

//   jQuery(document).on('mousemove', function(){

// if(jQuery("input[name=additional_field_499]").val() != ''){
//   if(jQuery("input[name=additional_field_128]").val() != ''){
//     if(jQuery("input[name=additional_field_655]").val() != ''){
//       if(jQuery("input[name=additional_field_694]").val() != ''){
//         if(jQuery("input[name=additional_field_912]").val() != ''){
//           if(jQuery("input[name=additional_field_187]").val() != ''){
//            // alert();
//           }
//         }
//       }
//     }
//   }
// }


// });


