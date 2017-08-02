<?php
/*
  * Template Name: Restoration Page Template
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
            <div class="col-md-8 col-sm-8">
             <div class="restoration-assembly-content-box">
              <div class="inner-page-heading">
               <h2> Restoration Assembly Albany </h2>
              </div>
              <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <?php the_content(); ?>	
              <?php endwhile; endif; ?>
             </div> 
            </div>
            
            <div class="col-md-4 col-sm-4">
             <div class="inner-right-images">
             <?php if(have_posts()) : while(have_posts()) : the_post(); ?>              
              <?php 
                if( has_post_thumbnail() ) { ?>
                    <img class="img-responsive" src="<?php echo the_post_thumbnail_url( 'full' ); ?>"/>
                <?php  }
              ?>
              <?php endwhile; endif; ?>
             </div>
            </div>
            
         </div>
  
		</div>
    </div>
 </div>   
 
 <!-- leadrsship -->
 <div class="leadrsship-div">   
      <div class="container"> 
        
        <!-- TITTLE -->
        <div class="inner-page-heading inner-heading">
           <h2><?php the_field('leadership_section_title'); ?></h2>
          <?php the_field('leadership_section_sub_title'); ?>
        </div>
        
        <!-- leadrsship row -->
          <div class="row"> 
            <?php 
              $leader1 = get_field('first_leadership_block_image');
              $leader2 = get_field('second_leadership_block_image');
              $leader3 = get_field('third_leadership_block_image');
              $leader4 = get_field('fourth_leadership_block_image');
            ?>
          <!-- leadrsship col -->
              <!-- leadrsship 1 -->
              <div class="col-sm-3">
               <div class="leadrsship-box">
                <div class="avatar"> 
                  <img class="img-responsive" src="<?php echo $leader1['url']; ?>" alt=""> 
                </div>
                <div class="donor-details">
                  <h5><?php the_field('first_leadership_block_title'); ?></h5>
                  <p><?php the_field('first_leadership_block_designation'); ?></p>
                  <!--<span>Donated : <strong>$252</strong></span>-->
                  
              </div>
               </div>
              </div>
              <!-- DONATOR 2 -->
              <div class="col-sm-3">
               <div class="leadrsship-box">
                <div class="avatar"> <img class="img-responsive" src="<?php echo $leader2['url']; ?>" alt=""> </div>
                <div class="donor-details">
                  <h5><?php the_field('second_leadership_block_title'); ?></h5>
                  <p><?php the_field('second_leadership_block_designation'); ?></p>
                  <!--<span>Donated : <strong>$252</strong></span>-->
              </div>
               </div>
              </div>
              <!-- leadrsship 1 -->
              <div class="col-sm-3">
               <div class="leadrsship-box">
                <div class="avatar"> <img class="img-responsive" src="<?php echo $leader3['url']; ?>" alt=""> </div>
                <div class="donor-details">
                  <h5><?php the_field('third_leadership_block_title'); ?></h5>
                  <p><?php the_field('third_leadership_block_designation'); ?></p>
                  <!--<span>Donated : <strong>$252</strong></span>-->
                </div>
               </div> 
              </div>  
              
              <!-- DONATOR 2 -->
              <div class="col-sm-3">
               <div class="leadrsship-box">
                <div class="avatar"> <img class="img-responsive" src="<?php echo $leader4['url']; ?>" alt=""> </div>
                <div class="donor-details">
                  <h5><?php the_field('fourth_leadership_block_title'); ?></h5>
                  <p><?php the_field('fourth_leadership_block_designation'); ?></p>
                  <!--<span>Donated : <strong>$252</strong></span>-->
                </div>
               </div> 
              </div>  
          </div>
          
      </div>
 </div>   
   
</section>



<?php get_footer(); ?>