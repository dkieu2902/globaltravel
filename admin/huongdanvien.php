<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(12) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-person{
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
                                <h3 class="mb-0">Quản lý hướng dẫn viên</h3>
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
                        <div class="col-lg-8" style="padding-top:10px;">
                            <button class="btn d-inline-flex btn-sm btn-danger mx-1" onclick="showaddModal()">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Thêm mới</span>
                                </button>
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
                                            <th scope="col">Họ tên</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Ngày sinh</th>
                                            <th scope="col">SĐT</th>     
                                            <th scope="col">Tour hiện có</th>                                       
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">#</th>  
                                        </tr>
                                    </thead>
                                    <tbody id="gioitinh-table-body"></tbody>                                
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
      <h2>Thông tin hướng dẫn viên</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">

                    <label class="col-sm-2 col-form-label">Họ tên:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="hoten" rows="1"></textarea>
                    </div>

                    <label class="col-sm-1 col-form-label">Giới tính:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="gioitinh">
                        <option value="0" >Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                    </div>

                    <label class="col-sm-1 col-form-label">CCCD:</label>
                        <div class="col-sm-2">
                    <textarea class="form-control" id="cccd" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <input type="file" name="hinhanh" id="hinhanh">
                    </div> 

                    <label class="col-sm-2 col-form-label">Ngày sinh:</label>
                    <div class="col-sm-4">
                    <input type="date" class="form-control" id="ngaysinh">
                    </div>

                    <label class="col-sm-2 col-form-label">SĐT:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="sdt" rows="1"></textarea>
                    </div> 

                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="email" rows="1"></textarea>
                    </div>                       

                    <label class="col-sm-2 col-form-label">Ngôn ngữ:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="ngonngu" rows="1"></textarea>
                    </div>   

                     <label class="col-sm-2 col-form-label">Kinh nghiệm:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="kinhnghiem" rows="1"></textarea>
                    </div> 

                     <label class="col-sm-2 col-form-label">Địa chỉ:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="diachi" rows="1"></textarea>
                    </div>   

                    <label class="col-sm-2 col-form-label">Mô tả:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="mota" rows="1"></textarea>
                    </div>                                                                          
      </form>
    </div>

  </div>
</div>


<!-- update -->
<div class="modal-overlay" id="modalUpdate">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin hướng dẫn viên</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
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

<script type="text/javascript">

    function createItem() {
        var hoten = document.getElementById('hoten').value;
        var ngaysinh = document.getElementById('ngaysinh').value;
        var gioitinh = document.getElementById('gioitinh').value;
        var sdt = document.getElementById('sdt').value;
        if (!hoten || !ngaysinh|| !gioitinh|| !sdt) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        var hinhanhInput = document.getElementById('hinhanh');
        var hinhanhFile = hinhanhInput.files[0];

            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('hoten', hoten);
            formData.append('gioitinh', gioitinh);
            formData.append('sdt', sdt);
            formData.append('email', document.getElementById('email').value);
            formData.append('cccd', document.getElementById('cccd').value);                                     
            formData.append('diachi', document.getElementById('diachi').value);
            formData.append('ngonngu', document.getElementById('ngonngu').value);
            formData.append('ngaysinh', ngaysinh);
            formData.append('kinhnghiem', document.getElementById('kinhnghiem').value);
            formData.append('mota', document.getElementById('mota').value);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/huongdanvien/create.php`, {
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
        var hoten = document.getElementById('hoten_update').value;
        var ngaysinh = document.getElementById('ngaysinh_update').value;
        var gioitinh = document.getElementById('gioitinh_update').value;
        var sdt = document.getElementById('sdt_update').value;
        if (!hoten || !ngaysinh|| !gioitinh|| !sdt) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        var hinhanhInput = document.getElementById('hinhanh_update');
        var hinhanhFile = hinhanhInput.files[0];

            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('hoten', hoten);
            formData.append('gioitinh', gioitinh);
            formData.append('sdt', sdt);
            formData.append('email', document.getElementById('email_update').value);
            formData.append('cccd', document.getElementById('cccd_update').value);                                     
            formData.append('diachi', document.getElementById('diachi_update').value);
            formData.append('ngonngu', document.getElementById('ngonngu_update').value);
            formData.append('ngaysinh', ngaysinh);
            formData.append('kinhnghiem', document.getElementById('kinhnghiem_update').value);
            formData.append('hienthi', document.getElementById('hienthi_update').value);
            formData.append('mota', document.getElementById('mota_update').value);
            formData.append('id', document.getElementById('id_update').value);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/huongdanvien/update.php`, {
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
    function updateStatusBefore(id, hienthi) {
        var formData = {
            hienthi: hienthi,
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/huongdanvien/updatestatus.php`, {
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

        fetch(`${apiBaseURL}/admin/api/huongdanvien/delete.php`, {
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

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        

        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/huongdanvien/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}`, {
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
                var tableBody = document.getElementById('gioitinh-table-body');
                tableBody.innerHTML = '<p style="text-align:center;">Không có dữ liệu</p>';
            });
        }


        function displayDataInTable(data) {
            var tableBody = document.getElementById('gioitinh-table-body');

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
                cell1.innerHTML = item.id;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.hoten + '</a>';
                cell3.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="50px" height="50px"/>';
                cell4.innerHTML = item.ngaysinh;
                cell5.innerHTML = item.sdt;
                if (item.thoigiandi && item.thoigiandi.length > 0) {
                    let tourList = item.thoigiandi.map(itemm => 
                        `Mã tour: ${itemm.matour} - ${itemm.tieude}`
                    ).join('<br>');
                    cell6.innerHTML = tourList;
                } else {
                    cell6.innerHTML = 'Chưa có tour';
                }

                cell7.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell7.style.textAlign="center";

                cell8.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell8.style.textAlign="center";
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchDataByPage();
        });
        $('#pagination').twbsPagination({
          totalPages: 35,
          visiblePages: 7
        });

   
</script>
<?php include 'inc/footer.php';?>

