<?php
	global $post, $agent_id;
	//echo 'ID: '.$agent_id.', Name: '.$agent_name.'<br>';
	$args = array(
        'post_type' => 'estate_agents',
        'post__in' => array($agent_id),
    );
    $agent_posts = get_posts($args);
	
	//print_r($agent_posts);

	foreach ($agent_posts as $agents) { ?>
		<div class="single-agent-block">
			<a href="<?php the_permalink($agents->ID); ?>">
				<?php //echo get_the_post_thumbnail( $agents->ID, 'thumbnail' ); ?>
				<img src="<?php echo get_the_post_thumbnail_url($agents->ID, 'thumbnail'); ?>">
			</a>
	    	<a href="<?php the_permalink($agents->ID); ?>">
	    		<h2><?php echo $agents->post_title; ?></h2>
	    	</a>
	    	<ul>
	    		<li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo get_post_meta($agents->ID, 'phone', true); ?>"><?php echo get_post_meta($agents->ID, 'phone', true); ?></a></li>
	    		<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo get_post_meta($agents->ID, 'email', true); ?>"><?php echo get_post_meta($agents->ID, 'email', true); ?></a></li>
	    		<li><i class="fa fa-id-card" aria-hidden="true"></i> <?php echo get_post_meta($agents->ID, 'agent_id', true); ?></li>
	    	</ul>
    	</div>
	<?php }
?>