<?php
/*
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
	<meta name="p:domain_verify" content="311c35332d594917b5d35e1c5bfd998d"/>
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <title><?php bloginfo('name'); ?> <?php wp_title('::'); ?></title>
    <?php wp_head(); ?>
    <?php global $deworbaby_options; ?>
</head>
<body <?php body_class(); ?>>
	<!--search block-->
	<div class="search_field">
	   <a href="#" class="cross"><img src="<?php echo get_template_directory_uri(); ?>/images/cross.png" alt="cross"></a>
	   <div class="search_area">
	       <!-- <form action="#" method="post">
	           <input type="text" name="" placeholder="Enter search keywords">
	           <input type="submit" value="SUBMIT">
	       </form> -->
	       <?php //get_search_form(); ?>
	       <?php get_product_search_form();
			$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
				<div>
					<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search Products', 'woocommerce' ) . '" />
					<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
					<input type="hidden" name="post_type" value="product" />
				</div>
			</form>';
			//echo $form;
	       ?>
	   </div>
	</div>
	<!--search block-->

    <!-- header start -->
    <header id="main_header" class="clearfix">
       <div class="top_section">
	       <div class="container clearfix"> 
	           	<div class="left_part">
	              	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('title'); ?>">
	            	<?php 
	                if(!empty($deworbaby_options['logo'])) { ?> 
	                    <img src="<?php echo $deworbaby_options['logo']['url']; ?>"> 
	            	<?php } ?>
	            	</a>
	           	</div>
	           	<a href="#" class="bars">
	              	<span></span>
	              	<span></span>
	              	<span></span>
	            </a>
	           	<nav class="right_part clearfix">
	               	<div class="close"><i class="fa fa-times"></i></div>
	               
	                  	<?php 
				            wp_nav_menu( 
				                array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'header-menu', 'link_before' => '', 'link_after' => '', )
				            ); /* */
				           // echo clean_custom_menu('header-menu');
				        ?>

	                  	<li id="navds">
							<?php if ( is_user_logged_in() ) { ?>
		                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php $current_user = wp_get_current_user(); echo $current_user->user_login; ?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
		                        <ul class="sub-menu">
		                            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
		                            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
		                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
		                            </li>
		                            <?php endforeach; ?>
		                        </ul>
		                     <?php } 
		                     else { ?>
		                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('SIGN IN','deworbaby'); ?></a>
		                     <?php } ?>
	                  	</li>
	               

	               	<ul>
	                  <li>
						<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                        <span class="cartAmmount" ><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/cart_black.png" alt="shopping Cart">
                    	</a>
	                  </li>
	                  <li><a href="#" class="search"><img src="<?php echo get_template_directory_uri(); ?>/images/search_icon.png" alt="search"></a></li>
	               	</ul>
	           	</nav>
	       </div>    
	   	</div>
    </header>
    <!-- header end -->