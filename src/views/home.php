<?php
// include __DIR__ . '/layout/header.php'; 
?>

<div class="container">

    <!-- Homepage Header Section -->
    <section class="homepage-header">
        <?php if ($homepageHeader): ?>
            <div class="header-image" style="background-image: url('<?php echo htmlspecialchars($homepageHeader['image'] ?? 'default-header.jpg'); ?>');">
                <div class="overlay">
                    <h1><?php echo htmlspecialchars($homepageHeader['overlay_text'] ?? 'Welcome to Riad Room Booking'); ?></h1>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <!-- <section class="featured-reviews">
        <h2>Featured Reviews</h2>
        <table class="reviews-table" border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Review Text</th>
                    <th>Rating</th>
                    <th>Review Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($featuredReviews as $review): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($review['user_name'] ?? 'Anonymous'); ?></td>
                        <td><?php echo htmlspecialchars($review['review_text'] ?? 'No review text available.'); ?></td>
                        <td><?php echo htmlspecialchars($review['rating'] ?? 'N/A'); ?>/5</td>
                        <td><?php echo isset($review['review_date']) ? date('F j, Y', strtotime($review['review_date'])) : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section> -->
    <section class="featured-reviews">
        <h2>Recent Reviews</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Review Text</th>
                    <th>Rating</th>
                    <th>Review Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($featuredReviews as $review): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($review['REVIEW_TEXT'] ?? 'No review text available.'); ?></td>
                        <td><?php echo htmlspecialchars($review['RATING'] ?? 'N/A'); ?>/5</td>
                        <td><?php echo isset($review['REVIEW_DATE']) ? date('F j, Y', strtotime($review['REVIEW_DATE'])) : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>






    <!-- Featured Activities Section -->
    <section class="featured-activities">
        <h2>Featured Activities</h2>
        <table class="activities-table" border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Activity Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($featuredActivities as $activity): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($activity['image'] ?? 'default-activity.jpg'); ?>" alt="<?php echo htmlspecialchars($activity['name'] ?? 'Activity'); ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($activity['name'] ?? 'Activity'); ?></td>
                        <td><?php echo htmlspecialchars($activity['description'] ?? 'No description available.'); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($activity['price'] ?? 0, 2)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Featured Rooms Section -->
    <section class="featured-rooms">
        <h2>Featured Rooms</h2>
        <table class="rooms-table" border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Room Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($featuredRooms as $room): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($room['image'] ?? 'default-room.jpg'); ?>" alt="<?php echo htmlspecialchars($room['name'] ?? 'Room'); ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($room['name'] ?? 'Room'); ?></td>
                        <td><?php echo htmlspecialchars($room['description'] ?? 'No description available.'); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($room['price'] ?? 0, 2)); ?></td>
                        <td><?php echo htmlspecialchars($room['room_type'] ?? 'Unknown'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</div>

<?php
// include __DIR__ . '/layout/footer.php'; 
?>