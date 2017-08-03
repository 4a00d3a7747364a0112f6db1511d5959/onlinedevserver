<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
<title>Lavish</title>

 <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/custom.css">
 <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/responsive.css">
 <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css"  href="<?php echo esc_url( get_template_directory_uri() )?>/css/normalize.css">
 <link rel="stylesheet" type="text/css"  href="<?php echo esc_url( get_template_directory_uri() )?>/css/styles.css">
 <link rel="stylesheet" type="text/css"  href="<?php echo esc_url( get_template_directory_uri() )?>/css/jquery.bxslider.css" >
 <link rel="stylesheet" type="text/css"  href="<?php echo esc_url( get_template_directory_uri() )?>/css/jquery_dropdown.css">

<?php wp_head(); ?>
</head>

<body>

<section id="header-vip-message" class="header-vip-message-box">
 <div class="container clearfix">
  <div class="vip-message-text">
   <h1> Thank you for your vip Booking. </h1>
   <h2> we're arranging your membership. </h2>
  </div>
  <div class="vip-message-logo">
   <a href="#"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/header-logo.png" alt="logo" title="logo image"></a>
  </div>
 </div>
</section>


<!--End Div-->





