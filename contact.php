
<?php
    $title='GlobalTravel - Liên hệ';
    $description = 'GlobalTravel - Liên hệ với chúng tôi';
    $keywords = 'GlobalTravel - Liên hệ';
    $duongdan='/lien-he';
    include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){                   
        $image='admin/uploads/'.$result['logo'];
}}
	include 'include/header.php';
	// include 'include/slider.php';
?>
<?php 
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['guidi'])){
        $status = 0;
        $ten    = $_POST['ten'];
        $email  = 'No Email';
        $sdt    = $_POST['sdt'];
        $chude  = $_POST['chude'];
        
        if($ten=='' || $sdt=='' || $chude=='') {
            echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Error!',
                            text: 'Hãy nhập đủ thông tin!',
                            icon: 'error'});                        
                            </script>";         
        }else{
            
                if(preg_match('/^[0-9]{10}+$/', $sdt)){
                    $query ="insert into lienhe(ten,email,sdt,chude,status) values('$ten','$email','$sdt','$chude','$status')";
                $result =$db->insert($query);
                if($result){
                    $ten = '';
                    $sdt = '';
                    echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Success!',
                            text: 'Liên hệ thành công! Chúng tôi sẽ liên hệ lại sau.',
                            icon: 'success'});                      
                            </script>";
                }else{
                    echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Error!',
                            text: 'Không thể liên hệ! Bạn hãy thử lại sau.',
                            icon: 'error'});                        
                            </script>";
                
                }
            }else{
                echo "<script language='javascript'>                                    
                            Swal.fire({
                            title: 'Error!',
                            text: 'Số điện thoại không hợp lệ!',
                            icon: 'error'});                        
                            </script>";
                
            }
        }


    } ?>
<style type="text/css">
    .btn.btn-secondary{
        color:white; background:#e20c26; border: none;  
        margin-top: 30px;
    }
    .btn.btn-secondary:hover{
        color: #e20c26;
        background: white;
        border: 1px solid #e20c26;
    }
</style>
<script type="text/javascript">

</script>
<div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">
                    <img src="images/shortback.jpeg" alt="Ảnh về du lịch" class="backimg">
            <h2 class="fix-h2">Khám phá nhiều hơn tại đây</h2>
            </div>
        </div>
    </div>
    <div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;margin-bottom: 15px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-links">
                <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
                <span>/</span>
                <span>Liên hệ</span>
            </div>
        </div>
    </div>
</div>
 <form action="" method="post">
     <div class="container">
    <div class="row last-row">
        <div class="col-lg-6">
            <section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Gửi ngay cho chúng tôi.</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5" style="color:red;">Đường Z 115, Quyết Thắng, Thành phố Thái Nguyên, Thái Nguyên</p>

    <div class="row input-container">
            <div class="col-xs-12">
                <div class="styled-input wide">
                    <input type="text" name="ten" id="ten" value="<?php if(isset($ten)){
                                echo $ten;
                            } ?>" required />
                    <label for="ten">Họ và tên</label> 
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="styled-input">
                    <input type="text" name="email" id="email" value="<?php if(isset($email)){
                                echo $email;
                            } ?>" required />
                    <label for="email">Email</label> 
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="styled-input" style="float:right;">
                    <input type="text" name="sdt" id="sdt" value="<?php if(isset($sdt)){
                                echo $sdt;
                            } ?>" required />
                    <label for="sdt">Số điện thoại</label> 
                </div>
            </div>
            <div class="col-xs-12">
                <div class="styled-input wide">
                    <textarea name="chude" id="chude" required><?php if(isset($chude)){
                                echo $chude;
                            } ?></textarea>
                    <label for="chude">Nội dung yêu cầu</label>
                </div>
            </div>
            <div class="col-xs-12">
                <button class="glow-on-hover" name="guidi" type="submit">Gửi ngay <i class="bi bi-send"></i></button>
            </div>
    </div>

</section>
        </div>
        <div class="col-lg-6 bando">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3710.0528717550883!2d105.80730280000002!3d21.583859199999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31352738b1bf08a3%3A0x515f4860ede9e108!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiAmIFRydXnhu4FuIHRow7RuZyBUaMOhaSBOZ3V5w6pu!5e0!3m2!1svi!2s!4v1745857842149!5m2!1svi!2s" width="100%" height="90%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
 </div>
 </form>

 <?php
	include 'include/footer.php';
	
?>