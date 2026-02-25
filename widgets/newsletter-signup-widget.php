<?php
if (! defined('ABSPATH')) exit;

class Onyx_Newsletter_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_newsletter';
    }
    public function get_title()
    {
        return 'Onyx: Newsletter Signup';
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
            'default' => 'Get the latest news from ONYX'
        ]);

        $this->add_control('desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Subscribe to our newsletter and be the first to know...'
        ]);

        // Shortcode input removed as it is no longer needed

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="newsletter-section">
            <div class="container newsletter-container">

                <div class="newsletter-content">
                    <h2 class="nl-title"><?php echo esc_html($settings['title']); ?></h2>
                    <p class="nl-desc"><?php echo esc_html($settings['desc']); ?></p>

                    <div class="nl-icon-wrapper">
                        <span class="highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="newsletter-form-wrapper">
                    <?php
                    // GỌI TRỰC TIẾP SHORTCODE TẠI ĐÂY
                    // Lưu ý: Nếu bạn lỡ tay xóa form bên Contact Form 7 thì code này sẽ lỗi
                    echo do_shortcode('[mailpoet_form id="1"]');
                    ?>
                </div>

            </div>
        </section>
<?php
    }
}
