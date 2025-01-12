<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
<div class="">
    <div class="row">
        <div class="col-8 m-auto">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class='text-muted text-center'>Welcome To Dashboard <span class='text-success'><?php echo $data['admin_name'] ?></span></h5>
                </div>
                <div class="card-body">
                    <!-- Biểu đồ cột - Số đơn hàng mua hàng tháng -->
                    <div class="chart-container mb-4">
                        <canvas id="ordersChart" style="height: 300px;"></canvas>
                    </div>

                    <!-- Grid chứa 2 biểu đồ dưới -->
                    <div class="row g-4">
                        <!-- Biểu đồ tròn -->
                        <div class="col-md-6">
                            <div class="chart-container p-3 bg-light shadow-sm">
                                <canvas id="productCategoryChart" style="height: 300px;"></canvas>
                            </div>
                        </div>

                        <!-- Biểu đồ cột -->
                        <div class="col-md-6">
                            <div class="chart-container p-3 bg-light shadow-sm">
                                <canvas id="manufacturerChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once ROOT ."/views/inc/adminFooter.php" ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ cột: Số đơn hàng mua hàng tháng
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Số tiền / triệu đồng',
                data: [120, 150, 20, 170, 250, 300, 40, 450, 320, 220, 180, 210],
                backgroundColor: [
                'rgba(255, 99, 132, 0.7)', // Honda
                'rgba(54, 162, 235, 0.7)', // Aston Martin
                'rgba(255, 206, 86, 0.7)', // Chevrolet
                'rgba(75, 192, 192, 0.7)', // Lamborghini
                'rgba(153, 102, 255, 0.7)', // Ford
                'rgba(255, 159, 64, 0.7)', // Nissan
                'rgba(100, 159, 64, 0.7)', // Mclaren
                'rgba(128, 0, 128, 0.7)',   // Mazda
                'rgba(0, 128, 255, 0.7)'   // Hot Wheels
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(100, 159, 64, 1)',
                'rgba(128, 0, 128, 1)',
                'rgba(0, 128, 255, 1)'
            ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
             plugins: {
                title: {
                    display: true,
                    text: 'Thống kê doanh thu hàng tháng',
                    font: { size: 16 },
                    color: '#333'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ tròn: Phần trăm các sản phẩm theo loại
    const productCategoryCtx = document.getElementById('productCategoryChart').getContext('2d');
    new Chart(productCategoryCtx, {
        type: 'pie',
        data: {
            labels: ['New Models', 'Teams', 'Track', 'Treasure', 'Event', 'Basic', 'Premium'],
            datasets: [{
                label: 'Phần trăm sản phẩm',
                data: [15, 20, 25, 10, 10, 10, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(100, 159, 64, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
             plugins: {
                title: {
                    display: true,
                    text: 'Số đơn hàng mua theo loại sản phẩm',
                    font: { size: 16 },
                    color: '#333'
                }
            },
        }
    });

    // Biểu đồ cột: Số lượng sản phẩm được mua theo nhà sản xuất
    const manufacturerCtx = document.getElementById('manufacturerChart').getContext('2d');
    new Chart(manufacturerCtx, {
        type: 'bar',
        data: {
            labels: ['Honda', 'Aston Martin', 'Chevrolet', 'Lamborghini', 'Ford	', 'Nissan', 'Mclaren', 'Mazda', 'Hot Wheels'],
            datasets: [{
                label: 'Số lượng sản phẩm',
                data: [50, 70, 100, 90, 80, 110, 130, 60, 95],
                backgroundColor: [
                'rgba(255, 99, 132, 0.7)', // Honda
                'rgba(54, 162, 235, 0.7)', // Aston Martin
                'rgba(255, 206, 86, 0.7)', // Chevrolet
                'rgba(75, 192, 192, 0.7)', // Lamborghini
                'rgba(153, 102, 255, 0.7)', // Ford
                'rgba(255, 159, 64, 0.7)', // Nissan
                'rgba(100, 159, 64, 0.7)', // Mclaren
                'rgba(128, 0, 128, 0.7)',   // Mazda
                'rgba(0, 128, 255, 0.7)'   // Hot Wheels
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(100, 159, 64, 1)',
                'rgba(128, 0, 128, 1)',
                'rgba(0, 128, 255, 1)'
            ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Cho phép mở rộng chiều cao
            plugins: {
                title: {
                    display: true,
                    text: 'Số lượng sản phẩm được mua theo nhà sản xuất',
                    font: { size: 16 },
                    color: '#333'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
