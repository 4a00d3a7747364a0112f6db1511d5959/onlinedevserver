<?php
/**
 * @Author: brainos
 * @Date:   2016-04-28 20:45:22
 * @Last Modified by:   brainos
 * @Last Modified time: 2016-04-28 21:26:08
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Order_Item extends OpalHotel_Abstract_Service {

	/* order id */
	public $id;

	/* order item data */
	public $data = null;

	/* instance */
	public static $instance = null;

	/* constructor object */
	public function __construct( $id = null ) {
		$this->id = $id;
		if ( $this->id ) {
			$this->data = opalhotel_get_order_item( $this->id );
		}
	}

	/* get order item */
	public function __get( $key = '' ) {
		if ( metadata_exists( 'opalhotel_order_item', $this->id, $key ) ) {
			return opalhotel_get_order_item_meta( $this->id, $key, true );
		} else if ( isset( $this->data->{$key} ) ) {
			return $this->data->{$key};
		}
	}

	/* instance return exist object or initialize new object */
	public static function instance( $order_item = null ) {
		$id = null;
		if ( $order_item instanceof OpalHotel_Order_Item ) {
			$id = $order_item->order_item_id;
		} else if ( is_numeric( $order_item ) ) {
			$id = $order_item;
		} else if ( is_object( $order_item ) && isset( $order_item->order_item_id ) ) {
			$id = $order_item->order_item_id;
		}

		if ( empty( self::$instance[ $id ] ) ) {
			self::$instance[ $id ] = new self( $id );
		}

		return self::$instance[ $id ];
	}

}
