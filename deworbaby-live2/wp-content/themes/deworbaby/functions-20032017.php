<?php
	//Deworbaby enqueue scripts
	function sb_deworbaby_enqueue_script() {
		//styles
		wp_enqueue_style( 'fontawesome',  get_template_directory_uri() . '/css/font-awesome.min.css' );
		//wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Karla:400,700' );	
		wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Raleway:300,400,600,700' );	
		
		//wp_enqueue_style( 'bxslider-css',  get_template_directory_uri() . '/css/jquery.bxslider.css' );
		wp_enqueue_style( 'customs',  get_template_directory_uri() . '/css/custom.css' );
		wp_enqueue_style( 'responsive',  get_template_directory_uri() . '/css/responsive.css' );		
		wp_enqueue_style( 'main',  get_template_directory_uri() . '/style.css' );		
		
		//js
		//wp_enqueue_script( 'new-js', get_template_directory_uri().'/js/jquery.min.js', array('jquery'), true );
		//wp_enqueue_script( 'bxslider-js', get_template_directory_uri().'/js/jquery.bxslider.min.js', array('jquery'), true );
		wp_enqueue_script( 'custom', get_template_directory_uri().'/js/custom.js', array('jquery'), true );
		wp_enqueue_script( 'flexisel', get_template_directory_uri().'/js/jquery.flexisel.js', array('jquery'), true );
		wp_enqueue_script( 'deworbaby-js', get_template_directory_uri().'/js/deworbaby.js', array('jquery'), true );
	}
	add_action( 'wp_enqueue_scripts', 'sb_deworbaby_enqueue_script' );

	//Deworbaby thumbnail support
	add_theme_support( 'post-thumbnails' );

	function sb_deworbaby_excerpt_support_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'sb_deworbaby_excerpt_support_pages' );

	//Deworbaby menus
	function sb_deworbaby_register_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'footer-menu' => __( 'Footer Menu' ),
				)
			);
	}
	add_action( 'init', 'sb_deworbaby_register_menus' );

	//Deworbaby dynamic sidebars
	function sb_deworbaby_widgets() {
		register_sidebar( array(
			'name' => __( 'Deworbaby Blog Sidebar', 'deworbaby' ),
			'id' => 'deworbaby-blog-sidebar',
			'description' => __( 'This widget displayed in right sidebar of blog pages', 'deworbaby' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Deworbaby Woocommerce Sidebar', 'deworbaby' ),
			'id' => 'deworbaby-woocommerce-sidebar',
			'description' => __( 'This widget displayed in right sidebar of blog pages', 'deworbaby' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}
	//add_action( 'widgets_init', 'sb_deworbaby_widgets' );

	//Deworbaby theme options
	function sb_deworbaby_redux_framework(){
		if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/includes/ReduxFramework/ReduxCore/framework.php' ) ) {
			require_once( dirname( __FILE__ ) . '/includes/ReduxFramework/ReduxCore/framework.php' );
		}
		if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/includes/ReduxFramework/sample/sample-config.php' ) ) {
			require_once( dirname( __FILE__ ) . '/includes/ReduxFramework/sample/barebones-config.php' );
		}
	}
	add_action('after_setup_theme', 'sb_deworbaby_redux_framework');

	//Deworbaby customized content word limit
	//use sb_content(25)
	function sb_content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
			array_pop($content);
			$content = implode(" ",$content);
		} else {
			$content = implode(" ",$content);
		} 
		$content = preg_replace('`\[[^\]]*\]`','',$content);
		return $content;
	}
	
	//Deworbaby customized exceprt word limit
	//use excerpt(25) or the_excerpt()
	function excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}

	//Deworbaby excerpt read more link
	function new_excerpt_more($more) {
		global $post;
		return '<a class="getDetails" href="'. get_permalink($post->ID) . '">' . 'Get Details <i class="fa fa-long-arrow-right" aria-hidden="true"></i>' . '</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	
	//search highlighter for excerpt
	function search_excerpt_highlight() {
		$excerpt = get_the_excerpt();
		$keys = implode('|', explode(' ', get_search_query()));
		$excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);
		echo '<p>' . $excerpt . '</p>';
	}
		//search highlighter for title
	function search_title_highlight() {
		$title = get_the_title();
		$keys = implode('|', explode(' ', get_search_query()));
		$title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);
		echo $title;
	}
	
	//Deworbaby woocommerce support
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'woocommerce_support' );

	//Deworbaby woocommerce continue shopping
	function sb_deworbaby_woo_continue_redirect( $url ) {
		return esc_url( home_url( '/' ) ).'shop';
	}
	add_filter( 'woocommerce_continue_shopping_redirect', 'sb_deworbaby_woo_continue_redirect' );

	//woocommerce hooks & filters
	//remove default sorting
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	
	//remove showing # number of products message
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	
	//existing tabs in single product removed
	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
	function woo_remove_product_tabs( $tabs ) {
	    unset( $tabs['description'] );      		// Remove the description tab
	    unset( $tabs['reviews'] ); 					// Remove the reviews tab
	    unset( $tabs['additional_information'] );  	// Remove the additional information tab

	    return $tabs;
	}
	
	//remove breadcrumbs
	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

	//custom stock messages
	//add_filter( 'woocommerce_get_availability', 'sb_custom_get_availability', 1, 2);
	function sb_custom_get_availability( $availability, $_product ) {
	    
	    // Change In Stock Text
	    if ( $_product->is_in_stock() ) {
	        $availability['availability'] = __('Available!', 'woocommerce');
	    }
	    // Change Out of Stock Text
	    if ( ! $_product->is_in_stock() ) {
	        $availability['availability'] = __('Sold Out', 'woocommerce');
	    }
	    return $availability;
	}

	//vertical product gallery
	//add_filter ( 'woocommerce_product_thumbnails_columns', 'sb_change_gallery_columns' ); 
	function sb_change_gallery_columns() {
	    return 1; 
	}

	//update cart
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
	  global $woocommerce;
	  ob_start();
	  ?>
	  <span class="cartAmmount"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
	  <?php
	  $fragments['span.cartAmmount'] = ob_get_clean();
	  return $fragments;
	}

	//Remove Sales Flash
	add_filter('woocommerce_sale_flash', 'sb_hide_sales_flash');
	function sb_hide_sales_flash()
	{
	    return false;
	}

	//add sizechart beside add to cart button
	add_action('woocommerce_after_add_to_cart_button','sb_woo_sizechart_beside_cart_button');
	function sb_woo_sizechart_beside_cart_button() {
		global $deworbaby_options;
		echo "<a class='zoom sizechart-link' href='".$deworbaby_options['shop_size_chart']['url']."'>".$deworbaby_options['shop_size_chart_text']."</a>";
	}

	//remove add to cart button on archive and category pages
	add_action( 'woocommerce_after_shop_loop_item', 'sb_remove_add_to_cart_buttons', 1 );
    function sb_remove_add_to_cart_buttons() {
      if( is_product_category() || is_shop()) { 
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
      }
    }


	//adding first and last name is registration form
	/* BEGIN REGISTRATION FIELDS */
	function sb_extra_register_fields() {
		?>
		<div class="clearfix">
			<p class="form-row form-row-first half">
			<label for="reg_billing_first_name"><?php _e( 'First Name', 'textdomain' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
		</p>
		<p class="form-row form-row-last half">
			<label for="reg_billing_last_name"><?php _e( 'Last Name', 'textdomain' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
		</p>
		</div>
		
		<?php
	}
	add_action( 'woocommerce_register_form_start', 'sb_extra_register_fields' );
	function sb_validate_extra_register_fields( $username, $email, $validation_errors ) {
		if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
			$validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: Required.', 'textdomain' ) );
		}
		if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
			$validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Required.', 'textdomain' ) );
		}
	}
	add_action( 'woocommerce_register_post', 'sb_validate_extra_register_fields', 10, 3 );
	function sb_save_extra_register_fields( $customer_id ) {
		if ( isset( $_POST['billing_first_name'] ) ) {
			update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
			update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		}
		if ( isset( $_POST['billing_last_name'] ) ) {
			update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
			update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		}
	}
	add_action( 'woocommerce_created_customer', 'sb_save_extra_register_fields' );
	/* END REGISTRATION FIELDS */


	//adding confirm email field on registration form
	add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
	function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
		global $woocommerce;
		extract( $_POST );
		if ( strcmp( $email, $confirm_email ) !== 0 ) {
			return new WP_Error( 'registration-error', __( 'Emails do not match.', 'woocommerce' ) );
		}
		return $reg_errors;
	}
	add_action( 'woocommerce_register_form', 'wc_register_form_email_confirm' );
	function wc_register_form_email_confirm() {
		?>
		<p class="form-row form-row-wide confirm-email">
			<label for="confirm_email"><?php _e( 'Confirm Email Address', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="email" class="input-text" name="confirm_email" id="confirm_email" value="<?php if ( ! empty( $_POST['confirm_email'] ) ) echo esc_attr( $_POST['confirm_email'] ); ?>" required/>
		</p>
		<?php
	}

	//product search customization
	add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );
	function woo_custom_product_searchform( $form ) {
		
		$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
			<div>
				<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
				<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search Products', 'woocommerce' ) . '" />
				<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>';
		
		return $form;	
	}

	//show shipping address always
	//add_filter( 'woocommerce_cart_needs_shipping', '__return_true' );
	add_filter( 'woocommerce_cart_needs_shipping_address', '__return_true', 50 );

	function wc_remove_related_products( $args ) {
		return array();
	}
	add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

/*--please put your code before this end tags--*/?>

<?php 
/* */
add_filter ('add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout() {
		global $woocommerce;

		//Get product ID
		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint($_REQUEST['add-to-cart'] ) );
		//Check if product ID is in a certain taxonomy
		if( has_term( 'subscription', 'product_cat', $product_id ) ){
					//Get cart URL
					$checkout_url = get_permalink(get_option('woocommerce_checkout_page_id'));
					//Return the new URL
				return $checkout_url;
		 };
}