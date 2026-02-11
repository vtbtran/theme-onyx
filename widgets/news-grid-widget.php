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
        // 1. Lấy nội dung & tính thời gian đọc
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);

        // 2. Xử lý Ảnh (Đã đồng bộ với Ajax để có hiệu ứng Hover)
        $thumb_url = '';

        // Lấy URL ảnh placeholder chuẩn của Elementor (nếu có)
        $placeholder_img = 'https://via.placeholder.com/600x400/cccccc/969696?text=No+Image';
        if (class_exists('\Elementor\Utils')) {
            $placeholder_img = \Elementor\Utils::get_placeholder_image_src();
        }

        // Lấy URL ảnh đại diện
        if (has_post_thumbnail()) {
            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
        } else {
            $thumb_url = $placeholder_img;
        }

        // 3. Xử lý Mô tả ngắn (Excerpt)
        $excerpt = get_the_excerpt();
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(strip_tags($content), 20, '...');
        } else {
            $excerpt = wp_trim_words($excerpt, 20, '...');
        }
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
                    <?php echo esc_html($settings['card_btn_text']); ?>
                </a>
            </div>
        </div>
<?php
    }
}
