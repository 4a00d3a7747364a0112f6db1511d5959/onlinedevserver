<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

    <div class="content lightgray home-tag">
      <div class="container">
        <?php 
          $post_10 = get_post(10); 
          //print_r($post_10);
          $excerpt = $post_10->post_excerpt;
          echo $excerpt
        ?>
        <p><a class="special" href="<?php echo esc_url(home_url('/about')); ?>">READ OUR STORY</a></p>
      </div>
    </div>

    <div class="content">
      <div class="pad">
          <h2>Featured Listings</h2>
          <div class="homepage-image-grid reverse-hover">
              <div class="flex-col resize">

                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_1.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>142 Russ St. #4</h3>
                             <p>SOMA</p>
                             <p>3 BR 2.5 BA <br />2,326 Sq. Ft.  <br /> $1,790,000</p>
                         </div>
                     </div>
                  </a>

                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_2.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>350 Alabama St. #12</h3>
                             <p>Inner Mission</p>
                             <p>1 BR 2 BA <br />1,017 Sq. Ft.  <br /> $1,395,000</p>
                         </div>
                     </div>
                  </a>

                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_3.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>38 N. Almaden Blvd. #2015</h3>
                             <p>San Jose</p>
                             <p>Axis: 2 BR 2 BA <br />1,333 Sq. Ft.  <br /> $1,050,000</p>
                         </div>
                     </div>
                  </a>

                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_4.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>240 Caldecott Ln. #106</h3>
                             <p>Oakland</p>
                             <p>Parkwoods: 1 BR 1 BA <br />773 Sq. Ft.  <br /> $405,000</p>
                         </div>
                     </div>
                  </a>

              </div>

              <div class="flex-col resize">
                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_5.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                            <div class="content-item">
                             <h3>40487 Blanchard St.</h3>
                             <p>Fremont</p>
                             <p>3 BR 1 BA <br />1,016 Sq. Ft.  <br /> $699,000</p>
                         </div>
                     </div>
                  </a>
                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_6.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>5210 Victor Ave.</h3>
                             <p>El Cerrito</p>
                             <p>4 BR 2.5 BA <br />1,684 Sq. Ft.  <br /> $649,000</p>
                         </div>
                     </div>
                  </a>
                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_7.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>750 Van Ness Ave. #1005</h3>
                             <p>Van Ness-Civic Center</p>
                             <p>Symphony Towers: 2 BR 2 BA <br />1,091 Sq. Ft.  <br /> $1,050,000</p>
                         </div>
                     </div>
                  </a>
                </div>

                <div class="flex-col resize">
                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_2.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>2526 Francisco St.</h3>
                             <p>Marina</p>
                             <p>5 BR 4.5 BA <br />3,945 Sq. Ft.  <br /> $5,588,000</p>
                         </div>
                     </div>
                  </a>
                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_5.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>4444 18th St.</h3>
                             <p>Eureka Valley-Dolores Heights</p>
                             <p>2 BR 1 BA  <br /> $949,000</p>
                         </div>
                     </div>
                  </a>
                  <a class="flex-item offset resize-item" href="#" style="background:url(<?php echo get_template_directory_uri(); ?>/images/gallery_1.jpg) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3>850 Corbett Ave. #4</h3>
                             <p>Twin Peaks</p>
                             <p>2 BR + Den 2 BA <br />1,690 Sq. Ft.  <br /> $1,195,000</p>
                         </div>
                     </div>
                  </a>
              </div>
          </div>
      </div>
  </div>

  <div class="full-img hero" >
    <div class="left-side">
      <div class="content">
          <?php the_field('know_our_story_section'); ?>
      </div>
    </div>
  </div>

  <div class="content lightgray">
    <h2>Featured Agents</h2>
    <div class="homepage-agents">
          
           <div class="grid bricks-agents">

             <div class="block">
                <div class="padding">
                   <div class="content">
                      <div class="inner">
                        <div class="overlay">
                         <a href="#">
                            <h3>Dan Silvert</h3>
                            <p>Sales Associate</p>
                         </a>
                        </div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/profile_1.jpg" alt="Dan Silvert" />
                      </div>
                    </div>
                   <div class="block-foot">
                      <h3>Dan Silvert</h3>
                      <p>Sales Associate</p>
                    </div>
                </div>
              </div>

              <div class="block">
                <div class="padding">
                   <div class="content">
                      <div class="inner">
                        <div class="overlay">
                         <a href="#">
                            <h3>Dan Silvert</h3>
                            <p>Sales Associate</p>
                         </a>
                        </div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/profile_2.jpg" alt="Dan Silvert" />
                      </div>    
                        
                    </div>
                   <div class="block-foot">
                        <h3>Dan Silvert</h3>
                        <p>Sales Associate</p>
                      </div>
                </div>
              </div>
              
              <div class="block">
                <div class="padding">
                   <div class="content">
                      <div class="inner">
                        <div class="overlay">
                         <a href="#">
                            <h3>Dan Silvert</h3>
                            <p>Sales Associate</p>
                         </a>
                        </div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/profile_3.jpg" alt="Dan Silvert" />
                      </div>    
                        
                    </div>
                   <div class="block-foot">
                        <h3>Dan Silvert</h3>
                        <p>Sales Associate</p>
                      </div>
                </div>
              </div> 

              <div class="block">
                <div class="padding">
                   <div class="content">
                      <div class="inner">
                        <div class="overlay">
                         <a href="#">
                            <h3>Dan Silvert</h3>
                            <p>Sales Associate</p>
                         </a>
                        </div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/profile_4.jpg" alt="Dan Silvert" />
                      </div>    
                        
                    </div>
                   <div class="block-foot">
                        <h3>Dan Silvert</h3>
                        <p>Sales Associate</p>
                      </div>
                </div>
              </div>
          </div>
      
    </div>
  </div>

  <div class="content">
        <h2>Kulan Features</h2>

        <div class="homepage-features">
            <div class="grid feature-blocks">
              
               <?php
                $featured_entries = get_post_meta( get_the_ID(), 'sb_group_kulan_featured_block', true );

                //print_r($featured_entries);

                foreach ( (array) $featured_entries as $key => $featured_entry ) { ?>

                <div class="block">
                  <div class="padding">
                      <a href="<?php echo $featured_entry['feature_block_link']; ?>" style="background:url( <?php echo $featured_entry['featured_block_image']; ?>) no-repeat;">
                          <div class="cover-color">
                              <p><?php echo $featured_entry['feature_block_title']; ?></p>
                          </div>
                      </a>
                  </div>
                </div>

              <?php } ?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>