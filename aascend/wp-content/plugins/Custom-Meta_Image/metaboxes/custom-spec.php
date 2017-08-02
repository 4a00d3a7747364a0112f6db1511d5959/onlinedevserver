<?php

$custom_mb = new WPAlchemy_MetaBox(array
(
'id' => '_custom_meta',
'title' => 'My Custom Meta',
'template' => get_stylesheet_directory() . '/metaboxes/custom-meta.php',
));
