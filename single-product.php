<?php
/**
 * Template Name: Single Product
 * Template Post Type: product
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <div class="elementor-product-container">
            <?php 
            if ( class_exists( '\Elementor\Plugin' ) ) {
                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( 3485 );
            } else {
                the_content();
            }
            ?>
        </div>

    <?php
    endwhile;
    ?>

    </main>
</div>

<?php get_footer(); ?>