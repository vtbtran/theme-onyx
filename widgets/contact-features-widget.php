<?php
if (! defined('ABSPATH')) exit;

class Onyx_Contact_Features_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_contact_features';
    }
    public function get_title()
    {
        return 'Onyx: Contact Features Bar';
    }
    public function get_icon()
    {
        return 'eicon-icon-box';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('content_section', ['label' => 'Features List', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('icon', [
            'label' => 'Icon (SVG or Upload)',
            'type' => \Elementor\Controls_Manager::MEDIA, // Use Media to upload image/svg
            'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
        ]);

        $repeater->add_control('text', [
            'label' => 'Content',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'AI-Powered Insight & Security',
        ]);

        $this->add_control('features_list', [
            'label' => 'Features',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['text' => 'AI-Powered Insight & Security'],
                ['text' => 'Integrated STEM-to-Career Path'],
                ['text' => 'Continuous Innovation & R&D Focus'],
            ],
            'title_field' => '{{{ text }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="features-bar">
            <div class="container features-grid">
                <?php if ($settings['features_list']) : foreach ($settings['features_list'] as $item) : ?>
                        <div class="feature-item">
                            <span class="feat-icon">
                                <?php
                                // Kiểm tra xem là file ảnh hay SVG
                                if (!empty($item['icon']['url'])) {
                                    echo '<img src="' . esc_url($item['icon']['url']) . '" alt="icon">';
                                }
                                ?>
                            </span>
                            <span><?php echo esc_html($item['text']); ?></span>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
        </section>
<?php
    }
}
