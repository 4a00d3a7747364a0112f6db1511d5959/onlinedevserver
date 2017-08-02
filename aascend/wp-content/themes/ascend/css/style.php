<?php
    header("Content-type: text/css; charset: UTF-8");
    $image_name = $_REQUEST['image'];
?>
.slider
   {
	       background: url(<?php echo $image_name?>) center center no-repeat !important;
   }


