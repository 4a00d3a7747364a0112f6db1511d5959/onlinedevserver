<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( ); ?>
<?php //get_footer(  ); ?>


<?php
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $link_array = explode('/',$actual_link);
 $countSourceArr=count($link_array);
	$page_name =$link_array[$countSourceArr-2];
	
	$page_name = explode('-',$page_name);
	$cat_select = $page_name[1];
  $page_name = $page_name[0];
  
?>

<?php

//$obj = get_queried_object();

if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $cat_name = $cat->name;
		$parent = $cat->parent;
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image_new = wp_get_attachment_url( $thumbnail_id );
	    
	}
				
				
?>
<?php $parent_name = get_cat_name( $parent ) ?>


<section class="slider shop_page">
<!--
	<div class="banner_header">
		<h1 class="head_one white">FABRICS</h1>
	</div>
-->
</section>

<!-- chamois slider ends -->

	
	<section class="left-sidebar-shop">	
	<!-- Main content area -->
<div class="container contents fabric_container shop_custom clearfix">
	 
	
	<!-- main sidebar -->
  <aside class="mainSidebar">
    <div class="asideContainer">
      <div class="cat_head exact_width_underline_left_align">
         <h4 class="head_four exact_width left_align_head blue">Product Category</h4>
      </div> 
      <section class="filterSection itsAccordion">
		  <ul class="main_items">
			  <?php
			
				$taxonomy     = 'product_cat';
				$orderby      = 'name';
				$show_count   = 0; // 1 for yes, 0 for no
				$pad_counts   = 0; // 1 for yes, 0 for no
				$hierarchical = 1; // 1 for yes, 0 for no
				$title        = '';
				$empty        = 0;

				$args = array(
				'taxonomy' => $taxonomy,
				'orderby' => $orderby,
				'show_count' => $show_count,
				'pad_counts' => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li' => $title,
				'hide_empty' => $empty
				);
			$categories = get_categories( $args );
			foreach($categories as $category_par) 
			{
				if ($category_par->category_parent == 0) 
				{ 
					
					$thumbnail_id = get_woocommerce_term_meta( $category_par->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					
					$metafieldArray = get_option('taxonomy_'. $category_par->term_id);
					$metafieldoutput = $metafieldArray['custom_term_meta'];
					
					
					
					
					if($metafieldoutput !='')
					{
						$arrayds1[$metafieldoutput]= $category_par->term_id;
					
					
					}	
				}
			}
			
			$arraysc1 = ksort($arrayds1);
			?>
			  
			  
			  
		<?php
			
			foreach($arrayds1 as $arrayds1)
			{ 
				$category_id  = $arrayds1;
				$category_par = get_term_by( 'id', $arrayds1, 'product_cat' );
				 if ($category_par->category_parent == 0) 
    
				{ $category_id  = $category_par->term_id; ?>
					<li><a data-val="<?php echo $category_par->name;?>" href="javascript:void(0)"><?php echo $category_par->name;?> <i class="fa fa-angle-down"></i></a>
					<ul class="sub_items">
					<?php
        $args2 = array(
            'taxonomy' => $taxonomy,
            'child_of' => 0,
            'parent' => $category_id,
            'orderby' => $orderby,
            'show_count' => $show_count,
            'pad_counts' => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li' => $title,
            'hide_empty' => $empty
            
        );
        
        $sub_cats = get_categories($args2);
        if ($sub_cats) {
			
			foreach ($sub_cats as $sub_category) {
				
				//~ echo "parent is:".$cat_select;
				
				$product_cat_id = $sub_category->term_id;
			$link = get_term_link( $product_cat_id, 'product_cat' );
				
				?>
				<li <?php if($cat_select == 
						strtolower($category_par->name)) echo "class='current_li'";?>><a <?php if($page_name == 
						strtolower($sub_category->name)) echo "class='active'";?> href='<?php echo $link;?>'><i class='square'></i> <?php echo $sub_category->cat_name;?> </a></li>
				
			<?php }
			
		}?>
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
    
 <?php   do_action( 'woocommerce_sidebar' ); ?>
  </aside>
  <!-- main sidebar ends --> 
	<!-- content Section -->
	<section class="productContent">
		
		<?php if($parent_name !=''):?>
<!--
<section id="page_header">
   <div class="container exact_width_underline_left_align clearfix">
      <div class="header_offset_from_left">
		  
         <h2 class="grey head_two exact_width left_align_head"><?php echo $parent_name;?></h2>
         
      </div> 
   </div>
 </section>
-->
<?php endif;?>	
			<div class="product-shortcode">
				<div class="pro-custom">
					 <?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				
				<div class="head">
					<div class="overlay">
						<h3 class="white left_align_head"><?php echo woocommerce_page_title(); ?></h3>
					</div>  
					 <img src="<?php echo $image_new;?>" alt="#">
				</div>
		


			


		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
					
				<?php 
				
				while ( have_posts() ) : the_post();
				global $params;
				global $n;
				 ?>

					<?php wc_get_template_part( 'content', 'product',true); ?>
				
				<?php 
				$params++;
				endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


				 </div>
<!--
				<div class="product-details-btn-left searchAndBtn">
				  <a href="javascript:void(0)" class="btn btn-get-started"><span>View All Products</span></a>
				</div>
-->
			</div>	  

	   <!--End Of Cycling-->
	   
	<!-- end content section -->
</div>


</section>
	
	
	
	
	
	
	
	

<?php get_footer(  ); ?>
