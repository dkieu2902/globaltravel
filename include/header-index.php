<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';

    spl_autoload_register(function($className){
        include_once "classes/".$className.".php";
    });
        
    $post = new post();
    $blog = new blog();   

    $db = new database();
    $fm = new Format();
    $us = new user();
    $cat = new category();
    $cart = new cart();
    $cs = new customer();
    $product = new product();
 ?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" class="mdl-js">
<?php 
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>
<!-- Google Tag Manager -->
<?php echo $result['googleanalytics']?>
<?php echo $result['webmastertool']?>

<!-- End Google Tag Manager -->
<?php }} ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
<title><?php echo $title; ?></title>
<meta name="title" content="<?php echo $title; ?>">
<meta name="description" content="<?php echo $description; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="robots" content="index, follow">
<link rel="canonical" href="http://localhost<?php echo $duongdan; ?>">

<!-- dublin core -->
<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/">
<meta name="DC.title" content="<?php echo $title; ?>">
<meta name="DC.identifier" content="http://localhost<?php echo $duongdan; ?>">
<meta name="DC.description" content="<?php echo $description; ?>">
<meta name="DC.subject" content="<?php echo $title; ?>">
<meta name="DC.language" scheme="UTF-8" content="vi">
<meta itemprop="name" content="<?php echo $title; ?>">
<meta itemprop="description" content="<?php echo $description; ?>">
<meta itemprop="image" content="http://localhost/globaltravel/<?php echo $image; ?>">

<meta property="og:locale" content="vi_VN">
<meta property="og:url" content="http://localhost<?php echo $duongdan; ?>">
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:image" content="http://localhost/globaltravel/<?php echo $image; ?>">
<meta property="og:site_name" content="http://localhost/globaltravel/">

<meta name="twitter:card" content="<?php echo $title; ?>">
<meta name="twitter:site" content="<?php echo $title; ?>">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:creator" content="<?php echo $title; ?>">


<?php 
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>
<link rel="icon" type="image/x-icon" href="admin/uploads/<?php echo $result['logo']?>">
<?php }} ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<link href="http://localhost/globaltravel/omoda-update/css/animations.css?v=1.1" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<link href="http://localhost/globaltravel/css/style-index.css?v=1.1" rel="stylesheet" type="text/css"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/globaltravel/js/script.js?v=1.2" type="text/javascript"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="http://localhost/globaltravel/omoda-update/js/animation.js?v=1.1" type="text/javascript"></script>

<base href="http://localhost/globaltravel/">

<?php 
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        while($result = $cauhinh->fetch_assoc()){
$homepageSchema = [
   "@context" => "http://schema.org",
   "@type" => "Organization",
   "name" => $result['tieude'],
   "url" => "http://localhost/globaltravel/",
   "logo" => "http://localhost/globaltravel/admin/uploads/".$result['logo'],
   "sameAs" => [
      "https://www.facebook.com/trang.mun.37819"
   ]
];


$homepageSchemaJson = json_encode($homepageSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                                  

// Tạo một mảng các câu hỏi và câu trả lời
$faqs = array(
  array(
    'question' => 'Đặt lịch online du lịch, nghỉ mát?',
    'answer' => 'Truy cập ngay http://localhost/globaltravel/'
  ),
  
);

// Chuyển đổi mảng thành chuỗi JSON
$schema = array(
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => array()
);

foreach ($faqs as $faq) {
  $question = $faq['question'];
  $answer = $faq['answer'];
  
  $schema['mainEntity'][] = array(
    '@type' => 'Question',
    'name' => $question,
    'acceptedAnswer' => array(
      '@type' => 'Answer',
      'text' => $answer
    )
  );
}

$json = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

}}
?>


<script type="application/ld+json">
  <?php echo $json; ?>
</script>

<script type="application/ld+json">
    <?php echo $homepageSchemaJson; ?>
</script>
</head>
<body>
    <div class="container-fluid" id="scroll-nav" style="background-color: #14304F;z-index: 100;">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="nav1">       
        

            <ul class="menu">
                <li>
                    <a href="/" title="Trang chủ">TRANG CHỦ</a>
                </li>

                <li>

                <!-- First Tier Drop Down -->
                
                <a href="cac-tour" title="danh mục">DANH MỤC </a>
                
                <ul class="ul12">
                <?php
                        $show_product = $cat -> show_category1();
                        if($show_product){
                            while ($result_con = $show_product->fetch_assoc()) {                                   
            
                    ?>                    
                        <li><a href="<?php echo $result_con['url']?>" title="<?php echo $result_con['tendm']?>"><?php echo $result_con['tendm']?></a></li>
                        <?php
                    }
                        }
                ?>      
                    <li class="li-xemall1"><a href="cac-tour" title="Xem tất cả" style="color:#fff;text-align: center;">Xem tất cả</a></li>        
                </ul>
                </li> 

                <li>

                <!-- First Tier Drop Down -->
                
                <a href="cac-bai-viet" title="Bài viết">BÀI VIẾT </a>
                
                <ul class="ul12">
                <?php
                        $show_category_fontend = $post -> show_category_fontend();
                        if($show_category_fontend){
                            while ($result_con = $show_category_fontend->fetch_assoc()) {                                   
            
                    ?>                    
                        <li><a href="<?php echo $result_con['url']?>" title="<?php echo $result_con['tendm']?>"><?php echo $result_con['tendm']?></a></li>
                        <?php
                    }
                        }
                ?>    
                        <li class="li-xemall1"><a href="cac-bai-viet" title="Xem tất cả" style="color:#fff;text-align: center;">Xem tất cả</a></li>          
                </ul>
                </li>

                <li>
                    <a href="cac-tour" title="Đi đến các tour">TOUR</a>
                </li> 
                <?php
                        $login_check = Session::get('customer_login');
                        if($login_check==true){
                            $customer_id = Session::get('customer_id');
                            $check_order1 = $cart->check_order1($customer_id);
                            if($check_order1){
                                echo '<li><a href="tour-da-dat" title="Tour đã đặt">TOUR ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        
                        }else{
                            $check_order = $cart->check_order();
                            if($check_order){
                                echo '<li><a href="tour-da-dat" title="Tour đã đặt">TOUR ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        }
                                                
                          ?> 
                <li>
                    <a href="lien-he" title="Liên hệ">LIÊN HỆ</a>
                </li>
            
                

            </ul>
            
        </div>
            </div>
            <div class="col-lg-2" style="position:relative;display: flex;">
                
            <?php
                    if(isset($_GET['customer_id'])){
                        $customer_id = $_GET['customer_id'];


                        Session::destroy();
                        
                    }
                  ?>
                <?php
                    ob_start();
                    $name = Session::get('customer_name');
                    $login_check = Session::get('customer_login');
                    if($login_check==false){
                        echo '<a href="dang-nhap" title="Thành viên" class="dangnhap-top">Thành viên <i class="bi bi-person"></i></a>';
                        
                    }else{?>
                      <div class="taikhoan-top">
                          <div class="dropdown">
                          <button onclick="myFunction1()" class="dropbtn1"><?php echo $name; ?> <i class="bi bi-person"></i></button>
                          <div id="myDropdown1" class="dropdown-content1">
                            <a href="lich-su-dat-tour" title="Lịch sử đặt tour"><i class="bi bi-hourglass"></i> Lịch sử</a>
                            <a href="thong-tin-thanh-vien" title="Thông tin"><i class="bi bi-info-circle"></i> Thông tin</a>
                            <a href="doi-mat-khau" title="Đổi mật khẩu"><i class="bi bi-key"></i> Đổi mật khẩu</a>
                            <a href="?customer_id=<?php echo Session::get('customer_id') ?>" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
                          </div>
                        </div>
                      </div>

                      <?php  
                    }

                ?>
                    <div style="position:absolute;top: 25px;right: 10%; ">
                    <div class="opensearch" tabindex="0" ><span onclick="showBar()"><i class="bi bi-search"></i>                    
                    </span>

                    <div id="form-timkiem" class="form-timkiem">
                        <form style="display:flex;" action="tim-kiem" method="post">
                              <input type="text" name="tukhoa" placeholder="Tìm kiếm...">
                              <button type="submit" name="search"><i class="bi bi-search" style="color:black;"></i></button>
                              <span class="dongtimkiem" onclick="hideBar()"><i class="bi bi-x-lg"></i></span>                         
                        </form>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid container-header" >
        <div class="row row-header">
            <div class="col-12 logo-res">
                <p class="h3 text-center"><a href="/" title="Trang chủ"><img src="images/logo.png" alt="Logo du lịch" width="100px"></a></p>
            </div>
            
            <div class="col-12">
                    <nav class="nav2" id="navbar"> 
                    <div style="display:flex;position: relative;">
                        <label for="drop" class="toggle"><i id="icon" class="fa fa-bars"></i></label>
                        <p class="logo-mobile"><a href="/" title="Trang chủ"><img src="images/logo.png" alt="Logo du lịch" width="70px"></a></p>
                        <div class="timkiem-mobile">
                            <div class="opensearch3" tabindex="0" ><span style="color: #fff;" onclick="showBar3()"><i class="bi bi-search"></i>  </span>                  
                                        
                        <div id="form-timkiem3" class="form-timkiem">
                            <form style="display:flex;" action="tim-kiem" method="post">
                                  <input type="text" name="tukhoa" placeholder="Tìm kiếm...">
                                  <button type="submit" name="search"><i class="bi bi-search"></i></button>
                                  <span class="dongtimkiem" onclick="hideBar3()"><i class="bi bi-x-lg"></i></span>                         
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>     
       
        
        <input type="checkbox" id="drop" />
            <ul class="menu" >
                <li>
                    <a href="/" title="Trang chủ">TRANG CHỦ</a>
                </li>

                <li>                   
                <!-- First Tier Drop Down -->
                <div style="display:flex;">
                   
                <a class="menu-mobile" href="cac-tour" title="Khu vực">DANH MỤC</a>
               
                <label for="drop-1" class="toggle"><i class="bi bi-chevron-down"></i></label>
                </div>

                <a class="menu-pc" href="cac-tour" title="danh mục">DANH MỤC </a>
               
                <input type="checkbox" id="drop-1"/>
                <ul class="ul12">
                    
                        <?php
                        $show_product = $cat -> show_category1();
                        if($show_product){
                            while ($result_con = $show_product->fetch_assoc()) {                                    
            
                    ?>                    
                        <li><a href="<?php echo $result_con['url']?>" title="<?php echo $result_con['tendm']?>"><?php echo $result_con['tendm']?></a></li>
                        <?php
                    }
                        }
                ?>
                        <li class="li-xemall"><a href="cac-tour" title="Xem tất cả" style="color:black;text-align: center;">Xem tất cả</a></li> 
                                    
                </ul>
                </li>

                <li>                   
                <!-- First Tier Drop Down -->
                <div style="display:flex;">
                   
                <a class="menu-mobile" href="cac-bai-viet" title="Bài viết">BÀI VIẾT</a>
               
                <label for="drop-2" class="toggle"><i class="bi bi-chevron-down"></i></label>
                </div>

                <a class="menu-pc" href="cac-bai-viet" title="Bài viết">BÀI VIẾT </a>
               
                <input type="checkbox" id="drop-2"/>
                <ul class="ul12">
                    
                        <?php
                        $show_category_fontend = $post -> show_category_fontend();
                        if($show_category_fontend){
                            while ($result_con = $show_category_fontend->fetch_assoc()) {                                    
            
                    ?>                    
                        <li><a href="<?php echo $result_con['url']?>" title="<?php echo $result_con['tendm']?>"><?php echo $result_con['tendm']?></a></li>
                        <?php
                    }
                        }
                ?>
                        <li class="li-xemall"><a href="cac-bai-viet" title="Xem tất cả" style="color:black;text-align: center;">Xem tất cả</a></li>  
                                    
                </ul>
                </li>

                <li>
                    <a href="cac-tour" title="Đi đến các tour">TOUR</a>
                </li> 
                <?php
                        $login_check = Session::get('customer_login');
                        if($login_check==true){
                            $customer_id = Session::get('customer_id');
                            $check_order1 = $cart->check_order1($customer_id);
                            if($check_order1){
                                echo '<li><a href="tour-da-dat" title="Tour đã đặt">TOUR ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        
                        }else{
                            $check_order = $cart->check_order();
                            if($check_order){
                                echo '<li><a href="tour-da-dat" title="Tour đã đặt">TOUR ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        }
                                                
                          ?>  

                <li>
                    <a href="lien-he" title="Liên hệ">LIÊN HỆ</a>
                </li>
                            

            </ul>

            <div class="right-icon">
                
                

                <?php
                    if(isset($_GET['customer_id'])){
                        $customer_id = $_GET['customer_id'];
                        Session::destroy();                        
                    }
                  ?>
                <?php
                    ob_start();
                    $name = Session::get('customer_name');
                    $login_check = Session::get('customer_login');
                    if($login_check==false){
                        echo '<a href="dang-nhap" title="Thành viên" class="dangnhap"><span class="thanhvien">Thành viên</span> <i class="bi bi-person"></i></a>';
                        
                    }else{?>
                      <div class="taikhoan">
                          <div class="dropdown">
                          <button onclick="myFunction()" class="dropbtn"><span class="thanhvien"><?php echo $name; ?> <i class="bi bi-person"></i></button>                       
                          <div id="myDropdown" class="dropdown-content">
                            <a href="lich-su-dat-tour" title="Lịch sử đặt tour"><i class="bi bi-hourglass"></i> Lịch sử</a>
                            <a href="thong-tin-thanh-vien" title="Thông tin"><i class="bi bi-info-circle"></i> Thông tin</a>
                            <a href="doi-mat-khau" title="Đổi mật khẩu"><i class="bi bi-key"></i> Đổi mật khẩu</a>
                            <a href="?customer_id=<?php echo Session::get('customer_id') ?>" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
                          </div>
                        </div>
                      </div>

                      <?php  
                    }

                ?>
                <div class="opensearch" id="opensearch2" tabindex="0" ><span onclick="showBar2()"><i class="bi bi-search"></i>                    
                </span>

                    <div id="form-timkiem2" class="form-timkiem">
                        <form style="display:flex;" action="tim-kiem" method="post">
                              <input type="text" name="tukhoa" placeholder="Tìm kiếm...">
                              <button type="submit" name="search"><i class="bi bi-search" style="color:black;"></i></button>
                              <span class="dongtimkiem" onclick="hideBar2()"><i class="bi bi-x-lg"></i></span>                         
                        </form>
                    </div>
                </div>
            </div>
            
        </nav> 
         
            </div>
        </div>

    </div>
    <header class="hero-text">
  <div class="hero" data-arrows="true" data-autoplay="true">
    <!--.hero-slide-->

    <?php
                        $show_slider1 = $product -> show_slider1();
                        if($show_slider1){
                            $i=0;
                            while ($result = $show_slider1->fetch_assoc()) {  
                                $i++;
            
                    ?>

    <div class="hero-slide">
      <img alt="<?php echo $result['ten']; ?>" class="img-responsive cover" src="admin/uploads/<?php echo $result['hinhanh']; ?>">
      <div class="header-content text-white position-absolute slide-content col-lg-4">
        <h1><?php echo $result['ten']; ?></h1>
        <p class="font-weight-bold"><?php echo $result['noidung']; ?></p>
        <a href="<?php echo $result['xemthem']; ?>" title="<?php echo $result['ten']; ?>">
        <div class="box-3">
          <div class="btn btn-three">
            <span>Xem thêm</span>
          </div>
        </div>
        </a>
      </div>
    </div>
    <!--.hero-slide-->

    <?php }} ?>
  </div>
  <!--.hero-->
</header>
    

