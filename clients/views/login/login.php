
<div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Đăng nhập</h1>
        <form action="process_login.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                    placeholder="Nhập email" 
                    required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Mật khẩu</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                    placeholder="Nhập mật khẩu" 
                    required>
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Đăng nhập
            </button>
        </form>
        <div class="mt-4 text-sm text-center text-gray-600">
            <a href="#" class="text-blue-500 hover:underline">Quên mật khẩu?</a>
            <span class="mx-2">|</span>
            <a href="#" class="text-blue-500 hover:underline">Đăng ký tài khoản</a>
        </div>
    </div>
</div>
<?php
session_start();
require 'database_connection.php'; // File kết nối cơ sở dữ liệu

// Lấy dữ liệu từ form
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    echo "Vui lòng nhập đầy đủ thông tin!";
    exit();
}

// Kiểm tra người dùng trong database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Kiểm tra mật khẩu
    if (password_verify($password, $user['password'])) {
        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        echo "Đăng nhập thành công!";
        // Chuyển hướng đến trang chính (dashboard)
        header("Location: /");
        exit();
    } else {
        echo "Mật khẩu không chính xác!";
    }
} else {
    echo "Email không tồn tại!";
}
?>

