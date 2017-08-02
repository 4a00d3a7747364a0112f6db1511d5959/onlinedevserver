<?php
/*
* The template for inner pages
*/
get_header(); 
?>

<!-- slider -->
<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
?>
<section class="sliderSec inner clearfix">
    <div class="container">  
       <h1><?php the_title(); ?></h1>
    </div>
</section>
<?php
	endwhile; endif; 
?>
<!-- slider ends -->

<section id="general">
    <div id="faq">
        <div class="container">
            <div class="navigation">
                <ul>
                    <?php
                        $about_section_icon = get_field('about_section_icon');
                        $product_section_icon = get_field('product_section_icon');
                        $shipping_section_icon = get_field('shipping_section_icon');
                        $payment_section_icon = get_field('payment_section_icon');
                        $return_or_exchange_section_icon = get_field('return_or_exchange_section_icon');
                    ?>
                  <li><a href="#about"><figure><img src="<?php echo $about_section_icon['url']; ?>" alt="#"></figure><span><?php the_field('about_section_title'); ?></span></a></li>
                  <li><a href="#products"><figure><img src="<?php echo $product_section_icon['url']; ?>" alt="#"></figure><span><?php the_field('product_section_title'); ?></span></a></li>
                  <li><a href="#shipping"><figure><img src="<?php echo $shipping_section_icon['url']; ?>" alt="#"></figure><span><?php the_field('shipping_section_title'); ?></span></a></li>
                  <li><a href="#payment"><figure><img src="<?php echo $payment_section_icon['url']; ?>" alt="#"></figure><?php the_field('payment_section_title'); ?></a></li>
                  <li><a href="#return"><figure><img src="<?php echo $return_or_exchange_section_icon['url']; ?>" alt="#"></figure><span><?php the_field('return_or_exchange_section_title'); ?></span> </a></li>
                </ul>
            </div>
            
            <div class="content">

		        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		          <?php the_content(); ?>	
	            <?php endwhile; endif; ?>

  	         </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>