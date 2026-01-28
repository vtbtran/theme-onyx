<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Onyx_News_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'onyx_news_grid'; }
    public function get_title() { return 'Onyx: News Grid'; }
    public function get_icon() { return 'eicon-posts-grid'; }
    public function get_categories() { return [ 'general' ]; }

    protected function _register_controls() {
        
        // --- HEADER ---
        $this->start_controls_section('sec_header', ['label' => 'Header & Search', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('sec_title', [ 'label' => 'Tiêu đề Section', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Recent News' ]);
        $this->add_control('search_placeholder', [ 'label' => 'Placeholder Tìm kiếm', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Search news articles...' ]);
        $this->end_controls_section();

        // --- POST LIST ---
        $this->start_controls_section('sec_list', ['label' => 'Danh sách bài viết', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('card_btn_text', [
            'label' => 'Chữ nút (Mỗi thẻ)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Read More', 'separator' => 'after',
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('img', [ 'label' => 'Ảnh', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()] ]);
        $repeater->add_control('title', [ 'label' => 'Tiêu đề', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'News Title Here' ]);
        $repeater->add_control('date', [ 'label' => 'Ngày & Meta', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'March 8, 2024 • 3 min read' ]);
        $repeater->add_control('desc', [ 'label' => 'Mô tả ngắn', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Description here...' ]);
        $repeater->add_control('link', [ 'label' => 'Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#'] ]);

        $this->add_control('posts_list', [
            'label' => 'Các bài viết',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['title' => 'Partnership with Global Education...', 'date' => 'March 8, 2024 • 3 min read'],
                ['title' => 'AI Technology Wins Innovation Award...', 'date' => 'March 5, 2024 • 3 min read'],
                ['title' => 'New STEM Curriculum Helps Students...', 'date' => 'March 1, 2024 • 3 min read'],
            ],
            'title_field' => '{{{ title }}}',
        ]);

        $this->end_controls_section();

        // --- FOOTER BUTTON ---
        $this->start_controls_section('sec_footer', ['label' => 'Nút Xem tất cả (Footer)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('btn_text', [ 'label' => 'Chữ nút', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View All' ]);
        $this->add_control('btn_link', [ 'label' => 'Link nút', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#'] ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Tạo ID duy nhất cho mỗi widget để tránh xung đột nếu dùng nhiều widget trên 1 trang
        $widget_id = $this->get_id();
        ?>
        <section class="recent-news-section">
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
                        <button type="button" class="search-submit">Search</button>
                    </form>
                </div>

                <div class="news-grid" id="news-grid-<?php echo esc_attr($widget_id); ?>">
                    <?php if ( $settings['posts_list'] ) : foreach ( $settings['posts_list'] as $post ) : ?>
                        <div class="news-item-card js-news-item">
                            <div class="card-thumb">
                                <?php if(!empty($post['img']['url'])): ?>
                                    <img src="<?php echo esc_url($post['img']['url']); ?>" alt="News">
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="card-meta">
                                    <?php echo esc_html($post['date']); ?>
                                </div>
                                
                                <h3 class="card-title js-search-target">
                                    <a href="<?php echo esc_url($post['link']['url']); ?>"><?php echo esc_html($post['title']); ?></a>
                                </h3>
                                
                                <div class="card-desc js-search-target">
                                    <?php echo esc_html($post['desc']); ?>
                                </div>
                                
                                <a href="<?php echo esc_url($post['link']['url']); ?>" class="btn-card-full">
                                    <span class="icon-box">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 7 17 17 7 17"></polyline>
                                        </svg>
                                    </span>
                                    <?php echo esc_html($settings['card_btn_text']); ?>
                                </a>
                                
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
                
                <div id="no-results-<?php echo esc_attr($widget_id); ?>" style="display:none; text-align:center; width:100%; padding: 20px; color:#666;">
                    No results found.
                </div>

                <?php if(!empty($settings['btn_text'])): ?>
                <div class="news-bottom-action">
                    <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn-static-event">
                        <span class="icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="7" x2="17" y2="17"></line>
                                <polyline points="17 7 17 17 7 17"></polyline>
                            </svg>
                        </span>
                        <?php echo esc_html($settings['btn_text']); ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </section>

        <script>
        jQuery(document).ready(function($) {
            var inputID = '#news-search-<?php echo esc_js($widget_id); ?>';
            var gridID = '#news-grid-<?php echo esc_js($widget_id); ?>';
            var noResultID = '#no-results-<?php echo esc_js($widget_id); ?>';

            $(inputID).on('keyup', function() {
                var value = $(this).val().toLowerCase();
                var hasResult = false;

                $(gridID + ' .js-news-item').filter(function() {
                    // Lấy nội dung text của cả thẻ (Title + Desc)
                    var textContent = $(this).find('.js-search-target').text().toLowerCase();
                    var isMatch = textContent.indexOf(value) > -1;
                    
                    // Hiện/Ẩn thẻ
                    $(this).toggle(isMatch);
                    
                    if (isMatch) hasResult = true;
                });

                // Hiển thị thông báo nếu không tìm thấy gì
                if (!hasResult) {
                    $(noResultID).show();
                } else {
                    $(noResultID).hide();
                }
            });
            
            // Chặn Enter submit form
            $(inputID).on('keypress', function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
        </script>
        <?php
    }
}