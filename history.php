<?php
	$title='GlobalTravel - Lịch sử';
	$description = 'GlobalTravel - Lịch sử đặt tour của quý khách';
	$keywords = 'GlobalTravel - Lịch sử';	
	$duongdan='/lich-su-dat-tour';
	include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){                   
		$image='admin/uploads/'.$result['logo'];
}}
	include 'include/header.php';
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
    			<span>Lịch sử</span>
    		</div>
    	</div>
    </div>
</div>

<form action="" method="post">
 <div class="container" style="padding:30px 10px 30px 10px;">
 	<div class="row">
 		<div class="col-lg-12" style="border-bottom: 1px solid rgba(51,51,51,0.2)"><h2 style="color:#ec2424"><i class="bi bi-clock-history"></i> Lịch sử đặt tour</h2></div>
		<div class="col-lg-12" style="overflow-x:auto; padding-top:30px ;">
			
						<table class="table table-bordered" style="margin-left: auto;margin-right: auto;"> 									
							<tr>
								<th width="5%">STT</th>
								<th width="10%">Mã tour</th>
								<th width="15%">Tên tour</th>
								<th width="10%">Khởi hành</th>
								<th width="10%">Giá</th>
								<th width="15%">Số lượng</th>
								<th width="20%">Ngày đặt</th>
							</tr>			
								<?php
							
								$get_history_cart = $cart->get_history_cart($customer_id);
								if($get_history_cart){
									$subtotal = 0;
									$qty = 0;
									$i = 0;
									while ($result = $get_history_cart->fetch_assoc()) {
										$i++;?>
									<tr>
								<td><?php echo $i; ?></td>
								<td><a href="tour/<?php echo $result['url']?>" title="<?php echo $result['matour']?>"><?php echo $result['matour']?></a></td>
								<td><a href="tour/<?php echo $result['url']?>" title="<?php echo $result['matour']?>"><?php echo $result['tentour']?></a></td>
								<td><?php echo $result['khoihanh']?></td>
								<td><?php echo $fm->format_currency($result['gia']).'đ'?></td>
								<td><?php echo $result['soluong']?>					
								</td>
								<td>
									<?php
										
										echo $fm->formatDate($result['ngaydat']);
									?>
								</td>
							</tr>


							<?php	}}	 ?>					
							
							
						</table>							
					   
		</div>
 	</div>
 </div>
	</form>
 <?php
	include 'include/footer.php';
	
?>