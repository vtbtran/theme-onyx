<?php
get_header(); 
?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            
            // QUAN TRỌNG: Elementor cần cái này để hiển thị
            the_content();
            
        endwhile;
    else :
        echo '<p>Không có nội dung nào.</p>';
    endif;
    ?>
</main>

<?php
get_footer(); 
?>