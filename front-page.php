<?php get_header(); ?>

<main class="site-main" role="main">
    <?php
    while ( have_posts() ) :
        the_post();
        
        // QUAN TRỌNG: Hàm này giúp Elementor hoạt động
        the_content();

    endwhile;
    ?>
</main>

<?php get_footer(); ?>