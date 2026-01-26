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

  <header id="site-header" class="site-header">
    <div class="header-container">

      <button id="mobile-menu-trigger" class="mobile-toggle">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2">
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
      </button>
      <div class="site-logo">
        <a href="<?php echo home_url(); ?>">
          <?php
          // Ưu tiên 1: Nếu người dùng có upload logo riêng trong Admin thì dùng nó
          if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
          }
          // Ưu tiên 2: Nếu không upload, thì lấy file logo mặc định trong thư mục assets
          else {
          ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/onyx-logo.webp" alt="Onyx Default Logo">
          <?php
          }
          ?>
        </a>
      </div>
      <nav class="desktop-navigation">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'menu-list', // Class chung để style
          'fallback_cb'    => false,
        ));
        ?>
      </nav>

      <div class="header-cta">
        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="btn-contact">
          <span class="icon-box">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="7" y1="17" x2="17" y2="7"></line>
              <polyline points="7 7 17 7 17 17"></polyline>
            </svg>
          </span>
          <span class="btn-text">Contact Us</span>
        </a>
      </div>

    </div>
  </header>
  <div class="mobile-menu-overlay" id="mobileMenu">

    <div class="mobile-menu-header">
      <button class="btn-close-menu" id="closeMenuBtn">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>

      <div class="mobile-logo">
        <a href="<?php echo home_url(); ?>">
          <?php
          if (has_custom_logo()) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
          } else {
            // Đường dẫn logo mặc định của bạn
            echo '<img src="' . get_template_directory_uri() . '/assets/images/onyx-logo.webp" alt="Onyx Default Logo">';
          }
          ?>
        </a>
      </div>
    </div>
    <?php
    wp_nav_menu(array(
      'theme_location' => 'primary',       // Lấy menu "Primary" giống hệt Desktop
      'container'      => false,           // Không tạo thẻ div bao ngoài
      'menu_class'     => 'mobile-nav-list', // Gán class CSS bạn đã viết vào thẻ <ul>
      'fallback_cb'    => false,           // Không hiển thị gì nếu chưa cài menu
    ));
    ?>
  </div>

  <?php wp_footer(); ?>
</body>

</html>