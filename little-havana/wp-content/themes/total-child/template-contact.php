<?php
/**
 * Template Name: Contact Page Template
 *
 * @package Total
 */

get_header(); ?>

<header class="ht-main-header">
  <div class="ht-container">
    <?php the_title( '<h1 class="ht-main-title">', '</h1>' ); ?>
    <?php do_action( 'total_breadcrumbs' ); ?>
  </div>
</header>
<!-- .entry-header -->

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
            <h2 class="ht-section-title">
              <?php the_title(); ?>
            </h2>
          </div>
        </div>
        <?php
          }
        ?>
        <div class="ht-contact-row ht-clearfix">
          <div class="contact-details">
            <div class="contact-info">
              <h2>Contact Info</h2>
              <div class="media-contact clearfix">
                <div class="media-contact-icon"> <i class="fa fa-map-marker" aria-hidden="true"></i> </div>
                <div class="media-contact-info">
                  <p>Lake Resort, Lorance 542B, Tailstoi Town 5248 MT, Wordwide Country</p>
                </div>
              </div>
              <div class="media-contact clearfix">
                <div class="media-contact-icon"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </div>
                <div class="media-contact-info">
                  <p> <a href="mailto:Info@Resorthotel.Com">littlehavanahotel@gmail.com</a><br>
                    <a href="mailto:support@Resorthotel.Com">support@littlehavanahotel.Com</a> </p>
                </div>
              </div>
              
              <div class="media-contact clearfix">
                <div class="media-contact-icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                <div class="media-contact-info">
                  <p> <a href="tel:18005622487"><i>U.S.A: 800-247-7052</i></a><br>
                    <a href="tel:32155468975"><i>C.R. (506) 2222-7065</i></a> </p>
                </div>
              </div>
            </div>
          </div>
          <div class="contact-form-box">
            <?php 
                while ( have_posts() ) { the_post();
              ?>
            <?php the_content(); ?>
            <?php }  ?>
          </div>
        </div>
      </div>
      <!-- #main --> 
    </div>
    <!-- #primary --> 
  </div>
</section>
<?php 
	  while(have_posts()) { the_post();
	?>
<section id="contact-map" class="contact-map-box">
  <?php the_excerpt(); ?>
</section>
<?php
		}
	  ?>
<?php get_footer(); ?>
