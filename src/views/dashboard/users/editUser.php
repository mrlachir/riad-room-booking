
<!-- src/views/dashboard/users/editUser.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Role</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Edit User Role</h1>
        
        <form action="index.php?page=updateAdminUser&id=<?php echo htmlspecialchars($user['USER_ID']); ?>" 
              method="POST" 
              class="space-y-4">
            
            <div class="mb-4">
                <p class="text-sm text-gray-600">User: <?php echo htmlspecialchars($user['NAME']); ?></p>
                <p class="text-sm text-gray-600">Email: <?php echo htmlspecialchars($user['EMAIL']); ?></p>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                <select id="role" 
                        name="role" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="Customer" <?php echo $user['ROLE'] === 'Customer' ? 'selected' : ''; ?>>Customer</option>
                    <option value="Admin" <?php echo $user['ROLE'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>

            <div class="pt-5">
                <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update Role
                </button>
            </div>
        </form>
    </div>
</body>
</html>