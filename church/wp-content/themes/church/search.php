<?php get_header(); ?>

	<section class="inner-div clearfix">
		<div class="container">
	 		<div class="row">
	 	 		<div class="col-md-9 col-sm-9">
	 	 			<h2><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h2> 

	    			<?php 
	    				if(have_posts()) { while(have_posts()) { the_post(); ?>

				    		<a href="<?php the_permalink(); ?>"><?php search_title_highlight(); ?></a>

				    		<?php search_excerpt_highlight(); ?>

				    		<?php } get_search_form();

				    } else{ echo "No data found. Please try with some other keywords"; 

	    	 		get_search_form(); 

	    	 		} 
	    	 	?>

	   			</div>
				<div class="col-md-3 col-sm-3">
					<div class="right-content">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
    	</div>
	</section>	

<?php get_footer(); ?>