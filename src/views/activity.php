<?php
include 'layout/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($activity['NAME']); ?> - Riad Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
        }

        .main-image {
            position: relative;
            height: 80vh;
            overflow: hidden;
            border-radius: 1rem;
        }

        .main-image img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .main-image:hover img {
            transform: scale(1.05);
        }

        .activity-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .price-tag {
            background: linear-gradient(135deg, #2c5282, #4299e1);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            display: inline-block;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <!-- Activity Header -->
        <div class="mb-16">
            <div class="space-y-8">
                <!-- Main Image -->
                <div class="main-image shadow-2xl">
                    <img src="<?php echo '/riad-room-booking/' . htmlentities($activity['IMAGE']); ?>" alt="Riad Hero Image">
                </div>

                <div class="max-w-3xl mx-auto text-center space-y-6">
                    <h1 class="section-title text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                        <?php echo htmlentities($activity['NAME']); ?>
                    </h1>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        <?php echo htmlentities($activity['DESCRIPTION']); ?>
                    </p>
                    <div class="price-tag text-lg font-semibold">
                        $<?php echo htmlentities($activity['PRICE']); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Activities -->
        <div>
            <h2 class="section-title text-3xl font-bold text-gray-800 mb-8 text-center">
                Discover More Adventures
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach ($recommendedActivities as $recommended): ?>
                    <a href="index.php?page=activity&id=<?php echo $recommended['ACTIVITY_ID']; ?>"
                        class="activity-card block bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="<?php echo '/riad-room-booking/' . htmlentities($recommended['IMAGE']); ?>"
                                class="w-full h-56 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-gray-800 mb-2">
                                <?php echo htmlentities($recommended['NAME']); ?>
                            </h3>
                            <div class="text-blue-600 font-semibold">
                                Learn More →
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include __DIR__ . '/layout/footer.php';
?>