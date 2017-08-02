<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Ascend_Theme
 * @since 1.0
 * @version 1.0
 */

?>

<!-- Footer Start -->
<footer>
  <div class="footer_back">
    <div class="footer_wrap">
      <h5>Quality Custom Sportswear made Easy</h5>
      <div class="footer_border clearfix">
        <div class="container clearfix">
          <div class="footer_left_row clearfix">
       	<?php   if ( is_active_sidebar( 'sidebarleftfooter' ) ) 
				{ 

					dynamic_sidebar('sidebarleftfooter');
		
				}
         ?>
            <div class="footer_row business_hour">
              <ul>
                <li class="footer_owned"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/footer_usa.png"/></a></li>
              </ul>
            </div>
          </div>
          <div class="footer_center_row">

			<?php if ( is_active_sidebar( 'center_footer_sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'center_footer_sidebar' ); ?>
			<?php endif; ?>

          </div>
          <div class="footer_right_row">
            <?php if ( is_active_sidebar( 'right_footer_sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'right_footer_sidebar' ); ?>
			<?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="footer_copyright">
      <p> <?php echo get_option('webq_footer_text');?></p>
      <ul class="footer_social">
        <li><a href=" <?php echo get_option('webq_fb_link');?>"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
        <li><a href=" <?php echo get_option('webq_twt_link');?>"><i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
        <li><a href=" <?php echo get_option('webq_pin_link');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram_footer.png"/> </a></li>
      </ul>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/easyzoom.js"></script>
	<script>
		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});
	</script>

<!-- Footer End --> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js"></script> 


<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/owl.carousel.min.js"> </script>
-->

<?php wp_footer(); ?>
</div>
</body>

</html>
