<?php
/**
* Plugin Name: WP Plugin Lock By Admin
* Plugin URI: http://uniterrene.com/
* Description: Uniterrene websoft is an outsourcing IT & Software offshore development company which provides professional web designing services.
* Version: 1.0 
* Author: Uniterrene
* Author URI: http://uniterrene.com/
* License: UNIDS001
*/
define( 'WPLOCK_PLUGIN_DIR',plugin_dir_path( __FILE__ ) );
register_activation_hook( __FILE__, 'wppluginlock_install' );
register_activation_hook( __FILE__, 'wppluginlock_install_install_data' );

global $lockwpplugin_db_version;
$lockwpplugin_db_version = '1.0';

function wppluginlock_install() {
	global $wpdb;
	global $lockwpplugin_db_version;

	$table_name = $wpdb->prefix . 'wppluginlock';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		lockid mediumint(9) NOT NULL AUTO_INCREMENT,
		locktime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		lockname tinytext NOT NULL,
		lockpass text NOT NULL,
		lockslug text NOT NULL,
		lockcontent text NOT NULL,
		lockurl varchar(55) DEFAULT '' NOT NULL,
		lockstatus varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (lockid)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'lockwpplugin_db_version', $lockwpplugin_db_version );
}

function wppluginlock_install_install_data() {
	global $wpdb;
	
	$welcome_name = 'WP Plugin Lock By Admin';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'wppluginlock';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'locktime' => current_time( 'mysql' ), 
			'lockname' => $welcome_name, 
			'lockcontent' => $welcome_text, 
			'lockpass' => 'wppluginlock', 
			'lockslug' =>'wp-plugin-lock-admin', 
			'lockstatus'=>'No',
		) 
	);
}
require_once( WPLOCK_PLUGIN_DIR . 'wp-init.php');
add_action('admin_footer', 'my_admin_footer_function');

add_action('wp_ajax_upload-plugin', 'upload-plugin');
add_action('wp_ajax_nopriv_upload-plugin', 'upload-plugin');

function my_admin_footer_function() {
	?>
  <script>
/*jQuery(window).load(function() {

jQuery("#plugin-filter #the-list .plugin-action-buttons .button").removeClass("install-now");
jQuery("#plugin-filter #the-list .plugin-action-buttons .button").addClass("install-nowds");

});*/




/**/

jQuery(document).ready(function() {
jQuery( "#plugin-filter" ).hover(function() {
// alert('woo');
  jQuery("#plugin-filter #the-list .plugin-action-buttons .button").removeClass("install-now");
jQuery("#plugin-filter #the-list .plugin-action-buttons .button").addClass("install-nowds");
});
/*
	jQuery('#plugin-filter').bind('contentchanged', function() {
  // do something after the div content has changed
  alert('woo');
  jQuery("#plugin-filter #the-list .plugin-action-buttons .button").removeClass("install-now");
jQuery("#plugin-filter #the-list .plugin-action-buttons .button").addClass("install-nowds");
});*/

	  
  var ajaxurl='<?php echo admin_url( 'admin-ajax.php' );?>';
	jQuery('#plugin-filter').on( 'click', 'a.install-nowds.button', function(event) {
		
if(event.stopPropagation){event.stopPropagation();}event.cancelBubble=true;
	
	
		var dataname=jQuery(this).attr('data-name');
		var dataslag=jQuery(this).attr('data-slug');
		jQuery(this).parents('li').hide();
	var plurl=jQuery(this).attr('href');
	
	jQuery('#plname').html(dataname);
	
	jQuery('#pname').val(dataname);
	jQuery('#plockurl').val(plurl);
		jQuery('#plockslag').val(dataslag);
jQuery('#lockdiv').show();
event.preventDefault();
return false;
});

jQuery('#the-list').on( 'click', '.inactive .activate a.edit', function(e) {
	var name_text = jQuery(this).parent().parent().parent().find('> strong').text();
var plurl=jQuery(this).attr('href');
jQuery('#lockactivediv').show();
jQuery('#plnameact').html(name_text);
jQuery('#paname').val(name_text);
jQuery('#palockurl').val(plurl);

e.preventDefault();
return false;
});




	jQuery('#lockasubmit').on('click', function(e) {
	jQuery('#imglodupdate').show();
	jQuery('#lockdivcontentupdate').hide();
		var pname=jQuery('#paname').val();
		var lockpass=jQuery('#lockapass').val();
	//alert(pname + '||'+lockpass);
		var data = {
			'action': 'wplock_active_action',
			'name': pname,
			'pass':lockpass,	
		};
		jQuery.post(ajaxurl, data, function(response) {
			if(response>0){
				
				var activeurlplugin=jQuery('#palockurl').val();
						var urlractiv='<?php echo admin_url();?>' + activeurlplugin;
				
			window.location.href =urlractiv;
			
			}else{
		
					jQuery('#imglodupdate').hide();
					
					jQuery('.perror').show();
	jQuery('#lockdivcontentupdate').show();
				}
			});
	
});
		
	jQuery('#locksubmit').on('click', function(e) {
	//alert('xxxxxx');
	jQuery('#imglod').show();
	jQuery('#lockdivcontent').hide();
	

	
		var pname=jQuery('#pname').val();
		var pcontent=jQuery('#pcontent').val();
		var lockpass=jQuery('#lockpass').val();
		var plockslag=jQuery('#plockslag').val();
//alert(pname + '||'+pcontent + '||'+lockpass);
		if(lockpass){
			
			
		var data = {
			'action': 'wplock_action',
			'name': pname,
			'content':pcontent,
			'pass':lockpass,	
			'pslag':plockslag,	
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {	
			//alert('Got this from the server: ' + response);
			var lu= jQuery('#plockurl').val();
			
			var pluginzip=jQuery('#pluginzip').val();
              //  alert("New content loaded successfully!");
			  if(pluginzip){
				jQuery('form.wp-upload-form').submit();
				
				}else{
				
			jQuery("#lockdivcontent").load(lu, function(responseTxt, statusTxt, jqXHR){

            if(statusTxt == "success"){

					
				jQuery('#lockdivcontent').show();
				jQuery("#lockdivcontent").html("New content loaded successfully! , <br> Go To <a href='<?php echo admin_url();?>plugins.php'>Plugins page .</a>");
				jQuery('#imglod').hide();
		

            }

            if(statusTxt == "error"){
	jQuery('#lockdivcontent').show();
              //  alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
jQuery("#lockdivcontent").html("Error: " + jqXHR.status + " " + jqXHR.statusText);
jQuery('#imglod').hide();
            }

        });
		
				}
				
		});
				
		}else{
				jQuery('#imglod').hide();
	jQuery('#lockdivcontent').show();
			}
		
		
	});
	
	/*jQuery('#wpbody-content .wrap p a.button.button-primary').on('click', function(e) {
var plurl=jQuery(this).attr('href');
	alert(plurl);
	return false;
	
	});*/


jQuery('img.close').on('click', function(e) {
	jQuery('#lockactivediv').hide();
jQuery('#lockdiv').hide();
			});
jQuery('.lockasubmitdownload').on('click', function(e) {
		var dataslag=jQuery(this).attr('data-slug');
	//alert(pname + '||'+lockpass);
		var data = {
			'action': 'downloadpluginformdir',
			'name': dataslag,
		};
		jQuery.post(ajaxurl, data, function(response) {
				window.open(response,'_blank');			
			});
	
});


jQuery("#pluginzip").change(function(event) {
var plurl=jQuery(this).val();
var plurlname=jQuery(this).val().replace(/C:\\fakepath\\/i, '');
var pnamearray=plurlname.split('.');
/*alert(pnamearray.length);
if()*/
	jQuery('#plname').html(plurlname);
	
	jQuery('#pname').val(plurlname);
	jQuery('#plockurl').val(plurl);
		jQuery('#plockslag').val(pnamearray[0]);
jQuery('#lockdiv').show();

event.preventDefault();
return false;

    });

	});
	</script>
   <style>
   #lockdiv,#lockactivediv{ background: #fff none repeat scroll 0 0;
    border: 2px solid;
    left: 25%;
    padding: 50px;
    position: absolute;
    top: 200px;
	display:none;
   }
   #imglod,#imglodupdate,#wpbody-content .wrap p a.button.button-primary,.perror{
	   display:none;
	   }
	   #install-plugin-submit{
	   display:none !important;
	   }
	#pluginuploadclass{
		width: 25%; margin-left: 25%; line-height: 43px; border: 1px solid; padding: 10px;
		}
		img.close{
float: right;
    margin-right: -68px;
    margin-top: -75px;
	}
   </style> 
   <?php //echo WP_PLUGIN_DIR;?>
    <div id="lockdiv">
     <img class="close" src="<?php echo plugins_url( 'img/close-icon.png', __FILE__ );?>" />
    <img src="<?php echo plugins_url( 'img/loading.gif', __FILE__ );?>" id="imglod" >
    <div id="lockdivcontent">

  Name:<br><samp id="plname"></samp>
  
  <input type="hidden" name="pname" id="pname" placeholder="Plugin Name">
  <br>
<br>
 <textarea name="pcontent" id="pcontent">
 </textarea>
  <br><br>
  <input type="text" name="lockpass" id="lockpass" placeholder="Plugin Activation Code">
  <br>
<br>
<input type="hidden" name="plockurl" id="plockurl" />
<input type="hidden" name="plockslag" id="plockslag" />
  <input type="button" value="Submit" id="locksubmit">
  </div>
</div>

 <div id="lockactivediv">
 <img class="close" src="<?php echo plugins_url( 'img/close-icon.png', __FILE__ );?>" />
     <img src="<?php echo plugins_url( 'img/loading.gif', __FILE__ );?>" id="imglodupdate" >
     <samp class="perror" style="color:#fff; background:#000; font-weight:bold;">Enter Valid Plugin Activation Code.</samp>
    <div id="lockdivcontentupdate">
  Name:<br><span id="plnameact"></span>
  <input type="hidden" name="paname" id="paname" placeholder="Plugin Name">
  <br>
<br>

  <input type="text" name="lockapass" id="lockapass" placeholder="Plugin Activation Code">
  <br>
<br>
<input type="hidden" name="palockurl" id="palockurl" />
  <input type="button" value="Submit" id="lockasubmit">
</div>
</div>


<?php
	
}


add_action( 'wp_ajax_wplock_active_action', 'wplock_active_action' );
add_action("wp_ajax_nopriv_wplock_active_action", "wplock_active_action");
function wplock_active_action(){
	global $wpdb; 
$table_name = $wpdb->prefix . 'wppluginlock';
	/*$querylock = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table_name` WHERE `lockname` LIKE '%the%' "));
$name ='';
foreach( $querylock as $results ) {

      $name.= $result->lockname.'<br>';
    }
	echo $name;*/
$pmane=explode(' ',$_REQUEST['name']);

$lockapass=$_REQUEST['pass'];

$plock_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE lockname LIKE '%$pmane[0]%' AND lockpass=$lockapass" );
echo "{$plock_count}";
die();   
	}
add_action( 'wp_ajax_wplock_action', 'wplock_action' );
add_action("wp_ajax_nopriv_wplock_action", "wplock_action");
function wplock_action() {
	global $wpdb; // this is how you get access to the database
/*$_REQUEST['name'];
$_REQUEST['content'];
$_REQUEST['pass'];
$_REQUEST['pslag'];*/


	
	$table_name = $wpdb->prefix . 'wppluginlock';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'locktime' => current_time( 'mysql' ), 
			'lockname' => $_REQUEST['name'], 
			'lockcontent' => $_REQUEST['content'], 
			'lockpass' => $_REQUEST['pass'], 
			'lockslug' => $_REQUEST['pslag'], 
			'lockstatus'=>'No',
		) 
	);
	echo 'update-data';
	/*$whatever = intval( $_POST['whatever'] );
	$whatever += 10;
echo $whatever;*/
wp_die(); // this is required to terminate immediately and return a proper response
}

add_action( 'wp_ajax_downloadpluginformdir', 'downloadpluginformdir' );
add_action("wp_ajax_nopriv_downloadpluginformdir", "downloadpluginformdir");
function downloadpluginformdir(){
	global $wpdb;
	$fileslagname=$_REQUEST['name'];

	$rootPath =WP_PLUGIN_DIR.'/'.$fileslagname;
$zipfileconte=WP_PLUGIN_DIR.'/'.$fileslagname.'.zip';
// Initialize archive object
$zip = new ZipArchive();

$zip->open($zipfileconte, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

$zip->close();
echo plugins_url().'/'.$fileslagname.'.zip';
exit();
wp_die(); // this is required to terminate immediately and return a proper response
	}

add_filter('upload_mimes', 'add_custom_upload_mimes');
 
function add_custom_upload_mimes( $existing_mimes ){
  $existing_mimes['zip'] = 'application/zip';
  return $existing_mimes;
}

?>