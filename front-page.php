<?php get_header(); ?>

<?php
// Dữ liệu Slider (Bạn có thể thêm bao nhiêu slide tùy thích)
$hero_slides = [
    [
        'img'      => get_template_directory_uri() . '/assets/images/banner.png',
        'title'    => 'Empowering Through Education',
        'category' => 'Learning & Development',
        'desc'     => 'We create engaging educational experiences that inspire growth, foster creativity, and build the skills needed for tomorrow`s challenges.',
        'link'     => '/education',
        'btn_text' => 'About Us'
    ],
    [
        'img'      => get_template_directory_uri() . '/assets/images/banner-2.png',
        'title'    => 'Join Our Growing Community',
        'category' => 'Resources & Support',
        'desc'     => 'Access comprehensive resources, expert guidance, and dedicated support to achieve your goals and maximize your potential.',
        'link'     => '/technology',
        'btn_text' => 'View our Resouces' // <-- Chữ hiển thị cho Slide 2
    ],
    [
        'img'      => get_template_directory_uri() . '/assets/images/banner-3.png',
        'title'    => 'Advanced Technology Solutions',
        'category' => 'Smart Innovation',
        'desc'     => 'Experience next-generation technology solutions designed to optimize performance, enhance efficiency, and drive meaningful results.',
        'link'     => '/support',
        'btn_text' => 'Discover our Service' // <-- Chữ hiển thị cho Slide 3
    ]
];
?>
<main class="home-hero-section">
    <div class="container hero-container">
        
        <div class="hero-text-wrapper">
            <h1 class="hero-title">Innovating <br> Tomorrow, Today</h1>
            <div class="hero-bottom-info">
                <div class="hero-highlight">
                    <span class="highlight-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </span>
                    <h2 class="highlight-text">Technology & <br> Education Solutions</h2>
                </div>
                <p class="hero-desc">ONYX delivers cutting-edge solutions that transform industries and empower communities.</p>
            </div>
        </div>

        <div class="hero-slider-structure">
            
            <button class="hero-nav-btn prev" id="heroPrevBtn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>

            <div class="hero-viewport">
                <div class="hero-track">
                    
                    <?php foreach ($hero_slides as $slide) : ?>
                        <div class="hero-card">
                            <div class="card-img">
                                <img src="<?php echo esc_url($slide['img']); ?>" alt="<?php echo esc_attr($slide['title']); ?>">
                            </div>
                            <div class="card-content">
                                <h3 class="card-title"><?php echo esc_html($slide['title']); ?></h3>
                                <p class="card-category"><?php echo esc_html($slide['category']); ?></p>
                                <p class="card-desc"><?php echo esc_html($slide['desc']); ?></p>
                                
                                <a href="<?php echo esc_url($slide['link']); ?>" class="btn-card-action">
                                    <span class="btn-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                    </span>
                                    
                                    <?php echo esc_html($slide['btn_text']); ?>
                                
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <button class="hero-nav-btn next" id="heroNextBtn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>

        </div>

    </div>
</main>

<?php get_footer(); ?>