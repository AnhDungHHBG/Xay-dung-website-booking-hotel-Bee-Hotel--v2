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
            <span class="text-3xl font-bold text-gray-800">Logo</span>
            <!-- Navbar -->
            <?php $viewApp->requestComponents('components.navbar'); ?>
            <!-- User Section -->
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
