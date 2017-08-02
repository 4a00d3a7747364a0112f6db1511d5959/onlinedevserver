<?php
$found_post = null;
$user = wp_get_current_user();
if ( $posts = get_posts( array( 
    'name' => "refferal_invitation_".$user->display_name, 
    'post_type' => 'refferal_invitation',
    'post_status' => 'publish',
    'posts_per_page' => 1
) ) ) $found_post = $posts[0];

// Now, we can do something with $found_post
if ( ! is_null( $found_post ) ){
	$post_id = $found_post->ID;
} else {
	$post_id = '';
}
?>
<form method='post' action=''>
<p class="show_response" ></p>
<div class='col-md-6 left'><input id='invite_email' type='email' placeholder='Email' ></div>
<input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id; ?>" >
<div class='col-md-4 right'><button type="submit" class='btn btn-success' onclick='return emailClicked();'>Send</submit></div>
</form> 
<?php require_once('list_email.php'); ?>
<script type="text/javascript">
function emailClicked() 
{
	var email = $('#invite_email').val();
	var post_id = $('#post_id').val();
	var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
	var data = {
        action: 'send_invitetion',
		dataType: 'json',
		email: email,
		post_id: post_id
    };
	if(email != ''){
		$.post(ajaxurl, data, function(response) {
			$('.show_response').html(response);
			$('.list_email').append('<li>'+email+'<span class="invite_status">SENT</span><div class="user_stat">Hasn\'t Signup Yet</div></li>');
			return false;
		});	
	} else {
		alert('please input an email');
		return false;
	}
	return false;
}
</script>