
<!-- src/views/dashboard/activities/addActivity.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Add New Activity</h1>
        
        <form action="index.php?page=adminstoreActivity" method="POST" 
              enctype="multipart/form-data" 
              class="space-y-4">
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Activity Name:</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea id="description" 
                          name="description" 
                          required 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 h-32"></textarea>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" 
                       id="price" 
                       name="price" 
                       required 
                       step="0.01" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
            </div>

            <div class="pt-5">
                <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Add Activity
                </button>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('image').onchange = function(e) {
        const preview = document.createElement('img');
        preview.className = 'mt-2 w-32 h-32 object-cover rounded-lg';
        preview.alt = 'Image Preview';
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        
        const previewContainer = this.parentElement.querySelector('img');
        if (previewContainer) {
            previewContainer.replaceWith(preview);
        } else {
            this.parentElement.appendChild(preview);
        }
        
        reader.readAsDataURL(this.files[0]);
    };
    </script>
</body>
</html>
