<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Admin_MetaBoxes {

	/**
	 * Is meta boxes saved once?
	 *
	 * @var boolean
	 */
	private static $saved_meta_boxes = false;

	/**
	 * Meta box error messages.
	 *
	 * @var array
	 */
	public static $meta_box_errors  = array();

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );
		add_action( 'cmb2_admin_init', array( $this, 'hotel_map' ), 12 );

		/**
		 * Save Order Meta Boxes.
		 *
		 * In order:
		 *      Save the order items.
		 *      Save the order totals.
		 *      Save the order downloads.
		 *      Save order data - also updates status and sends out admin emails if needed. Last to show latest data.
		 *      Save actions - sends out other emails. Last to show latest data.
		 */
		// add_action( 'opalhotel_process_opalhotel_room_meta', 'OpalHotel_MetaBox_Booking::save', 10, 2 );
		add_action( 'opalhotel_process_opalhotel_room_meta', 'OpalHotel_MetaBox_Room_Gallery::save', 10, 2 );
		add_action( 'opalhotel_process_opalhotel_hotel_meta', 'OpalHotel_MetaBox_Room_Gallery::save', 10, 2 );
		add_action( 'opalhotel_process_opalhotel_room_meta', 'OpalHotel_MetaBox_Room_Data::save', 10, 2 );
		add_action( 'opalhotel_process_opalhotel_coupon_meta', 'OpalHotel_MetaBox_Coupon_Data::save', 10, 2 );
		add_action( 'opalhotel_process_opalhotel_package_meta', 'OpalHotel_MetaBox_Package_Data::save', 10, 2 );
		add_action( 'opalhotel_process_booking_order_meta', 'OpalHotel_MetaBox_Booking_Data::save', 10, 2 );
		add_action( 'opalhotel_process_booking_order_meta', 'OpalHotel_MetaBox_Booking_Item::save', 10, 2 );
		add_action( 'opalhotel_process_booking_order_meta', 'OpalHotel_MetaBox_Booking_Action::save', 10, 2 );

		// Error handling (for showing errors from meta boxes on next page load)
		add_action( 'admin_notices', array( $this, 'output_errors' ) );
		add_action( 'shutdown', array( $this, 'save_errors' ) );
	}

	/**
	 * Add an error message.
	 * @param string $text
	 */
	public static function add_error( $text ) {
		self::$meta_box_errors[] = $text;
	}

	/**
	 * Save errors to an option.
	 */
	public function save_errors() {
		update_option( 'opalhotel_meta_box_errors', self::$meta_box_errors );
	}

	/**
	 * Show any stored error messages.
	 */
	public function output_errors() {
		$errors = maybe_unserialize( get_option( 'opalhotel_meta_box_errors' ) );

		if ( ! empty( $errors ) ) {

			echo '<div id="opalhotel_errors" class="error notice is-dismissible">';

			foreach ( $errors as $error ) {
				echo '<p>' . wp_kses_post( $error ) . '</p>';
			}

			echo '</div>';

			// Clear
			delete_option( 'opalhotel_meta_box_errors' );
		}
	}

	/**
	 * Add Opal Meta boxes.
	 */
	public function add_meta_boxes() {

		remove_meta_box( 'slugdiv', 'opalhotel_coupon', 'normal' );
		remove_meta_box( 'slugdiv', 'opalhotel_package', 'normal' );
		remove_meta_box( 'submitdiv', 'opalhotel_booking', 'side' );

		/* room pricing */
		add_meta_box(
			'opalhotel-room-pricing',
			__( 'Room Pricing', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Room_Pricing::render',
			'opalhotel_room',
			'advanced',
			'low'
		);

		/* room data */
		add_meta_box(
			'opalhotel-room-setting',
			__( 'Room Data', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Room_Data::render',
			'opalhotel_room',
			'normal',
			'high'
		);

		/* galleries room */
		add_meta_box(
			'opalhotel-room-images',
			__( 'Gallery', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Room_Gallery::render',
			array( 'opalhotel_room', 'opalhotel_hotel' ),
			'side',
			'high'
		);

		/* coupon data */
		add_meta_box(
			'opalhotel-coupon-data',
			__( 'Coupon Data', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Coupon_Data::render',
			'opalhotel_coupon',
			'advanced',
			'high'
		);

		/* package data */
		add_meta_box(
			'opalhotel-package-data',
			__( 'Package Data', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Package_Data::render',
			'opalhotel_package',
			'advanced',
			'high'
		);

		/* booking data */
		add_meta_box(
			'opalhotel-booking-data',
			__( 'Book Data', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Booking_Data::render',
			'opalhotel_booking',
			'advanced',
			'high'
		);

		/* booking items */
		add_meta_box(
			'opalhotel-booking-item',
			__( 'Book Items', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Booking_Item::render',
			'opalhotel_booking',
			'advanced',
			'high'
		);

		/* booking action */
		add_meta_box(
			'opalhotel-booking-action',
			__( 'Book Action', 'opal-hotel-room-booking' ),
			'OpalHotel_MetaBox_Booking_Action::render',
			'opalhotel_booking',
			'side',
			'high'
		);
	}

	public function hotel_map() {
		$prefix = '_';
        $cmb = new_cmb2_box( array(
            'id' 			=> 'opalhotel_map',
            'title'		 	=> __( 'Hotel Data', 'opal-hotel-room-booking' ),
            'object_types' 	=> array( 'opalhotel_hotel' ), // post type
            'context' 		=> 'normal', //  'normal', 'advanced', or 'side'
            'priority' 		=> 'high', //  'high', 'core', 'default' or 'low'
            'show_names' 	=> true, // Show field names on the left
                ) );

        $cmb->add_field( array(
            'name' => __( 'Map', 'opal-hotel-room-booking' ),
            'desc' => __( 'Drag the marker to set the exact location', 'opal-hotel-room-booking' ),
            'id' 	=> $prefix . 'map',
            'type' => 'opalhotel_map'
        ) );

        $cmb->add_field( array(
            'name' => __( 'Address', 'opal-hotel-room-booking' ),
            'desc' => __( 'Hotel\'s address.', 'opal-hotel-room-booking' ),
            'id' 	=> $prefix . 'address',
            'type' => 'text'
        ) );

        $cmb->add_field( array(
            'name' => __( 'Phone', 'opal-hotel-room-booking' ),
            'desc' => __( 'Hotel\'s phone.', 'opal-hotel-room-booking' ),
            'id' 	=> $prefix . 'phone',
            'type' => 'text'
        ) );

     	$cmb->add_field( array(
            'name' => __( 'Website', 'opal-hotel-room-booking' ),
            'desc' => __( 'Website address.', 'opal-hotel-room-booking' ),
            'id' 	=> $prefix . 'website',
            'type' => 'text'
        ) );

        do_action( 'opalhotel_hotel_map_meta_data', $cmb, $prefix );
	}

	/**
	 * Check if we're saving, the trigger an action based on the post type.
	 *
	 * @param  int $post_id
	 * @param  object $post
	 */
	public function save_meta_boxes( $post_id, $post ) {
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		// Dont' save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) ) {
			return;
		}

		// Check the nonce
		if ( empty( $_POST['opalhotel_meta_nonce'] ) || ! wp_verify_nonce( $_POST['opalhotel_meta_nonce'], 'opalhotel_save_data' ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// We need this save event to run once to avoid potential endless loops. This would have been perfect:
		self::$saved_meta_boxes = true;

		// Check the post type
		if ( in_array( $post->post_type, array( 'opalhotel_booking' ) ) ) {
			do_action( 'opalhotel_process_booking_order_meta', $post_id, $post );
		} elseif ( in_array( $post->post_type, array( 'opalhotel_room', 'opalhotel_hotel', 'opalhotel_coupon', 'opalhotel_package', 'opalhotel_booking' ) ) ) {
			do_action( 'opalhotel_process_' . $post->post_type . '_meta', $post_id, $post );
		}
	}

}

new OpalHotel_Admin_MetaBoxes();
