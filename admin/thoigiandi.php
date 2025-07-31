<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php if(Session::get('phanquyen')=='1'){
    echo "<script>window.location ='404.php'</script>";
}
                     ?>
<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-12 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0" id="h3-title"></h3>
                            </div>
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
                        <div class="col-lg-6" style="padding-top:10px;">
                            <button class="btn d-inline-flex btn-sm btn-danger mx-1" onclick="showaddModal()">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Thêm mới</span>
                                </button>
                        </div>
                        <div class="col-lg-2 text-end" style="padding-top:10px;">
                        <a class="btn d-inline-flex btn-sm btn-secondary mx-1" href="tour.php">
                                    <span class=" pe-2">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </span>
                                    <span>Quay lại</span>
                                </a>
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
                                            <th scope="col" style="width: 39px;">Thứ tự</th>
                                            <th scope="col">Tiêu đề</th>
                                            <th scope="col">Số chỗ còn</th>
                                            <th scope="col">Hướng dẫn viên</th>
                                            <th scope="col">#</th>  

                                        </tr>
                                    </thead>
                                    <tbody id="danhmuc-table-body"></tbody>                                
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
      <h2>Thông tin mục lục</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">
                    <label class="col-sm-2 col-form-label">Tiêu đề:</label>
                    <div class="col-sm-10">
                     <input type="date" class="form-control" id="tieude" 
                    >
                    </div>

                    <label class="col-sm-2 col-form-label">Thứ tự:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="thutu">
                    </div>
                                                        
                    <label class="col-sm-2 col-form-label">Số chỗ còn:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="sochocon" 
                    value="0">
                    </div>
                                               
      </form>
    </div>

  </div>
</div>


<!-- update -->
<div class="modal-overlay" id="modalUpdate">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin mục lục</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">
                    <label class="col-sm-2 col-form-label">Tiêu đề:</label>
                    <div class="col-sm-10">
                     <input type="date" class="form-control" id="tieude_update" 
                    >
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update" 
                        placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-2 col-form-label">Thứ tự:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="thutu_update" 
                    placeholder="Nhập thông tin">
                    </div> 

                    <label class="col-sm-2 col-form-label">Số chỗ còn:</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="sochocon_update" 
                    placeholder="Nhập thông tin">
                    </div>             

                                               
      </form>
    </div>

  </div>
</div>

<div class="modal-overlay" id="modalHdv">
         <div class="modaladd">
            <div class="modal-headerr">
               <h2>Chọn hướng dẫn viên</h2>
               <div>
                  <button type="button" class="btn btn-primary" onclick="updatehdv()">Lưu dữ liệu</button>
                  <button type="button" class="btn btn-secondary" onclick="closehdvModal()"><i class="bi bi-arrow-return-right"></i> Thoát</button>
               </div>
            </div>
            <div class="modal-bodyy">
                <div style="display:none;">
                        <input type="text" class="form-control" id="id_hdv">
                    </div>
               <select class="form-control" id="huongdanvien">
                   
               </select>
            </div>
         </div>
      </div>
<div class="modal-overlay" id="modalUpdatehdv">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin hướng dẫn viên</h2>
      <div>
            <button type="button" class="btn btn-secondary" onclick="closeupdatehdvModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">


                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update">
                    </div>

                    <label class="col-sm-2 col-form-label">Họ tên:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="hoten_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-1 col-form-label">Giới tính:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="gioitinh_update">
                        <option value="0" >Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                    </div>

                    <label class="col-sm-1 col-form-label">CCCD:</label>
                        <div class="col-sm-2">
                    <textarea class="form-control" id="cccd_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Hiển thị:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="hienthi_update">
                            <option value="0">Có</option>
                            <option value="1">Không</option>
                        </select>                        
                    </div> 

                    <div class="col-lg-6"></div>

                    

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <img src="" width="70" height="50" id="hienthianh">
                        <input type="file" name="hinhanh" id="hinhanh_update" />
                    </div> 

                    <label class="col-sm-2 col-form-label">Ngày sinh:</label>
                    <div class="col-sm-4">
                    <input type="date" class="form-control" id="ngaysinh_update">
                    </div>

                    <label class="col-sm-2 col-form-label">SĐT:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="sdt_update" rows="1"></textarea>
                    </div> 

                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="email_update" rows="1"></textarea>
                    </div>                       

                    <label class="col-sm-2 col-form-label">Ngôn ngữ:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="ngonngu_update" rows="1"></textarea>
                    </div>   

                     <label class="col-sm-2 col-form-label">Kinh nghiệm:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="kinhnghiem_update" rows="1"></textarea>
                    </div> 

                     <label class="col-sm-2 col-form-label">Địa chỉ:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="diachi_update" rows="1"></textarea>
                    </div>   

                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="mota_update" rows="1"></textarea>
                    </div> 
                    
                     
            </form>
    </div>

  </div>
</div>

<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckfinder/ckfinder.js" type="text/javascript"></script>
<script type="text/javascript">
    function createItem() {
        var tieude = document.getElementById('tieude').value;
        var thutu = document.getElementById('thutu').value;
        if (!tieude || !thutu) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            tieude: tieude,
            thutu: thutu,
            sochocon: document.getElementById('sochocon').value,
            tour: '<?php echo $_GET['tour']; ?>'
        };

        fetch(`${apiBaseURL}/admin/api/thoigiandi/create.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Thêm mới thành công');
            document.getElementById('modalAdd').style.display = 'none';
            fetchDataByPage();
            resetForm();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }    
    function updateItem() {
        var tieude = document.getElementById('tieude_update').value;
        var thutu = document.getElementById('thutu_update').value;
        if (!tieude || !thutu) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            tieude: tieude,
            thutu: thutu,
            sochocon: document.getElementById('sochocon_update').value,
            id: document.getElementById('id_update').value,
        };

        fetch(`${apiBaseURL}/admin/api/thoigiandi/update.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Cập nhật thành công');
            document.getElementById('modalUpdate').style.display = 'none';
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

        fetch(`${apiBaseURL}/admin/api/thoigiandi/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/thoigiandi/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('tieude_update').value = data.tieude;
                document.getElementById('thutu_update').value = data.thutu;
                document.getElementById('sochocon_update').value = data.sochocon;

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function openDetaildhv(id) {
            fetch(`${apiBaseURL}/admin/api/huongdanvien/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('hoten_update').value = data.hoten;
                document.getElementById('gioitinh_update').value = data.gioitinh;
                document.getElementById('ngaysinh_update').value = data.ngaysinh;
                document.getElementById('sdt_update').value = data.sdt;
                document.getElementById('email_update').value = data.email;
                document.getElementById('cccd_update').value = data.cccd;
                document.getElementById('diachi_update').value = data.diachi;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('ngonngu_update').value = data.ngonngu;
                document.getElementById('kinhnghiem_update').value = data.kinhnghiem;
                document.getElementById('mota_update').value = data.mota;
                document.getElementById('diachi_update').value = data.diachi;
                document.getElementById('hienthianh').src = `uploads/${data.hinhanh}`;

                document.getElementById('modalUpdatehdv').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        

        function fetchDataByPage() {
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/thoigiandi/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&search=${searchInput}&tourfilter=<?php echo $_GET['tour']; ?>`, {
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
                var tableBody = document.getElementById('danhmuc-table-body');
                tableBody.innerHTML = '<p style="text-align:center;">Không có dữ liệu</p>';
            });
        }


        function displayDataInTable(data) {
            var tableBody = document.getElementById('danhmuc-table-body');

            tableBody.innerHTML = '';

            data.data.forEach(item => {
                var row = tableBody.insertRow();

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);

                cell1.innerHTML = item.thutu;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.tieude + '</a>';
                cell3.innerHTML = item.sochocon;
                if(item.huongdanvien == null || item.huongdanvien == 0){
                    cell4.innerHTML = '<button onclick="showhdvModal(\'' + item.id + '\', \'' + item.tieude + '\')" class="btn btn-danger btn-sm">Chọn</button>';
                } else {
                    cell4.innerHTML = '<a href="javascript:void(0)" onclick="openDetaildhv(\'' + item.huongdanvien + '\')">' + item.hoten_huongdanvien + '</a>';
                } 
                cell5.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell5.style.textAlign="center";
                document.getElementById('h3-title').innerHTML = 'Lịch trình thuộc tour: ' + data.thuoctieude;

            });
        }

        function updatehdv() {
            var huongdanvien = document.getElementById('huongdanvien').value;
            if (!huongdanvien) {
                toastr.error('Lỗi', 'Vui lòng chọn hướng dẫn viên');
                return;
            }
            var formData = {
                huongdanvien: huongdanvien,
                id: document.getElementById('id_hdv').value,
            };

            fetch(`${apiBaseURL}/admin/api/thoigiandi/updatehdv.php`, {
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
                closehdvModal();
            })
            .catch(error => {
                toastr.error('Thông báo', 'Cập nhật thất bại');
            });
        }
        function readhdv(ngaydi) {
    fetch(`${apiBaseURL}/admin/api/huongdanvien/readhuongdanvientrong.php?ngaydi=${ngaydi}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        var selectdanhmuc = document.getElementById('huongdanvien');

        selectdanhmuc.innerHTML = '';
        var initialOption = document.createElement('option');
        initialOption.value = '';
        initialOption.text = 'Chọn hướng dẫn viên';
        selectdanhmuc.appendChild(initialOption);
        
        if(data.data && data.data.length > 0) {
            data.data.forEach(item => {
                var option = document.createElement('option');
                option.value = item.id;
                option.text = item.id + ' - ' + item.hoten + ' - ' + item.ngaysinh + ' - ' + item.sdt;
                selectdanhmuc.appendChild(option);
            });
        } else {
            var noDataOption = document.createElement('option');
            noDataOption.value = '';
            noDataOption.text = 'Không có hướng dẫn viên nào còn trống';
            noDataOption.disabled = true;
            selectdanhmuc.appendChild(noDataOption);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Hiển thị thông báo lỗi cho user
        var selectdanhmuc = document.getElementById('huongdanvien');
        selectdanhmuc.innerHTML = '';
        var errorOption = document.createElement('option');
        errorOption.value = '';
        errorOption.text = 'Lỗi khi tải dữ liệu';
        errorOption.disabled = true;
        selectdanhmuc.appendChild(errorOption);
    });
}

function showhdvModal(id, ngaydi) {
    document.getElementById('modalHdv').style.display = 'block';
    document.getElementById('id_hdv').value = id;
    readhdv(ngaydi);
}

function closehdvModal() {
    document.getElementById('modalHdv').style.display = 'none';
}
function closeupdatehdvModal() {
    document.getElementById('modalUpdatehdv').style.display = 'none';
}
function tinhNgayToiThieuTgd() {
    const ngayHienTaiTgd = new Date();
    ngayHienTaiTgd.setDate(ngayHienTaiTgd.getDate() + 2);
    const ketQuaTgd = ngayHienTaiTgd.toISOString().split('T')[0];
    console.log('Ngày tối thiểu TGD:', ketQuaTgd);
    return ketQuaTgd;
}
function thietLapGioiHanNgayTgd(inputId) {
    const inputElementTgd = document.getElementById(inputId);
    console.log('Tìm input với ID:', inputId, inputElementTgd ? 'Tìm thấy' : 'KHÔNG tìm thấy');
    
    if (inputElementTgd) {
        const ngayToiThieuTgd = tinhNgayToiThieuTgd();
        inputElementTgd.setAttribute('min', ngayToiThieuTgd);
        
        // Thiết lập thuộc tính step để đảm bảo chỉ chọn được ngày
        inputElementTgd.setAttribute('step', '1');
        
        console.log('Đã thiết lập min cho', inputId, ':', ngayToiThieuTgd);
        
        // Xóa giá trị hiện tại nếu nhỏ hơn ngày tối thiểu
        if (inputElementTgd.value && inputElementTgd.value < ngayToiThieuTgd) {
            console.log('Xóa giá trị không hợp lệ:', inputElementTgd.value);
            inputElementTgd.value = '';
        }
    }
}

function xuLySuKienNhapPhimTgd(event) {
    // Ngăn việc nhập số và ký tự đặc biệt
    const phimBiChanTgd = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        '/', '-', '.', ' '
    ];
    
    // Cho phép các phím điều hướng
    const phimChoPhepTgd = [
        'Tab', 'Escape', 'Enter', 'Backspace', 'Delete',
        'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown',
        'Home', 'End', 'F5'
    ];
    
    // Cho phép Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X, Ctrl+Z
    if (event.ctrlKey || event.metaKey) {
        return;
    }
    
    // Chặn phím số và ký tự đặc biệt
    if (phimBiChanTgd.includes(event.key) || 
        (!phimChoPhepTgd.includes(event.key) && event.key.length === 1)) {
        console.log('Chặn phím:', event.key);
        event.preventDefault();
        return false;
    }
}
        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
            tinhNgayToiThieuTgd();
            thietLapGioiHanNgayTgd('tieude');
            thietLapGioiHanNgayTgd('tieude_update');
            const danhSachInputTgd = ['tieude', 'tieude_update'];
    
    danhSachInputTgd.forEach(function(inputId) {
        const inputElementTgd = document.getElementById(inputId);
        if (inputElementTgd) {
            inputElementTgd.addEventListener('keydown', xuLySuKienNhapPhimTgd);
        }
    });
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

