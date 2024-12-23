<?php include 'C:/xampp/htdocs/riad-room-booking/src/views/layout/admin_navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Header</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Add New Header</h1>
        
        <form action="index.php?page=storeAdminHeader" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-4">
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Header Image:</label>
                <input type="file" 
                       id="image" 
                       name="image" 
                       accept="image/*" 
                       required
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100">
            </div>

            <div>
                <label for="overlay_text" class="block text-sm font-medium text-gray-700">Overlay Text:</label>
                <input type="text" 
                       id="overlay_text" 
                       name="overlay_text" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="pt-5">
                <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Add Header
                </button>
            </div>
        </form>
    </div>
</body>
</html>
