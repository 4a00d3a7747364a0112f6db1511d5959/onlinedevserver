<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

//do_action( 'woocommerce_before_checkout_form', $checkout );

?>
	
	<div class="form_area form_area_subscribe">
	   <div class="form_inner">
		  <div class="actual_form_area">
				<div class="steps">
                     <div class="line"></div>
                     <div class="line2"></div>
                     
				<?php 
				foreach ( WC()->cart->get_cart() as $cart_item ) {
					$item = $cart_item['data'];
					if(!empty($item)){
						$product = new WC_product($item->id);
						// $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
						$terms = get_the_terms( $item->id, 'product_cat' );
						foreach ($terms as $term) {
						$product_cat = $term->name;
						}
						
						// to display only the first product image uncomment the line bellow
						// break;
					}
				
				
				   if($product_cat =="Subscription")	
				   {
					  require_once('subscribecheckout.php');
					   
					}elseif($product_cat =="Trial")	
				   {
				   		require_once('subscribecheckout.php');
				   }
				   elseif($product_cat =="deworbaby")	
				   {
				   		require_once('shopcheckout.php');
				   }
					elseif($product_cat =="gift")	
				   {
				    	$reactiveds = WC()->session->get('reactive');	

					  	if($reactiveds=='hidegifthtml'){
						 	require_once('subscribecheckout.php');  
							WC()->session->__unset('reactive');
					  	}else{ 
					   		require_once('giftcheckout.php');
						}
					}
	   else
	   {
		
		if(!is_user_logged_in()):$pmsc_no_login = "class='selected'";
		else:$pmsc_login = "none";$pmsc_select_div = "class='selected'";
		endif;?>	
		<ul class="pmsc_tabs">
		<li style="display:<?php echo (isset($pmsc_login) && !empty($pmsc_login))?$pmsc_login:''; ?>;" <?php echo (isset($pmsc_no_login) && !empty($pmsc_no_login))?$pmsc_no_login:'';?> data-step="0"><?php _e( 'Login', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
		
		<li <?php echo (isset($pmsc_select_div) && !empty($pmsc_select_div))?$pmsc_select_div:''; ?> data-step='1'><?php _e( 'Billing', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
			
		<li  data-step='2'><?php _e( 'Shipping', 'multi-step-ckeckout-for-woocommerce' ); ?></li>	
		<li  data-step='3'><?php _e( 'Order Info', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
		
		<li  data-step='4'><?php _e( 'Payment Info', 'multi-step-ckeckout-for-woocommerce' ); ?></li>

	</ul>
	
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
		

		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
			
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
				
				
				<div class="col-1_billing ui-tabs-panel" id='pmsc_1' style="display:none">
		
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
			   
				</div>

				<div class="col-2_shipping ui-tabs-panel ui-tabs-hide" id="pmsc_2" style="display:none">
				
					<?php
				   
					do_action( 'woocommerce_before_checkout_shipping_form' );
					do_action( 'woocommerce_checkout_shipping' );
					do_action( 'woocommerce_checkout_after_customer_details' );
				   
				   ?>
			    </div>

				<?php endif; ?>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			   <div id="pmsc_3" class="woocommerce-checkout-review-order" style="display:none">				   
				   <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>				   
				   <div class="coupan_form">						
						<?php do_action( 'phoen_checkout_order_review' ); ?>
					</div>
					<input type="checkbox" name="payment_method" value="" data-order_button_text="" style="display: none;" />
				</div>				
				<div class="ui-tabs-panel ui-tabs-hide " id="pmsc_4" style="display:none">					
					<h3 id="phoen_order_review_heading"><?php _e( 'Payment Info', 'woocommerce' ); ?></h3>					
					<?php do_action( 'phoen_checkout_order_payment' ); ?>										
				</div>			 
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>						
		</form>		
		<div class="btn-wrapper">
			<button name="prev" style="display:none" class="phoen_checkout_button_prev"><?php _e( 'Previous', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
			<button name="next" class="phoen_checkout_butt_next"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
		</div>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
 <?php } ?>
<?php } ?>
<style>		
	.selected {
		color:red;
	}
	.input_field.active{
		background: #caaa55 !important;
	}
	.input_field.active::after{
		border:1px solid #caaa55 !important;
	}
	.woocommerce-shipping-fields p {
		text-transform: capitalize !important;
	}
	.woocommerce-shipping-fields .form-row.form-row-wide.subscription_step_2.size{
		text-transform: uppercase !important;
	} 
	.woocommerce-shipping-fields .form-row.form-row-wide.subscription_step_2.size label{
	text-transform: capitalize !important;	
	}
</style>
<script>
	var cls_val = jQuery('.cls-pmsc').html();
	var active = jQuery(".pmsc_tabs li.selected").attr('id');
	
	if(active =="cus-1")
	{
		jQuery('.subscription_step_2').css("display", "none");
	}
	else
	{
		jQuery('.subscription_step_2').css("display", "block");
	}		
	
	jQuery(document).ready(function(){		
	/* xxxxxxxxxxxxxxxxxxxxxxxx #pmsc_1 */	
	<?php
	if($product_cat =="gift")	
				   {
	?>
	//jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
	
	jQuery('.radiobuttongift').on('click', function(event) {
		jQuery(".radiobuttongift").removeClass("activds");
		var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
		jQuery(this).addClass('activds');
		
		
		
var cartitemid=jQuery(this).attr("data-id");
jQuery('.phoen_checkout_butt_next.radiobuttongift').attr("data-id", "ds99");
jQuery( "div[data-id='"+cartitemid+"']" ).addClass('activds');

var name =jQuery('#recipient_dsname').val();
var note = jQuery('#recipnote').val();
 if ( jQuery( this ).hasClass( "phoen_checkout_butt_next" ) ) {
	 jQuery(this).hide();
		emailfildchk();	
			/*jQuery( '#recivuserinfo input[type="email"]').each(function( e ) {
				var cc=jQuery( this ).val();
				if(cc==''){
				alert('enter email address.');
				ggg='xccccccc';
				
				  jQuery(this).focus();
            jQuery(this).next('.err-msg').show();
					
				jQuery('.phoen_checkout_butt_next.radiobuttongift').show();	 	
				e.preventDefault();
				 e.stopPropagation();
				}else{
			ggg='mmm';
			jQuery(this).next('.err-msg').hide();
			
					}
			});	
			if(ggg=='mmm'){
			jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
			}*/

			
 }
var data = {
        action: 'update_cartds',
        pid: cartitemid,
		rname: name,
		rnote: note
    };
jQuery.post(ajaxurl, data, function(response) {
   //  alert('^'+response+'^');
   if(response!='nodata'){
	 jQuery('#recivuserinfo').html(response);
	//jQuery('#pmsc_2').load('http://onlinedevserver.biz/dev/deworbaby/checkout/#pmsc_2');	
//jQuery('#pmsc_2').load(document.URL +  ' #pmsc_2 > *');
	/*jQuery('#sub-general form.checkout.woocommerce-checkout').load(document.URL +  ' #sub-general form.checkout.woocommerce-checkout> *');*/
	
	
location.reload();
   }
    });
	
		});
		
		jQuery('.phoen_checkout_button_prev.giftpre').on('click', function(e) {
		location.reload();
			});
			
			
jQuery('#recipient_dsname').focusout(function(event) {	
	if(jQuery(this).val() == ''){
	jQuery(this).focus();
	jQuery(this).next('.err-msg').show();
	/*	jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');*/
	jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
	}else{		   
	jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
	jQuery(this).next('.err-msg').hide();		
	}	
});

jQuery('#recivuserinfo input[type="email"]').focusout(function(event) {	

var evalds=jQuery(this).val();
if(isValidEmailAddress(evalds)){
	
/*jQuery( '#recivuserinfo input[type="email"]').each(function( e ) {
var emailAddress=jQuery(this).val();
	if(!isValidEmailAddress(emailAddress)){
	jQuery(this).focus();
	jQuery(this).next('.err-msg').show();
	/*	jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');*-/
	jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
	
	}else{		   
	jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
	jQuery(this).next('.err-msg').hide();		
	}	
});*/
emailfildchk();
}else{
	jQuery(this).focus();
            jQuery(this).next('.err-msg').show();
			jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
			//alert('xxxxxxxxxxx');
	}

});


function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
        return pattern.test(emailAddress);
    };

function emailfildchk(){
	var getval=[];
	
	jQuery( '#recivuserinfo input[type="email"]').each(function( e ) {
				var cc=jQuery( this ).val();
				
				//var getval[]=cc;
				if(cc==''){
				//alert('enter email address.');
				ggg='xccccccc';
				
				  jQuery(this).focus();
            jQuery(this).next('.err-msg').show();
					jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
			jQuery('.phoen_checkout_butt_next.radiobuttongift').show();	 	
				e.preventDefault();
				 e.stopPropagation();
				}else{
					getval=[cc];
			ggg='mmm';
			jQuery(this).next('.err-msg').hide();
			
					}
			});	
			if(ggg=='mmm'){
				
				//if (getval[1] == getval[0]) {
			jQuery(".phoen_checkout_butt_next.btnDisabled").removeAttr("disabled").removeClass('btnDisabled');
			  jQuery('#recivuserinfo input[name="recipient_emailds"]').next('.err-msg').hide();
				/*}else{
					//alert('vvvvvvvvvvv');
					jQuery('#recivuserinfo input[name="recipient_emailds"]').focus();
					  jQuery('#recivuserinfo input[name="recipient_emailds"]').next('.err-msg').show();
					//location.reload();
				/*   e.stopPropagation();*-/
				// jQuery("button.phoen_checkout_butt_next").prop("disabled",true).addClass('btnDisabled');
					}*/
			}
			
	};
	
	/* xxxxxxxxxxxxxxxxxxxxxxxx 
	
	
	
	
	*/
<?php
				   }
				   ?>
	});
	
	
</script>