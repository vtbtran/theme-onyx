<?php
if (! defined('ABSPATH')) exit;

class Onyx_About_Stats_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_about_stats';
    }
    public function get_title()
    {
        return 'Onyx: About & Stats';
    }
    public function get_icon()
    {
        return 'eicon-info-box';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // --- LEFT COLUMN: CONTENT ---
        $this->start_controls_section('section_left_content', ['label' => 'Content (About)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('title', [
            'label' => 'Main Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'About Us'
        ]);

        $this->add_control('description', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => '<strong>Pioneering Mission in Technology & Education.</strong> We connect advanced AI technology with STEM education...'
        ]);

        $this->add_control('btn_text', [
            'label' => 'Button Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Meet Our Leader Team'
        ]);

        $this->add_control('btn_link', [
            'label' => 'Button Link',
            'type' => \Elementor\Controls_Manager::URL,
            'default' => ['url' => '#']
        ]);

        $this->end_controls_section();

        // --- RIGHT COLUMN: STATISTICS ---
        $this->start_controls_section('section_right_stats', ['label' => 'Statistics (Stats)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();

        // 1. Image Control
        $repeater->add_control('stat_image', [
            'label' => 'Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]);

        $repeater->add_control('stat_number', [
            'label' => 'Number',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '50K+'
        ]);

        $repeater->add_control('stat_label', [
            'label' => 'Label',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Students Educated'
        ]);

        $this->add_control('stats_list', [
            'label' => 'Stats List',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            // Update default to include placeholder image
            'default' => [
                ['stat_number' => '50K+', 'stat_label' => 'Students Educated', 'stat_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ['stat_number' => '200+', 'stat_label' => 'Schools Partnered', 'stat_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ['stat_number' => '15+', 'stat_label' => 'Countries Served', 'stat_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ['stat_number' => '98%', 'stat_label' => 'Customer Satisfaction', 'stat_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
            ],
            'title_field' => '{{{ stat_label }}}',
        ]);

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="about-us-section">
            <div class="container about-container">

                <div class="about-content animate-on-scroll">
                    <h2 class="about-title"><?php echo $settings['title']; ?></h2>
                    <div class="about-desc">
                        <?php echo $settings['description']; ?>
                    </div>
                    <div class="about-decor-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                    <?php if (! empty($settings['btn_text'])) : ?>
                        <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn-about-action">
                            <span class="icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </span>
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="about-stats-grid">
                    <?php if ($settings['stats_list']) : foreach ($settings['stats_list'] as $item) : ?>

                            <div class="stat-card animate-on-scroll delay-100">
                                <div class="stat-icon-wrapper">
                                    <?php if (! empty($item['stat_image']['url'])) : ?>
                                        <img src="<?php echo esc_url($item['stat_image']['url']); ?>"
                                            alt="<?php echo esc_attr($item['stat_label']); ?>"
                                            class="stat-img-custom">
                                    <?php endif; ?>
                                </div>
                                <div class="stat-number"><?php echo esc_html($item['stat_number']); ?></div>
                                <div class="stat-label"><?php echo esc_html($item['stat_label']); ?></div>
                            </div>

                    <?php endforeach;
                    endif; ?>
                </div>

            </div>
        </section>
<?php
    }
}
