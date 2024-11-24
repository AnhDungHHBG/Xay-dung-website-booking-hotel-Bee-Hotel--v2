
<div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Tạo tài khoản</h1>
        <form method="POST" action="<?= $route->getLocateAdmin('post-create-user') ?>" enctype="multipart/form-data">
        <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Tên</label>
                <input 
                    type="text" 
                    name="name" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                    placeholder="Nhập tên" 
                    required>
            </div>
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
                <label for="phone" class="block text-sm font-medium text-gray-600 mb-2">Số điện thoại</label>
                <input 
                    type="number" 
                    id="phone" 
                    name="phone" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500" 
                    placeholder="Nhập số điện thoại" 
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
            <input type="text" name="role" hidden value="User">
            <button
                type="submit" 
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Submit
            </button>
        </form>
    </div>
</div>

