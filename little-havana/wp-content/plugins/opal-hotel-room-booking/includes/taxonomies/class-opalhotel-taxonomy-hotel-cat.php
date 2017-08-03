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

class OpalHotel_Hotel_Taxonomy extends OpalHotel_Abstract_Taxonomy {

	/* taxonomy name */
	public $taxonomy = null;

	/* taxonomy args */
	public $taxonomy_args = array();

	/* post types uses */
	public $post_types = array();

	/* contructor */
	public function __construct() {

		/* taxonomy name */
		$this->taxonomy = 'opalhotel_hotel_cat';

		$this->post_types = array(
				'opalhotel_hotel'
			);

		/* taxonomy args register */
		$this->taxonomy_args = array(
                'hierarchical'          => true,
                'label'                 => __( 'Catetories', 'opal-hotel-room-booking' ),
                'labels' => array(
                    'name'              => _x( 'Catetories', 'taxonomy general name', 'opal-hotel-room-booking' ),
                    'singular_name'     => _x( 'Catetorie', 'taxonomy singular name', 'opal-hotel-room-booking' ),
                    'menu_name'         => _x( 'Catetories', 'Catetories', 'opal-hotel-room-booking' ),
                    'search_items'      => __( 'Search Catetories', 'opal-hotel-room-booking' ),
                    'all_items'         => __( 'All Catetories', 'opal-hotel-room-booking' ),
                    'parent_item'       => __( 'Parent Catetorie', 'opal-hotel-room-booking' ),
                    'parent_item_colon' => __( 'Parent Catetorie:', 'opal-hotel-room-booking' ),
                    'edit_item'         => __( 'Edit Catetorie', 'opal-hotel-room-booking' ),
                    'update_item'       => __( 'Update Catetorie', 'opal-hotel-room-booking' ),
                    'add_new_item'      => __( 'Add New Catetorie', 'opal-hotel-room-booking' ),
                    'new_item_name'     => __( 'New Catetorie Name', 'opal-hotel-room-booking' )
                ),
                'public'                => true,
                'show_ui'               => true,
                'query_var'             => true,
                'rewrite'               => array( 'slug' => _x( 'hotel-cat', 'URL slug', 'opal-hotel-room-booking' ) )
            );

		parent::__construct();
	}

}

new OpalHotel_Hotel_Taxonomy();