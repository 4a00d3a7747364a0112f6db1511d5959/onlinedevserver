<?php
/**
 * Template Name: gift Page
 */
get_header('small');
?>

<?php
while (have_posts()) : the_post();

echo get_post_meta(get_the_ID(),'Page Content',true);
endwhile;
?>

<section id="gift" class="gift-bottom">
 <div class="container">
  <div class="gift-box">
    <ul> 
		<?php
		while (have_posts()) : the_post();

			$post_id = get_the_ID();
			$post_title = get_the_title( $post_id );
			if ( get_post_gallery() ) :
            $gallery = get_post_gallery( get_the_ID(), false );
            
            /* Loop through all the image and output them one by one */
            foreach( $gallery['src'] as $src ) : ?>
               
			<li><img src="<?php echo $src; ?>"/></li>
			
			<?php 
			 endforeach;
			 endif;
			endwhile;
			?>

    </ul>
  </div>
 </div>
</section>


<!--<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/scripts.js" ></script>-->
<?php
get_footer();
?>
