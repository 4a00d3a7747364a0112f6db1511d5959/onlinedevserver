<?php

					  /*  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */ 
					   
		
		if(!is_user_logged_in()):$pmsc_no_login = "class='selected'";
		else:$pmsc_login = "none";$pmsc_select_div = "class='selected'";
		endif;?>	
		<ul class="pmsc_tabs" style="display:none;">
		<li style="display:<?php echo (isset($pmsc_login) && !empty($pmsc_login))?$pmsc_login:''; ?>;" <?php echo (isset($pmsc_no_login) && !empty($pmsc_no_login))?$pmsc_no_login:'';?> data-step="0"><?php _e( 'Login', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
		
		<li <?php echo (isset($pmsc_select_div) && !empty($pmsc_select_div))?$pmsc_select_div:''; ?> data-step='1'>your gift<?php //_e( 'Billing', 'multi-step-ckeckout-for-woocommerce' ); ?></li>
			
		<li  data-step='2'><?php //_e( 'Shipping', 'multi-step-ckeckout-for-woocommerce' ); ?><?php _e( 'Billing', 'multi-step-ckeckout-for-woocommerce' ); ?></li>	
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
		
<style>
.radiobuttongift{
	 border: 2px solid;   
    float: left;
    font-weight: bold;
    text-align: center;
    width: 25%;
	cursor:pointer;
	}
.activds{
	color: green; cursor: unset;
	}
.nextgiftbtn{
	background: #41476d none repeat scroll 0 0 !important;
    border-radius: 3px;
    box-shadow: none;
    color: #fff;
    cursor: pointer;
    font-size: 1.25em;
    margin-bottom: 1em;
    margin-top: 1em;
    padding: 1em;
    text-align: center;
    text-shadow: none;
	}
</style>
		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
			
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
				
				
				<div class="col-1_billing ui-tabs-panel" id='pmsc_1' style="display:none">
                
                
<h3>Customize Your Gift</h3><br />

You're so thoughtful! We know they'll love it.<br />


Select the duration of your gift<br />
<?php
$args = array( 'post_type' => 'product', 'posts_per_page' => 4,'product_cat' => 'gift', 'orderby' =>'date','order' => 'ASC' );
  $loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product; 
$id=$product->id;
//print_r($product);
$giftp=array('name'=>get_the_title($id),'img'=>wp_get_attachment_url( get_post_thumbnail_id($id) ),'price'=>$product->subscription_price,'sortdec'=>get_post($id)->post_excerpt,'dec'=>get_post($id)->post_content, 'addtocart'=>'?add-to-cart='.$id);
?>
<div class="radiobuttongift <?php if($id==$item->id){?>activds<?php }?>" data-id="<?php echo $id;?>">
                                        <label class="label-freqency" for="SelectedSlug"><?php echo $giftp['name'];?></label>
                                        <br>
                                        $ <?php echo $giftp['price'];?></label>
                                    </div>
                                   
                                    
<?php
endwhile;
wp_reset_query(); 
?>
<div id="recivuserinfo">
<?php
$cart_itemsd = WC()->cart->get_cart();
foreach($cart_itemsd as $cart_item_key=>$cart_item){	
	echo WCSG_Cart::maybe_display_gifting_information( $cart_item, $cart_item_key );
	}
?>
</div>
		
					
			   
				</div>

				<div <?php /*?>class="col-2_shipping ui-tabs-panel ui-tabs-hide" id="pmsc_2"<?php */?> style="display:none">
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
                    
					<?php
				  
					do_action( 'woocommerce_before_checkout_shipping_form' );
					do_action( 'woocommerce_checkout_shipping' );
					do_action( 'woocommerce_checkout_after_customer_details' );
				   
				   ?>
			    </div>

				<?php endif; ?>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			   <div id="pmsc_3" class="woocommerce-checkout-review-order" style="display:none">				   
				  <?php /*?> <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>				   
				   <div class="coupan_form">						
						<?php do_action( 'phoen_checkout_order_review' ); ?>
					</div><?php */?>
					<input type="checkbox" name="payment_method" value="" data-order_button_text="" style="display: none;" />
				</div>				
				<div <?php /*?>class="ui-tabs-panel ui-tabs-hide " id="pmsc_4"<?php */?>class="col-2_shipping ui-tabs-panel ui-tabs-hide" id="pmsc_2"  style="display:none">	
                 <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>				   
				   <div class="coupan_form">						
						<?php do_action( 'phoen_checkout_order_review' ); ?>
					</div>				
					<h3 id="phoen_order_review_heading"><?php _e( 'Payment Info', 'woocommerce' ); ?></h3>					
					<?php do_action( 'phoen_checkout_order_payment' ); ?>										
				</div>			 
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>						
		</form>		
		<div>
			<button name="prev" style="display:none" class="phoen_checkout_button_prev giftpre"><?php _e( 'Previous', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
			<?php /*?><button name="next" class="phoen_checkout_butt_next radiobuttongift" data-id="<?php echo $id;?>"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button><?php */?>
            <button name="next" class="phoen_checkout_butt_next radiobuttongift" data-id="ds99"><?php _e( 'Continue', 'multi-step-ckeckout-for-woocommerce' ); ?></button>
		</div>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
 <?php 
 /*  xxxxxxxxxxxxxxxxxxxxxxxxxxxxx */
					   
?>