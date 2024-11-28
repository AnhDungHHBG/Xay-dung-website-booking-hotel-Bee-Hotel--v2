<?php 
$users = $data['users'];
$bookings = $data['bookings'];
$rooms = $data['rooms'];
$revenue = $data['revenue'];
$dataRevenuaMonth = $data['data_revenue_mouth'];
$revenue_per_months = $data['revenue_per_month'];

$bookings_per_month = $dataRevenuaMonth['bookings_per_month'];
$revenue_per_month = $dataRevenuaMonth['revenue_per_month'];
?>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Thống kê phòng -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Rooms</h2>
            <p class="text-2xl"><?= $rooms ?></p>
        </div>

        <!-- Thống kê đặt phòng -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Bookings</h2>
            <p class="text-2xl"><?= $bookings ?></p>

        </div>

        <!-- Thống kê doanh thu -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Total Revenue</h2>
            <p class="text-2xl"><?= $revenue ?></p>
        </div>

        <!-- Thống kê người dùng -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Users</h2>
            <p class="text-2xl"><?= $users ?></p>

        </div>
    </div>

    <!-- Biểu đồ thống kê -->
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
    // Biểu đồ Chart.js
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Bookings',
                data: <?php echo json_encode($bookings_per_month); ?>,
                borderColor: 'rgb(75, 192, 192)',
                fill: false,
            }, {
                label: 'Revenue',
                data: <?php echo json_encode($revenue_per_month); ?>,
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
</script>
<script>
var ctxMonthlyRevenue = document.getElementById('monthlyRevenueChart').getContext('2d');
var monthlyRevenueChart = new Chart(ctxMonthlyRevenue, {
    type: 'bar',  
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],  // Các tháng trong năm
        datasets: [{
            label: 'Revenua per month in this year(USD)',  
            data: <?php echo json_encode($revenue_per_month); ?>,  
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
                        return value.toLocaleString();
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
</html>
