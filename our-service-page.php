<?php
/*
Template Name: Our Service Page
*/
get_header();
?>
<?php
while ( have_posts() ) :
    the_post();
    
    // ĐÂY LÀ CHÌA KHÓA ĐỂ ELEMENTOR CHẠY
    the_content();

endwhile;
?>

<!-- <main id="main-content">

    <section class="service-section">
        <div class="container">

            <div class="section-header">
                <h1 class="section-title">Our Service</h1>
            </div>

            <div class="service-grid">

                <div class="service-card">
                    <div class="card-image-box">
                         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service.png" alt="Resource">
                        <span class="card-tag">Technology</span>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">AI Camera Integration</h3>
                        <p class="card-desc">Complete AI camera system setup and integration for businesses and institutions.</p>
                        <ul class="card-features">
                            <li>Custom Installation</li>
                            <li>System Configuration</li>
                            <li>Staff Training</li>
                            <li>24/7 Support</li>
                        </ul>

                        <div class="card-footer">
                            <div class="price-info">
                                <span class="price">Starting at $2,999</span>
                                <span class="duration">2-4 weeks</span>
                            </div>
                            <a href="#" class="btn-learn-more">
                                <span class="icon-box-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service (1).png" alt="Resource">
                       
                        <span class="card-tag tag-yellow">Education</span>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">STEM Education Kit</h3>
                        <p class="card-desc">Comprehensive learning package for students to explore science, technology.</p>
                        <ul class="card-features">
                            <li>Custom Curriculum</li>
                            <li>Teacher Training</li>
                            <li>Learning Materials</li>
                            <li>Progress Tracking</li>
                        </ul>
                        <div class="card-footer">
                            <div class="price-info">
                                <span class="price">Starting at $2,999</span>
                                <span class="duration">2-4 weeks</span>
                            </div>
                            <a href="#" class="btn-learn-more">
                                <span class="icon-box-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service (2).png" alt="Resource">
                       
                        <span class="card-tag">Consulting</span>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Smart Home Security</h3>
                        <p class="card-desc">Complete home security solution with AI-powered monitoring and mobile app.</p>
                        <ul class="card-features">
                            <li>Multi-Camera Setup</li>
                            <li>Mobile App Control</li>
                            <li>24/7 Monitoring</li>
                            <li>Smart Alerts</li>
                        </ul>
                        <div class="card-footer">
                            <div class="price-info">
                                <span class="price">Starting at $2,999</span>
                                <span class="duration">2-4 weeks</span>
                            </div>
                            <a href="#" class="btn-learn-more">
                                <span class="icon-box-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service (3).png" alt="Resource">
                       
                        <span class="card-tag">Technology</span>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">AI Camera Integration</h3>
                        <p class="card-desc">Complete AI camera system setup and integration for businesses.</p>
                        <ul class="card-features">
                            <li>Custom Installation</li>
                            <li>System Configuration</li>
                            <li>Staff Training</li>
                            <li>24/7 Support</li>
                        </ul>
                        <div class="card-footer">
                            <div class="price-info">
                                <span class="price">Starting at $2,999</span>
                                <span class="duration">2-4 weeks</span>
                            </div>
                            <a href="#" class="btn-learn-more">
                                <span class="icon-box-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service(4).png" alt="Resource">
                       
                        <span class="card-tag">Consulting</span>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Technical Consulting</h3>
                        <p class="card-desc">Tailored STEM education programs designed for schools.</p>
                        <ul class="card-features">
                            <li>Custom Curriculum</li>
                            <li>Teacher Training</li>
                            <li>Learning Materials</li>
                            <li>Progress Tracking</li>
                        </ul>
                        <div class="card-footer">
                            <div class="price-info">
                                <span class="price">Starting at $2,999</span>
                                <span class="duration">2-4 weeks</span>
                            </div>
                            <a href="#" class="btn-learn-more">
                                <span class="icon-box-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

                <div class="service-card">
                    <div class="card-image-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service (5).png" alt="Resource">
                       
                        <span class="card-tag">Training</span>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Training & Workshops</h3>
                        <p class="card-desc">Complete AI camera system setup and integration for businesses.</p>
                        <ul class="card-features">
                            <li>Custom Installation</li>
                            <li>System Configuration</li>
                            <li>Staff Training</li>
                            <li>24/7 Support</li>
                        </ul>
                        <div class="card-footer">
                            <div class="price-info">
                                <span class="price">Starting at $2,999</span>
                                <span class="duration">2-4 weeks</span>
                            </div>
                            <a href="#" class="btn-learn-more">
                                <span class="icon-box-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bottom-action-left">
                <div class="bottom-action-left">
                    <a href="/products" class="btn-view-product">
                        <span class="icon-box-lg">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="7" x2="17" y2="17"></line>
                                <polyline points="17 7 17 17 7 17"></polyline>
                            </svg>
                        </span>
                        View Product
                    </a>
                </div>
            </div>

        </div>
    </section>
    <section class="product-section">
        <div class="container-fluid">

            <h2 class="section-title-center light-text">Product</h2>

            <div class="product-slider-outer">

                <button class="slider-nav-outside prev" aria-label="Previous">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>

                <div class="slider-viewport">
                    <div class="product-track">

                        <div class="product-card">
                            <div class="prod-img-placeholder">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service.png" alt="Product" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <div class="prod-body">
                                <h3 class="prod-title">AI Smart Camera Pro</h3>
                                <p class="prod-desc">Advanced AI-powered surveillance camera with real-time object detection.</p>
                                <ul class="prod-specs">
                                    <li>4K Ultra HD Recording</li>
                                    <li>AI Object Detection</li>
                                    <li>Night Vision</li>
                                </ul>
                                <a href="#" class="btn-buy-now">
                                    <span class="icon-box-dark">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 7 17 17 7 17"></polyline>
                                        </svg>
                                    </span>
                                    Buy now
                                </a>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="prod-img-placeholder">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service (2).png" alt="Product" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <div class="prod-body">
                                <h3 class="prod-title">STEM Education Kit</h3>
                                <p class="prod-desc">Comprehensive learning package for students to explore science & engineering.</p>
                                <ul class="prod-specs">
                                    <li>Robotics Components</li>
                                    <li>Programming Tutorials</li>
                                    <li>Project Guides</li>
                                </ul>
                                <a href="#" class="btn-buy-now">
                                    <span class="icon-box-dark">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 7 17 17 7 17"></polyline>
                                        </svg>
                                    </span>
                                    Buy now
                                </a>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="prod-img-placeholder">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service (3).png" alt="Product" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <div class="prod-body">
                                <h3 class="prod-title">Smart Home Security System</h3>
                                <p class="prod-desc">Complete home security solution with AI-powered monitoring and mobile app.</p>
                                <ul class="prod-specs">
                                    <li>Multi-Camera Setup</li>
                                    <li>Mobile App Control</li>
                                    <li>24/7 Monitoring</li>
                                </ul>
                                <a href="#" class="btn-buy-now">
                                    <span class="icon-box-dark">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 7 17 17 7 17"></polyline>
                                        </svg>
                                    </span>
                                    Buy now
                                </a>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="prod-img-placeholder">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Our Service(4).png" alt="Product" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <div class="prod-body">
                                <h3 class="prod-title">Smart Home System</h3>
                                <p class="prod-desc">Complete home security solution with AI-powered monitoring and mobile app.</p>
                                <ul class="prod-specs">
                                    <li>Multi-Camera Setup</li>
                                    <li>Mobile App Control</li>
                                    <li>24/7 Monitoring</li>
                                </ul>
                                <a href="#" class="btn-buy-now">
                                    <span class="icon-box-dark">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="7" x2="17" y2="17"></line>
                                            <polyline points="17 7 17 17 7 17"></polyline>
                                        </svg>
                                    </span>
                                    Buy now
                                </a>
                            </div>
                        </div>

                    </div>
                </div> <button class="slider-nav-outside next" aria-label="Next">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

            </div>
            <div class="view-process-btn-wrapper">
                <a href="#process" class="btn-view-process">
                    <span class="icon-box-square">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="7" x2="17" y2="17"></line>
                            <polyline points="17 7 17 17 7 17"></polyline>
                        </svg>
                    </span>
                    View our Process
                </a>
            </div>

        </div>
    </section>

    <section class="process-section" id="process">
        <div class="container">
            <h2 class="section-title-center dark-text">Our Process</h2>

            <div class="process-list">

                <div class="process-item">
                    <div class="proc-header">
                        <span class="proc-num">001</span>
                        <h3 class="proc-name">CONSULTATION</h3>
                    </div>
                    <div class="proc-body">
                        <p>We start with a detailed consultation to understand your specific needs and requirements.</p>
                    </div>
                    <div class="proc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="process-item">
                    <div class="proc-header">
                        <span class="proc-num">002</span>
                        <h3 class="proc-name">PLANNING</h3>
                    </div>
                    <div class="proc-body">
                        <p>Our team develops a customized plan tailored to your goals and timeline.</p>
                    </div>
                    <div class="proc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="process-item">
                    <div class="proc-header">
                        <span class="proc-num">003</span>
                        <h3 class="proc-name">IMPLEMENTATION</h3>
                    </div>
                    <div class="proc-body">
                        <p>We execute the plan with precision, keeping you informed throughout the process.</p>
                    </div>
                    <div class="proc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                </div>

                <div class="process-item">
                    <div class="proc-header">
                        <span class="proc-num">004</span>
                        <h3 class="proc-name">SUPPORT</h3>
                    </div>
                    <div class="proc-body">
                        <p>Ongoing support and maintenance to ensure your continued success.</p>
                    </div>
                    <div class="proc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main> -->

<?php get_footer(); ?>