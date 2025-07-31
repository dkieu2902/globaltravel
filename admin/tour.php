<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(4) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-dice-1{
        color: #fff !important;
    }
</style>
<?php if(Session::get('phanquyen')!='0'){
    echo "<script>window.location ='404.php'</script>";
}
                     ?>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Quản lý tour</h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <ul id="hienthi-dropdown">
                                <li value="0">Hoạt động</li>
                                <li value="1">Đã hủy</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <select id="itemsPerPage" onchange="changeItemsPerPage()">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-lg-2" style="padding-top:10px;">
                            <button class="btn d-inline-flex btn-sm btn-danger mx-1" onclick="showaddModal()">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Thêm mới</span>
                                </button>
                        </div>
                        <div class="col-lg-4 text-sm-end" style="padding-top:11px;">

                        </div>
                        <div class="col-lg-2" style="padding: 4px 0 0 0;">                           
                            <select id="filterdanhmuc" onchange="changedanhmucFilter()"></select>
                        </div>
                        <div class="col-lg-3">
                            <div class="search-container">
                                <input type="text" id="search" class="search-input" placeholder="Tìm kiếm...">
                                <button class="search-button"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Mã tour</th>
                                            <th scope="col">Tên tour</th>  
                                            <th scope="col">Danh mục</th>                                          
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Lịch trình</th>
                                            <th scope="col">Thông tin tour</th>
                                            <th scope="col">Thời gian đi</th>
                                            <th scope="col">Hình ảnh tour</th>
                                            <th scope="col">Trạng thái</th>

                                            <th scope="col">#</th>  
                                        </tr>
                                    </thead>
                                    <tbody id="tour-table-body"></tbody>                                
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-pageinfo">
                            <table>
                                <tr>
                                    <td>
                                        <div id="itemCount"></div>
                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="paginationInfo"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-8" style="text-align: right;">
                            <ul id="pagination"></ul>
                        </div>
                    </div>
                    
                    
                </div>

<!-- new modal add update -->
<div class="modal-overlay" id="modalAdd">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin tour</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">

                    <label class="col-sm-2 col-form-label">Tên tour:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control"  id="tieude" onkeyup="updateUrl()" rows="1"></textarea>
                    </div>
                    
                    <label class="col-sm-2 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="uutien" 
                    value="0">
                    </div>  

                    <label class="col-sm-2 col-form-label">Danh mục:</label>
                        <div class="col-sm-4">
                    <select class="form-control" id="danhmuc">
                        </select>
                    </div>

                    <label class="col-sm-2 col-form-label">Phương tiện:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="phuongtien">
                            <option value="Xe">Xe</option>
                            <option value="Máy bay">Máy bay</option>
                        </select>                        
                    </div> 

                    <label class="col-sm-2 col-form-label title">Mã tour:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="matour" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label title">Khởi hành:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="khoihanh" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Thời gian chuyến:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="thoigianchuyen" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Điểm tham quan:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="diemthamquan" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label title">Ẩm thực:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="amthuc" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Đối tượng thích hợp:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="doituongthichhop" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label title">Thời gian lý tưởng:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="thoigianlytuong" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Khuyến mãi:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="khuyenmai" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Giá từ:</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" id="giatuhienthi" value="0" oninput="formatPrice('giatuhienthi','giatureal')">
                    </div>

                    <div style="display:none;">
                      <input type="text" class="form-control" id="giatureal" placeholder="Nhập thông tin" value="0">
                    </div>
                    <div class="col-lg-6"></div> 

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <input type="file" name="hinhanh" id="hinhanh">
                    </div> 

                    <label class="col-sm-2 col-form-label title">Số ngày:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="songay" rows="1"></textarea>
                    </div>            

                    <label class="col-sm-2 col-form-label title">SEO Title:</label>
                    <div class="col-sm-8 title">
                    <textarea class="form-control" id="title" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                   

                    <label class="col-sm-2 col-form-label">SEO Keywords:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" id="keywords" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">SEO URL:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" id="url" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">SEO Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="description"></textarea>
                    </div>

                    <div class="col-lg-2"></div>    

                    <label class="col-sm-2 col-form-label">Tóm tắt:</label>
                    <div class="col-sm-8">
                     <textarea id="tomtat" rows="4" cols="80" class="form-control"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-8">
                     <textarea name="mota" id="editor2" rows="10" cols="80"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                                
                                               
      </form>
    </div>

  </div>
</div>


<!-- update -->
<div class="modal-overlay" id="modalUpdate">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin tour</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">

                    <label class="col-sm-2 col-form-label">Tên tour:</label>
                    <div class="col-sm-4">
                     <textarea class="form-control" id="tieude_update" onkeyup="updateUrl()" rows="1"></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update">
                    </div>

                    <label class="col-sm-2 col-form-label">Ưu tiên:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="uutien_update">
                    </div>

                    <label class="col-sm-2 col-form-label">Danh mục:</label>
                        <div class="col-sm-4">
                    <select class="form-control" id="danhmuc_update">
                        </select>
                    </div> 
                    <label class="col-sm-2 col-form-label">Phương tiện:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="phuongtien_update">
                            <option value="Xe">Xe</option>
                            <option value="Máy bay">Máy bay</option>
                        </select>                        
                    </div> 

                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="hienthi_update">
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                        </select>                        
                    </div> 

                    <div class="col-lg-6"></div>

                    <label class="col-sm-2 col-form-label title">Mã tour:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="matour_update" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label title">Khởi hành:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="khoihanh_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Thời gian chuyến:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="thoigianchuyen_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Điểm tham quan:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="diemthamquan_update" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label title">Ẩm thực:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="amthuc_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Đối tượng thích hợp:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="doituongthichhop_update" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label title">Thời gian lý tưởng:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="thoigianlytuong_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label title">Khuyến mãi:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="khuyenmai_update" rows="1"></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">Giá từ:</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" id="giatuhienthi_update" oninput="formatPrice('giatuhienthi_update','giatureal_update')">
                    </div>

                    <div class="col-lg-6"></div> 

                    <div style="display:none;">
                      <input type="text" class="form-control" id="giatureal_update" placeholder="Nhập thông tin" value="0">
                    </div> 

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <img src="" width="70" height="50" id="hienthianh">
                        <input type="file" name="hinhanh" id="hinhanh_update" />
                    </div>

                    <label class="col-sm-2 col-form-label title">Số ngày:</label>
                    <div class="col-sm-4 title">
                    <textarea class="form-control" id="songay_update" rows="1"></textarea>
                    </div>                                                          

                    <label class="col-sm-2 col-form-label title">Title:</label>
                    <div class="col-sm-8 title">
                    <textarea class="form-control" name="title" id="title_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>                    

                    <label class="col-sm-2 col-form-label">Keywords:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="keywords" id="keywords_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">URL:</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="url" id="url_update" rows="1"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="description" id="description_update"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Tóm tắt:</label>
                    <div class="col-sm-8">
                     <textarea id="tomtat_update" class="form-control" rows="4" cols="80"></textarea>
                    </div>

                    <div class="col-lg-2"></div>

                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-8">
                     <textarea id="editor2_update" rows="10" cols="80"></textarea>
                    </div>

                    <div class="col-lg-2"></div>
                    
            </form>
    </div>

  </div>
</div>

<script type="text/javascript">

    function createItem() {
        var tieude = document.getElementById('tieude').value;
        var url = document.getElementById('url').value;
        var danhmuc = document.getElementById('danhmuc').value;
        var matour = document.getElementById('matour').value;
        var songay = document.getElementById('songay').value;
        if (!tieude || !url|| !danhmuc|| !matour|| !songay) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh');
        var hinhanhFile = hinhanhInput.files[0];

            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('tieude', tieude);
            formData.append('danhmuc', danhmuc);
            formData.append('matour', matour);
            formData.append('mota', CKEDITOR.instances.editor2.getData());
            formData.append('tomtat', document.getElementById('tomtat').value);
            formData.append('uutien', document.getElementById('uutien').value);
            formData.append('nguoidang', '<?php echo Session::get('id') ?>');                                       
            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('url', url);
            formData.append('keywords', document.getElementById('keywords').value);

            formData.append('khoihanh', document.getElementById('khoihanh').value);
            formData.append('thoigianchuyen', document.getElementById('thoigianchuyen').value);
            formData.append('diemthamquan', document.getElementById('diemthamquan').value);
            formData.append('amthuc', document.getElementById('amthuc').value);
            formData.append('doituongthichhop', document.getElementById('doituongthichhop').value);
            formData.append('thoigianlytuong', document.getElementById('thoigianlytuong').value);
            formData.append('phuongtien', document.getElementById('phuongtien').value);
            formData.append('khuyenmai', document.getElementById('khuyenmai').value);
            formData.append('giatu', document.getElementById('giatureal').value);
            formData.append('songay', songay);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/tour/create.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                toastr.success('Thông báo', 'Thêm mới thành công');
                document.getElementById('modalAdd').style.display = 'none';
                hinhanhInput.value = null;
                fetchDataByPage();
                resetForm();
            })
            .catch(error => {
                console.error('Error:', error);
            });
         
    }   
    function updateItem() {
        var tieude = document.getElementById('tieude_update').value;
        var url = document.getElementById('url_update').value;
        var danhmuc = document.getElementById('danhmuc_update').value;
        var matour = document.getElementById('matour_update').value;
        var songay = document.getElementById('songay_update').value;
        if (!tieude || !url|| !danhmuc|| !matour|| !songay ) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh_update');
        var hinhanhFile = hinhanhInput.files[0];

            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('tieude', tieude);
            formData.append('danhmuc', danhmuc);
            formData.append('matour', matour);
            formData.append('songay', songay);
            formData.append('tomtat', document.getElementById('tomtat_update').value);
            formData.append('uutien', document.getElementById('uutien_update').value);
            formData.append('hienthi', document.getElementById('hienthi_update').value);
            formData.append('mota', CKEDITOR.instances.editor2_update.getData());
            formData.append('title', document.getElementById('title_update').value);
            formData.append('description', document.getElementById('description_update').value);
            formData.append('url', url);
            formData.append('keywords', document.getElementById('keywords_update').value);
            formData.append('id', document.getElementById('id_update').value);

            formData.append('khoihanh', document.getElementById('khoihanh_update').value);
            formData.append('thoigianchuyen', document.getElementById('thoigianchuyen_update').value);
            formData.append('diemthamquan', document.getElementById('diemthamquan_update').value);
            formData.append('amthuc', document.getElementById('amthuc_update').value);
            formData.append('doituongthichhop', document.getElementById('doituongthichhop_update').value);
            formData.append('thoigianlytuong', document.getElementById('thoigianlytuong_update').value);
            formData.append('phuongtien', document.getElementById('phuongtien_update').value);
            formData.append('khuyenmai', document.getElementById('khuyenmai_update').value);
            formData.append('giatu', document.getElementById('giatureal_update').value);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/tour/update.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                toastr.success('Thông báo', 'Cập nhật thành công');
                document.getElementById('modalUpdate').style.display = 'none';
                hinhanhInput.value = null;
                fetchDataByPage();
            })
            .catch(error => {
                console.error('Error:', error);
            });

    }
    function updateStatusBefore(madm, hienthi) {
        var formData = {
            hienthi: hienthi,
            id: madm,
        };

        fetch(`${apiBaseURL}/admin/api/tour/updatestatus.php`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Cập nhật thành công');
            fetchDataByPage();
        })
        .catch(error => {
            toastr.error('Thông báo', 'Cập nhật thất bại');
        });
    }

   
    function performDelete(id) {
        var formData = {
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/tour/delete.php`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Xóa thành công');
            fetchDataByPage();
        })
        .catch(error => {
            toastr.error('Thông báo', 'Xóa thất bại');
        });
    }
   
        function openDetail(id) {
            fetch(`${apiBaseURL}/admin/api/tour/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('tieude_update').value = data.tieude;
                document.getElementById('danhmuc_update').value = data.danhmuc;
                document.getElementById('uutien_update').value = data.uutien;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('tomtat_update').value = data.tomtat;
                document.getElementById('title_update').value = data.title;
                document.getElementById('keywords_update').value = data.keywords;
                document.getElementById('url_update').value = data.url;
                document.getElementById('description_update').value = data.description;
                document.getElementById('hienthianh').src = `uploads/${data.hinhanh}`;

                document.getElementById('matour_update').value = data.matour;
                document.getElementById('khoihanh_update').value = data.khoihanh;
                document.getElementById('thoigianchuyen_update').value = data.thoigianchuyen;
                document.getElementById('diemthamquan_update').value = data.diemthamquan;
                document.getElementById('amthuc_update').value = data.amthuc;
                document.getElementById('doituongthichhop_update').value = data.doituongthichhop;
                document.getElementById('thoigianlytuong_update').value = data.thoigianlytuong;
                document.getElementById('phuongtien_update').value = data.phuongtien;
                document.getElementById('khuyenmai_update').value = data.khuyenmai;
                document.getElementById('giatureal_update').value = data.giatu;
                document.getElementById('giatuhienthi_update').value = formatNumberWithCommas(data.giatu);
                document.getElementById('songay_update').value = data.songay;

                CKEDITOR.instances.editor2_update.setData(data.mota);

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function populateDanhmucSelect() {
            // Fetch danh muc tin tuc data from the API
            fetch(`${apiBaseURL}/admin/api/danhmuc/read.php`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(danhmucData => {
                var selectdanhmuc = document.getElementById('danhmuc');
                var selectdanhmuc_update = document.getElementById('danhmuc_update');
                var selectdanhmuc_filter = document.getElementById('filterdanhmuc');

                // Clear existing options
                selectdanhmuc.innerHTML = '';
                selectdanhmuc_update.innerHTML = '';

                // Add initial option for both selects
                var initialOption = document.createElement('option');
                initialOption.value = '';
                initialOption.text = 'Chọn Danh mục';
                selectdanhmuc.appendChild(initialOption);

                var initialOptionUpdate = document.createElement('option');
                initialOptionUpdate.value = '';
                initialOptionUpdate.text = 'Chọn Danh mục';
                selectdanhmuc_update.appendChild(initialOptionUpdate);

                var initialOptionFilter = document.createElement('option');
                initialOptionFilter.value = '';
                initialOptionFilter.text = 'Chọn Danh mục';
                selectdanhmuc_filter.appendChild(initialOptionFilter);

                // Create and append new options based on API data
                danhmucData.data.forEach(item => {
                    var option = document.createElement('option');
                    option.value = item.madm;
                    option.text = item.tendm;
                    selectdanhmuc.appendChild(option);

                    // Create a new option for selectdanhmuc_update
                    var optionUpdate = document.createElement('option');
                    optionUpdate.value = item.madm;
                    optionUpdate.text = item.tendm;
                    selectdanhmuc_update.appendChild(optionUpdate);

                    var optionFilter = document.createElement('option');
                    optionFilter.value = item.madm;
                    optionFilter.text = item.tendm;
                    selectdanhmuc_filter.appendChild(optionFilter);
                });
            })
            .catch(error => {
                console.error('Error fetching danh muc data:', error);
            });
        }

        var filterdanhmuc = document.getElementById('filterdanhmuc').value;

        function changedanhmucFilter() {
            filterdanhmuc = document.getElementById('filterdanhmuc').value;
            fetchDataByPage();
        }
        
        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/tour/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}&filterdanhmuc=${filterdanhmuc}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                displayPage(data);
                displayDataInTable(data);
            })
            .catch(error => {
                console.error('Error:', error);
                var tableBody = document.getElementById('tour-table-body');
                tableBody.innerHTML = '<p style="text-align:center;">Không có dữ liệu</p>';
            });
        }


        function displayDataInTable(data) {
            var tableBody = document.getElementById('tour-table-body');

            tableBody.innerHTML = '';

            data.data.forEach(item => {
                var row = tableBody.insertRow();

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                var cell9 = row.insertCell(8);
                var cell10 = row.insertCell(9);
                var cell11 = row.insertCell(10);

                cell1.innerHTML = item.id;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.matour + '</a>';
                cell3.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.tieude + '</a>';
                cell4.innerHTML = item.tendanhmuc;
                cell5.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="50px" height="50px"/>';
                cell6.innerHTML = `<a class="btn btn-sm btn-neutral" href="lichtrinh.php?tour=${item.id}">Xem DS</a>`;
                cell7.innerHTML = `<a class="btn btn-sm btn-neutral" href="thongtintour.php?tour=${item.id}">Xem DS</a>`;
                cell8.innerHTML = `<a class="btn btn-sm btn-neutral" href="thoigiandi.php?tour=${item.id}">Xem DS</a>`;
                cell9.innerHTML = `<a class="btn btn-sm btn-neutral" href="hinhanhtour.php?tour=${item.id}">Xem DS</a>`;

                cell10.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell10.style.textAlign="center";

                cell11.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell11.style.textAlign="center";
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
            populateDanhmucSelect();
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

