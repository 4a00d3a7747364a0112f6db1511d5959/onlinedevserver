<?php
/**
 * Plugin Name: Woocommerce Force Product Shippings
 * Plugin URI: http://codecanyon.net/user/TicianaH
 * Description: Force the Shippings for single products .
 * Version: 2.0
 * Author: TicianaH
 * Author URI:http://codecanyon.net/user/TicianaH
  
 */

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
{
    
    add_action('add_meta_boxes', 'wfp_shipping_meta_box_add', 20);
    function wfp_shipping_meta_box_add()
    {
        add_meta_box('wfp_ship', 'Choose Shippings', 'wfp_shipping_form', 'product','side', 'high');
    }

    function wfp_shipping_form()
    {
        global $post, $woocommerce;
        $productIds = get_option('woocommerce_product_apply_wfpship');
        $postwfp_ship = count(get_post_meta($post->ID, 'wfp_ship', true)) ? get_post_meta($post->ID, 'wfp_ship', true) : array();
        if (is_array($productIds))
        {
            foreach ($productIds as $key => $product) {
                if (!get_post($product) || !count(get_post_meta($product, 'wfp_ship', true)))
                    unset($productIds[$key]);
            }
        }
        update_option('woocommerce_product_apply_wfpship', $productIds);
        $productIds = get_option('woocommerce_product_apply_wfpship');

        if ($woocommerce->shipping->load_shipping_methods())
            foreach ($woocommerce->shipping->load_shipping_methods() as $key => $method) {
                if ($method->enabled == 'yes')
                    $wfp_ship[$key] = $method;
            }

        foreach ($wfp_ship as $ship) {
            $checked = '';
            if (is_array($postwfp_ship) && in_array($ship->id, $postwfp_ship))
                $checked = ' checked="checked" ';
            ?>  
            <input type="checkbox" <?php echo $checked; ?> value="<?php echo $ship->id; ?>" name="ship[]" id="ship_<?php echo $ship->id ?>" />
            <label for="ship_<?php echo $ship->id ?>"><?php echo $ship->method_title; ?></label>  
            <br />  
            <?php
        }
    }

    add_action('save_post', 'wfp_shipping_meta_box_save', 10, 2);
    function wfp_shipping_meta_box_save($post_id, $post)
    {
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
        
        if (isset($post->post_type) && $post->post_type == 'revision')
            return $post_id;
        if (isset( $_POST['post_type']) && $_POST['post_type'] == 'product' && isset( $_POST['ship'] ))
        {
            $productIds = get_option('woocommerce_product_apply_wfpship');
            if ( is_array( $productIds ) && !in_array( $post_id, $productIds ) )
            {
                $productIds[] = $post_id;
                update_option('woocommerce_product_apply_wfpship', $productIds);
            }
            
            $wfp_ship = array();
            if ($_POST['ship'])
            {
                foreach ($_POST['ship'] as $ship)
                    $wfp_ship[] = $ship;
            }
            if (count($wfp_ship))
                update_post_meta($post_id, 'wfp_ship', $wfp_ship);
            else
                delete_post_meta($post_id, 'wfp_ship');
        }

    }

    function wfp_shipping_method_disable_country($available_methods)
    {
        global $woocommerce;
        $_available_methods = $available_methods;
        $temp = array();
        $arrayKeys = array_keys($available_methods);
        if (count($woocommerce->cart))
        {
            $items = $woocommerce->cart->cart_contents;
            $itemsShips = '';
            if ( is_array( $items ) )
            {
                foreach ( $items as $item ) {
                    $itemsShips = get_post_meta( $item['product_id'], 'wfp_ship', true );
                    if ( !empty( $itemsShips ) )
                    {
                        foreach ( $arrayKeys as $key ) {
                            if( array_key_exists( $key, $available_methods ) ){
                                $method_id = $available_methods[$key]->method_id;
                                if ( !empty( $method_id ) && !in_array( $method_id, $itemsShips ) )
                                {
                                    unset( $available_methods[$key] );
                                }
                            }
                        }
                        $temp = array_merge( $temp, $itemsShips );
                    }
                }
            }
        }
        $maxcost_shipping = array();
        $max_cost = -1;
        foreach ( $_available_methods as $key => $available_method ) {
            if( array_key_exists( $key, $_available_methods ) ){
                $method_id = $available_method->method_id;
                if ( $available_method->cost > $max_cost && in_array( $method_id, $temp ) )
                {
                    $max_cost = $available_method->cost;
                    $maxcost_shipping = array($key => $available_method);
                }
            }
        }    
        if (count($available_methods)){
            return $available_methods;
        } else {
            return count($maxcost_shipping) ? $maxcost_shipping : $available_methods;
        }
    }
    add_filter('woocommerce_package_rates', 'wfp_shipping_method_disable_country', 99);

	function update_user_database()
    {
        $is_shipping_updated = get_option('is_shipping_updated');
        if (!$is_shipping_updated)
        {
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'product',
                'fields' => 'ids'
            );
            $products = get_posts($args);
            foreach ($products as $pro_id) {
                $itemsShips = get_post_meta($pro_id, 'wfp_ship', true);
                if (empty($itemsShips))
                {
                    delete_post_meta($pro_id, 'wfp_ship');
                }
            }
            update_option('is_shipping_updated', true);
        }
    }
    add_action('wp_head', 'update_user_database');
}

else{
	add_action( 'admin_notices', 'woo_define_shipping_not_active' );
	function woo_define_shipping_not_active(){
		echo '<div class="updated"><p>Woocommerce is not activated.Activate the Woocommerce to use the Woocommerce Force  Product Shippings Plugin </p></div>';
	}
	
}
?>