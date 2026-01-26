<?php
/*
Template Name: Resources Page
*/
get_header();
?>
<div class="resources-page-wrapper">
    <section class="res-hero-section">
        <div class="container">
            <div class="res-hero-content">
                <h1 class="res-title">Learning Resources</h1>
                <p class="res-subtitle"> <b>Access our comprehensive library of guides, templates, whitepapers, and training materials</b> to help you succeed with ONYX products and services.</p>
                <div class="res-search-box">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search Resources" class="search-input">
                    <button class="btn-search">Search</button>
                </div>
                <div class="res-tags">
                    <button class="tag-btn active">All</button>
                    <button class="tag-btn">Technology</button>
                    <button class="tag-btn">Education</button>
                    <button class="tag-btn">Training</button>
                    <button class="tag-btn">Documentation</button>
                </div>
            </div>
        </div>
    </section>

    <section class="res-featured-section">
        <div class="container">
            <h2 class="section-heading">Featured Resources</h2>

            <div class="res-grid">

                <div class="res-card">
                    <div class="res-img-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resource-1.jpg" alt="Resource">
                        <span class="res-tag yellow">Technology</span>
                        <span class="res-type">Guide</span>
                    </div>
                    <div class="res-body">
                        <h3 class="res-card-title">AI Camera Setup Guide</h3>
                        <p class="res-card-desc">Complete step-by-step guide for installing and configuring AI cameras in various environments.</p>
                        <div class="res-footer">
                            <span class="file-info">PDF • 2.5 MB</span>
                            <a href="#" class="btn-download">
                                <span class="icon-box-dark-sm">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg>
                                </span>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="res-card">
                    <div class="res-img-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resource-2.jpg" alt="Resource">
                        <span class="res-tag yellow">Education</span>
                        <span class="res-type">Template</span>
                    </div>
                    <div class="res-body">
                        <h3 class="res-card-title">STEM Curriculum Templates</h3>
                        <p class="res-card-desc">Ready-to-use curriculum templates for different grade levels and STEM subjects.</p>
                        <div class="res-footer">
                            <span class="file-info">ZIP • 15.2 MB</span>
                            <a href="#" class="btn-download">
                                <span class="icon-box-dark-sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg></span>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="res-card">
                    <div class="res-img-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resource-3.jpg" alt="Resource">
                        <span class="res-tag yellow">Documentation</span>
                        <span class="res-type">Whitepaper</span>
                    </div>
                    <div class="res-body">
                        <h3 class="res-card-title">AI Tech & Security</h3>
                        <p class="res-card-desc">In-depth analysis of current AI trends and their applications in education and security.</p>
                        <div class="res-footer">
                            <span class="file-info">PDF • 3.8 MB</span>
                            <a href="#" class="btn-download">
                                <span class="icon-box-dark-sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg></span>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="res-card">
                    <div class="res-img-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resource-4.jpg" alt="Resource">
                        <span class="res-tag yellow">Technology</span>
                        <span class="res-type">Guide</span>
                    </div>
                    <div class="res-body">
                        <h3 class="res-card-title">Artificial Intelligence Guide</h3>
                        <p class="res-card-desc">Complete step-by-step guide for installing and configuring AI cameras in various environments.</p>
                        <div class="res-footer">
                            <span class="file-info">PDF • 2.5 MB</span>
                            <a href="#" class="btn-download">
                                <span class="icon-box-dark-sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg></span>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="res-card">
                    <div class="res-img-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resource-5.jpg" alt="Resource">
                        <span class="res-tag yellow">Education</span>
                        <span class="res-type">Template</span>
                    </div>
                    <div class="res-body">
                        <h3 class="res-card-title">Introduction to STEM</h3>
                        <p class="res-card-desc">Ready-to-use curriculum templates for different grade levels and STEM subjects.</p>
                        <div class="res-footer">
                            <span class="file-info">ZIP • 15.2 MB</span>
                            <a href="#" class="btn-download">
                                <span class="icon-box-dark-sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg></span>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="res-card">
                    <div class="res-img-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resource-6.jpg" alt="Resource">
                        <span class="res-tag yellow">Documentation</span>
                        <span class="res-type">Whitepaper</span>
                    </div>
                    <div class="res-body">
                        <h3 class="res-card-title">Group Project Presentation</h3>
                        <p class="res-card-desc">Complete step-by-step guide for installing and configuring AI cameras in various environments.</p>
                        <div class="res-footer">
                            <span class="file-info">PDF • 2.5 MB</span>
                            <a href="#" class="btn-download">
                                <span class="icon-box-dark-sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="7" x2="17" y2="17"></line>
                                        <polyline points="17 7 17 17 7 17"></polyline>
                                    </svg></span>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="res-view-news-wrap">
                <a href="#" class="btn-view-news">
                    <span class="icon-box-square-white">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="7" x2="17" y2="17"></line>
                            <polyline points="17 7 17 17 7 17"></polyline>
                        </svg>
                    </span>
                    View News
                </a>
            </div>
        </div>
    </section>

    <section class="res-webinar-section">
        <div class="container">
            <h2 class="section-title-center light-text">Webinars & News</h2>

            <div class="webinar-grid">

                <div class="webinar-card">
                    <span class="webinar-tag">Upcoming</span>
                    <h3 class="webinar-title">Future of AI in Education</h3>
                    <div class="webinar-meta">
                        <p>March 15, 2024 at 2:00 PM EST</p>
                        <p>Speaker: Dr. Sarah Chen</p>
                    </div>
                    <a href="#" class="btn-webinar">Register Now</a>
                </div>

                <div class="webinar-card">
                    <span class="webinar-tag">Recorded</span>
                    <h3 class="webinar-title">Smart Camera Implementation Best Practices</h3>
                    <div class="webinar-meta">
                        <p>February 28, 2024 at 3:00 PM EST</p>
                        <p>Speaker: Michael Rodriguez</p>
                    </div>
                    <a href="#" class="btn-webinar dark">Watch Recording</a>
                </div>

                <div class="webinar-card">
                    <span class="webinar-tag">Recorded</span>
                    <h3 class="webinar-title">STEM Curriculum Innovation Workshop</h3>
                    <div class="webinar-meta">
                        <p>February 14, 2024 at 1:00 PM EST</p>
                        <p>Speaker: Dr. Emily Wong</p>
                    </div>
                    <a href="#" class="btn-webinar dark">Watch Recording</a>
                </div>

            </div>

            <div class="webinar-read-more-wrap">
                <a href="#" class="btn-read-more-white">Read more</a>
            </div>
        </div>
    </section>
    <section class="res-faq-section">
        <div class="container">
            <h2 class="section-title-center">Frequently Asked Questions</h2>

            <div class="faq-list">
                <div class="faq-item">
                    <h3 class="faq-question">HOW DO I ACCESS PREMIUM RESOURCES ?</h3>
                    <p class="faq-answer">Premium resources are available to customers with active support contracts. Contact our sales team to upgrade your access level.</p>
                    <span class="faq-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </span>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">ARE THE RESOURCES REGULARLY UPDATED?</h3>
                    <p class="faq-answer">Yes, we update our resources quarterly and add new content based on customer feedback and product updates.</p>
                    <span class="faq-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </span>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">CAN I REQUEST SPECIFIC RESOURCES?</h3>
                    <p class="faq-answer">We welcome resource requests from our community. Please contact our support team with your specific needs.</p>
                    <span class="faq-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="res-contact-section">
        <div class="container">
            <h2 class="contact-title">More questions? Send them to us</h2>

            <form class="res-contact-form" action="#" method="POST">
                <div class="form-row-top">
                    <input type="text" placeholder="Name" class="form-input">
                    <input type="email" placeholder="E-mail" class="form-input">
                </div>

                <div class="form-row-bottom">
                    <input type="text" placeholder="Describe your question" class="form-input full-width">

                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24" fill="currentColor" stroke="none">
                            <path d="M22 2L11 13"></path>
                            <path d="M22 2L15 22L11 13L2 9L22 2Z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
</div>
<?php get_footer(); ?>