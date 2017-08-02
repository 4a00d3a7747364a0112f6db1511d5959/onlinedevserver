<?php
 /**
* Plugin Name:  price-slider
* Plugin URI: http://google.com/
* Description: Set selling price,  
* Version: 1.0 
* Author: D Santra
* Author URI: http://uniterrene.com/
* License: UNIDS007
*/

function add_price_slider_theme_scripts(){
wp_enqueue_style( 'bootstrap.min', plugin_dir_url( __FILE__ ). 'css/bootstrap.min.css');	
wp_enqueue_style( 'bootstrap-slider', plugin_dir_url( __FILE__ ). 'css/bootstrap-slider.css');	
wp_enqueue_style( 'css', plugin_dir_url( __FILE__ ). 'css/css.css');	
wp_enqueue_style( 'custom-slider', plugin_dir_url( __FILE__ ). 'css/custom-slider.css');	
wp_enqueue_style( 'pb-font', plugin_dir_url( __FILE__ ). 'css/pb-font.css');

wp_enqueue_script( 'bootstrap-slider', plugin_dir_url( __FILE__ ). 'js/bootstrap-slider.js', array(), '1.0.0', true );
wp_enqueue_script( 'price-sliderjs', plugin_dir_url( __FILE__ ). 'js/js.js', array(), '1.0.0', true );

	}
add_action( 'wp_enqueue_scripts', 'add_price_slider_theme_scripts' );

/**
 * custom option and settings
 */
function priceslideruniterrene_settings_init() {
 // register a new setting for "priceslideruniterrene" page
 register_setting( 'priceslideruniterrene', 'priceslideruniterrene_options' );
 
 // register a new section in the "priceslideruniterrene" page
 add_settings_section(
 'priceslideruniterrene_section_custom',
 __( '', 'priceslideruniterrene' ),
 'priceslideruniterrene_section_custom_cb',
 'priceslideruniterrene'
 );
 
 // register a new field in the "priceslideruniterrene_section_custom" section, inside the "priceslideruniterrene" page
 add_settings_field(
 'priceslideruniterrene_field_selling', // as of WP 4.6 this value is used only internally
 // use $args' _selling_price to populate the id inside the callback
 __( 'Set selling price', 'priceslideruniterrene' ),
 'priceslideruniterrene_field_selling_cb',
 'priceslideruniterrene',
 'priceslideruniterrene_section_custom',
 [
 '_selling_price' => 'priceslideruniterrene_field_selling',
 'class' => 'priceslideruniterrene_row',
 'priceslideruniterrene_custom_data' => 'custom',
 ]
 );
  add_settings_field(
 'priceslideruniterrene_field_price_range', // as of WP 4.6 this value is used only internally
 // use $args' _selling_price to populate the id inside the callback
 __( 'Price range', 'priceslideruniterrene' ),
 'priceslideruniterrene_field_price_range_cb',
 'priceslideruniterrene',
 'priceslideruniterrene_section_custom',
 [
 '_price_range' => 'priceslideruniterrene_field_price_range',
 'class' => 'priceslideruniterrene_row',
 'priceslideruniterrene_custom_data' => 'custom',
 ]
 );
  add_settings_field(
 'priceslideruniterrene_field_fixed', // as of WP 4.6 this value is used only internally
 // use $args' _selling_price to populate the id inside the callback
 __( 'Set fixed price', 'priceslideruniterrene' ),
 'priceslideruniterrene_field_fixed_cb',
 'priceslideruniterrene',
 'priceslideruniterrene_section_custom',
 [
 '_fixed_price' => 'priceslideruniterrene_field_fixed',
 'class' => 'priceslideruniterrene_row',
 'priceslideruniterrene_custom_data' => 'custom',
 ]
 );
 
  add_settings_field(
 'priceslideruniterrene_field_commission', // as of WP 4.6 this value is used only internally
 // use $args' _selling_price to populate the id inside the callback
 __( 'Set Commission price', 'priceslideruniterrene' ),
 'priceslideruniterrene_field_commission_cb',
 'priceslideruniterrene',
 'priceslideruniterrene_section_custom',
 [
 '_commission_price' => 'priceslideruniterrene_field_commission',
 'class' => 'priceslideruniterrene_row',
 'priceslideruniterrene_custom_data' => 'custom',
 ]
 );
 
  add_settings_field(
 'priceslideruniterrene_field_commission_range', // as of WP 4.6 this value is used only internally
 // use $args' _selling_price to populate the id inside the callback
 __( 'Commission range', 'priceslideruniterrene' ),
 'priceslideruniterrene_field_commission_range_cb',
 'priceslideruniterrene',
 'priceslideruniterrene_section_custom',
 [
 '_commission_range' => 'priceslideruniterrene_field_commission_range',
 'class' => 'priceslideruniterrene_row',
 'priceslideruniterrene_custom_data' => 'custom',
 ]
 ); 
 add_settings_field(
 'priceslideruniterrene_field_buynow', // as of WP 4.6 this value is used only internally
 // use $args' _selling_price to populate the id inside the callback
 __( 'Buy Now', 'priceslideruniterrene' ),
 'priceslideruniterrene_field_buynow_cb',
 'priceslideruniterrene',
 'priceslideruniterrene_section_custom',
 [
 '_buynow' => 'priceslideruniterrene_field_buynow',
 'class' => 'priceslideruniterrene_row',
 'priceslideruniterrene_custom_data' => 'custom',
 ]
 );
 
}
 
/**
 * register our priceslideruniterrene_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'priceslideruniterrene_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */
 
// custom section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function priceslideruniterrene_section_custom_cb( $args ) {

}
 
// selling field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: _selling_price, class.
// the "_selling_price" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function priceslideruniterrene_field_selling_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'priceslideruniterrene_options' );
 // output the field
 ?>
$<input type="number"id="<?php echo esc_attr( $args['_selling_price'] ); ?>"
 data-custom="<?php echo esc_attr( $args['priceslideruniterrene_custom_data'] ); ?>"
 name="priceslideruniterrene_options[<?php echo esc_attr( $args['_selling_price'] ); ?>]" placeholder="Set selling price" value="<?php echo $options[ $args['_selling_price'] ];?>" />
 <?php
}
function priceslideruniterrene_field_fixed_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'priceslideruniterrene_options' );
 // output the field
 ?>
 $ <input type="number"id="<?php echo esc_attr( $args['_fixed_price'] ); ?>"
 data-custom="<?php echo esc_attr( $args['priceslideruniterrene_custom_data'] ); ?>"
 name="priceslideruniterrene_options[<?php echo esc_attr( $args['_fixed_price'] ); ?>]" placeholder="Set fixed fee" value="<?php echo $options[ $args['_fixed_price'] ];?>" />
 <?php
}
 function priceslideruniterrene_field_commission_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'priceslideruniterrene_options' );
 // output the field
 ?>
  <input type="number"id="<?php echo esc_attr( $args['_commission_price'] ); ?>"
 data-custom="<?php echo esc_attr( $args['priceslideruniterrene_custom_data'] ); ?>"
 name="priceslideruniterrene_options[<?php echo esc_attr( $args['_commission_price'] ); ?>]" placeholder="Set Commission fee" value="<?php echo $options[ $args['_commission_price'] ];?>" />%
 <?php
}

 function priceslideruniterrene_field_commission_range_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'priceslideruniterrene_options' );
 // output the field
 ?>
  <input type="text" id="<?php echo esc_attr( $args['_commission_range'] ); ?>"
 data-custom="<?php echo esc_attr( $args['priceslideruniterrene_custom_data'] ); ?>"
 name="priceslideruniterrene_options[<?php echo esc_attr( $args['_commission_range'] ); ?>]" placeholder="Set Commission range" value="<?php echo $options[ $args['_commission_range'] ];?>" />% <br />
(<small>Ex: 3-6</small>)
 <?php
}
 
  function priceslideruniterrene_field_price_range_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'priceslideruniterrene_options' );
 // output the field
 ?>
 $ <input type="text" id="<?php echo esc_attr( $args['_price_range'] ); ?>"
 data-custom="<?php echo esc_attr( $args['priceslideruniterrene_custom_data'] ); ?>"
 name="priceslideruniterrene_options[<?php echo esc_attr( $args['_price_range'] ); ?>]" placeholder="Price range" value="<?php echo $options[ $args['_price_range'] ];?>" /><br />
(<small>Ex: 10000-5000000</small>)
 <?php
}
 
 function priceslideruniterrene_field_buynow_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'priceslideruniterrene_options' );
 // output the field
 ?>
<input type="text" id="<?php echo esc_attr( $args['_buynow'] ); ?>"
 data-custom="<?php echo esc_attr( $args['priceslideruniterrene_custom_data'] ); ?>"
 name="priceslideruniterrene_options[<?php echo esc_attr( $args['_buynow'] ); ?>]" placeholder="Set Buy Now Link" value="<?php echo $options[ $args['_buynow'] ];?>" style="width:70%;" />
 <?php
}
 
/**
 * top level menu
 */
function priceslideruniterrene_options_page() {
 // add top level menu page
 add_menu_page(
 'PriceSlider',
 'PriceSlider Options',
 'manage_options',
 'priceslideruniterrene',
 'priceslideruniterrene_options_page_html'
 );
}
 
/**
 * register our priceslideruniterrene_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'priceslideruniterrene_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function priceslideruniterrene_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'priceslideruniterrene_messages', 'priceslideruniterrene_message', __( 'Settings Saved', 'priceslideruniterrene' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'priceslideruniterrene_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "priceslideruniterrene"
 settings_fields( 'priceslideruniterrene' );
 // output setting sections and their fields
 // (sections are registered for "priceslideruniterrene", each field is registered to a specific section)
 do_settings_sections( 'priceslideruniterrene' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}
function pricesliderhtml($atts){
	
	 $priceslidersetting = get_option( 'priceslideruniterrene_options' );
	// print_r($priceslidersetting);
$priceselling=$priceslidersetting['priceslideruniterrene_field_selling'];
$pricerange=explode('-',$priceslidersetting['priceslideruniterrene_field_price_range']);
$pricefixed=$priceslidersetting['priceslideruniterrene_field_fixed'];
$pricecommission=$priceslidersetting['priceslideruniterrene_field_commission'];
$commissionrange=explode('-',$priceslidersetting['priceslideruniterrene_field_commission_range']);
$buynow=$priceslidersetting['priceslideruniterrene_field_buynow'];
?><div class="row calculator" data-anchor="savings-calculator">
    <div class="container">
        <div class="row" data-bind="with: pbApp.viewModel.calc">
            <div class="col-md-12 text-center">
                <h2>
                    <span class="hidden-sm hidden-md hidden-lg">See your savings</span>
                    <span class="hidden-xs">How much could you save?</span>
                </h2>
            </div>
            <div class="calc text-center">

                    <div class="price col-xs-12">
                        <h4>Set your selling price</h4>
                        <div class="fees">
                            <h3 class="fee"><span data-bind="text: currency">$</span><span data-bind="text: price"><span id="priceSliderVal"><?php echo $priceselling;?></span></span></h3>
                        </div>
                        <div class="slider-control">
                            <p data-bind="click: priceMinus" id="decrease">&ndash;</p>
                            <div class="slider-outer">
                                
                                 <input id="price" name="price" type="text" data-slider-min="<?php echo $pricerange[0];?>" data-slider-max="<?php echo $pricerange[1];?>" data-slider-step="10000" data-slider-value="<?php echo $priceselling;?>"/>
                                 
                            </div>
                           

                            <p data-bind="click: pricePlus" id="increase">+</p>
                        </div>
                        <h4>Set typical estate agent's commission</h4>
                    </div>
                    <div class="commission col-xs-12 col-sm-4 col-sm-push-4 col-md-4 col-md-push-4">
                  <div class="slider-outer centerpriceslider">
   
                            <input id="pricecommission" name="pricecommission" type="text" data-slider-min="<?php echo $commissionrange[0];?>" data-slider-max="<?php echo $commissionrange[1];?>" data-slider-step="0.1" data-slider-value="<?php echo $pricecommission;?>"/>
                            </div>
                    </div>

                    <div class="commisery col-xs-6 col-sm-4 col-sm-pull-4 col-md-4 col-md-pull-3 col-lg-3 col-lg-pull-2">
                        <div class="fees">
                            <h4>Your saving</h4>
                            <p>
                                <strong class="fee purplebricks" data-bind="text: savings, css: agentFeeSize ">$<span id="pricesave"><?php echo $pricefixed;?></span></strong>
                            </p>
                        </div>
                    </div>

                    <div class="fixed-fee col-xs-6 col-sm-4 col-md-4 col-md-pull-1 col-lg-3 col-lg-pull-0">
                        <div class="fees">
                            <h4>Our fixed fee</h4>
                            <p>
                                <strong class="fee purplebricks">
                                    <span data-bind="text: currency">$</span><span id="fixedprice"><?php echo $pricefixed;?></span>
                                </strong>
                            </p>
                        </div>
                    </div>

                    <div class="cta col-xs-12">
                        <p>Like the difference?</p>
                            <a class="btn btn-warning btn-cta btn-valuation" id="buttonValuation" href="<?php echo $buynow;?>" role="button">Buy Now<span class="pb pb-angle-right hidden-xs"></span></a>
                    </div>
                </div>
     </div>
    </div>
</div>
<script>   
   var percentage = <?php echo $pricecommission;?>;
	var price      = <?php echo $priceselling;?>;	
	var fixprice=<?php echo $pricefixed;?>;
</script>
<?php	
}
add_shortcode( 'PRICESLIDER', 'pricesliderhtml' );