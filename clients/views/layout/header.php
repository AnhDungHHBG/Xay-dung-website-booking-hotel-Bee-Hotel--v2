<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="./public/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- swiper làm carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="./public/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="bg-white">
        <div class ="bg-[#F5F5F5]">
        <div class=" flex h-[75px]  justify-between  items-center container mx-auto">
                <span class="text-3xl font-extrabold">Logo</span>
                <?php $viewApp->requestComponents('components.navbar'); ?>
                <div class="w-[100px] h-[48px] rounded-3xl bg-white flex items-center justify-center">
                    <i class="fa-solid fa-bars"></i>
                    <img src="" alt="User">
                </div>
    </div>
        </div>