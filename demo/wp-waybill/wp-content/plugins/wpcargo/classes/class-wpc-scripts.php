<?php

if (!defined('ABSPATH')){

	exit; // Exit if accessed directly

}

class WPCargo_Scripts{

	function __construct(){

		add_action('wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

	}

	function frontend_scripts(){

		wp_register_style('wpcargo-styles', WPCARGO_PLUGIN_URL . 'assets/css/wpcargo-style.css', array(), '4.0.7');
		wp_enqueue_style('wpcargo-styles');

	}

}

$class_wpcargo_scripts = new WPCargo_Scripts;

