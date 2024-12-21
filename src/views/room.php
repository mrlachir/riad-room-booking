<?php
// include 'layout/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($room['NAME']); ?> - Riad Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        a {
            text-decoration: none;
            color: inherit;
            background: none;
        }

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
        <!-- Room Header -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Image Gallery -->
            <div class="space-y-6 max-w-4xl mx-auto">
                <div class="main-image">
                    <img id="mainImage" src="<?php echo htmlentities($room['IMAGE']); ?>" alt="<?php echo htmlentities($room['NAME']); ?>" class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
                <!-- Additional Images Section -->
                <!-- <div class="additional-images grid grid-cols-3 gap-6">
                    <?php foreach ($room['additional_images'] as $image): ?>
                        <div class="image-item">
                            <img src="<?php echo htmlentities($image); ?>" alt="Room Additional Image" class="w-full h-32 object-cover rounded-lg shadow-lg cursor-pointer" onclick="changeMainImage(this)">
                        </div>
                    <?php endforeach; ?>
                </div> -->
            </div>

            <script>
                function changeMainImage(thumbnail) {
                    document.getElementById("mainImage").src = thumbnail.src;
                }
            </script>

            <!-- Room Information -->
            <div>
                <h1 class="section-title text-3xl font-bold text-gray-800 mb-4"><?php echo htmlentities($room['NAME']); ?></h1>
                <p class="text-gray-600 mb-4"><?php echo htmlentities($room['DESCRIPTION']); ?></p>

                <div class="flex items-center space-x-4 mb-4">
                    <span class="text-2xl font-bold text-green-600">$<?php echo htmlentities($room['PRICE']); ?></span>
                    <span class="text-gray-500">Per Night</span>
                </div>

                <form action="index.php?page=bookRoom" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                    <input type="hidden" name="room_id" value="<?php echo htmlentities($room['ROOM_ID']); ?>">

                    <?php if (isset($errorMessage)): ?>
                        <div class="text-red-500 text-sm mb-4">
                            <?php echo htmlentities($errorMessage); ?>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Check-in</label>
                            <input type="date" name="check_in" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Check-out</label>
                            <input type="date" name="check_out" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-4 bg-yellow-500 text-white py-3 rounded-md hover:bg-yellow-600 transition duration-300">
                        Book Now
                    </button>
                </form>


            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Features</h2>
            <ul class="list-disc pl-6">
                <?php foreach ($room['features'] as $feature): ?>
                    <li class="text-gray-600"><?php echo htmlentities($feature); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Reviews Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Reviews</h2>
            <?php if (!empty($reviews)): ?>
                <div class="space-y-4">
                    
                    <?php foreach ($reviews as $review): ?>
                        <div class="p-4 bg-gray-100 rounded-md">
                            <h4 class="font-bold text-gray-800">
                            <?php echo htmlentities($review['USER_NAME'] ?? 'Anonymous'); ?>

                            </h4>
                            <div class="flex items-center text-yellow-500">
                                <?php for ($i = 0; $i < ($review['RATING'] ?? 0); $i++): ?>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-600"><?php echo htmlentities($review['REVIEW_TEXT'] ?? 'No review text.'); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">No reviews yet. Be the first to leave a review!</p>
            <?php endif; ?>

            <!-- Write a Review Form -->
            <div class="mt-6">
                <form action="index.php?page=addReview" method="POST">
                    <input type="hidden" name="room_id" value="<?php echo htmlentities($room['ROOM_ID']); ?>">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Rating</label>
                            <select name="rating" class="w-full px-3 py-2 border rounded-md">
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Good</option>
                                <option value="3">3 - Average</option>
                                <option value="2">2 - Poor</option>
                                <option value="1">1 - Terrible</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Your Review</label>
                            <textarea name="review_text" rows="4" class="w-full px-3 py-2 border rounded-md" placeholder="Write your review here..." required></textarea>
                        </div>
                        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recommended Rooms -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-12">
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-4">Recommended Rooms</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <?php foreach ($recommendedRooms as $recommendedRoom): ?>
                    <a href="index.php?page=room&id=<?php echo htmlentities($recommendedRoom['ROOM_ID']); ?>" class="block">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="<?php echo htmlentities($recommendedRoom['IMAGE']); ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-gray-800 mb-2"><?php echo htmlentities($recommendedRoom['NAME']); ?></h3>
                                <p class="text-gray-600">$<?php echo htmlentities($recommendedRoom['PRICE']); ?> Per Night</p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>


</html>