<?php include __DIR__ . '/layout/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riad Room Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            background-color: #f9f5f0;
            color: #4a4a4a;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* Hero Section */
        .riad-info {
            position: relative;
            height: 100vh;
        }

        .riad-image img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            width: 90%;
            max-width: 800px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }

        .overlay h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-home {
            font-size: 1.1rem;
            padding: 15px 35px;
            border-radius: 30px;
            background-color: rgb(226, 182, 51);
            color: black;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-home:hover {
            background-color: rgb(200, 150, 40);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        section {
            padding: 80px 20px;
            margin: 0;
            text-align: center;
        }

        .section-title {
            margin-bottom: 50px;
            font-size: 2.5rem;
            color: #2d2d2d;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: rgb(226, 182, 51);
        }

        /* Enhanced Featured Grid */
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .featured-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            position: relative;
        }

        .featured-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .featured-image {
            height: 300px;
            position: relative;
            overflow: hidden;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .featured-item:hover .featured-image img {
            transform: scale(1.1);
        }

        .featured-content {
            padding: 25px;
        }

        .featured-title {
            font-size: 1.5rem;
            color: #2d2d2d;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .featured-description {
            color: #666;
            margin-bottom: 20px;
            font-size: 1rem;
            line-height: 1.6;
        }

        .featured-price {
            font-size: 1.75rem;
            font-weight: 700;
            color: rgb(226, 182, 51);
            margin-bottom: 20px;
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 5px;
        }

        .featured-price span {
            font-size: 1rem;
            color: #888;
            font-weight: normal;
        }

        .featured-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background-color: #f8f8f8;
            border-top: 1px solid #eee;
        }

        /* Enhanced Reviews Section */
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .review-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: transform 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-5px);
        }

        .stars {
            color: #ffd700;
            font-size: 1.3rem;
            margin-bottom: 20px;
        }

        .review-text {
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .review-author {
            font-weight: 600;
            color: #2d2d2d;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .review-date {
            color: #888;
            font-size: 0.9rem;
        }

        @media (max-width: 1200px) {
            .featured-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .featured-grid {
                grid-template-columns: 1fr;
            }

            .overlay h2 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .featured-image {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="riad-image">
        <section class="riad-info">
            <img src="/riad-room-booking/public/images/rooms/marrakech-nira.jpg" alt="Riad Hero Image">
            <div class="overlay">
                <h2>A peaceful escape in the heart of Marrakech</h2>
                <a href="/riad-room-booking/public/index.php?page=rooms" class="btn-home">Explore Our Rooms</a>
            </div>
        </section>

        <section class="featured-rooms">
            <h2 class="section-title">Featured Rooms</h2>
            <div class="featured-grid">
                <?php 
                $featuredRoomsCount = 0;
                foreach ($featuredRooms as $room): 
                    if ($featuredRoomsCount >= 3) break;
                ?>
                    <div class="featured-item">
                        <div class="featured-image">
                            <img src="<?php echo '/riad-room-booking' . htmlspecialchars(($room['IMAGE'] ?? '/images/default-room.jpg')); ?>" 
                                 alt="<?php echo htmlspecialchars($room['NAME'] ?? 'Room'); ?>">
                        </div>
                        <div class="featured-content">
                            <h3 class="featured-title"><?php echo htmlspecialchars($room['NAME'] ?? 'Room'); ?></h3>
                            <p class="featured-description"><?php echo htmlspecialchars($room['DESCRIPTION'] ?? 'No description available.'); ?></p>
                            <div class="featured-price">
                                $<?php echo htmlspecialchars(number_format($room['PRICE'] ?? 0, 2)); ?> 
                                <span>per night</span>
                            </div>
                            <div class="featured-footer">
                                <span><?php echo htmlspecialchars($room['ROOM_TYPE'] ?? 'Standard'); ?></span>
                                <a href="/riad-room-booking/public/index.php?page=room&id=<?php echo $room['ROOM_ID']; ?>" 
                                   class="btn-home">Book Now</a>
                            </div>
                        </div>
                    </div>
                <?php 
                    $featuredRoomsCount++;
                endforeach; 
                ?>
            </div>
        </section>

        <section class="featured-activities">
            <h2 class="section-title">Featured Activities</h2>
            <div class="featured-grid">
                <?php foreach ($featuredActivities as $activity): ?>
                    <div class="featured-item">
                        <div class="featured-image">
                            <img src="<?php echo '/riad-room-booking/'.htmlspecialchars(($activity['IMAGE'] ?? '/images/default-activity.jpg')); ?>" 
                                 alt="<?php echo htmlspecialchars($activity['NAME'] ?? 'Activity'); ?>">
                        </div>
                        <div class="featured-content">
                            <h3 class="featured-title"><?php echo htmlspecialchars($activity['NAME'] ?? 'Activity'); ?></h3>
                            <p class="featured-description"><?php echo htmlspecialchars($activity['DESCRIPTION'] ?? 'No description available.'); ?></p>
                            <div class="featured-price">$<?php echo htmlspecialchars(number_format($activity['PRICE'] ?? 0, 2)); ?></div>
                            <div class="featured-footer">
                                <a href="/riad-room-booking/public/index.php?page=activity&id=<?php echo $activity['ACTIVITY_ID']; ?>" 
                                   class="btn-home">Learn More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="featured-reviews">
            <h2 class="section-title">Recent Reviews</h2>
            <div class="reviews-grid">
                <?php foreach ($featuredReviews as $review): ?>
                    <div class="review-card">
                        <div class="stars">
                            <?php for ($i = 0; $i < (int)$review['RATING']; $i++): ?>&#9733;<?php endfor; ?>
                        </div>
                        <p class="review-text"><?php echo htmlspecialchars($review['REVIEW_TEXT'] ?? 'No review text available.'); ?></p>
                        <div class="review-author">
                            <?php echo htmlspecialchars($review['GUEST_NAME'] ?? 'Anonymous'); ?>
                        </div>
                        <div class="review-date">
                            <?php echo isset($review['REVIEW_DATE']) ? date('F j, Y', strtotime($review['REVIEW_DATE'])) : 'N/A'; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <?php include __DIR__ . '/layout/footer.php'; ?>
</body>
</html>