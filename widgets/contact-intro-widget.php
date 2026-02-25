<?php
if (! defined('ABSPATH')) exit;

class Onyx_Contact_Intro_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_contact_intro';
    }
    public function get_title()
    {
        return 'Onyx: Contact Intro';
    }
    public function get_icon()
    {
        return 'eicon-text-area';
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
            'default' => 'Why Choose ONYX Team?',
        ]);

        $this->add_control('description', [
            'label' => 'Description (Use Bold for emphasis)',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => '<span class="text-bold">We bridge the gap...</span> Our solutions are designed for high performance.',
        ]);

        // Default is yellow circle SVG as per design
        $this->add_control('icon_svg', [
            'label' => 'SVG Icon (Code)',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#FAFF00" /><path d="M12 28L28 12M28 12H16M28 12V24" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" /></svg>',
            'description' => 'Enter SVG code here.',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="contact-intro-section">
            <div class="container">
                <h2 class="intro-title"><?php echo esc_html($settings['title']); ?></h2>
                <div class="intro-desc">
                    <?php echo $settings['description']; ?>
                </div>
                <div class="intro-icon">
                    <?php echo $settings['icon_svg']; ?>
                </div>
            </div>
        </section>
<?php
    }
}
