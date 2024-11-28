
<nav class= "h-full flex items-center justify-between ">
    <ul class="h-full w-[600px] flex justify-around items-center">
        <li class="text-body font-semibold text-[#133E87]">
            <a class="" href="<?= $route->getLocateClient() ?>">Home</a>
        </li>
        <li class="text-body font-semibold text-[#133E87]">
            <a class="" href="<?= $route->getLocateClient('room-list') ?>">Rooms</a>
        </li>
        <li class="text-body font-semibold text-[#133E87]">
            <a class="" href="<?= $route->getLocateClient('about') ?>">About</a>
        </li>
        <li class="text-body font-semibold text-[#133E87]">
            <a class="" href="<?= $route->getLocateClient('contact') ?>">Contact</a>
        </li>
        <li class="text-body font-semibold">
            <a class=" bg-[#133E87] text-[#CBDCEB] text-[14px] h-[46px] rounded-3xl px-[45px] ml-7 py-3"  href="<?= $route->getLocateClient('booking-list') ?>">Checkin Now</a>
        </li>
    </ul>
</nav>