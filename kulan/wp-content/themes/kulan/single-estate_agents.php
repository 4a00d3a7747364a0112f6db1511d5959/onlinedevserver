<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section id="inner-page">

		<div class="agent-slider-inner-page">

	        <?php 
	            while ( have_posts() ) { the_post();
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
						
						<?php if( have_rows('agent_key_points') ): ?>					 
						    <?php while( have_rows('agent_key_points') ): the_row(); ?>					 
						        <p><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php the_sub_field('key_points'); ?></p>
						    <?php endwhile; ?>
						<?php endif; ?>
	                   
	                  </div>
	              </div>
	              <div style="clear: both;"></div>
	          </div>
	          </div>
	        </div><!--single agent slide ends-->

	        <?php } wp_reset_postdata(); ?>    
		<div style="clear: both"></div>
	      </div><!--agent slider ends-->

		<div class="agent-profile-block">
			<h3>AGENT PROFILE</h3>

			<div class="agent-biopic">

				<?php 
					$gal_images = get_field('agent_gallery');
					if( $gal_images ): 
				?>
				<?php foreach( $gal_images as $gal_image ): ?>
					    <img src="<?php echo $gal_image['sizes']['medium']; ?>"/>
				<?php endforeach; ?>
				<?php endif; ?>

			</div>
			
		</div>

		</div>

		<div class="main-agent-content details_page_content for_inner">
			<div class="container">
				<?php while ( have_posts() ) : the_post(); ?>
				<div class="left-agent-content">
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>					
				</div>
				<div class="right-agent-content">
					<?php
			    		$agent_name_field = "my_name";
						$agent_name = get_field_object($agent_name_field);
						$agent_iam_field = "i_am";
						$agent_iam = get_field_object($agent_iam_field);
						$agent_born_field = "born_in";
						$agent_born = get_field_object($agent_born_field);
						$agent_lang_field = "language_spoken";
						$agent_lang = get_field_object($agent_lang_field);
						$agent_moment_field = "proudest_moment";
						$agent_moment = get_field_object($agent_moment_field);
						$agent_chanllenge_field = "biggest_challenge";
						$agent_chanllenge = get_field_object($agent_chanllenge_field);
						$agent_alarm_field = "alarm_clock";
						$agent_alarm = get_field_object($agent_alarm_field);
						$agent_perfect_field = "perfect_day";
						$agent_perfect = get_field_object($agent_perfect_field);
						$agent_job_field = "first_job";
						$agent_job = get_field_object($agent_job_field);
						$agent_hero_field = "super_hero_power";
						$agent_hero = get_field_object($agent_hero_field);
						$agent_fav_field = "favorite_bay_area_neighborhood";
						$agent_fav = get_field_object($agent_fav_field);
						$agent_inspiration_field = "inspiration";
						$agent_inspiration = get_field_object($agent_inspiration_field);
						$agent_climb_field = "climb_is";
						$agent_climb = get_field_object($agent_climb_field);
					?>

					<p><?php echo '<strong>'.$agent_name['label'].'</strong>: <br>'.$agent_name['value']; ?></p>
					<p><?php echo '<strong>'.$agent_iam['label'].'</strong>: <br>'.$agent_iam['value']; ?></p>
					<p><?php echo '<strong>'.$agent_born['label'].'</strong>: <br>'.$agent_born['value']; ?></p>
					<p><?php echo '<strong>'.$agent_lang['label'].'</strong>: <br>'.$agent_lang['value']; ?></p>
					<p><?php echo '<strong>'.$agent_moment['label'].'</strong>: <br>'.$agent_moment['value']; ?></p>
					<p><?php echo '<strong>'.$agent_chanllenge['label'].'</strong>: <br>'.$agent_chanllenge['value']; ?></p>
					<p><?php echo '<strong>'.$agent_alarm['label'].'</strong>: <br>'.$agent_alarm['value']; ?></p>
					<p><?php echo '<strong>'.$agent_perfect['label'].'</strong>: <br>'.$agent_perfect['value']; ?></p>
					<p><?php echo '<strong>'.$agent_job['label'].'</strong>: <br>'.$agent_job['value']; ?></p>
					<p><?php echo '<strong>'.$agent_hero['label'].'</strong>: <br>'.$agent_hero['value']; ?></p>
					<p><?php echo '<strong>'.$agent_fav['label'].'</strong>: <br>'.$agent_fav['value']; ?></p>
					<p><?php echo '<strong>'.$agent_climb['label'].'</strong>: <br>'.$agent_climb['value']; ?></p>
				</div>
				<?php endwhile; ?>
			</div>
	  	</div>

		
	  	<div class="agent-work-place">
	  		<h1><i class="fa fa-heart" aria-hidden="true"></i></h1>
			<h2>What do you love about <?php the_field('work_place'); ?>?</h2>
			<h3><?php the_field('about_work_place'); ?></h3>
	  	</div>
		

	  	<div class="agent-property">
	  		<?php
	  			$fullname = get_the_title();
				$agent_first_name = explode(' ',trim($fullname));				
	  		?>
	  		<div class="related_posts_show_section">
	    <div class="related-listing-block">
			<h3><?php echo $agent_first_name[0]; ?>'S PROPERTIES</h3>

			<!--agent listing starts-->
			<?php
             	$args = array(
				    'post_type'        => 'estate_listings',
				    'posts_per_page'   => 4,
				    'orderby'          => 'DESC',
				    'no_found_rows'    => true,
				    'suppress_filters' => false,
				    'meta_query'       => array(
				       array(
				            'key'          => get_the_ID(),
				            'value'        => get_the_title(),
				            'compare'      => '=',
				        )
				    ),
				);

				$query = new WP_Query( $args ); ?>

			<ul class="single_related_estate" style="text-align: center;">
			<?php
				while ($query->have_posts() ) : $query->the_post();
            ?>
              	<li>
              		<p style="display: none;"><?php the_title(); ?></p>
	      			<a href="<?php the_permalink() ?>"> 
	           		<?php if (has_post_thumbnail()) { ?>			            	
	            		<?php the_post_thumbnail( 'large' ); ?>
	            	<?php } ?>
	            	<h5><?php echo get_post_meta(get_the_ID(), 'building', true); ?></h5>
	            	<p class="address"><?php echo get_post_meta(get_the_ID(), 'address', true); ?></p>
	            	<p class="bedrooms"><?php echo get_post_meta(get_the_ID(), 'bedrooms', true); ?>, <?php echo get_post_meta(get_the_ID(), 'bathrooms', true); ?>, <?php echo get_post_meta(get_the_ID(), 'style', true); ?></p>
	            	<p class="listed"><?php echo $listed_at_value['label']; ?> <?php echo get_post_meta(get_the_ID(), 'listed_at', true); ?></p>
	            	</a>
	            	<?php 
	            		if( get_field('is_this_property_sold_out') == 'Yes' ){ 
	            		$date = get_post_meta(get_the_ID(), 'sold_on', true);
	            		$date = new DateTime($date);
	            	?>
	            	<p class="is_sold"><span style="color: Green;">SOLD ON: <?php echo $date->format('j/m/Y'); ?></span></p>
	            	<?php } ?>
	       		</li>
            <?php endwhile; ?>	
            </ul>
			</div>
			</div>
			<!--agent listing ends-->
	  	</div>

	  	<div style="clear:both;"></div>

	</section>

<?php get_footer(); ?>