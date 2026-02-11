<?php
if (! defined('ABSPATH')) exit;

class Onyx_News_Grid_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'onyx_news_grid';
    }
    public function get_title()
    {
        return 'Onyx: News Grid';
    }
    public function get_icon()
    {
        return 'eicon-posts-grid';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // Header & Search
        $this->start_controls_section('sec_header', ['label' => 'Header & Search', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('sec_title', ['label' => 'Tiêu đề Section', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Recent News']);
        $this->add_control('search_placeholder', ['label' => 'Placeholder Tìm kiếm', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Search news articles...']);
        $this->end_controls_section();

        // Query Settings
        $this->start_controls_section('sec_query', ['label' => 'Cấu hình bài viết', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('posts_per_page', ['label' => 'Số lượng ban đầu', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 6]);
        $this->add_control('card_btn_text', ['label' => 'Chữ nút (Mỗi thẻ)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Read More']);
        $this->end_controls_section();

        // Footer Button
        $this->start_controls_section('sec_footer', ['label' => 'Nút View All', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('btn_text', ['label' => 'Chữ nút', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View All']);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        // 1. QUERY BAN ĐẦU: Chỉ lấy số lượng giới hạn (ví dụ 6 bài)
        $ppp = (int) $settings['posts_per_page'];
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $ppp,
            'post_status'    => 'publish',
            'paged'          => 1,
        ];
        $query = new \WP_Query($args);

        // Kiểm tra xem có còn bài để load không (Tổng bài > Số bài hiển thị)
        $total_posts = $query->found_posts;
        $has_more = $total_posts > $ppp;
?>
        <section class="recent-news-section" id="onyx-news-<?php echo esc_attr($widget_id); ?>">
            <div class="container">
                <div class="recent-header-row">
                    <h2 class="section-title"><?php echo esc_html($settings['sec_title']); ?></h2>
                    <form class="news-search-form" onsubmit="event.preventDefault();">
                        <span class="search-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <input type="text" id="news-search-<?php echo esc_attr($widget_id); ?>" class="search-field" placeholder="<?php echo esc_attr($settings['search_placeholder']); ?>">
                    </form>
                </div>

                <div class="news-grid" id="news-grid-<?php echo esc_attr($widget_id); ?>">
                    <?php
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            $this->render_post_card($settings);
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <div id="no-results-<?php echo esc_attr($widget_id); ?>" style="display:none; text-align:center; width:100%; padding: 20px; color:#666;">
                    No results found.
                </div>

                <?php if ($has_more) : ?>
                    <div class="news-bottom-action">
                        <button type="button"
                            id="view-all-<?php echo esc_attr($widget_id); ?>"
                            class="btn-static-event btn-load-more"
                            data-ppp="<?php echo $ppp; ?>"> <span class="icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                            <span class="btn-text"><?php echo esc_html($settings['btn_text']); ?></span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <script>
            jQuery(document).ready(function($) {
                var widgetID = '<?php echo esc_js($widget_id); ?>';
                var gridSelector = '#news-grid-' + widgetID;
                var inputSelector = '#news-search-' + widgetID;
                var noResultSelector = '#no-results-' + widgetID;
                var btnSelector = '#view-all-' + widgetID;
                var searchTimer; // Biến dùng để delay (Debounce)

                // --- 1. XỬ LÝ NÚT LOAD MORE (GIỮ NGUYÊN) ---
                $('.btn-load-more').off('click').on('click', function(e) {
                    e.preventDefault();
                    var button = $(this);
                    var $grid = button.closest('.recent-news-section').find('.news-grid');
                    var initialPosts = button.attr('data-ppp');

                    button.addClass('loading').css('opacity', '0.6');
                    button.find('.btn-text').text('Loading...');

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'onyx_load_more_posts',
                            offset: initialPosts,
                            card_btn_text: '<?php echo esc_js($settings['card_btn_text']); ?>'
                        },
                        success: function(response) {
                            if (response) {
                                $grid.append(response); // Thêm vào cuối danh sách
                                button.parent().fadeOut();
                            } else {
                                button.find('.btn-text').text('Hết bài');
                            }
                        }
                    });
                });

                // --- 2. XỬ LÝ TÌM KIẾM TRONG DATABASE (MỚI) ---
                $(inputSelector).on('keyup', function() {
                    var keyword = $(this).val();
                    var $grid = $(gridSelector);
                    var $btnWrapper = $(btnSelector).parent(); // Lấy div bao ngoài nút View All

                    // Xóa lệnh cũ để tránh gửi quá nhiều request khi gõ nhanh
                    clearTimeout(searchTimer);

                    // Đợi 500ms sau khi ngừng gõ mới bắt đầu tìm (Debounce)
                    searchTimer = setTimeout(function() {

                        // Hiệu ứng đang tải (làm mờ lưới bài viết)
                        $grid.css('opacity', '0.4');

                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            data: {
                                action: 'onyx_load_more_posts',
                                keyword: keyword, // Gửi từ khóa lên PHP
                                card_btn_text: '<?php echo esc_js($settings['card_btn_text']); ?>'
                            },
                            success: function(response) {
                                // Tắt hiệu ứng đang tải
                                $grid.css('opacity', '1');

                                if (response.trim() !== '') {
                                    // CÓ KẾT QUẢ:
                                    // Thay thế toàn bộ nội dung lưới bằng kết quả tìm kiếm
                                    $grid.html(response);
                                    $(noResultSelector).hide();

                                    // Nếu đang tìm kiếm thì ẩn nút "View All" đi (vì kết quả đã show hết rồi)
                                    if (keyword.length > 0) {
                                        $btnWrapper.hide();
                                    } else {
                                        // Nếu xóa trắng ô tìm kiếm -> Reload lại trang để reset về ban đầu cho đẹp
                                        // Hoặc có thể gọi Ajax load lại 6 bài đầu, nhưng reload là cách an toàn nhất
                                        location.reload();
                                    }
                                } else {
                                    // KHÔNG CÓ KẾT QUẢ:
                                    $grid.empty(); // Xóa trắng lưới
                                    $(noResultSelector).show(); // Hiện thông báo "No results"
                                    $btnWrapper.hide(); // Ẩn nút View All
                                }
                            }
                        });
                    }, 500); // Thời gian chờ 500ms
                });
            });
        </script>
    <?php
    }

   private function render_post_card($settings)
    {
        $post_id = get_the_ID();
        $thumb_url = ''; // Biến chứa link ảnh cuối cùng

        // 1. LẤY ẢNH TỪ ONYX EDITOR (ƯU TIÊN)
        if (class_exists('Onyx_Editor_Database')) {
            // Gọi hàm lấy dữ liệu (không cần sửa database.php)
            $onyx_article = Onyx_Editor_Database::get_article_by_post_id($post_id);

            if ($onyx_article && !empty($onyx_article['hero_image'])) {
                $hero_data = $onyx_article['hero_image'];

                // TRƯỜNG HỢP 1: Dữ liệu là Mảng (Do database.php đã json_decode)
                if (is_array($hero_data)) {
                    // Kiểm tra các key phổ biến chứa link ảnh
                    if (isset($hero_data['url'])) {
                        $thumb_url = $hero_data['url'];
                    } elseif (isset($hero_data['link'])) {
                        $thumb_url = $hero_data['link'];
                    } elseif (isset($hero_data['src'])) {
                        $thumb_url = $hero_data['src'];
                    }
                } 
                // TRƯỜNG HỢP 2: Dữ liệu là Chuỗi (Link trực tiếp)
                elseif (is_string($hero_data)) {
                    $thumb_url = $hero_data;
                }
            }
        }

        // 2. FALLBACK (NẾU KHÔNG CÓ ẢNH TRONG ONYX)
        // Nếu $thumb_url vẫn rỗng -> Lấy Featured Image của WordPress
        if (empty($thumb_url)) {
            if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url($post_id, 'medium_large');
            } else {
                // Nếu không có cả Featured Image -> Lấy ảnh giữ chỗ
                $thumb_url = class_exists('\Elementor\Utils') 
                    ? \Elementor\Utils::get_placeholder_image_src() 
                    : 'https://via.placeholder.com/600x400/cccccc/969696?text=No+Image';
            }
        }

        // 3. XỬ LÝ NỘI DUNG (Title, Excerpt...)
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);

        $excerpt = get_the_excerpt($post_id);
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(strip_tags($content), 20, '...');
        } else {
            $excerpt = wp_trim_words($excerpt, 20, '...');
        }
    ?>
        <div class="news-item-card js-news-item">
            <div class="card-thumb">
                <a href="<?php echo get_permalink($post_id); ?>">
                    <img src="<?php echo esc_url($thumb_url); ?>"
                        alt="<?php echo esc_attr(get_the_title($post_id)); ?>"
                        class="attachment-medium_large size-medium_large wp-post-image"
                        style="width:100%; height:240px; object-fit:cover; display:block; background-color: #f0f0f0;">
                </a>
            </div>
            <div class="card-body">
                <div class="card-meta"><?php echo get_the_date('F j, Y', $post_id); ?> • <?php echo $reading_time; ?> min read</div>
                <h3 class="card-title js-search-target">
                    <a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a>
                </h3>
                <div class="card-desc js-search-target"><?php echo $excerpt; ?></div>
                <a href="<?php echo get_permalink($post_id); ?>" class="btn-card-full">
                    <span class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="7" x2="17" y2="17"></line>
                            <polyline points="17 7 17 17 7 17"></polyline>
                        </svg>
                    </span>
                    <?php echo esc_html($settings['card_btn_text']); ?>
                </a>
            </div>
        </div>
    <?php
    }
}
