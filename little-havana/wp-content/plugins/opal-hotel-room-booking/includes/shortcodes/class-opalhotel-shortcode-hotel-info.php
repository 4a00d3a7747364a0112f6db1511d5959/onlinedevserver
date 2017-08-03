<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 09:34:10
 * @Last Modified by:   tienhc
 * @Last Modified time: 2016-05-08 14:03:37
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Shortcode_Hotel_Info extends OpalHotel_Abstract_Shortcode {

	/* shortcode name */
	public $shortcode = null;

	public function __construct() {
		$this->shortcode = 'opalhotel_hotel_info';
		parent::__construct();
	}

	/* render */
	public function render( $atts = array(), $content = null ) {

		/* review template file */
		opalhotel_get_template( 'single-hotel/hotel-info.php' );
	}

}