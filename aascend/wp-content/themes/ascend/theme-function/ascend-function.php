<?php
/*
 * Author: Shourya Chowdhury
 * 
 * Description: Added the code for the custom function for the theme
 * 
 * 
 * 
 * */
 
 // Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

/*Added New Menu For The Footer Section*/

register_nav_menus( array(
		'products_menu'    => __( 'PRODUCTS', 'ascend' ),
		'ordering_menu' => __( 'ORDERING', 'ascend' ),
		'helpful_menu' => __( 'HELPFUL RESOURCES', 'ascend' ),
		'technology_menu' => __( 'TECHNOLOGY', 'ascend' ),
		'design_menu' => __( 'DESIGN', 'ascend' ),
		'special_menu' => __( 'SPECIAL PROGRAMS', 'ascend' ),
	) );
	
/* Add New Side-Bar For The Footer Area */

function center_register_sidebars() {
 
    /* Register the footer center sidebar. */
    register_sidebar(
        array(
            'id' => 'center_footer_sidebar',
            'name' => __( 'Footer 2', 'ascend' ),
            'description' => __( 'Add widgets here to appear in your  Center Footer.', 'ascend' ),
            'before_widget' => '<div class="footer_row">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
    );
 
    /* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'center_register_sidebars' );




/* Add New Side-Bar For Right Side  Footer Area */

function right_register_sidebars() {
 
    /* Register the footer center sidebar. */
    register_sidebar(
        array(
            'id' => 'right_footer_sidebar',
            'name' => __( 'Footer 3', 'ascend' ),
            'description' => __( 'Add widgets here to appear in your  Center Footer.', 'ascend' ),
            'before_widget' => '<div class="footer_row">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
    );
 
    /* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'right_register_sidebars' );



/* Add New Side-Bar For Left Side  Shop Page*/

function shop_register_sidebars() {
 
    /* Register the footer center sidebar. */
    register_sidebar(
        array(
            'id' => 'shop_sidebar',
            'name' => __( 'Shop Sidebar', 'ascend' ),
            'description' => __( 'Add widgets here to appear in your  Center Footer.', 'ascend' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );
 
    /* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'shop_register_sidebars' );




	
$args = array(
	'default-color' => '000000',
	'default-image' => '%1$s/images/background.jpg',
);
add_theme_support( 'custom-background', $args );



require get_template_directory() . '/custom-post/custom-post.php'; 




// numbered pagination
function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         //echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         //echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
          //~ if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
          echo "<li class='firstAndLast'><a href='".get_pagenum_link($paged - 1)."'> Previous</a></li>";
 
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class=\"current\">".$i."</span></li>":"<li><span><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></span></li>";
             }
         }
 
        echo "<li class='firstAndLast'><a class='next2' href=\"".get_pagenum_link($paged + 1)."\">Next </a></li>";  
         //~ if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}


add_action("wp_ajax_sort_technology", "sort_technology");
add_action("wp_ajax_nopriv_sort_technology", "sort_technology");

function sort_technology()
{
	$cat_name = $_REQUEST['cat_name'];
	
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	'category'  => $cat_name,
	'category_name'   => $cat_name,
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'chamois',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$post_new = new WP_Query( $args );
$opt_emd = array();
$opt_id = array();
$i=0;
while($post_new->have_posts()):

$post_new->the_post();	

$id = get_the_ID();
$title= get_the_title();
 	
array_push($opt_emd,$id);
array_push($opt_id,$i);
		
$i++;
endwhile;


	$dadaget = array("idcode"=>$opt_emd,"id"=>$i);


	echo json_encode($dadaget);

	exit();
}


add_action("wp_ajax_sort_fabric", "sort_fabric");
add_action("wp_ajax_nopriv_sort_fabric", "sort_fabric");

function sort_fabric()
{
	$cat_name = $_REQUEST['cat_name'];
	
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	'category'  => $cat_name,
	'category_name'   => $cat_name,
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'fabric',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$post_new = new WP_Query( $args );
$opt_emd = array();
$opt_id = array();
$i=0;
while($post_new->have_posts()):

$post_new->the_post();	

$id = get_the_ID();
$title= get_the_title();
 	
array_push($opt_emd,$id);
array_push($opt_id,$i);
		
$i++;
endwhile;


	$dadaget = array("idcode"=>$opt_emd,"id"=>$i);


	echo json_encode($dadaget);

	exit();
}
/*Add Meta Box In The Product Panel*/

function price_chart_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function price_chart_add_meta_box() {
	add_meta_box(
		'price_chart-price-chart',
		__( 'Price Chart', 'price_chart' ),
		'price_chart_html',
		'product',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'price_chart_add_meta_box' );

function price_chart_html( $post) {
	wp_nonce_field( '_price_chart_nonce', 'price_chart_nonce' ); ?>

	<p>Enter Your Price Chart Description and add the price chart data in the short description panel so that you can change them easily</p>

	<p>

		<input type="radio" name="price_chart_price_chart_enable_or_not" id="price_chart_price_chart_enable_or_not_0" value="Yes" <?php echo ( price_chart_get_meta( 'price_chart_price_chart_enable_or_not' ) === 'Yes' ) ? 'checked' : ''; ?>>
<label for="price_chart_price_chart_enable_or_not_0">Yes</label><br>

		<input type="radio" name="price_chart_price_chart_enable_or_not" id="price_chart_price_chart_enable_or_not_1" value="No" <?php echo ( price_chart_get_meta( 'price_chart_price_chart_enable_or_not' ) === 'No' ) ? 'checked' : ''; ?>>
<label for="price_chart_price_chart_enable_or_not_1">No</label><br>
	</p>	<p>
		<label for="price_chart_price_chart_description"><?php _e( 'Price Chart Description', 'price_chart' ); ?></label><br>
		<textarea name="price_chart_price_chart_description" id="price_chart_price_chart_description" ><?php echo price_chart_get_meta( 'price_chart_price_chart_description' ); ?></textarea>
	
	</p><?php
}

function price_chart_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['price_chart_nonce'] ) || ! wp_verify_nonce( $_POST['price_chart_nonce'], '_price_chart_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['price_chart_price_chart_enable_or_not'] ) )
		update_post_meta( $post_id, 'price_chart_price_chart_enable_or_not', esc_attr( $_POST['price_chart_price_chart_enable_or_not'] ) );
	if ( isset( $_POST['price_chart_price_chart_description'] ) )
		update_post_meta( $post_id, 'price_chart_price_chart_description', esc_attr( $_POST['price_chart_price_chart_description'] ) );
}
add_action( 'save_post', 'price_chart_save' );

/*
	Usage: price_chart_get_meta( 'price_chart_price_chart_enable_or_not' )
	Usage: price_chart_get_meta( 'price_chart_price_chart_description' )
*/

function highlights_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function highlights_add_meta_box() {
	add_meta_box(
		'highlights-highlights',
		__( 'HIGHLIGHTS', 'highlights' ),
		'highlights_html',
		'product',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'highlights_add_meta_box' );

function highlights_html( $post) {
	wp_nonce_field( '_highlights_nonce', 'highlights_nonce' ); ?>

	<p>Enter The HIGHLIGHTS Area Of Product</p>

	<p>

		<input type="radio" name="highlights_highlights_enable_or_not" id="highlights_highlights_enable_or_not_0" value="Yes" <?php echo ( highlights_get_meta( 'highlights_highlights_enable_or_not' ) === 'Yes' ) ? 'checked' : ''; ?>>
<label for="highlights_highlights_enable_or_not_0">Yes</label><br>

		<input type="radio" name="highlights_highlights_enable_or_not" id="highlights_highlights_enable_or_not_1" value="No" <?php echo ( highlights_get_meta( 'highlights_highlights_enable_or_not' ) === 'No' ) ? 'checked' : ''; ?>>
<label for="highlights_highlights_enable_or_not_1">No</label><br>
	</p>	<p>
		<label for="highlights_highlights_title"><?php _e( 'HIGHLIGHTS Title', 'highlights' ); ?></label><br>
		<textarea name="highlights_highlights_title" id="highlights_highlights_title" ><?php echo highlights_get_meta( 'highlights_highlights_title' ); ?></textarea>
	
	</p>	<p>
		<label for="highlights_highlights_description"><?php _e( 'HIGHLIGHTS Description', 'highlights' ); ?></label><br>
		<textarea name="highlights_highlights_description" id="highlights_highlights_description" ><?php echo highlights_get_meta( 'highlights_highlights_description' ); ?></textarea>
	
	</p><?php
}

function highlights_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['highlights_nonce'] ) || ! wp_verify_nonce( $_POST['highlights_nonce'], '_highlights_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['highlights_highlights_enable_or_not'] ) )
		update_post_meta( $post_id, 'highlights_highlights_enable_or_not', esc_attr( $_POST['highlights_highlights_enable_or_not'] ) );
	if ( isset( $_POST['highlights_highlights_title'] ) )
		update_post_meta( $post_id, 'highlights_highlights_title', esc_attr( $_POST['highlights_highlights_title'] ) );
	if ( isset( $_POST['highlights_highlights_description'] ) )
		update_post_meta( $post_id, 'highlights_highlights_description', esc_attr( $_POST['highlights_highlights_description'] ) );
}
add_action( 'save_post', 'highlights_save' );

/*
	Usage: highlights_get_meta( 'highlights_highlights_enable_or_not' )
	Usage: highlights_get_meta( 'highlights_highlights_title' )
	Usage: highlights_get_meta( 'highlights_highlights_description' )
*/


add_action( 'add_meta_boxes', 'add_custom_box' );


    function add_custom_box( $post ) {
        add_meta_box(
            'Meta Box', // ID, should be a string.
            'Fabric Names', // Meta Box Title.
            'people_meta_box', // Your call back function, this is where your form field will go.
            'product', // The post type you want this to show up on, can be post, page, or custom post type.
            'side', // The placement of your meta box, can be normal or side.
            'core' // The priority in which this will be displayed.
        );
}
    
 function people_meta_box($post) {
    wp_nonce_field( 'my_awesome_nonce', 'awesome_nonce' );    
    $checkboxMeta = get_post_meta( $post->ID );
    
    $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'Fabric',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	$bobc='fab_'.$recent_posts['ID'];
    ?>

    <input type="checkbox" name="<?php echo 'fab_'.$recent_posts['ID'];?>" id="<?php echo 'fab_'.$recent_posts['ID'];?>" value="<?php echo $recent_posts['post_title'];?>" <?php if ( isset ( $checkboxMeta[$bobc] ) ) checked( $checkboxMeta[$bobc][0], $recent_posts['post_title'] ); ?> /><?php echo $recent_posts['post_title'];?><br />
    
<?php 
}
}
add_action( 'save_post', 'save_people_checkboxes' );
    function save_people_checkboxes( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;
        if ( ( isset ( $_POST['my_awesome_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['my_awesome_nonce'], plugin_basename( __FILE__ ) ) ) )
            return;
        if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }    
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
        
        $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'Fabric',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	$bobc='fab_'.$recent_posts['ID'];
	$post_type = get_post_type( $post_id );
		if($post_type =="product")
		{

        //saves bob's value
        if( isset( $_POST[ $bobc] ) ) {
            update_post_meta( $post_id, $bobc, $recent_posts['post_title'] );
        } else {
            update_post_meta( $post_id, $bobc, 'Null Data' );
        }
	}
	}

}

add_action( 'add_meta_boxes', 'add_custom_box_com' );


    function add_custom_box_com( $post ) {
        add_meta_box(
            'custom box', // ID, should be a string.
            'Componet Names', // Meta Box Title.
            'componet_meta_box', // Your call back function, this is where your form field will go.
            'product' // The post type you want this to show up on, can be post, page, or custom post type.
            
        );
}

function componet_meta_box($post) {
    wp_nonce_field( 'my_awesome_nonce', 'awesome_nonce' );    
    $checkboxMeta_com = get_post_meta( $post->ID );
    
    $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'component',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	$com='com_'.$recent_posts['ID'];
    ?>

    <input type="checkbox" name="<?php echo 'com_'.$recent_posts['ID'];?>" id="<?php echo 'com_'.$recent_posts['ID'];?>" value="<?php echo $recent_posts['post_title'];?>" <?php if ( isset ( $checkboxMeta_com[$com] ) ) checked( $checkboxMeta_com[$com][0], $recent_posts['post_title'] ); ?> /><?php echo $recent_posts['post_title'];?><br />
    
<?php 
}
}
add_action( 'save_post', 'save_com_checkboxes' );

function save_com_checkboxes( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;
        if ( ( isset ( $_POST['my_awesome_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['my_awesome_nonce'], plugin_basename( __FILE__ ) ) ) )
            return;
        if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }    
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
        
        $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'component',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	$bobc='com_'.$recent_posts['ID'];
    $post_type = get_post_type( $post_id );
		if($post_type =="product")
		{
			//saves bob's value
			if( isset( $_POST[ $bobc] ) ) 
			{
				update_post_meta( $post_id, $bobc, $recent_posts['post_title'] );
			} else 
			{
			    update_post_meta( $post_id, $bobc, 'Null Data' );
			}
		}
	}

}

add_action( 'add_meta_boxes', 'add_custom_box_con' );


    function add_custom_box_con( $post ) {
        add_meta_box(
            'con box', // ID, should be a string.
            'Contruction Names', // Meta Box Title.
            'contruction_meta_box', // Your call back function, this is where your form field will go.
            'product' // The post type you want this to show up on, can be post, page, or custom post type.
            
        );
}

function contruction_meta_box($post) {
    wp_nonce_field( 'my_awesome_nonce', 'awesome_nonce' );    
    $checkboxMeta_con = get_post_meta( $post->ID );
    
    $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'construction',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	$con='con_'.$recent_posts['ID'];
    ?>

    <input type="checkbox" name="<?php echo 'con_'.$recent_posts['ID'];?>" id="<?php echo 'con_'.$recent_posts['ID'];?>" value="<?php echo $recent_posts['post_title'];?>" <?php if ( isset ( $checkboxMeta_con[$con] ) ) checked( $checkboxMeta_con[$con][0], $recent_posts['post_title'] ); ?> /><?php echo $recent_posts['post_title'];?><br />
    
<?php 
}
}
add_action( 'save_post', 'save_con_checkboxes' );

function save_con_checkboxes( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;
        if ( ( isset ( $_POST['my_awesome_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['my_awesome_nonce'], plugin_basename( __FILE__ ) ) ) )
            return;
        if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }    
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
        
        $args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'construction',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{
	
	$bobc='con_'.$recent_posts['ID'];
	
	$post_type = get_post_type( $post_id );
		if($post_type =="product")
		{

			//saves bob's value
			if( isset( $_POST[ $bobc] ) ) {
				update_post_meta( $post_id, $bobc, $recent_posts['post_title'] );
			} else {
			    update_post_meta( $post_id, $bobc, 'Null Data' );
			}
		}
	}

}

/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function shop_page_option_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function shop_page_option_add_meta_box() {
	add_meta_box(
		'shop_page_option-shop-page-option',
		__( 'Shop Page Option', 'shop_page_option' ),
		'shop_page_option_html',
		'product',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'shop_page_option_add_meta_box' );

function shop_page_option_html( $post) {
	wp_nonce_field( '_shop_page_option_nonce', 'shop_page_option_nonce' ); ?>

	<p>Mark as yes if you want to show it in Shop Page</p>

	<p>

		<input type="radio" name="shop_page_option_select_to_show_in_shop_page" id="shop_page_option_select_to_show_in_shop_page_0" value="Yes" <?php echo ( shop_page_option_get_meta( 'shop_page_option_select_to_show_in_shop_page' ) === 'Yes' ) ? 'checked' : ''; ?>>
<label for="shop_page_option_select_to_show_in_shop_page_0">Yes</label><br>

		<input type="radio" name="shop_page_option_select_to_show_in_shop_page" id="shop_page_option_select_to_show_in_shop_page_1" value="No" <?php echo ( shop_page_option_get_meta( 'shop_page_option_select_to_show_in_shop_page' ) === 'No' ) ? 'checked' : ''; ?>>
<label for="shop_page_option_select_to_show_in_shop_page_1">No</label><br>
	</p><?php
}

function shop_page_option_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['shop_page_option_nonce'] ) || ! wp_verify_nonce( $_POST['shop_page_option_nonce'], '_shop_page_option_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['shop_page_option_select_to_show_in_shop_page'] ) )
		update_post_meta( $post_id, 'shop_page_option_select_to_show_in_shop_page', esc_attr( $_POST['shop_page_option_select_to_show_in_shop_page'] ) );
}
add_action( 'save_post', 'shop_page_option_save' );

/*
	Usage: shop_page_option_get_meta( 'shop_page_option_select_to_show_in_shop_page' )
*/



?>

<?php
// Add term page
function tutorialshares_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'Postion in the shop page', 'tutorialshares' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Enter a value for this field','tutorialshares' ); ?></p>
	</div>
	
	
	<div class="form-field">
		<label for="term_meta[custom_term_meta2]"><?php _e( 'Postion in the Mega Menu', 'tutorialshares' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta2]" id="term_meta[custom_term_meta2]" value="">
		<p class="description"><?php _e( 'Enter a value for this field','tutorialshares' ); ?></p>
	</div>
	
	
	
	
	
<?php
}
add_action( 'product_cat_add_form_fields', 'tutorialshares_taxonomy_add_new_meta_field', 10, 2 );


// Edit term page
function tutorialshares_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Postion in the shop page', 'tutorialshares' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a value for this field','tutorialshares' ); ?></p>
		</td>
	</tr>
	
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta2]"><?php _e( 'Postion in the Mega Menu', 'tutorialshares' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta2]" id="term_meta[custom_term_meta2]" value="<?php echo esc_attr( $term_meta['custom_term_meta2'] ) ? esc_attr( $term_meta['custom_term_meta2'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a value for this field','tutorialshares' ); ?></p>
		</td>
	</tr>
	
	
	
	
	
	
	
	
	
	
<?php
}
add_action( 'product_cat_edit_form_fields', 'tutorialshares_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_product_cat', 'save_taxonomy_custom_meta', 10, 2 );


//remove_action('woocommerce_template_loop_product_title', 'titlechange', 10);
//apply_filters('woocommerce_template_loop_product_title', 'titlechange', 10);

//breadchumb

// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}
/*Compare link Area In product*/

function compare_jersey_link__get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function compare_jersey_link__add_meta_box() {
	add_meta_box(
		'compare_jersey_link_-compare-jersey-link',
		__( 'Compare Jersey Link ', 'compare_jersey_link_' ),
		'compare_jersey_link__html',
		'product',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'compare_jersey_link__add_meta_box' );

function compare_jersey_link__html( $post) {
	wp_nonce_field( '_compare_jersey_link__nonce', 'compare_jersey_link__nonce' ); ?>

	<p>Need to add the http:// or https://
link for the product compare</p>

	<p>
		<label for="compare_jersey_link__link"><?php _e( 'Link', 'compare_jersey_link_' ); ?></label><br>
		<input type="text" name="compare_jersey_link__link" id="compare_jersey_link__link" value="<?php echo compare_jersey_link__get_meta( 'compare_jersey_link__link' ); ?>">
	</p><?php
}

function compare_jersey_link__save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['compare_jersey_link__nonce'] ) || ! wp_verify_nonce( $_POST['compare_jersey_link__nonce'], '_compare_jersey_link__nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['compare_jersey_link__link'] ) )
		update_post_meta( $post_id, 'compare_jersey_link__link', esc_attr( $_POST['compare_jersey_link__link'] ) );
}
add_action( 'save_post', 'compare_jersey_link__save' );

/*
	Usage: compare_jersey_link__get_meta( 'compare_jersey_link__link' )
*/




function rating_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function rating_add_meta_box() {
	add_meta_box(
		'rating-rating',
		__( 'Rating', 'rating' ),
		'rating_html',
		'chamois',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'rating_add_meta_box' );

function rating_html( $post) {
	wp_nonce_field( '_rating_nonce', 'rating_nonce' ); ?>

	<p>Add Your rating here</p>

	<p>
		<label for="rating_rating_out_of_10"><?php _e( 'rating out of 10', 'rating' ); ?></label><br>
		<input type="text" name="rating_rating_out_of_10" id="rating_rating_out_of_10" value="<?php echo rating_get_meta( 'rating_rating_out_of_10' ); ?>">
	</p><?php
}

function rating_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['rating_nonce'] ) || ! wp_verify_nonce( $_POST['rating_nonce'], '_rating_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['rating_rating_out_of_10'] ) )
		update_post_meta( $post_id, 'rating_rating_out_of_10', esc_attr( $_POST['rating_rating_out_of_10'] ) );
}
add_action( 'save_post', 'rating_save' );

/*
	Usage: rating_get_meta( 'rating_rating_out_of_10' )
*/
add_image_size( 'custom-product-size',300, 300 );



