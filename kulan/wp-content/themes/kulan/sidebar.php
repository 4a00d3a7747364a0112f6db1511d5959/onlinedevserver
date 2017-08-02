<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
	<div id="secondary" class="secondary">

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
					// Primary navigation menu.
					wp_nav_menu( array(
						'menu_class'     => 'nav-menu',
						'theme_location' => 'primary',
					) );
				?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' => 'social',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'blog-widget' ) ) { ?>
			<?php dynamic_sidebar( 'blog-widget' ); ?>
		<?php } ?>

		<!--category starts-->
		<?php 
			$current_user = wp_get_current_user();
		?>
		<div class="widget woocommerce">
		<h2 class="widget-title">Product Categories</h2>
		<?php

			$taxonomyName = "product_cat";
			//This gets top layer terms only.  This is done by setting parent to 0.  
		    $parent_terms = get_terms( $taxonomyName, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );

		    echo '<ul>';
		    foreach ($parent_terms as $pterm) {

		    	$thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
		        // get the image URL for parent category
		        $image = wp_get_attachment_url($thumbnail_id);

		        //show parent categories
		        echo '<li><img src="'.$image.'" width="40" height="40" /> <a href="' . get_term_link( $pterm->name, $taxonomyName ) . '">' . $pterm->name . '</a></li>';

		        // print the IMG HTML for parent category
		        //echo "<a href='".get_term_link( $pterm->name, $taxonomyName )."'><img src='".$image."' alt='' width='40' height='40' /></a>";

		        //Get the Child terms
		        $terms = get_terms( $taxonomyName, array('parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => true ) );
		        foreach ($terms as $term) {

		        	$thumbnail_id = get_woocommerce_term_meta( $pterm->term_id, 'thumbnail_id', true );
		            // get the image URL for child category
		            $image = wp_get_attachment_url($thumbnail_id);

		            echo '<li><img src="'.$image.'" width="40" height="40" /> <a href="' . get_term_link( $term->name, $taxonomyName ) . '">' . $term->name . '</a></li>';
		            
		            // print the IMG HTML for child category
		            //echo "<a href='".get_term_link( $term->name, $taxonomyName )."'><img src='".$image."' alt='' width='40' height='40' /></a>";
		        }
		    }
		    echo '</ul>';
		?>
		<!--category ends-->

	</div><!-- .secondary -->

<?php endif; ?>
