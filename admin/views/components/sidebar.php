<nav class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
        <h2 class="font-bold text-2xl">Amin <span class="bg-[#f84525] text-white px-2 rounded-md">Dashboard</span></h2>
    </a>
    <ul class="mt-5">
        <!-- Dashboard -->
        <li class="mb-1 group">
            <a href="<?= $route->getLocateAdmin('') ?>" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md">
                <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>

        <!-- Quản lý Phòng -->
        <li class="mb-1 group">
            <a href="#" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md" onclick="toggleSubmenu(event, 'roomManagement', this)">
                <i class="fas fa-bed mr-3 text-lg"></i>
                <span class="text-sm">Quản lý Phòng</span>
                <i class="fas fa-chevron-right ml-auto transition-transform"></i>
            </a>
            <ul id="roomManagement" class="pl-7 mt-2 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('room_types/list') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-list mr-2"></i> Danh Sách Loại Phòng
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('room_types/add') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-plus mr-2"></i> Thêm Loại Phòng
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('rooms/list') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-list mr-2"></i> Danh Sách Phòng
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('rooms/add') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-plus mr-2"></i> Thêm Phòng
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Quản lý Người Dùng -->
        <li class="mb-1 group">
            <a href="#" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md" onclick="toggleSubmenu(event, 'userManagement', this)">
                <i class="fas fa-users mr-3 text-lg"></i>
                <span class="text-sm">Quản lý Người Dùng</span>
                <i class="fas fa-chevron-right ml-auto transition-transform"></i>
            </a>
            <ul id="userManagement" class="pl-7 mt-2 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('users/list') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-list mr-2"></i> Danh Sách Người Dùng
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('users/add') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-user-plus mr-2"></i> Thêm Người Dùng
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Quản lý Đặt Phòng -->
        <li class="mb-1 group">
            <a href="#" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md" onclick="toggleSubmenu(event, 'bookingManagement', this)">
                <i class="fas fa-calendar-check mr-3 text-lg"></i>
                <span class="text-sm">Quản lý Đặt Phòng</span>
                <i class="fas fa-chevron-right ml-auto transition-transform"></i>
            </a>
            <ul id="bookingManagement" class="pl-7 mt-2 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('bookings/list') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-list mr-2"></i> Danh Sách Đặt Phòng
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('bookings/add') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-plus mr-2"></i> Thêm Đặt Phòng
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Quản lý Tiện Nghi -->
        <li class="mb-1 group">
            <a href="#" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md" onclick="toggleSubmenu(event, 'amenityManagement', this)">
                <i class="fas fa-concierge-bell mr-3 text-lg"></i>
                <span class="text-sm">Quản lý Tiện Nghi</span>
                <i class="fas fa-chevron-right ml-auto transition-transform"></i>
            </a>
            <ul id="amenityManagement" class="pl-7 mt-2 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('hotel_amenities/list') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-list mr-2"></i> Danh Sách Tiện Nghi
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('hotel_amenities/add') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-plus mr-2"></i> Thêm Tiện Nghi
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Quản lý Khuyến Mãi -->
        <li class="mb-1 group">
            <a href="#" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md" onclick="toggleSubmenu(event, 'promotionManagement', this)">
                <i class="fas fa-tags mr-3 text-lg"></i>
                <span class="text-sm">Quản lý Khuyến Mãi</span>
                <i class="fas fa-chevron-right ml-auto transition-transform"></i>
            </a>
            <ul id="promotionManagement" class="pl-7 mt-2 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('promotion-list') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-list mr-2"></i> Danh Sách Khuyến Mãi
                    </a>
                </li>
                <li class="mb-4">
                    <a href="<?= $route->getLocateAdmin('promotion-add') ?>" class="text-gray-900 text-sm flex items-center hover:text-[#f84525]">
                        <i class="fas fa-plus mr-2"></i> Thêm Khuyến Mãi
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>


<script>
    function toggleSubmenu(event, submenuId, element) {
        event.preventDefault();
        const submenu = document.getElementById(submenuId);
        if (submenu) {
            const isHidden = submenu.classList.contains('max-h-0');
            submenu.classList.toggle('max-h-0', !isHidden);
            submenu.classList.toggle('max-h-96', isHidden); 
            const icon = element.querySelector('.fa-chevron-right');
            if (icon) {
                icon.classList.toggle('rotate-90', isHidden);
            }
        }
    }
</script>