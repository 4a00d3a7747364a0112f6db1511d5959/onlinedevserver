<?php
/**
 * Template Name: Financing Page Template
 * This template displays financing page
 */

get_header(); ?>

    <section id="inner-page">

        <div class="financing-banner">
            <img src="<?php the_field('financing_banner'); ?>"/>
        </div>

       <div class="financing-main-content">
            <div class="container">
                <?php
                    while ( have_posts()) { the_post();
                       the_content();
                    }
                ?>
            </div>
        </div>

        <div class="financing-lender-block">
            <div class="container">
                <h3>KULAN LENDERS</h3>
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
        </div>
        
    </section> <!--  common div for all pages -->

<?php get_footer(); ?>
