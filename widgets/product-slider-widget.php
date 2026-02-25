<?php
if (! defined('ABSPATH')) exit;

class Onyx_Product_Slider_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'onyx_product_slider';
    }
    public function get_title()
    {
        return 'Onyx: Product Slider';
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
        // --- CONTENT TAB: Product Configuration ---
        $this->start_controls_section('content_section', ['label' => 'Product Configuration', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('sec_title', [
            'label' => 'Section Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Product'
        ]);

        $this->add_control('posts_per_page', [
            'label' => 'Number of Posts',
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 6,
        ]);

        $this->end_controls_section();

        // --- CONTENT TAB: Footer Button ---
        $this->start_controls_section('footer_btn', ['label' => 'Footer Button', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('show_ft_btn', [
            'label' => 'Show Button',
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('ft_btn_text', [
            'label' => 'Button Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'View our Process'
        ]);

        $this->add_control('ft_btn_link', [
            'label' => 'Button Link',
            'type' => \Elementor\Controls_Manager::URL,
            'default' => ['url' => '#process', 'is_external' => false, 'nofollow' => false],
        ]);

        $this->end_controls_section();

        // --- STYLE TAB: Button Style ---
        $this->start_controls_section('style_footer_btn', ['label' => 'Process Button Style', 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_responsive_control('ft_btn_margin_top', [
            'label' => 'Margin Top',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => ['px' => ['min' => 0, 'max' => 100]],
            'default' => ['unit' => 'px', 'size' => 40],
            'selectors' => ['{{WRAPPER}} .view-process-btn-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $args = array(
            'limit'   => $settings['posts_per_page'],
            'status'  => 'publish',
            'orderby' => 'date',
            'order'   => 'DESC',
        );
        $products = wc_get_products($args);

        if (empty($products)) return;
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
                            <?php foreach ($products as $product) :
                                if (is_numeric($product)) $product = wc_get_product($product);

                                $link  = get_permalink($product->get_id());
                                $name  = $product->get_name();
                                $image_id = $product->get_image_id();
                                $image = $image_id ? wp_get_attachment_image_url($image_id, 'large') : wc_placeholder_img_src();
                                $desc  = $product->get_short_description();
                                $price_html = $product->get_price_html();
                                $categories = wc_get_product_category_list($product->get_id(), ', ', '', '');
                                $item_id = 'product_' . $product->get_id();
                                $this->add_render_attribute($item_id, 'href', $link);
                            ?>
                                <div class="product-card">
                                    <a <?php echo $this->get_render_attribute_string($item_id); ?> class="prod-img-link">
                                        <div class="prod-img-placeholder">
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" style="width:100%; height:100%; object-fit:cover;">
                                        </div>
                                    </a>

                                    <div class="prod-body">
                                        <div class="prod-info-top">
                                            <div class="prod-cat-tag">
                                                <?php echo $categories; ?>
                                            </div>

                                            <h3 class="prod-title">
                                                <a <?php echo $this->get_render_attribute_string($item_id); ?>>
                                                    <?php echo esc_html($name); ?>
                                                </a>
                                            </h3>

                                            <div class="prod-desc">
                                                <?php echo strip_tags($desc); ?>
                                            </div>
                                        </div>

                                        <div class="onyx-card-footer">
                                            <div class="onyx-main-price">
                                                <?php echo $price_html; ?>
                                            </div>

                                            <a <?php echo $this->get_render_attribute_string($item_id); ?> class="btn-buy-circle">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="7" y1="7" x2="17" y2="17"></line>
                                                    <polyline points="17 7 17 17 7 17"></polyline>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button class="slider-nav-outside next" aria-label="Next">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>

                <?php if ('yes' === $settings['show_ft_btn']) : ?>
                    <div class="view-process-btn-wrapper" style="display: flex; justify-content: flex-end; padding-right: 10px; margin-top: 40px;">
                        <a href="<?php echo esc_url($settings['ft_btn_link']['url']); ?>"
                            class="btn-view-process"
                            <?php echo $settings['ft_btn_link']['is_external'] ? 'target="_blank"' : ''; ?>
                            <?php echo $settings['ft_btn_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>
                            style="background: #fff; color: #1a1a1a; padding: 10px 24px 10px 10px; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; text-decoration: none; transition: transform 0.2s;">

                            <span class="icon-box-square" style="background: #2d3138; color: #fff; width: 36px; height: 36px; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 14px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px;">
                                    <line x1="17" y1="7" x2="7" y2="17"></line>
                                    <polyline points="7 7 7 17 17 17"></polyline>
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
