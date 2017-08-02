<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ascend_Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $link_array = explode('/',$actual_link);
 $countSourceArr=count($link_array);
	$page_name =$link_array[$countSourceArr-2];
   
?>
	

	
			<section class="slider chamois">
  <div class="banner_header">
    <h1 class="head_one white">Chamois</h1>
  </div>
</section>
<!-- chamois slider ends --> 
<!-- Main content area -->

<div class="container contents Cyclin clearfix"> 
	
	
	
  <!-- <div class="mobile-heading">
    <h2>Cycling</h2>
  </div> --> 
  <!-- main sidebar -->
  <aside class="mainSidebar for_stky">
    <div class="asideContainer">
      <section class="filterSection itsAccordion">
		  <ul class="main_items">
		  <?php
			$args = array('orderby' => 'ID','order' => 'ASC','parent' => 0);
			$categories = get_categories( $args );
			foreach($categories as $category_par) 
			{ 
				if($category_par->name!='Uncategorized')
				{
					$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	  
					 if(substr_count($actual_link,"?")>0)
					 {
						 $actual_link = $actual_link."&";
					 }
					 else
					 {
						 $actual_link = $actual_link."?";
					 }
				  
					
					//echo $category->term_id."<br/>";?>
					<li <?php if($category_par->name == "Chamios") echo "class='opened'";?>><a data-val="<?php echo $category_par->name;?>" href="javascript:void(0)"><?php echo $category_par->name;?> <i class="fa fa-angle-down"></i></a>
					<ul class="sub_items">
					<?php
					$args = array('child_of' => $category_par->term_id);
					$categories = get_categories( $args );
					foreach($categories as $category) 
					{ $category_link = get_category_link( $category->term_id );?>
						
						<li <?php if($_REQUEST['q'] == $category->name) echo "class='current_li'";?>><a data-val="<?php echo $category->name;?>"
						<?php if($_REQUEST['q'] == $category->name) echo "class='active'";?>
						 href="<?php echo  $actual_link;?>q=<?php echo $category->name;?>"><i class="square"></i> <?php echo $category->name;?> </a></li>
						
						
					<?php
					}
					?>
						</ul>
					</li>
						
				<?php
				}
				
			}
		  
		  ?>
		  
		  </ul>
		  
		  

      </section>
      <!-- filter top section -->
      
      <!-- filter bottom section --> 
    </div>
    <!-- end aside container --> 
  </aside>
  <!-- main sidebar ends --> 
  <!-- content Section -->
  <section class="productContent push_right"> 
	  <section class="tag_filtering">
	  <?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	  
	     if(substr_count($actual_link,"?")>0)
	     {
			 $actual_link = $actual_link."&";
		 }
		 else
		 {
			 $actual_link = $actual_link."?";
		 }
	  
	  ?>
	  

				<select id="soflow-color" class="acted_as_button">
				
					<option>Select Comfort Rating</option>
					<option class="rate1">Rating 1</option>
					<option class="rate2">Rating 2</option>
					<option class="rate3">Rating 3</option>
					<option class="rate4">Rating 4</option>
					<option class="rate5">Rating 5</option>
					<option class="rate6">Rating 6</option>
					<option class="rate7">Rating 7</option>
					<option class="rate8">Rating 8</option>
					<option class="rate9">Rating 9</option>
					<option class="rate10">Rating 10</option>
				</select>

<!--
	           <a class="acted_as_button"> Apply Rating</a>
-->
<!--
             <button class="btnExample" id="apply_filter" type="submit" value="Submit"/>Apply Rating</button>
-->

	           
		  <a class="acted_as_button <?php if($_REQUEST['t']=="male") echo "active_tag_filter";?>" href="<?php echo $actual_link ?>t=male">Male</a>
	  
	  
		  <a class="acted_as_button <?php if($_REQUEST['t']=="female") echo "active_tag_filter";?>" href="<?php echo $actual_link ?>t=female">Female</a>
	  
		  <a class="acted_as_button <?php if($_REQUEST['t']=="unisex") echo "active_tag_filter";?>" href="<?php echo $actual_link ?>t=unisex">Unisex</a>
	  
	</section>
	  <section id="page_header">
  <div class="container exact_width_underline_left_align clearfix">
<!--
    <div class="header_offset_from_left">
		 <?php if($_REQUEST['q'] !='') {?>
      <h2 class="grey head_two exact_width left_align_head"><?php echo $_REQUEST['q'];?></h2>
      <?php } else {?>
		  <h2 class="grey head_two exact_width left_align_head">Cycling</h2>
		  <?php } ?>
    </div>
-->
  </div>
</section>
		<?php
		$q= $_REQUEST['q'];
		$t= $_REQUEST['t'];
		$rate= $_REQUEST['rate'];
		
		
		if($t !="" && $q !="" && $rate !="")
			{
				
				$args = array(
					'posts_per_page' => 10,
					'tag' => $t,
					'category_name' => $q,
					'meta_key' => 'rating_rating_out_of_10',
					'meta_value' => $rate,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			
			
			 else if($t !="" && $q !="")
			{
				
				$args = array(
					'posts_per_page' => 10,
					'tag' => $t,
					'category_name' => $q,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			else if($rate!="" && $q !="" )
			{
				$args = array(
					'posts_per_page' => 10,
					'meta_key' => 'rating_rating_out_of_10',
					'meta_value' => $rate,
					'category_name' => $q,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			else if($rate!="" && $t !="" )
			{
				$args = array(
					'posts_per_page' => 10,
					'meta_key' => 'rating_rating_out_of_10',
					'tag' => $t,
					'category_name' => $q,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			
			 
			
			
			/*If Category*/
			else if($q !="")
			{
				
					$args = array(
					'posts_per_page' => 10,
					'category_name' => $q,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			
			
			
			/*If Tag*/
			else if($t !="")
			{
				
					$args = array(
					'posts_per_page' => 10,
					'tag' => $t,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			/*If Rating*/
			
			else if($rate!="")
			{
				$args = array(
					'posts_per_page' => 10,
					'meta_key' => 'rating_rating_out_of_10',
					'meta_value' => $rate,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post_type' => 'chamois',
					'post_status' => 'publish'
				);
			}
			
			else
			{
				
		
			$args = array(
				'posts_per_page' => 10,
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
				'post_type' => 'chamois',
				'post_status' => 'publish'
			);
		   }
			query_posts( $args );
			
		if ( have_posts() ) : ?>
			<div class="mainContentStart">
				<div class="productRowHolder">
			<?php
			/* Start the Loop */
			$q= $_REQUEST['q'];
			// The Query
				
			if($q !="")
			{
				
			}
			else
			{
				
			}
			
		
				while ( have_posts() ) : the_post();
			?>
			
			<?php

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'chamois' );

			endwhile;?>
			
			<?php if($post_count ==0)
{?>
	<script>
		
		jQuery('.no_selection').text("No Fabric is match in this selection");
		</script>

<?php } ?>  
			
			 </div>
			</div>
			
             <?php     
			the_posts_pagination( array(
				'prev_text' => ascend_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'ascend' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'ascend' ) . '</span>' . ascend_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ascend' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

	</section>
	
	<?php $actual_link_or = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	  
	     if(substr_count($actual_link_or,"?")>0)
	     {
			 $actual_link_or = $actual_link_or."&";
		 }
		 else
		 {
			 $actual_link_or = $actual_link_or."?";
		 }
	  
	  ?>
	

</div>

<script>
	var link_url = '<?php echo $actual_link;?>'; 
	var rate_url = '<?php echo $rate;?>'; 
	
	jQuery('#soflow-color').find('.rate'+rate_url).attr('selected','selected');
	//alert(link_url);
	
	if(link_url == "http://onlinedevserver.biz/dev/ascend/chamois/")
	{
		jQuery('.main_items li').find("[data-page=Chamios]").addClass('opened');
	}
	
	jQuery('#soflow-color').change(function(){
		
		var current_url = '<?php echo $actual_link_or;?>'; 
		var rating_url = jQuery('select#soflow-color option:selected').val();
		//~ rating-10
		var rate_number = parseInt(rating_url.replace(/[^0-9\.]/g, ''), 10);;
		//alert(current_url);
		window.location.href = current_url+"rate="+rate_number;
		
	});
	
	
	</script>
<?php get_footer();
