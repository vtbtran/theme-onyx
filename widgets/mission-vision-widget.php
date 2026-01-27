    <?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_Mission_Vision_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_mission_vision'; }
    public function get_title() { return 'Onyx: Mission & Vision'; }
    public function get_icon() { return 'eicon-banner'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {

        // --- TAB 1: DANH SÁCH THẺ (REPEATER) ---
        $this->start_controls_section('section_cards', ['label' => 'Các thẻ (Mission/Vision)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('card_icon', [
            'label' => 'Icon Ngôi sao (Ảnh)', 
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]
        ]);

        $repeater->add_control('card_title', [
            'label' => 'Tiêu đề', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our Mission'
        ]);

        $repeater->add_control('card_desc', [
            'label' => 'Mô tả', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'To democratize access...'
        ]);

        $this->add_control('cards_list', [
            'label' => 'Danh sách thẻ',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'card_title' => 'Our Mission', 
                    'card_desc' => 'To democratize access to advanced technology and quality education, empowering individuals and organizations to achieve their full potential through innovative AI solutions and comprehensive STEM learning programs.'
                ],
                [
                    'card_title' => 'Our Vision', 
                    'card_desc' => 'To be the global leader in AI-powered educational technology, creating a world where advanced technology is accessible to all, and every learner has the tools they need to succeed in the digital age.'
                ],
            ],
            'title_field' => '{{{ card_title }}}',
        ]);

        $this->end_controls_section();

        // --- TAB 2: NÚT BẤM DƯỚI CÙNG ---
        $this->start_controls_section('section_button', ['label' => 'Nút bấm (Core Values)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('btn_text', [
            'label' => 'Chữ trên nút', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our Core Values'
        ]);

        $this->add_control('btn_link', [
            'label' => 'Link nút', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="mission-vision-section">
            <div class="container mission-container">

                <div class="mission-grid">
                    <?php if ( $settings['cards_list'] ) : foreach ( $settings['cards_list'] as $item ) : ?>
                        
                        <div class="mv-card animate-on-scroll delay-100">
                            <div class="mv-icon-top">
                                <?php if ( ! empty( $item['card_icon']['url'] ) ) : ?>
                                    <img src="<?php echo esc_url($item['card_icon']['url']); ?>" alt="Icon" class="star-icon">
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="mv-title"><?php echo esc_html($item['card_title']); ?></h3>
                            
                            <p class="mv-desc"><?php echo esc_html($item['card_desc']); ?></p>
                            
                            <div class="mv-icon-bottom">
                                <?php if ( ! empty( $item['card_icon']['url'] ) ) : ?>
                                    <img src="<?php echo esc_url($item['card_icon']['url']); ?>" alt="Icon" class="star-icon">
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; endif; ?>
                </div>

                <?php if ( ! empty( $settings['btn_text'] ) ) : ?>
                <div class="mv-action-wrapper animate-on-scroll delay-400">
                    <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn-core-values">
                        <span class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                        <?php echo esc_html($settings['btn_text']); ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}