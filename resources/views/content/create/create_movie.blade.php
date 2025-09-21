<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

        <!-- Back to Previous Page Link -->
        <div class="my-4">
            <a href="{{ route('content.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                &larr; Home
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">Add Movie</h1>
        <form action="{{ route('content.store.movie') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="content_id" class="block text-gray-700">Content ID</label>
                <input type="number" id="content_id" name="content_id" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg" onclick="alert('Movie added')">Add Movie</button>
            </div>
        </form>
        
    </div>
</body>
</html>
