<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_Service_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_service_grid'; }
    public function get_title() { return 'Onyx: Service Grid'; }
    public function get_icon() { return 'eicon-gallery-grid'; }
    public function get_categories() { return [ 'general' ]; }

protected function _register_controls() {

        // --- HEADER SECTION ---
        $this->start_controls_section('section_header', ['label' => 'Header Section', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('sec_title', [
            'label' => 'Section Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our Service'
        ]);
        $this->end_controls_section();

        // --- SERVICES LIST (REPEATER) ---
        $this->start_controls_section('section_services', ['label' => 'Services List', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control('img', [
            'label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]
        ]);
        $repeater->add_control('tag', [
            'label' => 'Tag (e.g., Technology)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Technology'
        ]);
        $repeater->add_control('tag_color_class', [
            'label' => 'Tag Color Class (e.g., tag-yellow)', 
            'type' => \Elementor\Controls_Manager::TEXT, 
            'description' => 'Leave empty or enter "tag-yellow" for yellow color scheme.', 
            'default' => ''
        ]);
        $repeater->add_control('title', [
            'label' => 'Service Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'AI Camera Integration'
        ]);
        $repeater->add_control('desc', [
            'label' => 'Short Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Complete AI camera system setup...'
        ]);
        $repeater->add_control('features', [
            'label' => 'Features List (One per line)', 
            'type' => \Elementor\Controls_Manager::WYSIWYG, 
            'default' => '<ul><li>Custom Installation</li><li>System Configuration</li></ul>'
        ]);
        $repeater->add_control('price', [
            'label' => 'Price (e.g., Starting at $2,999)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Starting at $2,999'
        ]);
        $repeater->add_control('duration', [
            'label' => 'Duration (e.g., 2-4 weeks)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '2-4 weeks'
        ]);
        $repeater->add_control('link', [
            'label' => 'Learn More Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']
        ]);

        $this->add_control('services_list', [
            'label' => 'Service Cards',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['title' => 'AI Camera Integration', 'tag' => 'Technology'],
                ['title' => 'STEM Education Kit', 'tag' => 'Education', 'tag_color_class' => 'tag-yellow'],
                ['title' => 'Smart Home Security', 'tag' => 'Consulting'],
            ],
            'title_field' => '{{{ title }}}',
        ]);
        $this->end_controls_section();

        // --- BOTTOM BUTTON ---
        $this->start_controls_section('section_footer_btn', ['label' => 'Bottom Button', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('btn_text', [
            'label' => 'Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View Product'
        ]);
        $this->add_control('btn_link', [
            'label' => 'Button Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '/products']
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="service-section">
            <div class="container">

                <div class="section-header">
                    <h1 class="section-title"><?php echo esc_html($settings['sec_title']); ?></h1>
                </div>

                <div class="service-grid">
                    <?php if ( $settings['services_list'] ) : foreach ( $settings['services_list'] as $item ) : ?>
                    <div class="service-card">
                        <div class="card-image-box">
                            <?php if(!empty($item['img']['url'])): ?>
                                <img src="<?php echo esc_url($item['img']['url']); ?>" alt="Service">
                            <?php endif; ?>
                            <span class="card-tag <?php echo esc_attr($item['tag_color_class']); ?>"><?php echo esc_html($item['tag']); ?></span>
                        </div>

                        <div class="card-content">
                            <h3 class="card-title"><?php echo esc_html($item['title']); ?></h3>
                            <p class="card-desc"><?php echo esc_html($item['desc']); ?></p>
                            
                            <div class="card-features-wrapper">
                                <?php echo $item['features']; ?> 
                                </div>

                            <div class="card-footer">
                                <div class="price-info">
                                    <span class="price"><?php echo esc_html($item['price']); ?></span>
                                    <span class="duration"><?php echo esc_html($item['duration']); ?></span>
                                </div>
                                <a href="<?php echo esc_url($item['link']['url']); ?>" class="btn-learn-more">
                                    <span class="icon-box-sm">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 7 17 17 7 17"></polyline>
                                        </svg>
                                    </span>
                                    Learn more
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>

                <?php if(!empty($settings['btn_text'])): ?>
                <div class="bottom-action-left">
                    <div class="bottom-action-left"> <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn-view-product">
                            <span class="icon-box-lg">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                    <polyline points="17 7 17 17 7 17"></polyline>
                                </svg>
                            </span>
                            <?php echo esc_html($settings['btn_text']); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}