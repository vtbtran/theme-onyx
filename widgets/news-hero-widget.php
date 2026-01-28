<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_News_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_news_hero'; }
    public function get_title() { return 'Onyx: News Hero'; }
    public function get_icon() { return 'eicon-post-list'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {
        $this->start_controls_section('content_section', ['label' => 'Nội dung', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('sec_title', [
            'label' => 'Tiêu đề Section', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Latest News'
        ]);

        $this->add_control('post_title', [
            'label' => 'Tiêu đề Bài viết', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ONYX Launches Revolutionary AI Camera System...'
        ]);

        $this->add_control('post_date', [
            'label' => 'Ngày & Thời gian đọc', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'March 10, 2024 • 5 min read'
        ]);

        $this->add_control('post_desc', [
            'label' => 'Mô tả ngắn', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Our latest AI-powered camera system brings advanced security...'
        ]);

        $this->add_control('post_img', [
            'label' => 'Ảnh đại diện',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
        ]);

        // --- PHẦN NÚT BẤM ---
        $this->add_control('btn_text', [
            'label' => 'Chữ trên Nút',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Read Full Article',
            'separator' => 'before',
        ]);

        $this->add_control('post_link', [
            'label' => 'Link bài viết',
            'type' => \Elementor\Controls_Manager::URL,
            'default' => ['url' => '#'],
            'placeholder' => 'https://your-link.com',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // 1. Tạo bộ thuộc tính Link chung (chỉ chứa href, target...)
        // Lỗi cũ: Mình đã add class 'btn-dark-icon' vào đây nên nó dính cả vào tiêu đề.
        // Sửa lại: Chỉ lấy thuộc tính link thuần túy.
        $this->add_link_attributes( 'article_link', $settings['post_link'] );
        
        // 2. Kiểm tra tag cho nút (nếu có link thì dùng a, không thì div)
        $btn_tag = ! empty( $settings['post_link']['url'] ) ? 'a' : 'div';

        ?>
        <section class="news-header-section">
            <div class="container">
                <h1 class="header-title"><?php echo esc_html($settings['sec_title']); ?></h1>

                <div class="latest-news-card">
                    <div class="latest-img">
                        <?php if(!empty($settings['post_img']['url'])): ?>
                            <img src="<?php echo esc_url($settings['post_img']['url']); ?>" alt="Hero News">
                        <?php endif; ?>
                    </div>
                    <div class="latest-content">
                        <div class="meta-info">
                            <?php echo esc_html($settings['post_date']); ?>
                        </div>
                        
                        <h2 class="latest-title">
                            <a <?php echo $this->get_render_attribute_string( 'article_link' ); ?>>
                                <?php echo esc_html($settings['post_title']); ?>
                            </a>
                        </h2>

                        <div class="latest-excerpt">
                            <?php echo esc_html($settings['post_desc']); ?>
                        </div>

                        <?php if ( ! empty( $settings['btn_text'] ) ) : ?>
                            <<?php echo $btn_tag; ?> class="btn-dark-icon" <?php echo $this->get_render_attribute_string( 'article_link' ); ?>>
                                <span class="icon-box">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="17" x2="17" y2="7"></line>
                                        <polyline points="7 7 17 7 17 17"></polyline>
                                    </svg>
                                </span>
                                <?php echo esc_html($settings['btn_text']); ?>
                            </<?php echo $btn_tag; ?>>
                        <?php endif; ?>
                        
                    </div>
                </div>

            </div>
        </section>
        <?php
    }
}