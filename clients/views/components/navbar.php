
<nav class= "h-full flex items-center justify-between ">
    <ul class="h-full w-[600px] flex justify-around items-center">
        <li class="text-body font-semibold">
            <a class="" href="<?= $route->getLocateClient() ?>">Home</a>
        </li>
        <li class="text-body font-semibold">
            <a class="" href="<?= $route->getLocateClient('room-list') ?>">Rooms</a>
        </li>
        <li class="text-body font-semibold">
            <a class="" href="<?= $route->getLocateClient('about') ?>">About</a>
        </li>
        <li class="text-body font-semibold">
            <a class="" href="<?= $route->getLocateClient('contact') ?>">Contact</a>
        </li>
        <li class="text-body font-semibold">
        <a class="block text-gray-700 hover:bg-blue-600 hover:text-white bg-blue-500 py-2 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105" href="<?= $route->getLocateClient('booking-list') ?>">
            Checkin Now
        </a>
        </li>


    </ul>
    <!-- <button class="bg-zinc-600 text-white text-[14px] h-[46px] rounded-3xl px-[45px] ml-7">
            Become A Host
    </button> -->
</nav>