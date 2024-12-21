
<?php 
include 'layout/navbar.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Your Booking is Confirmed!</h1>

        <h2>Booking Details</h2>
        <table>
            <tr>
                <th>Booking ID</th>
                <td><?php echo htmlspecialchars($booking['BOOKING_ID']); ?></td>
            </tr>
            <tr>
                <th>Room Name</th>
                <td><?php echo htmlspecialchars($booking['ROOM_NAME']); ?></td>
            </tr>
            <tr>
                <th>User Name</th>
                <td><?php echo htmlspecialchars($booking['USER_NAME']); ?></td>
            </tr>
            <tr>
                <th>Check-in Date</th>
                <td><?php echo htmlspecialchars($booking['CHECK_IN']); ?></td>
            </tr>
            <tr>
                <th>Check-out Date</th>
                <td><?php echo htmlspecialchars($booking['CHECK_OUT']); ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td><?php echo "$" . number_format($booking['TOTAL_PRICE'], 2); ?></td>
            </tr>
        </table>

        <a href="index.php">Go Back Home</a>
    </div>
</body>
</html>
