<div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-center">
        <h1 class="text-3xl font-bold ">Trang Tổng Quan</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold">Tổng số phòng</h2>
            <p class="text-2xl">120</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold">Số đặt phòng hôm nay</h2>
            <p class="text-2xl">15</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold">Doanh thu hôm nay</h2>
            <p class="text-2xl">$1,200</p>
        </div>
    </div>

    <!-- Biểu đồ thống kê đặt phòng theo tháng -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold">Thống kê đặt phòng theo tháng</h2>
        <canvas id="bookingChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'], // Nhãn cho các tháng
            datasets: [{
                label: 'Số lượng đặt phòng',
                data: [12, 19, 3, 5, 2, 3], // Dữ liệu mẫu, bạn có thể thay thế bằng dữ liệu thực tế từ cơ sở dữ liệu
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
