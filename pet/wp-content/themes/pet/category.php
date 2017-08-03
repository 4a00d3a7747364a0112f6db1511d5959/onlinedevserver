<?php

/**

 * Template for displaying Category Archive pages

 *

 */



get_header(); ?>


<!-- <section id="bottom_nav">
        <div class="container">
               <div class="bottom">
                <div class="">
                    <ul class="pet-blog">
                        <li><a href="<?php echo site_url(); ?>" class="active_state"><i class="fa fa-clock-o"></i>Latest Posts</a></li>
                        <li><a href="<?php echo site_url(); ?>/category/trending/"><i class="fa fa-bolt"></i>Trending</a></li>
                        <li><a href="<?php echo site_url(); ?>/category/editors-choice/"><i class="fa fa-star"></i>Editors choice</a></li>
                    </ul> 
                </div>
               </div>
        </div>
    </section>
   
    <section id="banner">
        <div class="container banner_blog blog_image">
            <div class="baner_text">
                <h3>Celebrate Your Beloved Pet's</h3>
                <h2>Life with The Ultimate Memorial Tribute</h2>
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
		
				<h2 class="page-title inner-page-heading"><span><?php printf( __( 'Category Archives: %s', 'pet' ), '' . single_cat_title( '', false ) . '' ); ?></span></h2>

					<div class="left-top-blog">

						<?php
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo '<div class="archive-meta">' . $category_description . '</div>';
								/*
								 * Run the loop for the category page to output the posts.
								 * If you want to overload this in a child theme then include a file
								 * called loop-category.php and that will be used instead.
								 */
								get_template_part( 'loop', 'category' );
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

