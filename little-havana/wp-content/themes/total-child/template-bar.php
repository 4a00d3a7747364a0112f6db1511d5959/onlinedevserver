<?php
/**
 * Template Name: Bar Page Template
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
           <h3 class="ht-section-sub-title">SERVICE</h3>
           <h2 class="ht-section-title">Bar</h2>
         </div>
        </div>

          <?php 
            $bar_args = array( 'post_type' => 'total_bar', 'posts_per_page' => -1 );
            $bar_loop = new WP_Query( $bar_args );
            while ( $bar_loop->have_posts() ) : $bar_loop->the_post();
          ?>
          
          

          <div class="ht-col-box ht-clearfix">

            <div class="room_grid_item">
              <figure>
                <a href="javascript:void(0)" class="hover_effect"><img src="<?php echo the_post_thumbnail_url(); ?>" class="img-responsive" alt="Image"></a>
              </figure>
              
              <div class="col_info">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <!--<span class="">€129 / night</span>-->
                  <p> <?php echo substr(get_the_content(), 0, 100).'...'; ?> </p>
                 <!-- <div class="room_services">
                   <span> <i class="fa fa-coffee"></i> </span>
                   <span> <i class="fa fa-cutlery"></i> </span> 
                   <span> <i class="fa fa-television"></i> </span> 
                  </div>-->
                  <div class="info-btn">
                   <a href="<?php the_permalink(); ?>" class="button btn_more">Read More</a>
                  </div> 
               </div>
            </div>
           
          </div>

          <?php endwhile; wp_reset_postdata();  ?>

		</main><!-- #main -->
	</div><!-- #primary -->
  </div>
</section>  

<section class="light_section no_padding vcenter">
  <div class="container-fluid clearfix">
    <div class="row">
      <div class="ht-col-md-8">
        
          <div class="stretchy_wrapper ratio_full">
            <img src="http://onlinedevserver.biz/dev/little-havana/wp-content/uploads/2017/05/banner-2.jpg" / alt="bar-images" class="img-responsive">
          </div>
       
      </div>
      <div class="ht-col-md-6">
        
          <div class="stretchy_wrapper-right text_block">
            <h3>Wine Tasting</h3>
            <span>FAMOUS WINES</span>
            <p>They're seas gathering behold the years saying make and divide fill given whales fill female moved, blessed. Midst one from divide whales seasons cattle male own saying to night fruit own creeping second earth be lesser without deep beast female.</p>
            
            <div class="info-btn">
             <a href="javascript:void(0)" class="button btn_more">MORE DETAILS</a>
            </div>
            
            
          </div>
        
      </div>
    </div>
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
							echo total_excerpt( get_the_content() , 180 );
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
