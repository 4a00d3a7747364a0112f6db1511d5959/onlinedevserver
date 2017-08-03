<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Email_Customer_Completed_Booking extends OpalHotel_Email {

	public function __construct() {
		/* id */
		$this->id = 'customer_completed_booking';
		$this->title = __( 'Customer Completed Booking', 'opal-hotel-room-booking' );
		parent::__construct();

		if ( ! $this->enabled ) {
			$this->enabled = true;
		}
		
		if ( $this->recipient === false ) {
			$this->recipient = get_option( 'admin_email' );
		}
		
		if ( ! $this->heading ) {
			$this->heading = __( 'Your reservation has been completed.', 'opal-hotel-room-booking' );
		}

		if ( ! $this->subject ) {
			$this->subject = __( 'Your reservation has been completed.', 'opal-hotel-room-booking' );
		}

		$this->template_html = 'emails/customer-completed.php';
		$this->template_plain = 'emails/plain/customer-completed.php';

		add_action( 'opalhotel_update_status_completed', array( $this, 'trigger' ) );
	}

	/* get settings */
	public function admin_settings() {
		return array(
				array(
							'type'		=> 'section_start',
							'id'		=> 'completed_settings',
							'title'		=> __( 'Customer Completed Payment', 'opal-hotel-room-booking' ),
							'desc'		=> __( 'New booking emails are sent to chosen customer when a new booking is completed.', 'opal-hotel-room-booking' )
						),
array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_email_' . $this->id . '_recipient',
							'title'		=> __( 'Recipient(s)', 'opal-hotel-room-booking' ),
							'default'	=> get_option( 'admin_email' )
						),
					array(
							'type'		=> 'checkbox',
							'id'		=> 'opalhotel_email_' . $this->id . '_enable',
							'title'		=> __( 'Enable/Disable', 'opal-hotel-room-booking' ),
							'default'	=> 1
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_email_' . $this->id . '_heading',
							'title'		=> __( 'Email Heading', 'opal-hotel-room-booking' ),
							'default'	=> __( 'Your reservation has been completed.', 'opal-hotel-room-booking' )
						),

					array(
							'type'		=> 'text',
							'id'		=> 'opalhotel_email_' . $this->id . '_subject',
							'title'		=> __( 'Email Subject', 'opal-hotel-room-booking' ),
							'default'	=> __( 'Your reservation has been completed.', 'opal-hotel-room-booking' )
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
		/*$this->recipient = $this->order->customer_email;
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );*/
		$oder_value = get_post_meta($order_id, 'senduseremailcomplet', true );
		if (empty( $oder_value ) ) {
		$this->recipient = $this->order->customer_email;
		update_post_meta( $order_id, 'senduseremailcomplet', $this->recipient );		
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		}else{
			$this->recipient =  get_option( 'admin_email' );
			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
			}

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
return new OpalHotel_Email_Customer_Completed_Booking();