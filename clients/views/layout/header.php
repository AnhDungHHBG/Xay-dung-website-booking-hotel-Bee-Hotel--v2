<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>


<body class="bg-gray-100">
    <div class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <span class="text-3xl font-bold text-gray-800">Hotel Luxury</span>
            <!-- Navbar -->
            <?php $viewApp->requestComponents('components.navbar');
            ?>
<<<<<<< HEAD
            <div class="relative mr-6">
                    <a href="<?= $route->getLocateClient('notification-list') ?>" class="text-gray-700 hover:text-blue-500">
                        <i class="fa-solid fa-bell fa-lg"></i>
                        <?php $unreadCount = 5;?>
                        <?php if ($unreadCount > 0): ?>
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-1"><?= $unreadCount ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <!-- User Section -->
            
                            <?php
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    ?>
                    <div class="relative">
                        <div class="flex items-center gap-4">
                            <div class="userMenu" onclick="toggleUserMenu()"><i class="fa-regular fa-user"></i></div>
                        </div>
                        <!-- User Dropdown -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <?php if ($user['role'] === 'Admin'): ?>
                            <a href="http://localhost/duan1/Xay-dung-website-booking-hotel-Bee-Hotel--v2/?mode=admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Admin Panel</a>
                        <?php endif; ?>
                            <a href="<?= $route->getLocateClient('signup') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Sign Up</a>
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= $route->getLocateClient('profile') ?>">Profile</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Help Center</a>
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= $route->getLocateClient('logout') ?> ">Logout</a>
                        </div>
=======
               <div class="flex gap-5">
                <div class="relative mr-6">
                        <a href="<?= $route->getLocateClient('notification-list') ?>" class="text-gray-700 hover:text-blue-500">
                            <i class="fa-solid fa-bell fa-lg"></i>
                            <?php $unreadCount = 5;?>
                            <?php if ($unreadCount > 0): ?>
                                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-1"><?= $unreadCount ?></span>
                            <?php endif; ?>
                        </a>
>>>>>>> b42d5d34552c71640c2b905c120f0b230e3d414c
                    </div>
                <!-- User Section -->
                
                                <?php
                    if (isset($_SESSION['user'])) {
                        ?>
                        <div class="relative">
                            <div class="flex items-center gap-4">
                                <div class="userMenu" onclick="toggleUserMenu()"><i class="fa-regular fa-user"></i></div>
                            </div>
                            <!-- User Dropdown -->
                            <div id="userMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                <a href="<?= $route->getLocateClient('signup') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Sign Up</a>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= $route->getLocateClient('profile') ?>">Profile</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Help Center</a>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= $route->getLocateClient('logout') ?> ">Logout</a>

                            </div>
                        </div>
                        <?php
                        
                    } else {
                        ?>
                        <div class="relative">
                            <div class="flex items-center gap-4">
                                <button class="userMenu" onclick="toggleUserMenu()"><i class="fa-solid fa-bars"></i></button>
                                <div class="userMenu" onclick="toggleUserMenu()"><i class="fa-regular fa-user"></i></div>
                            </div>
                            <!-- User Dropdown -->
                            <div id="userMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                <a href="<?= $route->getLocateClient('signup') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Sign Up</a>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= $route->getLocateClient('login') ?>">Login</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Help Center</a>
                            </div>
                        <?php
                    }
                    ?>
               </div>
        </div>
    </div>
            </div>
        </div>
    </div>

    <script>
        function toggleUserMenu() {
            const menu = document.getElementById("userMenu");
            menu.classList.toggle("hidden");
        }

        window.onclick = function (event) {
            const menu = document.getElementById("userMenu");
            if (!event.target.closest('.relative')) {
                menu.classList.add("hidden");
            }
        };
    </script>
</body>

</html>
