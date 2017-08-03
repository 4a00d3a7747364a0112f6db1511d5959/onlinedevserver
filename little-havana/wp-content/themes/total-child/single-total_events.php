<?php
/**
 * Single events template
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

  <div class="ht-container">
	 <div id="primary" class="content-area">
		<main id="main" class="site-main">

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <div class="ht-room-col ht-clearfix">

            <div class="room_grid_item">
              <figure>
                <a href="javascript:void(0)" class="hover_effect"><img src="<?php echo the_post_thumbnail_url(); ?>" class="img-responsive" alt="Image"></a>
              </figure>
              
              <div class="room_info">
                  <h3><a href="#"><?php the_title(); ?></a></h3>
                  <span>€129 / night</span>
                  <?php echo substr(the_content(), 0, 50); ?>
                  <div class="room_services">
                   <span> <i class="fa fa-coffee"></i> </span>
                   <span> <i class="fa fa-cutlery"></i> </span> 
                   <span> <i class="fa fa-television"></i> </span> 
                  </div>
                  <a href="#" class="button  btn_blue btn_full upper mt20">Book Now</a>
               </div>
            </div>
           
          </div>

          <?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
  </div>

<?php get_footer();
