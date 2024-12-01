<?php 
$users = $data['users'];
$bookings = $data['bookings'];
$rooms = $data['rooms'];
$revenue = $data['revenue'];
$dataRevenuaMonth = $data['data_revenue_mouth'];
$revenue_per_month = $dataRevenuaMonth['revenue_per_month'];
$bookings_per_month = $dataRevenuaMonth['bookings_per_month'];

// Đảm bảo rằng mảng bookings_per_month và revenue_per_month có đủ 12 giá trị
$bookings_per_month = array_pad($bookings_per_month, 12, 0); // Điền 0 cho các tháng thiếu
$revenue_per_month = array_pad($revenue_per_month, 12, 0); // Điền 0 cho các tháng thiếu

$months = $dataRevenuaMonth['months'];

$current_month = date('n');
?>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Rooms</h2>
                <p class="text-2xl"><?= $rooms ?></p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Bookings</h2>
                <p class="text-2xl"><?= $bookings ?></p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Total Revenue</h2>
                <p class="text-2xl"><?= $revenue ?></p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Users</h2>
                <p class="text-2xl"><?= $users ?></p>
            </div>
        </div>

        <div class="bg-white p-6 mt-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold mb-4">Bookings and Revenue Over Time</h2>
            <canvas id="chart"></canvas>
        </div>

        <div class="bg-white p-6 mt-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold mb-4">Monthly Revenue for This Year</h2>
            <canvas id="monthlyRevenueChart"></canvas>
        </div>
    </div>

    <script>
    // Chuyển đổi dữ liệu PHP sang JavaScript
    var months = <?php echo json_encode($months); ?>;
    var bookingsData = <?php echo json_encode($bookings_per_month); ?>;
    var revenueData = <?php echo json_encode($revenue_per_month); ?>;

    console.log(months); // Kiểm tra giá trị tháng
    console.log(bookingsData); // Kiểm tra dữ liệu bookings
    console.log(revenueData); // Kiểm tra dữ liệu revenue

    // Biểu đồ Bookings và Revenue
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months, // Các tháng
            datasets: [{
                label: 'Bookings',
                data: bookingsData, // Dữ liệu bookings
                borderColor: 'rgb(75, 192, 192)',
                fill: false,
            }, {
                label: 'Revenue',
                data: revenueData, // Dữ liệu revenue
                borderColor: 'rgb(255, 99, 132)',
                fill: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
        }
    });

    // Biểu đồ Monthly Revenue
    var ctxMonthlyRevenue = document.getElementById('monthlyRevenueChart').getContext('2d');
    var monthlyRevenueChart = new Chart(ctxMonthlyRevenue, {
        type: 'bar',
        data: {
            labels: months, // Tháng
            datasets: [{
                label: 'Revenue per month in this year (USD)',
                data: revenueData, // Dữ liệu doanh thu
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString(); // Định dạng tiền tệ
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
    </script>
</body>