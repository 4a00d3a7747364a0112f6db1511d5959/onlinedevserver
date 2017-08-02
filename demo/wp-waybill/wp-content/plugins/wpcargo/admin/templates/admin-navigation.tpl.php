<?php
	$view = $_GET['page'];
?>
<h2 class="nav-tab-wrapper"> <a class="nav-tab <?php echo ( $view == 'wpcargo-settings') ? 'nav-tab-active' : '' ;  ?>" href="<?php echo admin_url().'admin.php?page=wpcargo-settings'; ?>" >
  <?php _e('Shipment Settings', 'wpcargo'); ?>
  </a> <a class="nav-tab <?php echo ( $view == 'wpcargo-email-settings') ? 'nav-tab-active' : '' ;  ?>" href="<?php echo admin_url().'admin.php?page=wpcargo-email-settings'; ?>" >
  <?php _e('Email Settings', 'wpcargo'); ?>
  </a>
  <?php do_action('wpc_add_settings_nav'); ?>
</h2>
