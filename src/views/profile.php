<?php 
include 'layout/navbar.php'; 
?>
<!DOCTYPE html>
<html lang="en">
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
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-6xl">

        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <div class="flex items-center space-x-6">
                <img src="https://www.alleganyco.gov/wp-content/uploads/unknown-person-icon-Image-from.png" alt="User Avatar" class="w-24 h-24 rounded-full shadow-lg">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800"><?php echo htmlentities($user['NAME']); ?></h1>
                    <p class="text-lg text-gray-600">Welcome back! Here's an overview of your profile.</p>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Personal Information</h2>
            <form action="index.php?page=updateProfile" method="POST" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-md" value="<?php echo htmlentities($user['NAME']); ?>" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-md" value="<?php echo htmlentities($user['EMAIL']); ?>" required>
                    </div>
                    <!-- <div>
                        <label for="phone" class="block text-gray-700 mb-2">Phone</label>
                        <input type="tel" name="phone" id="phone" class="w-full px-3 py-2 border rounded-md" value="<?php echo htmlentities($user['PHONE']); ?>">
                    </div> -->
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Booking History -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Booking History</h2>
            <?php if (!empty($bookings)): ?>
                <div class="space-y-4">
                    <?php foreach ($bookings as $booking): ?>
                        <div class="flex justify-between items-center py-3 border-b">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800"><?php echo htmlentities($booking['ROOM_NAME']); ?></h3>
                                <p class="text-gray-600">Date: <?php echo htmlentities($booking['CHECK_IN']); ?> - <?php echo htmlentities($booking['CHECK_OUT']); ?></p>
                            </div>
                            <span class="text-gray-600">$<?php echo htmlentities($booking['TOTAL_PRICE']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">No bookings found.</p>
            <?php endif; ?>
        </div>

        <!-- Reviews -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Your Reviews</h2>
            <?php if (!empty($reviews)): ?>
                <div class="space-y-4">
                    <?php foreach ($reviews as $review): ?>
                        <div class="bg-gray-100 p-4 rounded-md">
                            <h3 class="font-bold text-gray-800"><?php echo htmlentities($review['ROOM_NAME']); ?></h3>
                            <div class="flex items-center mb-2 text-yellow-500">
                                <?php for ($i = 0; $i < $review['RATING']; $i++): ?>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-600"><?php echo htmlentities($review['REVIEW_TEXT']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">No reviews found.</p>
            <?php endif; ?>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Change Password</h2>
            <a href="index.php?page=changePassword">
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                        change Password
                    </button>
            </a>
        </div>

        <!-- Logout -->
        <div class="text-center">
            <a href="index.php?page=logout" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition duration-300">
                Logout
            </a>
        </div>
    </div>
</body>
</html>
<?php
include __DIR__ . '/layout/footer.php'; 
?>