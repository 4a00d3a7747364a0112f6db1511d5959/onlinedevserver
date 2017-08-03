<?php
/**
 * Template Name: Events Page Template
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
		<main id="main" class="site-main">
          
           <div class="inner-heading">
             <div class="section-header">
               <h3 class="ht-section-sub-title">OUR EVENTS</h3>
               <h2 class="ht-section-title">Events</h2>
               <div class="sub-text"><p> Grand Opening!  Party Daily, Sleep Well...  </p>
               </div>
             </div>
            </div>
            

          
          <div class="events-box"> 
                  
           <div class="row">
           
           <?php 
            $bar_args = array( 'post_type' => 'total_events', 'posts_per_page' => -1 );
            $bar_loop = new WP_Query( $bar_args );
			$j=1;
			$class_name = ""; // get the class name for time line
            while ( $bar_loop->have_posts() ) : $bar_loop->the_post();
			if($j%2==0)
			{
			$class_name = "events-box-row-alternative";	
			}
			else
			{
			  $class_name = "";	
			}
          ?>
           
             <div class="events-box-row clearfix <?php echo $class_name;?>">
                <div class="events-box-image">
                    <div class="events-image">
                        <div class="hover_effect"><img src="<?php echo the_post_thumbnail_url('full'); ?>" class="img-responsive" alt="Image"></div>
                    </div>
                </div>
                <div class="events-box-content">
                    <div class="events-box-content-col">
                     <div class="hotel-weeding-offer">
                        <h3><?php the_title(); ?></h3>
                        <p><span>1500</span><del>$2000</del>/Per Night</p>
                     </div>
                     <div class="event-content">
                      <p><?php echo substr(get_the_content(), 0, 250).'...'; ?></p>  
                     </div>
                    </div>
                </div>
             </div>  
             
             <?php $j++; endwhile; wp_reset_postdata();  ?>
             
            
            </div>
            
          </div>
          

		</main><!-- #main -->
	</div><!-- #primary -->
  </div>
</section>  

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
