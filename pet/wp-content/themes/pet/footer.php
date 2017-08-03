<?php
/*
 * The template for displaying the footer
 */
global $pet_options; 
?>

  <?php if( is_front_page() ){ ?>

    <section id="boutique">
      <div class="container">
         <div class="inner-main-container clearfix">
               <div class="boutique-left">
                 <div class="boutique-left-img">
                  <!--<img src="http://onlinedevserver.biz/dev/pet/wp-content/uploads/2017/05/pmao-123-2.jpg"/>-->
                  <img src="http://onlinedevserver.biz/dev/pet/wp-content/uploads/2017/05/pmao-123-4.jpg"/>
                 </div> 
                  <?php echo $pet_options['binkys-pet-title']; ?>
                  <div class="boutique-btn desktop">
                      <?php if( !empty($pet_options['binkys-in-memorial-link']) ){ ?>
                      <a href="<?php echo site_url('/').$pet_options['binkys-in-memorial-link']; ?>" class="more_btn"><?php echo $pet_options['binkys-in-memorial-btn-text']; ?></a>
                      <?php } ?>
                      <?php if( !empty($pet_options['binkys-senior-pet-care-link']) ){ ?>
                      <a href="<?php echo site_url('/').$pet_options['binkys-senior-pet-care-link']; ?>" class="more_btn"><?php echo $pet_options['binkys-senior-pet-care-btn-text']; ?></a>
                      <?php } ?>
                      <?php if( !empty($pet_options['binkys-pampered-pets-link']) ){ ?>
                      <a href="<?php echo site_url('/').$pet_options['binkys-pampered-pets-link']; ?>" class="more_btn"><?php echo $pet_options['binkys-pampered-pets-btn-text']; ?></a>
                      <?php } ?>
                  </div>
               </div>
               <div class="boutique-right">
                  <div class="boutique-image-1">
                    <img src="<?php echo $pet_options['binkys-pet-third-image']['url']; ?>">
                  </div>
                  <div class="boutique-image-2">
                    <img src="<?php echo $pet_options['binkys-pet-second-image']['url']; ?>">
                  </div>                  
                  <div class="boutique-image-3">                    
                    <img src="<?php echo $pet_options['binkys-pet-first-image']['url']; ?>">
                  </div>
               </div>
               <div class="boutique-btn mobile">
                  <?php if( !empty($pet_options['binkys-in-memorial-link']) ){ ?>
                  <a href="<?php echo site_url('/').$pet_options['binkys-in-memorial-link']; ?>" class="more_btn"><?php echo $pet_options['binkys-in-memorial-btn-text']; ?></a>
                  <?php } ?>
                  <?php if( !empty($pet_options['binkys-pampered-pets-link']) ){ ?>
                  <a href="<?php echo site_url('/').$pet_options['binkys-pampered-pets-link']; ?>" class="more_btn"><?php echo $pet_options['binkys-pampered-pets-btn-text']; ?></a>
                  <?php } ?>
                  <?php if( !empty($pet_options['binkys-senior-pet-care-link']) ){ ?>
                  <a href="<?php echo site_url('/').$pet_options['binkys-senior-pet-care-link']; ?>" class="more_btn"><?php echo $pet_options['binkys-senior-pet-care-btn-text']; ?></a>
                  <?php } ?>
              </div>
         </div>
      </div>
    </section>

    <section id="memorial">
      <div class="container">
         
         <?php echo $pet_options['memoriam-pet-content']; ?>

        <?php 
          //$img_first = $pet_options['memoriam-pet-fifth-image']['id'];
          //$img_first_src = wp_get_attachment_image_src( $img_first, 'sb-custom-size-3');
          //print_r($pet_options['memoriam-pet-first-image']); 
          //print_r($img_first_src); 
        ?>
 
        <div class="memorial-image">
           <ul class="clearfix gallery">
               <li><a href="<?php echo $pet_options['memoriam-pet-first-image']['url']; ?>"><img src="<?php echo $pet_options['memoriam-pet-first-image']['url']; ?>" alt="#"></a>
                   <div class="pin-top-left"></div>
                   <div class="pin-top-right"></div>
                   <div class="pin-bottom-right"></div>
                   <div class="pin-bottom-left"></div>
               </li>
               <li><a href="<?php echo $pet_options['memoriam-pet-second-image']['url']; ?>"><img src="<?php echo $pet_options['memoriam-pet-second-image']['url']; ?>" alt="#"></a>
                  <div class="pin-top-left"></div>
                   <div class="pin-top-right"></div>
                   <div class="pin-bottom-right"></div>
                   <div class="pin-bottom-left"></div>
               </li>
               <li><a href="<?php echo $pet_options['memoriam-pet-third-image']['url']; ?>"><img src="<?php echo $pet_options['memoriam-pet-third-image']['url']; ?>" alt="#"></a>
                  <div class="pin-top-left"></div>
                   <div class="pin-top-right"></div>
                   <div class="pin-bottom-right"></div>
                   <div class="pin-bottom-left"></div>
               </li>
               <li><a href="<?php echo $pet_options['memoriam-pet-fourth-image']['url']; ?>"><img src="<?php echo $pet_options['memoriam-pet-fourth-image']['url']; ?>" alt="#"></a>
                  <div class="pin-top-left"></div>
                   <div class="pin-top-right"></div>
                   <div class="pin-bottom-right"></div>
                   <div class="pin-bottom-left"></div>
               </li>
               <li><a href="<?php echo $pet_options['memoriam-pet-fifth-image']['url']; ?>"><img src="<?php echo $pet_options['memoriam-pet-fifth-image']['url']; ?>" alt="#"></a>
                  <div class="pin-top-left"></div>
                   <div class="pin-top-right"></div>
                   <div class="pin-bottom-right"></div>
                   <div class="pin-bottom-left"></div>
               </li>
           </ul>
        </div>
      </div>
    </section>
    
    <?php } ?>

	<footer>
    	<div class="container footer">
    		<div class="footer_top">
    			<h4>EXPLORE SELECTIONS</h4>
    			<?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'top', 'menu_id' => '', 'theme_location' => 'footer-menu', 'link_before' => '<span>', 'link_after' => '</span>', )); ?>
    		</div>
    		<div class="bottom">
    			<div class="social_area">
    				<ul class="social">
    					<?php if( !empty($pet_options['facebook']) ){ ?>
						<li><a href="<?php echo $pet_options['facebook']; ?>" target="_blank" title="Follow us on Facebook"><i class="fa fa-facebook"></i></a></li>
						<?php } ?>
						<?php if( !empty($pet_options['twitter']) ){ ?>
    					<li><a href="<?php echo $pet_options['twitter']; ?>" target="_blank" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>
    					<?php } ?>
    					<?php if( !empty($pet_options['pinterest']) ){ ?>
    					<li><a href="<?php echo $pet_options['pinterest']; ?>" target="_blank" title="Follow us on Pinterest"><i class="fa fa-pinterest"></i></a></li>
    					<?php } ?>
    					<?php if( !empty($pet_options['instagram']) ){ ?>
    					<li><a href="<?php echo $pet_options['instagram']; ?>" target="_blank" title="Follow us on Instagram"><i class="fa fa-instagram"></i></a></li>
    					<?php } ?>
    					<?php if( !empty($pet_options['mail']) ){ ?>
    					<li><a href="mailto:<?php echo $pet_options['mail']; ?>" title="Mail us"><i class="fa fa-envelope"></i></a></li>
    					<?php } ?>
    				</ul>
    			</div>
    			<div class="footer_logo">
    				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('title'); ?>">
                            <?php if(!empty($pet_options['logo-foot'])) { ?> <img src="<?php echo $pet_options['logo-foot']['url']; ?>"> <?php } ?>
                        </a>
    				<p>Copyright &copy; <?php echo date('Y'); ?> <?php echo $pet_options['copyright']; ?></p>
    			</div>
    			<div class="newsletter">
    				<h4>Get Our Newsletter</h4>
    				<div class="news_form">
    					<input type="email" name="" placeholder="Enter Email ID">
    					<button class="submit" type="submit">SUBMIT</button>
    				</div>
    			</div>
    		</div>
    	</div>
    </footer>

	<?php wp_footer(); ?>

	</body>

</html>