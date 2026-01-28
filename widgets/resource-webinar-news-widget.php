<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_Webinar_News_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_webinar_news'; }
    public function get_title() { return 'Onyx: Webinars & News'; }
    public function get_icon() { return 'eicon-post-list'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {

        // --- SECTION TITLE ---
        $this->start_controls_section('sec_header', ['label' => 'Tiêu đề Section', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        
        $this->add_control('sec_title', [
            'label' => 'Tiêu đề lớn', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Webinars & News'
        ]);

        $this->end_controls_section();

        // --- LIST ITEMS (REPEATER) ---
        $this->start_controls_section('sec_list', ['label' => 'Danh sách Tin/Webinar', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('tag_text', [ 
            'label' => 'Tag (Góc trái)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Upcoming' 
        ]);

        $repeater->add_control('title', [ 
            'label' => 'Tiêu đề', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Future of AI in Education' 
        ]);

        $repeater->add_control('time', [ 
            'label' => 'Thời gian', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'March 15, 2024 at 2:00 PM EST' 
        ]);

        $repeater->add_control('speaker', [ 
            'label' => 'Diễn giả', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Speaker: Dr. Sarah Chen' 
        ]);

        $repeater->add_control('btn_text', [ 
            'label' => 'Chữ nút', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Register Now' 
        ]);

        $repeater->add_control('btn_style', [
            'label' => 'Kiểu nút',
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => 'Mặc định (Đen)',
                'dark' => 'Xám đậm (Dùng cho Recorded)',
            ],
        ]);

        $repeater->add_control('link', [ 
            'label' => 'Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#'] 
        ]);

        $this->add_control('items_list', [
            'label' => 'Các thẻ tin tức',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'tag_text' => 'Upcoming', 
                    'title' => 'Future of AI in Education', 
                    'time' => 'March 15, 2024 at 2:00 PM EST',
                    'speaker' => 'Speaker: Dr. Sarah Chen',
                    'btn_text' => 'Register Now',
                    'btn_style' => ''
                ],
                [
                    'tag_text' => 'Recorded', 
                    'title' => 'Smart Camera Implementation', 
                    'time' => 'February 28, 2024 at 3:00 PM EST',
                    'speaker' => 'Speaker: Michael Rodriguez',
                    'btn_text' => 'Watch Recording',
                    'btn_style' => 'dark'
                ],
                [
                    'tag_text' => 'Recorded', 
                    'title' => 'STEM Curriculum Innovation', 
                    'time' => 'February 14, 2024 at 1:00 PM EST',
                    'speaker' => 'Speaker: Dr. Emily Wong',
                    'btn_text' => 'Watch Recording',
                    'btn_style' => 'dark'
                ],
            ],
            'title_field' => '{{{ title }}}',
        ]);

        $this->end_controls_section();

        // --- FOOTER BUTTON ---
        $this->start_controls_section('sec_footer', ['label' => 'Nút Xem thêm (Cuối)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        
        $this->add_control('footer_btn_text', [ 
            'label' => 'Chữ nút', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Read more' 
        ]);
        
        $this->add_control('footer_btn_link', [ 
            'label' => 'Link nút', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#'] 
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <section class="res-webinar-section">
            <div class="container">
                
                <h2 class="section-title-center light-text"><?php echo esc_html($settings['sec_title']); ?></h2>

                <div class="webinar-grid">
                    <?php if ( $settings['items_list'] ) : foreach ( $settings['items_list'] as $item ) : ?>
                        <div class="webinar-card">
                            <span class="webinar-tag"><?php echo esc_html($item['tag_text']); ?></span>
                            <h3 class="webinar-title"><?php echo esc_html($item['title']); ?></h3>
                            
                            <div class="webinar-meta">
                                <p><?php echo esc_html($item['time']); ?></p>
                                <p><?php echo esc_html($item['speaker']); ?></p>
                            </div>
                            
                            <a href="<?php echo esc_url($item['link']['url']); ?>" class="btn-webinar <?php echo esc_attr($item['btn_style']); ?>">
                                <?php echo esc_html($item['btn_text']); ?>
                            </a>
                        </div>
                    <?php endforeach; endif; ?>
                </div>

                <?php if(!empty($settings['footer_btn_text'])): ?>
                <div class="webinar-read-more-wrap">
                    <a href="<?php echo esc_url($settings['footer_btn_link']['url']); ?>" class="btn-read-more-white">
                        <?php echo esc_html($settings['footer_btn_text']); ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}