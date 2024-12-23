<?php include 'C:/xampp/htdocs/riad-room-booking/src/views/layout/admin_navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
        <h1>Dashboard Overview</h1>
        <div class="statistics">
            <h2>Statistics</h2>
            <p>Total Rooms: <?php echo $statistics['numRooms']; ?></p>
            <p>Total Bookings: <?php echo $statistics['numBookings']; ?></p>
            <p>Total Users: <?php echo $statistics['numUsers']; ?></p>
        </div>
        <div class="recent-reviews">
    <h2>Recent Reviews</h2>
    <table>
        <thead>
            <tr>
                <th>Review Text</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentReviews as $review): ?>
                <tr>
                    <td><?php echo isset($review['REVIEW_TEXT']) ? htmlspecialchars($review['REVIEW_TEXT']) : 'No review text'; ?></td>
                    <td><?php echo isset($review['RATING']) ? $review['RATING'] : 'No rating'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="recent-bookings">
    <h2>Recent Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Booked By</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentBookings as $booking): ?>
                <tr>
                    <td><?php echo isset($booking['ROOM_ID']) ? $booking['ROOM_ID'] : 'Unknown'; ?></td>
                    <td><?php echo isset($booking['CHECK_IN']) ? $booking['CHECK_IN'] : 'No check-in date'; ?></td>
                    <td><?php echo isset($booking['CHECK_OUT']) ? $booking['CHECK_OUT'] : 'No check-out date'; ?></td>
                    <td><?php echo isset($booking['USER_NAME']) ? htmlspecialchars($booking['USER_NAME']) : 'Unknown User'; ?></td>
                    <td><?php echo isset($booking['TOTAL_PRICE']) ? '$' . number_format($booking['TOTAL_PRICE'], 2) : 'N/A'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




    </div>
</body>
</html>
