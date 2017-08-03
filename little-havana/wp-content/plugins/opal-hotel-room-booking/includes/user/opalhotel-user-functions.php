<?php
/**
 * @Author: someone
 * @Date:   2016-04-23 23:18:25
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-14 10:30:07
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/* get current customer */
if ( ! function_exists( 'opalhotel_get_current_customer' ) ) {

	function opalhotel_get_current_customer() {
		return OpalHotel_User::get_current_user();
	}

}
