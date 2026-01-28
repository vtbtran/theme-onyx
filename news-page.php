<?php
/*
Template Name: News Page (Static UI)
*/
get_header();

// DỮ LIỆU GIẢ (DUMMY DATA) - Mô phỏng bài viết để lên giao diện
// 1. Bài nổi bật (Hero)
// $hero_post = [
//     'title' => 'ONYX Launches Revolutionary AI Camera System for Educational Institutions',
//     'date'  => 'March 10, 2024',
//     'read'  => '5 min read',
//     'desc'  => 'Our latest AI-powered camera system brings advanced security and learning analytics to schools worldwide, featuring real-time behavior analysis and automated attendance tracking.',
//     // Đảm bảo file ảnh này tồn tại trong thư mục assets/images theme của bạn
//     'img'   => get_template_directory_uri() . '/assets/images/news.png' 
// ];

// $recent_posts = [
//     [
//         'title' => 'Partnership with Global Education Network Expands STEM Reach',
//         'date' => 'March 8, 2024',
//         'desc' => 'ONYX partners with leading educational organizations to bring STEM programs to over 500 schools across 15 countries.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'AI Technology Wins Innovation Award at Tech Summit 2024',
//         'date' => 'March 5, 2024',
//         'desc' => 'Our AI camera technology receives recognition for outstanding innovation in educational technology at the annual Tech Summit.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'New STEM Curriculum Helps Students Excel in Robotics Competition',
//         'date' => 'March 1, 2024',
//         'desc' => 'Students using ONYX STEM curriculum achieve remarkable success in national robotics competition, showcasing the effectiveness of our programs.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'Quarterly Report: 200% Growth in AI Camera Deployments',
//         'date' => 'February 28, 2025',
//         'desc' => 'ONYX reports significant growth in AI camera installations across educational and commercial sectors in Q1 2024.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'Webinar Series: Future of AI in Education Attracts 10K+ Participants',
//         'date' => 'February 25, 2024',
//         'desc' => 'Our educational webinar series reaches milestone attendance, highlighting growing interest in AI-powered learning solutions.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'Research Study: AI Cameras Improve School Safety by 85%',
//         'date' => 'February 20, 2024',
//         'desc' => 'Independent research confirms significant safety improvements in schools using ONYX AI camera systems.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ]
// ];
?>
<?php
while ( have_posts() ) :
    the_post();
    
    the_content();

endwhile;
?>
<!-- <main class="news-page-wrapper">

    <section class="news-header-section">
        <div class="container">
            <h1 class="header-title">Latest News</h1>

            <div class="latest-news-card">
                <div class="latest-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-news.png" alt="Hero News">
                </div>
                <div class="latest-content">
                    <div class="meta-info">
                        <?php echo $hero_post['date']; ?> • <?php echo $hero_post['read']; ?>
                    </div>
                    <h2 class="latest-title">
                        <a href="#"><?php echo $hero_post['title']; ?></a>
                    </h2>
                    <div class="latest-excerpt">
                        <?php echo $hero_post['desc']; ?>
                    </div>
                    <a href="#" class="btn-dark-icon">
                        <span class="icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                        Read Full Article
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section class="recent-news-section">
        <div class="container">

            <div class="recent-header-row">
                <h2 class="section-title">Recent News</h2>

                <form role="search" method="get" class="news-search-form" action="#">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input type="search" class="search-field" placeholder="Search news articles..." value="" name="s">
                    <button type="submit" class="search-submit">Search</button>
                </form>
            </div>

            <div class="news-grid">
                <?php foreach ($recent_posts as $post) : ?>
                    <div class="news-item-card">
                        <div class="card-thumb">
                            <img src="<?php echo esc_url($post['img']); ?>" alt="<?php echo esc_attr($post['title']); ?>">
                        </div>
                        <div class="card-body">
                            <div class="card-meta">
                                <?php echo $post['date']; ?> • 3 min read
                            </div>
                            <h3 class="card-title">
                                <a href="#"><?php echo $post['title']; ?></a>
                            </h3>
                            <div class="card-desc">
                                <?php echo $post['desc']; ?>
                            </div>
                            <a href="#" class="btn-card-full">
                                <span class="icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Read More
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="news-bottom-action">
                <a href="#" class="btn-static-event">
                    <span class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="7" x2="17" y2="17"></line>
                            <polyline points="17 7 17 17 7 17"></polyline>
                        </svg>
                    </span>
                    View All
                </a>
            </div>

        </div> </section>


    <section class="newsletter-section">
        <div class="container newsletter-container">

            <div class="newsletter-content">
                <h2 class="nl-title">Get the latest news from ONYX</h2>
                <p class="nl-desc">Subscribe to our newsletter and be the first to know about our latest news, product launches, and industry insights.</p>

                <div class="nl-icon-wrapper">
                    <span class="highlight-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="newsletter-form-wrapper">
                <form class="newsletter-form" action="#">
                    <input type="email" class="nl-input" placeholder="Enter your email..." required>
                    <button type="submit" class="nl-submit-btn">Subscribe</button>
                </form>
            </div>

        </div>
    </section>

</main> -->

<?php get_footer(); ?>