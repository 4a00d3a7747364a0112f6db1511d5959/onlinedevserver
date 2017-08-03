<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 09:15:01
 * @Last Modified by:   opalhotel_remove_extra
 * @Last Modified time: 2016-04-27 23:42:39
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Room_Cat_Taxnomy extends OpalHotel_Abstract_Taxonomy {

	/* taxonomy name */
	public $taxonomy = null;

	/* taxonomy args */
	public $taxonomy_args = array();

	/* post types uses */
	public $post_types = array();

	/* contructor */
	public function __construct() {

		/* taxonomy name */
		$this->taxonomy = 'opalhotel_room_cat';

		$this->post_types = array(
				'opalhotel_room'
			);

		/* taxonomy args register */
		$this->taxonomy_args = array(
                'hierarchical'          => true,
                'label'                 => __( 'Room Categories', 'opal-hotel-room-booking' ),
                'labels' => array(
                    'name'              => _x( 'Room Categories', 'taxonomy general name', 'opal-hotel-room-booking' ),
                    'singular_name'     => _x( 'Room Category', 'taxonomy singular name', 'opal-hotel-room-booking' ),
                    'menu_name'         => _x( 'Room Categories', 'Room Categories', 'opal-hotel-room-booking' ),
                    'search_items'      => __( 'Search Room Categories', 'opal-hotel-room-booking' ),
                    'all_items'         => __( 'All Room Categories', 'opal-hotel-room-booking' ),
                    'parent_item'       => __( 'Parent Room Category', 'opal-hotel-room-booking' ),
                    'parent_item_colon' => __( 'Parent Room Category:', 'opal-hotel-room-booking' ),
                    'edit_item'         => __( 'Edit Room Category', 'opal-hotel-room-booking' ),
                    'update_item'       => __( 'Update Room Category', 'opal-hotel-room-booking' ),
                    'add_new_item'      => __( 'Add New Room Category', 'opal-hotel-room-booking' ),
                    'new_item_name'     => __( 'New Room Category Name', 'opal-hotel-room-booking' )
                ),
                'public'                => true,
                'show_ui'               => true,
                'query_var'             => true,
                'rewrite'               => array( 'slug' => _x( 'room-cat', 'URL slug', 'opal-hotel-room-booking' ) )
            );

		parent::__construct();
	}

}

new OpalHotel_Room_Cat_Taxnomy();