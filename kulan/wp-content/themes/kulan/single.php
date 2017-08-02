<?php
/**
 * The template for displaying all single posts and attachments
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

   <div class="breadcrumb-area">
      <div class="inner-table">
         <div class="child-table">
           <span>Our Blog</span>
         </div>
      </div>
   </div> <!-- breadcrumb -->


   </section>

	<?php $about_query = new WP_Query( 'page_id=4' ); ?>
      <?php while ($about_query -> have_posts()) : $about_query -> the_post();  ?>
	   <div class="inner-section-title">
	       <h1><?php the_field('latest_blog_title_as_background'); ?></h1>
	       <h2><?php the_field('latest_blog_title_on_background'); ?></h2>
	  </div><!-- page title section -->
	<?php endwhile;?>

	<div class="inner-content" style="min-height: 300px;">

		<section id="blog-all-container-with-sidebar">
	       <div class="container clearfix">
	             <div class="blog-area">
				<?php while ( have_posts() ) : the_post(); ?>
	             <div class="single-blog-acontainer">
                   <div class="single-image">
                     <?php 
                		if ( has_post_thumbnail() ) { 
			        		the_post_thumbnail( 'full' );
			      		}
                	?>
                   </div>
                    
                    <h3><?php the_title(); ?></h3>
                    <div class="row">
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
                    </div>

				<?php
				// Start the loop.
				//while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );

					the_content();

					?>

					<div class="row">
                      <h6>Please Share This</h6>
                      <div class="saaprate-line"></div>
                      <?php echo do_shortcode('[ssba]'); ?>
                    </div>

                    <div class="row">
                      <h6>Leave a Reply</h6>
                      <div class="saaprate-line"></div>
                      <div class="leave-comment-area">
                         <!-- <form method="post" action="#">
                           <div class="row clearfix">
                             <div class="comment-left"><input type="text" name="name" placeholder="Name"></div>
                             <div class="comment-right"><input type="email" name="Email" placeholder="Email"></div>
                           </div>
                           <div class="row">
                             <input type="text" name="website" placeholder="Website">
                           </div>
                           <div class="row">
                             <textarea placeholder="Comments"></textarea>
                           </div>
                           <input type="submit" name="comment-submit" value="Submit">
                         </form> -->
                         <?php 
                         	if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
                         ?>
                      </div>  
                    </div>

					<?php 

					// If comments are open or we have at least one comment, load up the comment template.
					/*if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;*/

					// Previous/next post navigation.
					/*the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'mykis-theme' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'mykis-theme' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'mykis-theme' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'mykis-theme' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );*/

				// End the loop.
				//endwhile;
				?>



		</div>
		<?php endwhile; ?>


		</div><!--all blog section-->

	    <div class="blog-sider-bar">
			<?php if ( is_active_sidebar( 'blog-widget' ) ) { ?>
				<?php dynamic_sidebar( 'blog-widget' ); ?>
			<?php } ?>
	    </div>
	       </div>
	  	</section>

		<div class="inner-footer-image">
			<img src="<?php echo get_template_directory_uri(); ?>/images/inner-footer-image.png" alt="">
		</div>

	</div>

<?php get_footer(); ?>
