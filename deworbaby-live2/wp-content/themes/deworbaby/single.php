<?php

/*

 * The loop that displays a single post

 */

get_header(); 

?>



	<section class="inner-div clearfix">
		<div class="container">
			<h2 class="inner-page-heading"><span><?php the_title(); ?></span></h2>
			<div class="left-content">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php

                    if ( has_post_thumbnail() ) { 

                    the_post_thumbnail( 'full' );

                  }

                  else { ?>

                    <?php _e( 'Sorry, no image found' ); ?>

                  <?php }

                  ?>

                  <div class="single-post-meta">
                  		<p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?>  in <?php the_category(', '); ?></p>
                  </div>

                  <div class="blog-tags">
                  	<?php the_tags( 'Tags: ', ' ', '<br />' ); ?>
                  </div>

					<div class="entry-meta">

						<?php //deworbaby_posted_on(); ?>

					</div><!-- .entry-meta -->



					<div class="entry-content">

						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'deworbaby' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->



					<?php if ( get_the_author_meta( 'description' ) ) :  ?>

					<div id="entry-author-info">

						<div id="author-avatar">

							<?php

							/** This filter is documented in author.php */

							echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'deworbaby_author_bio_avatar_size', 60 ) );

							?>

						</div><!-- #author-avatar -->

						<div id="author-description">

							<h2><?php printf( __( 'About %s', 'deworbaby' ), get_the_author() ); ?></h2>

							<?php the_author_meta( 'description' ); ?>

							<div id="author-link">

								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">

									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'deworbaby' ), get_the_author() ); ?>

								</a>

							</div><!-- #author-link	-->

						</div><!-- #author-description -->

					</div><!-- #entry-author-info -->

<?php endif; ?>



					<div class="entry-utility">

						<?php //deworbaby_posted_in(); ?>

						<?php edit_post_link( __( 'Edit', 'deworbaby' ), '<span class="edit-link">', '</span>' ); ?>

					</div><!-- .entry-utility -->

				</div><!-- #post-## -->



				<div id="nav-below" class="navigation">

					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'deworbaby' ) . '</span> %title' ); ?></div>

					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'deworbaby' ) . '</span>' ); ?></div>

				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div>
			<div class="right-content">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>