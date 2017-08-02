<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<?php 
	    $top_banner = get_field('top_inner_page_banner');
	    if( !empty($top_banner) ){ ?>
	      <img src="<?php echo $top_banner['url']; ?>" class="inner-banner"/>
	    <?php } else { ?>
	    <img src="<?php echo get_template_directory_uri(); ?>/images/inner-banner-about-bg.jpg" class="inner-banner">
	    <?php } ?>

	   </section>

		<div class="inner-content">
			<div class="container">
			<section class="search-area-section">

		<?php if ( have_posts() ) { ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'mykis-theme' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				//get_template_part( 'content', 'search' );

				the_excerpt();
				

			// End the loop.
			endwhile;

		}
		else{ echo "<h2>No data found. Please try with some other keywords</h2>"; 

	    	 get_search_form(); }
		?>
		</section>
		</div>
			<div class="inner-footer-image">
	    		<img src="<?php echo get_template_directory_uri(); ?>/images/inner-footer-image.png" alt="">
	  		</div> <!-- footer image -->
		</div>  <!-- inner container --> 

<?php get_footer(); ?>
