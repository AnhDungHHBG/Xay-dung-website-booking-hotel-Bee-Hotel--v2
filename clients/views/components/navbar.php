
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

    </ul>
    <!-- <button class="bg-zinc-600 text-white text-[14px] h-[46px] rounded-3xl px-[45px] ml-7">
            Become A Host
    </button> -->
</nav>