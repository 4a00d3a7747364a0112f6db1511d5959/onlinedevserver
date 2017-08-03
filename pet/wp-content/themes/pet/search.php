<?php get_header(); ?>

<section id="bottom_nav">
        <div class="container">
               <div class="bottom">
                <div class="">
                    <ul class="pet-blog">
                        <li><a href="<?php echo site_url(); ?>/"><i class="fa fa-clock-o"></i>Latest Posts</a></li>
                        <li><a href="<?php echo site_url(); ?>/category/trending/"><i class="fa fa-bolt"></i>Trending</a></li>
                        <li><a href="<?php echo site_url(); ?>/category/editors-choice/"><i class="fa fa-star"></i>Editors choice</a></li>
                    </ul> 
                </div>
               </div>
        </div>
    </section>

    <section id="top-blog-section error404">    
        <div class="container clearfix">
          <div class="inner-main-container">
              <div class="blogg clearfix">
				<h2 style="text-align: center;"><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h2> 

				<?php if(have_posts()) { while(have_posts()) { the_post(); ?>    		

	    		<a href="<?php the_permalink(); ?>"><?php search_title_highlight(); ?></a>

	    		<?php search_excerpt_highlight(); ?>

	    		<?php } get_search_form();

	    		}

	    		else{ echo "No data found. Please try with some other keywords"; 

	    	 get_search_form(); } ?>
              </div>
          </div>              
        </div>        
    </section>

<?php get_footer(); ?>