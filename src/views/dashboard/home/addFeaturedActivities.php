<?php include 'C:/xampp/htdocs/riad-room-booking/src/views/layout/admin_navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Featured Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Add Featured Activity</h1>
        
        <form action="index.php?page=storeAdminFeaturedActivity" 
              method="POST" 
              class="space-y-4">
            
            <div>
                <label for="activity_id" class="block text-sm font-medium text-gray-700">Select Activity:</label>
                <select id="activity_id" 
                        name="activity_id" 
                        required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select an activity</option>
                    <?php foreach ($availableActivities as $activity): ?>
                        <option value="<?php echo $activity['ACTIVITY_ID']; ?>">
                            <?php echo htmlspecialchars($activity['NAME']); ?> - 
                            $<?php echo number_format($activity['PRICE'], 2); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="pt-5">
                <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Add to Featured
                </button>
            </div>
        </form>
    </div>
</body>
</html>