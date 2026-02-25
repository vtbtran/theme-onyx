<?php
if (! defined('ABSPATH')) exit;

class Onyx_Resource_Library_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'onyx_resource_library';
    }
    public function get_title()
    {
        return 'Onyx: Resource Library';
    }
    public function get_icon()
    {
        return 'eicon-search';
    }
    public function get_categories()
    {
        return ['general'];
    }

protected function _register_controls()
    {

        // --- TAB 1: HERO SECTION ---
        $this->start_controls_section('sec_hero', ['label' => 'Hero & Search Section', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('hero_title', ['label' => 'Hero Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Learning Resources']);
        $this->add_control('hero_subtitle', ['label' => 'Hero Description', 'type' => \Elementor\Controls_Manager::WYSIWYG, 'default' => '<b>Access our comprehensive library...</b>']);
        $this->add_control('search_placeholder', ['label' => 'Search Placeholder', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Search Resources']);

        $repeater_filters = new \Elementor\Repeater();
        $repeater_filters->add_control('filter_label', ['label' => 'Button Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Technology']);
        $repeater_filters->add_control('filter_slug', ['label' => 'Filter Slug', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'tech']);
        $this->add_control('filters_list', ['label' => 'Filters List', 'type' => \Elementor\Controls_Manager::REPEATER, 'fields' => $repeater_filters->get_controls(), 'default' => [['filter_label' => 'Technology', 'filter_slug' => 'technology']], 'title_field' => '{{{ filter_label }}}']);
        $this->end_controls_section();

        // --- TAB 2: RESOURCE GRID ---
        $this->start_controls_section('sec_grid', ['label' => 'Resources List', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('grid_heading', ['label' => 'Grid Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Featured Resources']);

        $repeater_items = new \Elementor\Repeater();
        $repeater_items->add_control('res_img', ['label' => 'Cover Image', 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);
        $repeater_items->add_control('res_cat_slug', ['label' => 'Filter Slug', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'technology']);
        $repeater_items->add_control('res_cat_label', ['label' => 'Tag Label', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Technology']);
        $repeater_items->add_control('res_type', ['label' => 'File Type (Right Corner)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Guide']);
        $repeater_items->add_control('res_title', ['label' => 'Resource Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'AI Camera Setup Guide']);
        $repeater_items->add_control('res_desc', ['label' => 'Short Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Complete step-by-step guide...']);
        $repeater_items->add_control('res_file_info', ['label' => 'File Information', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'PDF • 2.5 MB']);

        // --- UPGRADE: BUTTON TEXT CONTROL ---
        $repeater_items->add_control('res_btn_text', [
            'label' => 'Button Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Download', 
            'placeholder' => 'e.g., Download, View Now...'
        ]);

        $repeater_items->add_control('res_link', ['label' => 'Download Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);

        $this->add_control('items_list', [
            'label' => 'Resource Cards',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater_items->get_controls(),
            'default' => [
                ['res_title' => 'AI Camera Guide', 'res_btn_text' => 'Download'],
            ],
            'title_field' => '{{{ res_title }}}',
        ]);

        $this->add_control('view_news_text', ['label' => 'Bottom Button Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View News']);
        $this->add_control('view_news_link', ['label' => 'Bottom Button Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $unique_id = $this->get_id();
?>
        <div class="onyx-resource-library-wrapper" id="onyx-res-<?php echo esc_attr($unique_id); ?>">

            <section class="res-hero-section">
                <div class="container">
                    <div class="res-hero-content">
                        <h1 class="res-title"><?php echo esc_html($settings['hero_title']); ?></h1>
                        <p class="res-subtitle"><?php echo $settings['hero_subtitle']; ?></p>
                        <div class="res-search-box">
                            <span class="search-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg></span>
                            <input type="text" placeholder="<?php echo esc_attr($settings['search_placeholder']); ?>" class="search-input" id="search-input-<?php echo esc_attr($unique_id); ?>" onkeypress="onyxCheckEnter(event, '<?php echo esc_attr($unique_id); ?>')">
                            <button class="btn-search" onclick="onyxRunFilter('<?php echo esc_attr($unique_id); ?>')">Search</button>
                        </div>
                        <div class="res-tags">
                            <button class="tag-btn active" data-filter="all" onclick="onyxSetFilter('<?php echo esc_attr($unique_id); ?>', 'all', this)">All</button>
                            <?php if ($settings['filters_list']) : foreach ($settings['filters_list'] as $filter) : ?>
                                    <button class="tag-btn" data-filter="<?php echo esc_attr($filter['filter_slug']); ?>" onclick="onyxSetFilter('<?php echo esc_attr($unique_id); ?>', '<?php echo esc_attr($filter['filter_slug']); ?>', this)"><?php echo esc_html($filter['filter_label']); ?></button>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="res-featured-section">
                <div class="container">
                    <h2 class="section-heading"><?php echo esc_html($settings['grid_heading']); ?></h2>
                    <div class="res-grid" id="res-grid-<?php echo esc_attr($unique_id); ?>">
                        <?php if ($settings['items_list']) : foreach ($settings['items_list'] as $item) :
                                $search_string = $item['res_title'] . ' ' . $item['res_desc'];
                                $search_string = function_exists('mb_strtolower') ? mb_strtolower($search_string, 'UTF-8') : strtolower($search_string);
                        ?>
                                <div class="res-card" data-cat="<?php echo esc_attr(strtolower($item['res_cat_slug'])); ?>" data-search="<?php echo esc_attr($search_string); ?>">
                                    <div class="res-img-box">
                                        <?php if (!empty($item['res_img']['url'])): ?><img src="<?php echo esc_url($item['res_img']['url']); ?>" alt="Resource"><?php endif; ?>
                                        <span class="res-tag yellow"><?php echo esc_html($item['res_cat_label']); ?></span>
                                        <span class="res-type"><?php echo esc_html($item['res_type']); ?></span>
                                    </div>
                                    <div class="res-body">
                                        <h3 class="res-card-title"><?php echo esc_html($item['res_title']); ?></h3>
                                        <p class="res-card-desc"><?php echo esc_html($item['res_desc']); ?></p>
                                        <div class="res-footer">
                                            <span class="file-info"><?php echo esc_html($item['res_file_info']); ?></span>

                                            <a href="<?php echo esc_url($item['res_link']['url']); ?>" class="btn-download">
                                                <span class="icon-box-dark-sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                                        <polyline points="17 7 17 17 7 17"></polyline>
                                                    </svg></span>

                                                <?php echo esc_html($item['res_btn_text']); ?>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                        <div class="no-res-msg" style="display:none; grid-column: 1/-1; text-align: center; color: #666; padding: 40px;">
                            <h3>No resources found.</h3>
                        </div>
                    </div>
                    <?php if (!empty($settings['view_news_text'])): ?>
                        <div class="res-view-news-wrap">
                            <a href="<?php echo esc_url($settings['view_news_link']['url']); ?>" class="btn-view-news"><span class="icon-box-square-white"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg></span><?php echo esc_html($settings['view_news_text']); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <script>
            if (typeof onyxRunFilter !== 'function') {
                function onyxRunFilter(uid) {
                    var input = document.getElementById('search-input-' + uid);
                    var filterValue = input.value.toLowerCase().trim();
                    var activeTag = document.querySelector('#onyx-res-' + uid + ' .tag-btn.active');
                    var catValue = activeTag ? activeTag.getAttribute('data-filter') : 'all';
                    var grid = document.getElementById('res-grid-' + uid);
                    var cards = grid.getElementsByClassName('res-card');
                    var noMsg = grid.querySelector('.no-res-msg');
                    var count = 0;
                    for (var i = 0; i < cards.length; i++) {
                        var card = cards[i];
                        var cardCat = card.getAttribute('data-cat');
                        var cardSearch = card.getAttribute('data-search');
                        var matchCat = (catValue === 'all') || (cardCat && cardCat.includes(catValue));
                        var matchSearch = (filterValue === '') || (cardSearch && cardSearch.includes(filterValue));
                        if (matchCat && matchSearch) {
                            card.style.display = 'flex';
                            count++;
                        } else {
                            card.style.display = 'none';
                        }
                    }
                    if (count === 0) noMsg.style.display = 'block';
                    else noMsg.style.display = 'none';
                }

                function onyxSetFilter(uid, slug, btn) {
                    var buttons = document.querySelectorAll('#onyx-res-' + uid + ' .tag-btn');
                    buttons.forEach(function(b) {
                        b.classList.remove('active');
                    });
                    btn.classList.add('active');
                    onyxRunFilter(uid);
                }

                function onyxCheckEnter(e, uid) {
                    if (e.keyCode === 13) {
                        onyxRunFilter(uid);
                    }
                }
            }
        </script>
<?php
    }
}
