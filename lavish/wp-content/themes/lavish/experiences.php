<?php
/**
 * Template Name: experiences Page
 */
get_header('small');
?>

<section id="experiences-top" class="experiences-top-div" style="background: url(<?php echo esc_url( get_template_directory_uri() )?>/images/experience-bg.jpg) no-repeat center center; background-attachment:fixed; background-size:cover;">
  <div class="container">
    <div class="experiences-top-box">
       <h3> Choose your experience </h3>
        <div class="pref">
          <h3>I am a:</h3>
           <div class="btn-group experience-checkbox-box">
 
			 <form id="myForm" class="experience-box">
                <div class="experience-box-input">
                 <label>
                  <input type="radio" name="radioName" value="Man"> 
                  <span></span>Man 
                 </label> 
                </div>
                <div class="experience-box-input">
                 <label>
                  <input type="radio" name="radioName" value="Woman"> 
                  <span></span>Woman 
                 </label> 
                </div>
                <div class="experience-box-input">
                 <label>
                  <input type="radio" name="radioName" value="Couple"> 
                  <span></span>Couple 
                 </label> 
                </div> 

                <h3>I am in the mood for:</h3>
                <div class="experience-box-input">
                 <label> 
                  <input type="radio" name="radioName1" value="companionship">
                  <span></span>Companionship 
                 </label> 
                </div>
                <div class="experience-box-input"> 
                 <label>
                  <input type="radio" name="radioName1" value="luxury"> 
                  <span></span>Luxury 
                 </label> 
                </div>
                <div class="experience-box-input"> 
                 <label>
                  <input type="radio" name="radioName1" value="relaxation"> 
                  <span></span>Relaxation
                 </label> 
                 </div>
                <div class="experience-box-input"> 
                 <label>
                  <input type="radio" name="radioName1" value="passion"> 
                  <span></span>Passion
                 </label> 
                </div>
                <div class="experience-box-input"> 
                 <label>
                  <input type="radio" name="radioName1" value="naughty"> 
                  <span></span>Naughty 
                 </label> 
                </div> 
             </form>   
             
        </div>
        </div> 
        



    </div> 
    
    <div class="experiences-box-col">
		<div id="show_loader"><img src="http://onlinedevserver.biz/dev/lavish/wp-content/uploads/2017/02/loadingimg.gif"/></div>
      <ul class="experience_ul">
		  <?php
$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'rand',
	'order' => 'ASC',
	
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'experience_post_type',
	'post_status' => 'publish',
	'suppress_filters' => true
);
$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{ 
	 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID'] ), 'single-post-thumbnail' ); 

?>
       <li class="show_li_<?php print_r($recent_posts['ID'] );?>"> 
        <a href="<?php print_r($recent_posts['guid'] );?>">
           <div class="experiences-box-col-img">
            <img src="<?php echo $image[0];?>" / alt="experience-1">
           </div>
           <div class="experiences-box-col-heading">
            <h3> <?php print_r($recent_posts['post_title'] );?> </h3>
           </div>
           <div class="experiences-box-col-sub-heading">
            <p> <?php print_r($recent_posts['post_excerpt'] );?> </p>
           </div>
        </a>
       </li>
       <?php } ?>

      </ul>
    </div>     
  </div>
</section>
<!--<script type="text/javascript">
	jQuery('#myForm input').on('change', function() {    
   var selected_val = jQuery('input[name=radioName]:checked', '#myForm').val();
   var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
  jQuery('.experiences-box-col li').hide();
  jQuery('#show_loader').show();
		var data = 
		{
		action: 'get_experience',
		dataType: 'json',

		selected_val:selected_val,

		}
		jQuery.post(ajaxurl, data, function(response) {
			var dataval = jQuery.parseJSON(response);
			var colorCodes = new Array();
	 colorCodes = dataval["embroiderycode"];	
	 for(i=0;i<10;i++){		 
		 var list="."+colorCodes[i];		
		 jQuery( ".experiences-box-col ul" ).find( ".show_li_"+colorCodes[i] ).css({'display':'inline-block'} );
		 jQuery('#show_loader').hide();
	 }
		});   
});
	
	</script>-->
    
<script type="text/javascript">
	jQuery('#myForm input').on('change', function() {    
      var selected_val = jQuery('input[name=radioName]:checked', '#myForm').val();
      var selected_val1 = jQuery('input[name=radioName1]:checked', '#myForm').val();
      if(selected_val1!=undefined)
      {
		  selected_val = selected_val+','+selected_val1;
		  //alert(selected_val);
	  }
      
   var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
     jQuery('.experiences-box-col li').hide();
      jQuery('#show_loader').show();
		var data = 
		{
		action: 'get_experience',
		dataType: 'json',

		selected_val:selected_val,

		}
		jQuery.post(ajaxurl, data, function(response) {
			var dataval = jQuery.parseJSON(response);
			var colorCodes = new Array();
	 colorCodes = dataval["embroiderycode"];	
	 for(i=0;i<10;i++){		 
		 var list="."+colorCodes[i];		
		 jQuery( ".experiences-box-col ul" ).find( ".show_li_"+colorCodes[i] ).css({'display':'inline-block'} );
		 jQuery('#show_loader').hide();
	 }
		});   
});
</script>

<script type="text/javascript">
	jQuery('#myForm-1 input').on('change', function() {    
   var selected_val = jQuery('input[name=radioName]:checked', '#myForm-1').val();
   var ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>';
  jQuery('.experiences-box-col li').hide();
  jQuery('#show_loader').show();
		var data = 
		{
		action: 'get_experience',
		dataType: 'json',

		selected_val:selected_val,

		}
		jQuery.post(ajaxurl, data, function(response) {
			var dataval = jQuery.parseJSON(response);
			var colorCodes = new Array();
	 colorCodes = dataval["embroiderycode"];	
	 for(i=0;i<10;i++){		 
		 var list="."+colorCodes[i];		
		 jQuery( ".experiences-box-col ul" ).find( ".show_li_"+colorCodes[i] ).css({'display':'inline-block'} );
		 jQuery('#show_loader').hide();
	 }
		});   
});
</script>
    

<?php
get_footer();
?>
