<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 */

get_header(); ?>
    
            <section class="inner-div clearfix">
                <div class="container">
                    <div class="left-content">

                        <?php if ( have_posts() ) : ?>

                        <header class="archive-header">
                            <h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'pietergoosen' ), single_tag_title( '', false ) ); ?></h1>

                            <?php
                                // Show an optional term description.
                                $term_description = term_description();
                                if ( ! empty( $term_description ) ) :
                                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                                endif;
                            ?>
                        </header><!-- .archive-header -->

                        <?php
                            $counter = 1; //Starts counter for post column lay out

                            // Start the Loop.
                            while ( have_posts() ) : the_post();

                    ?>
                            <div class="entry-column<?php echo ( $counter%2  ? ' left' : ' right' ); ?>">

                                <?php get_template_part( 'content', get_post_format() ); ?>

                            </div>  

                    <?php   

                        $counter++; //Update the counter

                        endwhile;

                    pietergoosen_pagination();

                    else :
                                // If no content, include the "No posts found" template.
                            get_template_part( 'content', 'none' );

                            endif;
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
            </section>

<?php get_footer(); ?>