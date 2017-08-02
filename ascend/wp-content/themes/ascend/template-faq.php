<?php
/**
 * Template Name: Faq Template
 */
 
 get_header();
 //global $product; global $woocommerce;
?>
<?php
while (have_posts()) : the_post();

?>

<!-- faq slider -->
<section class="slider faq">
	<div class="container clearfix">
	    <div class="leftPart">
	    	
	    	<h1>Frequently Asked Questions</h1>
	    	<div class="search_bg">
	    		<form class="clearfix search" action="<?php echo home_url( '/' ); ?>">
	    			<input type="search" name="s" placeholder="Search Now...">
	    			<span class="bar"></span>
	    			<input type="submit" value="">
	    			<input type="hidden" name="post_type" value="general_faq">
	    		</form>
	    		
<!--
	    		<form class="search" action="<?php //echo home_url( '/' ); ?>">
  <input type="search" name="s" placeholder="Search&hellip;">
  <input type="submit" value="Search">
  <input type="hidden" name="post_type" value="kb_article">
</form>
-->
	    		
	    		
	    		<p>Can’t find what you are looking for? - <a href="#"> Ask your own Question</a></p>
	    	</div>
	    </div>
	    <div class="rightPart">
	    	<h3>Want Help Now?</h3>
	    	<p>Call Us : 1-800-894-7105</p>
	    	<a href="javascript:void(0)" class="btn btn-get-started"><span>get started</span></a>
	    	
	    </div>
		
	</div>
</section>

<!-- FAQ Form --> 
<section class="ask_question">
	<div class="container clearfix">
	    <div class="header exact_width_underline_left_align clearfix">
	    	
	    </div>
		<div class="ask_form">
		<div class="HeadingTestimonials">
		 		  <h2 class="partical_bothside">Ask a Question?
                  <span></span>
		 		  </h2>
		      </div>
			<form>
				<div class="form_Part_main">
					<div class="row">
						<input type="text" name="f_name" placeholder="First Name">
					</div>
					<div class="row">
						<input type="text" name="l_name" placeholder="Last Name">
					</div>
					<div class="row">
						<textarea placeholder="Question"></textarea>
					</div>
					<div class="row form_Part">
						<input type="submit" value="SUBMIT NOW">
					<div class="bor"></div>
					</div>

				</div>
				
				
			</form>
		</div>
  </div>
	</div>
</section>

<!-- *********** Main Content Area ************ -->
<section id="faq_area" class="clearfix">
<?php $terms = get_terms( array(
    'taxonomy' => 'faq_gen',
    'order' => 'DESC',
    'hide_empty' => false,
) );


$j=1;$step=4;$class_name="";
$nextid=2;
foreach($terms as $category) { 
 //echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';

//print_r($category->term_taxonomy_id);

$nextid=$nextid+$step;
$nextidt=$nextid+1;
 if($nextid==$j || $nextidt==$j)
{
	$class_name="grey";
	
	}else{
		
	switch($j){
		case 2:$class_name="grey";
		break;
		case 3:$class_name="grey";
		break;
		default:$class_name="";
		break;		
		}
		
	}
?>
<div class="faq_box <?php echo $class_name;?>">
		<div class="header">
		    <h3 class="partical_bothside"><?php print_r($category->name);?> <span></span></h3>
		</div>
        <div class="half_container">
<?php

$args = array('post_type' => 'general_faq',
    'tax_query' => array(
        array(
            'taxonomy' => 'faq_gen',
            'field' => 'term_id',
            'terms' => $category->term_taxonomy_id,
        ),
    ),
 );

 $loop = new WP_Query($args);
 if($loop->have_posts()) {
    //echo '<h2>'.$custom_term->name.'</h2>';

    while($loop->have_posts()) : $loop->the_post();?>
    <div class="accordion">
        		<div class="accordion_head">
        			<p><?php echo get_the_title();?> </p>
        			<span class="plus">+</span>
        			<div class="q"><p>Q</p></div>
        		</div>
        		<div class="content">
        			<p>
<?php echo get_the_content();?></p>
        		</div>
        	</div>
        <?php
        //echo '<a href="'.get_permalink().'">'.get_the_title().'</a>'."<br/>";
    endwhile;
 }




?>
	
        	
        	
        	
        </div>
	</div>



<?php $j++; 
$class_name="";
} ?>
</section>
<?php
endwhile;
?>

 
<?php
get_footer();
?>
