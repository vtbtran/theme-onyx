<?php
if ( ! class_exists( 'Onyx_Footer_Widget' ) ) {

    class Onyx_Footer_Widget extends \Elementor\Widget_Base {

        public function get_name() { return 'onyx_footer_widget'; }
        public function get_title() { return 'Onyx Footer Custom'; }
        public function get_icon() { return 'eicon-footer'; }
        public function get_categories() { return [ 'general' ]; }

        protected function register_controls() {
            // --- TAB NỘI DUNG ---
            $this->start_controls_section('section_content', ['label' => 'Nội dung Footer']);

            // 1. Copyright Text
            $this->add_control('copyright_text', [
                'label' => 'Dòng bản quyền',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'ONYX. All rights reserved',
                'description' => 'Năm hiện tại ('.date('Y').') sẽ tự động hiển thị phía trước.',
            ]);

            $this->add_control('hr_1', ['type' => \Elementor\Controls_Manager::DIVIDER]);

            // 2. Chọn Menu
            $menus = wp_get_nav_menus();
            $menu_options = [ '' => 'Mặc định (Footer Location)' ];
            foreach ( $menus as $menu ) {
                $menu_options[ $menu->slug ] = $menu->name;
            }

            $this->add_control('selected_menu', [
                'label' => 'Chọn Menu hiển thị',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => '',
            ]);

            $this->end_controls_section();

            // --- TAB MẠNG XÃ HỘI (REPEATER) ---
            $this->start_controls_section('section_socials', ['label' => 'Mạng xã hội']);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control('social_name', [
                'label' => 'Tên (để SEO)',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Social Network',
            ]);

            $repeater->add_control('social_icon', [
                'label' => 'Icon',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-facebook',
                    'library' => 'fa-brands',
                ],
            ]);

            $repeater->add_control('social_link', [
                'label' => 'Link',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://...',
                'default' => [ 'url' => '#' ],
            ]);

            $this->add_control('social_list', [
                'label' => 'Danh sách Social',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_name' => 'X (Twitter)',
                        'social_icon' => ['value' => 'fab fa-x-twitter', 'library' => 'fa-brands'],
                        'social_link' => ['url' => '#'],
                    ],
                    [
                        'social_name' => 'Facebook',
                        'social_icon' => ['value' => 'fab fa-facebook', 'library' => 'fa-brands'],
                        'social_link' => ['url' => '#'],
                    ],
                    [
                        'social_name' => 'Instagram',
                        'social_icon' => ['value' => 'fab fa-instagram', 'library' => 'fa-brands'],
                        'social_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ social_name }}}',
            ]);

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            ?>

            <footer class="site-footer">
                <div class="footer-container">
                    
                    <div class="footer-copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html($settings['copyright_text']); ?></p>
                    </div>

                    <div class="footer-socials">
                        <?php foreach ( $settings['social_list'] as $item ) : ?>
                            <?php 
                            $target = $item['social_link']['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $item['social_link']['nofollow'] ? ' rel="nofollow"' : '';
                            ?>
                            <a href="<?php echo esc_url($item['social_link']['url']); ?>" class="social-link" aria-label="<?php echo esc_attr($item['social_name']); ?>"<?php echo $target . $nofollow; ?>>
                                <?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="footer-links">
                        <?php
                        $menu_args = [
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                            'fallback_cb'    => false, // Không hiện menu rác nếu không tìm thấy
                        ];

                        if ( ! empty( $settings['selected_menu'] ) ) {
                            $menu_args['menu'] = $settings['selected_menu'];
                            wp_nav_menu($menu_args);
                        } else {
                            if ( has_nav_menu('footer') ) {
                                $menu_args['theme_location'] = 'footer';
                                wp_nav_menu($menu_args);
                            } else {
                                // Fallback giống thiết kế cũ nếu chưa chọn menu
                                echo '<ul class="footer-menu">';
                                echo '<li><a href="#">FAQ</a></li>';
                                echo '<li><a href="#">Privacy policy</a></li>';
                                echo '<li><a href="#">Terms & Conditions</a></li>';
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>

                </div>
            </footer>
            <?php
        }
    }
}
?>