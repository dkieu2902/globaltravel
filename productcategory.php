<?php
	if(!isset($_GET['url']) || $_GET['url']==NULL){
    echo "<script>window.location ='404.php'</script>";
   
}else{
    $url=$_GET['url'];
    
}    
     
?>
<?php
	include_once 'classes/category.php';
	$cat = new category();
	$getproductcat_byUrl = $cat->getproductcat_byUrl($url);
    			if($getproductcat_byUrl){
    				while ($result_name = $getproductcat_byUrl->fetch_assoc()) {
	      				$title=$result_name['title'];
	      				$description=$result_name['description'];
	      				$keywords=$result_name['keywords'];
	      				$duongdan='/'.$result_name['url'];
	      				$image='';
	      			}
	      		}
	      			else{
	      				include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
	$title = $result['tieude'];
	$description = $result['mota'];
	$keywords = $result['keywords'];
	$duongdan = '';
	$image = '';	
}}
	      			}   		
	      
	include 'include/header.php';
	
?>
    




<?php
                $getproductcat_byUrl = $cat->getproductcat_byUrl($url);
                if($getproductcat_byUrl){
                    while ($result_pc = $getproductcat_byUrl->fetch_assoc()) {
                        if($result_pc['kieuhienthi']=='3'){
            ?>

    <div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">
                <div class="header-tintuc">
                <?php
                $show_blogbydm = $blog->show_blogbydm($result_pc['madm']);
                if($show_blogbydm){
                $blogcount= mysqli_num_rows($show_blogbydm);
                if($blogcount>=3){


                $get_slider = $blog->show_blogbydm($result_pc['madm']);
                            if($get_slider){
                                while($result_slider = $get_slider->fetch_assoc()){
                        
            ?>
                <div class="header-item">
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><img src="admin/uploads/<?php echo $result_slider['slider'] ?>" alt="<?php echo $result_slider['tieude'] ?>"></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><h3 class="header-tentin"><?php echo $result_slider['tieude'] ?></h3></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>" class="chitiettin"><i class="bi bi-arrow-right fa-3x"></i></a>
                </div>
            <?php }}}else{ 
                $get_slider = $blog->show_lastest_blog();
                            if($get_slider){
                                while($result_slider = $get_slider->fetch_assoc()){
                        
            ?>
                <div class="header-item">
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><img src="admin/uploads/<?php echo $result_slider['slider'] ?>" alt="<?php echo $result_slider['tieude'] ?>"></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><h3 class="header-tentin"><?php echo $result_slider['tieude'] ?></h3></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>" class="chitiettin"><i class="bi bi-arrow-right fa-3x"></i></a>
                </div>

                <?php }}}}else{ $get_slider = $blog->show_lastest_blog();
                            if($get_slider){
                                while($result_slider = $get_slider->fetch_assoc()){?>
                 <div class="header-item">
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><img src="admin/uploads/<?php echo $result_slider['slider'] ?>" alt="<?php echo $result_slider['tieude'] ?>"></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><h3 class="header-tentin"><?php echo $result_slider['tieude'] ?></h3></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>" class="chitiettin"><i class="bi bi-arrow-right fa-3x"></i></a>
                </div>                  
                                <?php }}} ?>
            </div>
            <?php
                $show_blogbydm = $blog->show_blogbydm($result_pc['madm']);
                if($show_blogbydm){
                $blogcount= mysqli_num_rows($show_blogbydm);
                if($blogcount>=3){ ?>
            <h2 class="header-khampha"><?php echo $result_pc['tendm'] ?></h2>
        <?php }else{ ?>
            <h2 class="header-khampha">Khám phá ngay các bài viết mới nhất</h2>
        <?php }}else{ ?>
            <h2 class="header-khampha">Khám phá ngay các bài viết mới nhất</h2>
        <?php } ?>
            </div>
        </div>
    </div>

    <div class="link-content" style="margin-bottom: 15px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-links">
                <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
                <span>></span>
                <a href="cac-bai-viet" title="Bài viết">Bài viết</a>
                <span>></span>
                <span><?php echo $result_pc['tendm'] ?></span>
            </div>
        </div>
    </div>
</div>

    <div class="container product-container">
    <div class="row first-row">
        <div class="col-lg-12">
            <h2><i class="bi bi-postcard"></i> Bài viết thú vị</h2>
        </div>
        <?php
                $show_blogbydm = $blog->show_blogbydm($result_pc['madm']);
                if($show_blogbydm){
                    while ($result_tt = $show_blogbydm->fetch_assoc()) {
            ?>
        <div class="col-lg-12 mb-4">
  <div class="row align-items-center g-3 shadow p-3 rounded bg-white">
    <div class="col-md-4">
      <a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>">
        <img src="admin/uploads/<?php echo $result_tt['hinhanh'] ?>" alt="<?php echo $result_tt['tieude'] ?>" class="img-fluid rounded">
      </a>
    </div>
    <div class="col-md-8">
      <h6 class="theloai4 mb-2 text-danger"><?php echo $result_tt['tendm'] ?></h6>
      <a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>">
        <h4 class="tieude4 mb-2"><?php echo $fm->textShorten($result_tt['tieude'], 60) ?></h4>
      </a>
      <p class="tomtat4 mb-2"><?php echo $fm->textShorten($result_tt['mota'], 120) ?></p>
      <div class="viewtime4 text-muted">
        <span><i class="bi bi-calendar3 me-1"></i> <?php echo $fm->formatDate_Details($result_tt['thoigian']) ?></span>
        <span class="ms-3"><i class="bi bi-eye me-1"></i> <?php echo $result_tt['luotxem'] ?></span>
      </div>
    </div>
  </div>
</div>     
        <?php }}else{
            echo 'Danh mục này hiện không có bài viết. Bạn hãy thử chọn danh mục khác!';
        } ?>


    </div>

</div>

<?php 
    }else{

 ?>
<div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">

                    <img src="images/shortback.jpeg" alt="Ảnh về du lịch" class="backimg">

            <h2 class="fix-h2">Khám phá nhiều hơn tại đây</h2>
            </div>
        </div>
    </div>
    <?php 
        $getproductcat_byUrl = $cat->getproductcat_byUrl($url);
                if($getproductcat_byUrl){
                    while ($result_name = $getproductcat_byUrl->fetch_assoc()) {
     ?>
    <div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;margin-bottom: 15px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-links">
          <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
          <span>/</span>
          <span><?php echo $result_name['tendm'] ?></span>
        </div>
      </div>
    </div>
</div>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <?php
                $gettour = $product->gettourbydm($url);
                            if($gettour){
                                while($tour = $gettour->fetch_assoc()){
                                    $departureDates = $product->getNearestDepartureDate($tour['id']);
                        
            ?>
            <div class="card mb-4 tour-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="position-relative h-100">
                            <img src="admin/uploads/<?php echo $tour['hinhanh']; ?>" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="<?php echo $tour['tieude']; ?>">
                            <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 rounded">Tiết kiệm</span>
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
                                        <a href="#" class="ms-2"><i class="bi bi-arrow-right-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small">Giá từ:</div>
                                    <div class="fs-5 fw-bold text-danger"><?php echo $fm->format_currency($tour['giatu']); ?> đ</div>
                                </div>
                                <a href="tour/<?php echo $tour['url']; ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }}else{
                    echo 'Không có tour bạn cần tìm, bạn hãy tìm dòng tour khác xem sao. ';
                }
                     ?>

        </div>
    </div>
</div>

<?php 
    }}
 ?>
 <?php 
 }}}
  ?>

 <?php
	include 'include/footer.php';
	
?>