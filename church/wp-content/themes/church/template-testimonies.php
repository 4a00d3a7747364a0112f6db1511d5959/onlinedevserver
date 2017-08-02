<?php
/*
  * Template Name: Testimonies Page Template
*/
get_header(); 

global $church_options;

$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');
 
query_posts( '&post_type=user_posts&paged=' . $paged );
?>

<section class="banner-div clearfix">
    <div class="sub-banner" style="background:url(http://onlinedevserver.biz/dev/church/wp-content/uploads/2017/05/Share-Your-Testimony.jpg) no-repeat center center; background-size:cover;">
     <div class="overlay">
      <div class="container">
        <h3>RECENT <span> TESTIMONIES</span></h3>
      </div>
     </div>
    </div>
</section>

<section class="inner-div clearfix">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="main-content" style="min-height: 300px;">
            <div class="new-user-post">            
             <div class="inner-content-heading">
              <h2 class="big-text">Recent <small> Testimonies</small></h2>
             </div>
             <div class="new-testimony-div">
              <a href="<?php echo esc_url(home_url('/')); ?>user-testimonies" class="btn new-testimoni-btn">Add New Testimony</a>
             </div> 
            </div>
            
          <?php 
                $banner_args = array( 'post_type' => 'user_posts', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged );
                $banner_query = new WP_Query( $banner_args ); 

                if ( $banner_query->have_posts() ) { 
                  while ( $banner_query->have_posts() ) { $banner_query->the_post();
              ?>
              <div class="user-testimonies-col">
                <a href="<?php the_permalink(); ?>" class="user-testimonies-title"><?php the_title(); ?></a>
                <p class="user-testimonies-date"><?php echo get_the_author(); ?> | <?php echo get_the_date( 'F j, Y' ); ?> </p>
    
                <?php
                      the_excerpt();                  
                      ?>
                <?php if (is_single ()) comments_template (); ?>
                      
              </div>
              <?php } ?>


              <?php wp_reset_postdata(); ?>
              <div class="testimonies-pagin">
              <?php echo paginate(); 
			  } ?>
              </div>
        </div>
      </div>
    </div>
    </div>
</section>

<?php get_footer(); ?>