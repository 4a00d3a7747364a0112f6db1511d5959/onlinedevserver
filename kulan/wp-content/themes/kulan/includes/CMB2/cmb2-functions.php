<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'sb_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object.
 *
 * @return bool             True if metabox should show
 */
function sb_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object.
 *
 * @return bool                     True if metabox should show
 */
function sb_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function sb_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function sb_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters.
 * @param  CMB2_Field object $field      Field object.
 */
function sb_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

/*
* Meta fields for pages and posts
*/

//feature section repeater
add_action( 'cmb2_admin_init', 'sb_featured_section_repeatable_metabox' );
function sb_featured_section_repeatable_metabox() {
	$prefix = 'sb_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'repeated_feature_metabox',
		'title'        => esc_html__( 'Kulan Feature Section', 'kulan' ),
		'object_types'  => array( 'page' ), // Post type
		'show_on'      => array( 'key' => 'id', 'value' => array( 5 ) ),
		'closed'     => true, // true to keep the metabox closed by default
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'kulan_featured_block',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Feature {#}', 'kulan' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Feature', 'kulan' ),
			'remove_button' => esc_html__( 'Remove Feature', 'kulan' ),
			//'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Featured Block Title', 'kulan' ),
		'id'         => 'feature_block_title',
		'type'       => 'text',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Featured Block Image', 'kulan' ),
		'id'   => 'featured_block_image',
		'type' => 'file',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Featured Block Link', 'kulan' ),
		'id'         => 'feature_block_link',
		'type'       => 'text',
	) );
}

//footer message on all pages
add_action( 'cmb2_admin_init', 'sb_footer_message_metabox' );
function sb_footer_message_metabox() {
	$prefix = 'sb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'footer_message_metabox',
		'title'         => esc_html__( 'Footer Message Section', 'kulan' ),
		'object_types'  => array( 'page' ), // Post type
		'show_on'      => array( 'key' => 'id', 'value' => array( 5 ) ),
		'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Footer Message', 'cmb2' ),
		'id'         => $prefix . 'foo_msg_text',
		'type'       => 'textarea_small',
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Footer Message Link', 'cmb2' ),
		'id'   => $prefix . 'foo_msg_link',
		'type' => 'text',
	) );
}

//social media icons and links on all pages
add_action( 'cmb2_admin_init', 'sb_social_media_repeatable_metabox' );
function sb_social_media_repeatable_metabox() {
	$prefix = 'sb_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_groups = new_cmb2_box( array(
		'id'           => $prefix . 'repeated_social_metabox',
		'title'        => esc_html__( 'Social Media Section', 'kulan' ),
		'object_types'  => array( 'page' ), // Post type
		'show_on'      => array( 'key' => 'id', 'value' => array( 5 ) ),
		'closed'     => true, // true to keep the metabox closed by default
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_ids = $cmb_groups->add_field( array(
		'id'          => $prefix . 'kulan_social_block',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Social Icon {#}', 'kulan' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Social Icon', 'kulan' ),
			'remove_button' => esc_html__( 'Remove Social Icon', 'kulan' ),
			//'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_groups->add_group_field( $group_field_ids, array(
		'name'             => esc_html__( 'Select Social Icons', 'kuklan' ),
		'id'               => $prefix . 'social_select',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'fa-facebook' => esc_html__( 'Facebook', 'kuklan' ),
			'fa-twitter'   => esc_html__( 'Twitter', 'kuklan' ),
			'fa-youtube-play'     => esc_html__( 'YouTube', 'kuklan' ),
			'fa-rss'     => esc_html__( 'RSS', 'kuklan' ),
			'fa-envelope'     => esc_html__( 'Envelope (Mail)', 'kuklan' ),
			'fa-instagram'     => esc_html__( 'Instagram', 'kuklan' ),
			'fa-google-plus'     => esc_html__( 'Google Plus', 'kuklan' ),
			'fa-linkedin'     => esc_html__( 'LinkedIn', 'kuklan' ),
		),
	) );

	$cmb_groups->add_group_field( $group_field_ids, array(
		'name'       => esc_html__( 'Social Media Link', 'kulan' ),
		'id'         => $prefix . 'social_link',
		'type'       => 'text',
	) );
}

//Contact Information 
add_action( 'cmb2_admin_init', 'sb_footer_contact_info_metabox' );
function sb_footer_contact_info_metabox() {
	$prefix = 'sb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'contact_info_metabox',
		'title'         => esc_html__( 'Contact Information Section', 'kulan' ),
		'object_types'  => array( 'page' ), // Post type
		'show_on'      => array( 'key' => 'id', 'value' => array( 5 ) ),
		'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Footer Contact Information', 'cmb2' ),
		//'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'contact_info',
		'type'       => 'wysiwyg',
		//'options' => array(),
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Copyright Message', 'cmb2' ),
		//'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'copy_text',
		'type'       => 'wysiwyg',
		//'options' => array(),
	) );
}

//footer copyright information
add_action( 'cmb2_admin_init', 'sb_footer_copyright_info_metabox' );
function sb_footer_copyright_info_metabox() {
	$prefix = 'sb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'copy_info_metabox',
		'title'         => esc_html__( 'Copyright Message Section', 'kulan' ),
		'object_types'  => array( 'page' ), // Post type
		'show_on'      => array( 'key' => 'id', 'value' => array( 5 ) ),
		'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Copyright Information', 'cmb2' ),
		//'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'copy_info',
		'type'       => 'text',
		//'options' => array(),
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Copyright Message', 'cmb2' ),
		//'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'copy_text',
		'type'       => 'wysiwyg',
		//'options' => array(),
	) );
}