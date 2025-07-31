<?php
	$title='GlobalTravel - Xin chào quý khách';
	$description = 'GlobalTravel - Xin chào quý khách';
	$keywords = 'GlobalTravel - Chào mừng';
	$duongdan='/xin-chao';
	include_once 'classes/blog.php';
    $blog = new blog();
    $cauhinh = $blog->show_cauhinh();
    if($cauhinh){
        $i = 0;
        while($result = $cauhinh->fetch_assoc()){                   
            $image='admin/uploads/'.$result['logo'];
        }
    }
	include 'include/header.php';
?>
<div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">

                    <img src="images/shortback.jpeg" alt="Ảnh về du lịch" class="backimg">

            <h2 class="fix-h2">Khám phá nhiều hơn tại đây</h2>
            </div>
        </div>
</div>
<div class="welcome-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="welcome-card">
                    <div class="welcome-icon">
                        <i class="bi bi-emoji-smile"></i>
                    </div>
                    <h1 class="welcome-title">Chào mừng đến với GlobalTravel</h1>
                    <p class="welcome-text">Cảm ơn bạn đã ghé thăm website của chúng tôi. Chúng tôi hy vọng sẽ mang đến cho bạn những trải nghiệm du lịch tuyệt vời nhất.</p>
                    
                    <div class="welcome-features">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="bi bi-compass"></i>
                                    <h4>Đa dạng điểm đến</h4>
                                    <p>Khám phá nhiều điểm đến hấp dẫn</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="bi bi-star"></i>
                                    <h4>Dịch vụ chất lượng</h4>
                                    <p>Đảm bảo sự hài lòng của khách hàng</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-item">
                                    <i class="bi bi-shield-check"></i>
                                    <h4>An toàn tuyệt đối</h4>
                                    <p>Cam kết an toàn cho mọi chuyến đi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="welcome-actions">
                        <a href="cac-tour" class="btn btn-primary btn-lg me-3">
                            <i class="bi bi-compass me-2"></i>Khám phá tour
                        </a>
                        <a href="lien-he" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>Liên hệ tư vấn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.welcome-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.welcome-card {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.welcome-card:hover {
    transform: translateY(-5px);
}

.welcome-icon {
    font-size: 4rem;
    color: #0d6efd;
    margin-bottom: 20px;
    animation: bounce 2s infinite;
}

.welcome-title {
    color: #212529;
    font-size: 2.5rem;
    margin-bottom: 20px;
    font-weight: 700;
}

.welcome-text {
    color: #6c757d;
    font-size: 1.1rem;
    margin-bottom: 40px;
    line-height: 1.6;
}

.feature-item {
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-item i {
    font-size: 2.5rem;
    color: #0d6efd;
    margin-bottom: 15px;
}

.feature-item h4 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #212529;
}

.feature-item p {
    color: #6c757d;
    font-size: 0.9rem;
}

.welcome-actions {
    margin-top: 40px;
}

.btn {
    padding: 12px 30px;
    font-weight: 500;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px);
    }
    60% {
        transform: translateY(-10px);
    }
}

@media (max-width: 768px) {
    .welcome-section {
        padding: 40px 0;
    }
    
    .welcome-card {
        padding: 20px;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .welcome-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .welcome-actions .btn {
        width: 100%;
    }
}
</style>

<?php
	include 'include/footer.php';
?>
