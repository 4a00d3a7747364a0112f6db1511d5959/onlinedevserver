<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clean_Commerce
 */

get_header(); ?>

	

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
                
			<div class="top_content_area clearfix">
			    <div class="img_area">
		    	   <?php echo do_shortcode('[soliloquy id="256"]'); ?>
		        </div>
		        <?php while ( have_posts() ) : the_post(); ?>
				<div class="content_area">
				    <?php the_content(); ?>
				</div>
				<?php endwhile; // End of the loop. ?>
			</div>
			
			<!--category list with thumbnails starts-->
			
			<?php 
			$benchmark_terms = get_terms( 'product_cat', 
				array( 
					'parent' => 0, 
					'orderby' => 'name', 
					'order' => 'ASC', 
					'hide_empty' => false
					) 
				);
			//print_r($benchmark_terms);				
			?>
			<div class="cat_head">
				    <h2><?php the_field('section_title'); ?></h2>
			    </div>
			<div class="benchmark-products">
			    
				<ul class="clearfix">
					<?php 
						foreach($benchmark_terms as $benchmark_term) {
					?>
					<li>
						<?php 
							$cat_thumb_id = get_woocommerce_term_meta( $benchmark_term->term_id, 'thumbnail_id', true );
					        $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'thumbnail' );
					        $term_link = get_term_link( $benchmark_term, 'product_cat' ); 
					    ?>

				        <a href="<?php echo $term_link; ?>">
				        	<img src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $benchmark_term->name; ?>" />
				        	<?php echo $benchmark_term->name; ?>
				        </a>
					</li>
					<?php } ?>				
				</ul>
			</div>
			<!--category list with thumbnails ends-->

			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - clean_commerce_action_sidebar.
	 *
	 * @hooked: clean_commerce_add_sidebar - 10
	 */
	do_action( 'clean_commerce_action_sidebar' );
?>

<?php get_footer(); ?>
