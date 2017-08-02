<?php

/* Author : Shourya Chowdhury
 * Date: 15/3/17
 * Description: Customize the template for the product details page
 *  The page is calling from the single-product.php file from the root of the woocommerce folder
 *  in the theme folder
 * 
 ** 
 * **/

?>

<!-- **************** MODAL POPUP *****************  -->

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/pygments.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/easyzoom.css" />
<div class="popup_overlay">

   <div class="popup_body">
     
      <a href="#" class="cross"><img src="http://onlinedevserver.biz/dev/ascend/wp-content/themes/ascend/images/cross.png" alt="#"></a> 
      <div class="popup_content">
      <div class="content">
      
       
      
      </div>
   </div>
   </div>
</div>

<!-- Hidden Span Added -->
<span id="popupval"; visibility="hidden"></span>
<!-- End Of Span -->
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>



<?php $productId = get_the_ID(); ?>

<section id="products-details" class="products-details-div">
  <div class="container"> 
   <div class="products-details-box clearfix">
    <div class="products-details-left">
<!--
      <div id="js-gallery" class="gallery">
       <div class="products-detalis-tag">
        <img src="<?php echo get_template_directory_uri(); ?>/images/product-details-tag.png" />
       </div>
       <div class="gallery__hero">
      
        <img src="<?php echo get_template_directory_uri(); ?>/images/prodicts-details.jpg">
       </div>
-->
        <!--Gallery Thumbs-->
         
			 <!-- -Get The Gallery Image In The Slider Section- -->
			 
			 <section id="example">

				<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
				<a href="<?php echo get_template_directory_uri(); ?>/images/prodicts-details.jpg">
					<img src="<?php echo get_template_directory_uri(); ?>/images/prodicts-details.jpg" alt="" width="468" height="360" />
				</a>
			</div>

			<ul class="thumbnails">
				
				<?php
		$product = new WC_product($productId);
		$attachment_ids = $product->get_gallery_attachment_ids();
			$j=1;
			foreach( $attachment_ids as $attachment_id ) 
			{
				if($j==1)
				{
					$class_name = "is-active";
				}
				else
				{
					$class_name = "";
				}
				
				?>
				
				
				<li>
					<a href="<?php echo $full_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];?>" data-standard="<?php echo $full_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];?>">
						<img src="<?php echo $full_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];?>" alt="" />
					</a>
				</li>
				
			<?php
				$j++;
			}
		?> 
				
				
				
			</ul>

			

		</section>
			 
			 
			 
			
		
        <!-- Gallery Thumbs -->
    
<!--
      </div>
-->
    </div>
    
    <div class="products-details-right">
     <div class="products-details-right-heading">
      <h3> <?php echo get_the_title();?></h3> <!--Get The Product Name-->
     </div>

     <div class="products-rating clearfix">
      <span> User Rating: </span>
      <ul>
		  <?php echo do_shortcode('[rate]');?>
  </ul>
     </div>

     <?php $price_chart_on = get_post_meta($productId,'price_chart_price_chart_enable_or_not',true);
     
       if($price_chart_on == "Yes"):
     ?>
     <div class="products-details-right-pricing clearfix">
      <div class="products-details-right-pricing-left">
        <p> Pricing </p>
      </div>
      <div class="products-details-right-pricing-right">
       <p> <?php echo get_post_meta($productId,'price_chart_price_chart_description',true);?> </p>
      </div>
     </div> 

		<?php  echo $product->post->post_excerpt;?>
     <?php endif;?>
     
     <div class="product-chart-link-div clearfix">
      <div class="product-chart-link-div-left">
       <span> <i class="fa fa-random" aria-hidden="true"></i> </span>
       <?php //do_action( 'woocommerce_single_product_summary' );?>
       
       
       
       <a href="<?php echo get_post_meta($productId,'compare_jersey_link__link',true)?>">Compare this Jersey</a>
       
      </div>
      <div class="product-chart-link-div-right" id="charts">
       <span> <img src="<?php echo get_template_directory_uri(); ?>/images/shirt-icon.png" /> </span> 
        <?php wc_get_template_part( 'chart', 'template' ); ?>
<!--
       <a href="#" id="popupbpopup"><?php echo $gema75_chart_meta['charts_tab_header_or_modal_link_text']; ?></a> 
-->
<!--
       <a href="#"> Sizing Chart </a>
-->
      </div>
     </div>
     
     <div class="product-details-btn clearfix">
      <div class="product-details-btn-left searchAndBtn">
       <a href="javascript:void(0)" class="btn btn-get-started"><span>Order A SAMPLE</span></a>
      </div>
      <div class="product-details-btn-right searchAndBtn">
       <a href="javascript:void(0)" class="btn btn-get-started"><span>Customize this products</span></a>
      </div>
     </div>
     
    </div>
    
   </div>
  </div>
</section>

<!-- chamois slider ends --> 
<!-- Main content area -->
<!-- <section id="page_header">
  <div class="container exact_width_underline_left_align clearfix">
    <div class="header_offset_from_left">
      <h2 class="grey head_two exact_width left_align_head"><?php echo get_the_title();?></h2>
    </div>
  </div>
</section> -->
<div class="container contents Cyclin pro_details clearfix"> 
  <!-- <div class="mobile-heading">
    <h2>Cycling</h2>
  </div> --> 
  <!-- main sidebar -->
  <aside class="mainSidebar product-description-sticky">
    <div class="asideContainer itsAccordion">
      <section class="filterSection ">
        <ul class="main_items">
          <li><a href="#description">Description</a>
<!--
            <ul class="sub_items">
              <li><a href="javascript:void(0)"><i class="square"></i> Cycling </a></li>
              <li><a href="javascript:void(0)"><i class="square"></i> Triathlon </a></li>
            </ul>
-->
          </li>
           <li><a href="#fabric"><!-- <i class="square" ></i> --> Fabric </a></li>
              <li><a href="#components"><!-- <i class="square" ></i> --> Special Components </a></li>
              <li><a href="#construction"><!-- <i class="square" ></i> --> Construction </a></li>
          <!-- <li><a href="javascript:void(0)">Features <i class="fa fa-angle-down"></i></a>
            <ul class="sub_items">
             

              <li><a href="javascript:void(0)"><i class="square" ></i> Stitchings </a></li>

            </ul>
          </li> -->
   <!--       <li><a href="#option">Options</a>

            <ul class="sub_items">
              <li><a href="javascript:void(0)"><i class="square" ></i> Cycling </a></li>
              <li><a href="javascript:void(0)"><i class="square" ></i> Triathlon </a></li>
            </ul>

          </li>-->
  <!--        <li><a href="#size_charts">Sizing Charts </a>

            <ul class="sub_items">
              <li><a href="javascript:void(0)"><i class="square" ></i> Cycling </a></li>
              <li><a href="javascript:void(0)"><i class="square" ></i> Triathlon </a></li>
            </ul>

          </li>-->
         
        </ul>
      </section>
      <!-- filter top section -->
      <div class="head_four left_align_head full_width testimonials_heading">
       <h3>Testimonials</h3>
       </div>
       
      <?php
       $args = array(
   'posts_per_page' => 1,
   'category' => 0,
	'orderby' => 'rand',
	'post_type' => 'testimonial',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$custom_query = new WP_Query( $args );

while($custom_query->have_posts()) : 

$custom_query->the_post();

$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
?>
      <section class="inner-testimonials no_padding">
        <div class="inner-testimonials-box">
         <div class="inner-testimonials-img">
          <img src="<?php echo $image[0];?>" / alt="">
         </div>
         <div class="inner-testimonials-content">
          <p> <?php the_content() ;?></p>
          <div class="testimonial-author-name">
            <p> -<?php the_title() ;?> </p>
          </div>
         </div>
        </div>
      </section>
      <?php endwhile;wp_reset_postdata();?>
      <!-- filter bottom section --> 
    </div>
    <!-- end aside container --> 
  </aside>
  <!-- main sidebar ends --> 
  <!-- content Section -->
  <section class="productContent productContent-product-details">  
   
  <div class="exact_width_underline_left_align">
    
      <h2 class="grey head_two exact_width left_align_head"><?php echo get_the_title();?></h2>
    
  </div>

    <!-- product row holder -->
    <div class="productRowHolder">
		
		
    
      <div class="productRowHolder-top clearfix">
		  <?php $higlighs_on_or_not = get_post_meta($productId,'highlights_highlights_enable_or_not',true);
		      if($higlighs_on_or_not == "Yes"):
		?>
    <!-- highlight section commented on 24.4.2017 -->

		<!-- <div class="highlights_div_container">
       <h3> <?php echo get_post_meta($productId,'highlights_highlights_title',true); ?> </h3>
       <div class="productRowHolder-top-left">
        <ul>
			<?php
			$post_filed_custom =  get_post_custom_keys(get_the_ID()); 
				  
						foreach($post_filed_custom as $post_filed_custom_name)
						{
							//echo $post_filed_custom_name;
							$post_meta = get_post_meta(get_the_ID(),$post_filed_custom_name,true);
							//substr_count("Hello world. The world is nice","world");
							if(substr_count($post_filed_custom_name,"Highlights Left")>0)
							{?>
								<li>  <?php echo $post_meta;?> </li>
							<?php
							}
						}
			
			
			?>
			

        </ul>
       </div>
       <div class="productRowHolder-top-right">
        <ul>
         <?php
			$post_filed_custom =  get_post_custom_keys(get_the_ID()); 
				  
						foreach($post_filed_custom as $post_filed_custom_name)
						{
							//echo $post_filed_custom_name;
							$post_meta = get_post_meta(get_the_ID(),$post_filed_custom_name,true);
							//substr_count("Hello world. The world is nice","world");
							if(substr_count($post_filed_custom_name,"Highlights Right")>0)
							{?>
								<li>  <?php echo $post_meta;?> </li>
							<?php
							}
						}
			
			
			?>
			
        </ul>
       </div>
       </div> -->
       <?php endif;?>
      
       <div class="productRowHolder-toppart-bottom" id="description">
        <div class="more">
         <h3> Description: </h3>
         <div class="truncate">
            <?php the_content();?>
       </div>
        
      
        </div>
        
       
        
        
       </div>
       
      </div>
      <!-- productRow top -->
      <div class="product_Features_box_top" id="fabric">
       <div class=" product-details_time_line_heading">
        <!-- <h3> Fabrics: </h3> -->
        <h4> <span><i class="fa fa-stop" aria-hidden="true"></i></span>Fabrics: </h4>
       
        
        
       </div> 
      <?php wc_get_template_part( 'fabric', 'template' ); ?>
     
      
      <!-- product row holder -->
      <div class="productRowHolder">
       <div class="content_box">
        <div class="header_style product_details_header_style">
          <div class="header_inner">
            <div class="product_details_header_style-left">
              <h3>See one for yourself</h3>
            </div> 
            <div class="product_details_header_style-right">
             <div class="product-details-btn-left searchAndBtn">
              <a href="javascript:void(0)" class="btn btn-get-started"><span>get A SAMPLE</span></a>
             </div>
            </div>
          </div>
        </div>
       </div>
      </div>
      <!-- product row holder ends --> 
      
      <!--- time line heading -->
      <div class="product-details_time_line_heading" id="components">
       <h4>  <span><i class="fa fa-stop" aria-hidden="true"></i></span> Special Components: </h4>
      </div>
      <!--- time line heading end -->
       <?php wc_get_template_part( 'component', 'template' ); ?>
      
      <div class="time_line_bottom-div">
       <!--- time line heading -->
       <div class="product-details_time_line_heading"  id="construction">
       <h4>  <span><i class="fa fa-stop" aria-hidden="true"></i></span> CONSTRUCTION: </h4>
      </div>
       <!--- time line heading end -->
      <?php wc_get_template_part( 'construction', 'template' ); ?>
      </div>
      
      <!-- product row holder -->
      <div class="productRowHolder">
       <div class="content_box">
        <div class="header_style product_details_header_style">
          <div class="header_inner">
            <div class="product_details_header_style-left">
              <h3>See one for yourself</h3>
            </div> 
            <div class="product_details_header_style-right">
             <div class="product-details-btn-left searchAndBtn">
              <a href="javascript:void(0)" class="btn btn-get-started"><span>get A SAMPLE</span></a>
             </div>
            </div>
          </div>
        </div>
       </div>
      </div>
      <!-- product row holder ends --> 
      
      <!-- bottom option heading -->
      <!--  <div class="product_Features_box_top-heading bottom_option-heading" id="option">
        <h3> options: </h3>
       </div> -->
      <!-- bottom option heading end -->
      
      <!-- available holder -->
       <!-- <div class="available_box">
		   
	<?php	   
	//global $product; 

// Get product attributes
$attributes = $product->get_attributes();

$j=1;
foreach ( $attributes as $attribute ) 
{

    if($j%2==0)
    {
		$class_name = "available_box_right";
	}
	else
	{
		$class_name = "available_box_left";
	}
	global $product;
//echo $koostis = $product->get_attribute( $attribute['name']  );
	
	?>
	<div class="<?php echo $class_name?> available_div">
              
			   <?php
	
        //echo $attribute['name'] . ": ";
       $liquor_brands = get_terms( $attribute['name'] );
      $koostis = $product->get_attribute( $attribute['name']  );
       $term_name = str_replace("pa_","",$attribute['name']);
       
       
$cats = explode(",", $koostis);

       
       
       ?>
       <h5> available <?php echo $term_name?>: </h5>
           <ul>
			   <?php
                foreach($cats as $cat) 
                {
					//echo "here".$koostis;
					
					//echo $liquor_brand->slug . ' ';
					?>
					<li> 
             <div class="available-img-box">
              <a href="javascript:void(0)"><img src="<?php echo get_template_directory_uri(); ?>/images/available-img.png" /></a>
             </div> 
             <div class="available-content">
              <p><a href="javascript:void(0)"> <?php echo $cat = trim($cat);?> </a></p>
             </div>
            </li>
                    
                <?php
                }?>
			   
			   
            
           
           </ul>
         </div>
	

<?php
$j++;
}
?>
		      
         <div class="searchAndBtn sizing_chart" id="size_charts"> <a  id="popupbpopup1"  class="btn btn-get-started"><span>
			 Sizing chart</span></a> 
			
			 
			 </div>
         
       </div> -->
      <!-- available holder end -->
    </div>
    <!-- product row holder ends -->
    <?php wc_get_template_part( 'related', 'template' ); ?> 
  </section>
  
  <!-- end content section --> 
</div>
 


<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div>
<script>
	jQuery('.getPopupfab').on('click', function()
	{

  	var getId= jQuery(this).attr('id');
    var baseId= getId.split('img_').join('');
    jQuery('#popupval').html(baseId);
    /*Split the value*/
    var type = baseId.split('-');
    /*Get the post type*/
    var post_type = type[0];
    /*Get the post id*/
    var custom_post_id = type[1];
    
    url_name = "http://onlinedevserver.biz/dev/ascend/"+"technology_fabric/?post_id=";
    
    
   jQuery.ajax({url:url_name+custom_post_id,cache:false,success:function(result){
        jQuery(".content").html(result);
    }});
		
    
    
    
    jQuery('.popup_overlay').fadeIn(500);
   
  });
 
  jQuery('.cross').on('click', function(e){
  	e.preventDefault();
    jQuery('.popup_overlay').fadeOut(500);
  });
   jQuery('.popup_overlay .popup_body').on('click', function(e){
    e.stopPropagation();
  });
  jQuery('.popup_overlay').on('click', function(){
	   
	   jQuery('.popup_overlay').fadeOut(500);
	  });

  
	</script>
