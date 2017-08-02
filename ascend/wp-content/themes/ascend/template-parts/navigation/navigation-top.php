<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Ascend_Theme
 * @since 1.0
 * @version 1.0
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'ascend' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo ascend_get_svg( array( 'icon' => 'bars' ) ); echo ascend_get_svg( array( 'icon' => 'close' ) ); _e( 'Menu', 'ascend' ); ?></button>
	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

	<?php if ( ( ascend_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo ascend_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'ascend' ); ?></span></a>
	<?php endif; ?>
</nav><!-- #site-navigation -->
