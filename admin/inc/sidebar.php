<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="javascript:void(0)" class="logo d-flex align-items-center">
        <img src="assets/img/alex-high-resolution-logo-transparent.png" alt="">
        <span class="d-none d-lg-block">GlobalTravel</span>
      </a>
      
      <button id="toggleButton"><i class="bi bi-list toggle-sidebar-btn"></i></button>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo Session::get('tennd') ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo Session::get('tennd') ?></h6>
              <span><?php if(Session::get('phanquyen')==0){
                echo 'Quản trị viên';
                }else{
                    echo 'Thành viên';
                }
               ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="changepassword.php">
                <i class="bi bi-person"></i>
                <span>Đổi mật khẩu</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="?action=logout" onClick = "return confirm('Bạn có chắc muốn đăng xuất không?')">
                <i class="bi bi-box-arrow-right"></i>
                <span>Đăng xuất</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary content">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav nav1">
                    <?php if(Session::get('phanquyen')=='0'){

                     ?>
                     <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="postlist.php">
                            <i class="bi bi-postcard"></i> Danh mục tin tức
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catlist.php">
                            <i class="bi bi-tag"></i> Danh mục
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tour.php">
                            <i class="bi bi-dice-1"></i> Tour
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bloglist.php">
                            <i class="bi bi-newspaper"></i> Bài viết
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inbox.php">
                            <i class="bi bi-chat"></i> Đơn đặt tour
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"><?php 
                            $getinboxcount = $blog->getinboxcount();
                            if($getinboxcount){
                                 $product_count = mysqli_num_rows($getinboxcount);
                                 echo $product_count; 
                            }
                            else{
                                echo '0';
                            }                       
                            
                         ?></span>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="contactlist.php">
                            <i class="bi bi-telephone-fill"></i> Liên hệ
                            <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto"><?php 
                            $contact_all = $blog->getcontactcount();
                            if($contact_all){
                                 $contact_count = mysqli_num_rows($contact_all);
                                 echo $contact_count; 
                            }
                            else{
                                echo '0';
                            }                       
                            
                         ?></span>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="sliderlist.php">
                            <i class="bi bi-images"></i> Banner
                        </a>
                    </li>
                                     
                    <li class="nav-item">
                        <a class="nav-link" href="cauhinh.php">
                            <i class="bi bi-tools"></i> Cấu hình
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="taikhoan.php">
                            <i class="bi bi-person-square"></i> Tài khoản
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="thongke.php">
                            <i class="bi bi-bar-chart"></i> Thống kê
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="huongdanvien.php">
                            <i class="bi bi-person"></i> Hướng dẫn viên
                        </a>
                    </li>
                 <?php }else if(Session::get('phanquyen')=='1'){

                  ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/globaltravel/">
                            <i class="bi bi-house"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bloglist.php">
                            <i class="bi bi-newspaper"></i> Bài viết
                        </a>
                    </li>

                  <?php } ?>
                    
                </ul>
                <!-- Divider -->
                <hr class="navbar-divider my-5 opacity-20">
                <!-- Push content down -->
            </div>
        </div>
    </nav>
    <?php
    if(isset($_GET['action'])&&$_GET['action']=='logout'){
        Session::destroy_admin();
    }
?>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                
            