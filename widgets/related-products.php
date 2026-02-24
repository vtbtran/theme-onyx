<?php
class Onyx_Related_Products_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_related_products';
    }
    public function get_title()
    {
        return 'Onyx Related Products';
    }
    public function get_icon()
    {
        return 'eicon-products';
    }
    public function get_categories()
    {
        return ['onyx-category'];
    }

    protected function render()
    {
        global $product;
        if (! $product) {
            $curr_id = get_the_ID();
            if ($curr_id) {
                $product = wc_get_product($curr_id);
            }
        }

        if ((! $product || ! is_a($product, 'WC_Product')) && \Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $recent_products = wc_get_products(array('limit' => 1, 'status' => 'publish'));
            if (! empty($recent_products)) {
                $product = $recent_products[0];
            }
        }

        // Nếu vẫn không có sản phẩm nào (Website trắng trơn) -> Báo lỗi
        if (! $product || ! is_a($product, 'WC_Product')) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<div style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 8px;">The Related Products Widget requires at least one product in WooCommerce to display.</div>';
            }
            return;
        }


        // --- BƯỚC 3: LẤY LIST LIÊN QUAN TỪ SẢN PHẨM ĐÃ TÌM ĐƯỢC ---
        $related_ids = wc_get_related_products($product->get_id(), 5);

        // Nếu sản phẩm này không có sản phẩm liên quan nào & đang ở chế độ Edit
        // -> Tự lấy 5 sản phẩm ngẫu nhiên khác để lấp đầy giao diện cho đẹp (Fake data để design)
        if (empty($related_ids) && \Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $fallback_args = array(
                'limit' => 5,
                'status' => 'publish',
                'exclude' => array($product->get_id()) // Trừ chính nó ra
            );
            $fallback_products = wc_get_products($fallback_args);

            if (!empty($fallback_products)) {
                $related_ids = wp_list_pluck($fallback_products, 'get_id');
            }
        }

        if (empty($related_ids)) return;

        // --- BƯỚC 4: HIỂN THỊ GIAO DIỆN ---
        echo '<div class="onyx-related-wrapper onyx-card">';
        echo '<div class="onyx-related-header">';
        echo '<h2 class="onyx-related-title">Related Products</h2>';
        echo '<p class="onyx-related-subtitle">Products in the same category you might like</p>';
        echo '</div>';
        echo '<div class="onyx-related-grid">';

        foreach ($related_ids as $related_id) {
            $related_product = wc_get_product($related_id);
            if (!$related_product) continue; // Bỏ qua nếu lỗi

            $link = get_permalink($related_id);
            $image = wp_get_attachment_image_url($related_product->get_image_id(), 'medium');
            $name = $related_product->get_name();
            $price_html = $related_product->get_price_html();
?>
            <div class="onyx-related-item">
                <div class="onyx-related-thumb">
                    <a href="<?php echo esc_url($link); ?>">
                        <img src="<?php echo esc_url($image ? $image : wc_placeholder_img_src()); ?>" alt="<?php echo esc_attr($name); ?>">
                    </a>
                </div>
                <div class="onyx-related-info">
                    <h3 class="onyx-related-name">
                        <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a>
                    </h3>
                    <div class="onyx-related-price">
                        <?php echo $price_html; ?>
                    </div>
                </div>
            </div>
<?php
        }

        echo '</div></div>';
    }
}
