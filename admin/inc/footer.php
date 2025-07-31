
</div>
        </main>
    </div>
</div>
</body>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/diacritics"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="ckfinder/ckfinder.js" type="text/javascript"></script>
    <script type="text/javascript">
        CKFinder.setupCKEditor();
        if(document.getElementById('editor1')){
            CKEDITOR.replace( 'editor1' );
        }
        if(document.getElementById('editor2')){
            CKEDITOR.replace( 'editor2' );
        }
        if(document.getElementById('editor1_update')){
            CKEDITOR.replace( 'editor1_update' );
        }
        if(document.getElementById('editor2_update')){
            CKEDITOR.replace( 'editor2_update' ); 
        }
               
    </script>
<script type="text/javascript">
  var apiBaseURL = 'http://localhost';

    function updateUrl() {
  var tieudeInput = document.getElementById('tieude');
  var urlInput = document.getElementById('url');
  
  var tieudeValue = tieudeInput.value;
  var urlValue = sanitizeTitle(tieudeValue);
  urlInput.value = urlValue;

  var tieudeInputU = document.getElementById('tieude_update');
  var urlInputU = document.getElementById('url_update');

  var tieudeValueU = tieudeInputU.value;
  var urlValueU = sanitizeTitle(tieudeValueU);
  urlInputU.value = urlValueU;

  var titleInput = document.getElementById('title');
  titleInput.value = tieudeInput.value;
}

function removeDiacriticsAndConvert(str) {
  return str.normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu tiếng Việt
    .replace(/đ/g, 'd')
    .replace(/Đ/g, 'D');
}

function sanitizeTitle(str) {
  return removeDiacriticsAndConvert(str)
    .toLowerCase()
    .replace(/\s+/g, '-')           // Thay khoảng trắng bằng dấu gạch ngang
    .replace(/[^a-z0-9\-]/g, '');   // Loại bỏ tất cả ký tự không hợp lệ
}



    function formatPrice(inputId,outputId) {
      var inputValue = document.getElementById(inputId).value;

      var numericValue = parseFloat(inputValue.replace(/,/g, ''));
      if (isNaN(numericValue)) {
        return;
      }

      var formattedValue = formatNumberWithCommas(numericValue);

      document.getElementById(inputId).value = formattedValue;

      document.getElementById(outputId).value = numericValue;
    }

    function formatNumberWithCommas(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var isthoigian = document.getElementById('thoigian');

    if(isthoigian){
        $(document).ready(function () {
            var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('thoigian').value = now.toISOString().slice(0,16);
        
        });
    }


    function resetForm() {
        var form = document.getElementById("myForm");
        form.reset();
        var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('thoigian').value = now.toISOString().slice(0,16);
               
        if(document.getElementById('editor1')){
            CKEDITOR.instances.editor1.setData('');
        }
        if(document.getElementById('editor2')){
            CKEDITOR.instances.editor2.setData('');
        }
        if(document.getElementById('editor1_update')){
            CKEDITOR.instances.editor3.setData('');
        }
    }

    function resetFormkhac() {
      var form = document.getElementById('formkhac');
      var inputs = form.getElementsByTagName('input');
      var textareas = form.getElementsByTagName('textarea');

      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type !== 'hidden' && inputs[i].id !== 'idvinhvien') {
          inputs[i].value = '';
        }
      }

      for (var j = 0; j < textareas.length; j++) {
        textareas[j].value = '';
      }
      CKEDITOR.instances.editor1.setData('');
      CKEDITOR.instances.editor2.setData('');
      CKEDITOR.instances.editor3.setData('');
      $(document).ready(function () {
            var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('thoigian').value = now.toISOString().slice(0,16);
        
        });
    }
    function deleteItem(id) {
        Swal.fire({
            title: 'Xác nhận xóa',
            text: 'Bạn có chắc muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id);
            }
        });
    }
    function updateStatus(id, status) {
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: 'Bạn có chắc muốn đổi trạng thái?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatusBefore(id, status);
            }
        });
    }

    function updateAccept(id, status) {
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: 'Bạn có thay đổi duyệt?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                updateAcceptBefore(id, status);
            }
        });
    }

    var searchInput = document.getElementById('search');
    if(searchInput){
        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                fetchDataByPage();
            }
        });
    }

        var searchButton = document.querySelector('.search-button');

    if(searchButton){
        searchButton.addEventListener('click', function () {
            fetchDataByPage();
        });
    }    
        
    var cotrangkhong = document.getElementById('itemsPerPage');
        if(cotrangkhong){
            var currentPage = 1;
            var itemsPerPage = cotrangkhong.value;
            document.querySelector('#hienthi-dropdown li[value="0"]').classList.add('selected');

            var hienthiDropdown = document.getElementById('hienthi-dropdown');
            var hienthiOptions = hienthiDropdown.getElementsByTagName('li');

            for (var i = 0; i < hienthiOptions.length; i++) {
                hienthiOptions[i].addEventListener('click', function() {
                    for (var j = 0; j < hienthiOptions.length; j++) {
                        hienthiOptions[j].classList.remove('selected');
                    }
                    this.classList.add('selected');
                    fetchDataByPage();
                });
            }
        }
        function displayPage(data) {
    var totalPages = Math.ceil(data.total / itemsPerPage);
    var maxPagesToShow = 6;
    var step = 3; // Number of pages to step forward/backward

    document.getElementById('itemCount').innerHTML = `Tổng: ${data.total}`;
    document.getElementById('paginationInfo').innerHTML = `Page ${currentPage} of ${totalPages}`;

    var paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = '';

    function createPageLink(page, text) {
        var pageLink = document.createElement('li');
        pageLink.textContent = text;
        pageLink.addEventListener('click', function (event) {
            event.preventDefault();
            currentPage = page;
            fetchDataByPage();
            updateActivePageStyle();
        });
        return pageLink;
    }

    var firstPageLink = createPageLink(1, '<<');
    paginationContainer.appendChild(firstPageLink);

    if (currentPage > step + 1) {
        var ellipsisBackLink = document.createElement('li');
        ellipsisBackLink.textContent = '...';
        ellipsisBackLink.addEventListener('click', function (event) {
            event.preventDefault();
            currentPage = Math.max(1, currentPage - step);
            fetchDataByPage();
            updateActivePageStyle();
        });
        paginationContainer.appendChild(ellipsisBackLink);
    }

    var startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
    var endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

    if (endPage - startPage < maxPagesToShow) {
        startPage = Math.max(1, endPage - maxPagesToShow + 1);
    }

    for (var i = startPage; i <= endPage; i++) {
        var pageLink = createPageLink(i, i);
        paginationContainer.appendChild(pageLink);
    }

    if (endPage < totalPages - step) {
        var ellipsisForwardLink = document.createElement('li');
        ellipsisForwardLink.textContent = '...';
        ellipsisForwardLink.addEventListener('click', function (event) {
            event.preventDefault();
            currentPage = Math.min(totalPages, currentPage + step);
            fetchDataByPage();
            updateActivePageStyle();
        });
        paginationContainer.appendChild(ellipsisForwardLink);
    }

    var lastPageLink = createPageLink(totalPages, '>>');
    paginationContainer.appendChild(lastPageLink);

    function updateActivePageStyle() {
        var pageLinks = document.querySelectorAll('#pagination li');
        pageLinks.forEach(function (link) {
            link.classList.remove('active');
        });

        var currentPageLink = Array.from(pageLinks).find(link => parseInt(link.textContent) === currentPage);
        if (currentPageLink) {
            currentPageLink.classList.add('active');
        }
    }

    updateActivePageStyle();
}

        function changeItemsPerPage() {
            var selectedValue = document.getElementById('itemsPerPage').value;
            itemsPerPage = parseInt(selectedValue);
            fetchDataByPage();
        }



function showaddModal(){
    document.getElementById('modalAdd').style.display = 'block';
}
function closeaddModal(){
    document.getElementById('modalAdd').style.display = 'none';
}

function showupdateModal(){
    document.getElementById('modalUpdate').style.display = 'block';
}
function closeupdateModal(){
    document.getElementById('modalUpdate').style.display = 'none';
}



function toggleButton(){
    if (document.getElementById('navbarVertical').style.width == '0px') {
        document.getElementById('navbarVertical').style.width = '100%';
    } else {
        document.getElementById('navbarVertical').style.width = '0px';
    }
}

    
</script>

</body>
</html>
