document.addEventListener('DOMContentLoaded', function () {

    const track = document.querySelector('.product-track');
    const nextBtn = document.querySelector('.slider-nav-outside.next');
    const prevBtn = document.querySelector('.slider-nav-outside.prev');

    // Kiểm tra và thực thi
    if (track && nextBtn && prevBtn) {

        // --- 1. CLONE ITEM (QUAN TRỌNG) ---
        // Nhân bản danh sách sản phẩm để tạo hiệu ứng vô tận mượt mà
        // Nếu ít hơn 6 thẻ, ta nhân đôi lên
        const cards = Array.from(track.children);
        if (cards.length > 0 && cards.length < 6) {
            cards.forEach(card => {
                const clone = card.cloneNode(true);
                track.appendChild(clone);
            });
            // Nhân thêm lần nữa nếu cần thiết (để chắc chắn full màn hình)
            cards.forEach(card => {
                const clone = card.cloneNode(true);
                track.appendChild(clone);
            });
        }

        let isAnimating = false;
        const gap = 30; // Khớp với CSS
        // Lấy lại danh sách thẻ sau khi clone
        let allCards = document.querySelectorAll('.product-card');
        // Kích thước bước nhảy = Width thẻ đầu tiên + gap
        let slideWidth = allCards[0].offsetWidth + gap;

        // --- 2. HÀM NEXT ---
        nextBtn.addEventListener('click', () => {
            if (isAnimating) return;
            isAnimating = true;

            // Cập nhật lại width (phòng trường hợp resize)
            slideWidth = track.firstElementChild.offsetWidth + gap;

            // Hiệu ứng trượt
            track.style.transition = 'transform 0.4s ease-in-out'; // 0.4s cho nhanh gọn
            track.style.transform = `translateX(-${slideWidth}px)`;

            // Sau khi trượt xong
            track.addEventListener('transitionend', function () {
                // Tắt hiệu ứng để thao tác ngầm
                track.style.transition = 'none';

                // Bốc thẻ đầu tiên bỏ xuống cuối cùng
                track.appendChild(track.firstElementChild);

                // Reset vị trí về 0 ngay lập tức
                track.style.transform = 'translateX(0)';

                // Mở khoá nút bấm
                setTimeout(() => { isAnimating = false; }, 0);

            }, { once: true }); // Chỉ chạy 1 lần mỗi cú click
        });

        // --- 3. HÀM PREV ---
        prevBtn.addEventListener('click', () => {
            if (isAnimating) return;
            isAnimating = true;

            slideWidth = track.firstElementChild.offsetWidth + gap;

            // Tắt hiệu ứng để thao tác ngầm trước
            track.style.transition = 'none';

            // Bốc thẻ cuối cùng bỏ lên đầu
            track.prepend(track.lastElementChild);

            // Dịch đường ray sang trái 1 bước (để giấu thẻ vừa bốc lên)
            track.style.transform = `translateX(-${slideWidth}px)`;

            // Bắt trình duyệt vẽ lại (Reflow)
            void track.offsetWidth;

            // Bật hiệu ứng và trượt về 0 (Hiển thị thẻ đó ra)
            track.style.transition = 'transform 0.4s ease-in-out';
            track.style.transform = 'translateX(0)';

            track.addEventListener('transitionend', function () {
                isAnimating = false;
            }, { once: true });
        });
    }

});

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
