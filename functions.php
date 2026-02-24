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

    add_theme_support('woocommerce');

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
    // 4.1. CSS cho Sản phẩm chi tiết (Single Product)
    if (is_single()) {
        wp_enqueue_style(
            'onyx-single-product-css',
            get_template_directory_uri() . '/assets/css/single-product.css',
            array('onyx-main-style'),
            time()
        );
    }
    // 5. CSS cho Trang chủ
    if (is_front_page()) {
        wp_enqueue_style('onyx-front-page', get_template_directory_uri() . '/assets/css/front-page.css', array('onyx-main-style'), '1.0.0');
    }

    // 6. Nhúng JS (ĐÃ SỬA: Thêm dependency 'jquery' để tránh lỗi Ajax)
    wp_enqueue_script(
        'onyx-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'), // Quan trọng: Phải có jquery
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

function create_home_slider_cpt()
{
    register_post_type(
        'home_slider',
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
/* --- ĐĂNG KÝ WIDGET ELEMENTOR HEADER & FOOTER (QUAN TRỌNG) --- */
function onyx_register_elementor_locations($elementor_theme_manager)
{
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
}
add_action('elementor/theme/register_locations', 'onyx_register_elementor_locations');

/* --- ĐĂNG KÝ WIDGET ELEMENTOR (QUAN TRỌNG) --- */
function register_custom_elementor_widgets($widgets_manager)
{
    $widget_file = get_template_directory() . '/widgets/home-widget.php';

    // Tạm thời ẩn 2 dòng này đi bằng dấu //
    if (file_exists($widget_file)) {
        require_once($widget_file);
        $widgets_manager->register(new \Home_Hero_Widget());
    }

    $file_about = get_template_directory() . '/widgets/about-stats-widget.php';
    if (file_exists($file_about)) {
        require_once($file_about);
        $widgets_manager->register(new \Onyx_About_Stats_Widget());
    }
    $file_mv = get_template_directory() . '/widgets/mission-vision-widget.php';
    if (file_exists($file_mv)) {
        require_once($file_mv);
        $widgets_manager->register(new \Onyx_Mission_Vision_Widget());
    }
    $file_cv = get_template_directory() . '/widgets/core-values-widget.php';
    if (file_exists($file_cv)) {
        require_once($file_cv);
        $widgets_manager->register(new \Onyx_Core_Values_Widget());
    }

    $file_service = get_template_directory() . '/widgets/service-grid-widget.php';
    if (file_exists($file_service)) {
        require_once($file_service);
        $widgets_manager->register(new \Onyx_Service_Grid_Widget());
    }

    $file_product = get_template_directory() . '/widgets/product-slider-widget.php';
    if (file_exists($file_product)) {
        require_once($file_product);
        $widgets_manager->register(new \Onyx_Product_Slider_Widget());
    }

    $file_process = get_template_directory() . '/widgets/process-list-widget.php';
    if (file_exists($file_process)) {
        require_once($file_process);
        $widgets_manager->register(new \Onyx_Process_List_Widget());
    }
    $file_process = get_template_directory() . '/widgets/resource-library-widget.php';
    if (file_exists($file_process)) {
        require_once($file_process);
        $widgets_manager->register(new \Onyx_Resource_Library_Widget());
    }
    $file_process = get_template_directory() . '/widgets/resource-webinar-news-widget.php';
    if (file_exists($file_process)) {
        require_once($file_process);
        $widgets_manager->register(new \Onyx_Webinar_News_Widget());
    }
    $file_faq = get_template_directory() . '/widgets/resource-faq-widget.php';
    if (file_exists($file_faq)) {
        require_once($file_faq);
        $widgets_manager->register(new \Onyx_FAQ_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/resource-more-questions-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_More_Questions_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/contact-intro-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_Contact_Intro_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/contact-features-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_Contact_Features_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/contact-business-hours-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_Business_Hours_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/contact-info-grid-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_Contact_Grid_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/news-hero-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_News_Hero_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/news-grid-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_News_Grid_Widget());
    }
    $file_contact = get_template_directory() . '/widgets/newsletter-signup-widget.php';
    if (file_exists($file_contact)) {
        require_once($file_contact);
        $widgets_manager->register(new \Onyx_Newsletter_Widget());
    }
    $file_header = get_template_directory() . '/widgets/header-widget.php';
    if (file_exists($file_header)) {
        require_once($file_header);
        $widgets_manager->register(new \Onyx_Header_Widget());
    }
    $file_footer = get_template_directory() . '/widgets/footer-widget.php';
    if (file_exists($file_footer)) {
        require_once($file_footer);
        if (class_exists('Onyx_Footer_Widget')) {
            $widgets_manager->register(new \Onyx_Footer_Widget());
        }
    }

    $file_product_info = get_template_directory() . '/widgets/product-info.php';
    if (file_exists($file_product_info)) {
        require_once($file_product_info);
        // Tên class trong file product-info.php phải là Onyx_Product_Info_Widget
        if (class_exists('Onyx_Product_Info_Widget')) {
            $widgets_manager->register(new \Onyx_Product_Info_Widget());
        }
    }

    $file_tabs = get_template_directory() . '/widgets/product-tabs.php';
    if (file_exists($file_tabs)) {
        require_once($file_tabs);
        $widgets_manager->register(new \Onyx_Product_Tabs_Widget());
    }

    $file_related = get_template_directory() . '/widgets/related-products.php';
    if (file_exists($file_related)) {
        require_once($file_related);
        $widgets_manager->register(new \Onyx_Related_Products_Widget());
    }
}
add_action('elementor/widgets/register', 'register_custom_elementor_widgets');


// --- START: CODE CẤP CỨU QUYỀN MAILPOET ---
add_action('init', 'onyx_force_restore_mailpoet_permissions');
function onyx_force_restore_mailpoet_permissions()
{
    // 1. Lấy vai trò Administrator (Quản lý)
    $role = get_role('administrator');

    if (! empty($role)) {
        // 2. Danh sách các quyền cần khôi phục
        $caps = array(
            'manage_mailpoet',
            'mailpoet_manage_emails',
            'mailpoet_manage_subscribers',
            'mailpoet_manage_forms',
            'mailpoet_manage_segments',
            'mailpoet_manage_settings',
            'edit_users',
            'promote_users',
            'manage_options' // Quyền quan trọng nhất của Admin
        );

        // 3. Vòng lặp add từng quyền vào
        foreach ($caps as $cap) {
            $role->add_cap($cap);
        }
    }
}


// 1. Xóa các action cũ để tránh xung đột
remove_action('wp_ajax_onyx_load_more_posts', 'onyx_load_more_posts_handler');
remove_action('wp_ajax_nopriv_onyx_load_more_posts', 'onyx_load_more_posts_handler');

// 2. Đăng ký lại action mới
add_action('wp_ajax_onyx_load_more_posts', 'onyx_load_more_posts_handler');
add_action('wp_ajax_nopriv_onyx_load_more_posts', 'onyx_load_more_posts_handler');

function onyx_load_more_posts_handler()
{
    // 1. Nhận dữ liệu từ Ajax
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $card_btn_text = isset($_POST['card_btn_text']) ? sanitize_text_field($_POST['card_btn_text']) : 'Read More';
    $keyword = isset($_POST['keyword']) ? sanitize_text_field($_POST['keyword']) : ''; // Nhận từ khóa tìm kiếm

    // 2. Thiết lập Query
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1, // Mặc định lấy hết bài còn lại
    ];

    if (!empty($keyword)) {
        $args['s'] = $keyword;
        $args['offset'] = 0;
    } else {
        $args['offset'] = $offset;
    }

    $query = new WP_Query($args);

    // 3. Xuất HTML
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            // Xử lý dữ liệu hiển thị (Giữ nguyên logic cũ của bạn)
            $content = get_post_field('post_content', get_the_ID());
            $word_count = str_word_count(strip_tags($content));
            $reading_time = ceil($word_count / 200);

            $thumb_url = '';
            // Ưu tiên dùng Placeholder của Elementor nếu có
            $placeholder_img = 'https://via.placeholder.com/600x400/cccccc/969696?text=No+Image';
            if (class_exists('\Elementor\Utils')) {
                $placeholder_img = \Elementor\Utils::get_placeholder_image_src();
            }

            if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
            } else {
                $thumb_url = $placeholder_img;
            }

            $excerpt = get_the_excerpt();
            if (empty($excerpt)) $excerpt = wp_trim_words(strip_tags($content), 20, '...');
            else $excerpt = wp_trim_words($excerpt, 20, '...');
?>

            <div class="news-item-card js-news-item" style="opacity: 1; visibility: visible;">
                <div class="card-thumb">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($thumb_url); ?>"
                            alt="<?php the_title_attribute(); ?>"
                            class="attachment-medium_large size-medium_large wp-post-image"
                            style="width:100%; height:auto; object-fit:cover; display:block; min-height: 200px; background-color: #eee;">
                    </a>
                </div>
                <div class="card-body">
                    <div class="card-meta"><?php echo get_the_date('F j, Y'); ?> • <?php echo $reading_time; ?> min read</div>
                    <h3 class="card-title js-search-target"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="card-desc js-search-target"><?php echo $excerpt; ?></div>
                    <a href="<?php the_permalink(); ?>" class="btn-card-full">
                        <span class="icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="7" x2="17" y2="17"></line>
                                <polyline points="17 7 17 17 7 17"></polyline>
                            </svg>
                        </span>
                        <?php echo esc_html($card_btn_text); ?>
                    </a>
                </div>
            </div>

<?php
        endwhile;
    else:
    endif;
    wp_reset_postdata();
    die();
}

function create_product_cpt()
{
    register_post_type(
        'product',
        array(
            'labels'      => array(
                'name'          => __('Products', 'textdomain'),
                'singular_name' => __('Product', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'products'),
            'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'create_product_cpt');
