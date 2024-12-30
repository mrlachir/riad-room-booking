<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Riad Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
        }
    </style>
</head>
<?php
include 'layout/navbar.php';
?>
<!-- Change Password -->
<div class="max-w-lg mx-auto mt-8 p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Change Your Password</h2>

    <!-- Display Error Message -->
    <?php if (!empty($errorMessage)): ?>
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <strong>Error: </strong><?php echo htmlspecialchars($errorMessage); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=changePassword" method="POST">
        <div class="mb-4">
            <label for="current-password" class="block text-sm font-medium text-gray-600">Current Password</label>
            <input type="password" id="current-password" name="current_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
        </div>

        <div class="mb-4">
            <label for="new-password" class="block text-sm font-medium text-gray-600">New Password</label>
            <input type="password" id="new-password" name="new_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
        </div>

        <div class="mb-4">
            <label for="confirm-password" class="block text-sm font-medium text-gray-600">Confirm New Password</label>
            <input type="password" id="confirm-password" name="confirm_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
        </div>

        <div class="text-right">
            <button type="submit" class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-300">
                Change Password
            </button>
        </div>
    </form>
</div>
<?php
include __DIR__ . '/layout/footer.php';
?>