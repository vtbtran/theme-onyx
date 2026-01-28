<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_Process_List_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_process_list'; }
    public function get_title() { return 'Onyx: Process List'; }
    public function get_icon() { return 'eicon-editor-list-ul'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {
        $this->start_controls_section('content', ['label' => 'Quy trình', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('title', [ 'label' => 'Tiêu đề', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our Process' ]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('num', [ 'label' => 'Số (VD: 001)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '001' ]);
        $repeater->add_control('name', [ 'label' => 'Tên bước', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'CONSULTATION' ]);
        $repeater->add_control('desc', [ 'label' => 'Mô tả', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'We start with a detailed consultation...' ]);

        $this->add_control('process_list', [
            'label' => 'Các bước',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['num' => '001', 'name' => 'CONSULTATION', 'desc' => 'We start with a detailed consultation...'],
                ['num' => '002', 'name' => 'PLANNING', 'desc' => 'Our team develops a customized plan...'],
            ],
            'title_field' => '{{{ name }}}',
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="process-section" id="process">
            <div class="container">
                <h2 class="section-title-center dark-text"><?php echo esc_html($settings['title']); ?></h2>

                <div class="process-list">
                    <?php if ( $settings['process_list'] ) : foreach ( $settings['process_list'] as $item ) : ?>
                    <div class="process-item">
                        <div class="proc-header">
                            <span class="proc-num"><?php echo esc_html($item['num']); ?></span>
                            <h3 class="proc-name"><?php echo esc_html($item['name']); ?></h3>
                        </div>
                        <div class="proc-body">
                            <p><?php echo esc_html($item['desc']); ?></p>
                        </div>
                        <div class="proc-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}