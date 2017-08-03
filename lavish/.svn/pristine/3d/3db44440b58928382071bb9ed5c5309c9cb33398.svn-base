<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "lp";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings For Home Page Different Options",
                    "type" => "heading");

	$options[] = array( "name" => "High Class",
                    "type" => "heading");				
	
					
$options[] = array( "name" => "High Class Escort Service",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_es_srv",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "High Class Escort Service",
					"desc" => "Here you can enter any description you want",
					"id" => "webq_es_srv_des",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "High Class Escort Service2",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_es_srv2",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "High Class Escort Service2",
					"desc" => "Here you can enter any description you want",
					"id" => "webq_es_srv_des2",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "High Class Escort Service3",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_es_srv3",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "High Class Escort Service3",
					"desc" => "Here you can enter any description you want",
					"id" => "webq_es_srv_des3",
					"std" => "",
					"type" => "webq_editor");						
																							
														
$options[] = array( "name" => "Our Discreet Concierge Service",
                    "type" => "heading");					
					

$options[] = array( "name" => "Our Discreet Concierge Service",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_dis_srv",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "Our Discreet Concierge Service Description",
					"desc" => "Here you can enter any description you want",
					"id" => "webq_dis_srv_des",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "Our Discreet Concierge Service2",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_dis_srv2",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "Our Discreet Concierge Service2 Description",
					"desc" => "Here you can enter any description you want",
					"id" => "webq_dis_srv_des2",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => " View All Exclusive Models",
                    "type" => "heading");	
                    
$options[] = array( "name" => "View All Exclusive Models",
					"desc" => "Here you can enter any heading you want and also give the link of the section",
					"id" => "webq_ex_models",
					"std" => "",
					"type" => "webq_editor");	                    				
	
$options[] = array( "name" => "Latest News",
                    "type" => "heading");										


$options[] = array( "name" => "Latest News",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_lat_news",
					"std" => "",
					"type" => "webq_editor");	
					

$options[] = array( "name" => "Latest News Subheading",
					"desc" => "Here you can enter any heading you want",
					"id" => "webq_lat_news_sub_heading",
					"std" => "",
					"type" => "webq_editor");	
					
$options[] = array( "name" => "General Settings For Footer Area",
                    "type" => "heading");	
                    
$options[] = array( "name" => "Copy Right Text",
					"desc" => "Here you can enter any copy right text you want",
					"id" => "webq_copy",
					"std" => "",
					"type" => "webq_editor");                    																						
$options[] = array( "name" => "Facebook Link",
					"desc" => "Here you can enter any fb link",
					"id" => "webq_fb",
					"std" => "",
					"type" => "webq_editor");                    																						
$options[] = array( "name" => "Twitter Link",
					"desc" => "Here you can enter any twitter link",
					"id" => "webq_twt",
					"std" => "",
					"type" => "webq_editor");                    																						
$options[] = array( "name" => "Instragram Link",
					"desc" => "Here you can enter any twitter link",
					"id" => "webq_ins",
					"std" => "",
					"type" => "webq_editor");                    																						
$options[] = array( "name" => "Youtube Link",
					"desc" => "Here you can enter any youtube link",
					"id" => "webq_youtube",
					"std" => "",
					"type" => "webq_editor");                    																						
	
update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
