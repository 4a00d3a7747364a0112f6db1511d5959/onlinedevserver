<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Email_New_Booking extends OpalHotel_Email {

	/* order */
	private $order = null;

	public function __construct() {

		$this->id = 'new_booking';
		$this->title = __( 'New Booking', 'opal-hotel-room-booking' );
		parent::__construct();

		if ( $this->enabled === false ) {
			$this->enabled = true;
		}

		if ( $this->recipient === false ) {
			$this->recipient = get_option( 'admin_email' );
		}

		if ( $this->heading === false ) {
			$this->heading = __( 'New Customer Reservation', 'opal-hotel-room-booking' );
		}

		if ( $this->subject === false ) {
			$this->subject = __( 'New Customer Reservation', 'opal-hotel-room-booking' );
		}

		$this->template_html = 'emails/admin-new-booking.php';
		$this->template_plain = 'emails/plain/admin-new-booking.php';

		add_action( 'opalhotel_update_status_pending_to_on-hold', array( $this, 'trigger' ) );
		add_action( 'opalhotel_update_status_pending_to_processing', array( $this, 'trigger' ) );
		add_action( 'opalhotel_update_status_pending_to_completed', array( $this, 'trigger' ) );
	}

	/* get settings */
	public function admin_settings() {
		return array(
				array(
							'type'		=> 'section_start',
							'id'		=> 'completed_settings',
							'title'		=> __( 'New Booking', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'New booking emails are sent to chosen recipient(s) when a new booking is received.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_email_' . $this->id . '_enable',
							'title'		=> __( 'Enable/Disable', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_email_' . $this->id . '_recipient',
							'title'		=> __( 'Recipient(s)', 'opal-hotel-room-booking' ),
							'default'	=> get_option( 'admin_email' )
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_email_' . $this->id . '_heading',
							'title'		=> __( 'Email Heading', 'opal-hotel-room-booking' ),
							'default'	=> __( 'New Customer Reservation', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_email_' . $this->id . '_subject',
							'title'		=> __( 'Email Subject', 'opal-hotel-room-booking' ),
							'default'	=> __( 'New Customer Reservation', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'select',
							'id'		=> 'opalhotel_email_' . $this->id . '_type',
							'title'		=> __( 'Email Type', 'opal-hotel-room-booking' ),
							'default'	=> 'html',
							'options'	=> array(
									'html'		=> __( 'HTML', 'opal-hotel-room-booking' ),
									'plain'		=> __( 'Plain', 'opal-hotel-room-booking' )
								)
						),

					array(
							'type'		=> 'section_end',
							'id'		=> 'completed_settings'
						)
			);
	}

	public function trigger( $order_id ) {
		if ( ! $this->enabled || ! $this->get_recipient() ) {
			return;
		}

		$this->order = opalhotel_get_order( $order_id );
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );

	}

	public function get_heading() {
		return apply_filters( 'opalhotel_email_' . $this->id . '_heading', $this->format_string( $this->heading ) );
	}

	/* content html */
	public function get_content_html() {
		return opalhotel_get_template_content( $this->template_html, array(
				'order'		=> $this->order,
				'heading'	=> $this->get_heading(),
				'admin'		=> true,
				'plain_text'=> false,
				'email'		=> $this
			) );
	}

	/* content text/plain */
	public function get_content_plain() {
		return opalhotel_get_template_content( $this->template_plain, array(
				'order'		=> $this->order,
				'heading'	=> $this->get_heading(),
				'admin'		=> true,
				'plain_text'=> true,
				'email'		=> $this
			) );
	}

}
return new OpalHotel_Email_New_Booking();