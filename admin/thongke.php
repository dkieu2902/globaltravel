<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style type="text/css">
    .nav1 .nav-item:nth-child(11) .nav-link{
        background: #1c84c6 !important;
        color: #fff;
    }
    .bi-bar-chart{
        color: #fff !important;
    }
    .chart-container {
        position: relative;
        height: 400px;
        margin: 20px 0;
    }
    .filter-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .total-revenue {
        background: linear-gradient(135deg, #1c84c6, #23a7e0);
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }
    .total-revenue h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 500;
    }
    .total-revenue .amount {
        font-size: 2rem;
        font-weight: bold;
        margin-top: 5px;
    }
    .btn-filter {
        background: #1c84c6;
        border-color: #1c84c6;
        padding: 8px 20px;
    }
    .btn-filter:hover {
        background: #156ab3;
        border-color: #156ab3;
    }
    .form-control:focus {
        border-color: #1c84c6;
        box-shadow: 0 0 0 0.2rem rgba(28, 132, 198, 0.25);
    }
</style>

<div class="card shadow border-0 mb-7">
    <div class="card-header bg-white py-3">
        <h5 class="card-title mb-0">
            <i class="bi bi-bar-chart me-2"></i>
            Biểu Đồ Tour Bán Chạy
        </h5>
    </div>
    <div class="card-body">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Từ ngày</label>
                    <input type="date" class="form-control" id="start_date" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Đến ngày</label>
                    <input type="date" class="form-control" id="end_date" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-filter" onclick="filterData()">
                        <i class="bi bi-funnel me-1"></i>
                        Lọc dữ liệu
                    </button>
                </div>
            </div>
        </div>

        <!-- Total Revenue Display -->
        <div class="total-revenue">
            <h3>Tổng doanh thu</h3>
            <div class="amount" id="total-amount">0 VNĐ</div>
        </div>

        <!-- Chart Container -->
        <div class="chart-container">
            <canvas id="tourChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
let tourChart;

// Sample data - thay thế bằng dữ liệu thực từ database
let sampleData = [
    { ten: 'Tour Hạ Long', tongtien: 45000000 },
    { ten: 'Tour Sapa', tongtien: 38000000 },
    { ten: 'Tour Phú Quốc', tongtien: 52000000 },
    { ten: 'Tour Đà Nẵng', tongtien: 41000000 },
    { ten: 'Tour Nha Trang', tongtien: 35000000 },
    { ten: 'Tour Hội An', tongtien: 28000000 },
    { ten: 'Tour Mũi Né', tongtien: 22000000 },
    { ten: 'Tour Cần Thơ', tongtien: 18000000 }
];

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN').format(amount) + ' VNĐ';
}

function createChart(data) {
    const ctx = document.getElementById('tourChart').getContext('2d');
    
    // Destroy existing chart if exists
    if (tourChart) {
        tourChart.destroy();
    }
    
    // Sort data by revenue (descending)
    data.sort((a, b) => b.tongtien - a.tongtien);
    
    const labels = data.map(item => item.matour);
    const revenues = data.map(item => item.tongtien);
    
    tourChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: revenues,
                backgroundColor: [
                    'rgba(28, 132, 198, 0.8)',
                    'rgba(35, 167, 224, 0.8)',
                    'rgba(52, 144, 220, 0.8)',
                    'rgba(41, 128, 185, 0.8)',
                    'rgba(30, 115, 190, 0.8)',
                    'rgba(46, 139, 192, 0.8)',
                    'rgba(25, 111, 175, 0.8)',
                    'rgba(33, 123, 188, 0.8)'
                ],
                borderColor: [
                    'rgba(28, 132, 198, 1)',
                    'rgba(35, 167, 224, 1)',
                    'rgba(52, 144, 220, 1)',
                    'rgba(41, 128, 185, 1)',
                    'rgba(30, 115, 190, 1)',
                    'rgba(46, 139, 192, 1)',
                    'rgba(25, 111, 175, 1)',
                    'rgba(33, 123, 188, 1)'
                ],
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: '#1c84c6',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + formatCurrency(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#666',
                        callback: function(value) {
                            return (value / 1000000).toFixed(0) + 'M';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#666',
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            }
        }
    });
}

function updateTotalRevenue(data) {
    const total = data.reduce((sum, item) => sum + item.tongtien, 0);
    document.getElementById('total-amount').textContent = formatCurrency(total);
}

function filterData() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    
    if (!startDate || !endDate) {
        alert('Vui lòng chọn đầy đủ ngày bắt đầu và ngày kết thúc');
        return;
    }
    
    if (new Date(startDate) > new Date(endDate)) {
        alert('Ngày bắt đầu không thể lớn hơn ngày kết thúc');
        return;
    }
    
    // Show loading effect
    const btn = event.target;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i>Đang lọc...';
    btn.disabled = true;
    
    // AJAX call để lấy dữ liệu từ server
    $.ajax({
        url: `${apiBaseURL}/admin/api/dondattour/get_tour_data.php`,
        method: 'GET',
        data: {
            tungay: startDate,
            denngay: endDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                createChart(response.data);
                // Cập nhật tổng doanh thu từ server
                document.getElementById('total-amount').textContent = formatCurrency(response.tongdoanhthu);
            } else {
                alert('Có lỗi xảy ra khi lấy dữ liệu: ' + response.message);
                // Fallback to sample data
                createChart(sampleData);
                updateTotalRevenue(sampleData);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Có lỗi xảy ra khi kết nối server. Sử dụng dữ liệu mẫu.');
            // Fallback to sample data
            createChart(sampleData);
            updateTotalRevenue(sampleData);
        },
        complete: function() {
            // Restore button state
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });
}

function loadInitialData() {
    const today = new Date().toISOString().split('T')[0];
    
    $.ajax({
        url: `${apiBaseURL}/admin/api/dondattour/get_tour_data.php`,
        method: 'GET',
        data: {
            tungay: today,
            denngay: today
        },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.data.length > 0) {
                createChart(response.data);
                document.getElementById('total-amount').textContent = formatCurrency(response.tongdoanhthu);
            } else {
                // Fallback to sample data if no real data available
                createChart(sampleData);
                updateTotalRevenue(sampleData);
            }
        },
        error: function(xhr, status, error) {
            console.warn('Không thể tải dữ liệu thực, sử dụng dữ liệu mẫu');
            // Fallback to sample data
            createChart(sampleData);
            updateTotalRevenue(sampleData);
        }
    });
}

// Initialize chart on page load
document.addEventListener('DOMContentLoaded', function() {
    loadInitialData();
});
</script>

<?php include 'inc/footer.php';?>