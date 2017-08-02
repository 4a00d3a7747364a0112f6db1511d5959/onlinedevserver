<?php

class WCSG_Email_Recipient_New_Initial_Order extends WC_Email {

	public $subscription_owner;
	public $subscriptions;
	public $wcsg_sending_recipient_email;

	/**
	 * Create an instance of the class.
	 */
	function __construct() {

		$this->id             = 'recipient_completed_order';
		$this->title          = __( 'New Initial Order - Recipient', 'woocommerce-subscriptions-gifting' );
		$this->description    = __( 'This email is sent to recipients notifying them of subscriptions purchased for them.', 'woocommerce-subscriptions-gifting' );
		$this->customer_email = true;

$random_number = time();
$this->codeno = 'DB'.$random_number;

		$this->heading        = __( 'New Order', 'woocommerce-subscriptions-gifting' );
		/*$this->subject        = __( 'Your new subscriptions at {site_title}', 'woocommerce-subscriptions-gifting' );*/
		$this->subject        = __( 'A gift from  {site_title}', 'woocommerce-subscriptions-gifting' );

		$this->template_html  = 'emails/recipient-new-initial-order.php';
		$this->template_plain = 'emails/plain/recipient-new-initial-order.php';
		$this->template_base  = plugin_dir_path( WCS_Gifting::$plugin_file ) . 'templates/';

		// Trigger for this email
		add_action( 'wcsg_new_order_recipient_notification', array( $this, 'trigger' ), 10, 2 );

		WC_Email::__construct();
	}

	/**
	 * trigger function.
	 */
	function trigger( $recipient_user, $recipient_subscriptions ) {
		if ( $recipient_user ) {
			$this->object             = get_user_by( 'id', $recipient_user );
			$this->recipient          = stripslashes( $this->object->user_email );
			$subscription             = wcs_get_subscription( $recipient_subscriptions[0] );
			$this->subscription_owner = WCS_Gifting::get_user_display_name( $subscription->customer_user );
			$this->subscriptions      = $recipient_subscriptions;
		}

		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}

		$this->wcsg_sending_recipient_email = $recipient_user;
		update_user_meta( $recipient_user, '_rec_codeno', $this->codeno);	
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );

		unset( $this->wcsg_sending_recipient_email );
	}

	/**
	 * get_content_html function.
	 */
	function get_content_html() {
		ob_start();
		wc_get_template( $this->template_html, array(
			'email_heading'          => $this->get_heading(),
			'blogname'               => $this->get_blogname(),
			'recipient_user'         => $this->object,
			'subscription_purchaser' => $this->subscription_owner,
			'subscriptions'          => $this->subscriptions,
			'codeno'=>$this->codeno,
			'sent_to_admin'          => false,
			'plain_text'             => false,
			'email'                  => $this,
			),
			'',
			$this->template_base
		);
		return ob_get_clean();
	}

	/**
	 * get_content_plain function.
	 */
	function get_content_plain() {
		ob_start();
		wc_get_template( $this->template_plain, array(
			'email_heading'          => $this->get_heading(),
			'blogname'               => $this->get_blogname(),
			'recipient_user'         => $this->object,
			'subscription_purchaser' => $this->subscription_owner,
			'subscriptions'          => $this->subscriptions,
			'codeno'=>$this->codeno,
			'sent_to_admin'          => false,
			'plain_text'             => true,
			'email'                  => $this,
			),
			'',
			$this->template_base
		);
		return ob_get_clean();

	}
}
