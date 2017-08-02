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

            <?php 

              $estate_args = array( 'post_type' => 'estate_listings', 'posts_per_page' => 10, 'order' => 'DESC', 'orderby' => 'date' );

              $estate_query = new WP_Query( $estate_args ); 

            ?>

            <?php 
              $i = 1;

              if ( $estate_query->have_posts() ) { 
              while ( $estate_query->have_posts() ) { $estate_query->the_post(); 
            ?>
              
              <?php if( $i == 1 || $i == 5 || $i == 8 ){ ?>
              <div class="flex-col resize">
              <?php } ?>
                  <a class="flex-item offset resize-item <?php echo $i; ?>" href="<?php the_permalink(); ?>" style="background:url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url( 'full' ); } ?>) no-repeat;">
                     <div class="homepage-grid-content">
                         <div class="content-item">
                             <h3><?php the_field('estate_address'); ?></h3>
                             <?php if( have_rows('estate_key_features') ): ?>
                             <?php while( have_rows('estate_key_features') ): the_row(); ?>
                             <p><?php the_sub_field('key_feature'); ?></p>
                             <?php endwhile; ?>
                             <?php endif; ?>
                         </div>
                     </div>
                  </a>
              <?php if( $i == 4 || $i == 7 ){ ?>
              </div>
              <?php } ?>

              <?php 
                $i++;  } 
                wp_reset_postdata(); 
               } 
              ?>

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

      <?php 

        $agent_args = array( 'post_type' => 'estate_agents', 'posts_per_page' => 4, 'orderby' => 'rand' );

        $agents_query = new WP_Query( $agent_args ); 

        if ( $agents_query->have_posts() ) { 
        while ( $agents_query->have_posts() ) { $agents_query->the_post(); 
    ?>

       <div class="block">
          <div class="padding">
             <div class="content">
                <div class="inner">
                  <div class="overlay">
                   <a href="<?php the_permalink(); ?>">
                      <h3><?php the_title(); ?></h3>
                      <p><?php the_field('designation'); ?></p>
                   </a>
                  </div>
                  <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'thumbnail' ); } ?>
                </div>
              </div>
             <div class="block-foot">
                <h3><?php the_title(); ?></h3>
                <p><?php the_field('designation'); ?></p>
              </div>
          </div>
        </div>

        <?php 
            } 
          wp_reset_postdata(); 
         } 
        ?>
      
    </div>
  </div>
  </div>

  <div class="content">
    <h2>Kulan Features</h2>
    <div class="homepage-features">
      <div class="grid feature-blocks">
        
        <?php if( have_rows('kulan_features_section') ): ?>
          <?php while( have_rows('kulan_features_section') ): the_row(); ?>

            <?php 
              $feature_image = wp_get_attachment_image_src(get_sub_field('featured_block_image'), 'full'); 
              //print_r($feature_image);
            ?>

            <div class="block">
              <div class="padding">          
                <a href="<?php the_sub_field('featured_block_link'); ?>" style="background:url( '<?php echo $feature_image[0]; ?>' ) no-repeat; ">
                  <div class="cover-color">
                      <p><?php the_sub_field('featured_block_title'); ?></p>
                  </div>
                </a> 
              </div>
            </div>             
          <?php endwhile; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>