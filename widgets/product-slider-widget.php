<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_Product_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_product_slider'; }
    public function get_title() { return 'Onyx: Product Slider'; }
    public function get_icon() { return 'eicon-slides'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {
        $this->start_controls_section('content_section', ['label' => 'Sản phẩm', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('sec_title', [
            'label' => 'Tiêu đề', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Product'
        ]);

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control('img', [
            'label' => 'Ảnh Sản phẩm', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]
        ]);
        
        $repeater->add_control('title', [ 
            'label' => 'Tên', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'AI Smart Camera Pro' 
        ]);
        
        $repeater->add_control('desc', [ 
            'label' => 'Mô tả', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Advanced AI-powered surveillance...' 
        ]);
        
        $repeater->add_control('specs', [
            'label' => 'Thông số (<ul><li>...)', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => '<ul><li>4K Ultra HD</li><li>AI Object Detection</li></ul>'
        ]);
        
        // --- THÊM CONTROL CHỈNH CHỮ "BUY NOW" ---
        $repeater->add_control('btn_text', [ 
            'label' => 'Chữ trên nút', 
            'type' => \Elementor\Controls_Manager::TEXT, 
            'default' => 'Buy now' // Mặc định là Buy now
        ]);

        $repeater->add_control('link', [ 
            'label' => 'Link nút Buy', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#'] 
        ]);

        $this->add_control('products_list', [
            'label' => 'Danh sách Sản phẩm',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['title' => 'AI Smart Camera Pro', 'btn_text' => 'Buy now'],
                ['title' => 'STEM Education Kit', 'btn_text' => 'Buy now'],
            ],
            'title_field' => '{{{ title }}}',
        ]);
        $this->end_controls_section();

        // Footer Button
        $this->start_controls_section('footer_btn', ['label' => 'Nút Footer', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('ft_btn_text', [ 'label' => 'Chữ', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View our Process' ]);
        $this->add_control('ft_btn_link', [ 'label' => 'Link (#process)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '#process' ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="product-section">
            <div class="container-fluid">

                <h2 class="section-title-center light-text"><?php echo esc_html($settings['sec_title']); ?></h2>

                <div class="product-slider-outer">
                    <button class="slider-nav-outside prev" aria-label="Previous">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <div class="slider-viewport">
                        <div class="product-track">
                            <?php if ( $settings['products_list'] ) : foreach ( $settings['products_list'] as $item ) : ?>
                            <div class="product-card">
                                <div class="prod-img-placeholder">
                                    <?php if(!empty($item['img']['url'])): ?>
                                    <img src="<?php echo esc_url($item['img']['url']); ?>" alt="Product" style="width:100%; height:100%; object-fit:cover;">
                                    <?php endif; ?>
                                </div>
                                <div class="prod-body">
                                    <h3 class="prod-title"><?php echo esc_html($item['title']); ?></h3>
                                    <p class="prod-desc"><?php echo esc_html($item['desc']); ?></p>
                                    
                                    <div class="prod-specs-wrapper">
                                        <?php echo $item['specs']; ?>
                                    </div>

                                    <a href="<?php echo esc_url($item['link']['url']); ?>" class="btn-buy-now">
                                        <span class="icon-box-dark">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="7" y1="7" x2="17" y2="17"></line>
                                                <polyline points="17 7 17 17 7 17"></polyline>
                                            </svg>
                                        </span>
                                        <?php echo esc_html($item['btn_text']); ?>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div> 
                    
                    <button class="slider-nav-outside next" aria-label="Next">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>

                </div>

                <?php if(!empty($settings['ft_btn_text'])): ?>
                <div class="view-process-btn-wrapper">
                    <a href="<?php echo esc_attr($settings['ft_btn_link']); ?>" class="btn-view-process">
                        <span class="icon-box-square">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="7" x2="17" y2="17"></line>
                                <polyline points="17 7 17 17 7 17"></polyline>
                            </svg>
                        </span>
                        <?php echo esc_html($settings['ft_btn_text']); ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </section>
        <?php
    }
}