<?php
/*
Plugin Name: SB Custom Post Types & Shortcodes
Version: 1.0
Author: SB CPT
Author URI: #
Description: Custom post types & shortcodes
Tags: custom post type
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('SB_Post_Types')) {

	class SB_Post_Types {

		function __construct(){
            add_action( 'init', array( $this,'sb_church_banner_posttype'), 30 );
            //add_action( 'init', array( $this,'sb_church_viewer_posttype'), 30 );
            add_action( 'init', array( $this,'sb_church_resources_posttype'), 30 );
        }

        public function sb_church_banner_posttype() {
			register_post_type( 'banner_slider',
				// CPT Options
				array(
					'labels' => array(
						'name' => __( 'Home Slider' ),
						'singular_name' => __( 'Home Slider' )
						),
					'public' => true,
					'has_archive' => true,
					'menu_icon' => 'dashicons-format-image',
					'rewrite' => array('slug' => 'banner_slider'),
					'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
				)
			);
		}

		public function sb_church_viewer_posttype() {
			register_post_type( 'user_posts',
				// CPT Options
				array(
					'labels' => array(
						'name' => __( 'User\'s Posts' ),
						'singular_name' => __( 'User\'s Posts' ),
						),
					'public' => true,
					'has_archive' => true,
					'menu_icon' => 'dashicons-editor-quote',
					'rewrite' => array('slug' => 'user_posts', 'with_front' => true),
					'supports' => array( 'title', 'editor', 'excerpt' ),
				)
			);
		}

		public function sb_church_resources_posttype() {
			register_post_type( 'church_resources',
				// CPT Options
				array(
					'labels' => array(
						'name' => __( 'Church Resources' ),
						'singular_name' => __( 'Church Resource' ),
						),
					'public' => true,
					'has_archive' => true,
					'menu_icon' => 'dashicons-category',
					'rewrite' => array('slug' => 'church_resources'),
					'supports' => array( 'title', 'thumbnail', 'excerpt' ),
				)
			);

			function resource_pdf_get_meta( $value ) {
				global $post;

				$field = get_post_meta( $post->ID, $value, true );
				if ( ! empty( $field ) ) {
					return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
				} else {
					return false;
				}
			}

			function resource_pdf_add_meta_box() {
				add_meta_box(
					'resource_pdf-resource-pdf',
					__( 'Resource PDF', 'resource_pdf' ),
					'resource_pdf_html',
					'church_resources',
					'normal',
					'default'
				);
			}
			add_action( 'add_meta_boxes', 'resource_pdf_add_meta_box' );

			function resource_pdf_html( $post) {
				wp_nonce_field( '_resource_pdf_nonce', 'resource_pdf_nonce' ); ?>

				<p>
					<label for="resource_pdf_pdf_downloadable_link"><?php _e( 'PDF Downloadable Link', 'resource_pdf' ); ?></label><br>
					<input type="text" name="resource_pdf_pdf_downloadable_link" class="widefat" id="resource_pdf_pdf_downloadable_link" value="<?php echo resource_pdf_get_meta( 'resource_pdf_pdf_downloadable_link' ); ?>">
				</p><?php
			}

			function resource_pdf_save( $post_id ) {
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
				if ( ! isset( $_POST['resource_pdf_nonce'] ) || ! wp_verify_nonce( $_POST['resource_pdf_nonce'], '_resource_pdf_nonce' ) ) return;
				if ( ! current_user_can( 'edit_post', $post_id ) ) return;

				if ( isset( $_POST['resource_pdf_pdf_downloadable_link'] ) )
					update_post_meta( $post_id, 'resource_pdf_pdf_downloadable_link', esc_attr( $_POST['resource_pdf_pdf_downloadable_link'] ) );
			}
			add_action( 'save_post', 'resource_pdf_save' );

			/*
				Usage: resource_pdf_get_meta( 'resource_pdf_pdf_downloadable_link' )
			*/
		}
		

	}

}//End of class not exists check



$GLOBALS['SB_Post_Types'] = new SB_Post_Types();

?>