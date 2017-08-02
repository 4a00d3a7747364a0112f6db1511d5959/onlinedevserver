<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	 <section id="inner-page">
      <div class="container">

	<div class="inner-content" style="min-height: 300px;">

		<section id="blog-all-container-with-sidebar">
	       <div class="container clearfix">
	             <div class="blog-area">  
	                 
	                <ul class="list-group" id="paginate">
					<?php
						while ( have_posts() ) : the_post();
					?>
						<li class="list-group-item">
							<div class="blog-section clearfix">
			                	<div class="blog-image">
			                    	<?php 
			                    		if ( has_post_thumbnail() ) { 
							        		the_post_thumbnail( 'full' );
							      		}
			                    	?>
				                    <div class="blog-image-hover">
				                       <span><a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a></span>
				                    </div>
			                 	</div>
				                 <div class="blog-right-content-area">
				                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				                    <ul class="clearfix">
				                       <li><i class="fa fa-clock-o "></i><?php echo get_the_date(); ?></li>
				                       <li><i class="fa fa-tags "></i>
				                       	<?php 
				                       		$all_the_tags = get_the_tags();
				                       		if ( !empty($all_the_tags) ){
												foreach($all_the_tags as $this_tag) {
													echo $this_tag->name;											
												}
											}
											else {
												echo "No Tags";
											}
										?>
										</li>
				                       <li><i class="fa fa-eye"></i><?php if(function_exists('the_views')) { the_views(); } ?></li>
				                       <li><i class="fa fa-comments"></i><a href="<?php comments_link(); ?>"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a></li>
				                    </ul>
				                    <p><?php //echo sb_content(40).'...'; ?></p>
				                    <div class="saaprate-line"></div>
				                    <div class="blog-user clearfix">
				                      <div class="user-image"><?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?></div>
				                      <div class="user-name">
				                         <h5><?php echo get_the_author(); ?></h5>
				                      </div>
				                     </div>
				                 </div>
			             	</div>
						</li>
					<?php
						endwhile;

						// Previous/next page navigation.
						/*the_posts_pagination( array(
							'prev_text'          => __( 'Previous page', 'mykis-theme' ),
							'next_text'          => __( 'Next page', 'mykis-theme' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mykis-theme' ) . ' </span>',
						) );*/

						wp_pagenavi();
					?>

					</ul>
			    </div>
			    
			    <div class="blog-sider-bar">
					<?php if ( is_active_sidebar( 'blog-widget' ) ) { ?>
						<?php dynamic_sidebar( 'blog-widget' ); ?>
					<?php } ?>
			    </div>
	       </div>
	  	</section>

		

	</div>
	</div>

<?php get_footer(); ?>
