<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Package extends OpalHotel_Abstract_Service {

	/* $id property */
	public $id = null;

	// instance insteadof new class
	static $instance = null;

	public function __construct( $id = null ) {
		parent::__construct( $id );
	}

	/* get base price */
	public function base_price() {
		return apply_filters( 'opalhotel_package_base_price', (float)$this->package_amount );
	}

	/* get price */
	public function get_price() {
		return apply_filters( 'opalhotel_package_price', floatval( $this->base_price() ) );
	}

	/**
	 * instance insteadof new class
	 * @param  $package optional Eg: id, object
	 * @return object
	 */
	static function instance( $package = null ) {
		$id = null;
		if ( $package instanceof WP_POST ) {
			$id = $package->ID;
		} else if ( is_numeric( $package ) ) {
			$id = $package;
		} else if ( is_object( $package ) && isset( $package->ID ) ) {
			$id = $package->ID;
		}

		if ( empty( self::$instance[ $id ] ) ) {
			self::$instance[ $id ] = new self( $id );
		}

		return self::$instance[ $id ];

	}

}
