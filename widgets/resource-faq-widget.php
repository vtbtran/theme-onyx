<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_FAQ_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_faq'; }
    public function get_title() { return 'Onyx: FAQ List'; }
    public function get_icon() { return 'eicon-help-o'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {

        // --- SECTION HEADER ---
        $this->start_controls_section('sec_header', ['label' => 'Tiêu đề', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        
        $this->add_control('title', [
            'label' => 'Tiêu đề Section', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Frequently Asked Questions'
        ]);

        $this->end_controls_section();

        // --- FAQ ITEMS ---
        $this->start_controls_section('sec_items', ['label' => 'Danh sách Câu hỏi', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('question', [
            'label' => 'Câu hỏi', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'How do i access premium resources?'
        ]);

        $repeater->add_control('answer', [
            'label' => 'Câu trả lời', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Premium resources are available to customers with active support contracts...'
        ]);

        $this->add_control('faq_list', [
            'label' => 'Các câu hỏi',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'question' => 'How do i access premium resources?',
                    'answer' => 'Premium resources are available to customers with active support contracts. Contact our sales team to upgrade your access level.'
                ],
                [
                    'question' => 'Are the resources regularly updated?',
                    'answer' => 'Yes, we update our resources quarterly and add new content based on customer feedback and product updates.'
                ],
                [
                    'question' => 'Can i request specific resources?',
                    'answer' => 'We welcome resource requests from our community. Please contact our support team with your specific needs.'
                ],
            ],
            'title_field' => '{{{ question }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="res-faq-section">
            <div class="container">
                
                <h2 class="section-title-center"><?php echo esc_html($settings['title']); ?></h2>

                <div class="faq-list">
                    <?php if ( $settings['faq_list'] ) : foreach ( $settings['faq_list'] as $item ) : ?>
                        
                        <div class="faq-item">
                            <h3 class="faq-question"><?php echo esc_html($item['question']); ?></h3>
                            <p class="faq-answer"><?php echo esc_html($item['answer']); ?></p>
                            
                            <span class="faq-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </span>
                        </div>

                    <?php endforeach; endif; ?>
                </div>

            </div>
        </section>
        <?php
    }
}