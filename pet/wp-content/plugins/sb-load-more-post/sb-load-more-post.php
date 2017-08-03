<?php
/*
Plugin Name: SB Load More Post
Version: 1.0
Author: Subrat Kumar Barik
Author URI: https://twitter.com/subrat4kolkata
Description: A simple load more posts plugin for wordpress.
Tags: responsive, more, simple.
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages

SB Load More Post is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.
 
SB Load More Post is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along with SB Load More Post. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('SB_Load_More_Post')) {
	class SB_Load_More_Post
	{
		
		function __construct()
		{
			add_action( 'wp_enqueue_scripts', array( $this, 'sb_plugin_scripts' ), 20 );
		}

		function sb_plugin_scripts()
        {	
        	//js
            wp_register_script( 'sb-load-js', plugins_url( 'js/sb-load.js', __FILE__ ), '', '', true );
			wp_enqueue_script('sb-load-js');
			 
			//css
			wp_register_style( 'sb-load-css', plugins_url( 'css/sb-load.css', __FILE__ ) );
			wp_enqueue_style('sb-load-css');
			wp_register_style( 'sb-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
			wp_enqueue_style('sb-font-awesome');
        }
	}
}//End of class not exists check

$GLOBALS['SB_Load_More_Post'] = new SB_Load_More_Post();
?>