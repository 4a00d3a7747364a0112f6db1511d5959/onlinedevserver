<?php
/*
* The template for inner pages
*/
get_header(); ?>

<!-- inner banner -->
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

<section class="inner-div clearfix">
	<div class="container">
	 	<div class="row">
	 	 	<div class="col-lg-12 col-md-12">
				<div class="main-content" style="min-height: 300px;">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					    <?php the_content(); ?>	
				    <?php endwhile; endif; ?>
				</div>
			</div>
		</div>
    </div>
</section>

<?php get_footer(); ?>