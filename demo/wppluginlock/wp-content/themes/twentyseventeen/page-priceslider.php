<?php
/*  
Template Name: Price Theme

*/

get_header(); ?>
		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
			the_title();
				the_content();
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>
        
<?php get_footer();
