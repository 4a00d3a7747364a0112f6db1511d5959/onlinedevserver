<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ascend_Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="slider testimonials">
  <div class="headbar">
    <h2>Testimonials</h2>
  </div>
</section>
<!-- chamois slider ends --> 
<!-- Main content area -->
<div class="container contents testimonial">
  <div class="HeadingTestimonials">
    <h2 class="partical_bothside"><span></span>What Our Client Says</h2>
  </div>
  <!-- main content start -->
  <div class="mainContentStart">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'testimonial' );

			endwhile;

			the_posts_pagination( array(
				'prev_text' => ascend_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'ascend' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'ascend' ) . '</span>' . ascend_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ascend' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

		  
  </div>
 		
   </div>
  
  
  <!-- main content ends --> 
</div>

<?php get_footer();
