<?php
// Kiểm tra class tồn tại để tránh lỗi
if ( ! class_exists( 'Onyx_Header_Widget' ) ) {

    class Onyx_Header_Widget extends \Elementor\Widget_Base {

        public function get_name() { return 'onyx_header_widget'; }
        public function get_title() { return 'Onyx Header (Full Option)'; } // Đổi tên chút cho ngầu
        public function get_icon() { return 'eicon-code'; }
        public function get_categories() { return [ 'general' ]; }

        protected function register_controls() {
            $this->start_controls_section('section_content', ['label' => 'Cấu hình Header']);

            // 1. Control Logo
            $this->add_control('custom_logo', [
                'label' => 'Logo',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'description' => 'Để trống sẽ tự lấy Logo mặc định của web.',
            ]);

            // 2. Control Menu (MỚI THÊM)
            // Lấy danh sách tất cả Menu đang có trong website
            $menus = wp_get_nav_menus();
            $menu_options = [ '' => 'Mặc định (Primary Menu)' ]; // Tùy chọn mặc định
            foreach ( $menus as $menu ) {
                $menu_options[ $menu->slug ] = $menu->name;
            }

            $this->add_control('selected_menu', [
                'label' => 'Chọn Menu hiển thị',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => '',
                'description' => 'Chọn bộ menu bạn muốn hiển thị ở giữa.',
            ]);

            $this->add_control('hr_1', ['type' => \Elementor\Controls_Manager::DIVIDER]);

            // 3. Control Button
            $this->add_control('contact_text', [
                'label' => 'Chữ nút Contact',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Contact Us',
            ]);

            $this->add_control('contact_icon', [
                'label' => 'Icon nút Contact',
                'type' => \Elementor\Controls_Manager::ICONS,
            ]);
            
             // 4. Link Button (Nên thêm cái này để đổi link nút Contact nếu cần)
            $this->add_control('contact_link', [
                'label' => 'Link nút Contact',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'default' => [
                    'url' => home_url('/contact-us/'),
                ],
            ]);

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            
            // Chuẩn bị tham số cho Menu
            $menu_args = [
                'container'      => false,
                'menu_class'     => 'menu-list',
                'fallback_cb'    => false,
            ];

            // LOGIC MENU MỚI:
            // Nếu người dùng chọn 1 menu cụ thể -> Lấy theo menu đó
            // Nếu không chọn -> Lấy theo vị trí 'primary' như cũ
            if ( ! empty( $settings['selected_menu'] ) ) {
                $menu_args['menu'] = $settings['selected_menu'];
            } else {
                $menu_args['theme_location'] = 'primary';
            }
            ?>

            <header id="site-header" class="site-header">
              <div class="header-container">

                <button id="mobile-menu-trigger" class="mobile-toggle">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                  </svg>
                </button>

                <div class="site-logo">
                  <a href="<?php echo home_url(); ?>">
                    <?php
                    // Logic Logo
                    if ( ! empty( $settings['custom_logo']['url'] ) ) {
                        echo '<img src="' . esc_url( $settings['custom_logo']['url'] ) . '" alt="' . get_bloginfo('name') . '">';
                    } else {
                        // Fallback
                        if (has_custom_logo()) {
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/onyx-logo.webp" alt="Onyx Default Logo">';
                        }
                    }
                    ?>
                  </a>
                </div>

                <nav class="desktop-navigation">
                  <?php 
                  // Gọi menu với tham số động đã xử lý ở trên
                  wp_nav_menu($menu_args); 
                  ?>
                </nav>

                <div class="header-cta">
                  <?php 
                  $target = $settings['contact_link']['is_external'] ? ' target="_blank"' : '';
                  $nofollow = $settings['contact_link']['nofollow'] ? ' rel="nofollow"' : '';
                  ?>
                  <a href="<?php echo esc_url($settings['contact_link']['url']); ?>" class="btn-contact" <?php echo $target . $nofollow; ?>>
                    <span class="icon-box">
                      <?php 
                      if ( ! empty( $settings['contact_icon']['value'] ) ) {
                          \Elementor\Icons_Manager::render_icon( $settings['contact_icon'], [ 'aria-hidden' => 'true' ] );
                      } else {
                          ?>
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                          <?php
                      }
                      ?>
                    </span>
                    <span class="btn-text"><?php echo esc_html( $settings['contact_text'] ); ?></span>
                  </a>
                </div>

              </div>
            </header>

            <div class="mobile-menu-overlay" id="mobileMenu">
              <div class="mobile-menu-header">
                <button class="btn-close-menu" id="closeMenuBtn">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <div class="mobile-logo">
                    <?php
                    if ( ! empty( $settings['custom_logo']['url'] ) ) {
                        echo '<img src="' . esc_url( $settings['custom_logo']['url'] ) . '" alt="Logo">';
                    } else {
                        if (has_custom_logo()) {
                            $logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
                            echo '<img src="' . esc_url($logo[0]) . '" alt="Logo">';
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/onyx-logo.webp" alt="Default">';
                        }
                    }
                    ?>
                </div>
              </div>
              <?php
              // Mobile menu cũng dùng chung logic chọn menu
              $mobile_args = $menu_args;
              $mobile_args['menu_class'] = 'mobile-nav-list';
              wp_nav_menu($mobile_args);
              ?>
            </div>
            <?php
        }
    }
}
?>