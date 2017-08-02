<?php
/*
  * Template Name: Give Online Page Template
*/
get_header(); ?>
<section class="banner-div clearfix">
    <div class="sub-banner" style="background:url(<?php echo $church_options['blog_common_banner']['url']; ?>) no-repeat center center;background-size:cove;">
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

<!-- inner content -->
<section class="inner-div restoration-assembly-div">
 
  <div class="inner-box restoration-assembly">
    <div class="inner-overlay"></div>
      <div class="container">
        <div class="row">
          <div class="main-content clearfix">
           <div class="restoration-assembly-content-box">
            <div class="give-online-div clearfix">
            <div class="col-md-6 col-sm-6">
             
              <div class="give-online-box">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>                  
                <div class="row">
                  <div class="col-md-12">
                     <?php the_content(); ?>
                  </div>
                </div>
               <?php endwhile; endif; ?>
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6">             
              <div class="give-online-box give-online-box-right">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>                  
                <div class="row">
                  <div class="col-md-12">
                     <?php the_field('amazone_donate_section'); ?>
                  </div>
                </div>
              <?php endwhile; endif; ?>
             </div> 
             </div>
            </div> 
           </div> 
                       
          </div>
        </div>
      </div>
  </div>  

 
   
</section>



<?php get_footer(); ?>