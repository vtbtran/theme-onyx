<?php
if (! defined('ABSPATH')) exit;

class Onyx_News_Hero_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_news_hero';
    }
    public function get_title()
    {
        return 'Onyx: News Hero';
    }
    public function get_icon()
    {
        return 'eicon-post-list';
    }
    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('content_section', ['label' => 'Cấu hình bài viết', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('sec_title', [
            'label' => 'Tiêu đề Section',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Latest News'
        ]);

        // Cho phép chọn chuyên mục cụ thể
        $categories = get_categories();
        $options = ['0' => 'Tất cả chuyên mục'];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        $this->add_control('post_category', [
            'label' => 'Chọn chuyên mục',
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $options,
            'default' => '0',
        ]);

        $this->add_control('btn_text', [
            'label' => 'Chữ trên Nút',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Read Full Article',
            'separator' => 'before',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ];

        if ('0' !== $settings['post_category']) {
            $args['cat'] = $settings['post_category'];
        }

        $query = new \WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();

                $post_id = get_the_ID();
                $post_link = get_permalink();

                // --- 1. XỬ LÝ ẢNH ---
                $thumb_url = '';
                if (class_exists('Onyx_Editor_Database')) {
                    $onyx_article = Onyx_Editor_Database::get_article_by_post_id($post_id);
                    if ($onyx_article && !empty($onyx_article['hero_image'])) {
                        $hero_data = $onyx_article['hero_image'];
                        if (is_array($hero_data)) {
                            if (isset($hero_data['url'])) $thumb_url = $hero_data['url'];
                            elseif (isset($hero_data['src'])) $thumb_url = $hero_data['src'];
                        } elseif (is_string($hero_data)) {
                            $thumb_url = $hero_data;
                        }
                    }
                }
                if (empty($thumb_url)) {
                    $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'full') : \Elementor\Utils::get_placeholder_image_src();
                }

                // --- 2. TÍNH CONTENT ---
                $content = get_post_field('post_content', $post_id);
                $reading_time = ceil(str_word_count(strip_tags($content)) / 200);
                $excerpt = wp_trim_words(get_the_excerpt() ?: $content, 25, '...');

?>
                <section class="news-header-section">
                    <div class="container">
                        <h1 class="header-title"><?php echo esc_html($settings['sec_title']); ?></h1>

                        <div class="latest-news-card">
                            <div class="latest-img">
                                <a href="<?php echo esc_url($post_link); ?>">
                                    <img src="<?php echo esc_url($thumb_url); ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>"
                                        style="width:100%; height:100%; object-fit:cover; display:block; border-radius: 16px;">
                                </a>
                            </div>
                            <div class="latest-content">
                                <div class="meta-info">
                                    <?php echo get_the_date('F j, Y'); ?> • <?php echo $reading_time; ?> min read
                                </div>

                                <h2 class="latest-title">
                                    <a href="<?php echo esc_url($post_link); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="latest-excerpt">
                                    <?php echo $excerpt; ?>
                                </div>

                                <?php if (! empty($settings['btn_text'])) : ?>
                                    <a href="<?php echo esc_url($post_link); ?>" class="btn-dark-icon">
                                        <span class="icon-box">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                                <polyline points="7 7 17 7 17 17"></polyline>
                                            </svg>
                                        </span>
                                        <?php echo esc_html($settings['btn_text']); ?>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </section>
<?php
            endwhile;
            wp_reset_postdata();
        endif;
    }
}
