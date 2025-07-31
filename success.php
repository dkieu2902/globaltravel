<?php
    $title='Global Travel - Đặt tour thành công';
    $description = 'Global Travel - Đặt tour thành công';
    $keywords = 'Global Travel - Đặt tour thành công';
    $duongdan='/cam-on-quy-khach';
    include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){                   
        $image='admin/uploads/'.$result['logo'];
}} 
	include 'include/header.php';
?>
<style>
	
</style>
<div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">

                    <img src="images/shortback.jpeg" alt="Ảnh về du lịch" class="backimg">

            <h2 class="fix-h2">Khám phá nhiều hơn tại đây</h2>
            </div>
        </div>
</div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-3 mb-2">Đặt lịch thành công!</h2>
                        <p class="text-muted">Cảm ơn bạn đã tin tưởng và lựa chọn dịch vụ của chúng tôi</p>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-3">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận thông tin.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="/" class="btn btn-outline-primary">
                                <i class="bi bi-house-door me-2"></i>Về trang chủ
                            </a>
                            <a href="cac-tour" class="btn btn-primary">
                                <i class="bi bi-compass me-2"></i>Xem thêm tour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.order-details {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.order-details:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.btn {
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .order-details {
        padding: 1rem !important;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
 <?php
	include 'include/footer.php';
	
?>