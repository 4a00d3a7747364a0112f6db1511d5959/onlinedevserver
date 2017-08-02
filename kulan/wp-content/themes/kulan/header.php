<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->	
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="header sticky-header" >
        <div class="logo">
        	<a href="<?php echo esc_url(home_url()); ?>">
        		<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Kulan San Francisco Logo" />
       		</a>
       	</div>
        <div class="flip-container vertical">
            <div class="flipper">
                <div class="front">
                    <div class="allit">
                        <?php 
                    		wp_nav_menu( array( 'container' => '', 'menu_class' => 'location-chooser', 'menu_id' => '', 'theme_location' => 'location-menu', 'link_before' => '', 'link_after' => '', ));
                    	?>
                        <div class="menu-all-primary-container">
                        	<?php 
                    			wp_nav_menu( array( 'container' => '', 'menu_class' => 'menu', 'menu_id' => 'menu-all-primary', 'theme_location' => 'header-menu', 'link_before' => '', 'link_after' => '', ));
                    		?>
						</div>                    
					</div>
                </div>
                <div class="back">            
                    <div id="search_form">
                        <form method="get" action="#">
                            <label for="search_text" style="display:none">Search</label>
                            <input type="text" id="search_text" name="s" value="" placeholder="Search" />  
                            <input type="submit" id="search_submit" value="Go" />     
                            <fieldset class="search_options">
                                <label for="t" style="display:none">Search Type</label>
                                <input type="radio" name="t" title="listing" value="listing" >Buy
                                <input type="radio" name="t" title="properties" value="properties" >Rent
                                <input type="radio" name="t" title="agents" value="agents" >Agents
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <em class="fa fa-search"></em>
        <em class="fa fa-bars"></em>
    </div>
	
	<?php if( is_front_page() ){ ?>
    <div class="content home-video-wrap">
	    <div class="home-video">
	       <ul class="bxslider">
	       		<?php 
		              $banner_args = array( 'post_type' => 'sb_banner', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date', );

		              $banner_query = new WP_Query( $banner_args ); 

		              while ($banner_query -> have_posts()) : $banner_query -> the_post();
		          ?>
	            <li>
	              <div class="overlay">
	                 <div class="banner_logo">
	                   <div class="logo_inner">
	                     <?php the_content(); ?>
	                   </div>
	                </div>
	              </div>
	              	<?php if ( has_post_thumbnail() ) : ?>
					    <?php the_post_thumbnail('full'); ?>
					<?php endif; ?>
	            </li>

	            <?php 
	              endwhile; 
	              wp_reset_postdata();;
	            ?>

	         </ul>
	    </div>

	    <div class="video-logo-wrap" style="display:none;">
	        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-black-full-2015_2.png" />
	    </div>
	</div>
	<?php } ?>