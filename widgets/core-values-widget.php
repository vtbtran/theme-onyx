<?php
if (! defined('ABSPATH')) exit;

class Onyx_Core_Values_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_core_values';
    }
    public function get_title()
    {
        return 'Onyx: Core Values';
    }
    public function get_icon()
    {
        return 'eicon-diamond';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section('content_section', ['label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        // 1. Main Heading
        $this->add_control('heading', [
            'label' => 'Main Heading',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Our Core Values'
        ]);

        // 2. Values List (Repeater)
        $repeater = new \Elementor\Repeater();

        // Icon Control (SVG)
        $repeater->add_control('val_icon', [
            'label' => 'Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'fa-solid',
            ]
        ]);

        $repeater->add_control('val_title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Innovation'
        ]);

        $repeater->add_control('val_desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'We constantly push the boundaries of technology...'
        ]);

        $this->add_control('values_list', [
            'label' => 'Values List',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'val_title' => 'Innovation',
                    'val_desc' => 'We constantly push the boundaries of technology to create solutions that make a real difference.',
                    'val_icon' => ['value' => 'fas fa-lightbulb', 'library' => 'fa-solid']
                ],
                [
                    'val_title' => 'Education',
                    'val_desc' => 'We believe in empowering the next generation through accessible, engaging STEM education.',
                    'val_icon' => ['value' => 'fas fa-book', 'library' => 'fa-solid']
                ],
                [
                    'val_title' => 'Quality',
                    'val_desc' => 'Every product we create meets the highest standards of reliability and performance.',
                    'val_icon' => ['value' => 'fas fa-star', 'library' => 'fa-solid']
                ],
                [
                    'val_title' => 'Community',
                    'val_desc' => 'We build lasting relationships with our customers, partners, and the communities we serve.',
                    'val_icon' => ['value' => 'fas fa-users', 'library' => 'fa-solid']
                ],
            ],
            'title_field' => '{{{ val_title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="core-values-section">
            <div class="container values-container">

                <h2 class="values-heading"><?php echo esc_html($settings['heading']); ?></h2>

                <div class="values-grid">
                    <?php if ($settings['values_list']) : foreach ($settings['values_list'] as $item) : ?>

                            <div class="value-card animate-on-scroll delay-100">
                                <div class="value-icon">
                                    <?php \Elementor\Icons_Manager::render_icon($item['val_icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                                <h3 class="value-title"><?php echo esc_html($item['val_title']); ?></h3>
                                <p class="value-desc"><?php echo esc_html($item['val_desc']); ?></p>
                            </div>

                    <?php endforeach;
                    endif; ?>
                </div>

            </div>
        </section>
<?php
    }
}
