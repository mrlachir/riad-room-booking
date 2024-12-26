<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Room Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include 'C:/xampp/htdocs/riad-room-booking/src/views/layout/admin_navbar.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
            <p class="text-gray-600">Welcome to your admin control panel</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Rooms Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 mr-4">
                        <i class="fas fa-door-open text-blue-500 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Total Rooms</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $statistics['numRooms']; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Bookings Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 mr-4">
                        <i class="fas fa-calendar-check text-green-500 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Total Bookings</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $statistics['numBookings']; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Users Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 mr-4">
                        <i class="fas fa-users text-purple-500 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Total Users</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $statistics['numUsers']; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reviews Section -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Reviews</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review Text</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($recentReviews as $review): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="text-sm text-gray-900">
                                    <?php echo isset($review['REVIEW_TEXT']) ? htmlspecialchars($review['REVIEW_TEXT']) : 'No review text'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <?php 
                                    $rating = isset($review['RATING']) ? $review['RATING'] : 0;
                                    for($i = 0; $i < 5; $i++) {
                                        if($i < $rating) {
                                            echo '<i class="fas fa-star text-yellow-400"></i>';
                                        } else {
                                            echo '<i class="far fa-star text-gray-300"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Bookings Section -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Bookings</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booked By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($recentBookings as $booking): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <?php echo isset($booking['ROOM_ID']) ? $booking['ROOM_ID'] : 'Unknown'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <?php echo isset($booking['CHECK_IN']) ? $booking['CHECK_IN'] : 'No check-in date'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <?php echo isset($booking['CHECK_OUT']) ? $booking['CHECK_OUT'] : 'No check-out date'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <?php echo isset($booking['USER_NAME']) ? htmlspecialchars($booking['USER_NAME']) : 'Unknown User'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo isset($booking['TOTAL_PRICE']) ? '$' . number_format($booking['TOTAL_PRICE'], 2) : 'N/A'; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript for interactivity -->
    <script>
        // Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // You can add interactive features here
        });
    </script>
</body>
</html>