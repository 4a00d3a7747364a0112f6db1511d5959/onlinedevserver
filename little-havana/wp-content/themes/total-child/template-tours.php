<?php
/**
 * Template Name: Tours Page Template
 *
 * @package Total
 */

get_header(); ?>

<header class="ht-main-header">
	<div class="ht-container">
		<?php the_title( '<h1 class="ht-main-title">', '</h1>' ); ?>
		<?php do_action( 'total_breadcrumbs' ); ?>
	</div>
</header><!-- .entry-header -->

<section id="ht-inner" class="ht-inner">
  <div class="ht-container">
	 <div id="primary" class="content-area">
		<div id="main" class="site-main">
        <?php 
          while(have_posts()) { the_post();
        ?>
        <div class="inner-heading">
         <div class="section-header">
           <h3 class="ht-section-sub-title"><?php echo get_post_meta(get_the_ID(), 'tour_sub_title', true) ?></h3>
           <h2 class="ht-section-title"><?php the_title(); ?></h2>
           <div class="sub-text">
            <?php the_excerpt(); ?>
           </div>
         </div>
        </div>
        <?php
          }
        ?>
            
         <div class="ht-tours-row ht-clearfix">  

          <?php 
            $bar_args = array( 'post_type' => 'total_tours', 'posts_per_page' => -1 );
            $bar_loop = new WP_Query( $bar_args );
            while ( $bar_loop->have_posts() ) : $bar_loop->the_post();
          ?>

          <div class="ht-tours-col">

            <div class="tours_grid_item">
              <div class="tours-image-box">
                <div class="tours-image" style="background: url(<?php echo the_post_thumbnail_url(); ?>) no-repeat;">
                 <!--<img src="<?php //echo the_post_thumbnail_url(); ?>" class="img-responsive" alt="Image">-->
                </div>
                <div class="tours-image-overlay">
                  <span> <?php the_title(); ?> </span>
                </div>
              </div>
              
              <div class="tours_info">
                  <h3><?php the_title(); ?></h3>
                  
                 <div class="details">
                 
                    <div class="tours-description">
                     <?php echo substr(get_the_content(), 0, 100); ?>
                    </div>
                 
                    <span class="price">Price: <?php the_field('tour_cost'); ?></span>
                    <h4 class="box-title">City Tour</h4>
                     <div class="tours-details">
                      <?php the_field('tour_features'); ?>
                     </div> 
                    <div class="tours-details-time">
                        <div class="time">
                            <i class="soap-icon-clock yellow-color"></i>
                            <span><?php the_field('tour_duration'); ?></span>
                        </div>
                    </div>

                </div>
                  
               </div>
            </div>
           
          </div>

          <?php endwhile; wp_reset_postdata();  ?>
         </div>
         
		</div><!-- #main -->
	</div><!-- #primary -->
  </div>
</section>

<?php 
  while(have_posts()) { the_post();
?>
<section id="services" class="tours-bottom-section">
    <div class="ht-container ht-clearfix">					
     <div class="tours-bottom-section-left">						
        <?php the_content(); ?>
    </div>
    
    <div class="tours-bottom-section-right">
     <div class="tours-bottom-image">
      <span class="tours-bottom-bg-1"> 
        <img src="<?php the_post_thumbnail_url(); ?>" /> </span>
     </div>
    </div>
    </div>
</section>
 <?php
    }
  ?>


<section id="ht-blog-section" class="ht-section">
	<div class="ht-container">
		<?php
		$total_blog_title = get_theme_mod('total_blog_title');
		$total_blog_sub_title = get_theme_mod('total_blog_sub_title');
		?>
		<?php if($total_blog_title || $total_blog_sub_title){ ?>
		<div class="ht-section-title-tagline">
		<?php if($total_blog_title){ ?>
        <div class="section-header">
                   <h3 class="ht-section-sub-title">our blog</h3>
                   <h2 class="ht-section-title"><?php echo esc_html($total_blog_title); ?></h2>
        </div>
		
		<?php } ?>

		<?php if($total_blog_sub_title){ ?>
        
		<div class="ht-section-tagline"><?php echo esc_html($total_blog_sub_title); ?></div>
		<?php } ?>
		</div>
		<?php } ?>

		<div class="ht-blog-wrap ht-clearfix">
		<?php 
			$total_blog_post_count = get_theme_mod('total_blog_post_count', 3 );
			$total_blog_cat_exclude = get_theme_mod('total_blog_cat_exclude');
            $total_blog_cat_exclude = explode(',', $total_blog_cat_exclude);

			$args = array(
				'posts_per_page' => absint($total_blog_post_count),
				'category__not_in' => $total_blog_cat_exclude
				);
			$query = new WP_Query($args);
			if($query -> have_posts()):
				while($query -> have_posts()) : $query -> the_post();
				$total_image = wp_get_attachment_image_src(get_post_thumbnail_id() , 'total-blog-thumb');
				?>
				<div class="ht-blog-post ht-clearfix">
					<?php 
					if(has_post_thumbnail()){
					?> 
						<div class="ht-blog-thumbnail">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($total_image[0]) ?>" alt="<?php the_title(); ?>"></a>
						</div>
					<?php
					}
					?>
					<div class="ht-blog-excerpt">
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<div class="ht-blog-date"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php echo get_the_date(); ?></div>
						<?php 
						if(has_excerpt()){
							echo get_the_excerpt();
						}else{
							echo total_excerpt( get_the_content() , 190 );
						}
						?>
					</div>

					<!--<div class="ht-blog-read-more">
						<a href="<?php the_permalink(); ?>"><?php _e('Read More', 'total'); ?></a>
					</div>-->
				</div>
				<?php
				endwhile;
			endif;
			wp_reset_postdata();
		?>
		</div>	
	</div>
</section>

<?php get_footer(); ?>
