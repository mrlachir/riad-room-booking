<?php include 'C:/xampp/htdocs/riad-room-booking/src/views/layout/admin_navbar.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<!-- Homepage Headers Section -->
<div class="homepage-headers mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Homepage Headers</h2>
        <a href="index.php?page=addAdminHeader" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            Add New Header
        </a>
    </div>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Image</th>
                <th class="border border-gray-300 px-4 py-2">Overlay Text</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($headers as $header): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="<?php echo '/riad-room-booking' .htmlspecialchars($header['IMAGE']); ?>" 
                             alt="Header Image" 
                             class="w-40 h-20 object-cover rounded-lg">
                             
                    </td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($header['OVERLAY_TEXT']); ?></td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="index.php?page=deleteAdminHeader&id=<?php echo $header['HEADER_ID']; ?>"
                           onclick="return confirm('Are you sure you want to delete this header?');"
                           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Featured Rooms Section -->
<div class="featured-rooms mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Featured Rooms</h2>
        <a href="index.php?page=addAdminFeaturedRoom" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            Add Featured Room
        </a>
    </div>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Image</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($featuredRooms as $room): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="<?php echo '/riad-room-booking' .htmlspecialchars($room['IMAGE']); ?>" 
                             alt="Room Image" 
                             class="w-40 h-20 object-cover rounded-lg">
                    </td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['NAME']); ?></td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="index.php?page=deleteAdminFeaturedRoom&id=<?php echo $room['FEATURED_ROOM_ID']; ?>"
                           onclick="return confirm('Are you sure you want to remove this room from featured?');"
                           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Remove
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Featured Activities Section -->
<div class="featured-activities mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Featured Activities</h2>
        <a href="index.php?page=addAdminFeaturedActivity" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            Add Featured Activity
        </a>
    </div>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Image</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($featuredActivities as $activity): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="<?php echo '/riad-room-booking' .htmlspecialchars($activity['IMAGE']); ?>" 
                             alt="Activity Image" 
                             class="w-40 h-20 object-cover rounded-lg">
                    </td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($activity['NAME']); ?></td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="index.php?page=deleteAdminFeaturedActivity&id=<?php echo $activity['FEATURED_ACTIVITY_ID']; ?>"
                           onclick="return confirm('Are you sure you want to remove this activity from featured?');"
                           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Remove
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
