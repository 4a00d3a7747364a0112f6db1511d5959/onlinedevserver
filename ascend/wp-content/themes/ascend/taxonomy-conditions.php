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
					
					//echo $category->term_id."<br/>";?>
					<li <?php if($category_par->name == "Chamios") echo "class='opened'";?>><a data-val="<?php echo $category_par->name;?>" href="javascript:void(0)"><?php echo $category_par->name;?> <i class="fa fa-angle-down"></i></a>
					<ul class="sub_items">
					<?php
					$args = array('child_of' => $category_par->term_id);
					$categories = get_categories( $args );
					foreach($categories as $category) 
					{ ?>
						
						<li <?php if($_REQUEST['q'] == $category->name) echo "class='current_li'";?> data-page="<?php echo $category->name;?>">
						
						<a data-val="<?php echo $category->name;?>"
						<?php if($_REQUEST['q'] == $category->name) echo "class='active'";?>
						 href="http://onlinedevserver.biz/dev/ascend/chamois/?q=<?php echo $category->name;?>"><i class="square"></i> <?php echo $category->name;?> </a></li>
						
						
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
		if ( have_posts() ) : ?>
			<div class="mainContentStart">
				<div class="productRowHolder">
			<?php
			/* Start the Loop */
			$q= $_REQUEST['q'];
			// The Query
				
			
			
				while ( have_posts() ) : the_post();
				echo "here";
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

</div>

<script>
	var link_url = '<?php echo $actual_link;?>'; 
	//alert(link_url);
	
	if(link_url == "http://onlinedevserver.biz/dev/ascend/chamois/")
	{
		jQuery('.main_items li').find("[data-page=Chamios]").addClass('opened');
	}
	
	</script>
<?php get_footer();
