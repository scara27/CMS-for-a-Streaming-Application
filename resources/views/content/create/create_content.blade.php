<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

        <!-- Back to Previous Page Link -->
        <div class="my-4">
            <a href="{{ route('content.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                &larr; Back
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">Add Content</h1>
        <form action="{{ route('content.store.content') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="mb-4">
                <label for="content_type_id" class="block text-gray-700">Content Type ID</label>
                <input type="number" id="content_type_id" name="content_type_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="mb-4">
                <label for="content_status_id" class="block text-gray-700">Content Status ID</label>
                <input type="number" id="content_status_id" name="content_status_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <input type="hidden" id="icon" name="icon"> <!-- Hidden field for icon URL -->
            <div class="mb-4">
                <label for="imdb_id" class="block text-gray-700">IMDb ID</label>
                <input type="text" id="imdb_id" name="imdb_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg" onclick="alert('Content added')">Add Content</button>
            </div>
        </form>
    </div>

</body>
</html>
