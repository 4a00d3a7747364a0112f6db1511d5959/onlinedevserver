<?php
/**
 * @Author: brainos
 * @Date:   2016-04-23 23:17:25
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-14 22:23:02
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_User extends OpalHotel_User_Abstract {

	static $users = null;

	// get user
	static function get_user( $user_id = null ) {

		// return object if exits
		if ( ! empty( self::$users[ $user_id ] ) ) {
			return self::$users[ $user_id ];
		}

		return self::$users[ $user_id ] = new self( $user_id );
	}

	// get current user
	static function get_current_user() {
		$user_id = get_current_user_id();
		return self::get_user( $user_id );
	}

}