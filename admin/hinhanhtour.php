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
                                <h3 class="mb-0" id="h3-title"></h3>
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
                        <div class="col-lg-9 text-sm-end" style="padding-top:11px;">
                            <a class="btn d-inline-flex btn-sm btn-secondary mx-1" href="tour.php">
                                    <span class=" pe-2">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </span>
                                    <span>Quay lại</span>
                                </a>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Hình ảnh</th>

                                            <th scope="col">#</th>  
                                        </tr>
                                    </thead>
                                    <tbody id="hinhanhtour-table-body"></tbody>                                
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
      <h2>Thông tin hình ảnh tour</h2>
      <div>
            <button type="button" class="btn btn-primary" onclick="createItem()">Thêm mới</button>
            <button type="button" class="btn btn-secondary" onclick="closeaddModal()">Thoát</button>
        </div>
    </div>
    <div class="modal-bodyy">
        <form class="form-group row" enctype="multipart/form-data" id="myForm">

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <input type="file" id="hinhanh">
                    </div> 
                                             
      </form>
    </div>

  </div>
</div>


<!-- update -->
<div class="modal-overlay" id="modalUpdate">
  <div class="modaladd">
    <div class="modal-headerr">
      <h2>Thông tin hình ảnh tour</h2>
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

                    <label class="col-sm-2 col-form-label">Hình ảnh:</label>
                    <div class="col-sm-4">
                     <img src="" width="70" height="50" id="hienthianh">
                        <input type="file" name="hinhanh" id="hinhanh_update" />
                    </div>
                    
            </form>
    </div>

  </div>
</div>

<script type="text/javascript">

    function createItem() {

        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh');
        var hinhanhFile = hinhanhInput.files[0];

            var formData = new FormData();
            if(!hinhanhInput){
                toastr.error('Thông báo', 'Bạn chưa chọn ảnh');
                return;
            }
            formData.append('hinhanh', hinhanhFile);
            formData.append('tour', <?php echo $_GET['tour']; ?>);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/hinhanhtour/create.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                toastr.success('Thông báo', 'Thêm mới thành công');
                document.getElementById('modalAdd').style.display = 'none';
                hinhanhInput.value = null;
                fetchDataByPage();
            })
            .catch(error => {
                console.error('Error:', error);
            });
         
    }   
    function updateItem() {

        // Lấy file từ input
        var hinhanhInput = document.getElementById('hinhanh_update');
        var hinhanhFile = hinhanhInput.files[0];
        if(!hinhanhInput){
                toastr.error('Thông báo', 'Bạn chưa chọn ảnh');
                return;
            }
            var formData = new FormData();
            formData.append('hinhanh', hinhanhFile);
            formData.append('id', document.getElementById('id_update').value);

            // Gửi yêu cầu POST sử dụng formData
            fetch(`${apiBaseURL}/admin/api/hinhanhtour/update.php`, {
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

   
    function performDelete(id) {
        var formData = {
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/hinhanhtour/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/hinhanhtour/show.php?id=` + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_update').value = data.id;
                document.getElementById('hienthianh').src = `uploads/${data.hinhanh}`;

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        

        function fetchDataByPage() {

            fetch(`${apiBaseURL}/admin/api/hinhanhtour/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&filtertour=${<?php echo $_GET['tour']; ?>}`, {
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
                var tableBody = document.getElementById('hinhanhtour-table-body');
                tableBody.innerHTML = '<p style="text-align:center;">Không có dữ liệu</p>';
            });
        }


        function displayDataInTable(data) {
            var tableBody = document.getElementById('hinhanhtour-table-body');

            tableBody.innerHTML = '';

            data.data.forEach(item => {
                var row = tableBody.insertRow();

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                cell1.innerHTML = item.id;
                cell2.innerHTML = '<img src="uploads/' + item.hinhanh + '" width="120px" height="70px"/>';

                cell3.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell3.style.textAlign="center";
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

