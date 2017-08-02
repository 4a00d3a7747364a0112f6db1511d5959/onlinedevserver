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
				foreach ( WC()->cart->get_cart() as $cart_item ) 
				{
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
		
		<div>
			<button name="prev" style="display:none" class="phoen_checkout_button_prev"><?php _e( 'Previous', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
			<button name="next" class="phoen_checkout_butt_next"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
		</div>
		<style>
			.woocommerce-shipping-fields h3 {
				display: none;
			}
			#order_comments_field {
				display: none;
			}
		</style>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
		 </div>
		</div>
		</div>
		
	   <?php }
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
		<div>
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
		jQuery('.gender input:nth-child(2)').after('<span class="input_field"></span>');
		jQuery('.gender #additional_field_128:nth-child(4)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(2)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(3)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(4)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(5)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(6)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(7)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(8)').after('<span class="input_field"></span>');
		jQuery('.size input:nth-child(9)').after('<span class="input_field"></span>');
		
		
		jQuery('.delivary_option input:nth-child(2)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(3)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(4)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(5)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(6)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(7)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(8)').after('<span class="input_field"></span>');
		jQuery('.delivary_option input:nth-child(9)').after('<span class="input_field"></span>');
		
		
		jQuery('.woocommerce-shipping-fields p .input_field').click(function(){
			jQuery('.input_field').removeClass('active');
			jQuery(this).addClass('active');
		});

		jQuery('.phoen_checkout_butt_next').click(function(){
				jQuery('.subscription_step_2').css("display","block");
				jQuery('.subscription_step_1').css("display","none");
				jQuery('.dob').css("display","none");
		});
		
		jQuery('.phoen_checkout_button_prev').click(function(){
				jQuery('.subscription_step_2').css("display", "none");
				jQuery('.subscription_step_1').css("display", "block");
				jQuery('.dob').css("display", "block");
		});
	});
</script>
