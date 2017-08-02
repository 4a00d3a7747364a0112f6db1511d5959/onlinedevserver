<?php
/**
 * Template Name: Careers Page Template
 * This template displays careers page
 */

get_header(); ?>

    <section id="inner-page">

        <div class="parallax-window" data-parallax="scroll" data-image-src="<?php the_field('career_banner'); ?>">
        	<div class="career-banner-content">
				<h3><?php the_field('career_banner_text'); ?></h3>
	    	</div>
        </div>

        <div class="career-feature-block">
            <div class="container">
                <?php if( have_rows('career_features') ): ?> 
                    <ul> 
                    <?php 
                        while( have_rows('career_features') ): the_row(); 

                        $image = get_sub_field('career_feature_image');
                    ?> 
                        <li style="background-color: <?php echo get_sub_field('career_feature_block_color'); ?>;">
                            <?php echo get_sub_field('career_feature_title'); ?>
                            <?php echo get_sub_field('career_feature_description'); ?>                            
                            <?php echo get_sub_field('career_feature_description'); ?> 
                            <img src="<?php echo $image['url']; ?>">
                        </li>
                    <?php endwhile; ?> 
                    </ul> 
                <?php endif; ?>
            </div>
        </div>

        <div class="career-download-block" style="width: 100%; background: #ddd; height: 30px;">
        	<?php
        		$file = get_field('download_pdf');
        	?>
			<a href="<?php echo $file['url']; ?>" target="_blank"><?php the_field('download_pdf_text'); ?></a>
        </div>
        
       <div class="career-main-content">
            <div class="container">
                <?php
                    while ( have_posts()) { the_post();
                       the_content();
                    }
                ?>
            </div>
        </div>
        
    </section> <!--  common div for all pages -->

<?php get_footer(); ?>
<script>
 jQuery(document).ready(function(){
	 $('.parallax-window').parallax({imageSrc: '<?php the_field('career_banner'); ?>'});
 }
</script>