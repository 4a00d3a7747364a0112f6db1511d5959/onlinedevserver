<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 11:11:09
 * @Last Modified by:   opalhotel_remove_extra
 * @Last Modified time: 2016-04-25 19:53:53
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

add_action( 'widgets_init', 'opalhotel_widget_init' );
if ( ! function_exists( 'opalhotel_widget_init' ) ) {
	/* widget init */
	function opalhotel_widget_init() {

		$widgets = apply_filters( 'opalhotel_widgets_init', array(
				'OpalHotel_Widget_Check_Available',
				'OpalHotel_Widget_Mini_Cart',
				'OpalHotel_Widget_Hotel_Information',
				'OpalHotel_Widget_Hotels_Grid',
				'OpalHotel_Widget_Single_Book_Room'
			) );

		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
}