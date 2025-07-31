<?php
    $title = 'GlobalTravel - Tìm kiếm';
    $description = 'Tìm kiếm';
    $keywords = 'Tìm kiếm';
    $duongdan='/tim-kiem';
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


<div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">

                    <img src="images/shortback.jpeg" alt="Ảnh về du lịch" class="backimg">

            <h2 class="fix-h2">Khám phá nhiều hơn tại đây</h2>
            </div>
        </div>
</div>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;margin-bottom: 15px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-links">
                <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
                <span>/</span>
                <span>Tìm kiếm</span>
            </div>
        </div>
    </div>
</div>

 <div class="container product-container">
    <?php
          if($_SERVER['REQUEST_METHOD']==='POST' ){
        $tukhoa=$_POST['tukhoa'];
        $search_product=$product->search_product($tukhoa);
    }
                
            ?>
    <div class="row diadiem-row">
        <div class="col-12"><h3>Từ khóa tìm kiếm: <?php echo $tukhoa ?? '' ?></h3></div>
        
        
        <div class="col-lg-12">
            <?php
                if(isset($search_product) && $search_product){
                    while($tour = $search_product->fetch_assoc()){
                        $departureDates = $product->getNearestDepartureDate($tour['id']);
                        
            ?>
            <div class="card mb-4 tour-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="position-relative h-100">
                            <img src="admin/uploads/<?php echo $tour['hinhanh']; ?>" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="<?php echo $tour['tieude']; ?>">
                           <?php 
                            if($result['danhmuc']=='23'){
                                echo ' <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 rounded">Tiết kiệm</span>';
                            }
                            ?>
                            <button class="btn position-absolute top-0 end-0 m-2 text-white">
                                <i class="bi bi-heart fs-5"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body h-100 d-flex flex-column">
                            <h5 class="card-title"><?php echo $tour['tieude']; ?></h5>
                            
                            <div class="d-flex flex-wrap mb-2">
                                <div class="me-4 mb-2">
                                    <i class="bi bi-tag me-1"></i> Mã tour: <?php echo $tour['matour']; ?>
                                </div>
                                <div class="me-4 mb-2">
                                    <i class="bi bi-clock me-1"></i> Thời gian: <?php echo $tour['thoigianchuyen']; ?>
                                </div>
                                <div class="me-4 mb-2">
                                    <i class="bi bi-geo-alt me-1"></i> Khởi hành: <?php echo $tour['khoihanh']; ?>
                                </div>
                                <div class="mb-2">
                                    <i class="bi bi-airplane me-1"></i> Phương tiện: <?php echo $tour['phuongtien']; ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">Ngày khởi hành:</span>
                                    <div class="d-flex overflow-auto hide-scrollbar">
                                        <?php
                                        if($departureDates) {
                                            while($date = $departureDates->fetch_assoc()) {
                                                echo '<span class="date-tag bg-light border rounded px-2 py-1 me-2">' . $fm->formatDateToDayMonth($date['tieude']) . '</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-0">Giá từ</p>
                                        <p class="text-danger fw-bold mb-0"><?php echo $fm->format_currency($tour['giatu']); ?> đ</p>
                                    </div>
                                    <a href="tour/<?php echo $tour['url']; ?>" class="btn btn-outline-primary">Xem chi tiết →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
                echo '<div class="alert alert-info">Không tìm thấy kết quả nào phù hợp với từ khóa "' . ($tukhoa ?? '') . '"</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container product-container">
    <div class="row first-row">
        <div class="col-lg-12">
            <h2><i class="bi bi-postcard"></i> Bài viết</h2>
        </div>
        <?php
                $search_blog = $product->search_blog($tukhoa);
                if($search_blog){
                    while ($result_tt = $search_blog->fetch_assoc()) {
            ?>
        <div class="col-lg-3 show-4tin">
            <a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>"><img src="admin/uploads/<?php echo $result_tt['hinhanh'] ?>" alt="<?php echo $result_tt['tieude'] ?>"></a>
            <div class="content-field">
                <h6 class="theloai4"><?php echo $result_tt['tendm'] ?></h6>
                <a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>"><h3 class="tieude4"><?php echo $result_tt['tieude'] ?></h3></a>
                <p class="tomtat4"><?php echo $result_tt['mota'] ?></p>
                <div class="viewtime4">
                    <span><i class="bi bi-calendar3"></i> <?php echo $fm->formatDate_Details($result_tt['thoigian']) ?></span>
                    <span><i class="bi bi-eye"></i> <?php echo $result_tt['luotxem'] ?></span>
                </div>
            </div>
        </div>      
        <?php }}else{
            echo 'Danh mục này hiện không có bài viết. Bạn hãy thử chọn danh mục khác!';
        } ?>


    </div>

</div>

 <?php
    include 'include/footer.php';
    
?>