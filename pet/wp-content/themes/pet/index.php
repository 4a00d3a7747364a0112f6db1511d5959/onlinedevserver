<?php

/*

* The template for index page of blog

*/
get_header(); 

global $pet_options;
?>

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
   
    <section id="banner">
        <div class="container banner_blog blog_image_sb">
          <img src="<?php echo $pet_options['latest_tab_banner']['url']; ?>">
          <div class="baner_text">
              <?php //echo $pet_options['latest_tab_banner_content']; ?>
          </div>
        </div>
    </section>

	<section id="top-blog-section">
    
        <div class="container clearfix">
          <div class="inner-main-container">
              <div class="blogg clearfix">
              <div class="left-top-blog">

                <?php
                    if(have_posts()){
                        while (have_posts()) { the_post(); ?>

                 <div class="blog-top-main-box clearfix">
                      <div class="main-blog-image">
                          <?php 
                            if(has_post_thumbnail()){
                                the_post_thumbnail();
                            }
                          ?>
                          <div class="blog-overlay">
                             <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                          </div>
                      </div>
                      <div class="main-blog-text">
                         <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                         <?php echo excerpt(25); ?>
                      </div>
                 </div>            
                <?php }
                    }
                ?>

                 <div class="all-post all-post-bottom clearfix">

                    <?php
                        $sec_args = array( 'post_type' => 'pet_ads', 'posts_per_page' => 4, 'order' => 'DESC', 'orderby' => 'date', );
                        $sec_query = new WP_Query( $sec_args ); 

                        while ($sec_query -> have_posts()) : $sec_query -> the_post();           
                      ?>              
                        <div class="all-post-box clearfix">
                             <div class="all-post-box-left">
                              <?php 
                                if(has_post_thumbnail()){
                                    the_post_thumbnail('sb-custom-size-4');
                                }
                              ?>
                             </div>
                             <div class="all-post-box-right">
                                <h6><?php the_title(); ?></h6>
                             </div>
                        </div>                        
                      <?php endwhile; ?>                    
                      <?php wp_reset_query(); ?>
                    
                 </div>
            </div>
              
              <div class="right-top-blog">
                  <div class="right-social-blog">
                    <?php echo do_shortcode('[aps-counter]'); ?>
                  </div>
                  <div class="right-latest-blog"> 
                      <div class="right-blog-headre">
                         <a class="more_btn">More</a>
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