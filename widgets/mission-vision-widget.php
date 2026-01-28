    <?php
    if (! defined('ABSPATH')) exit;

    class Onyx_Mission_Vision_Widget extends \Elementor\Widget_Base
    {

        public function get_name()
        {
            return 'onyx_mission_vision';
        }
        public function get_title()
        {
            return 'Onyx: Mission & Vision';
        }
        public function get_icon()
        {
            return 'eicon-banner';
        }
        public function get_categories()
        {
            return ['general'];
        }

        protected function _register_controls()
        {

            // --- TAB 1: DANH SÁCH THẺ (REPEATER) ---
            $this->start_controls_section('section_cards', ['label' => 'Các thẻ (Mission/Vision)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control('card_title', [
                'label' => 'Tiêu đề',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Mission'
            ]);

            $repeater->add_control('card_desc', [
                'label' => 'Mô tả',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'To democratize access...'
            ]);

            $this->add_control('cards_list', [
                'label' => 'Danh sách thẻ',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'card_title' => 'Our Mission',
                        'card_desc' => 'To democratize access to advanced technology and quality education, empowering individuals and organizations to achieve their full potential through innovative AI solutions and comprehensive STEM learning programs.'
                    ],
                    [
                        'card_title' => 'Our Vision',
                        'card_desc' => 'To be the global leader in AI-powered educational technology, creating a world where advanced technology is accessible to all, and every learner has the tools they need to succeed in the digital age.'
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]);

            $this->end_controls_section();

            // --- TAB 2: NÚT BẤM DƯỚI CÙNG ---
            $this->start_controls_section('section_button', ['label' => 'Nút bấm (Core Values)', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

            $this->add_control('btn_text', [
                'label' => 'Chữ trên nút',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Core Values'
            ]);

            $this->add_control('btn_link', [
                'label' => 'Link nút',
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#']
            ]);

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();
    ?>
            <section class="mission-vision-section">
                <div class="container mission-container">

                    <div class="mission-grid">
                        <?php if ($settings['cards_list']) : foreach ($settings['cards_list'] as $item) : ?>

                                <div class="mv-card animate-on-scroll delay-100">
                                    <div class="mv-icon-top">
                                        <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.8844 8.85139L8.18517 6.78241L11.8844 4.71343C12.1912 4.54183 12.2996 4.14689 12.1246 3.83815L11.6178 2.94423C11.4428 2.63549 11.0528 2.5336 10.7535 2.71842L7.14467 4.94687L7.23506 0.649468C7.24255 0.293048 6.96094 0 6.61089 0H5.59744C5.24742 0 4.96578 0.293048 4.9733 0.649468L5.06367 4.94687L1.45482 2.71845C1.15552 2.53363 0.765511 2.63552 0.590499 2.94425L0.0837745 3.83818C-0.0912379 4.14691 0.0171303 4.54185 0.323948 4.71346L4.02316 6.78241L0.323922 8.85139C0.0171043 9.02299 -0.0912639 9.41793 0.0837745 9.72666L0.590499 10.6206C0.765511 10.9293 1.15552 11.0312 1.45482 10.8464L5.06367 8.61795L4.97327 12.9153C4.96578 13.2718 5.24742 13.5648 5.59744 13.5648H6.61092C6.96094 13.5648 7.24258 13.2718 7.23509 12.9153L7.14467 8.61795L10.7535 10.8464C11.0528 11.0312 11.4428 10.9293 11.6178 10.6206L12.1246 9.72663C12.2996 9.4179 12.1912 9.02299 11.8844 8.85139Z" fill="#4E89E8" />
                                        </svg>

                                    </div>

                                    <h3 class="mv-title"><?php echo esc_html($item['card_title']); ?></h3>

                                    <p class="mv-desc"><?php echo esc_html($item['card_desc']); ?></p>

                                    <div class="mv-icon-bottom">
                                        <?php if (! empty($item['card_icon']['url'])) : ?>
                                            <img src="<?php echo esc_url($item['card_icon']['url']); ?>" alt="Icon" class="star-icon">
                                        <?php endif; ?>
                                    </div>
                                </div>

                        <?php endforeach;
                        endif; ?>
                    </div>

                    <?php if (! empty($settings['btn_text'])) : ?>
                        <div class="mv-action-wrapper animate-on-scroll delay-400">
                            <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="btn-core-values">
                                <span class="icon-box">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="17" x2="17" y2="7"></line>
                                        <polyline points="7 7 17 7 17 17"></polyline>
                                    </svg>
                                </span>
                                <?php echo esc_html($settings['btn_text']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
    <?php
        }
    }
