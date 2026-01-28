<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_Contact_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_contact_grid'; }
    public function get_title() { return 'Onyx: Contact Info Grid'; }
    public function get_icon() { return 'eicon-columns'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {

        // --- CỘT TRÁI: MAP & FORM ---
        $this->start_controls_section('sec_left', ['label' => 'Cột Trái (Map & Form)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        
        $this->add_control('map_iframe', [
            'label' => 'Link Iframe Bản đồ',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => '<iframe src="https://www.google.com/maps/..." ...></iframe>',
            'description' => 'Dán mã nhúng iframe Google Maps vào đây.',
        ]);

        $this->add_control('form_title', [
            'label' => 'Tiêu đề Form', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Send us a Message'
        ]);

        $this->add_control('cf7_shortcode', [
            'label' => 'Shortcode Contact Form 7',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '[contact-form-7 id="ee1e918" title="Form contact"]',
        ]);

        $this->end_controls_section();

        // --- CỘT PHẢI: INFO CARDS ---
        $this->start_controls_section('sec_right', ['label' => 'Cột Phải (Thông tin)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('card_title', [ 'label' => 'Tiêu đề (VD: Sales Team)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Sales Team' ]);
        $repeater->add_control('card_desc', [ 'label' => 'Mô tả', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Ready to help you find the perfect solution' ]);
        $repeater->add_control('card_detail', [ 
            'label' => 'Chi tiết (Email, Phone)', 
            'type' => \Elementor\Controls_Manager::WYSIWYG, 
            'default' => '<p>Email: sales@onyx.com</p><p>Phone: +1 (555) 123-4568</p>' 
        ]);

        $this->add_control('info_cards', [
            'label' => 'Danh sách thẻ thông tin',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['card_title' => 'General Inquiries', 'card_desc' => 'For general questions...', 'card_detail' => '<p>Email: info@onyx.com</p>'],
                ['card_title' => 'Sales Team', 'card_desc' => 'Ready to help...', 'card_detail' => '<p>Email: sales@onyx.com</p>'],
            ],
            'title_field' => '{{{ card_title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="contact-main" style="padding-top: 0;"> <div class="container">
                <div class="contact-grid">

                    <div class="col-left">
                        <div class="map-wrapper">
                            <?php echo $settings['map_iframe']; ?>
                        </div>
                        <div class="contact-form-box" id="ket-qua-form">
                            <h3><?php echo esc_html($settings['form_title']); ?></h3>
                            <?php echo do_shortcode($settings['cf7_shortcode']); ?>
                        </div>
                    </div>

                    <div class="col-right">
                        <?php if ( $settings['info_cards'] ) : foreach ( $settings['info_cards'] as $card ) : ?>
                        <div class="info-card">
                            <h4><?php echo esc_html($card['card_title']); ?></h4>
                            <p class="info-desc"><?php echo esc_html($card['card_desc']); ?></p>
                            <div class="info-detail">
                                <?php echo $card['card_detail']; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>

                </div>
            </div>
        </section>
        <?php
    }
}