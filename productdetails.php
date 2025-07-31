<?php
	 if(!isset($_GET['url']) || $_GET['url']==NULL){
   		echo "<script>window.location ='404.php'</script>";
   
}else{
    $url=$_GET['url'];
}
?>
<?php
	$_SESSION['didVisit'] = 1;
	include_once 'classes/product.php';
	$product = new product();
	$get_tourdetailsbyUrl = $product->get_tourdetailsbyUrl($url);
    			if($get_tourdetailsbyUrl){
    				while ($result_details = $get_tourdetailsbyUrl->fetch_assoc()) {
	      				$title=$result_details['title'];
	      				$description=$result_details['description'];
	      				$keywords=$result_details['keywords'];
	      				$duongdan='/'.$result_details['url1'].'/'.$result_details['url'];
	      				$image='admin/uploads/'.$result_details['hinhanh'];
$productSchema = 
[
  "@context" => "https://schema.org",
  "@type" => "Product",
  "name" => $result_details['tieude'],
  "image" => "http://localhost/globaltour/admin/uploads/".$result_details['hinhanh'],
     
  "description" => $result_details['description'],
  "brand" => [
    "@type" => "Brand",
    "name" => "Viettel"
  ],
  "sku" => $result_details['id'],
  "aggregateRating" => [
    "@type" => "AggregateRating",
    "ratingValue" => 5,
    "reviewCount" => 63
  ],
  "review" => [
    [
      "@type" => "Review",
      "reviewBody" => $result_details['description'],
      "reviewRating" => [
        "@type" => "Rating",
        "ratingValue" => 5,
        "bestRating" => 5
      ],
      "author" => [
        "@type" => "Person",
        "name" => "Dương Nguyễn Huyền Trang"
      ]
    ]
  ],
  "offers" => [
        "@type" => "Offer",
        "url" => "http://localhost/globaltour/tour/".$result_details['url'],
        "itemCondition" => "https://schema.org/NewCondition",
      "availability" => "https://schema.org/InStock",
        "priceSpecification" => [
          "@type" => "PriceSpecification",
          "price" => $result_details['giatu'],
          "priceCurrency" => "VND"
        ],
        "hasMerchantReturnPolicy" => [
          "@type" => "MerchantReturnPolicy",
          "applicableCountry" => "VN",
          "returnPolicyCategory" => "https://schema.org/OnlineReturn",
          "merchantReturnDays" => 60,
          "returnMethod" => "https://schema.org/ReturnByMail",
          "returnFees" => "https://schema.org/FreeReturn"
        ],
        "shippingDetails" => [
          "@type" => "OfferShippingDetails",
          "shippingRate" => [
            "@type" => "MonetaryAmount",
            "value" => 4.59,
            "currency" => "VND"
          ],
          "shippingDestination" => [
            "@type" => "DefinedRegion",
            "addressCountry" => "VN"
          ],
          "deliveryTime" => [
            "@type" => "ShippingDeliveryTime",
            "handlingTime" => [
              "@type" => "QuantitativeValue",
              "minValue" => 0,
              "maxValue" => 1,
              "unitCode" => "DAY"
            ],
            "transitTime" => [
              "@type" => "QuantitativeValue",
              "minValue" => 1,
              "maxValue" => 5,
              "unitCode" => "DAY"
            ]
          ]
      ]
      ],
  "manufacturer" => [
    "@type" => "Organization",
    "name" => "Bvico"
  ],
  "category" => $result_details['tendm']
];

$productSchemaJson = json_encode($productSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);	      				
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
	$productSchemaJson = '';
}}
	      			}
	include 'include/header.php';
?>
<script type="application/ld+json">
   <?php echo $productSchemaJson; ?>
</script>

<?php 
$login_check = Session::get('customer_login');
if($login_check==true){
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['datlich'])){
      $customer_id = Session::get('customer_id');
        $options = $_POST['options'];
        $quantity = $_POST['quantity'];
        $getthoigiandibyid = $product->getthoigiandibyid($options);
          if($getthoigiandibyid){
            while ($result_check = $getthoigiandibyid->fetch_assoc()) {
              if($quantity>$result_check['sochocon']){
                echo "<script language='javascript'>                                  
                    Swal.fire({
                        title: 'Error!',
                        text: 'Bạn đã đặt vượt quá số chỗ còn! Chỉ còn " . $result_check['sochocon'] . " chỗ',
                        icon: 'error'
                    });                        
                </script>";
 
              }else{
                $booktour = $product->booktour($quantity,$options,$customer_id,"","","",$url);
                if($booktour=='00'){
                  echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Success!',
                            text: 'Đăng nhập thành công!',
                            icon: 'success'});                        
                            
                    setTimeout(function(){
                        window.open('cam-on-quy-khach', '_self', 1);
                    }, 1000); // Chờ 2 giây trước khi chuyển trang
                </script>";

                }else{
                  echo "<script language='javascript'>                                  
                    Swal.fire({
                        title: 'Error!',
                        text: 'Có vấn đề xảy ra khi đặt lịch',
                        icon: 'error'
                    });                        
                </script>";
                }
              }
            }}
    }

}else{
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['datlich'])){
        $options = $_POST['options'];
        $quantity = $_POST['quantity'];
        $getthoigiandibyid = $product->getthoigiandibyid($options);
          if($getthoigiandibyid){
            while ($result_check = $getthoigiandibyid->fetch_assoc()) {
              if($quantity>$result_check['sochocon']){
                echo "<script language='javascript'>                                  
                    Swal.fire({
                        title: 'Error!',
                        text: 'Bạn đã đặt vượt quá số chỗ còn! Chỉ còn " . $result_check['sochocon'] . " chỗ',
                        icon: 'error'
                    });                        
                </script>";
 
              }else{
                $hoten = $_POST['hoten'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                if(!$hoten || !$sdt){
                  echo "<script language='javascript'>                                  
                    Swal.fire({
                        title: 'Error!',
                        text: 'Bạn chưa nhập đủ thông tin họ tên hoặc SĐT',
                        icon: 'error'
                    });                        
                </script>";
                }else{
                  $booktour = $product->booktour($quantity,$options,0,$hoten,$sdt,$email,$url);
                if($booktour=='00'){
                  echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Success!',
                            text: 'Đăng nhập thành công!',
                            icon: 'success'});                        
                            
                    setTimeout(function(){
                        window.open('cam-on-quy-khach', '_self', 1);
                    }, 1000); // Chờ 2 giây trước khi chuyển trang
                </script>";
                }else{
                  echo "<script language='javascript'>                                  
                    Swal.fire({
                        title: 'Error!',
                        text: 'Có vấn đề xảy ra khi đặt lịch',
                        icon: 'error'
                    });                        
                </script>";
                }
                }
              }
            }}
    }
}



 ?>

<?php
    			$getproductbyUrl = $product->get_tourdetailsbyUrl($url);
    			if($getproductbyUrl){
    				while ($result_details = $getproductbyUrl->fetch_assoc()) {   				  				
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
          <span><?php echo $result_details['tieude'] ?></span>
        </div>
      </div>
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2><?php echo $result_details['tieude']; ?></h2>
    </div>
      <div class="col-lg-8">
        <div class="pt-2">
              <div class="slider-for">
                <?php
                  $get_sptrung = $product->gethinhanhtourbytour($result_details['id']);
                  if($get_sptrung){
                    while ($result_trung = $get_sptrung->fetch_assoc()) {
                      
                ?>
                <div class="for-item">
                  <img src="admin/uploads/<?php echo $result_trung['hinhanh']?>" width="100%" alt="Ảnh sản phẩm">
                </div>
              <?php }} ?>
              </div>
              <div class="slider-nav">
                <?php
                  $get_sptrung = $product->gethinhanhtourbytour($result_details['id']);
                  if($get_sptrung){
                    while ($result_trung = $get_sptrung->fetch_assoc()) {
                      
                ?>
                <div class="nav-item">
                  <img src="admin/uploads/<?php echo $result_trung['hinhanh']?>" alt="Ảnh sản phẩm" width="100%">
                </div>
              <?php }} ?>
              </div>
            </div>
    </div>
    <div class="col-lg-4">
            <div class="booking-card" id="bookingCard">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Giá từ:</h5>
                        <h3 class="text-danger fw-bold"><?php echo $fm->format_currency($result_details['giatu']); ?> đ <small>/ Khách</small></h3>
                        
                        <div class="d-flex align-items-center my-3">
                            <i class="bi bi-tag me-2"></i>
                            <span>Mã chương trình: <?php echo $result_details['matour'] ?></span>
                        </div>

                        <form method="POST" action="">
                          <div class="lichkhoihanh">
                          <?php
                  $getlichkhoihanhbytour = $product->getlichkhoihanhbytour($result_details['id']);
                  if($getlichkhoihanhbytour){
                    while ($result_tgd = $getlichkhoihanhbytour->fetch_assoc()) {                     
                ?>
                
                  <input type="radio" class="btn-check" name="options" id="option<?php echo $result_tgd['id']; ?>" value="<?php echo $result_tgd['id']; ?>" autocomplete="off">
                  <label class="btn btn-secondary" for="option<?php echo $result_tgd['id']; ?>"><?php echo $fm->formatDateToDayMonth($result_tgd['tieude']); ?></label>
                
                <?php 
                  }}
                     ?>
                        </div>
                        <div class="quantity-container mb-3" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <label class="form-control text-center">Số lượng: </label>
                            <input type="number" name="quantity" class="form-control text-center" style="width: 70px;" min="1" max="20" value="1" required>
                            
                        </div>
                        <?php 
                        if($login_check==false){

                         ?>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="hoten" placeholder="Họ và tên" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" name="sdt" placeholder="Số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <?php 
                      }
                         ?>
                        
                        
                        <button class="btn btn-primary w-100 mb-2" type="submit" name="datlich">
                            <i class="bi bi-calendar-check me-2"></i>
                            Đặt lịch
                        </button>
                        </form>
                        
                        <div class="d-flex mt-2">
                            <a href="tel:0353829581" class="btn btn-outline-primary w-100 me-2">
                                <i class="bi bi-telephone-fill me-2"></i>
                                0353829581
                            </a>
                            <a href="lien-he" class="btn btn-outline-primary w-100">
                                <i class="bi bi-chat-dots me-2"></i>
                                Liên hệ tư vấn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <p><?php echo $result_details['tomtat']; ?></p>
      <div class="noidungstyle">
          <?php
                                        $noidung=str_replace('<table','<div class="table_sp"><table',$result_details['mota']);
                                        echo $noidung=str_replace('</table>','</table></div>',$noidung);

                                        ?>
          
        </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
        <!-- Left side: Image gallery and content -->
        <div class="col-lg-8">  

            <!-- LỊCH TRÌNH -->
            <div class="tour-schedule mt-4">
                <h3 class="text-uppercase text-center">LỊCH TRÌNH</h3>
                
                <div class="accordion" id="accordionSchedule">

                    <?php
                  $getlichtrinhbytour = $product->getlichtrinhbytour($result_details['id']);
                  if($getlichtrinhbytour){
                    while ($result_lt = $getlichtrinhbytour->fetch_assoc()) {
                      
                ?>
                    <div class="accordion-item">
                        <h4 class="accordion-header" id="headingDay2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDay<?php echo $result_lt['id']?>" aria-expanded="false" aria-controls="collapseDay<?php echo $result_lt['id']?>">
                                <?php echo $result_lt['tieude']?>
                            </button>
                        </h4>
                        <div id="collapseDay<?php echo $result_lt['id']?>" class="accordion-collapse collapse" aria-labelledby="headingDay<?php echo $result_lt['id']?>" data-bs-parent="#accordionSchedule">
                            <div class="accordion-body">
                                <div class="noidungstyle">
          <?php
                                        $noidung=str_replace('<table','<div class="table_sp"><table',$result_lt['noidung']);
                                        echo $noidung=str_replace('</table>','</table></div>',$noidung);

                                        ?>
          
        </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                  }}
                     ?>
                </div>
            </div>
            
            <!-- NHỮNG THÔNG TIN CẦN LƯU Ý -->
            <div class="tour-notes mt-4">
                <h3 class="text-uppercase text-center">NHỮNG THÔNG TIN CẦN LƯU Ý</h3>
                
                <div class="accordion" id="accordionNotes">
                    <?php
                  $getluuybytour = $product->getluuybytour($result_details['id']);
                  if($getluuybytour){
                    while ($result_ly = $getluuybytour->fetch_assoc()) {
                      
                ?>
                    <div class="accordion-item">
                        <h4 class="accordion-header" id="headingNote<?php echo $result_ly['id']?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNote<?php echo $result_ly['id']?>" aria-expanded="false" aria-controls="collapseNote<?php echo $result_ly['id']?>">
                                <?php echo $result_ly['tieude']?>
                            </button>
                        </h4>
                        <div id="collapseNote<?php echo $result_ly['id']?>" class="accordion-collapse collapse" aria-labelledby="headingNote<?php echo $result_ly['id']?>" data-bs-parent="#accordionNotes">
                            <div class="accordion-body">
                                <div class="noidungstyle">
          <?php
                                        $noidung=str_replace('<table','<div class="table_sp"><table',$result_ly['noidung']);
                                        echo $noidung=str_replace('</table>','</table></div>',$noidung);

                                        ?>
          
        </div>
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
</div>

<div class="container-fluid tour-info-overlay mt-5" style="position: relative; padding: 0;">
    <div class="tour-background" style="background-image: url('images/hoaanhdao.jpg');">
        <div class="overlay-content">
            <h2 class="text-uppercase text-white mb-5">THÔNG TIN THÊM VỀ CHUYẾN ĐI</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <div class="info-icon mb-2">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h5>Điểm tham quan</h5>
                        <p><?php echo $result_details['diemthamquan'] ?></p>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="info-icon mb-2">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <h5>Ẩm thực</h5>
                        <p><?php echo $result_details['amthuc'] ?></p>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="info-icon mb-2">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5>Đối tượng thích hợp</h5>
                        <p><?php echo $result_details['doituongthichhop'] ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <div class="info-icon mb-2">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h5>Thời gian lý tưởng</h5>
                        <p><?php echo $result_details['thoigianlytuong'] ?></p>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="info-icon mb-2">
                            <i class="bi bi-bus-front"></i>
                        </div>
                        <h5>Phương tiện</h5>
                        <p><?php echo $result_details['phuongtien'] ?></p>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="info-icon mb-2">
                            <i class="bi bi-tag"></i>
                        </div>
                        <h5>Khuyến mãi</h5>
                        <p><?php echo $result_details['khuyenmai'] ?></p>
                    </div>
                </div>
            </div>

            <!-- CÁC CHƯƠNG TRÌNH KHÁC -->
            <div class="container other-tours mt-3" id="otherTours">
                <h3 class="text-uppercase">CÁC CHƯƠNG TRÌNH KHÁC</h3>
                
                <div class="row">
                    <!-- Tour 1 -->
                    <?php
                $gettour = $product->getcacchuongtrinhkhac($url);
                            if($gettour){
                                while($result = $gettour->fetch_assoc()){
                        
            ?>
                    <div class="col-md-4">
                        <div class="tour-card">
                            <div class="tour-image">
                                <img src="admin/uploads/<?php echo $result['hinhanh']; ?>" class="img-fluid w-100" alt="Tour image">
                                <a href="#" class="wishlist-icon"><i class="bi bi-heart"></i></a>
                                <div class="tour-info">
                                    <h5 class="tour-title"><?php echo $result['tieude']; ?></h5>
                                    <div class="tour-meta">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-geo-alt me-2"></i>
                                            <span>Khởi hành: <?php echo $result['khoihanh']; ?></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-tag me-2"></i>
                                            <span>Mã chương trình: <?php echo $result['matour']; ?> (<?php echo $result['thoigianchuyen']; ?>)</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-0">Giá từ</p>
                                            <p class="text-danger fw-bold mb-0"><?php echo $fm->format_currency($result['giatu']); ?> đ</p>
                                        </div>
                                        <a href="tour/<?php echo $result['url']; ?>" class="btn btn-outline-primary btn-sm">Xem chi tiết →</a>
                                    </div>
                                </div>
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
</div>

<style>
    .lichkhoihanh{
      position: relative;
      z-index: 1;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      justify-content: center;
      margin-bottom: 25px;
    }
    
    .lichkhoihanh .btn-secondary {
      border-radius: 8px;
      padding: 10px 16px;
      transition: all 0.3s ease;
      background-color: #f8f9fa;
      color: #495057;
      border: 1px solid #dee2e6;
      font-weight: 500;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .lichkhoihanh .btn-secondary:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      background-color: #e9ecef;
      border-color: #ced4da;
    }
    
    .lichkhoihanh .btn-check:checked + .btn-secondary {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }
    
    /* Select first item by default */
    .lichkhoihanh .btn-check:first-of-type:checked + .btn-secondary {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }
    
    /* For mobile screens */
    @media (max-width: 576px) {
      .lichkhoihanh {
        overflow-x: auto;
        flex-wrap: nowrap;
        justify-content: flex-start;
        padding-bottom: 10px;
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      
      .lichkhoihanh::-webkit-scrollbar {
        display: none;
      }
      
      .lichkhoihanh .btn-secondary {
        white-space: nowrap;
      }
    }
    
    /* Sticky booking card */
    .booking-card.sticky {
        position: fixed;
        top: 70px;
        z-index: 100;
    }
    
    /* Accordion styles */
    .accordion-button {
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: #e7f1ff;
        color: #0c63e4;
    }
    
    /* Tour card hover effect */
    .tour-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        
        margin-bottom: 20px;
    }
    
    .tour-image {
        position: relative;
        height: 100%;
        width: 100%;
    }
    
    .tour-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .wishlist-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255,255,255,0.7);
        color: #dc3545;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
    
    .tour-info {
        position: absolute;
        bottom: 20px;
        left: 0;
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
        color: white;
        padding: 15px;
        transform: translateY(70%);
        transition: transform 0.3s ease;
    }
    
    .tour-card:hover .tour-info {
        transform: translateY(0);
        bottom: 0;
    }
    
    .tour-title {
        font-size: 16px;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .tour-meta {
        font-size: 13px;
        display: none;
    }
    
    .tour-card:hover .tour-meta {
        display: block;
    }
    
    
    .tour-background {
        position: relative;
        background-size: cover;
        background-position: center;
        min-height: 500px;
        width: 100%;
    }
    
    .tour-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
    }
    
    .overlay-content {
        position: relative;
        padding: 40px 0;
        color: white;
        text-align: center;
    }
    
    .overlay-content h5 {
        color: white;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .overlay-content p {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .info-icon {
        font-size: 2.5rem;
        color: #fff;
        margin-bottom: 15px;
    }
    
    .info-icon i {
        font-size: 2.5rem;
    }
    
    @media (max-width: 991px) {
        .booking-card.sticky {
            width: 100%;
            position: relative;
            top: 0;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select first radio button by default
    const firstRadio = document.querySelector('.lichkhoihanh .btn-check');
    if (firstRadio) {
        firstRadio.checked = true;
    }

});
</script>

<?php }} ?>


 <?php
	include 'include/footer.php';
	
?>