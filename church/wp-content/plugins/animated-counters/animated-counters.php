<?php
/*
Plugin Name: Animated Counters
Description: Plugin for Animated Counters shortcodes
Author: <a href="http://www.eralion.com" target="_blank">ERALION.com</a>
Text Domain: animatedcounters
Domain Path: /languages
Version: 1.3
*/
#---------------------------------------------------------------------------#
function animatedcounter_func($atts) {
	if (is_numeric($atts['count'])) { $count=$atts['count']; } else { $count=100; }
	if (is_numeric($atts['duration'])) { $duration=$atts['duration']; } else { $duration=1000; }
	$css='';
	if (!empty($atts['css'])) { $css=' '.$atts['css']; }
	$id='';
	if (!empty($atts['id'])) { $id=' '.$atts['id']; }
	$style='style="';
	if (!empty($atts['color'])) { $style.='color:'.$atts['color'].';'; }
	if (!empty($atts['size'])) { $style.='font-size:'.$atts['size'].';line-height:'.$atts['size'].';'; }
	$style.='"';
	return '<span class="animatedcounters'.$css.'"'.$id.' '.$style.' data-count="'.$count.'" data-duration="'.$duration.'">0</span>';
}
add_shortcode( 'animatedcounter', 'animatedcounter_func' );
function animatedcounters_footer() {
	echo '<script type="text/javascript">
	if (jQuery(".animatedcounters").length) {
		jQuery(".animatedcounters").each(function () {
			jQuery(this).prop("Counter",0).animate({
				Counter: jQuery(this).attr("data-count")
			}, {
				duration: Math.round(jQuery(this).attr("data-duration")),
				easing: "swing",
				step: function (now) {
					jQuery(this).text(Math.ceil(now));
				}
			});
		});
	}
	</script>';
}
add_action( 'wp_footer', 'animatedcounters_footer' );
add_action( 'init', 'animatedcounters_buttons' );
function animatedcounters_buttons() {
	add_filter("mce_external_plugins", "animatedcounters_add_buttons");
    add_filter('mce_buttons', 'animatedcounters_register_buttons');
}	
function animatedcounters_add_buttons($plugin_array) {
	$plugin_array['wptuts'] = plugins_url( 'js/animated-counters.min.js', __FILE__ );
	return $plugin_array;
}
function animatedcounters_register_buttons($buttons) {
	array_push( $buttons, 'animatedcounter');
	return $buttons;
}
?>