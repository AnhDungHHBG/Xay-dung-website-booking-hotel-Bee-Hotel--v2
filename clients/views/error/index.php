<?php
$message = $data ? $data : 'Some error';
?>

<div class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <div class="text-center">
            <p class="text-red-500 text-xl font-semibold mb-4"><?= htmlspecialchars($message) ?></p>
            <a href="<?= $route->getLocateClient('') ?>" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition duration-200">Back to home</a>
        </div>
    </div>

</div>