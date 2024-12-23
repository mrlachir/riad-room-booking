<?php
include __DIR__ . '/layout/navbar.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
/* General Styles */
/* General Reset */
* {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body and Font Settings */
    body {
        font-family: 'Montserrat', sans-serif;
        line-height: 1.6;
        background-color: #f9f5f0;
        color: #4a4a4a;
    }

    /* Riad Image & Info Section */
    .riad-info {
        position: relative;
    }

    .riad-image img {
        width: 100%;
        height: 100vh;
        object-fit: cover;
    }
    a {
  color: initial !important;
  text-decoration: initial !important;
}

    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
    }

    .overlay h2 {
        font-size: 3rem;
        font-weight: 700;
    }

    .btn-home {
        font-size: 1rem;
        padding: 12px 30px;
        border-radius: 30px;
        color: rgb(0, 0, 0);
        background-color: rgb(226, 182, 51);
        margin-top: 20px;
    }

/* Featured Rooms Section */
.featured-rooms {
    text-align: center;
    margin-bottom: 40px;
}

.featured-rooms h2 {
    margin-bottom: 20px;
    font-size: 28px;
}

.room-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.room-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.room-card img {
    width: 100%;
    border-radius: 5px;
}

.room-card h3 {
    margin: 10px 0;
}

.room-card .btn-home {
    margin-top: 10px;
}

/* Featured Activities Section */
.featured-activities {
    text-align: center;
    margin-bottom: 40px;
}

.activity-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.activity-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Featured Reviews Section */
.featured-reviews {
    text-align: center;
    margin-bottom: 40px;
}

.review-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.review-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.review-card .stars {
    color: #ffc107;
}

.discover-more-btn {
  display: inline-block; /* Makes the link behave like a block element */
  padding: 10px 20px; /* Add padding to make it look like a button */
  background-color: #ffc107; /* Button background color */
  color: white; /* Button text color */
  text-align: center; /* Center the text */
  text-decoration: none; /* Remove underline */
  border-radius: 5px; /* Rounded corners */
  font-size: 16px; /* Text size */
  transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}
</style>

<div class="container">
    <!-- Homepage Header Section -->
    <section class="homepage-header">
        <?php if ($homepageHeader): ?>
            <img src="<?php echo htmlspecialchars('/riad-room-booking' . $homepageHeader['IMAGE']); ?>" alt="Header Image">
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

<!-- Riad Image & Info Section -->
<section class="riad-info">
    <div class="riad-image">
        <img src="https://sf1.mariefranceasia.com/wp-content/uploads/sites/7/2018/03/marrakech-nira.jpg" alt="Riad Image">
        <div class="overlay">
            <h2>A peaceful escape in the heart of Marrakech</h2>
            <a href="{{ route('room.listings') }}" class="btn btn-home">Explore Our Rooms</a>

        </div>
    </div>
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
                        <td><img src="<?php echo '/riad-room-booking' . htmlspecialchars($room['IMAGE'] ?? 'default-room.jpg'); ?>" alt="<?php echo htmlspecialchars($room['name'] ?? 'Room'); ?>" style="width: 100px; height: auto;"></td>
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
                        <td><img src="<?php echo '/riad-room-booking' . htmlspecialchars($activity['IMAGE'] ?? 'default-activity.jpg'); ?>" alt="<?php echo htmlspecialchars($activity['name'] ?? 'Activity'); ?>" style="width: 100px; height: auto;"></td>
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
        <div class="review-cards">
            <?php foreach ($featuredReviews as $review): ?>
                <div class="review-card">
                    <div class="stars">
                        <?php for ($i = 0; $i < (int)$review['RATING']; $i++): ?>
                            ⭐
                        <?php endfor; ?>
                    </div>
                    <p><?php echo htmlspecialchars($review['REVIEW_TEXT'] ?? 'No review text available.'); ?></p>
                    <p><strong>Date:</strong> <?php echo isset($review['REVIEW_DATE']) ? date('F j, Y', strtotime($review['REVIEW_DATE'])) : 'N/A'; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php
include __DIR__ . '/layout/footer.php'; 
?>
