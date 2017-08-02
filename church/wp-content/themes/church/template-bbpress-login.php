<?php
/*
* Template Name: BBPress Forum Login
*/

global $church_options;

get_header(); ?>

<!-- inner banner -->
<section class="banner-div clearfix">
    <div class="sub-banner" style="background:url(<?php echo $church_options['testimony_banner']['url']; ?>) no-repeat center center; background-size:cover;">
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

<section class="inner-div clearfix">
	<div class="container">
	 	<div class="row">
	 	 	<div class="col-lg-12 col-md-12">
				<div class="main-content testimony-login-div">
					<!-- <?php //if(have_posts()) : while(have_posts()) : the_post(); ?>
              <?php //the_content(); ?>  
              <?php //endwhile; endif; ?> -->
              <?php 
                if (!is_user_logged_in()){
                  echo do_shortcode('[bbp-login]');
                } else { ?>
               <div class="testimony-login-btn-div">  
                <p>Welcome back <?php $current_user = wp_get_current_user(); echo '<span style="text-transform: capitalize;">'.$current_user->user_login.'</span>'; ?>!!! Please click below button to provide your testimony or join the conversation.</p>
                
                 <a href="<?php echo esc_url(home_url('/')); ?>forums/forum/join-the-conversation/" class="btn-donate black-btn btn-big">Join Our Conversation <span> <i class="fa fa-long-arrow-right"></i> </span></a>
               </div>  
              <?php
                }
              ?>

				</div>
			</div>
		</div>
    </div>
</section>

<?php get_footer(); ?>