<?php

					if(!is_user_logged_in()):$pmsc_no_login = "class='selected'";
					else:$pmsc_login = "none";$pmsc_select_div = "class='selected'";
					endif;?>	
					<ul class="pmsc_tabs subscribe_list">
					<li style="display:none;" <?php echo (isset($pmsc_no_login) && !empty($pmsc_no_login))?$pmsc_no_login:'';?> data-step="0"> <a href="javascript:void(0);"><?php _e( 'Login', 'multi-step-ckeckout-for-woocommerce' ); ?></a></li>
					
					<li  id="cus-1" <?php echo (isset($pmsc_select_div) && !empty($pmsc_select_div))?$pmsc_select_div:''; ?> data-step='1'><a href="javascript:void(0);"><?php _e( '1', 'multi-step-ckeckout-for-woocommerce' ); ?></a></li>
					
					<li  id="cus-2" data-step='2'><a href="javascript:void(0);"><?php _e( '2', 'multi-step-ckeckout-for-woocommerce' ); ?></a></li>
						
					<li  id="cus-3"  data-step='3'><a href="javascript:void(0);"><?php _e( '3', 'multi-step-ckeckout-for-woocommerce' ); ?></a></li>
							
					<!--<li   id="cus-4"  data-step='4'><?php /* _e( 'Order Info', 'multi-step-ckeckout-for-woocommerce' ); */ ?></li> -->
					
					<li   id="cus-4" data-step='4'><a href="javascript:void(0);"><?php _e( '4', 'multi-step-ckeckout-for-woocommerce' ); ?></a></li>

				</ul>
				</div>
				<div class="login_form" id="pmsc_0">
						
					<?php 
						
						do_action('phoen_before_checkout_login_form');
					?>
				
				</div>
	
	<?php
	
		if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
			return;
		}
		
		?>
			
		<div class="pmsc_coupan_form" style="display:none;"> 			
			<?php do_action('phoen_before_checkout_coupan_form');?>		
		</div>

		<form name="checkout" id="subscribe_step_1" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">			
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>			
				<div class="col-1_billing ui-tabs-panel" id='pmsc_1' style="display:none">					
					<div class="cls-pmsc" style="display:none"></div>
					<script>
						jQuery('.cls-pmsc').html();
						jQuery('.cls-pmsc').html(1);
					</script>
					<?php				   
					do_action( 'woocommerce_before_checkout_shipping_form' );
					do_action( 'woocommerce_checkout_shipping' );
					do_action( 'woocommerce_checkout_after_customer_details' );				   
				   ?>			   
				</div>				
				<div class="col-1_billing ui-tabs-panel" id='pmsc_2' style="display:none">									
					<script>
						jQuery('.cls-pmsc').html();
						jQuery('.cls-pmsc').html(2);
					</script>
					<?php				   
				do_action( 'woocommerce_before_checkout_shipping_form' );
				do_action( 'woocommerce_checkout_shipping' );
				do_action( 'woocommerce_checkout_after_customer_details' );				   
				    ?>			   
				</div>
				<div class="col-2_shipping ui-tabs-panel ui-tabs-hide" id="pmsc_3" style="display:none">					
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<?php endif; ?>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
			    <?php /*<div id="pmsc_4" class="woocommerce-checkout-review-order" style="display:none">				   
				   <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>				   
				    <div class="coupan_form">						
						<?php do_action( 'phoen_checkout_order_review' ); ?>
					</div>
					<input type="checkbox" name="payment_method" value="" data-order_button_text="" style="display: none;" />
				</div>	
					*/ ?>				
				<div class="ui-tabs-panel ui-tabs-hide " id="pmsc_4" style="display:none">					
					<h3 id="phoen_order_review_heading"><?php _e( 'Payment Info', 'woocommerce' ); ?></h3>					
					<?php do_action( 'phoen_checkout_order_payment' ); ?>										
				</div>			 
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</form>
		
		<div class="btn-wrapper">
			<button name="prev" style="display:none" class="phoen_checkout_button_prev"><?php _e( 'Previous', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
			<button name="next" class="phoen_checkout_butt_next"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
<!--
			<button name="next" class="phoen_checkout_butt_next2" style="background: #41476d none repeat scroll 0 0 !important;
    border-radius: 3px;
    box-shadow: none;
    color: #fff;
    cursor: pointer;
    font-size: 1.25em;
    margin-bottom: 1em;
    margin-top: 1em;
    padding: 1em;
    text-align: center;
    text-shadow: none;"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
-->
		</div>
		<div class="select_size" style="display:none"></div>
		<div class="delivary_opt" style="display:none"></div>
		<style>
			.woocommerce-shipping-fields h3 {
				display: none;
			}
			#order_comments_field {
				display: none;
			}
			 .woocommerce form .dateofbirth {

    width: 33.3% !important;

       float: left !important;

       vertical-align: bottom !important;

       float: inherit !important;

       display: inline-block !important;

 }
   .select2-results-dept-0.select2-result.select2-result-selectable {
    text-transform: capitalize;
   }
		</style>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
		 </div>
		</div>
		</div>
        <script>
   	jQuery(document).ready(function()
   	{


		  










		//jQuery(this).html(jQuery(this).html().replace(/&nbsp;/gi,''));
		
		jQuery('#additional_field_801_field').html().replace(/&nbsp;/gi,'');
		//alert(jQuery('#additional_field_801_field').html());
		
		
		jQuery('#additional_field_801_field').html(jQuery('#additional_field_801_field').html().replace(/&nbsp;/g, ''));
		/*OnClick Function Related to the Next Button to get the current step number*/
		
		jQuery('.phoen_checkout_butt_next').on('click', function()
		{ 
			
			/*Get the previous tab number*/
			
			pmsc_div_show = jQuery('.pmsc_tabs').find('li.selected').attr('data-step');
			
			/*For Step 2*/

			if(pmsc_div_show == 1)
			{
				checkvalidate();

				
				var is_text = jQuery('.form-row.form-row-wide.subscription_step_2.size').next().text();

				jQuery('#additional_field_231_field input').on('click',function(){
										
					jQuery('.select_size').html('1');
					checkvalidate();
				});

				jQuery('#additional_field_718_field input').on('click',function(){
					//alert();
					jQuery('.delivary_opt').html('1');
					checkvalidate();
				});

				function checkvalidate(){	

					jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
						var slc_size = jQuery('.select_size').html();
						var dlc_opt = jQuery('.delivary_opt').html();

						/*if(slc_size =="1" && dlc_opt =="1")
							{
								jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
							}
							else
							{
								//jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
							}*/

						
					if(is_text){
							if(slc_size =="1" && dlc_opt =="1")
							{
								jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
							}							

					}else{
						if(slc_size =="1")
							{
								jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
							}
							
					}
				
					
				}
				
				
			}		
			
			
			/*For Step 3*/
			
			if(pmsc_div_show == 2)
			{
				
				jQuery( '#pmsc_3  input').each(function( e ) 
				{
						var cc=jQuery(this).val();
						if(cc=='')
						{
							jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
						}
						else
						{
							
							var type = jQuery(this).attr('type');
					
							/*Check if email is validated*/
								
							if(type =="email")
							{
								function ValidateEmail(email) 
								{
									var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
									return expr.test(email);
								};
								
								if (!ValidateEmail(cc)) 
								{
									if(jQuery(this).find('.error-emai').length == 0) 
									{
										jQuery(this).find('input').after('<span class="error-emai">Email is not valid</span>');

									}
									else
									{
										jQuery(this).find('.error-text').show();
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
							
							
							//jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
						}
					});
				
				
				
					
			}
		});
		
	   /*On Key Press Function*/		
			
		function require_validate_sc(tgh)
		{
			
			jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
			console.log(tgh);
			jQuery(tgh).find('.validate-required').each(function() {
				
				var input_val = jQuery(this).find('input').val();
					
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
		jQuery('#pmsc_3').find('.validate-required').find('input').on('keyup', function(){ var tgh = "#pmsc_3";require_validate_sc(tgh); });
		jQuery('#pmsc_4').find('.validate-required').find('input').on('keyup', function(){ var tgh = "#pmsc_1";require_validate_sc(tgh); });
		
		
	
			
		

		//jQuery('.gender input:nth-child(2)').after('<span class="input_field current_gender"></span>');
		//~ jQuery('.gender input[type=radio]:not(:first)').after('<span class="input_field current_gender"></span>');
		//~ jQuery('.gender input[type=radio]:first-of-type').after('<span class="input_field current_gender active"></span>');
		
		
		
			//~ jQuery('.size input:nth-child(2)').after('<span class="input_field sizee active"></span>');
			
		//~ jQuery('.size input:nth-child(3)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		//~ jQuery('.size input:nth-child(4)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		//~ jQuery('.size input:nth-child(5)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		//~ jQuery('.size input:nth-child(6)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		//~ jQuery('.size input:nth-child(7)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		//~ jQuery('.size input:nth-child(8)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		//~ jQuery('.size input:nth-child(9)').after('<span class="input_field sizee" style="margin-left: 15px;" ></span>');
		
		
		//~ jQuery('.delivary_option input:nth-child(2)').after('<span class="input_field delivery active"></span>');
		//~ jQuery('.delivary_option input:nth-child(3)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		//~ jQuery('.delivary_option input:nth-child(4)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		//~ jQuery('.delivary_option input:nth-child(5)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		//~ jQuery('.delivary_option input:nth-child(6)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		//~ jQuery('.delivary_option input:nth-child(7)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		//~ jQuery('.delivary_option input:nth-child(8)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		//~ jQuery('.delivary_option input:nth-child(9)').after('<span class="input_field delivery" style="margin-left: 25px;"></span>');
		
		
		//~ jQuery('.woocommerce-shipping-fields p .input_field.sizee').click(function(){
			//~ jQuery('.input_field.sizee').removeClass('active');
			//~ jQuery(this).addClass('active');
		//~ });
		//~ jQuery('.woocommerce-shipping-fields p .input_field.delivery').click(function(){
			//~ jQuery('.input_field.delivery').removeClass('active');
			//~ jQuery(this).addClass('active');
		//~ });
		//~ jQuery('.woocommerce-shipping-fields p .input_field.current_gender').click(function(){
			//~ jQuery('.input_field.current_gender').removeClass('active');
			//~ jQuery(this).addClass('active');
		//~ });
var prestp=0;
		jQuery('.phoen_checkout_butt_next').click(function(){
				jQuery('.subscription_step_2').css("display","block");
				jQuery('.subscription_step_1').css("display","none");
				jQuery('.dob').css("display","none");
				prestp++;
				jQuery('button.phoen_checkout_button_prev').attr( "data-id", prestp );
				
		});
		
		jQuery('.phoen_checkout_button_prev').click(function(){
					prestp--;
					
			if(prestp==1){
				jQuery('.subscription_step_2').css("display", "block");
				jQuery('.subscription_step_1').css("display", "none");
				}else{
				jQuery('.subscription_step_2').css("display", "none");
				jQuery('.subscription_step_1').css("display", "block");
				jQuery('.dob').css("display", "block");
			}
				
		
			//	alert(prestp);
				jQuery('button.phoen_checkout_button_prev').attr( "data-id", prestp );
		});
		
//alert('xxxxxxxxxxx');	
 /* jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');*/
/*jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');*/
jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
jQuery("#pmsc_1 .subscription_step_1 select").parent().addClass('dateofbirth');
jQuery('#pmsc_2 .validclassds').remove();

jQuery( '#pmsc_1 .validclassds input').each(function( e ) {
				var cc=jQuery( this ).val();
				//alert(cc);
				if(cc==''){
				//alert('xxxxxxxxxx');
				ggg='xccccccc';
				}else{
			ggg='mmm';
					}
			});	
			if(ggg=='mmm'){
			jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
			}
			
	   });
			  
			  /*  Ds Code 07-04-2017 */

	
/*jQuery('#pmsc_1 .validclassds input[type=text]').focusout(function(event) {	*/
jQuery('#pmsc_1 .validclassds input').keyup(function(event) {	
       if(jQuery(this).val() == ''){
            jQuery(this).focus();
            jQuery(this).next('.err-msg').show();
		/*	jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');*/
			jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
       }else{
		   	
        jQuery(this).next( '#pmsc_1 .validclassds input').focus();
            jQuery(this).next('.err-msg').hide();
			var ggg='';
			jQuery( '#pmsc_1 .validclassds input').each(function( e ) {
				var cc=jQuery( this ).val();
				if(cc==''){
				//alert('xxxxxxxxxx');
				ggg='xccccccc';
				}else{
			ggg='mmm';
					}
			});	
			if(ggg=='mmm'){
			jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
			}
				
       }		 
   });
  
   
   //~ jQuery('#pmsc_3 input').focusout(function(event) {
	   //~ //alert(jQuery(this).val());	
       //~ if(jQuery(this).val() == '')
       //~ {
            //~ jQuery(this).focus();
            //~ jQuery(this).next('.err-msg').show();
			//~ jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
       //~ }else
       //~ {
		   	
        //~ jQuery(this).next( '#pmsc_3 input').focus();
            //~ jQuery(this).next('.err-msg').hide();
			//~ var ggg='';
			//~ jQuery( '#pmsc_3  input').each(function( e ) {
				//~ var cc=jQuery( this ).val();
				//~ if(cc==''){
				//~ //alert('xxxxxxxxxx');
				//~ ggg='xccccccc';
				//~ }else{
			//~ ggg='mmm';
					//~ }
			//~ });	
			//~ if(ggg=='mmm'){
			//~ jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
			//~ }
				
       //~ }		 
   //~ });
   
</script>
