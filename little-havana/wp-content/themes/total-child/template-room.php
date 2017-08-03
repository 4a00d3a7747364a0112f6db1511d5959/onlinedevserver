<?php
/**
 * Template Name: Room Page Template
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
          <div class="ht-room-col ht-clearfix">
                    
                    <div class="room_grid_item">
                       <figure>
                          <a href="#" class="hover_effect"><img src="http://onlinedevserver.biz/dev/little-havana/wp-content/uploads/2017/04/room2.jpg" class="img-responsive" alt="Image"></a>
                       </figure>
                       <div class="room_info">
                          <h3><a href="room.html">Double Room</a></h3>
                          <span>€129 / night</span>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore...</p>
                          <div class="room_services">
                           <span> <i class="fa fa-coffee"></i> </span>
                           <span> <i class="fa fa-cutlery"></i> </span> 
                           <span> <i class="fa fa-television"></i> </span> 
                          </div>
                          <a href="room.html" class="button  btn_blue btn_full upper mt20">Book Now</a>
                       </div>
                    </div>
           
          </div>
		</main><!-- #main -->
	</div><!-- #primary -->
  </div>

<?php get_footer();
