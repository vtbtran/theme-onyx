<?php
if (! defined('ABSPATH')) exit;

class Home_Hero_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'home_hero_widget';
    }
    public function get_title()
    {
        return 'Home Hero Section';
    }
    public function get_icon()
    {
        return 'eicon-slides';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // --- LEFT CONTENT ---
        $this->start_controls_section('content_left_section', ['label' => 'Left Content', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('hero_main_title', [
            'label' => 'Main Title',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Innovating <br> Tomorrow, Today',
            'description' => 'Use <br> tag for line break.'
        ]);

        $this->add_control('hero_bottom_title', [
            'label' => 'Sub Title (Yellow)',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Technology & <br> Education Solutions'
        ]);

        $this->add_control('hero_bottom_desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'ONYX delivers cutting-edge solutions that transform industries and empower communities.'
        ]);

        $this->end_controls_section();

        // --- SLIDER ---
        $this->start_controls_section('slider_section', ['label' => 'Slides', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('slide_image', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $repeater->add_control('slide_title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Empowering Through Education']);
        $repeater->add_control('slide_cat', ['label' => 'Category', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Learning & Development']);
        $repeater->add_control('slide_desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'We create engaging educational experiences...']);
        $repeater->add_control('slide_btn_text', ['label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'About Us']);
        $repeater->add_control('slide_link', ['label' => 'Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->add_control('slides', [
            'label' => 'Slides List',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ slide_title }}}',
            // Default data
            'default' => [
                [
                    'slide_title' => 'Empowering Through Education',
                    'slide_cat' => 'Learning & Development',
                    'slide_btn_text' => 'About Us'
                ],
                [
                    'slide_title' => 'Join Our Growing Community',
                    'slide_cat' => 'Resources & Support',
                    'slide_btn_text' => 'View our Resources'
                ]
            ]
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Chuẩn bị dữ liệu để tránh lỗi
        $main_title = $settings['hero_main_title'];
        $bot_title  = $settings['hero_bottom_title'];
        $bot_desc   = $settings['hero_bottom_desc'];
?>

        <div class="home-hero-section">
            <div class="container hero-container">

                <div class="hero-text-wrapper">
                    <h1 class="hero-title"><?php echo $main_title; ?></h1>

                    <div class="hero-bottom-info">
                        <div class="hero-highlight">
                            <span class="highlight-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </span>
                            <h2 class="highlight-text"><?php echo $bot_title; ?></h2>
                        </div>
                        <p class="hero-desc"><?php echo $bot_desc; ?></p>
                    </div>
                </div>

                <div class="hero-slider-structure">

                    <button class="hero-nav-btn prev" id="heroPrevBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <div class="hero-viewport">
                        <div class="hero-track">
                            <?php if ($settings['slides']) : foreach ($settings['slides'] as $slide) :
                                    $img_url = !empty($slide['slide_image']['url']) ? $slide['slide_image']['url'] : get_template_directory_uri() . '/assets/images/banner.png';
                            ?>
                                    <div class="hero-card">
                                        <div class="card-img">
                                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($slide['slide_title']); ?>">
                                        </div>
                                        <div class="card-content">
                                            <h3 class="card-title"><?php echo $slide['slide_title']; ?></h3>
                                            <p class="card-category"><?php echo $slide['slide_cat']; ?></p>
                                            <p class="card-desc"><?php echo $slide['slide_desc']; ?></p>

                                            <?php $link = !empty($slide['slide_link']['url']) ? $slide['slide_link']['url'] : '#'; ?>
                                            <a href="<?php echo esc_url($link); ?>" class="btn-card-action">
                                                <span class="btn-icon">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <line x1="7" y1="17" x2="17" y2="7"></line>
                                                        <polyline points="7 7 17 7 17 17"></polyline>
                                                    </svg>
                                                </span>
                                                <?php echo $slide['slide_btn_text']; ?>
                                            </a>
                                        </div>
                                    </div>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>

                    <button class="hero-nav-btn next" id="heroNextBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>

                </div>
            </div>
        </div>
<?php
    }
}
