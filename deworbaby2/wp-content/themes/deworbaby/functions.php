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


	add_filter ('add_to_cart_redirect', 'redirect_to_checkout',12);
	function redirect_to_checkout() {
		global $woocommerce;

		//Get product ID
		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint($_REQUEST['add-to-cart'] ) );
		//Check if product ID is in a certain taxonomy
		$checkout_url = get_permalink(get_option('woocommerce_checkout_page_id'));
			
		if( has_term( 'subscription', 'product_cat', $product_id ) ){
			//Get cart URL
			return $checkout_url;
		 }
		 elseif( has_term( 'gift', 'product_cat', $product_id ) ){
			 return $checkout_url;
		 }
		 elseif( has_term( 'trial', 'product_cat', $product_id ) ){
			 return $checkout_url;
		 }else {
		 	return;
		 }
	}

	/* display-products-from-specific-category-in-shop-page */
	 add_action('pre_get_posts','shop_filter_cat');

	 function shop_filter_cat($query) {
	    if (!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query()) {
	       $query->set('tax_query', array(
	                    array ('taxonomy' => 'product_cat',
	                                       'field' => 'slug',
	                                       'terms' => 'deworbaby'
	                                 )
	                     )
	       );   
	    }
	 }

	//after registration, logout the user and redirect to home page
	function custom_registration_redirect() {
	    //wp_logout();
	    return home_url('/checkout');
	}
	add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 2);


	//free trial additional field for single product and cart
	$check_val = get_post_meta( get_the_ID(), '_free_trial_ship_info', true );
	if( !empty($check_va) ){
		//add_action( 'woocommerce_single_product_summary', 'sb_free_trial_text_section', 20 );
		function sb_free_trial_text_section() {
		    echo '<div id="free-ship-info">Free Trial Shipping Charge: $'.get_post_meta( get_the_ID(), '_free_trial_ship_info', true ).'</div>';
		}
	}
	
	// Display Fields
	//add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
	// Save Fields
	//add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

	//add new field
	function woo_add_custom_general_fields() {
		global $woocommerce, $post;	 ?>
	  	<div class="options_group">
	  	<?php 	  
	  	woocommerce_wp_text_input( 
			array( 
				'id'          => '_free_trial_ship_info', 
				'label'       => __( 'Free Trial Shipping Charge', 'deworbaby' ), 
				'placeholder' => '',
				'desc_tip'    => 'true',
				'description' => __( 'Free Trial Shipping charge charge', 'deworbaby' ) 
			)
		); ?>
	  	</div>	
	<?php }

	function woo_add_custom_general_fields_save( $post_id ){	
		// Text Field
		$woocommerce_free_trial_ship_info = $_POST['_free_trial_ship_info'];
		if( !empty( $woocommerce_free_trial_ship_info ) )
			update_post_meta( $post_id, '_free_trial_ship_info', esc_attr( $woocommerce_free_trial_ship_info ) );	
	}

	//Free Trial Shipping Information in cart
	function save_custom_data( $cart_item_data, $product_id ) {
	    $custom_data = get_post_meta( $product_id, '_free_trial_ship_info', true );
	    if( $custom_data != null && $custom_data != ""  ) {
	        $cart_item_data["freeproinfo"] = $custom_data;
	    }
	    return $cart_item_data;
	}
	//add_filter( 'woocommerce_add_cart_item_data', 'save_custom_data', 10, 2 );

	/**
	 * Here we are trying to display that custom data on Cart Table & Checkout Order Review Table 
	 */
	function render_custom_data_on_cart_checkout( $cart_data, $cart_item = null ) {
	    $custom_items = array();
	    /* Woo 2.4.2 updates */
	    if( !empty( $cart_data ) ) {
	        $custom_items = $cart_data;
	    }
	    if( isset( $cart_item["freeproinfo"] ) ) {
	        $custom_items[] = array( "name" => "Free Trial Shipping Charge", "value" => $cart_item["freeproinfo"] );
	    }
	    return $custom_items;
	}
	//add_filter( 'woocommerce_get_item_data', 'render_custom_data_on_cart_checkout', 10, 2 );

	/**
	 * We are adding that custom data ( freeproinfo ) as Order Item Meta, 
	 * which will be carried over to EMail as well 
	 */
	function save_custom_order_meta( $item_id, $values, $cart_item_key ) {
	    if( isset( $values["freeproinfo"] ) ) {
	        wc_add_order_item_meta( $item_id, "Free Trial Shipping Charge", $values["freeproinfo"] );
	    }
	}
	//add_action( 'woocommerce_add_order_item_meta', 'save_custom_order_meta', 10, 3 );

	//fee trial shipping charge to be inserted in cart and checkout
	//add_action("wp_ajax_sb_user_end_price", "sb_free_product_shipping_charge_deworbaby");
	//add_action("wp_ajax_nopriv_sb_free_product_shipping_charge_deworbaby", "sb_free_product_shipping_charge_deworbaby");
	//add_action( 'woocommerce_before_calculate_totals', 'sb_free_product_shipping_charge_deworbaby' );
	/*function sb_free_product_shipping_charge_deworbaby( $cart_object ) {
	    // $custom_price=786; // it returns the user defined price 
	    global $woocommerce, $product, $post;

	    if( $post->ID == 825 ){
	    	$check_val = get_post_meta( 825, '_free_trial_ship_info', true );
		    foreach ( $cart_object->cart_contents as $key => $value ) {
		           $value['data']->price = $check_val;
		           //$value['wccpf_fees']
		    }
	    }
	}*/

	//add_action( 'woocommerce_cart_calculate_fees','sb_extra_shipping_charge_trial_product' );
	/*function sb_extra_shipping_charge_trial_product() {
	    global $woocommerce;

	    //print_r($woocommerce);
	 
	    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) 
	        return;
	 
	    $fee = get_post_meta( 825, '_free_trial_ship_info', true );
		$woocommerce->cart->add_fee( 'Shipping Charge (Free Trial)', $fee, true, '' );
	}*/

	//auto status changing from pending to processing
	//add_action( 'woocommerce_thankyou', 'sb_woocommerce_auto_pending_status_changer' );
	/*function sb_woocommerce_auto_pending_status_changer( $order_id ) { 
		if ( ! $order_id ) {
			return;
		}
		$order = wc_get_order( $order_id );
		$order->update_status( 'processing' );	
		wp_logout();
		wp_safe_redirect(get_permalink(612));
		exit;	
	}*/


/*--please put your code before this end tags--*/?>


<?php /* unsubscribe function */
	
	add_action('init', 'subscriptionUnsubscribe');
	function subscriptionUnsubscribe(){
		if(isset($_GET) && $_GET['action'] == 'unsubscribe'){
			$args = array(
				'post_type'        => 'shop_subscription',
				'post_parent'      => $_GET['post_id'],
				'post_status'      => 'wc-active'
			);
			$post = get_posts($args );
			if(!empty($post)){
				$my_post = array(
				  'ID'           => $post[0]->ID,
				  'post_status'   => 'wc-on-hold.'
				);
			 
				wp_update_post( $my_post );
				
				$new_post = array(
				 'post_content'    => '{"subscription_id":'.$post[0]->ID.'}',
				 'post_title'   => 'woocommerce_scheduled_subscription_payment',          
				 'post_status'     => "trash", 
				 'comment_status'     => "open", 
				 'post_type'     => "scheduled-action", 
				);
				$pid = wp_insert_post($new_post);
			}		  
		}
	}
 /* Unsubscribe function */
 /* Re Active function Start */
	add_action('init', 'subscriptionReactive');
	function subscriptionReactive(){
		if(isset($_GET) && $_GET['action'] == 'reactive'){
			$args = array(
				'post_type'        => 'shop_subscription',
				'post_parent'      => $_GET['post_id'],
				'post_status'      => 'wc-on-hold'
			);
			$post = get_posts($args);
			if(!empty($post)){
				$my_post = array(
				  'ID'           => $post[0]->ID,
				  'post_status'   => 'wc-active'
				);
			 
				wp_update_post( $my_post );
				
				$new_post = array(
				 'post_content'    => '{"subscription_id":'.$post[0]->ID.'}',
				 'post_title'   => 'woocommerce_scheduled_subscription_payment',          
				 'post_status'     => "trash", 
				 'comment_status'     => "open", 
				 'post_type'     => "scheduled-action", 
				);
				$pid = wp_insert_post($new_post);
			}		  
		}
	}

 
/* Re Active function End */
 
 /*corn function */
    /* add_filter( 'cron_schedules', 'myprefix_add_a_cron_schedule' );

	function myprefix_add_a_cron_schedule( $schedules ) {
		$schedules['sixsec'] = array(
			'interval' => 600, // Every 6 hours
			'display'  => __( 'Every 6 hours' ),
		);
		mail('akash@uniterrene.com','test','hello');
		return $schedules;
	}

///////Schedule an action if it's not already scheduled

	if( ! wp_next_scheduled( 'myprefix_curl_cron_action' ) ) {
		wp_schedule_event( time(), 'sixsec', 'myprefix_curl_cron_action' );
	}

///Hook into that action that'll fire sixhour
	add_action( 'myprefix_curl_cron_action', 'import_into_db' ); */
 /*corn function */


//customizing login error message if password is wrong
add_filter('login_errors','login_error_message');
function login_error_message($error){
    $pos = strpos($error, 'incorrect');
    if ( ! empty( $_POST['username'] ) ) $customer_username = esc_attr( $_POST['username'] );
    if (is_int($pos)) {    	
        $error = 'ERROR: The password you entered for the username <b>'.$customer_username.'</b> is incorrect. <a href="'.esc_url( wp_lostpassword_url() ).'">Forgot your password?</a>';
    }
    return $error;
}
 
 ?>