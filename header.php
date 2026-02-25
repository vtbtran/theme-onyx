<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  
  <?php 
  if ( function_exists( 'wp_body_open' ) ) {
      wp_body_open(); 
  }
  ?>

  <?php

  $elementor_header_id = 3365; 


  // 2. Logic kiểm tra hiển thị
  if ( $elementor_header_id && class_exists( '\\Elementor\\Plugin' ) ) :
  ?>

      <div class="site-header-elementor-wrapper">
          <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_header_id ); ?>
      </div>

  <?php else : ?>

      <?php 
          // Gọi file từ thư mục: widgets/header-widget.php
          get_template_part('widgets/header', 'widget'); 
      ?>

  <?php endif; ?>