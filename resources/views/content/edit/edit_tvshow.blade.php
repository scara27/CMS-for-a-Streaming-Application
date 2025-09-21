<!DOCTYPE html>
<html>
<head>
    <title>Edit TV Show</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto px-4">
        <h1 class="my-4 text-2xl font-bold">Edit TV Show</h1>

        <form action="{{ route('content.update.tvshow', $tvShow->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ $tvShow->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="text" id="year" name="year" value="{{ $tvShow->year }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="director" class="block text-sm font-medium text-gray-700">Director</label>
                <input type="text" id="director" name="director" value="{{ $tvShow->director }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="season" class="block text-sm font-medium text-gray-700">Season</label>
                <input type="number" id="season" name="season" value="{{ $tvShow->season }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="episode" class="block text-sm font-medium text-gray-700">Episode</label>
                <input type="number" id="episode" name="episode" value="{{ $tvShow->episode }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Update TV Show
                </button>
            </div>
        </form>

        <a href="{{ route('content.index.tvshow') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 rounded-md">
            &larr; Back
        </a>
    </div>
</body>
</html>
