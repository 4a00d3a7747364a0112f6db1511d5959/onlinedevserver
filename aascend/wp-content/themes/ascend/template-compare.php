<?php
/**
 * Template Name: Compare Template
 */
 
 get_header();
 //global $product; global $woocommerce;
?>
<?php
while (have_posts()) : the_post();

?>
<?php
endwhile;
?>

 <section class="slider shop_page">
  <!-- <div class="banner_header">
    <h1 class="head_one white">Chamois</h1>
  </div> -->
</section>

<section class="compare-chart">
	<div class="container">
	<div class="HeadingTestimonials">
    <h2 class="partical_bothside"><span></span>Custom Cycling Jerseys Comparison</h2>
  </div>
	<?php the_content();?>
	</div>
</section>
<?php
get_footer();
?>
