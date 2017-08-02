<?php
/**
 * Plugin Name: Recent Post
 * Plugin URI: http://uniterrene.com
 * Description: This plugin for customize recent post widget
 * Version: 1.0.0
 * Author: Shourya Chowdhury
 * Author URI: http://uniterrene.com
 * License: GPL2
 */

/*Create New ShortCode For The Recent Post In The Footer Area Last Column*/

function sb_recent_posts_shortcode($atts){
$atts = shortcode_atts( array(
'post_limit' => 'post_limit',
'post_category'=>'post_category', ),
$atts ,'sb_recent_posts'); 

$no_of_posts = $atts['post_limit'];
$posts_from_category = $atts['post_category'];

ob_start(); ?>
<ul>
<?php
$rec_arg = array( 'post_type' => 'post', 'posts_per_page' => $no_of_posts, 'category_name' => $posts_from_category, 'order' => 'DESC', 'orderby' => 'date', );
$rec_query = new WP_Query( $rec_arg ); 
?>
<?php
while ($rec_query -> have_posts()) : $rec_query -> the_post(); 
?>
          <li>
    <a href="<?php the_permalink(); ?>">
                  <div class="imagehold">  
					<?php if( has_post_thumbnail() )
					{?>
						<img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>">
					<?php
					}?> 
					</div>
                  <div class="footer_posthold">
                    <h5><?php the_title(); ?></h5>
                    <p>On August 9, 2011</p>
                  </div>
                  </a></li>

<?php
endwhile; 
wp_reset_query();
?>
</ul>
<?php return ob_get_clean();
}
add_shortcode('sb_recent_posts', 'sb_recent_posts_shortcode');

/*Testimonial Post Type Is Added*/

function testimonial() {

	$labels = array(
		'name'                  => _x( 'Testimonial Post Types', 'Post Type General Name', 'ascend' ),
		'singular_name'         => _x( 'Testimonial Post Type', 'Post Type Singular Name', 'ascend' ),
		'menu_name'             => __( 'Testimonial', 'ascend' ),
		'name_admin_bar'        => __( 'Testimonial', 'ascend' ),
		'archives'              => __( 'Item Archives', 'ascend' ),
		'attributes'            => __( 'Item Attributes', 'ascend' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ascend' ),
		'all_items'             => __( 'All Items', 'ascend' ),
		'add_new_item'          => __( 'Add New Item', 'ascend' ),
		'add_new'               => __( 'Add New Testimonial', 'ascend' ),
		'new_item'              => __( 'New Testimonial', 'ascend' ),
		'edit_item'             => __( 'Edit Testimonial', 'ascend' ),
		'update_item'           => __( 'Update Testimonial', 'ascend' ),
		'view_item'             => __( 'View Testimonial', 'ascend' ),
		'view_items'            => __( 'View Testimonials', 'ascend' ),
		'search_items'          => __( 'Search Testimonial', 'ascend' ),
		'not_found'             => __( 'Not found', 'ascend' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ascend' ),
		'featured_image'        => __( 'Featured Image', 'ascend' ),
		'set_featured_image'    => __( 'Set featured image For Testimonial', 'ascend' ),
		'remove_featured_image' => __( 'Remove featured image For Testimonial', 'ascend' ),
		'use_featured_image'    => __( 'Use as featured image For Testimonial', 'ascend' ),
		'insert_into_item'      => __( 'Insert into Testimonial', 'ascend' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'ascend' ),
		'items_list'            => __( 'Testimonials list', 'ascend' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'ascend' ),
		'filter_items_list'     => __( 'Filter Testimonials list', 'ascend' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial Post Type', 'ascend' ),
		'description'           => __( 'Testimonial Type Post', 'ascend' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments','custom-fields' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonial', $args );

}
add_action( 'init', 'testimonial', 0 );

/*End Of Testimonial Type*/


add_action( 'add_meta_boxes', 'dynamic_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'dynamic_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function dynamic_add_custom_box() {
    add_meta_box(
        'dynamic_sectionid',
        __( 'My Tracks', 'myplugin_textdomain' ),
        'dynamic_inner_custom_box',
        'post');
}

/* Prints the box content */
function dynamic_inner_custom_box() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div id="meta_inner">
    <?php

    //get the saved meta as an arry
    $songs = get_post_meta($post->ID,'songs',true);

    $c = 0;
    if ( count( $songs ) > 0 ) {
        foreach( $songs as $track ) {
            if ( isset( $track['title'] ) || isset( $track['track'] ) ) {
			printf( '<p>Featured Title <input type="text" name="songs[%1$s][title]" value="%2$s" /> -- Featured Value : <input type="text" name="songs[%1$s][track]" value="%3$s" /><span class="remove">%4$s</span></p>', $c, $track['title'], $track['track'], __( 'Remove Featured ' ) );
                $c = $c +1;
            }
        }
    }

    ?>
<span id="here"></span>
<span class="add"><?php _e('Add Features'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $c; ?>;
        $(".add").click(function() {
            count = count + 1;

            $('#here').append('<p> Featured Title <input type="text" name="songs['+count+'][title]" value="" /> -- Featured Value : <input type="text" name="songs['+count+'][track]" value="" /><span class="remove">Remove Featured</span></p>' );
            return false;
        });
        $(".remove").live('click', function() {
            $(this).parent().remove();
        });
    });
    </script>
</div><?php

}

/* When the post is saved, saves our custom data */
function dynamic_save_postdata( $post_id ) {
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    // OK, we're authenticated: we need to find and save the data

    $songs = $_POST['songs'];

    update_post_meta($post_id,'songs',$songs);
}

// Register Custom Post Type For Chamois
function chamois() {

	$labels = array(
		'name'                  => _x( 'Chamois', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Chamois', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Chamois', 'text_domain' ),
		'name_admin_bar'        => __( 'Chamois', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Chamois:', 'text_domain' ),
		'all_items'             => __( 'All Chamois', 'text_domain' ),
		'add_new_item'          => __( 'Add New Chamois', 'text_domain' ),
		'add_new'               => __( 'Add New Chamois', 'text_domain' ),
		'new_item'              => __( 'New Chamois', 'text_domain' ),
		'edit_item'             => __( 'Edit Chamois', 'text_domain' ),
		'update_item'           => __( 'Update Chamois', 'text_domain' ),
		'view_item'             => __( 'View Chamois', 'text_domain' ),
		'view_items'            => __( 'View Chamois', 'text_domain' ),
		'search_items'          => __( 'Search Chamois', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image For Chamois', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image For Chamois', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image For Chamois', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image For Chamois', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Chamois', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Chamois', 'text_domain' ),
		'items_list'            => __( 'Chamois list', 'text_domain' ),
		'items_list_navigation' => __( 'Chamois list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Chamois list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Chamois', 'text_domain' ),
		'description'           => __( 'Chamois Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'chamois', $args );

}
add_action( 'init', 'chamois', 0 );

// Add The Custom Meta Box For The Chamois



function fabric_name_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function fabric_name_add_meta_box() {
	add_meta_box(
		'fabric_name-fabric-name',
		__( 'Fabric Name', 'fabric_name' ),
		'fabric_name_html',
		'chamois',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'fabric_name_add_meta_box' );

function fabric_name_html( $post) {
	wp_nonce_field( '_fabric_name_nonce', 'fabric_name_nonce' ); ?>

	<p>Please select the fabric that is associated with the chamois</p>

	<p>
		<label for="fabric_name_technology_fabric_name"><?php _e( 'Technology Fabric Name', 'fabric_name' ); ?></label><br>
		<select name="fabric_name_technology_fabric_name" id="fabric_name_technology_fabric_name">
			
		<?php
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'order' => 'ASC',
	'include' => '',
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
{ ?>
		<option <?php echo (fabric_name_get_meta( 'fabric_name_technology_fabric_name' ) === $recent_posts['post_title'] ) ? 'selected' : '' ?>><?php echo $recent_posts['post_title'];?></option>
		
		
	<?php	}
		
		?>
		
			
		
		
		</select>
	</p><?php
}

function fabric_name_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['fabric_name_nonce'] ) || ! wp_verify_nonce( $_POST['fabric_name_nonce'], '_fabric_name_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['fabric_name_technology_fabric_name'] ) )
		update_post_meta( $post_id, 'fabric_name_technology_fabric_name', esc_attr( $_POST['fabric_name_technology_fabric_name'] ) );
}
add_action( 'save_post', 'fabric_name_save' );

/*
	Usage: fabric_name_get_meta( 'fabric_name_technology_fabric_name' )
*/




/*Special Components*/






// Register Custom Post Type
function Fabric() {

	$labels = array(
		'name'                  => _x( 'Fabrics', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Fabric', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Fabrics', 'text_domain' ),
		'name_admin_bar'        => __( 'Fabric', 'text_domain' ),
		'archives'              => __( 'Fabric Archives', 'text_domain' ),
		'attributes'            => __( 'Fabric Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Fabric:', 'text_domain' ),
		'all_items'             => __( 'All Fabrics', 'text_domain' ),
		'add_new_item'          => __( 'Add New Fabric', 'text_domain' ),
		'add_new'               => __( 'Add New Fabric', 'text_domain' ),
		'new_item'              => __( 'New Fabric', 'text_domain' ),
		'edit_item'             => __( 'Edit Fabric', 'text_domain' ),
		'update_item'           => __( 'Update Fabric', 'text_domain' ),
		'view_item'             => __( 'View Fabric', 'text_domain' ),
		'view_items'            => __( 'View Fabrics', 'text_domain' ),
		'search_items'          => __( 'Search Fabric', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image Fabric', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image Fabric', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image Fabric', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image Fabric', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Fabric', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Fabric', 'text_domain' ),
		'items_list'            => __( 'Fabrics list', 'text_domain' ),
		'items_list_navigation' => __( 'Fabrics list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Fabrics list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Fabric', 'text_domain' ),
		'description'           => __( 'Fabric Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'fabric', $args );

}
add_action( 'init', 'Fabric', 0 );




// Register Custom Post Type
function component_post_type() {

	$labels = array(
		'name'                  => _x( 'Special Components', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Special Component', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Special Component', 'text_domain' ),
		'name_admin_bar'        => __( 'Special Component', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Special Components', 'text_domain' ),
		'add_new_item'          => __( 'Add New Special Component', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Special Component', 'text_domain' ),
		'edit_item'             => __( 'Edit Special Component', 'text_domain' ),
		'update_item'           => __( 'Update Special Component', 'text_domain' ),
		'view_item'             => __( 'View Special Component', 'text_domain' ),
		'view_items'            => __( 'View Special Components', 'text_domain' ),
		'search_items'          => __( 'Search Special Component', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Special Component', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Special Components list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Special Component', 'text_domain' ),
		'description'           => __( 'Special Components: Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'component', $args );

}
add_action( 'init', 'component_post_type', 0 );

/*Component Post Type*/

// Register Custom Post Type
function construction_post_type() {

	$labels = array(
		'name'                  => _x( 'Constructions', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Construction', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Constructions', 'text_domain' ),
		'name_admin_bar'        => __( 'Construction', 'text_domain' ),
		'archives'              => __( 'Construction Archives', 'text_domain' ),
		'attributes'            => __( 'Construction Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Construction:', 'text_domain' ),
		'all_items'             => __( 'All Constructions', 'text_domain' ),
		'add_new_item'          => __( 'Add New Construction', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Construction', 'text_domain' ),
		'edit_item'             => __( 'Edit Construction', 'text_domain' ),
		'update_item'           => __( 'Update Construction', 'text_domain' ),
		'view_item'             => __( 'View Construction', 'text_domain' ),
		'view_items'            => __( 'View Constructions', 'text_domain' ),
		'search_items'          => __( 'Search Construction', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Construction', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Construction', 'text_domain' ),
		'items_list'            => __( 'Constructions list', 'text_domain' ),
		'items_list_navigation' => __( 'Constructions list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Constructions list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Construction', 'text_domain' ),
		'description'           => __( 'Construction Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'construction', $args );

}
add_action( 'init', 'construction_post_type', 0 );
// Register Custom Post Type
function general_faq() {

	$labels = array(
		'name'                  => _x( 'General FAQ', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'General FAQ', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'General FAQ', 'text_domain' ),
		'name_admin_bar'        => __( 'Faq Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ), 
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Faq Type', 'text_domain' ),
		'description'           => __( 'Faq Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		//~ 'taxonomies'            => array( 'category', 'post_tag' ),
		'taxonomies'          => array('faq_gen' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'general_faq', $args );

}
add_action( 'init', 'general_faq', 0 );

// Add new taxonomy
function people_init() {
	// create a new taxonomy
	register_taxonomy(
		'faq_gen',
		'general_faq',
		array(
			'label' => __( 'General Faq Category' ),
			'rewrite' => array( 'slug' => 'faq_gen' )
			
		)
	);
}
add_action( 'init', 'people_init' );


function wpa82763_custom_type_in_categories( $query ) {
    if ( $query->is_main_query()
    && ( $query->is_category() || $query->is_tag() ) ) {
        $query->set( 'post_type', array( 'post', 'chamois' ) );
    }
}
add_action( 'pre_get_posts', 'wpa82763_custom_type_in_categories' );

