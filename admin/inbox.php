<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../classes/cart.php');
include_once ($filepath . '/../helpers/format.php');
?>
<style type="text/css">
    .nav1 .nav-item:nth-child(6) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-chat{
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
                                <h3 class="mb-0">Quản lý đơn đặt tour</h3>
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
                        <div class="col-lg-6"></div>
                        <div class="col-lg-2" style="padding: 4px 0 0 0;">                           
                            <select id="filterstatus" onchange="changeStatusFilter()">
                                <option value="0">Chưa hoàn thành</option>
                                <option value="1">Đã hoàn thành</option>
                            </select>
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
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hướng dẫn viên</th>
                                            <th scope="col">Mã tour</th>
                                            <th scope="col">Tên tour</th>
                                            <th scope="col">Ngày khởi hành</th>
                                            
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                            <th scope="col">Ngày đặt</th>
                                            <th scope="col">Họ tên</th>
                                            <th scope="col">SĐT</th>
                                            <th scope="col">Email</th>
                                            
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


<script type="text/javascript">  
    function updateStatusBefore(id, status) {
        var formData = {
            status: status,
            id: id,
        };

        fetch(`${apiBaseURL}/admin/api/dondattour/update.php`, {
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

        fetch(`${apiBaseURL}/admin/api/dondattour/delete.php`, {
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

        

        function changeStatusFilter() {
            filterstatus = document.getElementById('filterstatus').value;
            fetchDataByPage();
        }

        function fetchDataByPage() {
            var searchInput = document.getElementById('search').value;
            var filterstatus = document.getElementById('filterstatus').value;
            fetch(`${apiBaseURL}/admin/api/dondattour/readbypage.php?trang=${currentPage}&sp_tungtrang=${itemsPerPage}&search=${searchInput}&filterstatus=${filterstatus}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                displayDataInTable(data);
                displayPage(data);
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
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var cell11 = row.insertCell(10);
        var cell12 = row.insertCell(11);
        var cell12 = row.insertCell(11);

        cell1.innerHTML = item.id;
        cell2.innerHTML = item.status == '1' ? '<span class="badge badge-lg badge-dot">' +
                '<i class="bg-success"></i>Đã hoàn thành' +
            '</span>' : '<span class="badge badge-lg badge-dot" onclick="updateStatus(\'' + item.id + '\', 1)" style="cursor:pointer;">' +
                '<i class="bg-danger"></i>Chưa hoàn thành' +
            '</span>';
        cell2.style.textAlign = "center";
        cell3.innerHTML = item.tenhdv;
        
        cell4.innerHTML = item.matour;
        cell5.innerHTML = item.tentour;
        cell6.innerHTML = item.tieude;
        cell7.innerHTML = item.soluong;
        cell8.innerHTML = item.gia;
        cell9.innerHTML = item.ngaydat;
        cell10.innerHTML = item.hoten;
        cell11.innerHTML = item.sdt;
        cell12.innerHTML = item.email;

        cell12.innerHTML = '<button onclick="deleteItem(\'' + item.id + '\')" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>';
        cell12.style.textAlign = "center";
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

