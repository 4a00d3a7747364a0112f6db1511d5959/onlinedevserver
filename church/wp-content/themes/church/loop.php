<?php

/**

 * The loop that displays posts

 *

 * The loop displays the posts and the post content. See

 * https://codex.wordpress.org/The_Loop to understand it and

 * https://codex.wordpress.org/Template_Tags to understand

 * the tags used in it.

 *

 * This can be overridden in child themes with loop.php or

 * loop-template.php, where 'template' is the loop context

 * requested by a template. For example, loop-index.php would

 * be used if it exists and we ask for the loop with:

 * <code>get_template_part( 'loop', 'index' );</code>

 *

 * @package WordPress

 * @subpackage Twenty_Ten

 * @since Twenty Ten 1.0

 */

?>



<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>

	<div id="nav-above" class="navigation">

		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'church' ) ); ?></div>

		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'church' ) ); ?></div>

	</div><!-- #nav-above -->

<?php endif; ?>



<?php /* If there are no posts to display, such as an empty archive page */ ?>

<?php if ( ! have_posts() ) : ?>

	<div id="post-0" class="post error404 not-found">

		<h1 class="entry-title"><?php _e( 'Not Found', 'church' ); ?></h1>

		<div class="entry-content">

			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'church' ); ?></p>

			<?php get_search_form(); ?>

		</div><!-- .entry-content -->

	</div><!-- #post-0 -->

<?php endif; ?>



<?php

	/*

	 * Start the Loop.

	 *

	 * In Twenty Ten we use the same loop in multiple contexts.

	 * It is broken into three main parts: when we're displaying

	 * posts that are in the gallery category, when we're displaying

	 * posts in the asides category, and finally all other posts.

	 *

	 * Additionally, we sometimes check for whether we are on an

	 * archive page, a search page, etc., allowing for small differences

	 * in the loop on each template without actually duplicating

	 * the rest of the loop that is shared.

	 *

	 * Without further ado, the loop:

	 */

?>


<?php while ( have_posts() ) : the_post(); ?>


<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>



	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'church' ) ) ) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>



			<div class="entry-meta">

				<?php //procard_posted_on(); ?>

			</div><!-- .entry-meta -->



			<div class="entry-content">

<?php if ( post_password_required() ) : ?>

				<?php the_content(); ?>

<?php else : ?>

				<?php

					$images = procard_get_gallery_images();

					if ( $images ) :

						$total_images = count( $images );

						$image = reset( $images );

				?>

						<div class="gallery-thumb">

							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $image, 'thumbnail' ); ?></a>

						</div><!-- .gallery-thumb -->

						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'church' ),

								'href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'church' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark"',

								number_format_i18n( $total_images )

							); ?></em></p>

				<?php endif; // end procard_get_gallery_images() check ?>

						<?php the_excerpt(); ?>

<?php endif; ?>

			</div><!-- .entry-content -->



			<div class="entry-utility">

			<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>

				<a href="<?php echo esc_url( get_post_format_link( 'gallery' ) ); ?>" title="<?php esc_attr_e( 'View Galleries', 'church' ); ?>"><?php _e( 'More Galleries', 'church' ); ?></a>

				<span class="meta-sep">|</span>

			<?php elseif ( $gallery = get_term_by( 'slug', _x( 'gallery', 'gallery category slug', 'church' ), 'category' ) && in_category( $gallery->term_id ) ) : ?>

				<a href="<?php echo esc_url( get_category_link( $gallery ) ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'church' ); ?>"><?php _e( 'More Galleries', 'church' ); ?></a>

				<span class="meta-sep">|</span>

			<?php endif; ?>

				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'church' ), __( '1 Comment', 'church' ), __( '% Comments', 'church' ) ); ?></span>

				<?php edit_post_link( __( 'Edit', 'church' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>

			</div><!-- .entry-utility -->

		</div><!-- #post-## -->



<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>



	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'church' ) )  ) : ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>

			<div class="entry-summary">

				<?php the_excerpt(); ?>

			</div><!-- .entry-summary -->

		<?php else : ?>

			<div class="entry-content">

				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'church' ) ); ?>

			</div><!-- .entry-content -->

		<?php endif; ?>



			<div class="entry-utility">

				<?php procard_posted_on(); ?>

				<span class="meta-sep">|</span>

				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'church' ), __( '1 Comment', 'church' ), __( '% Comments', 'church' ) ); ?></span>

				<?php edit_post_link( __( 'Edit', 'church' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>

			</div><!-- .entry-utility -->

		</div><!-- #post-## -->



<?php /* How to display all other posts. */ ?>



	<?php else : ?>

		<div id="post-<?php the_ID(); ?> blog-box" <?php post_class(); ?>>
			<div class="blog-img">
				<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ) { 
                    the_post_thumbnail( 'full' );
                  }
                  else { ?>
                    <?php _e( 'Sorry, no image found' ); ?>
                  <?php }
                  ?>
                  </a>
			</div>
			<div class="blog-heading">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</div>

				<div class="entry-meta">
					<?php //procard_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
				<div class="entry-summary blog-content">
					<?php echo excerpt(20); ?>
					<p><a class="getDetails" href="<?php the_permalink(); ?>">Get Details <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
				</div><!-- .entry-summary -->
	<?php else : ?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'church' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'church' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">

				<?php if ( count( get_the_category() ) ) : ?>

					<span class="cat-links">

						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'church' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>

					</span>

					<span class="meta-sep">|</span>

				<?php endif; ?>

				<?php

					$tags_list = get_the_tag_list( '', ', ' );

					if ( $tags_list ):

				?>

					<span class="tag-links">

						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'church' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>

					</span>

					<span class="meta-sep">|</span>

				<?php endif; ?>

				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'church' ), __( '1 Comment', 'church' ), __( '% Comments', 'church' ) ); ?></span>

				<?php edit_post_link( __( 'Edit', 'church' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>

			</div><!-- .entry-utility -->

		</div><!-- #post-## -->



		<?php comments_template( '', true ); ?>



	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>



<?php endwhile; // End the loop. Whew. ?>



<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>

				<div id="nav-below" class="navigation">

					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'church' ) ); ?></div>

					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'church' ) ); ?></div>

				</div><!-- #nav-below -->

<?php endif; ?>

