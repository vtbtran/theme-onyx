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
        $this->add_control('sec_title', ['label' => 'Section Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Recent News']);
        $this->add_control('search_placeholder', ['label' => 'Search Placeholder', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Search news articles...']);
        $this->end_controls_section();

        // Query Settings
        $this->start_controls_section('sec_query', ['label' => 'Post Configuration', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('posts_per_page', ['label' => 'Posts Per Page', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 6]);
        $this->add_control('card_btn_text', ['label' => 'Button Text (Per Card)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Read More']);
        $this->end_controls_section();
        
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        // 1. XỬ LÝ BIẾN PHÂN TRANG (PAGED)
        // WordPress dùng 'page' cho Trang chủ tĩnh và 'paged' cho các trang khác
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $ppp = (int) $settings['posts_per_page'];
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $ppp,
            'post_status'    => 'publish',
            'paged'          => $paged,
        ];
        $query = new \WP_Query($args);
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
                    else :
                        echo '<p style="text-align:center; width:100%;">No posts found.</p>';
                    endif;
                    ?>
                </div>

                <div id="no-results-<?php echo esc_attr($widget_id); ?>" style="display:none; text-align:center; width:100%; padding: 40px; color:#666;">
                    No results found.
                </div>

                <?php if ($query->max_num_pages > 1) : ?>
                    <div class="onyx-pagination-wrapper">
                        <?php
                        echo paginate_links([
                            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format'       => '?paged=%#%',
                            'current'      => max(1, $paged),
                            'total'        => $query->max_num_pages,
                            'prev_text'    => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                            'next_text'    => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 3
                        ]);
                        ?>
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
                var paginationSelector = '.onyx-pagination-wrapper';
                var searchTimer;

                // XỬ LÝ TÌM KIẾM AJAX
                $(inputSelector).on('keyup', function() {
                    var keyword = $(this).val();
                    var $grid = $(gridSelector);
                    var $pagination = $(paginationSelector);

                    clearTimeout(searchTimer);

                    searchTimer = setTimeout(function() {
                        $grid.css('opacity', '0.4');

                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            data: {
                                action: 'onyx_load_more_posts',
                                keyword: keyword,
                                card_btn_text: '<?php echo esc_js($settings['card_btn_text']); ?>'
                            },
                            success: function(response) {
                                $grid.css('opacity', '1');

                                if (response.trim() !== '') {
                                    $grid.html(response);
                                    $(noResultSelector).hide();
                                    
                                    // Ẩn phân trang khi đang tìm kiếm
                                    if (keyword.length > 0) {
                                        $pagination.hide();
                                    } else {
                                        // Nếu xóa trắng thì reload để khôi phục trạng thái phân trang chuẩn
                                        location.reload();
                                    }
                                } else {
                                    $grid.empty();
                                    $(noResultSelector).show();
                                    $pagination.hide();
                                }
                            }
                        });
                    }, 500);
                });
            });
        </script>
    <?php
    }

    private function render_post_card($settings)
    {
        $post_id = get_the_ID();
        $thumb_url = '';

        // 1. LẤY ẢNH TỪ ONYX EDITOR (ƯU TIÊN)
        if (class_exists('Onyx_Editor_Database')) {
            $onyx_article = Onyx_Editor_Database::get_article_by_post_id($post_id);
            if ($onyx_article && !empty($onyx_article['hero_image'])) {
                $hero_data = $onyx_article['hero_image'];
                if (is_array($hero_data)) {
                    if (isset($hero_data['url'])) {
                        $thumb_url = $hero_data['url'];
                    } elseif (isset($hero_data['link'])) {
                        $thumb_url = $hero_data['link'];
                    } elseif (isset($hero_data['src'])) {
                        $thumb_url = $hero_data['src'];
                    }
                } elseif (is_string($hero_data)) {
                    $thumb_url = $hero_data;
                }
            }
        }

        // 2. FALLBACK
        if (empty($thumb_url)) {
            if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url($post_id, 'medium_large');
            } else {
                $thumb_url = class_exists('\Elementor\Utils') 
                    ? \Elementor\Utils::get_placeholder_image_src() 
                    : 'https://via.placeholder.com/600x400/cccccc/969696?text=No+Image';
            }
        }

        // 3. NỘI DUNG
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
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>">
                </a>
            </div>
            <div class="card-body">
                <div class="card-meta"><?php echo get_the_date('F j, Y', $post_id); ?> • <?php echo $reading_time; ?> min read</div>
                <h3 class="card-title">
                    <a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a>
                </h3>
                <div class="card-desc"><?php echo $excerpt; ?></div>
                <a href="<?php echo get_permalink($post_id); ?>" class="btn-card-full">
                    <span class="icon-box">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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