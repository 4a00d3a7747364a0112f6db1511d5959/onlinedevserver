<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>

<div class="footer-banner-newsletter">
    <a href="<?php the_field('newsletter_link', 5); ?>"><?php the_field('newsletter_message', 5); ?></a>
</div>
<div class="footer_top" id="footer-brick">
    <div class="container-new">
        <div class="footer_mid  social">
            <ul class="social-list">
            
                <?php if( have_rows('social_media_section', 5) ): ?>
                  <?php while( have_rows('social_media_section', 5) ): the_row(); ?>

                    <li class="wow zoomIn" data-wow-delay="0.2s"><a href="<?php the_sub_field('social_media_link'); ?>" target="_blank"><em class="fa fa-<?php the_sub_field('social_media_icons'); ?>"></em></a></li>

                  <?php endwhile; ?>
                <?php endif; ?>
                
            </ul>
        </div>
    </div>
    <div style="clear:both;"></div>
    <div class="container-new">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                <h3 class="menu_head">BUY</h3>
                <div class="footer_menu">
                    <?php wp_nav_menu( array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'footer-buy-menu', 'link_before' => '', 'link_after' => '', )); ?>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                <h3 class="menu_head">SELL</h3>
                <div class="footer_menu">
                    <?php wp_nav_menu( array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'footer-sell-menu', 'link_before' => '', 'link_after' => '', )); ?>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                <h3 class="menu_head">RENT</h3>
                <div class="footer_menu">
                    <?php wp_nav_menu( array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'footer-rent-menu', 'link_before' => '', 'link_after' => '', )); ?>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                <h3 class="menu_head">EXPLORE</h3>
                <div class="footer_menu">
                    <?php wp_nav_menu( array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'footer-explore-menu', 'link_before' => '', 'link_after' => '', )); ?>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                <h3 class="menu_head">AGENTS</h3>
                <div class="footer_menu">
                    <?php wp_nav_menu( array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'footer-agents-menu', 'link_before' => '', 'link_after' => '', )); ?>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                <h3 class="menu_head">ABOUT</h3>
                <div class="footer_menu">
                    <?php wp_nav_menu( array( 'container' => '', 'menu_class' => '', 'menu_id' => '', 'theme_location' => 'footer-about-menu', 'link_before' => '', 'link_after' => '', )); ?>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
                <h3 class="menu_head">Contact us</h3>
                <div class="footer_menu_contact">
                    <?php the_field('contact_information_section', 5); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer_b">
    <div class="container-new">
        <div class="row">
            <div class="col-md-11 col-sm-11 col-xs-12">
                <div class="footer_bottom1">
                    <p class="text-block1">&copy; 2006 - <?php echo date('Y'); ?> <?php the_field('copyright_information', 5); ?> </p>
                </div>
                <div class="footer_bottom">
                    <?php //echo get_post_meta( get_the_ID(), 'sb_copy_text', true ); ?>
                    <?php the_field('copyright_site_message', 5); ?>
                </div>
            </div>
        </div>
    </div>
</div>
	
<?php wp_footer(); ?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-596c75dd05cc2c2b"></script>

</body>
</html>
