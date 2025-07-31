<?php 
session_start();
					include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
	$title = $result['tieude'];
	$description = $result['mota'];
	$keywords = $result['keywords'];
    $duongdan='';	
    $image='admin/uploads/'.$result['logo'];
}}
	include 'include/header-index.php';
$thaydoitrangthai = $product->thaydoitrangthai();
?>

<style>
	.tour-info h3 {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-overflow: ellipsis;
		max-height: 50px;
	}
	
	.tour-dates {
		display: flex;
		align-items: center;
		overflow-x: auto;
		white-space: nowrap;
		padding-bottom: 5px;
		scrollbar-width: none;
		-ms-overflow-style: none; 
	}
	
	.tour-dates::-webkit-scrollbar {
		display: none;
	}
	
	.tour-dates span {
		flex-shrink: 0;
		margin-right: 5px;
	}
	
	.date-tag {
		flex-shrink: 0;
	}
.tour-grid-container {
    padding: 40px 15px;
}

.hot-tours-title {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
    display: block;
}

.tour-grid {
    display: flex;
    flex-wrap: wrap;
}

.tour-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.tour-image-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.tour-image1 {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.tour-card:hover .tour-image {
    transform: scale(1.05);
}

.tour-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.tour-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.tour-info-grid {
    margin-bottom: 15px;
}

.tour-info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.tour-info-item {
    display: flex;
    align-items: center;
    font-size: 13px;
    color: #666;
    flex: 1;
}

.tour-info-item i {
    margin-right: 5px;
    color: #007bff;
    font-size: 12px;
}

.tour-departure-dates {
    margin-bottom: 15px;
}

.departure-label {
    font-size: 13px;
    color: #666;
    display: block;
    margin-bottom: 8px;
}

.date-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.departure-date {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 4px 8px;
    font-size: 12px;
    color: #495057;
}

.tour-price-section {
    margin-bottom: 20px;
    margin-top: auto;
}

.price-label {
    font-size: 14px;
    color: #333;
    margin: 0;
}

.price-amount {
    font-size: 18px;
    font-weight: bold;
    color: #e74c3c;
}

.tour-detail-btn {
    background: #007bff;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 6px;
    text-align: center;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: block;
}

.tour-detail-btn:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
}

@media (max-width: 991px) {
    .tour-info-row {
        flex-direction: column;
    }
    
    .tour-info-item {
        margin-bottom: 5px;
    }
}

@media (max-width: 767px) {
    .hot-tours-title {
        font-size: 24px;
        text-align: center;
    }
    
    .tour-grid-container {
        padding: 20px 15px;
    }
}
</style>

<div class="mid-content">
    <div class="container tour-grid-container">
    <div class="row">
        <div class="col-lg-12">
            <span class="hot-tours-title" data-aos="fade-right">Các tour hot nhất của chúng tôi!</span>
        </div>
        
        <div class="col-lg-12">
            <div class="row tour-grid" data-aos="fade-in" data-aos-delay="200">
                
                <?php
                $gettour = $product->getTourTheoSoLuongDat();
                if($gettour){
                    while($result = $gettour->fetch_assoc()){
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="tour-card">
                        <div class="tour-image-wrapper">
                            <img src="admin/uploads/<?php echo $result['hinhanh']; ?>" alt="<?php echo $result['tieude']; ?>" class="tour-image1">
                        </div>
                        <div class="tour-content">
                            <h3 class="tour-title"><?php echo $result['tieude']; ?></h3>
                            
                            <div class="tour-info-grid">
                                <div class="tour-info-row">
                                    <div class="tour-info-item">
                                        <i class="bi bi-tag"></i>
                                        <span>Mã tour: <?php echo $result['matour']; ?></span>
                                    </div>
                                    <div class="tour-info-item">
                                        <i class="bi bi-clock"></i>
                                        <span>Thời gian: <?php echo $result['thoigianchuyen']; ?></span>
                                    </div>
                                </div>
                                
                                <div class="tour-info-row">
                                    <div class="tour-info-item">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>Khởi hành: <?php echo $result['khoihanh']; ?></span>
                                    </div>
                                    <div class="tour-info-item">
                                        <i class="bi bi-airplane"></i>
                                        <span>Phương tiện: <?php echo $result['phuongtien']; ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tour-departure-dates">
                                <span class="departure-label">Ngày khởi hành:</span>
                                <div class="date-tags">
                                    <?php
                                    $getthoigiandibytour = $product->getthoigiandibytour($result['id']);
                                    if($getthoigiandibytour){
                                        while($result_tgd = $getthoigiandibytour->fetch_assoc()){
                                    ?>
                                    <span class="departure-date"><?php echo $fm->formatDateToDayMonth($result_tgd['tieude']); ?></span>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="tour-price-section">
                                <p class="price-label">Giá từ: <span class="price-amount"><?php echo $fm->format_currency($result['giatu']); ?> đ</span></p>
                            </div>
                            
                            <a href="tour/<?php echo $result['url']; ?>" class="tour-detail-btn">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>                 
            </div>
        </div>
    </div>
</div>


	<div class="container index-container">
       
		<div class="row first-row">
			<div class="col-lg-12">
				<span class="bold" data-aos="fade-right">Lên lịch trình</span>
				<div class="top-tieude">
					<h2 class="tieude-index bold" data-aos="fade-right" data-aos-delay="200">Chúng ta sẽ đi đâu?</h2>
					<a href="cac-tour" title="Xem thêm" class="xemthem" data-aos="fade-left" data-aos-delay="300">Xem thêm</a>
				</div>
			</div>


			<div class="col-lg-12">
				<a href="cac-tour" title="Xem thêm" class="xemthem-mobile" data-aos="fade-up" data-aos-delay="600">Xem thêm</a>
			</div>
			
			<div class="col-lg-12">
				<div class="tour-slider" data-aos="fade-in" data-aos-delay="200">
					
                    <?php
                $gettour = $product->gettour();
                            if($gettour){
                                while($result = $gettour->fetch_assoc()){
                        
            ?>

					<div class="tour-item">
						<div class="tour-image">
							<img src="admin/uploads/<?php echo $result['hinhanh']; ?>" alt="<?php echo $result['tieude']; ?>" class="img-fluid">
						</div>
						<div class="tour-info">
							<h3><?php echo $result['tieude']; ?></h3>
							<div class="tour-details">
								<div class="tour-meta">
									<p><i class="bi bi-tag"></i> Mã tour: <?php echo $result['matour']; ?></p>
									<p><i class="bi bi-clock"></i> Thời gian: <?php echo $result['thoigianchuyen']; ?></p>
								</div>
								<div class="tour-meta">
									<p><i class="bi bi-geo-alt"></i> Khởi hành: <?php echo $result['khoihanh']; ?></p>
									<p><i class="bi bi-airplane"></i> Phương tiện: <?php echo $result['phuongtien']; ?></p>
								</div>
								<div class="tour-dates">
									<span>Ngày khởi hành:</span>
                                    <?php
                $getthoigiandibytour = $product->getthoigiandibytour($result['id']);
                            if($getthoigiandibytour){
                                while($result_tgd = $getthoigiandibytour->fetch_assoc()){
                        
            ?>
									<span class="date-tag"><?php echo $fm->formatDateToDayMonth($result_tgd['tieude']); ?></span>
                                    <?php 
                }}
                     ?>
								</div>
								<div class="tour-price">
									<p>Giá từ: <span class="price"><?php echo $fm->format_currency($result['giatu']); ?> đ</span></p>
								</div>
								<a href="tour/<?php echo $result['url']; ?>" class="btn-view-detail">Xem chi tiết</a>
							</div>
						</div>
					</div>
                    <?php 
                }}
                     ?>					
				</div>
			</div>
			
		</div>
		

		

	</div>


	<div class="container-fluid">
		<div class="row second-row">
			<div class="col-lg-12"  style="padding: 0;">
                <div style="position: relative;">
                    <img src="images/slider1.jpg" alt="Ảnh về du lịch" width="100%" data-aos="fade-in">
                    <h1 class="h1-mid bold" data-aos="fade-in" data-aos-delay="200">
                    	<span data-aos="fade-right" data-aos-delay="300">DU LỊCH</span> <br>
                    	<span data-aos="fade-right" data-aos-delay="400">TỐT NHẤT</span><br>
                    	<span class="year" data-aos="fade-right" data-aos-delay="400">2025</span>
                    </h1>
                    <div class="datlich" data-aos="fade-up" data-aos-delay="700">
                    	<p class="form-control text-left">Mang đến cho bạn những trải nghiệm tuyệt vời! Khám phá ngay tại đây.</p>
                    	<a href="cac-tour" title="Đặt lịch ngay" class="form-control datlichngay">ĐẶT LỊCH NGAY</a>
                    </div>
                </div>


			</div>
		</div>
	</div>

	<div class="container index-container">
		<div class="row third-row">
			<div class="col-lg-12">
				<span class="bold" data-aos="fade-right">Bài viết về du lịch</span>
				<div style="display:flex;justify-content: space-between;padding-bottom:25px ;">
					<h2 class="tieude-index bold" data-aos="fade-right" data-aos-delay="300">Khám phá các bài viết mới nhất</h2>
					<a href="cac-bai-viet" title="Xem thêm" class="xemthem" data-aos="fade-left" data-aos-delay="450">Xem thêm</a>
				</div>
			</div>
            <?php
                $get_slider = $blog->show_1lastest_blog();
                            if($get_slider){
                                while($result_tt = $get_slider->fetch_assoc()){
                        
            ?>
			<div class="col-lg-7">
				<div class="tintuc-left" data-aos="zoom-in" data-aos-delay="400">
                    
					<img src="admin/uploads/<?php echo $result_tt['hinhanh'] ?>" alt="<?php echo $result_tt['tieude'] ?>">
					<a href="<?php echo $result_tt['url1'] ?>" title="<?php echo $result_tt['tendm'] ?>"><p class="theloai"><?php echo $result_tt['tendm'] ?></p></a>
					<a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>"><h3 class="tentin"><?php echo $result_tt['tieude'] ?></h3></a>
					<div class="viewtime"><span class="thoigian"><?php echo $fm->formatDate_Details($result_tt['thoigian']) ?></span></div>
					<p class="tomtat"><?php echo $fm->textShorten($result_tt['mota'],200) ?></p>
               
				</div>
			</div>
			<div class="col-lg-5">
				<div class="tintuc-slider" data-aos="fade-in" data-aos-delay="400">
                    <?php
                $get_slider2 = $blog->show_18lastest_blog($result_tt['id']);
                            if($get_slider2){
                                while($result_tt2 = $get_slider2->fetch_assoc()){
                        
            ?>
                <div class="tintuc-item" data-aos="fade-up" data-aos-delay="400">
                    <img src="admin/uploads/<?php echo $result_tt2['hinhanh'] ?>" alt="<?php echo $result_tt2['tieude'] ?>">
                    <a href="<?php echo $result_tt2['url1'] ?>" title="<?php echo $result_tt2['tendm'] ?>"><p class="theloai-right"><?php echo $result_tt2['tendm'] ?></p></a>
					<a href="tin-tuc/<?php echo $result_tt2['url'] ?>" title="<?php echo $result_tt2['tieude'] ?>"><h3 class="tentin-right"><?php echo $result_tt2['tieude'] ?></h3></a>
					<div class="viewtime-right"><span><?php echo $fm->formatDate_Details($result_tt2['thoigian']) ?></span></div>
					<p class="tomtat-right"><?php echo $fm->textShorten($result_tt2['mota'],140) ?></p>
                </div>
            <?php }} ?>
            </div>
			</div>
             <?php }} ?>
			<div class="col-lg-12">
				<a href="cac-bai-viet" title="Xem thêm" class="xemthem-mobile" data-aos="fade-up" data-aos-delay="700">Xem thêm</a>
			</div>

			
		</div>	

	</div>

	<div class="container-fluid">
		<div class="row fourth-row">
			<div class="col-lg-12"  style="padding: 0;">
                <div style="position:relative;">
                    <img src="images/midheader.jpg" width="100%" alt="Ảnh nền thứ 3 về du lịch" data-aos="fade-in">
                    <div class="lienhe" data-aos="fade-in" data-aos-delay="200">
                    	<div class="section" data-aos="fade-up" data-aos-delay="400">
<?php 
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['lienhe'])){
        $status = 0;
        $ten    = $_POST['hoten'];
        $email  = 'No Email';
        $sdt    = $_POST['sdt'];
        $chude  = $_POST['chude'];
        
        if($ten=='' || $sdt=='' || $chude=='') {
            echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Error!',
                            text: 'Hãy nhập đủ thông tin!',
                            icon: 'error'});                        
                            </script>";         
        }else{
            
                if(preg_match('/^[0-9]{10}+$/', $sdt)){
                    $query ="insert into lienhe(ten,email,sdt,chude,status) values('$ten','$email','$sdt','$chude','$status')";
                $result =$db->insert($query);
                if($result){
                    $ten = '';
                    $sdt = '';
                    echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Success!',
                            text: 'Liên hệ thành công! Chúng tôi sẽ liên hệ lại sau.',
                            icon: 'success'});                      
                            </script>";
                }else{
                    echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Error!',
                            text: 'Không thể liên hệ! Bạn hãy thử lại sau.',
                            icon: 'error'});                        
                            </script>";
                
                }
            }else{
                echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Error!',
                            text: 'Số điện thoại không hợp lệ!',
                            icon: 'error'});                        
                            </script>";
                
            }
        }


    } ?>
    <!--Section heading-->
    <h2 class=" text-center lienhe-title">Gửi cho chúng tôi</h2>
    <!--Section description-->
    <p class="text-center lienhe-content">Nếu bạn có bất kỳ thắc mắc nào. Đừng ngần ngại, hãy gửi ngay cho chúng tôi.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-12">
            <form action="" id="contact-form" name="contact-form" method="POST">
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                        	<label for="hoten" class="hoten">Họ tên:</label>
                            <input type="text" id="hoten" name="hoten" class="form-control" value="<?php if(isset($ten)){
                                echo $ten;
                            } ?>">                            
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                 <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                        	<label for="sdt" class="sdt">Số điện thoại:</label>
                            <input type="text" id="sdt" name="sdt" class="form-control" value="<?php if(isset($sdt)){
                                echo $sdt;
                            } ?>">                           
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                        	<label for="chude" class="chude">Nội dung:</label>
                            <textarea type="text" id="chude" name="chude" rows="3" class="form-control md-textarea"><?php if(isset($chude)){
                                echo $chude;
                            } ?></textarea>                            
                        </div>

                    </div>
                </div>
                <!--Grid row-->
                <div class="text-center text-md-left">
                    <button class="glow-on-hover" name="lienhe" type="submit">Gửi ngay <i class="bi bi-send"></i></button>
                </div>
            </form>

            
            <div class="status"></div>
        </div>
        <!--Grid column-->



    </div>

</div>
<?php if(isset($insert_lh)){
                        echo $insert_lh;
                    } ?>
                    </div>
                </div>

            
			</div>

			<div class="col-lg-12">
				<div class="section-mobile" data-aos="fade-in" data-aos-delay="200">
                    
    <!--Section heading-->
    <h2 class=" text-center lienhe-title">Gửi cho chúng tôi</h2>
    <!--Section description-->
    <p class="text-center lienhe-content">Nếu bạn có bất kỳ thắc mắc nào. Đừng ngần ngại, hãy gửi ngay cho chúng tôi.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-12">
            
            <form action="" id="contact-form" name="contact-form" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="hoten" class="hoten">Họ tên:</label>
                            <input type="text" id="hoten" name="hoten" class="form-control" value="<?php if(isset($ten)){
                                echo $ten;
                            } ?>">                            
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                 <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="sdt" class="sdt">Số điện thoại:</label>
                            <input type="text" id="sdt" name="sdt" class="form-control" value="<?php if(isset($sdt)){
                                echo $sdt;
                            } ?>">                           
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="chude" class="chude">Nội dung:</label>
                            <textarea type="text" id="chude" name="chude" rows="3" class="form-control md-textarea"><?php if(isset($chude)){
                                echo $chude;
                            } ?></textarea>                            
                        </div>

                    </div>
                </div>
                <!--Grid row-->
                    <div class="text-center text-md-left">
                        <button class="glow-on-hover" name="lienhe" type="submit">Gửi ngay <i class="bi bi-send"></i></button>
                    </div>
            </form>

            
            <div class="status"></div>
        </div>
        <!--Grid column-->



    </div>

</div>
			</div>
		</div>
	</div>

</div>

<?php
	include 'include/footer.php';
	
?>