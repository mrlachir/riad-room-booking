<?php
include 'layout/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riad Activities</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f5f0;
            color: #2c3e50;
            line-height: 1.6;
        }

        /* Header Styles */
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('path/to/your/header-image.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            text-align: center;
            color: #fff;
            margin-bottom: 50px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: #c8a45c;
            text-align: center;
            padding: 40px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Activities Grid */
        .activities {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .activities-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        /* Activity Card Styles */
        .activity-block {
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            position: relative;
        }

        .activity-block:hover {
            transform: translateY(-5px);
        }

        .activity-block img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid #c8a45c;
        }

        .activity-content {
            padding: 25px;
        }

        .activity-block h3 {
            font-family: 'Playfair Display', serif;
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .activity-block p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .price {
            color: #c8a45c;
            font-weight: 600;
            font-size: 1.2rem;
            margin: 15px 0;
        }

        .learn-more-btn {
            display: inline-block;
            background-color: #c8a45c;
            color: #fff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            font-weight: 500;
            margin-top: 15px;
        }

        .learn-more-btn:hover {
            background-color: #b08d3c;
        }

        /* No Activities Message */
        .no-activities {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .activities-list {
                grid-template-columns: 1fr;
                padding: 15px;
            }

            h1 {
                font-size: 2.5rem;
                padding: 20px 0;
            }

            .activity-block {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Discover Our Authentic Experiences</h1>
    </div>

    <div class="activities">
        <?php if (!empty($activities)): ?>
            <div class="activities-list">
                <?php foreach ($activities as $activity): ?>
                    <div class="activity-block">
                        <div class="activity-image">
                            <?php if (!empty($activity['IMAGE'])): ?>
                                <img src="<?php echo '/riad-room-booking/' . htmlspecialchars($activity['IMAGE'], ENT_QUOTES); ?>"
                                    alt="<?php echo htmlspecialchars($activity['NAME'], ENT_QUOTES); ?>">
                            <?php else: ?>
                                <img src="path/to/default-activity-image.jpg" alt="Default Activity Image">
                            <?php endif; ?>
                        </div>
                        <div class="activity-content">
                            <h3><?php echo htmlspecialchars($activity['NAME'], ENT_QUOTES); ?></h3>
                            <p><?php echo htmlspecialchars($activity['DESCRIPTION'], ENT_QUOTES); ?></p>
                            <p class="price">From $<?php echo number_format(floatval($activity['PRICE']), 2); ?></p>
                            <a href="index.php?page=activity&id=<?php echo htmlspecialchars($activity['ACTIVITY_ID'], ENT_QUOTES); ?>"
                                class="learn-more-btn">Learn More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-activities">
                <p>No activities are currently available. Please check back later.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/layout/footer.php'; ?>
</body>

</html>