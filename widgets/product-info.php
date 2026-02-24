<?php
// widgets/product-info.php
class Onyx_Product_Info_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_product_info';
    }
    public function get_title()
    {
        return 'Onyx Product Info';
    }
    public function get_icon()
    {
        return 'eicon-product-info';
    }
    public function get_categories()
    {
        return ['onyx-category'];
    }

    // 1. THÊM PHẦN NÀY: Để tạo ô nhập liệu trong Elementor
    protected function register_controls()
    {
        // Section: Settings
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Settings',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => 'Button Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'LEARN MORE',
            ]
        );

        $this->add_control(
            'learn_more_link',
            [
                'label' => 'Link URL',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Section: Benefits (Phần lợi ích sản phẩm)
        $this->start_controls_section(
            'section_benefits',
            [
                'label' => 'Benefits Info',
            ]
        );

        // Benefit 1
        $this->add_control(
            'benefit_text_1',
            [
                'label' => 'Benefit 1 Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Nationwide Delivery', // Mặc định tiếng Anh
                'label_block' => true,
            ]
        );

        // Benefit 2
        $this->add_control(
            'benefit_text_2',
            [
                'label' => 'Benefit 2 Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Standard Packaging', // Mặc định tiếng Anh
                'label_block' => true,
            ]
        );

        // Benefit 3
        $this->add_control(
            'benefit_text_3',
            [
                'label' => 'Benefit 3 Text',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Warranty Policy', // Mặc định tiếng Anh
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $product;
        $product = wc_get_product(get_the_ID());

        if (! $product && \Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $recent_products = wc_get_products(array('limit' => 1, 'status' => 'publish'));
            if (! empty($recent_products)) {
                $product = $recent_products[0];
            }
        }

        if (! $product) {
            echo '<div style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 8px;">Widget này cần ít nhất 1 sản phẩm trong WooCommerce để hiển thị.</div>';
            return;
        }

        // Lấy settings từ Elementor
        $settings = $this->get_settings_for_display();
        
        $btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : 'LEARN MORE';
        $link_url = !empty($settings['learn_more_link']['url']) ? $settings['learn_more_link']['url'] : '#';

        // Lấy text Benefits từ settings (nếu trống thì lấy mặc định tiếng Anh)
        $benefit_1 = !empty($settings['benefit_text_1']) ? $settings['benefit_text_1'] : 'Nationwide Delivery';
        $benefit_2 = !empty($settings['benefit_text_2']) ? $settings['benefit_text_2'] : 'Standard Packaging';
        $benefit_3 = !empty($settings['benefit_text_3']) ? $settings['benefit_text_3'] : 'Warranty Policy';

        $main_image_url = wp_get_attachment_image_url($product->get_image_id(), 'full');

        $all_image_ids = array();
        if ($product->get_image_id()) {
            $all_image_ids[] = $product->get_image_id();
        }
        if ($product->get_gallery_image_ids()) {
            $all_image_ids = array_merge($all_image_ids, $product->get_gallery_image_ids());
        }
        $all_image_ids = array_unique($all_image_ids);
?>

        <div class="onyx-single-product-top">
            <div class="onyx-card onyx-gallery-card">
                <div class="onyx-gallery-layout">
                    <div class="onyx-main-image">
                        <?php if ($main_image_url) : ?>
                            <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/600x600?text=No+Image" alt="No Image">
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($all_image_ids)) : ?>
                        <div class="onyx-thumbnails">
                            <?php
                            $count = 0;
                            foreach ($all_image_ids as $attachment_id) {
                                $thumb_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                                $full_url  = wp_get_attachment_image_url($attachment_id, 'full');
                                $active_class = ($count == 0) ? 'active' : '';

                                echo '<div class="onyx-thumb-item ' . $active_class . '" data-full-image="' . esc_url($full_url) . '">';
                                echo '<img src="' . esc_url($thumb_url) . '" alt="Thumbnail">';
                                echo '</div>';

                                $count++;
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="onyx-card onyx-info-card" style="display: flex; flex-direction: column; height: 100%; min-height: auto;">
                
                <?php $categories = wc_get_product_category_list($product->get_id(), ', ', '', ''); ?>
                <?php if ($categories) : ?>
                    <div class="onyx-product-cat" style="color: #f97316; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">
                        <?php echo $categories; ?>
                    </div>
                <?php endif; ?>

                <h1 class="onyx-product-title" style="margin-top: 0; margin-bottom: 15px; font-size: 26px; color: #1a1a1a;"><?php echo $product->get_name(); ?></h1>

                <div class="onyx-product-excerpt" style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; font-size: 14px; line-height: 1.6; color: #555; margin-bottom: 25px;">
                    <?php
                    $desc = get_post_field('post_content', $product->get_id());
                    if (empty($desc)) { $desc = $product->get_short_description(); }
                    echo wp_strip_all_tags(strip_shortcodes($desc));
                    ?>
                </div>

                <div class="onyx-universal-benefits" style="margin-bottom: 25px; padding-top: 20px; border-top: 1px solid #eaeaea;">
                    
                    <div style="display: flex; align-items: center; margin-bottom: 14px;">
                        <div style="margin-right: 12px; color: #1a1a1a; display: flex;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        </div>
                        <div style="font-size: 13px; font-weight: 600; color: #1a1a1a; text-transform: uppercase; letter-spacing: 0.5px;">
                            <?php echo esc_html($benefit_1); ?>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 14px;">
                        <div style="margin-right: 12px; color: #1a1a1a; display: flex;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        </div>
                        <div style="font-size: 13px; font-weight: 600; color: #1a1a1a; text-transform: uppercase; letter-spacing: 0.5px;">
                            <?php echo esc_html($benefit_2); ?>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <div style="margin-right: 12px; color: #1a1a1a; display: flex;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <div style="font-size: 13px; font-weight: 600; color: #1a1a1a; text-transform: uppercase; letter-spacing: 0.5px;">
                             <?php echo esc_html($benefit_3); ?>
                        </div>
                    </div>

                </div>

                <div class="onyx-action-bottom" style="margin-top: auto;">
                    <?php if ($product->get_price_html()) : ?>
                    <div class="onyx-product-price" style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin-bottom: 15px;">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    <?php endif; ?>

                    <div class="onyx-product-actions">
                        <a href="<?php echo esc_url($link_url); ?>" class="onyx-btn-learn-more" style="display: flex; justify-content: center; align-items: center; width: 100%; padding: 12px 20px; background: #2d3138; color: #fff; border-radius: 8px; font-weight: 600; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;">
                            <?php echo esc_html($btn_text); ?>
                            <svg style="width: 18px; height: 18px; margin-left: 10px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
<?php
    }
}
?>