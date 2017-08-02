<?php

/**

 * Template for displaying Category Archive pages

 *

 */



get_header(); ?>



		<section class="inner-div clearfix">
			<div class="container">
				<h2 class="page-title inner-page-heading"><span><?php

					printf( __( 'Category Archives: %s', 'church' ), '' . single_cat_title( '', false ) . '' );

				?></span></h2>
					<div class="left-content">

						<?php
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo '<div class="archive-meta">' . $category_description . '</div>';
								/*
								 * Run the loop for the category page to output the posts.
								 * If you want to overload this in a child theme then include a file
								 * called loop-category.php and that will be used instead.
								 */
								get_template_part( 'loop', 'category' );
						?>

				</div>
				<div class="right-content">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>





<?php get_footer(); ?>

