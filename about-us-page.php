<?php
/* Template Name: About us */
get_header();
?>
<?php
while ( have_posts() ) :
    the_post();
    
    // ĐÂY LÀ CHÌA KHÓA ĐỂ ELEMENTOR CHẠY
    the_content();

endwhile;
?>
<!-- <section class="about-us-section">
    <div class="container about-container">

        <div class="about-content animate-on-scroll">
            <h2 class="about-title">About Us</h2>
            <div class="about-desc">
                <strong>Pioneering Mission in Technology & Education.</strong> We connect advanced AI technology with STEM education, creating innovative solutions for the future.
            </div>

            <div class="about-decor-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="7" y1="17" x2="17" y2="7"></line>
                    <polyline points="7 7 17 7 17 17"></polyline>
                </svg>
            </div>

            <a href="#" class="btn-about-action">
                <span class="icon-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="7" y1="17" x2="17" y2="7"></line>
                        <polyline points="7 7 17 7 17 17"></polyline>
                    </svg>
                </span>
                Meet Our Leader Team
            </a>
        </div>

        <div class="about-stats-grid">

            <div class="stat-card animate-on-scroll delay-100">
                <div class="stat-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="stat-number">50K+</div>
                <div class="stat-label">Students Educated</div>
            </div>

            <div class="stat-card animate-on-scroll delay-100">
                <div class="stat-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18" />
                        <path d="M5 21V7l8-4 8 4v14" />
                        <path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5" />
                        <circle cx="13" cy="9" r="2" />
                    </svg>
                </div>
                <div class="stat-number">200+</div>
                <div class="stat-label">Schools Partnered</div>
            </div>

            <div class="stat-card animate-on-scroll delay-100">
                <div class="stat-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                </div>
                <div class="stat-number">15+</div>
                <div class="stat-label">Countries Served</div>
            </div>

            <div class="stat-card animate-on-scroll delay-100">
                <div class="stat-icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                </div>
                <div class="stat-number">98%</div>
                <div class="stat-label">Customer Satisfaction</div>
            </div>

        </div>

    </div>
</section>
<section class="mission-vision-section">
    <div class="container mission-container">

       <div class="mission-grid">

            <div class="mv-card animate-on-scroll delay-100">
                <div class="mv-icon-top">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Vector-start.png" alt="Star Icon" class="star-icon">
                </div>
                <h3 class="mv-title">Our Mission</h3>
                <p class="mv-desc">
                    To democratize access to advanced technology and quality education, empowering individuals and organizations to achieve their full potential through innovative AI solutions and comprehensive STEM learning programs.
                </p>
                <div class="mv-icon-bottom">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Vector-start.png" alt="Star Icon" class="star-icon">
                </div>
            </div>

            <div class="mv-card animate-on-scroll delay-100">
                <div class="mv-icon-top">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Vector-start.png" alt="Star Icon" class="star-icon">
                </div>
                <h3 class="mv-title">Our Vision</h3>
                <p class="mv-desc">
                    To be the global leader in AI-powered educational technology, creating a world where advanced technology is accessible to all, and every learner has the tools they need to succeed in the digital age.
                </p>
                <div class="mv-icon-bottom">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Vector-start.png" alt="Star Icon" class="star-icon">
                </div>
            </div>

        </div>

        <div class="mv-action-wrapper animate-on-scroll delay-400">
            <a href="#" class="btn-core-values">
                <span class="icon-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="7" y1="17" x2="17" y2="7"></line>
                        <polyline points="7 7 17 7 17 17"></polyline>
                    </svg>
                </span>
                Our Core Values
            </a>
        </div>

    </div>
</section>

<section class="core-values-section">
    <div class="container values-container">
        <h2 class="values-heading">Our Core Values</h2>

        <div class="values-grid">

            <div class="value-card animate-on-scroll delay-100">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm2.85 11.1l-.85.6V16h-4v-2.3l-.85-.6A6.97 6.97 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.8 3.16-2.15 4.1z"></path>
                        <path d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1z"></path>
                    </svg>
                </div>
                <h3 class="value-title">Innovation</h3>
                <p class="value-desc">We constantly push the boundaries of technology to create solutions that make a real difference.</p>
            </div>

            <div class="value-card animate-on-scroll delay-100">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"></path>
                    </svg>
                </div>
                <h3 class="value-title">Education</h3>
                <p class="value-desc">We believe in empowering the next generation through accessible, engaging STEM education.</p>
            </div>

            <div class="value-card animate-on-scroll delay-100">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                    </svg>
                </div>
                <h3 class="value-title">Quality</h3>
                <p class="value-desc">Every product we create meets the highest standards of reliability and performance.</p>
            </div>

            <div class="value-card animate-on-scroll delay-100">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16.5 13c-1.2 0-3.07.34-4.5 1-1.43-.67-3.3-1-4.5-1C5.33 13 1 14.08 1 16.25V19h22v-2.75c0-2.17-4.33-3.25-6.5-3.25zm-4 4.5h-10v-1.25c0-.54 2.56-1.75 5-1.75s5 1.21 5 1.75v1.25zm9 0H14v-1.25c0-.46-2.06-1.63-4.5-1.74 1.83-.98 4.77-.99 6.79.02.76.38 1.21.92 1.21 1.72v1.25zM7.5 12c1.93 0 3.5-1.57 3.5-3.5S9.43 5 7.5 5 4 6.57 4 8.5 5.57 12 7.5 12zm0-5.5c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 5.5c1.93 0 3.5-1.57 3.5-3.5S18.43 5 16.5 5 13 6.57 13 8.5s1.57 3.5 3.5 3.5zm0-5.5c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"></path>
                    </svg>
                </div>
                <h3 class="value-title">Community</h3>
                <p class="value-desc">We build lasting relationships with our customers, partners, and the communities we serve.</p>
            </div>

        </div>
    </div>
</section> -->


<?php get_footer(); ?>