<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

global $params;

global $n;

$class_name_extra="";

$count = $params+1;

if($count%3==0)
{
	$n++;
}
$count_new = 1+3*$n;

if($count_new == $params)
{
	$class_name_extra = "second_child";
}

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$pid = get_the_ID();

$url = get_permalink($pid);
?>
<div class="box clearfix <?php echo $class_name_extra; ?>">
			<div <?php post_class(); ?>>
				
                <a href="<?php echo $url;?>">
                    <div class="box_inner">
                  <!--  <ul class="icons">
                     <li><a href="http://onlinedevserver.biz/dev/ascend?action=yith-woocompare-add-product&amp;id=<?php echo $pid; ?>" class="compare" data-product_id="<?php echo $pid; ?>" rel="nofollow"><i class="fa fa-tags" aria-hidden="true"></i></a></li>
                    
                     <li class="yith-wcwl-add-button show">
					<a href="http://onlinedevserver.biz/dev/ascend/product/elevate-cycling-jersey-mens/?add_to_wishlist=<?php echo $pid; ?>" rel="nofollow" data-product-id="<?php echo $pid; ?>" data-product-type="simple" class="add_to_wishlist">
					<i class="fa fa-heart" aria-hidden="true"></i></a>
					<img src="http://onlinedevserver.biz/dev/ascend/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility: hidden;">
					</li>
                   
                     <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                   </ul> -->
                 <?php //echo woocommerce_template_loop_product_thumbnail(); ?>
                  <?php  the_post_thumbnail('shop_thumbnail'); ?>
               
                </div>
              </a>  
                <div class="box_left">
                   <p><a href="<?php echo $url;?>"><?php the_title(); //echo 'cc='.$count;?></a></p>

                </div> 
                <div class="box_right">
                   <p class="price"><?php echo $product->get_price_html(); ?></p>
                </div> 
             </div>
			</div>
<?php echo $i;?>
