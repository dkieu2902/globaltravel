<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(4) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-dice-1{
        color: #fff !important;
    }
</style>
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
                    <div class="col-sm-7">
                     <input type="text" class="form-control" id="tieude" 
                    placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-1 col-form-label">Thứ tự:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="thutu" 
                    value="0">
                    </div>
                                                        
                    <label class="col-sm-2 col-form-label">Nội dung:</label>
                    <div class="col-sm-10">
                     <textarea id="editor1" rows="5" cols="80"></textarea>
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
                    <div class="col-sm-7">
                     <input type="text" class="form-control" id="tieude_update" 
                    placeholder="Nhập thông tin">
                    </div>

                    <div style="display:none;">
                        <input type="text" class="form-control" id="id_update" 
                        placeholder="Nhập thông tin">
                    </div>

                    <label class="col-sm-1 col-form-label">Thứ tự:</label>
                    <div class="col-sm-2">
                     <input type="text" class="form-control" id="thutu_update" 
                    placeholder="Nhập thông tin">
                    </div>             

                    <label class="col-sm-2 col-form-label">Nội dung:</label>
                    <div class="col-sm-10">
                     <textarea id="editor1_update" rows="5" cols="80"></textarea>
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
            noidung: CKEDITOR.instances.editor1.getData(),
            thutu: document.getElementById('thutu').value,
            tour: '<?php echo $_GET['tour']; ?>'
        };

        fetch(`${apiBaseURL}/admin/api/lichtrinh/create.php`, {
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
            noidung: CKEDITOR.instances.editor1_update.getData(),
            thutu: document.getElementById('thutu_update').value,
            id: document.getElementById('id_update').value,
        };

        fetch(`${apiBaseURL}/admin/api/lichtrinh/update.php`, {
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

        fetch(`${apiBaseURL}/admin/api/lichtrinh/delete.php`, {
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
            fetch(`${apiBaseURL}/admin/api/lichtrinh/show.php?id=` + id, {
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

                CKEDITOR.instances.editor1_update.setData(data.noidung);

                document.getElementById('modalUpdate').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        

        function fetchDataByPage() {
            var searchInput = document.getElementById('search').value;

            fetch(`${apiBaseURL}/admin/api/lichtrinh/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&search=${searchInput}&tourfilter=<?php echo $_GET['tour']; ?>`, {
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

                cell1.innerHTML = item.thutu;
                cell2.innerHTML = '<a href="javascript:void(0)" onclick="openDetail(\'' + item.id + '\')">' + item.tieude + '</a>';

                cell3.innerHTML = '<button class="btn btn-sm btn-neutral" onclick="openDetail(\'' + item.id + '\')">Xem</button><button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
                cell3.style.textAlign="center";
                document.getElementById('h3-title').innerHTML = 'Lịch trình thuộc tour: ' + data.thuoctieude;

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

