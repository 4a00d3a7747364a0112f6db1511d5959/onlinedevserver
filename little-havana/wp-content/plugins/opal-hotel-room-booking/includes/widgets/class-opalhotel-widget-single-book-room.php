<?php
/**
 * @Author: brainos
 * @Date:   2016-04-24 18:41:29
 * @Last Modified by:   opalhotel_remove_extra
 * @Last Modified time: 2016-04-25 20:40:07
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class OpalHotel_Widget_Single_Book_Room extends WP_Widget {

	/* widget base ID */
	public $id = 'opalhotel-single-book-room';

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			$this->id,
			__( 'OpalHotel: Single Book Room', 'opal-hotel-room-booking' ),
			array( 'description' => __( 'Single Book Room, should be place on single room page', 'opal-hotel-room-booking' ), ) // Args
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
		if ( ! is_singular( 'opalhotel_room' ) ) {
			return;
		}
		echo $args['before_widget'];
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		global $opalhotel_shortcodes;
		if ( isset( $opalhotel_shortcodes['single-book-room'] ) && $opalhotel_shortcodes['single-book-room'] ) {
			$single_book_room = $opalhotel_shortcodes['single-book-room'];
			$single_book_room->render( $instance );
		}

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'opal-hotel-room-booking' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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

		return $instance;
	}
}