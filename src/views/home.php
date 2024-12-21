<?php
// Ensure that header data is available
$headerImage = isset($headerData['header_image']) ? $headerData['header_image'] : 'default-header.jpg';
$overlayText = isset($headerData['overlay_text']) ? $headerData['overlay_text'] : 'Welcome to Our Website!';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/path/to/your/styles.css">
</head>
<body>

    <!-- Header Section -->
    <section class="header" style="background-image: url('<?php echo htmlspecialchars($headerImage); ?>');">
        <div class="overlay">
            <h1><?php echo htmlspecialchars($overlayText); ?></h1>
        </div>
    </section>

    <!-- Featured Activities -->
    <section class="featured-activities">
        <h2>Featured Activities</h2>
        <div class="activity-list">
            <?php if (!empty($featuredActivities)): ?>
                <?php foreach ($featuredActivities as $activity): ?>
                    <div class="activity-item">
                        <img src="<?php echo htmlspecialchars($activity['image']); ?>" alt="<?php echo htmlspecialchars($activity['name']); ?>">
                        <h3><?php echo htmlspecialchars($activity['name']); ?></h3>
                        <a href="/index.php?page=activity&id=<?php echo $activity['activity_id']; ?>">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No featured activities available.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Featured Rooms -->
    <section class="featured-rooms">
        <h2>Featured Rooms</h2>
        <div class="room-list">
            <?php if (!empty($featuredRooms)): ?>
                <?php foreach ($featuredRooms as $room): ?>
                    <div class="room-item">
                        <img src="<?php echo htmlspecialchars($room['image']); ?>" alt="<?php echo htmlspecialchars($room['name']); ?>">
                        <h3><?php echo htmlspecialchars($room['name']); ?></h3>
                        <a href="/index.php?page=room&id=<?php echo $room['room_id']; ?>">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No featured rooms available.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Featured Reviews -->
    <section class="featured-reviews">
        <h2>Featured Reviews</h2>
        <div class="review-list">
            <?php if (!empty($featuredReviews)): ?>
                <?php foreach ($featuredReviews as $review): ?>
                    <div class="review-item">
                        <p><?php echo htmlspecialchars($review['review_text']); ?></p>
                        <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?></p>
                        <p><strong>By:</strong> <?php echo htmlspecialchars($review['username']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No featured reviews available.</p>
            <?php endif; ?>
        </div>
    </section>

</body>
</html>
