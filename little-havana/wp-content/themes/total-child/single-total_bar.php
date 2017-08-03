<?php
/**
 * Single bar template
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

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <div class="ht-room-col ht-clearfix">

            <div class="room_grid_item">
              <figure>               
                 <img src="<?php echo the_post_thumbnail_url(); ?>" class="img-responsive" alt="Image">
              </figure>
              
              <div class="room_info">
                  <h3><?php the_title(); ?></h3>
                  <?php echo substr(the_content(), 0, 50); ?>
               </div>
            </div>
           
          </div>

          <?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
  </div>
</section>  

<?php get_footer();
