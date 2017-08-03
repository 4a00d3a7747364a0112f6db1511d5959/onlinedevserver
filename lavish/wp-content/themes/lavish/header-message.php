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
<link rel="icon" 
      type="image/png" 
      href="<?php echo esc_url( get_template_directory_uri() )?>/images/FAVICON.png">
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

<section id="header-casting-message" class="header-casting-message-box">
 <div class="container clearfix">
  <div class="casting-message-text">
   <h1> Thank you for your Application. </h1>
   <h2> we're processing your request </h2>
  </div>
  <div class="casting-message-logo">
   <a href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/header-logo.png" alt="logo" title="logo image"></a>
  </div>
 </div>
</section>


<!--End Div-->





