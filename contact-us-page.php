<?php
/* Template Name: Contact Page */
get_header();
?>
<?php
while ( have_posts() ) :
    the_post();
    the_content();

endwhile;
?>
<!-- <div class="contact-page-wrapper">

    <section class="contact-intro-section">
        <div class="container">
            <h2 class="intro-title">Why Choose ONYX Team?</h2>
            <p class="intro-desc">
                <span class="text-bold">
                    We bridge the gap between advanced AI capabilities and essential educational development.
                </span>
                Our solutions—from intelligent Camera Systems to hands-on STEM Kits—are designed for high performance, intuitive use, and impactful, real-world results.
            </p>
            <div class="intro-icon">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <circle cx="20" cy="20" r="20" fill="#FAFF00" />
                    <path d="M12 28L28 12M28 12H16M28 12V24" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </section>

    <section class="features-bar">
        <div class="container features-grid">
            <div class="feature-item">
                <span class="feat-icon">
                    <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30.3138 5.77395L17.3943 0.253596C17.0007 0.0861765 16.5788 0 16.1528 0C15.7267 0 15.3048 0.0861765 14.9113 0.253596L1.99176 5.77395C0.787284 6.28459 0 7.49217 0 8.83085C0 22.5282 7.70462 31.9957 14.9046 35.0733C15.6986 35.4114 16.5935 35.4114 17.3875 35.0733C23.1542 32.6098 32.2988 24.1015 32.2988 8.83085C32.2988 7.49217 31.5115 6.28459 30.3138 5.77395ZM16.1561 30.795L16.1494 4.50427L27.9856 9.5623C27.7635 20.0096 22.4611 27.5794 16.1561 30.795Z" fill="white" />
                    </svg>

                </span>
                <span>AI-Powered Insight & Security</span>
            </div>
            <div class="feature-item">
                <span class="feat-icon">
                    <svg width="40" height="35" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 23.75C25 24.4406 24.4406 25 23.75 25H16.25C15.5594 25 15 24.4406 15 23.75V20H0V31.25C0 33.25 1.75 35 3.75 35H36.25C38.25 35 40 33.25 40 31.25V20H25V23.75ZM36.25 7.5H30V3.75C30 1.75 28.25 0 26.25 0H13.75C11.75 0 10 1.75 10 3.75V7.5H3.75C1.75 7.5 0 9.25 0 11.25V17.5H40V11.25C40 9.25 38.25 7.5 36.25 7.5ZM25 7.5H15V5H25V7.5Z" fill="white" />
                    </svg>

                </span>
                <span>Integrated STEM-to-Career Path</span>
            </div>
            <div class="feature-item">
                <span class="feat-icon">
                    <svg width="27" height="35" viewBox="0 0 27 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.82882 24.7892C6.21781 24.1952 6.53632 24.3627 5.06259 23.9792C4.39392 23.8049 3.80612 23.4699 3.27456 23.0686L0.084513 30.6728C-0.224156 31.409 0.352401 32.2088 1.16942 32.1787L4.87415 32.0413L7.42225 34.6581C7.98474 35.235 8.97192 35.0552 9.28059 34.319L12.9403 25.5952C12.1781 26.008 11.3323 26.25 10.4576 26.25C9.08653 26.25 7.79842 25.7312 6.82882 24.7892ZM26.9155 30.6728L23.7254 23.0686C23.1939 23.4706 22.6061 23.8049 21.9374 23.9792C20.4559 24.3647 20.7808 24.1966 20.1712 24.7892C19.2016 25.7312 17.9128 26.25 16.5417 26.25C15.667 26.25 14.8212 26.0074 14.059 25.5952L17.7187 34.319C18.0274 35.0552 19.0153 35.235 19.577 34.6581L22.1258 32.0413L25.8306 32.1787C26.6476 32.2088 27.2242 31.4083 26.9155 30.6728ZM18.4921 23.2423C19.5665 22.1793 19.6895 22.2709 21.2195 21.8655C22.1962 21.6065 22.9597 20.8511 23.2213 19.8845C23.7472 17.9432 23.6108 18.1776 25.0459 16.7572C25.761 16.0496 26.0401 15.0181 25.7785 14.0515C25.2533 12.1115 25.2526 12.3822 25.7785 10.4402C26.0401 9.4736 25.761 8.44208 25.0459 7.73458C23.6108 6.3141 23.7472 6.54788 23.2213 4.6072C22.9597 3.64062 22.1962 2.88526 21.2195 2.62618C19.2592 2.10598 19.4955 2.24201 18.059 0.820847C17.3439 0.113342 16.3012 -0.163508 15.3246 0.0955688C13.365 0.61509 13.6385 0.615773 11.6754 0.0955688C10.6988 -0.163508 9.65606 0.112658 8.94098 0.820847C7.50592 2.24133 7.74217 2.10598 5.78117 2.62618C4.80454 2.88526 4.04096 3.64062 3.7794 4.6072C3.25417 6.54788 3.38987 6.3141 1.95481 7.73458C1.23974 8.44208 0.959895 9.4736 1.22216 10.4402C1.74739 12.3788 1.74809 12.1081 1.22216 14.0509C0.960598 15.0174 1.23974 16.049 1.95481 16.7572C3.38987 18.1776 3.25346 17.9432 3.7794 19.8845C4.04096 20.8511 4.80454 21.6065 5.78117 21.8655C7.35475 22.2825 7.47217 22.2169 8.50786 23.2423C9.43809 24.1631 10.8872 24.3278 12.0052 23.6401C12.4522 23.3642 12.9708 23.2177 13.5004 23.2177C14.0299 23.2177 14.5485 23.3642 14.9955 23.6401C16.1128 24.3278 17.5619 24.1631 18.4921 23.2423ZM6.86679 12.0288C6.86679 8.4038 9.83676 5.46509 13.5 5.46509C17.1632 5.46509 20.1332 8.4038 20.1332 12.0288C20.1332 15.6539 17.1632 18.5926 13.5 18.5926C9.83676 18.5926 6.86679 15.6539 6.86679 12.0288Z" fill="white" />
                    </svg>

                </span>
                <span>Continuous Innovation & R&D Focus</span>
            </div>
            <div class="feature-item">
                <span class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                        <path fill="#ffffff" d="M598.1 139.4C608.8 131.6 611.2 116.6 603.4 105.9C595.6 95.2 580.6 92.8 569.9 100.6L495.4 154.8L485.5 148.2C465.8 135 442.6 128 418.9 128L359.7 128L359.3 128L215.7 128C189 128 163.2 136.9 142.3 153.1L70.1 100.6C59.4 92.8 44.4 95.2 36.6 105.9C28.8 116.6 31.2 131.6 41.9 139.4L129.9 203.4C139.5 210.3 152.6 209.3 161 201L164.9 197.1C178.4 183.6 196.7 176 215.8 176L262.1 176L170.4 267.7C154.8 283.3 154.8 308.6 170.4 324.3L171.2 325.1C218 372 294 372 340.9 325.1L368 298L465.8 395.8C481.4 411.4 481.4 436.7 465.8 452.4L456 462.2L425 431.2C415.6 421.8 400.4 421.8 391.1 431.2C381.8 440.6 381.7 455.8 391.1 465.1L419.1 493.1C401.6 503.5 381.9 509.8 361.5 511.6L313 463C303.6 453.6 288.4 453.6 279.1 463C269.8 472.4 269.7 487.6 279.1 496.9L294.1 511.9L290.3 511.9C254.2 511.9 219.6 497.6 194.1 472.1L65 343C55.6 333.6 40.4 333.6 31.1 343C21.8 352.4 21.7 367.6 31.1 376.9L160.2 506.1C194.7 540.6 241.5 560 290.3 560L342.1 560L343.1 561L344.1 560L349.8 560C398.6 560 445.4 540.6 479.9 506.1L499.8 486.2C501 485 502.1 483.9 503.2 482.7C503.9 482.2 504.5 481.6 505.1 481L609 377C618.4 367.6 618.4 352.4 609 343.1C599.6 333.8 584.4 333.7 575.1 343.1L521.3 396.9C517.1 384.1 510 372 499.8 361.8L385 247C375.6 237.6 360.4 237.6 351.1 247L307 291.1C280.5 317.6 238.5 319.1 210.3 295.7L309 197C322.4 183.6 340.6 176 359.6 175.9L368.1 175.9L368.3 175.9L419.1 175.9C433.3 175.9 447.2 180.1 459 188L482.7 204C491.1 209.6 502 209.3 510.1 203.4L598.1 139.4z" />
                    </svg>
                </span>
                <span>Global Partnership & Local Support</span>
            </div>
        </div>
    </section>

    <section class="contact-main">
        <div class="container">
            <h1 class="page-title">CONTACT</h1>

            <div class="business-hours-bar">

                <div class="bh-item bh-label">BUSINESS HOURS</div>

                <div class="bh-item bh-days">
                    <span>Monday - Saturday</span>
                    <span>Sunday</span>
                </div>

                <div class="bh-item bh-times">
                    <span>8:00 AM - 5:00 PM PST</span>
                    <span>Closed</span>
                </div>

                <div class="bh-item bh-icon">
                    <span class="feat-icon">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/icon.png"
                            alt="Feature icon">
                    </span>
                </div>
            </div>

            <div class="contact-grid">

                <div class="col-left">
                    <div class="map-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7858.00017132909!2d105.78316359241424!3d10.016850660357527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1zxJDGsOG7nW5nIHPhu5EgOSwgS2h1IMSQTVQgSMawbmcgUGjDuiBQaMaw4budbmcgQ8OhaSBSxINuZywgVFAuIEPhuqduIFRoxqE!5e0!3m2!1svi!2s!4v1769323218298!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="contact-form-box" id="ket-qua-form">
                        <h3>Send us a Message</h3>
                        <?php echo do_shortcode('[contact-form-7 id="ee1e918" title="Form contact"]'); ?>
                    </div>
                </div>

                <div class="col-right">

                    <div class="info-card">
                        <h4>General Inquiries</h4>
                        <p class="info-desc">For general questions about our products and services</p>
                        <div class="info-detail">
                            <p>Email: info@onyx.com</p>
                            <p>Phone: +1 (555) 123-4567</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <h4>Sales Team</h4>
                        <p class="info-desc">Ready to help you find the perfect solution</p>
                        <div class="info-detail">
                            <p>Email: sales@onyx.com</p>
                            <p>Phone: +1 (555) 123-4568</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <h4>Technical Support</h4>
                        <p class="info-desc">Get help with installation and troubleshooting</p>
                        <div class="info-detail">
                            <p>Email: support@onyx.com</p>
                            <p>Phone: +1 (555) 123-4569</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <h4>Media & Press</h4>
                        <p class="info-desc">Press inquiries and media relations</p>
                        <div class="info-detail">
                            <p>Email: press@onyx.com</p>
                            <p>Phone: +1 (555) 123-4570</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div> -->

<?php get_footer(); ?>