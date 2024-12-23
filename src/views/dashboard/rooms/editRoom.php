<?php include 'C:/xampp/htdocs/riad-room-booking/src/views/layout/admin_navbar.php'; ?>
<!-- editRoom.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Room</h1>
        
        <form action="index.php?page=updateAdminRoom&id=<?php echo htmlspecialchars($room['ROOM_ID']); ?>" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-4">
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Room Name:</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="<?php echo htmlspecialchars($room['NAME']); ?>" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea id="description" 
                          name="description" 
                          required 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 h-32"
                ><?php echo htmlspecialchars($room['DESCRIPTION']); ?></textarea>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" 
                       id="price" 
                       name="price" 
                       value="<?php echo htmlspecialchars($room['PRICE']); ?>" 
                       required 
                       step="0.01" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="availability" class="block text-sm font-medium text-gray-700">Availability:</label>
                <select id="availability" 
                        name="availability" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="1" <?php echo $room['AVAILABILITY'] == 1 ? 'selected' : ''; ?>>Available</option>
                    <option value="0" <?php echo $room['AVAILABILITY'] == 0 ? 'selected' : ''; ?>>Not Available</option>
                </select>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                <input type="file" 
                       id="image" 
                       name="image" 
                       accept="image/*" 
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100">
                <?php if (!empty($room['IMAGE'])): ?>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Current image:</p>
                        <img src="<?php echo '/riad-room-booking' . htmlspecialchars($room['IMAGE']); ?>" 
                             alt="Current Room Image" 
                             class="mt-2 w-32 h-32 object-cover rounded-lg">
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label for="room_type" class="block text-sm font-medium text-gray-700">Room Type:</label>
                <input type="text" 
                       id="room_type" 
                       name="room_type" 
                       value="<?php echo htmlspecialchars($room['ROOM_TYPE']); ?>" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="pt-5">
                <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update Room
                </button>
            </div>
        </form>
    </div>
</body>
</html>

<script>
document.getElementById('image').onchange = function(e) {
    const preview = document.createElement('img');
    preview.className = 'mt-2 w-32 h-32 object-cover rounded-lg';
    preview.alt = 'Image Preview';
    
    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
    }
    
    // Clear previous preview
    const previewContainer = this.parentElement.querySelector('img');
    if (previewContainer) {
        previewContainer.replaceWith(preview);
    } else {
        this.parentElement.appendChild(preview);
    }
    
    reader.readAsDataURL(this.files[0]);
};
</script>