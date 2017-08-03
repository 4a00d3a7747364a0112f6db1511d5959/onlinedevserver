<?php

/**

 * The template for displaying room content within loops

 *

 * This template can be overridden by copying it to yourtheme/opalhotel/content-room.php.

 *

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit();

}

global $opalhotel_room;

$class = opalhotel_get_loop_class();

$has_discount = $opalhotel_room->has_discounts();

?>



<div <?php post_class( $class ); ?>>
    
      <div class="room-grid">

		

		<div class="room-top-wrap">

			<?php if( $has_discount ) : ?>

				<span class="room-label room-label-discount"><?php _e( 'Discount', 'opal-hotel-room-booking'); ?></span>

			<?php endif; ?>

			<?php

				/**

				 * opalhotel_archive_loop_item_thumbnail hook.

				 * opalhotel_loop_item_thumbnail - 5

				 */

				do_action( 'opalhotel_archive_loop_item_thumbnail' );



			?>

		</div>
         <?php

			/**

			 * opalhotel_before_archive_loop_item_title hook.

			 * opalhotel_loop_item_title - 5

			 */

			do_action( 'opalhotel_archive_loop_item_title' );

		?>
		<footer>

			<?php

				/**

				 * opalhotel_before_archive_loop_item_title hook.

				 * opalhotel_loop_item_title - 5

				 */

				do_action( 'opalhotel_archive_loop_item_price' );

			?>

			<?php



				/**

				 * opalhotel_archive_loop_item_title hook.

				 *

				 * @hooked opalhotel_loop_item_description - 5

				 */

				do_action( 'opalhotel_archive_loop_item_list_description' );
				
				

			?>
            
            <div class="room-view">
              <a href="<?php echo esc_attr( get_the_permalink() ) ?>">View detail</a>
            </div>
            
            

		</footer>



		<?php

			/**

			 * opalhotel_after_archive_loop_item hook.

			 */

			do_action( 'opalhotel_after_archive_loop_item' );

		?>

	</div>
    
	

</div>