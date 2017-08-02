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
<?php if ( have_posts() ) : ?>

<?php if(get_post_type() == "chamois") {?>
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
					{ //print_r($category->term_id);
						
						 $category_link = get_category_link( $category->term_id );
						 ?>
						
						<li <?php if($page_name == 
						strtolower($category->name)) echo "class='current_li'";?> data-page="<?php echo $category->name;?>">
						
						<a data-val="<?php echo $category->name;?>"
						<?php if($page_name == 
						strtolower($category->name)) echo "class='active'";?>
						 href="<?php echo esc_url( $category_link ); ?>"><i class="square"></i> <?php echo $category->name;?> </a></li>
						
						
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
		  
		  <?php //echo $actual_link;
		     if($actual_link == home_url()."/tag/unisex/")
		     {
				 $tag_name_active = "unisex";
			 }
		   
		     if($actual_link == home_url()."/tag/female/")
		     {
				 $tag_name_active = "female";
			 }
		    
		     if($actual_link == home_url()."/tag/male/")
		     {
				 $tag_name_active = "male";
			 }
		  
		  
		  ?>
	  
		  <a class="acted_as_button <?php if($tag_name_active=="male") 
		  echo 'active_tag_filter';?>" href="<?php echo home_url()?>/tag/male/">Male</a>
	  
	  
		  <a class="acted_as_button <?php if($tag_name_active=="female") 
		  echo 'active_tag_filter';?>" href="<?php echo home_url()?>/tag/female/">Female</a>
	  
		  <a class="acted_as_button <?php if($tag_name_active=="unisex") 
		  echo 'active_tag_filter';?>" href="<?php echo home_url()?>/tag/unisex/">Unisex</a>
	  
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
			// The Query
				
			if($q !="")
			{
				$args = array(
				'numberposts' => 10,
				'category_name' => $q,
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
				'post_type' => 'chamois',
				'post_status' => 'publish'
			);
			query_posts( $args );
			}
			else
			{
				
			}
		
		
		
		if ( have_posts() ) : ?>
			<div class="mainContentStart">
				<div class="productRowHolder">
			<?php
			/* Start the Loop */
			
			
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

</div>

<script>
	var link_url = '<?php echo $actual_link;?>'; 
	//alert(link_url);
	
	if(link_url == "http://onlinedevserver.biz/dev/ascend/chamois/")
	{
		jQuery('.main_items li').find("[data-page=Chamios]").addClass('opened');
	}
	
	</script>
<?php } else {?>
	<div class="wrap">

	
	<?php //echo "post format is: ".get_post_type();?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			
			
			
			
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_type() );

			endwhile;

			the_posts_pagination( array(
				'prev_text' => ascend_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'ascend' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'ascend' ) . '</span>' . ascend_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ascend' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->
<?php } ?>		
<?php endif; ?>


<?php get_footer();
