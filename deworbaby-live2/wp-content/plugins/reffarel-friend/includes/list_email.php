<?php 
	$user = wp_get_current_user(); 
	$user_meta = get_metadata('user', $user->ID, 'wallet', $single);
?>
<h2>You have $<?php echo $user_meta[0]; ?> rewards earned.</h2>

<?php 
	$user = wp_get_current_user(); 
	$user_meta = get_metadata('user', $user->ID, 'referral', $single);
	
	$args = array(
		 'post_title'    => "refferal_invitation_".$user->display_name,
		 'post_status'   => 'publish',          
		 'post_type'     => "refferal_invitation" 
	);
	//$pid = wp_insert_post($new_post);
	$post = get_posts($args);
	$post_id = $post[0]->ID;
	$postmetas = get_metadata('post', $post_id, '', ''); ?>
	<ul class="list_email" >
		<?php foreach($postmetas as $value){ ?>
			<li> 			
				<?php echo $value[0]; ?> <span class='invite_status'>SENT</span>
				<?php $meta_user = get_user_by( 'email', $value[0] ); 
					  $user_meta_data = get_metadata('user', $meta_user->ID, 'affiliate', $single);
					if($user_meta[0] == $user_meta_data[0]){ ?>
					<div class='user_stat'>Signed up, but hasn't subscribed yet</div>					
				<?php } else { ?>
					<div class='user_stat'>Hasn't Signup Yet</div>
				<?php } ?>
			</li>
		<?php }	?>
	</ul>
	
	<style>
		.user_stat {
			font-size: 11px;
			color: #B0B0B0;
		}
		
		.list_email > li {
			margin-top: 11px;
		}
	</style>