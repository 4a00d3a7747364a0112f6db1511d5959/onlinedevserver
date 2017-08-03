<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 20:12:41
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-02 10:47:29
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$order = OpalHotel_Order::instance( $post );

?>

<div id="opalhotel-customer-data" class="opalhotel_order_section">
	<div class="opalhotel-customer-details section">

		<h3>
			<?php _e( 'Customer Details', 'opal-hotel-room-booking' ); ?>
			<a href="#" class="opalhotel-edit-customer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
		</h3>

		<div class="sub_section">
			<div class="customer_field">
				<label><?php _e( 'First Name', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_first_name" value="<?php echo esc_attr( $order->customer_first_name ) ?>" disabled/>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Last Name', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_last_name" value="<?php echo esc_attr( $order->customer_last_name ) ?>" disabled/>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Country', 'opal-hotel-room-booking' ); ?></label>
				<?php echo opalhotel_dropdown_country( array( 'name' => '_customer_country', 'selected' => $order->customer_country, 'disabled' => true ) ) ?>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Address', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_address" value="<?php echo esc_attr( $order->customer_address ) ?>" disabled/>
			</div>
			<div class="customer_field">
				<label><?php _e( 'State', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_state" value="<?php echo esc_attr( $order->customer_state ) ?>" disabled/>
			</div>
		</div>

		<div class="sub_section">
			<div class="customer_field">
				<label><?php _e( 'Postcode', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_postcode" value="<?php echo esc_attr( $order->customer_postcode ) ?>" disabled/>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Tel', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_phone" value="<?php echo esc_attr( $order->customer_phone ) ?>" disabled/>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Email', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_email" value="<?php echo esc_attr( $order->customer_email ) ?>" disabled/>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Customer Notes', 'opal-hotel-room-booking' ); ?></label>
				<textarea name="_customer_notes" cols="40" rows="4" disabled><?php echo esc_html( $order->post_content ) ?></textarea>
			</div>
			<div class="customer_field">
				<label><?php _e( 'Transaction ID', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_transaction_id" value="<?php echo esc_attr( $order->transaction_id ) ?>" disabled/>
			</div>
			<!-- <div class="customer_field">
				<label><?php _e( 'User', 'opal-hotel-room-booking' ); ?></label>
				<input type="text" name="_customer_id" value="<?php echo esc_attr( $order->customer_id ) ?>" disabled/>
			</div> -->
		</div>
	</div>

</div>
