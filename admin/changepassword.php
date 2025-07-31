<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="card shadow border-0 mb-7">
                    <div class="row">
                        <div class="col-sm-6 col-12 text-sm-start">
                            <div class="card-header">
                                <h3 class="mb-0">Đổi mật khẩu</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-sm-end">
                        </div>
                    </div>
                    <div class="row" style="padding:25px;">
                    	<div class="col-lg-8 text-end pb-4">
                    		<div>
					            <button type="button" class="btn btn-primary" onclick="changepassword()">Lưu dữ liệu</button>
					        </div>
                    	</div>
                        <label class="col-sm-4"></label>
                        <div class="col-lg-12">
                        	<form class="form-group row" enctype="multipart/form-data">

                    <label class="col-sm-2 col-form-label">Mật khẩu cũ:</label>
                    <div class="col-sm-6">
                     <input type="password" id="maukhaucu" class="form-control">
                    </div>
                    <label class="col-sm-4"></label>

                    <label class="col-sm-2 col-form-label">Mật khẩu mới:</label>
                    <div class="col-sm-6">
                     <input type="password" id="matkhaumoi" class="form-control">
                    </div>
                    <label class="col-sm-4"></label>

                    <label class="col-sm-2 col-form-label">Nhập lại mật khẩu:</label>
                    <div class="col-sm-6">
                     <input type="password" id="nhaplai" class="form-control">
                    </div>
                    <label class="col-sm-4"></label>
                                               
      </form>
                        </div>
                        <div class="col-lg-8 text-end">
                    		<div style="padding-top: 10px;">
					            <button type="button" class="btn btn-primary" onclick="changepassword()">Lưu dữ liệu</button>
					        </div>
                    	</div>
                        <label class="col-sm-4"></label>
                    </div>
                    
                    
                </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script type="text/javascript">    
    function changepassword() {
        var matkhaucu = document.getElementById('maukhaucu').value;
        var matkhaumoi = document.getElementById('matkhaumoi').value;
        var nhaplai = document.getElementById('nhaplai').value;
        
        var matkhaucuMD5 = convertToMD5(matkhaucu);
        var matkhaumoiMD5 = convertToMD5(matkhaumoi);

        if (!matkhaucu || !matkhaumoi|| !nhaplai) {
            toastr.error('Lỗi', 'Vui lòng nhập đầy đủ thông tin');
            return;
        }

        if(matkhaucuMD5 != '<?php echo Session::get('password') ?>'){
            toastr.error('Lỗi', 'Mật khẩu không đúng!');
            return;
        }
        if(matkhaumoi != nhaplai){
            toastr.error('Lỗi', 'Mật khẩu mới không khớp nhau!');
            return;
        }
        
        var formData = {
            password: matkhaumoi,
            id: <?php echo Session::get('id') ?>,
        };       

        fetch(`${apiBaseURL}/viettel/api/taikhoan/changepassword.php`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            toastr.success('Thông báo', 'Đổi mật khẩu thành công');
            setTimeout(function() {
                fetch(`${apiBaseURL}/viettel/destroy_session.php`, {
                    method: 'GET'
                })
                .then(response => {
                    window.location.href = `${apiBaseURL}/viettel/login.php`;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }, 2000);
        })
    }
    function convertToMD5(string) {
        var md5 = CryptoJS.MD5(string);
        return md5.toString(CryptoJS.enc.Hex);
    }


        document.addEventListener('DOMContentLoaded', function() {

        });

   
</script>
<?php include 'inc/footer.php';?>

