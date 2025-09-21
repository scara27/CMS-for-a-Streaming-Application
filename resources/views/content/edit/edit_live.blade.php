<!DOCTYPE html>
<html>
<head>
    <title>Edit Live Content</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto px-4">
        <h1 class="my-4 text-2xl font-bold">Edit Live Content</h1>

        <form action="{{ route('content.update.live', $live->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="mb-4">
                <label for="content_id" class="block text-sm font-medium text-gray-700">Content ID</label>
                <input type="number" id="content_id" name="content_id" value="{{ $live->content_id }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="adult" class="block text-gray-700">Adult</label>
                <input type="checkbox" id="adult" name="adult" class="mt-1">
            </div>
            <div class="mb-4">
                <label for="kids" class="block text-gray-700">Kids</label>
                <input type="checkbox" id="kids" name="kids" class="mt-1">
            </div>
            <div class="mb-4">
                <label for="cathcup" class="block text-gray-700">Cathcup</label>
                <input type="checkbox" id="cathcup" name="cathcup" class="mt-1">
            </div>

            <div class="mb-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Update Live Content
                </button>
            </div>
        </form>

        <a href="{{ route('content.index.live') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 rounded-md">
            &larr; Back
        </a>
    </div>
</body>
</html>
