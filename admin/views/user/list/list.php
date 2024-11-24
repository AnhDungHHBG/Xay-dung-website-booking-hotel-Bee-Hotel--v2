    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-center">
            <h1 class="text-3xl font-bold ">Danh sách Users</h1>
        </div>
    </div>
    <br>
    <table class="table-auto border border-gray-400 border-separate border-spacing-0 w-full text-left">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 px-4 py-2">User-ID</th>
                <th class="border border-gray-400 px-4 py-2">Full name</th>
                <th class="border border-gray-400 px-4 py-2">Email</th>
                <th class="border border-gray-400 px-4 py-2">Phone</th>
                <th class="border border-gray-400 px-4 py-2">Password</th>
                <th class="border border-gray-400 px-4 py-2">Role</th>
                <th class="border border-gray-400 px-4 py-2">Delete</th>
                <th class="border border-gray-400 px-4 py-2">Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($user as $users) {
            ?>
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($users['user_id']) ?></td>
                <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($users['name']) ?></td>
                <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($users['email']) ?></td>
                <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($users['phone']) ?></td>
                <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($users['password']) ?></td>
                <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($users['role']) ?></td>
                <td class="border border-gray-400 px-4 py-2" >
                    <a class="text-red-600" href="<?= $route->getLocateAdmin('delete-user',['user_id'=>$users['user_id']]) ?>">Delete</a>
                </td>
                <td class="border border-gray-400 px-4 py-2" >
                    <a class="text-red-600" href="<?= $route->getLocateAdmin('update-user',['user_id'=>$users['user_id']]) ?>">Update</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
