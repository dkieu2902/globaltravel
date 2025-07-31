<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(10) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-person-square{
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
                                <h3 class="mb-0">Quản lý tài khoản</h3>
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
                                            <th scope="col">Tên người dùng</th>
                                            <th scope="col">Ngày sinh</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phân quyền</th>
                                            <th scope="col">Trạng thái</th>
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
      <h2>Thông tin danh mục</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">

                    <label class="col-sm-2 col-form-label">Tên người dùng:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="tennd" rows="1"></textarea>
                    </div>

                    <label class="col-sm-1 col-form-label">Giới tính:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="gioitinh">
                        <option value="0" >Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Quyền hạn:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="phanquyen">
                        <option value="0" >Quản trị viên</option>
                        <option value="1">Cộng tác viên</option>
                        <option value="5">Khách</option>
                    </select>
                    </div> 

                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="email" rows="1"></textarea>
                    </div>   

                    <label class="col-sm-2 col-form-label">Tài khoản:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="username" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Mật khẩu:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="password" rows="1"></textarea>
                    </div>  

                    <label class="col-sm-2 col-form-label">Ngày sinh:</label>
                    <div class="col-sm-4">
                    <input type="date" class="form-control" id="ngaysinh">
                    </div>

                    <div class="col-lg-6"></div>   

                     <label class="col-sm-2 col-form-label">SĐT:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="sdt" rows="1"></textarea>
                    </div> 

                     <label class="col-sm-2 col-form-label">Địa chỉ:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="diachi" rows="1"></textarea>
                    </div>                                                                            
      </form>
    </div>

  </div>
</div>


<!-- update -->
<div class="modal-overlay" id="modalUpdate">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin danh mục</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="updateItem()">Cập nhật</button>
            <button type="button" class="btn btn-secondary" onclick="closeupdateModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" action="" method="post"  enctype="multipart/form-data">

                    <label class="col-sm-2 col-form-label">Tên người dùng:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="tennd_update" rows="1"></textarea>
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update">
                    </div>

                    <label class="col-sm-1 col-form-label">Giới tính:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="gioitinh_update">
                        <option value="0" >Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                    </div>

                    <label class="col-sm-1 col-form-label">Quyền hạn:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="phanquyen_update">
                        <option value="0" >Quản trị viên</option>
                        <option value="1">Cộng tác viên</option>
                        <option value="5">Khách</option>
                    </select>
                    </div> 

                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="email_update" rows="1"></textarea>
                    </div>  

                    <label class="col-sm-1 col-form-label">Ngày sinh:</label>
                    <div class="col-sm-2">
                    <input type="date" class="form-control" id="ngaysinh_update">
                    </div>

                    <label class="col-sm-1 col-form-label">Hiển thị:</label>
                        <div class="col-sm-2">
                    <select class="form-control" id="hienthi_update">
                        <option value="0" >Có</option>
                        <option value="1">Không</option>
                    </select> 
                    </div>

                    <label class="col-sm-2 col-form-label">Tài khoản:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="username_update" rows="1"></textarea>
                    </div>

                    <label class="col-sm-2 col-form-label">Mật khẩu:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="password_update" rows="1"></textarea>
                    </div>  

                     <label class="col-sm-2 col-form-label">SĐT:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="sdt_update" rows="1"></textarea>
                    </div> 

                     <label class="col-sm-2 col-form-label">Địa chỉ:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" id="diachi_update" rows="1"></textarea>
                    </div>   
                    
                     
            </form>
    </div>

  </div>
</div>

<script type="text/javascript">

    function createItem() {
        var tennd = document.getElementById('tennd').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        if (!tennd || !username|| !password) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            tennd: tennd,
            username: username,
            password: password,
            ngaysinh: document.getElementById('ngaysinh').value,
            gioitinh: document.getElementById('gioitinh').value,
            email: document.getElementById('email').value,
            phanquyen: document.getElementById('phanquyen').value,
            sdt: document.getElementById('sdt').value,
            diachi: document.getElementById('diachi').value,
        };

        fetch(`${apiBaseURL}/admin/api/taikhoan/create.php`, {
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
            resetFormkhac();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }    
    function updateItem() {
        var tennd = document.getElementById('tennd_update').value;
        var username = document.getElementById('username_update').value;
        if (!tennd || !username) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }
        var formData = {
            tennd: tennd,
            username: username,
            password: document.getElementById('password_update').value,
            ngaysinh: document.getElementById('ngaysinh_update').value,
            gioitinh: document.getElementById('gioitinh_update').value,
            email: document.getElementById('email_update').value,
            phanquyen: document.getElementById('phanquyen_update').value,
            hienthi: document.getElementById('hienthi_update').value,
            sdt: document.getElementById('sdt_update').value,
            diachi: document.getElementById('diachi_update').value,
            id: document.getElementById('id_update').value,
        };

        fetch(`${apiBaseURL}/admin/api/taikhoan/update.php`, {
            method: 'PUT',
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
    function updateStatusBefore(id, hienthi) {
        var formData = {
            hienthi: hienthi,
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/taikhoan/updatestatus.php`, {
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

        fetch(`${apiBaseURL}/admin/api/taikhoan/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/taikhoan/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('tennd_update').value = data.tennd;
                document.getElementById('gioitinh_update').value = data.gioitinh;
                document.getElementById('ngaysinh_update').value = data.ngaysinh;
                document.getElementById('username_update').value = data.username;
                document.getElementById('hienthi_update').value = data.hienthi;
                document.getElementById('phanquyen_update').value = data.phanquyen;
                document.getElementById('email_update').value = data.email;
                document.getElementById('sdt_update').value = data.sdt;
                document.getElementById('diachi_update').value = data.diachi;

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        

        function fetchDataByPage() {
            var selectedHienthi = document.querySelector('#hienthi-dropdown .selected').value;
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/taikhoan/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&hienthi=${selectedHienthi}&search=${searchInput}`, {
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
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);

                cell1.innerHTML = item.id;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.tennd + '</a>';
                cell3.innerHTML = item.ngaysinh;
                cell4.innerHTML = item.email;
                if(item.phanquyen == 0){
                    cell5.innerHTML = 'Quản trị viên';
                }else if (item.phanquyen == 1){
                    cell5.innerHTML = 'Cộng tác viên';
                }else{
                    cell5.innerHTML = 'Khách';
                }

                cell6.innerHTML = item.hienthi == '0' ? '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                        '<i class="bg-success"></i>Hoạt động' +
                    '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 0)" style="cursor:pointer;">' +
                        '<i class="bg-danger"></i>Đã hủy' +
                    '</span>';
                    cell6.style.textAlign="center";

                cell7.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell7.style.textAlign="center";
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

