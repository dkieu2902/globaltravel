<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(11) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-bar-chart{
        color: #fff !important;
    }
    
    /* Simple Welcome Styles */
    .welcome-container {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4f1fd 100%);
        border-radius: 15px;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }
    
    .welcome-content {
        position: relative;
        z-index: 2;
    }
    
    .welcome-icon {
        font-size: 4rem;
        color: #1c84c6;
        margin-bottom: 1.5rem;
        animation: pulse 2s infinite ease-in-out;
    }
    
    .welcome-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    
    .welcome-message {
        font-size: 1.2rem;
        color: #5a6a7e;
        max-width: 700px;
        margin: 0 auto 2rem auto;
        line-height: 1.7;
    }
    
    .welcome-user {
        font-size: 1.4rem;
        font-weight: 500;
        color: #1c84c6;
        margin-bottom: 2rem;
    }
    
    .decoration {
        position: absolute;
        border-radius: 50%;
    }
    
    .decoration-1 {
        width: 300px;
        height: 300px;
        background: radial-gradient(rgba(28, 132, 198, 0.1), rgba(28, 132, 198, 0.05));
        top: -100px;
        left: -100px;
    }
    
    .decoration-2 {
        width: 200px;
        height: 200px;
        background: radial-gradient(rgba(26, 188, 156, 0.1), rgba(26, 188, 156, 0.05));
        bottom: -80px;
        right: -50px;
    }
    
    .decoration-3 {
        width: 150px;
        height: 150px;
        background: radial-gradient(rgba(241, 196, 15, 0.1), rgba(241, 196, 15, 0.05));
        bottom: 50px;
        left: 15%;
    }
    
    .current-time {
        font-size: 1.1rem;
        color: #7f8c8d;
        margin-top: 1rem;
    }
    
    .welcome-footer {
        margin-top: 1rem;
        font-size: 1rem;
        color: #95a5a6;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade {
        animation: fadeIn 0.8s ease forwards;
    }
</style>
<div class="card shadow border-0 mb-7">
    <div class="welcome-container">
        <div class="decoration decoration-1"></div>
        <div class="decoration decoration-2"></div>
        <div class="decoration decoration-3"></div>
        
        <div class="welcome-content animate-fade">
            <div class="welcome-icon">
                <i class="bi bi-display"></i>
            </div>
            
            <h1 class="welcome-title">Chào mừng đến với Trang Quản trị</h1>
            
            <p class="welcome-message">
                Đây là hệ thống quản lý toàn diện, được thiết kế để giúp bạn quản lý và theo dõi mọi hoạt động một cách hiệu quả.
                Khám phá các công cụ và tính năng của hệ thống qua thanh điều hướng bên trái.
            </p>
            
            <div class="welcome-user">
                <i class="bi bi-person-circle"></i> 
                <?php echo Session::get('tennd'); ?>
            </div>
            
            <div class="current-time">
                <?php echo date('l, d F Y'); ?>
            </div>
            
            <div class="welcome-footer">
                © <?php echo date('Y'); ?> GlobalTravel
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>