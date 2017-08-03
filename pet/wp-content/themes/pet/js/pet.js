jQuery(document).ready(function($){
	//shop page div wrap
	jQuery("img.attachment-shop_catalog").wrap("<div class='pro_img'></div>");
	jQuery( ".pro_img" ).append( "<div class='overlay'><a><i class='fa fa-plus-circle' aria-hidden='true'></i></a></div>" );

	//dropdown menu div wrap
	jQuery(".sub-menu").wrap("<div class='child'></div>");

	//active menu to home custom menu item
	var siteurl = window.location.href;
	//alert(siteurl);
	if( siteurl == '<?php echo site_url(); ?>' ){
		$('ul#menu-header-menu li:nth-child(1)').addClass('current_page_item');
	}
});