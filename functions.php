<?php
// functions.php

function theme_onyx_setup()
{
    // Cho phép upload Logo từ trang quản trị
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
    // 1. Nhúng file style.css gốc (Chứa thông tin theme)
    wp_enqueue_style('onyx-main-style', get_stylesheet_uri());

    // 2. Nhúng file header.css (Chứa giao diện Header)
    // Lưu ý: Đường dẫn phải khớp với thư mục bạn tạo trong VS Code
    wp_enqueue_style(
        'onyx-header-style',
        get_template_directory_uri() . '/assets/css/header.css',
        array('onyx-main-style'), // Load sau file chính
        '1.0.1' // Đổi số version để xóa cache trình duyệt
    );
    wp_enqueue_style(
        'onyx-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
        [],
        null
    );
    // THÊM ĐOẠN NÀY ĐỂ LOAD FOOTER CSS
    wp_enqueue_style(
        'onyx-footer-style',
        get_template_directory_uri() . '/assets/css/footer.css',
        array('onyx-main-style'),
        '1.0.0'
    );

    if (is_front_page()) {
        wp_enqueue_style('onyx-front-page', get_template_directory_uri() . '/assets/css/front-page.css', array('onyx-main-style'), '1.0.0');
    }

    wp_enqueue_script('onyx-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);

    wp_enqueue_script(
        'onyx-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(), // Không phụ thuộc jQuery
        '1.0',
        true // Load ở footer (true)
    );
    if (is_page_template('resources-page.php')) {
        wp_enqueue_style(
            'onyx-resources-css',
            get_template_directory_uri() . '/assets/css/resources-page.css',
            array(),
            '1.0'
        );
    }
    if (is_page_template('our-service-page.php')) {
        wp_enqueue_style(
            'onyx-our-service-css',
            get_template_directory_uri() . '/assets/css/our-service-page.css',
            array(),
            '1.0'
        );
    }

    if (is_page_template('contact-us-page.php')) {
        wp_enqueue_style(
            'onyx-contact-us-css',
            get_template_directory_uri() . '/assets/css/contact-us-page.css',
            array(),
            '1.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'theme_onyx_scripts');
