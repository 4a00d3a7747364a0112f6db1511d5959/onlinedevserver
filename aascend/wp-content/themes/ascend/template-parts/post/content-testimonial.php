<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ascend_Theme
 * @since 1.0
 * @version 1.0
 */

?>

<?php 
 $j=1;
 

$args = array(
   
	'category' => 0,
	'orderby' => 'date',
	'order' => 'ASC',
	'post_type' => 'testimonial',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$custom_query = new WP_Query( $args );

while($custom_query->have_posts()) : 
   $custom_query->the_post();	
   
   if($j%2==0)
	{
		$class_name = "rowsRightCurve";
	} 
	else
	{
		$class_name = "rowsleftCurve";
	}
	
	
	/*Get The Image Src*/
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID']), 'single-post-thumbnail');
   
?>
   <div class="rows <?php echo $class_name; ?> clearfix" id="testimonial_post">
      <div class="rightImagesArea">
        <div class="imgLabel"> <span><?php the_title() ;?></span> </div>
        <div class="wrap">
          <div class="imageHolder"> <img src="<?php echo $image[0];?>" alt=""> </div>
        </div>
      </div>
      <!-- left descriptions -->
      <div class="leftDescription">
        <div class="leftDescriptionInner1">
          <div class="leftDescriptionInner2">
            <div class="mainContentArea">
              <p><?php the_content() ;?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
											
     <?php $j++;
     endwhile; ?>
