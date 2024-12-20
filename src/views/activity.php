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
            background: none;
        }
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
        }
        .main-image img {
            height: 80vh;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Activity Header -->
        <div class="mb-12">
            <div class="mb-6">
                <!-- Main Image -->
                <div class="main-image">
                    <img src="<?php echo htmlentities($activity['IMAGE']); ?>" alt="<?php echo htmlentities($activity['NAME']); ?>" class="object-cover rounded-lg shadow-lg mb-4">
                </div>
                <h1 class="section-title text-3xl font-bold text-gray-800"><?php echo htmlentities($activity['NAME']); ?></h1>
                <p class="text-gray-600 leading-relaxed"><?php echo htmlentities($activity['DESCRIPTION']); ?></p>
                <p class="text-lg text-gray-800 font-bold">Price: $<?php echo htmlentities($activity['PRICE']); ?></p>
            </div>
        </div>

        <!-- Recommended Activities -->
        <div>
            <h2 class="section-title text-2xl font-bold text-gray-800 mb-6">Recommended Activities</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <?php foreach ($recommendedActivities as $recommended): ?>
                    <a href="index.php?page=activity&id=<?php echo $recommended['ACTIVITY_ID']; ?>">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="<?php echo htmlentities($recommended['IMAGE']); ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-gray-800 mb-2"><?php echo htmlentities($recommended['NAME']); ?></h3>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

