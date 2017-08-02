<?php
/**
 * Template Name: Contact Page Template
 * This template displays contact page
 */

get_header(); ?>

    <section id="inner-page">

        <div class="parallax-window" data-parallax="scroll" data-image-src="<?php the_field('contact_banner'); ?>"></div>

       <div class="contact-main-content">
            <div class="container">
                <div class="left-contact">
                    <h3>Kulan Real Estate</h3>

                    
                    <?php while ( have_posts()) { the_post(); the_excerpt(); } ?>
                    
                </div>
                <div class="right-contact">
                    <?php
                        while ( have_posts()) { the_post();
                           the_content();
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="contact-map-block">            
            <?php if( have_rows('financing_lenders') ): ?> 
                <ul> 
                <?php 
                    while( have_rows('financing_lenders') ): the_row(); 

                    $image = get_sub_field('financing_lender_logo');
                ?> 
                    <li>
                        <div class="lender-image">
                            <img src="<?php echo $image; ?>">
                        </div>
                        <div class="lender-description">
                            <?php echo get_sub_field('financing_lender_details'); ?>
                        </div>
                    </li>
                <?php endwhile; ?> 
                </ul> 
            <?php endif; ?>
        </div>
        
    </section> <!--  common div for all pages -->

<?php get_footer(); ?>
<script>
 jQuery(document).ready(function(){
     $('.parallax-window').parallax({imageSrc: '<?php the_field('contact_banner'); ?>'});
 }
</script>