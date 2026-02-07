<?php
/**
 * Template Name: Default Page
 * Description: File này giúp Elementor nhận diện vùng nội dung (the_content) để chỉnh sửa.
 */

get_header(); // 1. Gọi Header (Nó sẽ tự chọn Header Elementor hay Header Widget do mình code ở file header.php)
?>

<main id="primary" class="site-main">

    <?php
    // Vòng lặp bắt buộc của WordPress
    while ( have_posts() ) :
        the_post();

        // --- ĐÂY LÀ CHÌA KHÓA ---
        // Elementor sẽ móc vào hàm này để hiển thị trình kéo thả
        the_content();

    endwhile; 
    ?>

</main>

<?php
get_footer(); // 2. Gọi Footer
?>