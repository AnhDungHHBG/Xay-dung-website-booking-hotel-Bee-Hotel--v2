<?php 
$users = $data['users'];
$bookings = $data['bookings'];
$rooms = $data['rooms'];

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
            <h2 class="text-xl font-semibold">Revenue</h2>
            <p class="text-2xl">${{ number_format($revenueStats, 2) }}</p>
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
                data: [5, 10, 15, 20, 25, 30], 
                borderColor: 'rgb(75, 192, 192)',
                fill: false,
            }, {
                label: 'Revenue',
                data: [1000, 2000, 2500, 3000, 4000, 5000], 
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

</body>
</html>
