document.addEventListener('DOMContentLoaded', function () {
    // Đảm bảo chạy sau khi mọi thứ tải xong (để tính toán kích thước đúng)
    if (document.readyState === 'complete') {
        initSliderAllInOne();
    } else {
        window.addEventListener('load', initSliderAllInOne);
    }
});

function initSliderAllInOne() {
    const track = document.querySelector('.product-track');
    const nextBtn = document.querySelector('.slider-nav-outside.next');
    const prevBtn = document.querySelector('.slider-nav-outside.prev');

    if (!track || !nextBtn || !prevBtn) return;

    // --- PHẦN 1: BƠM CSS BẰNG JS (KHÔNG CẦN SỬA FILE CSS) ---
    // Ép khung chứa dài vô tận và nằm ngang
    track.style.display = 'flex';
    track.style.flexWrap = 'nowrap'; 
    track.style.width = 'max-content'; 
    track.style.gap = '30px'; 
    track.style.transition = 'transform 0.4s cubic-bezier(0.25, 1, 0.5, 1)';
    track.style.willChange = 'transform'; // Tối ưu hiệu năng để ko giật

    // Ép từng thẻ sản phẩm không được co lại (Fix lỗi mất khối)
    function enforceItemStyle(item) {
        item.style.flexShrink = '0';
        item.style.flexGrow = '0';
        item.style.height = 'auto'; 
        // Nếu ảnh bị mất, ép hiển thị block
        const img = item.querySelector('img');
        if(img) img.style.display = 'block';
    }

    // Áp dụng style cho các thẻ gốc
    Array.from(track.children).forEach(enforceItemStyle);


    // --- PHẦN 2: LOGIC NHÂN BẢN (CLONE) ---
    const originalItems = Array.from(track.children);
    const originalCount = originalItems.length;

    // Nếu ít sản phẩm, nhân bản lên 10 lần để tạo "vùng đệm" khổng lồ
    // Giúp bấm Next/Prev thoải mái mà không chạm đáy
    if (originalCount > 0) {
        const fragment = document.createDocumentFragment();
        for (let i = 0; i < 10; i++) { // Clone 10 bộ
            originalItems.forEach(item => {
                const clone = item.cloneNode(true);
                enforceItemStyle(clone); // Nhớ ép style cho thẻ clone luôn
                fragment.appendChild(clone);
            });
        }
        track.appendChild(fragment);
    }

    // --- PHẦN 3: LOGIC TRƯỢT MƯỢT ---
    let currentIndex = 0;
    let isAnimating = false;

    function getStep() {
        const firstCard = track.firstElementChild;
        // Lấy chiều rộng chính xác
        const width = firstCard.getBoundingClientRect().width; 
        const gap = 30; // Khớp với gap bên trên
        return width + gap;
    }

    function updateSlide(animate = true) {
        const step = getStep();
        if (animate) {
            track.style.transition = 'transform 0.4s cubic-bezier(0.25, 1, 0.5, 1)';
        } else {
            track.style.transition = 'none'; // Tắt hiệu ứng để nhảy tức thì
        }
        track.style.transform = `translateX(-${currentIndex * step}px)`;
    }

    // --- Xử lý Next ---
    nextBtn.onclick = () => {
        if (isAnimating) return;
        isAnimating = true;
        currentIndex++;
        updateSlide(true);
    };

    // --- Xử lý Prev ---
    prevBtn.onclick = () => {
        if (isAnimating) return;
        isAnimating = true;
        
        // Nếu đang ở vị trí 0 mà bấm lùi -> Nhảy tới vị trí tương đương ở xa tít
        if (currentIndex <= 0) {
            track.style.transition = 'none';
            // Nhảy đến giữa danh sách clone (ví dụ vị trí số 10)
            currentIndex = originalCount * 5; 
            updateSlide(false);
            
            // Ép trình duyệt vẽ lại (Anti-jerk)
            void track.offsetWidth; 
            
            // Sau đó mới cho lùi về
            requestAnimationFrame(() => {
                currentIndex--;
                updateSlide(true);
            });
        } else {
            currentIndex--;
            updateSlide(true);
        }
    };

    // --- Xử lý Reset Ngầm (Tránh đi quá giới hạn) ---
    track.addEventListener('transitionend', (e) => {
        if (e.target !== track) return;
        isAnimating = false;

        // Nếu đi quá xa về bên phải (gần hết thẻ clone)
        // Ta âm thầm nhảy lùi về đầu nhưng vẫn giữ đúng hình ảnh đang xem
        const totalItems = track.children.length;
        if (currentIndex >= totalItems - originalCount) {
            track.style.transition = 'none';
            currentIndex = originalCount; // Reset về vị trí đầu của set clone
            updateSlide(false);
        }
    });
    
    // Fix lỗi resize màn hình bị lệch
    window.addEventListener('resize', () => {
        updateSlide(false);
    });
}

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
