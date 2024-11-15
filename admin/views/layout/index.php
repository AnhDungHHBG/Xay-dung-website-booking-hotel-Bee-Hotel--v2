<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../../public/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- Thêm vào phần <head> của file layout -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f4f3;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #fff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .rotate-90 {
            transform: rotate(90deg);
        }
    </style>
</head>

<body>
    <div class="layout">
        <div class="sidebar">
            <?php $viewApp->requestComponents('components.sidebar'); ?>
        </div>
        <div class="main-content">
            <div class="navbar">
                <?php $viewApp->requestComponents('components.navbar'); ?>
            </div>
            <div class="content">
                <?php include($viewPath); ?>
            </div>
        </div>
    </div>
</body>

</html>