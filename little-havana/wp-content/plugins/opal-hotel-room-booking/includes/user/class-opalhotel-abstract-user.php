<?php
/**
 * @Author: brainos
 * @Date:   2016-04-23 23:28:07
 * @Last Modified by:   opalhotel_remove_extra
 * @Last Modified time: 2016-04-25 19:53:52
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

abstract class OpalHotel_User_Abstract {

	public $user 	= null;

	public $id 		= null;

	function __construct( $user = null ) {

		if ( is_numeric( $user ) && ( $user = get_user_by( 'ID', $user ) ) ) {
			$this->user = $user;
			$this->id 	= $this->user->ID;
		} else if ( $user instanceof WP_User  ) {
			$this->user = $user;
			$this->id 	= $this->user->ID;
		}

		if ( ! $user ) {
			$current_user = wp_get_current_user();
			$this->id = $current_user->ID;
		}
	}

	function __get( $key ) {
		if ( ! isset( $this->{$key} ) || ! method_exists( $this, $key ) ) {
			return get_user_meta( $this->id,  $key, true );
		}
	}

}