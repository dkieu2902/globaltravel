
<?php
                   
	$title = 'GlobalTravel - Tất cả các bài viết';
	$description = 'GlobalTravel - Hiển thị tất cả các bài viết';
	$keywords = 'GlobalTravel - Các bài viết';	
	$duongdan='/cac-bai-viet';	  
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
<style type="text/css"></style>

    <div class="container-fluid container-header-slider">
        <div class="row">
            <div class="col-lg-12"  style="padding: 0;position: relative;">
                <div class="header-tintuc">
                <?php
                $get_slider = $blog->show_lastest_blog();
                            if($get_slider){
                                while($result_slider = $get_slider->fetch_assoc()){                        
            ?>
                <div class="header-item">
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><img src="admin/uploads/<?php echo $result_slider['slider'] ?>" alt="<?php echo $result_slider['tieude'] ?>"></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>"><h3 class="header-tentin"><?php echo $result_slider['tieude'] ?></h3></a>
                    <a href="tin-tuc/<?php echo $result_slider['url'] ?>" title="<?php echo $result_slider['tieude'] ?>" class="chitiettin"><i class="bi bi-arrow-right fa-3x"></i></a>
                </div>
            <?php }} ?>

            </div>
            <h2 class="header-khampha">Khám phá ngay các bài viết mới nhất</h2>
            </div>
        </div>
    </div>
    <div class="link-content">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12 col-links">
    				<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
    				<span>></span>
    				<span>Bài viết</span>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="container product-container">
	<div class="row first-row pt-4">
		<?php
    			$show_all_blogs = $blog->show_all_blogs();
    			if($show_all_blogs){
    				while ($result_tt = $show_all_blogs->fetch_assoc()) {
    		?>
<div class="col-lg-12 mb-4">
  <div class="row align-items-center g-3 shadow p-3 rounded bg-white">
    <div class="col-md-4">
      <a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>">
        <img src="admin/uploads/<?php echo $result_tt['hinhanh'] ?>" alt="<?php echo $result_tt['tieude'] ?>" class="img-fluid rounded">
      </a>
    </div>
    <div class="col-md-8">
      <h6 class="theloai4 mb-2 text-danger"><?php echo $result_tt['tendm'] ?></h6>
      <a href="tin-tuc/<?php echo $result_tt['url'] ?>" title="<?php echo $result_tt['tieude'] ?>">
        <h4 class="tieude4 mb-2"><?php echo $fm->textShorten($result_tt['tieude'], 60) ?></h4>
      </a>
      <p class="tomtat4 mb-2"><?php echo $fm->textShorten($result_tt['mota'], 120) ?></p>
      <div class="viewtime4 text-muted">
        <span><i class="bi bi-calendar3 me-1"></i> <?php echo $fm->formatDate_Details($result_tt['thoigian']) ?></span>
        <span class="ms-3"><i class="bi bi-eye me-1"></i> <?php echo $result_tt['luotxem'] ?></span>
      </div>
    </div>
  </div>
</div>
		
		<?php }} ?>
		<div class="col-lg-12 cottrang"><?php
					$product_all = $blog->get_all();
					$product_count = mysqli_num_rows($product_all);
					$item_perpage = 10;
					$product_button = $product_count / $item_perpage;
					$i=1;
					if(isset($_GET['trang'])&& $_GET['trang']>1){
						$prev_page = $_GET['trang'] - 1;
						echo '<p><a class="trang" href="cac-bai-viet-'.$prev_page.'" title="Trang'.$prev_page.'"><</a></p>';
					}
					if(isset($_GET['trang'])&&$_GET['trang']>3){
						echo '<p><a class="trang" href="cac-bai-viet-1" title="Trang 1">1</a></p>';
					}
					
					for($i=1;$i<=ceil($product_button);$i++){
						if($product_button >=1){
							if(isset($_GET['trang'])&&$i!= $_GET['trang']){
							if($i > $_GET['trang'] - 3 && $i < $_GET['trang'] + 3 ){
							echo '<p><a class="trang" href="cac-bai-viet-'.$i.'" title="Trang '.$i.'">'.$i.'</a></p>';
						}}
						else{
							echo '<p><a class="currentpage" href="cac-bai-viet-'.$i.'" title="Trang '.$i.'">'.$i.'</a></p>';
						}
						}else{
							echo '';
						}
						

					}
					if(isset($_GET['trang'])&&$_GET['trang'] < $product_button - 3){
						echo '<p><a class="trang" href="cac-bai-viet-'.$product_button.'" title="'.$product_button.'">'.$product_button.'</a></p>';
					}
					if(isset($_GET['trang'])&&$_GET['trang'] < $product_button - 1){
						$next_page = $_GET['trang'] + 1;
						echo '<p><a class="trang" href="cac-bai-viet-'.$next_page.'" title="'.$next_page.'">></a></p>';
					}

			?></div>


	</div>

</div>






 <?php
	include 'include/footer.php';
	
?>