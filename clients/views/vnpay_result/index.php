<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_HashSecret = "EY3MOUTLJ8RBH3LJV0ZKJRP7096OP4TF"; // Secret key (same as on the server side)
        $inputData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);

        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $errorMessage = "";
        $transactionStatus = "";

        if ($secureHash == $vnp_SecureHash) {
            if (isset($_GET['vnp_ResponseCode']) == '00') {
                $transactionStatus = "GD Thanh cong";
            } else {
                $transactionStatus = "GD Khong thanh cong";
                $errorMessage = "Có lỗi trong quá trình thanh toán. Vui lòng thử lại!";
            }
        } else {
            $transactionStatus = "Chu ky khong hop le";
            $errorMessage = "Lỗi xác thực bảo mật. Vui lòng kiểm tra lại!";
        }
    ?>

    <!-- Begin display -->
    <div class="container mx-auto px-4 py-6">

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-center text-gray-800">VNPAY RESPONSE</h3>

            <?php if ($errorMessage): ?>
            <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded-lg mt-4">
                <strong>Error:</strong> <?php echo $errorMessage; ?>
            </div>
            <?php endif; ?>

            <div class="mt-6 space-y-4">
                <div class="flex justify-between">
                    <label class="font-medium">Mã đơn hàng:</label>
                    <span><?php echo $_GET['vnp_TxnRef'] ?></span>
                </div>
                <div class="flex justify-between">
                    <label class="font-medium">Số tiền:</label>
                    <span><?php echo $_GET['vnp_Amount'] ?></span>
                </div>
                <div class="flex justify-between">
                    <label class="font-medium">Nội dung thanh toán:</label>
                    <span><?php echo $_GET['vnp_OrderInfo'] ?></span>
                </div>

                <div class="flex justify-between">
                    <label class="font-medium">Mã GD tại VNPAY:</label>
                    <span><?php echo $_GET['vnp_TransactionNo'] ?></span>
                </div>
                <div class="flex justify-between">
                    <label class="font-medium">Mã Ngân hàng:</label>
                    <span><?php echo $_GET['vnp_BankCode'] ?></span>
                </div>
                <div class="flex justify-between">
                    <label class="font-medium">Thời gian thanh toán:</label>
                    <span><?php echo $_GET['vnp_PayDate'] ?></span>
                </div>
                <div class="flex justify-between">
                    <label class="font-medium">Kết quả:</label>
                    <span
                        class="<?php echo ($transactionStatus == 'GD Thanh cong') ? 'text-blue-500' : 'text-red-500'; ?>">
                        <?php echo $transactionStatus; ?>
                    </span>
                </div>
            </div>

            <!-- Back button -->
            <div class="mt-6 text-center">
                <a href="javascript:window.history.go(-2)"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Quay lại</a>
            </div>
        </div>

        <footer class="text-center mt-6 text-gray-500">
            <p>&copy; VNPAY <?php echo date('Y')?></p>
        </footer>
    </div>

</body>

</html>