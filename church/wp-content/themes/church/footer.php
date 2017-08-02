<?php

/*

 * The template for displaying the footer

 */

global $church_options; 

?>

<footer>
<div class="container"> 
  
  <div class="row">
    <div class="col-md-6"> 

      <ul class="row">            
        <li class="col-sm-6 shadow">
          <ul class="social_icons">
            <?php if(!empty($church_options['facebook_link'])){ ?>
            <li class="facebook"><a href="<?php echo $church_options['facebook_link']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <?php } ?>
            <?php if(!empty($church_options['twitter_link'])){ ?>
            <li class="twitter"><a href="<?php echo $church_options['twitter_link']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>
            <?php if(!empty($church_options['google_link'])){ ?>
            <li class="googleplus"><a href="<?php echo $church_options['google_link']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <?php } ?>
            <?php if(!empty($church_options['instagram_link'])){ ?>
            <li class="instagram"><a href="<?php echo $church_options['instagram_link']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>
            <?php if(!empty($church_options['youtube_link'])){ ?>
            <li class="soundcloud"><a href="<?php echo $church_options['youtube_link']; ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
            <?php } ?>
          </ul>
          
          
          <?php echo $church_options['keep_in_touch']; ?>

          <div class="subcribe">
            <form>
              <input type="text" placeholder="Email Address" required>
              <button type="submit"><i class="fa fa-sign-in"></i></button>
            </form>
          </div>
        </li>
        
        <li class="col-sm-6 footer-col">
          <h4>useful links</h4>
          <!-- <ul class="links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Meet The Team</a></li>
            <li><a href="#">Volunteers</a></li>
            <li><a href="#">Service Provided</a></li>
            <li><a href="#">Latest News</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul> -->
          <?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'links', 'menu_id' => '', 'theme_location' => 'useful-menu', 'link_before' => '<span>', 'link_after' => '</span>', )); ?>
        </li>
      </ul>
    </div>
    
    <div class="col-md-6">
      <ul class="row">
        
        <li class="col-sm-6">
          <div class="tweet">
           <h4>Latest Tweets</h4>
            <!-- <p>Eaque ipsa quae ab illo inventore veris 
                      quasi architecto beatae vitae dicta exp
                      enim ipsam voluptatem.</p>
                    <a href="#">http://rccgalbanyny</a> 
                    <span><i class="fa fa-twitter-square"></i> 3.00 PM, 24 May 2015</span>  --> 
              <?php if ( is_active_sidebar( 'church-twitter-widget' ) ) { ?>
                  <?php dynamic_sidebar( 'church-twitter-widget' ); ?>
              <?php } ?>       
          </div>
        </li>
        
        <li class="col-sm-6 footer-col">
          <h4>FACEBOOK FEEDS</h4>
          <!-- <ul class="links">
            <li><a href="#">How to Donate</a></li>
            <li><a href="#">Donation List</a></li>
            <li><a href="#">Recent Causes</a></li>
            <li><a href="#">FAQ</a></li>
            <li></li>
          </ul> -->
          <?php //wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'links', 'menu_id' => '', 'theme_location' => 'links-menu', 'link_before' => '', 'link_after' => '', )); ?>

          <div class="footer-donate-btn" style="display: none;"><a href="#" class="btn">Donate now!</a></div>
          <?php if ( is_active_sidebar( 'church-facebook-widget' ) ) { ?>
              <?php dynamic_sidebar( 'church-facebook-widget' ); ?>
          <?php } ?>    
        </li>
      </ul>
    </div>
  </div>
</div>

  <div class="rights">
   <p class="text-uppercase">Copyright &copy; <?php echo date('Y'); ?> <?php echo $church_options['copyright_info']; ?></p>
  </div>
</footer>

<a href="#" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>

	<?php wp_footer(); ?>

	</body>


<script>

jQuery(document).ready(function(){
	
			console.log(jQuery('.fp-player').html());
	
	  });

</script>




</html>
