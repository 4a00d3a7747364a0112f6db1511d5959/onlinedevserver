<?php
/**
 * Template Name: Agents Page Template
 * This template displays all the agents
 */

get_header(); ?>

    <section id="inner-page">
      
      <div class="agent-slider">

        <?php 
            $agent_args = array( 'post_type' => 'estate_agents', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' );
            $agent_query = new WP_Query( $agent_args ); 
            //print_r($agent_query);
            while ( $agent_query->have_posts() ) { $agent_query->the_post();
        ?>

        <div class="agent-details">
          <div class="container">
            <div class="agent_wrap">
              <div class="agent-image">
                <?php echo the_post_thumbnail('full'); ?>
              </div>
              <div class="agent-info">
                  <div class="maininfo">
                    <h4><?php the_title(); ?></h4>                
                    <span><?php the_field('designation'); ?></span>
                    <div class="social_info">
                    <?php if( have_rows('connect_with_me') ): ?> 
                        <ul>             
                        <?php while( have_rows('connect_with_me') ): the_row(); ?>             
                            <li><a href="<?php the_sub_field('agent_social_link'); ?>" target="_blank"><em class="fa fa-<?php the_sub_field('agent_social_icon'); ?>" style="color: #000;"></em></a></li>                    
                        <?php endwhile; ?>             
                        </ul>             
                    <?php endif; ?>
                    </div>
                  </div>
                  <div class="otherInfos">
                    <p><a href="#"><i class="fa fa-phone"></i> <?php the_field('phone'); ?></a></p>
                    <p><a href="#"><i class="fa fa-envelope"></i> <?php the_field('email'); ?></a></p>
                    <p><a href="#"><i class="fa fa-list-alt"></i> <?php the_field('agent_id'); ?></a></p>
                    <div class="learn-more"><a href="<?php the_permalink($agent_query->ID); ?>">Learn More</a></div>
                  </div>
              </div>
              <div style="clear: both;"></div>
          </div>
          </div>
        </div><!--single agent slide ends-->

        <?php } wp_reset_postdata(); ?>    

      </div><!--agent slider ends-->

        <div class="main-agent-block">

            <?php 
                $agent_args = array( 'post_type' => 'estate_agents', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date' );
                $agent_query = new WP_Query( $agent_args ); 
                //print_r($agent_query);
            ?>
            <div class="container">
                <ul class="agent-listing">
                <?php
                  while ( $agent_query->have_posts() ) { $agent_query->the_post();
                ?>
          			<li>                  
          				<a href="<?php the_permalink($agent_query->ID); ?>">
                    <div class="overlay_listing">
                      <a href="<?php the_permalink($agent_query->ID); ?>"> View Detail </a>
                    </div>
          					<div class="single_Agent_img">
                      <?php echo the_post_thumbnail('full'); ?>                      
                    </div>
                    <div class="infos">
            					<h4><?php the_title(); ?></h4>
                      <p><i class="fa fa-phone"></i> <?php the_field('phone'); ?></p>
                      <p><i class="fa fa-envelope"></i> <?php the_field('email'); ?></p>
                      <p><i class="fa fa-list-alt"></i> <?php the_field('agent_id'); ?></p>
                    </div>
          				</a>
          			</li>
                <?php } wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </section> <!--  common div for all pages -->

<?php get_footer(); ?>
