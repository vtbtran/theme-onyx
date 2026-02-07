<?php
/*
Template Name: Thank You Page
*/

get_header(); 
?>

<style>
    /* 1. TUYỆT CHIÊU: Ẩn luôn thanh Header/Menu của web đi */
    header, #masthead, .site-header, .elementor-location-header {
        display: none !important;
    }

    /* 2. Thiết lập nền tối toàn màn hình */
    html, body {
        background-color: #2d3138 !important;
        margin: 0;
        height: 100%;
        overflow: hidden; /* Chặn thanh cuộn, chỉ hiện đúng 1 màn hình */
    }

    /* 3. Căn giữa nội dung tuyệt đối */
    .onyx-thank-you-wrapper {
        height: 100vh; /* Chiều cao bằng đúng màn hình thiết bị */
        width: 100%;
        
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        
        background-color: #2d3138;
        font-family: Arial, Helvetica, sans-serif;
        position: relative;
        z-index: 10;
    }

    /* 4. Đẩy Footer xuống đáy (nếu bạn vẫn muốn giữ Footer) */
    footer, #colophon, .site-footer {
        position: fixed !important;
        bottom: 0;
        width: 100%;
        z-index: 99;
        background: transparent !important; /* Làm nền footer trong suốt cho đẹp */
        border-top: none !important;
    }

    /* --- Các hiệu ứng cũ --- */
    .onyx-icon svg { animation: popUp 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55); }
    @keyframes popUp { 0% { transform: scale(0); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
    
    .onyx-btn:hover {
        background-color: #faff00 !important;
        color: #000 !important;
        box-shadow: 0 0 20px rgba(250, 255, 0, 0.5);
    }
</style>

<div class="onyx-thank-you-wrapper">
    
    <div style="margin-bottom: 40px; opacity: 0.8;">
        <span style="color: #fff; font-weight: 900; letter-spacing: 2px; font-size: 14px;">ONYX INTERNATIONAL</span>
    </div>

    <div class="onyx-icon" style="margin-bottom: 25px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 24 24" fill="none" stroke="#faff00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
    </div>

    <h1 style="color: #ffffff; font-size: 36px; font-weight: 700; margin: 0 0 15px 0;">
        Xác nhận thành công!
    </h1>

    <p style="color: #cccccc; font-size: 16px; margin: 0 0 40px 0; line-height: 1.6; max-width: 500px; text-align: center;">
        Cảm ơn bạn đã đăng ký nhận tin từ ONYX.<br>
        Bạn sẽ là người đầu tiên nhận được những cập nhật công nghệ mới nhất.
    </p>

    <a href="<?php echo home_url(); ?>" class="onyx-btn" style="
        display: inline-block;
        padding: 14px 45px;
        color: #faff00;
        border: 2px solid #faff00;
        border-radius: 50px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        font-size: 14px;
    ">
        Về trang chủ
    </a>

</div>

<?php
get_footer(); 
?>