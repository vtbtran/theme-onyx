(function() {
    function initSliderAllInOne() {
        const sliders = document.querySelectorAll('.product-slider-outer');
        
        sliders.forEach(sliderContainer => {
            if (sliderContainer.classList.contains('onyx-init-done')) return;
            sliderContainer.classList.add('onyx-init-done');
            const track = sliderContainer.querySelector('.product-track');
            const nextBtn = sliderContainer.querySelector('.slider-nav-outside.next');
            const prevBtn = sliderContainer.querySelector('.slider-nav-outside.prev');
            if (!track || !nextBtn || !prevBtn) return;
            track.style.display = 'flex';
            track.style.flexWrap = 'nowrap';
            track.style.width = 'max-content';
            track.style.gap = '30px';
            track.style.transition = 'transform 0.4s cubic-bezier(0.25, 1, 0.5, 1)';
            track.style.willChange = 'transform';

            function enforceItemStyle(item) {
                item.style.flexShrink = '0';
                item.style.flexGrow = '0';
                item.style.height = 'auto';
                const rect = item.getBoundingClientRect();
                if (rect.width < 50) item.style.minWidth = '300px';
                
                const img = item.querySelector('img');
                if(img) { img.style.display = 'block'; img.style.width = '100%'; }
            }

            const originalItems = Array.from(track.children);
            originalItems.forEach(enforceItemStyle);

            if (originalItems.length > 0) {
                const fragment = document.createDocumentFragment();
                for (let i = 0; i < 4; i++) { 
                    originalItems.forEach(item => {
                        const clone = item.cloneNode(true);
                        enforceItemStyle(clone);
                        clone.classList.add('is-clone');
                        fragment.appendChild(clone);
                    });
                }
                track.appendChild(fragment);
            }
            let currentIndex = 0;
            let isAnimating = false;
            let stepSize = 0;

            function updateMetrics() {
                const firstCard = track.firstElementChild;
                if (firstCard) {
                    const rect = firstCard.getBoundingClientRect();
                    const width = rect.width > 50 ? rect.width : 300; 
                    stepSize = width + 30;
                }
                updateSlide(false);
            }

            function updateSlide(animate = true) {
                if (stepSize === 0) updateMetrics();
                track.style.transition = animate ? 'transform 0.4s cubic-bezier(0.25, 1, 0.5, 1)' : 'none';
                track.style.transform = `translateX(-${currentIndex * stepSize}px)`;
            }

            // D. SỰ KIỆN NÚT BẤM
            nextBtn.onclick = (e) => {
                e.preventDefault();
                if (isAnimating) return;
                isAnimating = true;
                currentIndex++;
                updateSlide(true);
            };

            prevBtn.onclick = (e) => {
                e.preventDefault();
                if (isAnimating) return;
                isAnimating = true;
                if (currentIndex <= 0) {
                    track.style.transition = 'none';
                    currentIndex = originalItems.length * 2; 
                    updateSlide(false);
                    void track.offsetWidth; 
                    requestAnimationFrame(() => {
                        currentIndex--;
                        updateSlide(true);
                    });
                } else {
                    currentIndex--;
                    updateSlide(true);
                }
            };

            track.addEventListener('transitionend', (e) => {
                if (e.target !== track) return;
                isAnimating = false;
                if (currentIndex >= track.children.length - originalItems.length) {
                    track.style.transition = 'none';
                    currentIndex = originalItems.length; 
                    updateSlide(false);
                }
            });

            // E. FIX LỖI RESIZE
            if ('ResizeObserver' in window) {
                new ResizeObserver(() => updateMetrics()).observe(sliderContainer);
            } else {
                window.addEventListener('resize', updateMetrics);
            }
            
            // Khởi chạy lần đầu & check lại sau 0.5s
            updateMetrics();
            setTimeout(updateMetrics, 500);
        });
    }

    // --- 2. CƠ CHẾ KÍCH HOẠT THÔNG MINH (QUAN TRỌNG) ---
    
    // Cách 1: Chạy khi vào trang lần đầu
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSliderAllInOne);
    } else {
        initSliderAllInOne();
    }

    // Cách 2: Chạy khi Elementor load xong (Dành cho WordPress)
    if (typeof jQuery !== 'undefined') {
        jQuery(window).on('elementor/frontend/init', function() {
            if (typeof elementorFrontend !== 'undefined') {
                elementorFrontend.hooks.addAction('frontend/element_ready/onyx_product_slider.default', initSliderAllInOne);
            }
        });
    }

    // Cách 3: CAMERA GIÁM SÁT (MutationObserver) - Fix lỗi chuyển trang bị mất khối
    const observer = new MutationObserver(function(mutations) {
        let shouldScan = false;
        mutations.forEach(mutation => {
            if (mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach(node => {
                    // Nếu phát hiện có slider mới xuất hiện trong DOM
                    if (node.nodeType === 1 && (node.classList.contains('product-slider-outer') || node.querySelector('.product-slider-outer'))) {
                        shouldScan = true;
                    }
                });
            }
        });
        if (shouldScan) {
            // Chờ 1 chút cho DOM ổn định rồi chạy lại
            setTimeout(initSliderAllInOne, 100);
        }
    });
    
    // Bắt đầu giám sát toàn bộ trang web
    observer.observe(document.body, { childList: true, subtree: true });

})();

document.addEventListener('DOMContentLoaded', function () {
    // 1. Lấy các phần tử cần thiết
    const triggerBtn = document.getElementById('mobile-menu-trigger'); // Nút 3 gạch
    const closeBtn = document.getElementById('closeMenuBtn');          // Nút X
    const menuOverlay = document.getElementById('mobileMenu');         // Màn hình menu

    // 2. Hàm mở menu
    if (triggerBtn) {
        triggerBtn.addEventListener('click', function (e) {
            e.preventDefault();
            menuOverlay.classList.add('active'); // Thêm class để hiện menu
            document.body.style.overflow = 'hidden'; // Khóa cuộn trang web
        });
    }

    // 3. Hàm đóng menu
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            menuOverlay.classList.remove('active'); // Bỏ class để ẩn menu
            document.body.style.overflow = ''; // Mở khóa cuộn
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.hero-track');
    let slides = document.querySelectorAll('.hero-card');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');

    if (!track || slides.length === 0) return;

    // --- 1. SETUP CLONES (Tạo bản sao) ---
    const firstClone = slides[0].cloneNode(true);
    const lastClone = slides[slides.length - 1].cloneNode(true);

    firstClone.id = 'first-clone';
    lastClone.id = 'last-clone';

    track.appendChild(firstClone);
    track.insertBefore(lastClone, slides[0]);

    // --- 2. HÀM TÍNH TOÁN KÍCH THƯỚC (BAO GỒM CẢ GAP) ---
    const getSlideMetrics = () => {
        const slideWidth = slides[0].offsetWidth;
        // Tự động lấy giá trị gap từ CSS (30px)
        const style = window.getComputedStyle(track);
        const gap = parseFloat(style.gap) || 0;

        return slideWidth + gap; // Trả về tổng quãng đường cần trượt
    };

    // --- 3. KHỞI TẠO ---
    const allSlides = document.querySelectorAll('.hero-card');
    let currentIndex = 1;
    let isTransitioning = false;

    // Đặt vị trí ban đầu
    track.style.transform = `translateX(-${currentIndex * getSlideMetrics()}px)`;

    // --- 4. HÀM DI CHUYỂN ---
    const moveToSlide = (index) => {
        if (isTransitioning) return;
        isTransitioning = true;
        currentIndex = index;

        track.style.transition = 'transform 0.5s ease-in-out';
        track.style.transform = `translateX(-${currentIndex * getSlideMetrics()}px)`;
    };

    // --- 5. BUTTON EVENTS ---
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (currentIndex >= allSlides.length - 1) return;
            moveToSlide(currentIndex + 1);
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentIndex <= 0) return;
            moveToSlide(currentIndex - 1);
        });
    }

    // --- 6. XỬ LÝ VÒNG LẶP VÔ TẬN ---
    track.addEventListener('transitionend', () => {
        isTransitioning = false;

        const moveDistance = getSlideMetrics();

        if (allSlides[currentIndex].id === 'last-clone') {
            track.style.transition = 'none';
            currentIndex = allSlides.length - 2;
            track.style.transform = `translateX(-${currentIndex * moveDistance}px)`;
        }

        if (allSlides[currentIndex].id === 'first-clone') {
            track.style.transition = 'none';
            currentIndex = 1;
            track.style.transform = `translateX(-${currentIndex * moveDistance}px)`;
        }
    });

    // --- 7. RESIZE FIX ---
    window.addEventListener('resize', () => {
        track.style.transition = 'none';
        track.style.transform = `translateX(-${currentIndex * getSlideMetrics()}px)`;
    });
});
document.addEventListener('DOMContentLoaded', function () {

    // 1. Xử lý xóa tham số ?sent=1 trên URL
    if (window.history.replaceState) {
        const url = new URL(window.location.href);
        if (url.searchParams.has('sent')) {
            url.searchParams.delete('sent');
            window.history.replaceState(null, null, url);
        }
    }

    // 2. Xử lý ẩn thông báo sau 5 giây
    const successMsg = document.getElementById('msg-success');
    if (successMsg) {
        setTimeout(function () {
            successMsg.style.transition = "opacity 1s ease";
            successMsg.style.opacity = 0;
            setTimeout(function () {
                successMsg.style.display = "none";
            }, 1000);
        }, 5000);
    }

});

document.addEventListener("DOMContentLoaded", function() {
    // 1. Tạo bộ quan sát (Observer)
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1 // Khi phần tử hiện ra 10% trong màn hình thì bắt đầu chạy
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            // Nếu phần tử xuất hiện trong màn hình
            if (entry.isIntersecting) {
                // Thêm class 'is-visible' để kích hoạt CSS
                entry.target.classList.add('is-visible');
                // Ngừng quan sát (để animation chỉ chạy 1 lần)
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // 2. Tìm tất cả các phần tử có class "animate-on-scroll" để theo dõi
    const elements = document.querySelectorAll('.animate-on-scroll');
    elements.forEach(el => {
        observer.observe(el);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // 1. Chọn tất cả các phần tử cần hiệu ứng
    const targets = document.querySelectorAll('.header-title, .latest-news-card, .recent-header-row, .news-item-card, .newsletter-section');

    // 2. Tạo "Người quan sát" (Intersection Observer)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Nếu phần tử lọt vào khung hình (viewport)
            if (entry.isIntersecting) {
                // Thêm class để kích hoạt CSS hiện lên
                entry.target.classList.add('onyx-in-view');
                
                // Xong việc rồi thì thôi, không theo dõi nữa (để đỡ tốn RAM)
                observer.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '0px',
        threshold: 0.15 // Khi thấy 15% chiều cao của vật thể thì bắt đầu hiệu ứng
    });

    // 3. Bắt đầu theo dõi từng phần tử
    targets.forEach(el => observer.observe(el));
});
document.addEventListener("DOMContentLoaded", function() {
    // 1. Kiểm tra: Nếu đang ở trong trình sửa Elementor thì KHÔNG CHẠY (để tránh lỗi hiển thị khi sửa)
    if (document.body.classList.contains('elementor-editor-active')) {
        return;
    }

    // 2. Thiết lập thông số quan sát
    const observerOptions = {
        root: null,       // Quan sát theo khung nhìn trình duyệt
        rootMargin: '0px',
        threshold: 0.15   // Khi phần tử hiện ra 15% diện tích thì bắt đầu hiệu ứng
    };

    // 3. Tạo bộ quan sát (Observer)
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            // Nếu phần tử xuất hiện trong màn hình
            if (entry.isIntersecting) {
                // Thêm class 'onyx-animate-active' để kích hoạt CSS
                entry.target.classList.add('onyx-animate-active');
                
                // Ngừng quan sát phần tử này (để hiệu ứng chỉ chạy 1 lần)
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // 4. Chọn các phần tử cần hiệu ứng (theo đúng các class CSS đã làm)
    const targetElements = document.querySelectorAll('.res-card, .webinar-card, .faq-item, .res-hero-content');
    
    targetElements.forEach(el => {
        // Thêm class 'onyx-animate-init' để set trạng thái ẩn ban đầu
        el.classList.add('onyx-animate-init');
        // Bắt đầu theo dõi
        observer.observe(el);
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // 1. AN TOÀN: Nếu đang sửa bằng Elementor thì KHÔNG CHẠY (để dễ sửa)
    if (document.body.classList.contains('elementor-editor-active')) {
        return;
    }

    // 2. Cấu hình bộ quan sát
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15 // Hiện 15% thì bắt đầu hiệu ứng
    };

    // 3. Tạo bộ quan sát (Observer)
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Kích hoạt hiệu ứng
                entry.target.classList.add('onyx-service-active');
                // Chỉ chạy 1 lần rồi thôi
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // 4. CHỌN CÁC PHẦN TỬ CẦN ANIMATION TRÊN TRANG SERVICE
    // Bao gồm: Tiêu đề, Card dịch vụ, Card sản phẩm, Dòng quy trình
    const serviceTargets = document.querySelectorAll(
        '.section-title, .section-title-center, .service-card, .product-card, .process-item'
    );
    
    serviceTargets.forEach(el => {
        // Gắn class ẩn ban đầu
        el.classList.add('onyx-service-init');
        // Bắt đầu theo dõi
        observer.observe(el);
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // 1. AN TOÀN: Nếu đang sửa bằng Elementor thì KHÔNG CHẠY
    if (document.body.classList.contains('elementor-editor-active')) {
        return;
    }

    // 2. Cấu hình bộ quan sát
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15 // Hiện 15% thì bắt đầu hiệu ứng
    };

    // 3. Tạo bộ quan sát
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Kích hoạt hiệu ứng
                entry.target.classList.add('onyx-contact-active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // 4. CHỌN CÁC PHẦN TỬ CẦN ANIMATION TRÊN TRANG CONTACT
    const contactTargets = document.querySelectorAll(
        '.intro-title, .intro-desc, .feature-item, .business-hours-bar, .map-wrapper, .contact-form-box, .info-card'
    );
    
    contactTargets.forEach(el => {
        // Gắn class ẩn ban đầu
        el.classList.add('onyx-contact-init');
        // Bắt đầu theo dõi
        observer.observe(el);
    });
});
