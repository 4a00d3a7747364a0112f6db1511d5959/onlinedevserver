<?php

/*

 * The loop that displays a single post

 */

get_header(); 

?>
<section class="banner-div clearfix">
    <div class="sub-banner" style="background:url(<?php echo $church_options['blog_common_banner']['url']; ?>) no-repeat center center;">
     <div class="overlay">
      <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
          <?php 
          $spanvalue = get_the_title();
          $words = 1;
          $words = $words-1;
        $arr = explode(' ',trim($spanvalue));
        $arrre = '';
        for($sb = 0; $sb <= count($arr); $sb++){
          $arrre .= $arr[$sb].' ';          
          if($words == $sb){ 
            $arrre .="<span>";
          }else{

          }
        }
        ?>
        <h3><?php echo $arrre; ?></span></h3>
        <?php endwhile; ?>

        <?php echo do_shortcode( '[breadcrumb]' ); ?>
      </div>
     </div>
    </div>
</section>

<section class="inner-div">
  <div class="container">
    	
          <div class="col-md-12 col-sm-12"> 
            <!--<div class="inner-page-heading">
              <h2 class="inner-page-heading"><span><?php //the_title(); ?></span></h2>
            </div> -->
			<div class="left-content">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                   <div class="blog-details-image-box">
					<?php
	                  if ( has_post_thumbnail() ) { 
	                ?>
	                 <div class="blog-details-img"> <img class="img-responsive" src="<?php echo the_post_thumbnail_url(); ?>" alt="" > </div>
	                <?php 
	                  }
	                ?>

                     <div class="single-post-meta">
                  		<p>Posted by <?php the_author(); ?> on <?php the_time('F j, Y'); ?></p>
                  </div>
                   </div>
                  <div class="blog-tags">
                  	<?php the_tags( 'Tags: ', ' ', '<br />' ); ?>
                  </div>

					<div class="entry-meta">

						<?php //procard_posted_on(); ?>

					</div><!-- .entry-meta -->


                    <div class="entry-content-blog">
				      <div class="entry-content">
                      
                      <?php the_title(); ?>
                                           
						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'church' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->
                    </div>



					<?php if ( get_the_author_meta( 'description' ) ) :  ?>

					<div id="entry-author-info">

						<div id="author-avatar">

							<?php

							/** This filter is documented in author.php */

							echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'procard_author_bio_avatar_size', 60 ) );

							?>

						</div><!-- #author-avatar -->

						<div id="author-description">

							<h2><?php printf( __( 'About %s', 'church' ), get_the_author() ); ?></h2>

							<?php the_author_meta( 'description' ); ?>

							<div id="author-link">

								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">

									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'church' ), get_the_author() ); ?>

								</a>

							</div><!-- #author-link	-->

						</div><!-- #author-description -->

					</div><!-- #entry-author-info -->

<?php endif; ?>



					<div class="entry-utility">

						<?php //procard_posted_in(); ?>

						<?php edit_post_link( __( 'Edit', 'church' ), '<span class="edit-link">', '</span>' ); ?>

					</div><!-- .entry-utility -->

				</div><!-- #post-## -->



				<div id="nav-below" class="navigation" style="display: none;">

					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'church' ) . '</span> %title' ); ?></div>

					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'church' ) . '</span>' ); ?></div>

				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div>
          </div>  
		</div>
</section>

  

<?php get_footer(); ?>