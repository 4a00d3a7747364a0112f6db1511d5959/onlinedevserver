<?php
/**
 * Template Name: Shop Page Template
 */
 
 get_header();
 global $product; global $woocommerce;
?>
<section class="slider shop_page">
  <!-- <div class="banner_header">
    <h1 class="head_one white">Chamois</h1>
  </div> -->
</section>
<!-- chamois slider ends --> 
<!-- Main content area -->

<div class="container contents shop clearfix"> 
  <!-- <div class="mobile-heading">
    <h2>Cycling</h2>
  </div> --> 
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
				$product_cat_id = $sub_category->term_id;
			$link = get_term_link( $product_cat_id, 'product_cat' );
				
				?>
				<li><a href='<?php echo $link;?>'><i class='square'></i> <?php echo $sub_category->cat_name;?> </a></li>
				
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
  </aside>
  <!-- main sidebar ends --> 
  <!-- content Section -->
  <section class="productContent" > 
	  
<!--
	  <section id="page_header">
  <div class=" exact_width_underline_left_align clearfix">
    <div class="header_offset_from_left">
		 		  <h2 class="grey head_two exact_width left_align_head">Custom Sportswear</h2>
		      </div>
  </div>
</section>
-->
	  
	  <!-- <h3 class="no_selection"></h3> -->
	   <!-- product row holder -->
	   <div id="show_loader"><img src="http://www.internet.ch/images/icons/icon_loading_animated2.gif"/></div>
		<div class="productRowHolder ">
			
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
						$arrayds[$metafieldoutput]= $category_par->term_id;
					
					
					}	
				}
			}
			
			$arraysc = ksort($arrayds);
			
			
			foreach($arrayds as $arrayds)
			{
				
				$category_par = get_term_by( 'id', $arrayds, 'product_cat' );
				
				$thumbnail_id = get_woocommerce_term_meta( $arrayds, 'thumbnail_id', true );
				$image_new = wp_get_attachment_url( $thumbnail_id );
				
				$product_cat_id = $category_par->term_id;
				$link = get_term_link( $product_cat_id, 'product_cat' );
				
				?>

				
				<div class="productRow ">
			  <div class="head">
				<div class="overlay">
				   <h3 class="white left_align_head"><?php echo $category_par->name;?></h3>
				</div>  
				<img src="<?php echo $image_new;?>" alt="#">
			  </div>
          <div class="box_area">
			  
			  
			  
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => 3, 
        
        'meta_query' => array(
			array(
			'key' => 'shop_page_option_select_to_show_in_shop_page',
			'value' => 'Yes',
			)
			),
        
        'product_cat' => $category_par->slug);
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			<?php  $pid = get_the_ID();
			
			$url = get_permalink($pid);
			
			
			?>
			<div class="box clearfix ">
			<a href="<?php echo $url; ?>">
			<div <?php post_class(); ?>>
				
                <div class="box_inner">
                   <!-- <ul class="icons">
                     <li><a href="http://onlinedevserver.biz/dev/ascend?action=yith-woocompare-add-product&amp;id=<?php echo $pid; ?>" class="compare" data-product_id="<?php echo $pid; ?>" rel="nofollow"><i class="fa fa-tags" aria-hidden="true"></i></a></li>
                    
                     <li class="yith-wcwl-add-button show">
					<a href="http://onlinedevserver.biz/dev/ascend/product/elevate-cycling-jersey-mens/?add_to_wishlist=<?php echo $pid; ?>" rel="nofollow" data-product-id="<?php echo $pid; ?>" data-product-type="simple" class="add_to_wishlist">
					<i class="fa fa-heart" aria-hidden="true"></i></a>
					<img src="http://onlinedevserver.biz/dev/ascend/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility: hidden;">
					</li>
                   
                     <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                   </ul> -->
                 <?php  the_post_thumbnail('shop_thumbnail'); ?>
                </div>
                <div class="box_left">
                   <p><a href="<?php echo $url;?>"><?php the_title(); ?></a></p>

                </div> 
                <div class="box_right">
                   <p class="price"><?php echo $product->get_price_html(); ?></p>
                </div> 
             </div>
             </a>
			</div>
			
			
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
				
			 <div class="read_more_btn">
             <a href="<?php echo $link;?>" class="btn btn-get-started"><span>View All Products</span></a>
          </div>	
				
			<?php
			}
			?>
			
			
			
	     
</div><!--/.products-->
		     
         
          
      </div>
     
      <!-- productRow 1 -->

  </section>
  <!-- end content section --> 
</div>

<?php
get_footer();
?>
