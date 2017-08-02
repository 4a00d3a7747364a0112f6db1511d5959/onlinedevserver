<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Ascend_Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<!-- faq slider -->
<section class="slider faq">
	<div class="container clearfix">
	    <div class="leftPart">
	    	
	    	<h1>Frequently Asked Questions</h1>
	    	<div class="search_bg">
	    		<form class="clearfix search" action="<?php echo home_url( '/' ); ?>">
	    			<input type="search" name="s" placeholder="Search Now..." value="<?php echo $_REQUEST['s']?>">
	    			<span class="bar"></span>
	    			<input type="submit" value="Search">
	    			<input type="hidden" name="post_type" value="general_faq">
	    		</form>
	    		
<!--
	    		<form class="search" action="<?php //echo home_url( '/' ); ?>">
  <input type="search" name="s" placeholder="Search&hellip;">
  <input type="submit" value="Search">
  <input type="hidden" name="post_type" value="kb_article">
</form>
-->
	    		
	    		
	    		<p>Can’t find what you are looking for? - <a href="#"> Ask your own Question</a></p>
	    	</div>
	    </div>
	    <div class="rightPart">
	    	<h3>Want Help Now?</h3>
	    	<p>Call Us : 1-800-894-7105</p>
	    	<a href="javascript:void(0)" class="btn btn-get-started"><span>get started</span></a>
	    	
	    </div>
		
	</div>
</section>

<!-- FAQ Form --> 
<section class="ask_question">
	<div class="container clearfix">
	    <div class="header exact_width_underline_left_align clearfix">
	    	<div class="header_offset_from_left">
		 		  <h2 class="grey head_two exact_width left_align_head">Ask a Question?</h2>
		      </div>
	    </div>
		<div class="ask_form">
			<form>
				<div class="form_Part">
					<div class="row">
						<input type="text" name="f_name" placeholder="First Name">
					</div>
					<div class="row">
						<input type="text" name="l_name" placeholder="Last Name">
					</div>
				</div>
				<div class="form_Part">
					<textarea placeholder="Question"></textarea>
				</div>
				<div class="form_Part">
					<input type="submit" value="SUBMIT NOW">
					<div class="bor"></div>
				</div>
			</form>
		</div>
  </div>
	</div>
</section>
<div class="wrap">

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ascend' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'ascend' ); ?></h1>
		<?php endif; ?>
	</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'faq' );

			endwhile; // End of the loop.

			the_posts_pagination( array(
				'prev_text' => ascend_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'ascend' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'ascend' ) . '</span>' . ascend_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ascend' ) . ' </span>',
			) );

		else : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ascend' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
