<?php
if (! defined('ABSPATH')) exit;

class Onyx_Business_Hours_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_business_hours';
    }
    public function get_title()
    {
        return 'Onyx: Business Hours';
    }
    public function get_icon()
    {
        return 'eicon-clock-o';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('content_section', ['label' => 'Business Hours', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('page_title', [
            'label' => 'Page Title (CONTACT)',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'CONTACT',
        ]);

        $this->add_control('label', [
            'label' => 'Label (BUSINESS HOURS)',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'BUSINESS HOURS',
        ]);

        $this->add_control('days', [
            'label' => 'Days',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => '<span>Monday - Saturday</span><span>Sunday</span>',
        ]);

        $this->add_control('times', [
            'label' => 'Hours',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => '<span>8:00 AM - 5:00 PM PST</span><span>Closed</span>',
        ]);

        $this->add_control('icon_img', [
            'label' => 'Right Icon (Leave empty for default icon)',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [], // Default empty to let PHP handle fallback
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // LOGIC XỬ LÝ ẢNH:
        // 1. Lấy ảnh admin upload
        $icon_url = $settings['icon_img']['url'];

        // 2. Nếu admin chưa upload (hoặc xóa đi), dùng ảnh tĩnh mặc định
        if (empty($icon_url)) {
            $icon_url = get_template_directory_uri() . '/assets/images/icon.png';
        }
?>
        <section class="contact-main" style="padding-bottom: 0;">
            <div class="container">
                <h1 class="page-title"><?php echo esc_html($settings['page_title']); ?></h1>

                <div class="business-hours-bar">
                    <div class="bh-item bh-label"><?php echo esc_html($settings['label']); ?></div>

                    <div class="bh-item bh-days">
                        <?php echo $settings['days']; ?>
                    </div>

                    <div class="bh-item bh-times">
                        <?php echo $settings['times']; ?>
                    </div>

                    <div class="bh-item bh-icon">
                        <span class="feat-icon">
                            <img src="<?php echo esc_url($icon_url); ?>" alt="Icon">
                        </span>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
