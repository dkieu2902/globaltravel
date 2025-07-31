<?php
    include '../lib/session.php';
    Session::checkSession();

?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Trang quản trị</title>
    <?php 
                    include '../classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>
    <link rel="icon" type="image/x-icon" href="uploads/<?php echo $result['logo']?>">
<?php }} ?>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/layout.css?v1.2" media="screen" />
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- BEGIN: load jquery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- END: load jquery -->
    <script src="js/setup.js" type="text/javascript"></script>
    

    <style type="text/css">
      @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');
*{
    font-family: 'Quicksand', sans-serif;
}

.content{
    padding-top: 50px;
}
td{
    padding: 4px 10px !important;
    font-size: 14px !important;
}
th{
    font-size: 14px !important;
    text-align: center;
    font-weight: 600 !important;
    color: #000 !important;
}
.cke_dialog_container 
{
    z-index: 20000
}
.cke_inner.cke_maximized {
    top: 0px !important;
}
.cke_browser_webkit{
    margin-top: 12px !important;
}
input[type="text"],textarea, select, input[type="file"], input[type="datetime-local"], img{
  margin-top: 8px;
  border-radius: 0 !important;
  border: 1px solid #CCCCCC !important;
}
textarea.form-control {
    min-height: calc(0.9em + 1.3rem + 2px) !important;
}
.form-control{
    padding: 7px 15px !important;
}
label{
    font-size: 15px !important;
    color: #000;
}
.modal-header,.modal-footer{
    border-radius: 0 !important;
}
.modal-content{
    border-radius: 2px;
}
#pagination {
    list-style: none;
    display: flex;
    justify-content: right;
    padding: 10px;
}

#pagination li {
    padding: 2px 8px;
    border: 1px solid #ccc;
    cursor: pointer;
    display: inline-block;
    font-size: 12px;
}

#pagination li:hover {
    background-color: #f2f2f2;
}

#pagination li a {
    text-decoration: none;
    color: #333;
    font-size: 12px;
}

#pagination li.active {
    background-color: #1c84c6;
    color: #fff;
    font-size: 12px;
}

#itemsPerPage{
    padding: 5px 10px;
    border: 1px solid #DDDDDD;
    margin: 10px;
    width: 100%;
}
.col-pageinfo{
    padding: 10px;
}
.col-pageinfo table{
    margin-left: 12px; 
}
.col-pageinfo table,td,th{
    border: 1px solid #e7eaec;
}
#itemCount, #paginationInfo {
    font-size: 14px;    
    color: #333; 
}
.search-container {
    margin: 10px 10px 0 0;
    display: flex;
    justify-content: right;
    align-items: end;
}

/* Style for the search input */
.search-input {
    padding: 5px 10px;
    border: 1px solid #ccc;
    margin: 0 !important;
    width: 100%;
}
.search-input:focus{
    border-color: #4CAF50;
    outline: none;
}

/* Style for the search button */
.search-button {
    padding: 5px 10px;
    background-color: #1c84c6;
    color: white;
    border: 1px solid #1c84c6;
    cursor: pointer;
}
#hienthi-dropdown {
    list-style: none;
    display: flex;
    justify-content: left;
    padding: 10px;
    margin: 0 !important;
}

#hienthi-dropdown li{
    padding: 5px 10px;
    border: 1px solid #DDDDDD;
}

#hienthi-dropdown li.selected {
    background-color: #4CAF50;
    color: white;
}

/* Hiệu ứng hover cho thẻ li */
#hienthi-dropdown li:hover {
    background-color: #ddd;
    cursor: pointer;
}
.card{
    border-radius: 0px !important;
}
.table-responsive{
    padding: 10px;
}
table{
    border: 1px solid #DDDDDD;
}
.nav-link{
    font-size: 15px !important;
}
.nav-link:hover{
    color: #000 !important;
}
#filterDanhmuc,#filterThuonghieu,#filterstatus,#filterDuyet,#filterKhuvuc,#filterdanhmuc{
    padding: 7px 10px;
    border: 1px solid #DDDDDD;
    margin-top: 5px;
    width: 100%;
}
.card-header{
    padding: 10px;
}
table a{
    color: #1c84c6;
    font-weight: 600;
}
.btn-primary{
    background-color: #1c84c6;
    border-color: #1c84c6;
}
.btn-primary:hover{
    background-color: #1c84c6;
    border-color: #1c84c6;
}

.modal-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: 9999;
  backdrop-filter: blur(2px);
  animation: fadeIn 0.3s ease-out;
}

.modaladd {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15), 0 8px 32px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 1200px;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  animation: modalSlideIn 0.4s ease-out;
}

.modal-headerr {
  position: sticky;
  top: 0;
  background-color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 24px 32px;
  border-bottom: 1px solid #e5e7eb;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  z-index: 10;
}

.modal-headerr h2 {
  margin: 0;
  font-size: 24px;
  font-weight: 600;
  color: #1f2937;
}

.modal-close {
  background: none;
  border: none;
  font-size: 24px;
  color: #6b7280;
  cursor: pointer;
  padding: 8px;
  border-radius: 6px;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
}

.modal-close:hover {
  background-color: #f3f4f6;
  color: #374151;
}

.modal-bodyy {
  flex: 1;
  padding: 32px;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: #d1d5db #f9fafb;
}

.modal-bodyy::-webkit-scrollbar {
  width: 8px;
}

.modal-bodyy::-webkit-scrollbar-track {
  background: #f9fafb;
  border-radius: 4px;
}

.modal-bodyy::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 4px;
}

.modal-bodyy::-webkit-scrollbar-thumb:hover {
  background: #9ca3af;
}

.modal-footerr {
  position: sticky;
  bottom: 0;
  background-color: #fff;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 12px;
  padding: 20px 32px;
  border-top: 1px solid #e5e7eb;
  box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.1);
}

.modal-footerr button {
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 500;
  transition: all 0.2s ease;
  cursor: pointer;
  border: none;
  font-size: 14px;
}

.btn-primary {
  background-color: #3b82f6;
  color: white;
}

.btn-primary:hover {
  background-color: #2563eb;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-secondary {
  background-color: #f3f4f6;
  color: #374151;
  border: 1px solid #d1d5db;
}

.btn-secondary:hover {
  background-color: #e5e7eb;
  transform: translateY(-1px);
}

/* Form styling inside modal */
.modal-bodyy .form-group {
  margin-bottom: 20px;
}

.modal-bodyy label {
  display: block;
  font-weight: 500;
  color: #374151;
  margin-bottom: 6px;
  font-size: 14px;
}

.modal-bodyy input,
.modal-bodyy select,
.modal-bodyy textarea {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 14px;
  transition: all 0.2s ease;
  background-color: #fff;
}

.modal-bodyy input:focus,
.modal-bodyy select:focus,
.modal-bodyy textarea:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.modal-bodyy .form-row {
  display: flex;
  gap: 16px;
}

.modal-bodyy .form-row .form-group {
  flex: 1;
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes modalSlideIn {
  from {
    opacity: 0;
    transform: translate(-50%, -50%) scale(0.9);
  }
  to {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
  }
}

/* Responsive */
@media (max-width: 768px) {
  .modaladd {
    width: 95%;
    max-height: 95vh;
  }
  
  .modal-headerr {
    padding: 20px 24px;
  }
  
  .modal-headerr h2 {
    font-size: 20px;
  }
  
  .modal-bodyy {
    padding: 24px;
  }
  
  .modal-footerr {
    padding: 16px 24px;
    flex-direction: column-reverse;
    gap: 8px;
  }
  
  .modal-footerr button {
    width: 100%;
    justify-content: center;
  }
  
  .modal-bodyy .form-row {
    flex-direction: column;
    gap: 0;
  }
}

@media (max-width: 480px) {
  .modaladd {
    width: 100%;
    height: 100%;
    max-height: 100vh;
    border-radius: 0;
    top: 0;
    left: 0;
    transform: none;
  }
  
  .modal-headerr {
    padding: 16px 20px;
  }
  
  .modal-bodyy {
    padding: 20px;
  }
  
  .modal-footerr {
    padding: 16px 20px;
  }
}
.navbar-vertical.navbar-expand-lg {
    transition: width 0.4s ease-in-out;
}
#toggleButton{
    background: none !important;
}


    </style>
    <body>

    
            
          
    
    