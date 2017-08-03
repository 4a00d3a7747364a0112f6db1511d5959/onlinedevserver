<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>

	<section id="bottom_nav">
        <div class="container">
               <div class="bottom">
                <div class="">
                    <ul class="pet-blog">
                        <li><a href="<?php echo site_url(); ?>/"><i class="fa fa-clock-o"></i>Latest Posts</a></li>
                        <li><a href="<?php echo site_url(); ?>/category/trending/"><i class="fa fa-bolt"></i>Trending</a></li>
                        <li><a href="<?php echo site_url(); ?>/category/editors-choice/"><i class="fa fa-star"></i>Editors choice</a></li>
                    </ul> 
                </div>
               </div>
        </div>
    </section>

	<section id="top-blog-section">    
        <div class="container clearfix">
          <div class="inner-main-container">
              <div class="blogg clearfix">
			<h2 class="page-title inner-page-heading"><span><?php _e( 'Not Found!!!', 'pet' ); ?></span></h2>
			<div class="left-content">
				<h4><?php _e( 'This is somewhat embarrassing, isn’t it?', 'pet' ); ?></h4>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'pet' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
          </div>              
        </div>        
    </section>

<?php get_footer(); ?>