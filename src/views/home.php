<?php
include __DIR__ . '/layout/navbar.php'; 
?>

<!-- <pre>
<?php print_r($homepageHeader); ?>
<?php print_r($featuredActivities); ?>
<?php print_r($featuredRooms); ?>
</pre> -->


<div class="container">
    <!-- Homepage Header Section -->
    <section class="homepage-header">
        <?php if ($homepageHeader): ?>
            <img src="<?php echo htmlspecialchars('/riad-room-booking/public/' . $homepageHeader['IMAGE']); ?>" alt="Header Image">
            <div class="overlay">
                <h1><?php echo htmlspecialchars($homepageHeader['OVERLAY_TEXT'] ?? 'Welcome to Riad Room Booking'); ?></h1>
            </div>
            <a href="/riad-room-booking/public/index.php?page=rooms">
                <button>
                    Explore our rooms now
                </button>
            </a>
        <?php endif; ?>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($featuredRooms as $room): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($room['IMAGE'] ?? 'default-room.jpg'); ?>" alt="<?php echo htmlspecialchars($room['name'] ?? 'Room'); ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($room['NAME'] ?? 'Room'); ?></td>
                        <td><?php echo htmlspecialchars($room['DESCRIPTION'] ?? 'No description available.'); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($room['PRICE'] ?? 0, 2)); ?></td>
                        <td><?php echo htmlspecialchars($room['ROOM_TYPE'] ?? 'Unknown'); ?></td>
                        <td>
                            <a href="/riad-room-booking/public/index.php?page=room&id=<?php echo $room['ROOM_ID']; ?>">
                                <button>Book Now</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="text-align: center; margin-top: 20px;">
            <a href="/riad-room-booking/public/index.php?page=rooms">
                <button>Explore More Rooms</button>
            </a>
        </div>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($featuredActivities as $activity): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($activity['IMAGE'] ?? 'default-activity.jpg'); ?>" alt="<?php echo htmlspecialchars($activity['name'] ?? 'Activity'); ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo htmlspecialchars($activity['NAME'] ?? 'Activity'); ?></td>
                        <td><?php echo htmlspecialchars($activity['DESCRIPTION'] ?? 'No description available.'); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($activity['PRICE'] ?? 0, 2)); ?></td>
                        <td>
                            <a href="/riad-room-booking/public/index.php?page=activity&id=<?php echo $activity['ACTIVITY_ID']; ?>">
                                <button>Learn More</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="text-align: center; margin-top: 20px;">
            <a href="/riad-room-booking/public/index.php?page=activities">
                <button>Explore More Activities</button>
            </a>
        </div>
    </section>

    

    <!-- Featured Reviews Section -->
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
</div>

<?php
include __DIR__ . '/layout/footer.php'; 
?>
