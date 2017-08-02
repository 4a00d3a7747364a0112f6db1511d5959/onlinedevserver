<?php

/**

 * Template Name: Sell Page Template

 * This template displays sell category listings

 */



get_header(); ?>



    <section id="inner-page">

       <div class="parallax-window" data-parallax="scroll" data-image-src="<?php the_field('sell_banner'); ?>"></div>

        <div class="sell-main-content">

            <div class="container">

                <?php
				

                    while ( have_posts()) { the_post();

                       the_content();

                    }

                ?>

            </div>

        </div>



        <div class="sell-agent-content">

            <div class="container">

                <?php the_field('sales_agents'); ?>

            </div>

        </div>



        <div class="sell-services-content">

            <div class="container">

                <?php the_field('our_services'); ?>

            </div>

        </div>



        <div class="recent-sold-block">

            <div class="container">

                <h3>RECENTLY SOLD ESTATES</h3>

                <?php 



                    $estate_args = array( 

                        'post_type' => 'estate_listings', 

                        'tax_query' => array(

                            array(

                                'taxonomy' => 'estate_category',

                                'field' => 'slug', //can be set to ID

                                'terms' => 'sell-estate' //if field is ID you can reference by cat/term number

                            )

                        ),

                        'posts_per_page' => 4, 

                        'order' => 'DESC', 

                        'orderby' => 'random' 

                    );



                    $estate_query = new WP_Query( $estate_args ); ?>

                    <ul class="single_related_estate">

                    <?php

                    while ( $estate_query->have_posts() ) { $estate_query->the_post();



                ?>

                    <li>

                                <a href="<?php the_permalink() ?>"> 

                                <?php if (has_post_thumbnail()) { ?>                            

                                    <?php the_post_thumbnail( 'large' ); ?>

                                <?php } ?>

                                <h5><?php echo get_post_meta(get_the_ID(), 'building', true); ?></h5>

                                <p class="address"><?php echo get_post_meta(get_the_ID(), 'address', true); ?></p>

                                <p class="bedrooms"><?php echo get_post_meta(get_the_ID(), 'bedrooms', true); ?>, <?php echo get_post_meta(get_the_ID(), 'bathrooms', true); ?>, <?php echo get_post_meta(get_the_ID(), 'style', true); ?></p>

                                </a>

                                <?php 

                                    if( get_field('is_this_property_sold_out') == 'Yes' ){ 

                                        $date = get_post_meta(get_the_ID(), 'sold_on', true);

                                        $date = new DateTime($date);

                                ?>

                                <p class="address">SOLD AT: <?php echo get_post_meta(get_the_ID(), 'sold_at', true); ?></p>

                                <p class="address">SOLD ON: <?php echo $date->format('j/m/Y'); ?></p>

                                <?php } ?>

                            </li>

                <?php 

                    } ?>

                    </ul>

                    <?php

                    wp_reset_postdata(); 

               

                ?>

            </div>

        </div>



        <div class="home-worth-block clearfix">
            <div class="container-sell">
            	<h3>WHAT'S MY HOUSE WORTH?</h3>

            <div class="home-worth-form">

                <?php echo do_shortcode('[contact-form-7 id="373" title="Home Worth Check Form"]'); ?>

            </div>
            	
            	
            </div>

            

        </div>



    </section> <!--  common div for all pages -->



<?php get_footer(); ?>
<script>
 jQuery(document).ready(function(){
	 $('.parallax-window').parallax({imageSrc: '<?php the_field('sell_banner'); ?>'});
 }
</script>