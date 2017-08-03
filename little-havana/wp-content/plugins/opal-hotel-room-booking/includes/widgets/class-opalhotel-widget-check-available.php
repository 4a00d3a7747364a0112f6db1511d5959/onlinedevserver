<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 11:14:46
 * @Last Modified by:   someone
 * @Last Modified time: 2016-05-04 00:05:30
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Widget_Check_Available extends WP_Widget {

	/* widget base ID */
	public $id = 'opalhotel-check-available';

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			$this->id,
			__( 'OpalHotel: Check Available', 'opal-hotel-room-booking' ),
			array( 'description' => __( 'Check Available Form', 'opal-hotel-room-booking' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		$shortcode_atts = array();

		$display_childrens	= false;
		if ( ! empty( $instance['display_childrens'] ) && $instance['display_childrens'] ) {
			$display_childrens	= true;
		}

		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		/* do shortcode instance print html */
		echo do_shortcode( '[opalhotel_check_available display_childrens="' . $display_childrens . '" ]' );

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Reservation', 'opal-hotel-room-booking' );
		$display_title = ! empty( $instance['display_title'] ) ? $instance['display_title'] : 0;
		$display_childrens = ! empty( $instance['display_childrens'] ) ? $instance['display_childrens'] : 0;
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'display_childrens' ); ?>" name="<?php echo $this->get_field_name( 'display_childrens' ); ?>" value="1"<?php checked( $display_childrens, 1 ); ?> />
				<label for="<?php echo $this->get_field_id( 'display_childrens' ); ?>"><?php _e( 'Display Children' ); ?></label>
			</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['display_childrens'] = ( ! empty( $new_instance['display_childrens'] ) ) ? strip_tags( $new_instance['display_childrens'] ) : 0;

		return $instance;
	}
}