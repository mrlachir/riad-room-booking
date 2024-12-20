<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>

<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="index.php" class="text-2xl font-bold text-gray-800">Riad Booking</a>

        <!-- Navigation Links -->
        <div class="space-x-6">
            <a href="index.php?page=rooms" class="text-gray-600 hover:text-gray-800">Rooms</a>
            <a href="index.php?page=activities" class="text-gray-600 hover:text-gray-800">Activities</a>

            <?php if ($isLoggedIn): ?>
                <a href="index.php?page=profile" class="text-gray-600 hover:text-gray-800">Profile</a>
                <a href="index.php?page=logout" class="text-red-600 hover:text-red-800">Logout</a>
            <?php else: ?>
                <a href="index.php?page=login" class="text-gray-600 hover:text-gray-800">Login</a>
                <a href="index.php?page=register" class="text-gray-600 hover:text-gray-800">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
