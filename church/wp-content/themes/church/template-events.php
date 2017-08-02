<?php
/*
  * Template Name: Events Page Template
*/
get_header(); 

global $church_options;
?>

<section class="banner-div clearfix">
    <div class="sub-banner" style="background:url(<?php echo $church_options['blog_common_banner']['url']; ?>) no-repeat center center;background-size:cove;">
     <div class="overlay">
      <div class="container">
        <h3>RECENT <span> EVENTS</span></h3>
      </div>
     </div>
    </div>
</section>

<!-- inner content -->
<section class="inner-div">
    <div class="inner-box">
      <div class="container">
	 	<div class="row">
         <div class="event-pages">

            <div class="events">
              <?php 
                $banner_args = array( 'post_type' => 'banner_slider', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' );
                $banner_query = new WP_Query( $banner_args ); 

                while ( $banner_query->have_posts() ) { $banner_query->the_post();
              ?>

                <div class="events-box-row clearfix">
                  <div class="col-sm-10">
                   <div class="row">
                     <div class="col-sm-5"> 
                    <div class="event-image">
                      <?php
                        if ( has_post_thumbnail() ) { ?>
                        <img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" class="img-responsive">
                    <?php } ?> 
                    </div>
                    </div>
                     <div class="col-sm-7">
                     <div class="events-box">
                      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <p><?php echo substr(get_the_content(), 0, 135).'...'; ?></p>
                      <a class="btn-donate black-btn btn-big" href="<?php the_permalink(); ?>" >View Event <span> <i class="fa fa-long-arrow-right"></i> 
                      </span></a>
                     </div> 
                   </div>
                   </div>
                  </div>
                
                  <div class="col-sm-2">
                 <div class="events-date-box">
                  <div class="date-place">
                    <?php 
                      $ori_dt = get_the_date( 'j F' ); 
                      $arr = explode(' ',trim($ori_dt));
                    ?>
                    <span class="custom-date"><?php 
                      //$arr[0] = $arr[0] % 100;
                        if($arr[0] < 11 || $arr[0] > 13){
                           switch($arr[0] % 10){
                              case 1: echo $arr[0].'<sup>st</sup>';
                              break;
                              case 2: echo $arr[0].'<sup>nd</sup>';
                              break;
                              case 3: echo $arr[0].'<sup>rd</sup>';
                              break;
                              default: echo $arr[0].'<sup>th</sup>';
                          }
                        }
                    ?></span>
                    <span class="custom-month"><?php echo $arr[1]; ?></span>  
                  </div>
                 </div> 
                </div>
                
                </div>

             <?php } wp_reset_query(); ?>
            </div>

          
          
         </div>
        </div>  
	  </div>
    </div>
</section>



<?php get_footer(); ?>