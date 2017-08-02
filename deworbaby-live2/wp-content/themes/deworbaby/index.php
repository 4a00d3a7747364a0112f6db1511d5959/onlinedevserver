<?php

/*

* The template for index page of blog

*/
get_header(); 

global $deworbaby_options;
?>

	<section class="inner-div clearfix">		
		<div class="container">
			<h2 class="inner-page-heading"><span><?php echo $deworbaby_options['blog_title']; ?></span></h2>
			<div class="left-content">
				<ul>
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<li>
						<div class="blog-box">
							<div class="blog-img">
								<a href="<?php the_permalink(); ?>">
								<?php 
				                    if ( has_post_thumbnail() ) { 
				                    the_post_thumbnail( 'full' );
				                  }
				                  else { ?>
				                    <?php _e( 'Sorry, no image found' ); ?>
				                  <?php }
				                ?>
				                </a>
			                </div>
			                <div class="blog-heading">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
							<div class="blog-content">
								<p><?php echo excerpt(20); ?></p>
								<p><a class="getDetails" href="<?php the_permalink(); ?>">Get Details <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
							</div>
						</div>
                     </li>
                    <?php endwhile; endif; ?>
				</ul>				
			</div>
			<div class="right-content">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>