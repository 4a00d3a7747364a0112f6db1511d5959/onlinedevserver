<?php
/*
Plugin Name: SB Custom Post Types
Version: 1.0
Author: Subrat Kumar Barik
Author URI: http://www.uniterrene.com/
Description: ***For developer's user only.
Tags: custom post type
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('SB_Post_Types')) {

	class SB_Post_Types {

		function __construct(){
            add_action( 'init', array( $this,'sb_home_banner_slider'));
            add_action( 'init', array( $this,'sb_estate_listings'));
            add_action( 'init', array( $this,'sb_estate_listing_taxonomy'));
            add_action( 'init', array( $this,'sb_estate_agents'));
            add_action( 'init', array( $this,'sb_estate_agent_taxonomy'));
            add_action( 'init', array( $this,'sb_kulan_history'));
        }

        //Home Banner Post Types
        public function sb_home_banner_slider(){

        	//banner post type
        	register_post_type( 'sb_banner',
			array(
				'labels' => array(
					'name' => __( 'Home Banners' ),
					'singular_name' => __( 'Home Banner' )
					),
				'public' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-images-alt',
				'rewrite' => array('slug' => 'sb_banner'),
				'supports' => array( 'title','editor','thumbnail' ),
				)
			);
		}

		//Estate Listing Post Types
		public function sb_estate_listings(){

        	//estate post type
        	register_post_type( 'estate_listings',
			array(
				'labels' => array(
					'name' => __( 'Real Estate Listings' ),
					'singular_name' => __( 'Real Estate Listing' )
					),
				'public' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-building',
				'rewrite' => array('slug' => 'estate_listings'),
				'supports' => array( 'title','thumbnail', 'editor' ),
				)
			);
		}

		//custom taxonomy for estate listings
		public function sb_estate_listing_taxonomy() {
		  $labels = array(
		    'name'              => _x( 'Estate Categories', 'taxonomy general name' ),
		    'singular_name'     => _x( 'Estate Category', 'taxonomy singular name' ),
		    'search_items'      => __( 'Search Estate Categories' ),
		    'all_items'         => __( 'All Estate Categories' ),
		    'parent_item'       => __( 'Parent Estate Category' ),
		    'parent_item_colon' => __( 'Parent Estate Category:' ),
		    'edit_item'         => __( 'Edit Estate Category' ), 
		    'update_item'       => __( 'Update Estate Category' ),
		    'add_new_item'      => __( 'Add New Estate Category' ),
		    'new_item_name'     => __( 'New Estate Category' ),
		    'menu_name'         => __( 'Estate Categories' ),
		  );
		  $args = array(
		    'labels' => $labels,
		    'hierarchical' => true,
		  );
		  register_taxonomy( 'estate_category', 'estate_listings', $args );
		}

		//Estate Agents Post Types
		public function sb_estate_agents(){

        	//agents post type
        	register_post_type( 'estate_agents',
			array(
				'labels' => array(
					'name' => __( 'Real Estate Agents' ),
					'singular_name' => __( 'Real Estate Agent' )
					),
				'public' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-businessman',
				'rewrite' => array('slug' => 'estate_agents'),
				'supports' => array( 'title','thumbnail', 'editor' ),
				)
			);
		}

		//custom taxonomy for estate agents
		public function sb_estate_agent_taxonomy() {
		  $labels = array(
		    'name'              => _x( 'Agent Categories', 'taxonomy general name' ),
		    'singular_name'     => _x( 'Agent Category', 'taxonomy singular name' ),
		    'search_items'      => __( 'Search Agent Categories' ),
		    'all_items'         => __( 'All Agent Categories' ),
		    'parent_item'       => __( 'Parent Agent Category' ),
		    'parent_item_colon' => __( 'Parent Agent Category:' ),
		    'edit_item'         => __( 'Edit Agent Category' ), 
		    'update_item'       => __( 'Update Agent Category' ),
		    'add_new_item'      => __( 'Add New Agent Category' ),
		    'new_item_name'     => __( 'New Agent Category' ),
		    'menu_name'         => __( 'Agent Categories' ),
		  );
		  $args = array(
		    'labels' => $labels,
		    'hierarchical' => true,
		  );
		  register_taxonomy( 'agent_category', 'estate_agents', $args );
		}

		//Kulan History Post Types
		public function sb_kulan_history(){

			//$kulan = get_template_directory_uri().'/images/favicon.png';

        	//agents post type
        	register_post_type( 'kulan_history',
			array(
				'labels' => array(
					'name' => __( 'Kulan Historys' ),
					'singular_name' => __( 'Kulan History' )
					),
				'public' => true,
				'has_archive' => true,
				'menu_icon' => 'dashicons-backup',
				'rewrite' => array('slug' => 'kulan_history'),
				'supports' => array( 'title','thumbnail' ),
				)
			);
		}
		

	}//End of SB_Post_Types class

}//End of class not exists check

$GLOBALS['SB_Post_Types'] = new SB_Post_Types();
?>