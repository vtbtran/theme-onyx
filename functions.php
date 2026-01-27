<?php
// functions.php

function theme_onyx_setup()
{
    // Cho phép upload Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Đăng ký vị trí Menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'theme-onyx'),
        'mobile'  => __('Mobile Menu', 'theme-onyx'),
        'footer'  => __('Footer Menu', 'theme-onyx'),
    ));
}
add_action('after_setup_theme', 'theme_onyx_setup');

// Nhúng file CSS và JS
function theme_onyx_scripts()
{
    // 1. Nhúng file style.css gốc
    wp_enqueue_style('onyx-main-style', get_stylesheet_uri());

    // 2. Nhúng file header.css
    wp_enqueue_style(
        'onyx-header-style',
        get_template_directory_uri() . '/assets/css/header.css',
        array('onyx-main-style'),
        '1.0.1'
    );

    // 3. Nhúng Google Fonts
    wp_enqueue_style(
        'onyx-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // 4. Nhúng footer.css
    wp_enqueue_style(
        'onyx-footer-style',
        get_template_directory_uri() . '/assets/css/footer.css',
        array('onyx-main-style'),
        '1.0.0'
    );

    // 5. CSS cho Trang chủ
    if (is_front_page()) {
        wp_enqueue_style('onyx-front-page', get_template_directory_uri() . '/assets/css/front-page.css', array('onyx-main-style'), '1.0.0');
    }

    // 6. Nhúng JS (Đã sửa lỗi trùng lặp: Chỉ giữ lại 1 dòng load ở footer)
    wp_enqueue_script(
        'onyx-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(), // Không phụ thuộc jQuery (nếu cần jQuery thì điền array('jquery'))
        '1.0',
        true // Load ở footer
    );

    // 7. CSS cho các trang con (Page Templates)
    if (is_page_template('resources-page.php')) {
        wp_enqueue_style('onyx-resources-css', get_template_directory_uri() . '/assets/css/resources-page.css', array(), '1.0');
    }
    if (is_page_template('our-service-page.php')) {
        wp_enqueue_style('onyx-our-service-css', get_template_directory_uri() . '/assets/css/our-service-page.css', array(), '1.0');
    }
    if (is_page_template('contact-us-page.php')) {
        wp_enqueue_style('onyx-contact-us-css', get_template_directory_uri() . '/assets/css/contact-us-page.css', array(), '1.0');
    }
    if (is_page_template('news-page.php')) {
        wp_enqueue_style('onyx-news-css', get_template_directory_uri() . '/assets/css/news-page.css', array(), '1.0');
    }
    if (is_page_template('about-us-page.php')) {
        wp_enqueue_style('onyx-about-us-css', get_template_directory_uri() . '/assets/css/about-us-page.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'theme_onyx_scripts');


/* --- 
   CUSTOM POST TYPE: SLIDER 
   (Lưu ý: Widget Elementor mới không dùng cái này nữa, 
   nhưng mình cứ để đây, nếu không dùng bạn có thể xóa) 
--- */
function create_home_slider_cpt() {
    register_post_type('home_slider',
        array(
            'labels'      => array(
                'name'          => 'Home Sliders',
                'singular_name' => 'Slider',
                'add_new'       => 'Thêm Slide Mới',
                'edit_item'     => 'Sửa Slide',
            ),
            'public'      => true,
            'menu_icon'   => 'dashicons-images-alt2',
            'supports'    => array('title', 'thumbnail'),
            'exclude_from_search' => true,
        )
    );
}
add_action('init', 'create_home_slider_cpt');


/* --- ĐĂNG KÝ WIDGET ELEMENTOR (QUAN TRỌNG) --- */
function register_custom_elementor_widgets( $widgets_manager ) {
    $widget_file = get_template_directory() . '/widgets/home-widget.php';
    
    // Tạm thời ẩn 2 dòng này đi bằng dấu //
    if ( file_exists( $widget_file ) ) {
        require_once( $widget_file );
        $widgets_manager->register( new \Home_Hero_Widget() );
    }

    $file_about = get_template_directory() . '/widgets/about-stats-widget.php';
    if ( file_exists( $file_about ) ) {
        require_once( $file_about );
        $widgets_manager->register( new \Onyx_About_Stats_Widget() );
    }
    $file_mv = get_template_directory() . '/widgets/mission-vision-widget.php';
    if ( file_exists( $file_mv ) ) {
        require_once( $file_mv );
        $widgets_manager->register( new \Onyx_Mission_Vision_Widget() );
    }
    $file_cv = get_template_directory() . '/widgets/core-values-widget.php';
    if ( file_exists( $file_cv ) ) {
        require_once( $file_cv );
        $widgets_manager->register( new \Onyx_Core_Values_Widget() );
    }
}
add_action( 'elementor/widgets/register', 'register_custom_elementor_widgets' );


/* --- Xử lý Form --- */
// add_action('admin_post_nopriv_onyx_submit_form', 'onyx_handle_form');
// add_action('admin_post_onyx_submit_form', 'onyx_handle_form');