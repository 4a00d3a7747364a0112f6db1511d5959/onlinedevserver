<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>



	<section id="single-posts">
		
		<?php if( get_field('is_this_property_sold_out') == 'Yes' ){ ?>
		<div class="footer-banner-newsletter footer_banner_n">
		    <a href="<?php echo esc_url(home_url('/for-sale')); ?>">This property is no longer available. Click here for our current listings.</a>
		</div>
		<?php } ?>
		
		<div class="detail_page_banner_slider">
		<?php the_field('estate_gallery_shortcode'); ?>
			<div class="single_details">
				<?php 
					while ( have_posts() ) { the_post(); 

					$address_field = "address";
					$address_value = get_field_object($address_field);
					$bedrooms_field = "bedrooms";
					$bedrooms_value = get_field_object($bedrooms_field);
					$bathrooms_field = "bathrooms";
					$bathrooms_value = get_field_object($bathrooms_field);
					$listed_at_field = "listed_at";
					$listed_at_value = get_field_object($listed_at_field);
				?>
				<div class="first-slide-title">
					<h1 class="title"><?php echo $address_value['value']; ?></h1>
					<h2><?php echo $bedrooms_value['value'].' '.$bathrooms_value['value']; ?><br><?php echo $listed_at_value['value']; ?></h2>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="details_page_content">

	  	<div class="container clearfix">

	  	<?php while ( have_posts() ) { the_post(); ?>

	     <div class="left-single-posts">

	    	<h3><?php the_title(); ?></h3>
	    	<!--special features-->
			<ul class="estate_features">
		    	<?php
		    		$address_field = "address";
					$address_value = get_field_object($address_field);
					$building_field = "building";
					$building_value = get_field_object($building_field);
					$neighborhood_field = "neighborhood";
					$neighborhood_value = get_field_object($neighborhood_field);
					$bedrooms_field = "bedrooms";
					$bedrooms_value = get_field_object($bedrooms_field);
					$bathrooms_field = "bathrooms";
					$bathrooms_value = get_field_object($bathrooms_field);
					$style_field = "style";
					$style_value = get_field_object($style_field);
					$parking_field = "parking";
					$parking_value = get_field_object($parking_field);
					$square_feet_field = "square_feet";
					$square_feet_value = get_field_object($square_feet_field);
					$hoa_dues_field = "hoa_dues";
					$hoa_dues_value = get_field_object($hoa_dues_field);
					$listed_at_field = "listed_at";
					$listed_at_value = get_field_object($listed_at_field);
					$sold_on_field = "sold_on";
					$sold_on_value = get_field_object($sold_on_field);
					$sold_at_field = "sold_at";
					$sold_at_value = get_field_object($sold_at_field);
				?>
				<li><?php echo $address_value['label'] . ': ' . $address_value['value']; ?></li>
				<li><?php echo $building_value['label'] . ': ' . $building_value['value']; ?></li>
				<li><?php echo $neighborhood_value['label'] . ': ' . $neighborhood_value['value']; ?></li>
				<li><?php echo $bedrooms_value['label'] . ': ' . $bedrooms_value['value']; ?></li>
				<li><?php echo $bathrooms_value['label'] . ': ' . $bathrooms_value['value']; ?></li>
				<li><?php echo $style_value['label'] . ': ' . $style_value['value']; ?></li>
				<li><?php echo $parking_value['label'] . ': ' . $parking_value['value']; ?></li>
				<li><?php echo $square_feet_value['label'] . ': ' . $square_feet_value['value']; ?></li>
				<?php if( get_field('is_this_property_sold_out') == 'No' ){  ?>
					<li><?php echo $hoa_dues_value['label'] . ': ' . $hoa_dues_value['value']; ?></li>
					<li><?php echo $listed_at_value['label'] . ': ' . $listed_at_value['value']; ?></li>
				<?php }else{ ?>
					<li><?php echo $sold_on_value['label'] . ': ' . $sold_on_value['value']; ?></li>
					<li><?php echo $sold_at_value['label'] . ': ' . $sold_at_value['value']; ?></li>
				<?php } ?>
			</ul>
	    	<!--special features-->

            <?php the_content(); ?>  
			
			<?php if(get_field('3d_tour_video')){ ?>
            <h3>3D TOUR</h3>
            <?php the_field('3d_tour_video'); ?>
            <?php } ?>
            


		 </div><!--single posts-->
		

	    <div class="right-single-posts">

	    	<div class="listing-agents-block">
				<h3>LISTING AGENTS</h3>
				<?php
					$listing_post_id = get_the_ID();
							
					$args = array(
						 'numberposts' => -1,
						 'offset' => 0,
						 'category' => 0,
						 'order' => 'DESC',					 
						 'exclude' => '',
						 'meta_key' => '',
						 'meta_value' =>'',
						 'post_type' => 'estate_agents',
						 'post_status' => 'publish',
						 'suppress_filters' => true
					);

					$agent_posts = wp_get_recent_posts( $args, ARRAY_A );

					//print_r($agent_posts);
					
					//$j=1;

					foreach($agent_posts as $agent_posts){

						$agent_id = $agent_posts['ID'];

						$agent_name =  get_post_meta( $listing_post_id, $agent_id ,true );

						if( $agent_name != "Null Data" ){
						  	//echo 'ID: '.$agent_id.', Name: '.$agent_name.'<br>';
						  	get_template_part( 'template-parts/content', 'agents' );
						}						  
					}				
				?>
			</div>			
			
			<?php if( get_field('showing_schedule') ): ?>
			<div class="showing-schedule-block">
				<h3>SHOWING SCHEDULE</h3>
				<?php if( have_rows('estate_showing_schedule') ): ?> 
    				<ul>
    					<?php while( have_rows('estate_showing_schedule') ): the_row(); ?> 
        				<li><?php the_sub_field('showing_schedule'); ?></li>
    					<?php endwhile; ?>
    				</ul> 
				<?php endif; ?>
			</div>
			<?php endif; ?>			
			
			<?php if( get_field('estate_location') ): ?>
			<div class="location-block">
				<h3>LOCATION</h3>
				<?php the_field('estate_location'); ?>
			</div>
			<?php endif; ?>
			
			<div class="single_social">
				<?php if ( is_active_sidebar( 'social-sharing-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'social-sharing-sidebar' ); ?>
				<?php } ?>
			</div>

			<?php if ( is_active_sidebar( 'twitter-sidebar' ) ) { ?>
				<?php dynamic_sidebar( 'twitter-sidebar' ); ?>
			<?php } ?>

	    </div>

	    <?php } //end of main while loop ?>
		<div class="related_posts_show_section">
	    <div class="related-listing-block">
			<h3>RELATED LISTINGS</h3>
			<?php 
				//get_template_part( 'template-parts/content', 'related-listings' ); 

				//Get array of terms
				$terms = get_the_terms( $post->ID , 'estate_category', 'string');
				//Pluck out the IDs to get an array of IDS
				//$term_ids = wp_list_pluck($terms,'term_id');
				$term_ids = 11; //showing posts related to Estate category

				//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
				//Chose 'AND' if you want to query for posts with all terms
				 $second_query = new WP_Query( array(
				    'post_type' => 'estate_listings',
				    'order'     => 'DESC',
				    'tax_query' => array(
				    	'relation' => 'AND', 
	                    array(
	                        'taxonomy' => 'estate_category',
	                        'field' => 'id',
	                        'terms' => $term_ids,
	                        'operator'=> 'IN' //Or 'AND' or 'NOT IN'
	                     ),
	                    array(
					        'taxonomy' => 'estate_category',
					        'field' => 'id',
					        'terms' => array( 10 ),  //excluding Featured category
					        'include_children' => false,
					        'operator' => 'NOT IN'
					      )

	                    ),
				    'posts_per_page' => 4,
				    'ignore_sticky_posts' => 1,
				    'orderby' => 'rand',
				    'post__not_in'=>array($post->ID)
				   ) );

				//Loop through posts and display...
			    if($second_query->have_posts()) { ?>
					<ul class="single_related_estate">
			    	<?php while ($second_query->have_posts() ) : $second_query->the_post(); ?>
			      		<li>
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
			   		<?php wp_reset_query();
			   		}
				?>

	    </div>
	    </div>

	   </div> 

	   </div>

	</section>

<?php get_footer(); ?>