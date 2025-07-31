<?php 
include_once 'classes/blog.php';
$blog = new blog();
$cauhinh = $blog->show_cauhinh();
if($cauhinh){
    while($result = $cauhinh->fetch_assoc()){
        $title = $result['tieude'] . " - Tours";
        $description = $result['mota'];
        $keywords = $result['keywords'];
        $duongdan='';
        $image='admin/uploads/'.$result['logo'];
    }
}

include 'include/header.php';

// Lấy tham số lọc và sắp xếp từ GET
$budget = isset($_GET['budget']) ? $_GET['budget'] : '';
$dongTour = isset($_GET['dong_tour']) ? $_GET['dong_tour'] : '';
$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'date_asc';

// Lấy danh sách danh mục tour
$tourCategories = $cat->show_category1();

// Lấy danh sách tour đã lọc
$filteredTours = $product->getFilteredTours($budget, $dongTour, $sortBy);

// Đếm số lượng tour
$tourCount = 0;
if($filteredTours) {
    $tourCount = mysqli_num_rows($filteredTours);
}
?>

<div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">

                    <img src="images/shortback.jpeg" alt="Ảnh về du lịch" class="backimg">

            <h2 class="fix-h2">Khám phá nhiều hơn tại đây</h2>
            </div>
        </div>
</div>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-links">
                <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
                <span>/</span>
                <span>Tour</span>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4 mb-5">
    <h1 class="text-center mb-4">DU LỊCH TOUR TIẾT KIỆM</h1>
    
    <div class="row mb-4">
        <div class="col-12">
            <p class="text-center">Dòng tour này Vietravel hướng đến mục tiêu bất cứ Du Khách nào cũng có cơ hội đi du lịch với mức chi phí tiết kiệm nhất. Các điểm tham quan và dịch vụ chọn lọc phù hợp với ngân sách của Du Khách nhưng vẫn đảm bảo hành trình du lịch đầy đủ và thú vị.</p>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">BỘ LỌC TÌM KIẾM</h5>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <!-- Ngân sách -->
                        <div class="mb-4">
                            <h6>Ngân sách:</h6>
                            <div class="d-grid gap-2">
                                <label class="btn btn-outline-secondary <?php echo ($budget == 'duoi5') ? 'active' : ''; ?>">
                                    <input type="radio" name="budget" value="duoi5" <?php echo ($budget == 'duoi5') ? 'checked' : ''; ?> class="d-none"> Dưới 5 triệu
                                </label>
                                <label class="btn btn-outline-secondary <?php echo ($budget == '5-10') ? 'active' : ''; ?>">
                                    <input type="radio" name="budget" value="5-10" <?php echo ($budget == '5-10') ? 'checked' : ''; ?> class="d-none"> Từ 5 - 10 triệu
                                </label>
                                <label class="btn btn-outline-secondary <?php echo ($budget == '10-20') ? 'active' : ''; ?>">
                                    <input type="radio" name="budget" value="10-20" <?php echo ($budget == '10-20') ? 'checked' : ''; ?> class="d-none"> Từ 10 - 20 triệu
                                </label>
                                <label class="btn btn-outline-secondary <?php echo ($budget == 'tren20') ? 'active' : ''; ?>">
                                    <input type="radio" name="budget" value="tren20" <?php echo ($budget == 'tren20') ? 'checked' : ''; ?> class="d-none"> Trên 20 triệu
                                </label>
                            </div>
                        </div>

                        <!-- Dòng tour -->
                        <div class="mb-4">
                            <h6>Dòng tour:</h6>
                            <select name="dong_tour" class="form-select">
                                <option value="">Tất cả</option>
                                <?php
                                if($tourCategories) {
                                    while($category = $tourCategories->fetch_assoc()) {
                                        $selected = ($dongTour == $category['madm']) ? 'selected' : '';
                                        echo '<option value="'.$category['madm'].'" '.$selected.'>'.$category['tendm'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            <a href="cac-tour" class="btn btn-outline-secondary">Xóa bộ lọc</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tour Listings -->
        <div class="col-lg-9">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="mb-0">Chúng tôi tìm thấy <strong><?php echo $tourCount; ?></strong> chương trình tour cho quý khách</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="me-2">Sắp xếp theo:</label>
                            <select class="form-select" id="sortOrder" onchange="window.location.href=this.value">
                                <option value="cac-tour?budget=<?php echo $budget; ?>&dong_tour=<?php echo $dongTour; ?>&sort_by=date_asc" <?php echo ($sortBy == 'date_asc') ? 'selected' : ''; ?>>Ngày khởi hành gần nhất</option>
                                <option value="cac-tour?budget=<?php echo $budget; ?>&dong_tour=<?php echo $dongTour; ?>&sort_by=price_asc" <?php echo ($sortBy == 'price_asc') ? 'selected' : ''; ?>>Giá từ thấp đến cao</option>
                                <option value="cac-tour?budget=<?php echo $budget; ?>&dong_tour=<?php echo $dongTour; ?>&sort_by=price_desc" <?php echo ($sortBy == 'price_desc') ? 'selected' : ''; ?>>Giá từ cao đến thấp</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tour List -->
            <?php
            if($filteredTours && $tourCount > 0) {
                while($tour = $filteredTours->fetch_assoc()) {
                    // Lấy danh sách ngày khởi hành
                    $departureDates = $product->getNearestDepartureDate($tour['id']);
            ?>
            <div class="card mb-4 tour-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="position-relative h-100">
                            <img src="admin/uploads/<?php echo $tour['hinhanh']; ?>" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="<?php echo $tour['tieude']; ?>">
                            <?php 
                                if($tour['danhmuc'] == 23){
                             ?>
                                <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 rounded">Tiết kiệm</span>
                             <?php 
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
                }
            } else {
            ?>
            <div class="alert alert-info">
                Không tìm thấy tour nào phù hợp với tiêu chí tìm kiếm của bạn. Vui lòng thử lại với bộ lọc khác.
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<style>

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
    white-space: nowrap;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}


.tour-card img {
    height: 250px;
    object-fit: cover;
}


.btn-outline-secondary.active {
    background-color: #6c757d;
    color: white;
}

/
.tour-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}


.date-tag {
    white-space: nowrap;
    font-size: 0.85rem;
}
</style>

<script>

document.addEventListener('DOMContentLoaded', function() {
  
    const radioButtons = document.querySelectorAll('input[type="radio"][name="budget"]');
    radioButtons.forEach(button => {
        button.addEventListener('change', function() {
       
            document.querySelectorAll('label.btn').forEach(label => {
                label.classList.remove('active');
            });
            
           
            if (this.checked) {
                this.closest('label').classList.add('active');
            }
        });
    });
});
</script>

<?php include 'include/footer.php'; ?> 