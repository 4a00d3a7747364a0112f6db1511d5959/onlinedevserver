<?php

/**

 * Template Name: About Page Template

 * This template displays about page

 */



get_header(); ?>



    <section id="inner-page">



        <div class="top-video-block">

            <?php 

                $first_video = get_field('about_first_video');

            ?>

             <video width="100%" poster="<?php the_field('about_first_video_poster'); ?>" controls loop>

              <source src="<?php echo $first_video; ?>" type="video/mp4">

             </video>

        </div>



        <div class="about-main-content">

            <div class="container">

                <?php

                    while ( have_posts()) { the_post();

                       the_content();

                    }

                ?>



                <?php if( have_rows('about_kulan_features') ): ?>

 

                    <ul class="about-features clearfix">                 

                    <?php while( have_rows('about_kulan_features') ): the_row(); ?>

                        <?php 

                            $featured_image = get_sub_field('featured_icon');

                        ?>

                        <li>

                            <div class="featured-icon">

                                <img src="<?php echo $featured_image['url']; ?>"/>

                            </div>

                            <div class="featured-text">

                                <?php the_sub_field('featured_text'); ?>

                            </div>

                        </li>

                    <?php endwhile; ?>                 

                    </ul>

                 

                <?php endif; ?>

            </div>

        </div>



        <div class="kulan-mgt-team">
            
            
            <h3>KULAN REAL ESTATE MANAGEMENT TEAM</h3>

            

            <?php if( have_rows('kulan_management_team') ): ?>

            <ul class="management-list">

            <?php while( have_rows('kulan_management_team') ): the_row(); ?>

                <?php 

                    $profile_image = get_sub_field('profile_image');

                ?>

                <li>
                    <div class="profile-image-with-info">
                    	 <div class="profile-image">

                        <img src="<?php echo $profile_image['url']; ?>">

                    </div>

                    <div class="profile-info">

                        <?php the_sub_field('profile_info'); ?>

                    </div>
                    </div>

                   

                    <div class="profile-description">
                        <div class="profile-description-wrap">
                        	 <?php the_sub_field('profile_description'); ?>
                        </div>

                       

                    </div>

                </li>

            <?php endwhile; ?>

				<div class="texts"></div>

            </ul>

            <?php endif; ?>
            	
            
            

        </div>



        <div class="kulan-dedication-block">

            <div class="container">

                <?php the_field('kulan_dedication'); ?>

                <?php 

                    $second_video = get_field('about_second_video');

                ?>

                 <video width="100%"  poster="<?php the_field('about_second_video_poster'); ?>" controls loop>

                  <source src="<?php echo $second_video; ?>" type="video/mp4">

                 </video>

            </div>

        </div>



        <div class="kulan-history-block">

            <h3>KULAN HISTORY</h3>



            <div class="main-history-block">

                <?php

                  $history_args = array( 'post_type' => 'kulan_history', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' );

                  $history_query = new WP_Query( $history_args ); 



                ?>



                <div class="about-kulan-slider">

                    <div class="history-slider">



                    <?php

                        $i = 1;

                        $count = $history_query->post_count;



                        while ( $history_query->have_posts() ) { $history_query->the_post(); 

                    ?>

                    <?php



                      if( $i%2 != 0 ){

                        echo '<div class="left-history clearfix">';

                      }else{

                        echo '<div class="right-history clearfix">';

                        } ?>

                            <div class="history-info" style="background-color: #63b744;">

                                <h3><?php the_field('happened_in'); ?></h3>
                                <div class="hr"><hr></div>
                                <h4><?php the_title(); ?></h4>

                            </div>

                            <div class="history-image" style="background: url('<?php if ( has_post_thumbnail() ) {the_post_thumbnail_url( 'medium' ); } ?>') no-repeat;"></div>

                        </div>



                    <?php 

                        if( $count > $i){ 



                            if( $i%2 == 0){

                                 echo '</div>';



                                echo ' <div class="history-slider">';



                             }

                        }else if($count == $i ){



                             echo '</div>';



                        }



                        $i++;

                        } ?>

                                   

                    <?php 

                        wp_reset_postdata();

                    ?>

            </div>

        </div>



    </section> <!--  common div for all pages -->



<?php get_footer(); ?>

