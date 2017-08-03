<?php

/**

 * Template for displaying Author Archive pages

 *

 */



get_header(); ?>

	<!-- <section id="bottom_nav">
          <div class="container">
                 <div class="bottom">
                  <div class="">
                      <ul class="pet-blog">
                          <li><a href="<?php //echo site_url(); ?>/"><i class="fa fa-clock-o"></i>Latest Posts</a></li>
                          <li><a href="<?php //echo site_url(); ?>/category/trending/"><i class="fa fa-bolt"></i>Trending</a></li>
                          <li><a href="<?php //echo site_url(); ?>/category/editors-choice/"><i class="fa fa-star"></i>Editors choice</a></li>
                      </ul> 
                  </div>
                 </div>
          </div>
      </section> -->

  <section id="bottom_nav">
        <div class="container">
               <div class="bottom">
                <div class="">
                    <ul class="pet-blog1">
                        <li style="width: 100%;"><a href="<?php echo site_url(); ?>/" >POSTS</a></li> <!-- class="active_state" -->
                        <li style="display: none;"><a href="<?php echo site_url(); ?>/category/trending/">POSTS</a></li>
                    </ul> 
                </div>
               </div>
        </div>
    </section>

    <section id="top-blog-section">
    	
        <div class="container clearfix">        
          <div class="inner-main-container">
			
              <div class="blogg clearfix"> 
				<h2 class="sb_style"><span><?php printf( __( 'Author Archives: %s', 'pet' ),  get_the_author()  ); ?></span></h2>
              <div class="left-top-blog">
				<?php
					/*
					 * Queue the first post, that way we know who
					 * the author is when we try to get their name,
					 * URL, description, avatar, etc.
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					if ( have_posts() )
						the_post();
				?>

				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php
								/**
								 * Filter the Twenty Ten author bio avatar size.
								 *
								 * @since Twenty Ten 1.0
								 *
								 * @param int The height and width avatar dimensions in pixels. Default 60.
								 */
								echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'pet_author_bio_avatar_size', 60 ) );
							?>
						</div><!-- #author-avatar -->

						<div id="author-description">
							<h2><?php printf( __( 'About %s', 'pet' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
				<?php endif; ?>

				<?php
					/*
					 * Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
					/*
					 * Run the loop for the author archive page to output the authors posts
					 * If you want to overload this in a child theme then include a file
					 * called loop-author.php and that will be used instead.
					 */
					get_template_part( 'loop', 'author' );
				?>
              </div>
              
              <div class="right-top-blog">
                  <div class="right-social-blog">
                    <?php echo do_shortcode('[aps-counter]'); ?>
                  </div>
                  <div class="right-latest-blog"> 
                      <div class="right-blog-headre">
                         <a class="more_btn">more</a>
                      </div>

                       <!-- <?php
                        $more_args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'rand', );
                      
                        $recent_query = new WP_Query( $more_args ); 
                      
                        while ($recent_query -> have_posts()) : $recent_query -> the_post();           
                      ?>
                      <div class="right-new-post-box">
                          <?php
                              if(has_post_thumbnail()){
                                the_post_thumbnail('sb-custom-size-1');
                              }
                          ?>
                         <div class="right-new-post-box-text">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <ul class="clearfix" style="display: none;">
                               <li><a><i class="fa fa-clock-o"></i><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></a></li>
                               <li><a><i class="fa fa-share-alt"></i> 10<?php //echo do_shortcode('[pssc_all]'); ?></a></li>
                            </ul>
                         </div>
                      </div>
                      <?php endwhile; ?>                    
                      <?php wp_reset_query(); ?> -->                      

                      <?php if ( is_active_sidebar( 'posts-by-category-sidebar' ) ) { ?>
                        <?php dynamic_sidebar( 'posts-by-category-sidebar' ); ?>
                      <?php } ?>

                  </div>
                  <div class="whats-new"> 
                     <div class="right-blog-headre">
                         <a class="more_btn">What’s New</a>
                      </div>

                      <?php
                        $new_args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'date', );
                        $new_query = new WP_Query( $new_args ); 

                        while ($new_query -> have_posts()) : $new_query -> the_post();           
                      ?>
                     <div class="what-new-box clearfix">
                         <div class="what-new-box-left">
                            <?php
                                if(has_post_thumbnail()){
                                  the_post_thumbnail('sb-custom-size-2');
                                }
                            ?>
                          </div>
                         <div class="what-new-box-right">
                            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                         </div>
                     </div>
                      <?php endwhile; ?>                    
                      <?php wp_reset_query(); ?>
                  </div>
          </div>
             
           </div>
          </div>
              
        </div>
        
    </section>

<?php get_footer(); ?>