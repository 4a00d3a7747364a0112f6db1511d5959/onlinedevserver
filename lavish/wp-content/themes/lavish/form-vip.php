<?php
/**
 * Template Name: vip form Page
 */
get_header();
?>
<?php  $pac_name = $_REQUEST['pac'];?>
<?php
			while ( have_posts() ) : the_post();
			the_content();

endwhile; // End of the loop.
			?>

<div class="vip-footer">
	
<?php get_footer();?>
 </div> 
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
 <script>
	$('document').ready(function(){
		
		$("#signupForm").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			conpassword: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			
			conemail: {
				required: true,
				email: true,
				equalTo: "#email"
			},
			
			
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your User Name must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			conpassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			conemail: {equalTo:"Please enter the same email as above"},
			
			
			email: "Please enter a valid email address"
			
			
		}
	});
		
		
		});
</script>
 
 
 


