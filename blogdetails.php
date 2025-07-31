<?php
	 if(!isset($_GET['url']) || $_GET['url']==NULL){
   		echo "<script>window.location ='404.php'</script>";
   
}else{
    $url=$_GET['url'];
}
?>
<?php
	$_SESSION['didVisit'] = 1;
	include_once 'classes/product.php';
	$product = new product();
	$get_blogdetailsbyUrl = $product->get_blogdetailsbyUrl($url);
    			if($get_blogdetailsbyUrl){
    				while ($result_details = $get_blogdetailsbyUrl->fetch_assoc()) {
	      				$title=$result_details['title'];
	      				$description=$result_details['description'];
	      				$keywords=$result_details['keywords'];
	      				$duongdan='/'.$result_details['url1'].'/'.$result_details['url'];
	      				$image='admin/uploads/'.$result_details['hinhanh'];
$articleSchema = [
   "@context" => "http://schema.org",
   "@type" => "NewsArticle",
   "mainEntityOfPage" => [
      "@type" => "WebPage",
      "@id" => "http://localhost/globaltour/tin-tuc/".$result_details['url']
   ],
   "headline" => $result_details['tieude'],
   "image" => [
      "url" => "http://localhost/globaltour/admin/uploads/".$result_details['hinhanh'],
      "width" => "100%",
      "height" => "auto"
   ],
   "datePublished" => $result_details['thoigian'],
   "dateModified" => $result_details['thoigian'],
   "author" => [
      "@type" => "Person",
      "name" => "Nguyễn Đức Trường"
   ],
   "publisher" => [
      "@type" => "Organization",
      "name" => "Đặt lịch Online du lịch, nghỉ mát",
      "logo" => [
         "@type" => "ImageObject",
         "url" => "http://localhost/globaltour/admin/uploads/".$result_details['hinhanh'],
         "width" => "50px",
         "height" => "50px"
      ]
   ],
   "description" => $result_details['description'],
   "articleBody" => $result_details['mota'],
   "keywords" => $result_details['keywords']
];


$articleSchemaJson = json_encode($articleSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);	      				
	      			}
	      		}
	      			else{
	      				include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
	$title = $result['tieude'];
	$description = $result['mota'];
	$keywords = $result['keywords'];
	$productSchemaJson = '';
	$articleSchemaJson = '';	
}}
	      			}
	include 'include/header.php';
?>
<?php 
	$_SESSION['didVisit'] = 1;
	if(isset( $_SESSION['didVisit']) ){
		$get_blogdetailsbyUrl = $product->get_blogdetailsbyUrl($url);
    			if($get_blogdetailsbyUrl){
    				while ($result_details = $get_blogdetailsbyUrl->fetch_assoc()) {
    					$luotxemmoi = $result_details['luotxem'] + 1;
    					$update=$blog->increase_view($url,$luotxemmoi);
    				}
    			}
	}
 ?> 
<script type="application/ld+json">
   <?php echo $productSchemaJson; ?>
</script>

 <script type="application/ld+json">
   <?php echo $articleSchemaJson; ?>
</script>

<?php
    			$getproductbyUrl = $product->get_blogdetailsbyUrl($url);
    			if($getproductbyUrl){
    				while ($result_details = $getproductbyUrl->fetch_assoc()) {  				
    		?>


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
          <span><?php echo $result_details['tieude'] ?></span>
        </div>
      </div>
    </div>
</div>

<div class="container blog-container">
	<div class="row first-row">
		<div class="col-lg-8">
			<?php 
			$getproductbyUrl = $product->get_blogdetailsbyUrl($url);
    			if($getproductbyUrl){
    				while ($result_blog = $getproductbyUrl->fetch_assoc()) { ?>
			<p class="h4" style="color:#ed1a36;font-weight: 600;"><?php echo $result_blog['tieude']?> </p>
			<p style="padding:5px 0 5px 0;border-bottom: 1px solid rgba(51,51,51,0.2);font-weight: 600;"><span style="font-size: 13px; color: #ff8c00; "><i class="bi bi-clock"></i> <?php echo $fm->formatDate_Details($result_blog['thoigian'])?></span>&emsp;
				<span style="font-size: 13px; color: #ff8c00; "><i class="bi bi-eye"></i> Lượt xem: <?php echo $result_blog['luotxem']?></span>
			</p>
			<div class="noidungstyle">
					<?php
                                        $noidung=str_replace('<table','<div class="table_sp"><table',$result_blog['noidung']);
                                        echo $noidung=str_replace('</table>','</table></div>',$noidung);

                                        ?>
					
				</div>
			<?php }} ?>
		</div>
		<div class="col-lg-4 blogdetails-4">
			<p style="border-bottom: 2px solid #ff3f55;position: relative; padding-top: 20px;"><span class="chitietsp"><i class="bi bi-newspaper"></i> Tin đọc nhiều</span></p>
			<ul class="right-menu">
				<?php
    			$get_all_blogs = $blog->get_all_blogs();
    			if($get_all_blogs){
    				while ($result = $get_all_blogs->fetch_assoc()) {
    					
    		?>
				<li>
					<div style="display:flex;">
						<a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>" style="width:40% "><img src="admin/uploads/<?php echo $result['hinhanh']?>" width="100%;" style="border-radius:5px;" alt="<?php echo $result['tieude']?>"></a>
					<p style="padding-left: 15px;width: 60%;"><a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>"><?php echo $result['tieude']?></a><br>
						<span style="font-size: 13px; color: #ff8c00;"><i class="bi bi-clock"></i> <?php echo $fm->formatDate_Details($result['thoigian'])?></span><br>
						 <span style="font-size: 13px; color: #ff8c00;"><i class="bi bi-eye"></i> Lượt xem: <?php echo $result['luotxem']?></span>
						
					</p>
					</div>
					<p style="padding-top:5px;"></p>
				</li>
				<?php
			
		}
	}
	?>
			</ul>
		</div>
	</div>
</div>

<?php }} ?>


 <?php
	include 'include/footer.php';
	
?>