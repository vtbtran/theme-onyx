<?php
if (! defined('ABSPATH')) exit;

class Onyx_More_Questions_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_contact_section';
    }
    public function get_title()
    {
        return 'Onyx: More Question Section';
    }
    public function get_icon()
    {
        return 'eicon-mail';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section('content_section', ['label' => 'Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'More questions? Send them to us',
            'label_block' => true,
        ]);

        $this->add_control('cf7_shortcode', [
            'label' => 'Contact Form 7 Shortcode',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => '[contact-form-7 id="0ae09d0" title="Form question"]',
            'description' => 'Copy the shortcode from Contact -> Contact Forms and paste it here.',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="res-contact-section">
            <div class="container">
                <h2 class="contact-title"><?php echo esc_html($settings['title']); ?></h2>

                <div class="res-contact-form-wrapper">
                    <?php echo do_shortcode($settings['cf7_shortcode']); ?>
                </div>
            </div>
        </section>
<?php
    }
}
