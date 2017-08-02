<div class="side-widget-area">
	<div class="sider-search clearfix">
		<form role="search" method="get" class="searchform group clearfix" action="<?php echo home_url( '/' ); ?>">
		 	<p class="search-text"><input type="search" class="search-field" placeholder="<?php echo esc_html_e( 'Search', 'mykis-theme' ) ?>" value="<?php echo get_search_query() ?>" name="s" /></p>
		 	<p class="search-btn"><button name="search-button"><i class="fa fa-search"></i></button></p>
		</form>
	</div>
</div>