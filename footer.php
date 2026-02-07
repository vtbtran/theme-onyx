<?php
/**
 * Footer template with Elementor Support
 */
?>

<?php
// 1. Nhập ID của Template Footer Elementor vào đây (Sau khi bạn tạo xong)
$elementor_footer_id = 3369; // <--- Thay số 0 bằng ID sau khi tạo

if ( $elementor_footer_id && class_exists( '\\Elementor\\Plugin' ) ) : ?>
    
    <div class="site-footer-elementor-wrapper">
        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $elementor_footer_id ); ?>
    </div>

<?php else : ?>

    <?php 
    // Fallback: Gọi Widget trực tiếp (hoặc code cũ) nếu chưa có ID
    // Nhưng tốt nhất là bạn hãy tạo Template Elementor ngay
    get_template_part('widgets/footer', 'widget'); 
    ?>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>